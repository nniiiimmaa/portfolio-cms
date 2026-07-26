<template>
    <AdminLayout>
        <template #title>{{ $t('adminMessage.title') }}</template>

        <div class="messages-page">

            <div class="page-header">
                <p class="page-subtitle">
                    {{ $t('adminMessage.subtitle') }}
                    <span v-if="unreadCount" class="unread-count">{{ $t('adminMessage.unread_count', {
                        count:
                        unreadCount })
                        }}</span>
                </p>
            </div>

            <div v-if="sortedMessages.length" class="message-list">
                <button v-for="msg in sortedMessages" :key="msg.id" type="button" class="message-row"
                    :class="{ unread: !msg.read_at }" @click="openMessage(msg)">
                    <span class="unread-dot" v-if="!msg.read_at"></span>

                    <div class="row-main">
                        <div class="row-top">
                            <span class="row-name">{{ msg.name }}</span>
                            <span class="row-date">{{ formatDateTime(msg.created_at) }}</span>
                        </div>
                        <p class="row-subject">{{ msg.subject }}</p>
                        <p class="row-snippet">{{ msg.message }}</p>
                    </div>

                    <span class="status-badge" :class="`status-${msg.status}`">
                        <span class="status-dot"></span>
                        {{ $t(`adminMessage.status_${msg.status}`) }}
                    </span>

                    <span class="material-symbols-outlined row-chevron">chevron_right</span>
                </button>
            </div>

            <div v-else class="empty-state">
                <span class="material-symbols-outlined">mail</span>
                <p>{{ $t('adminMessage.empty') }}</p>
            </div>

        </div>

        <!-- ═══ MESSAGE DETAIL DIALOG ═══ -->
        <Dialog v-model:visible="messageDialogOpen" modal :pt="dialogPt" dismissable-mask class="message-dialog"
            :style="{ width: '38rem', maxWidth: '94vw' }" @hide="closeMessage">
            <template #header>
                <h3 class="dialog-title">{{ activeMessage?.subject }}</h3>
            </template>

            <div v-if="activeMessage" class="message-detail">

                <div class="sender-row">
                    <div class="sender-avatar">{{ initialsOf(activeMessage.name) }}</div>
                    <div class="sender-info">
                        <p class="sender-name">{{ activeMessage.name }}</p>
                        <a :href="`mailto:${activeMessage.email}`" class="sender-email">{{ activeMessage.email }}</a>
                        <p v-if="activeMessage.phone" class="sender-phone">
                            <span class="material-symbols-outlined">call</span>
                            {{ activeMessage.phone }}
                        </p>
                    </div>

                    <button v-if="!activeMessage.read_at" type="button" class="mark-read-btn" :disabled="markingAsRead"
                        @click="markAsRead(activeMessage.id)">
                        <span class="material-symbols-outlined">mark_email_read</span>
                        {{ markingAsRead ? $t('adminMessage.marking_as_read') : $t('adminMessage.mark_as_read') }}
                    </button>
                    <span v-else class="status-badge" :class="`status-${activeMessage.status}`">
                        <span class="status-dot"></span>
                        {{ $t(`adminMessage.status_${activeMessage.status}`) }}
                    </span>
                </div>

                <div class="message-body">{{ activeMessage.message }}</div>

                <div class="meta-grid">
                    <div class="meta-item">
                        <span class="meta-label">{{ $t('adminMessage.fields.submitted_at') }}</span>
                        <span class="meta-value">{{ formatDateTime(activeMessage.created_at) }}</span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-label">{{ $t('adminMessage.fields.read_at') }}</span>
                        <span class="meta-value">{{ activeMessage.read_at ? formatDateTime(activeMessage.read_at) :
                            $t('adminMessage.not_yet') }}</span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-label">{{ $t('adminMessage.fields.replied_at') }}</span>
                        <span class="meta-value">{{ activeMessage.replied_at ? formatDateTime(activeMessage.replied_at)
                            :
                            $t('adminMessage.not_yet') }}</span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-label">{{ $t('adminMessage.fields.ip_address') }}</span>
                        <span class="meta-value">{{ activeMessage.ip_address ?? '—' }}</span>
                    </div>
                    <div v-if="activeMessage.referrer" class="meta-item span-2">
                        <span class="meta-label">{{ $t('adminMessage.fields.referrer') }}</span>
                        <a :href="activeMessage.referrer" target="_blank" rel="noopener noreferrer"
                            class="meta-value link">
                            {{ activeMessage.referrer }}
                        </a>
                    </div>
                    <div v-if="activeMessage.user_agent" class="meta-item span-2">
                        <span class="meta-label">{{ $t('adminMessage.fields.user_agent') }}</span>
                        <span class="meta-value muted">{{ activeMessage.user_agent }}</span>
                    </div>
                </div>

                <!-- ═══ REPLY ═══ -->
                <div class="reply-section">
                    <div class="reply-header">
                        <label class="form-label" for="reply-message">
                            {{ activeMessage.replied_at ? $t('adminMessage.reply_again_label') :
                                $t('adminMessage.reply_label')
                            }}
                        </label>

                        <div class="channel-toggle">
                            <button type="button" class="channel-btn" :class="{ active: replyChannel === 'email' }"
                                @click="replyChannel = 'email'">
                                <span class="material-symbols-outlined">mail</span>
                                {{ $t('adminMessage.channel_email') }}
                            </button>
                            <button type="button" class="channel-btn" :class="{ active: replyChannel === 'whatsapp' }"
                                :disabled="!hasWhatsapp" :title="!hasWhatsapp ? $t('adminMessage.no_phone') : ''"
                                @click="replyChannel = 'whatsapp'">
                                <span class="material-symbols-outlined">chat</span>
                                {{ $t('adminMessage.channel_whatsapp') }}
                            </button>
                        </div>
                    </div>

                    <Textarea id="reply-message" v-model="replyForm.message" :pt="textareaPt" rows="5"
                        :placeholder="replyChannel === 'whatsapp' ? $t('adminMessage.reply_placeholder_whatsapp') : $t('adminMessage.reply_placeholder_email')" />
                    <span v-if="replyForm.errors.message" class="field-error">{{ replyForm.errors.message }}</span>

                    <p v-if="replyChannel === 'whatsapp'" class="channel-hint">
                        <span class="material-symbols-outlined">info</span>
                        {{ $t('adminMessage.whatsapp_hint') }}
                    </p>
                </div>

            </div>

            <template #footer>
                <Button :pt="outlineButtonPt" :label="$t('adminMessage.close')" @click="messageDialogOpen = false" />
                <Button :pt="primaryButtonPt" :label="sendButtonLabel"
                    :disabled="replyForm.processing || !replyForm.message.trim()" @click="sendReply" />
            </template>
        </Dialog>

    </AdminLayout>
</template>
<script setup>
// -----------------------------
// Imports
// -----------------------------
import { computed, ref } from 'vue'
import { router, useForm } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/Admin/AdminLayout.vue'

import Textarea from 'primevue/textarea'
import Button from 'primevue/button'
import Dialog from 'primevue/dialog'
import { useToast } from 'primevue/usetoast'

import { primaryButtonPt, outlineButtonPt } from '@/PrimeVue/PT/button.pt'
import { textareaPt } from '@/PrimeVue/PT/textarea.pt'
import { dialogPt } from '@/PrimeVue/PT/dialog.pt'
import { useFormErrors } from '@/Composables/useFormErrors'
import { useI18n } from 'vue-i18n'


// -----------------------------
// Props & Emits
// -----------------------------
const props = defineProps({
    messages: {
        type: Array,
        default: () => [],
    },
})


// -----------------------------
// Stores & Composables
// -----------------------------
const toast = useToast()
const { showFormErrors } = useFormErrors()
const { t } = useI18n()


// -----------------------------
// Refs & Reactives & Vars
// -----------------------------
const activeMessageId = ref(null)
const messageDialogOpen = ref(false)
const replyForm = useForm({ message: '' })
const replyChannel = ref('email') // 'email' | 'whatsapp'
const markingAsRead = ref(false)


// -----------------------------
// Computed & Watch
// -----------------------------
const sortedMessages = computed(() =>
    [...props.messages].sort((a, b) => new Date(b.created_at) - new Date(a.created_at))
)

const unreadCount = computed(() =>
    props.messages.filter((msg) => !msg.read_at).length
)

// looked up from props by id (rather than held as a standalone copy) so
// it automatically reflects the fresh read_at / replied_at values once
// the backend responds and Inertia updates the messages prop
const activeMessage = computed(() =>
    props.messages.find((msg) => msg.id === activeMessageId.value) ?? null
)

const hasWhatsapp = computed(() => Boolean(activeMessage.value?.phone))

// mailto: link — mirrors the WhatsApp approach: there's no send-on-your-
// behalf API for email either, so "sending via email" opens the admin's
// default mail client with the recipient, subject, and body pre-filled
const emailLink = computed(() => {
    if (!activeMessage.value?.email) return null
    const subject = `Re: ${activeMessage.value.subject ?? ''}`
    return `mailto:${activeMessage.value.email}?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(replyForm.message)}`
})

// wa.me deep link — WhatsApp has no send-on-someone's-behalf API for a
// plain contact form, so "sending via WhatsApp" opens a pre-filled chat
// in a new tab for the admin to hit send on themselves
const whatsappLink = computed(() => {
    if (!activeMessage.value?.phone) return null
    const digits = activeMessage.value.phone.replace(/[^\d]/g, '')
    return `https://wa.me/${digits}?text=${encodeURIComponent(replyForm.message)}`
})

const sendButtonLabel = computed(() => {
    if (replyForm.processing) return t('adminMessage.sending')
    return replyChannel.value === 'whatsapp' ? t('adminMessage.channel_whatsapp') : t('adminMessage.send_reply')
})


// -----------------------------
// Methods
// -----------------------------
function initialsOf(name) {
    if (!name) return ''
    return name.split(' ').map((w) => w[0]).slice(0, 2).join('').toUpperCase()
}

function formatDateTime(value) {
    if (!value) return ''
    return new Date(value).toLocaleString(undefined, {
        dateStyle: 'medium',
        timeStyle: 'short',
    })
}

/* Open / close detail dialog — no longer marks anything as read on open;
   that now only happens when the admin explicitly clicks the button */
function openMessage(msg) {
    activeMessageId.value = msg.id
    replyForm.reset()
    replyForm.clearErrors()
    replyChannel.value = 'email'
    messageDialogOpen.value = true
}

function closeMessage() {
    messageDialogOpen.value = false
    activeMessageId.value = null
    replyForm.reset()
    replyForm.clearErrors()
    replyChannel.value = 'email'
}

/* Mark as read — only fires when the admin clicks the button in the dialog */
function markAsRead(messageId) {
    markingAsRead.value = true

    router.put(route('messages.read', messageId), {}, {
        preserveScroll: true,
        preserveState: true,
        only: ['messages'],

        onFinish: () => {
            markingAsRead.value = false
        },
    })
}

/* Reply */
function sendReply() {
    if (!activeMessage.value) return

    // Neither channel has a send-on-your-behalf API here, so the actual
    // sending happens in the admin's own mail client / WhatsApp — the
    // backend call still fires (with the channel) purely to log replied_at
    if (replyChannel.value === 'whatsapp' && whatsappLink.value) {
        window.open(whatsappLink.value, '_blank', 'noopener,noreferrer')
    } else if (replyChannel.value === 'email' && emailLink.value) {
        // mailto: links launch the OS mail client rather than navigating
        // the page, so location.href is safe to use here
        window.location.href = emailLink.value
    }

    replyForm
        .transform((data) => ({ ...data, channel: replyChannel.value }))
        .put(route('messages.reply', activeMessage.value.id), {
            preserveScroll: true,

            onSuccess: () => {
                replyForm.reset()
                toast.add({
                    severity: 'success',
                    summary: t('adminMessage.reply_sent_title'),
                    detail: t(
                        replyChannel.value === 'whatsapp'
                            ? 'adminMessage.reply_sent_whatsapp_message'
                            : 'adminMessage.reply_sent_email_message'
                    ),
                    life: 4000,
                })
            },

            onError: (errors) => {
                showFormErrors(errors)
            },
        })
}
</script>
<style scoped>
/* =================================
   PAGE
================================= */

.messages-page {
    max-width: 900px;
    margin: 0 auto;
}

.page-header {
    margin-bottom: 1.8rem;
}

.page-subtitle {
    font-size: .87rem;
    color: var(--text-muted);
}

.unread-count {
    display: inline-flex;
    align-items: center;
    background: var(--tag-bg);
    color: var(--primary);
    border-radius: 999px;
    padding: .1rem .55rem;
    font-size: .72rem;
    font-weight: var(--font-weight-semibold);
    margin-left: .5rem;
}


/* =================================
   LIST
================================= */

.message-list {
    display: flex;
    flex-direction: column;
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    overflow: hidden;
}

.message-row {
    display: flex;
    align-items: center;
    gap: 1rem;
    width: 100%;
    text-align: left;
    padding: 1.1rem 1.4rem;
    background: none;
    border: none;
    border-bottom: 1px solid var(--border);
    cursor: pointer;
    transition: background var(--transition-fast);
}

.message-row:last-child {
    border-bottom: none;
}

.message-row:hover {
    background: var(--bg-3);
}

.message-row.unread .row-name,
.message-row.unread .row-subject {
    font-weight: var(--font-weight-semibold);
    color: var(--text);
}

.unread-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: var(--primary);
    flex-shrink: 0;
}

.row-main {
    flex: 1;
    min-width: 0;
}

.row-top {
    display: flex;
    align-items: baseline;
    justify-content: space-between;
    gap: .8rem;
    margin-bottom: .2rem;
}

.row-name {
    font-size: .88rem;
    color: var(--text);
    font-weight: var(--font-weight-medium);
}

.row-date {
    font-size: .74rem;
    color: var(--text-subtle);
    flex-shrink: 0;
}

.row-subject {
    font-size: .84rem;
    color: var(--text-muted);
    margin-bottom: .15rem;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.row-snippet {
    font-size: .78rem;
    color: var(--text-subtle);
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.row-chevron {
    color: var(--text-subtle);
    font-size: 20px;
    flex-shrink: 0;
}

.status-badge {
    display: inline-flex;
    align-items: center;
    gap: .35rem;
    border-radius: 999px;
    padding: .2rem .65rem .2rem .55rem;
    font-size: .7rem;
    font-weight: var(--font-weight-medium);
    background: var(--bg-3);
    color: var(--text-muted);
    flex-shrink: 0;
    white-space: nowrap;
}

.status-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: currentColor;
}

.status-badge.status-new {
    color: var(--primary);
    background: var(--tag-bg);
}

.status-badge.status-read {
    color: var(--text-muted);
}

.status-badge.status-replied {
    color: var(--success);
    background: var(--tag-bg);
}


/* =================================
   EMPTY STATE
================================= */

.empty-state {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: .6rem;
    padding: 4rem 1rem;
    color: var(--text-subtle);
    text-align: center;
}

.empty-state .material-symbols-outlined {
    font-size: 40px;
}


/* =================================
   DIALOG
================================= */

.dialog-title {
    font-family: var(--font-heading);
    font-size: 1.05rem;
    font-weight: var(--font-weight-semibold);
    color: var(--text);
}

.message-detail {
    display: flex;
    flex-direction: column;
    gap: 1.4rem;
}

.sender-row {
    display: flex;
    align-items: center;
    gap: .9rem;
}

.sender-avatar {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: var(--tag-bg);
    color: var(--primary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: .8rem;
    font-weight: var(--font-weight-semibold);
    flex-shrink: 0;
}

.sender-info {
    flex: 1;
    min-width: 0;
}

.sender-name {
    font-size: .92rem;
    font-weight: var(--font-weight-semibold);
    color: var(--text);
}

.sender-email {
    font-size: .82rem;
    color: var(--primary);
    text-decoration: none;
}

.sender-email:hover {
    text-decoration: underline;
}

.sender-phone {
    display: flex;
    align-items: center;
    gap: .3rem;
    font-size: .8rem;
    color: var(--text-muted);
    margin-top: .1rem;
}

.sender-phone .material-symbols-outlined {
    font-size: 14px;
}

.mark-read-btn {
    display: inline-flex;
    align-items: center;
    gap: .35rem;
    border-radius: 999px;
    padding: .3rem .75rem;
    font-size: .74rem;
    font-weight: var(--font-weight-medium);
    color: var(--primary);
    background: var(--tag-bg);
    border: 1px solid var(--border);
    cursor: pointer;
    white-space: nowrap;
    flex-shrink: 0;
    transition: border-color var(--transition-fast), opacity var(--transition-fast);
}

.mark-read-btn .material-symbols-outlined {
    font-size: 15px;
}

.mark-read-btn:hover {
    border-color: var(--primary);
}

.mark-read-btn:disabled {
    opacity: .6;
    cursor: not-allowed;
}

.message-body {
    background: var(--bg-3);
    border: 1px solid var(--border);
    border-radius: var(--radius-sm);
    padding: 1rem 1.1rem;
    font-size: .87rem;
    color: var(--text);
    line-height: 1.65;
    white-space: pre-wrap;
}

.meta-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: .9rem 1.4rem;
}

.meta-item {
    display: flex;
    flex-direction: column;
    gap: .2rem;
    min-width: 0;
}

.meta-item.span-2 {
    grid-column: span 2;
}

.meta-label {
    font-size: .72rem;
    font-weight: var(--font-weight-medium);
    color: var(--text-subtle);
    text-transform: uppercase;
    letter-spacing: .02em;
}

.meta-value {
    font-size: .82rem;
    color: var(--text);
    word-break: break-word;
}

.meta-value.link {
    color: var(--primary);
    text-decoration: none;
}

.meta-value.link:hover {
    text-decoration: underline;
}

.meta-value.muted {
    color: var(--text-subtle);
    font-size: .76rem;
}

.reply-section {
    display: flex;
    flex-direction: column;
    gap: .5rem;
    padding-top: .4rem;
    border-top: 1px solid var(--border);
}

.reply-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
    flex-wrap: wrap;
}

.channel-toggle {
    display: inline-flex;
    border: 1px solid var(--border);
    border-radius: var(--radius-sm);
    overflow: hidden;
}

.channel-btn {
    display: inline-flex;
    align-items: center;
    gap: .35rem;
    padding: .35rem .75rem;
    font-size: .78rem;
    font-weight: var(--font-weight-medium);
    color: var(--text-muted);
    background: var(--bg-3);
    border: none;
    cursor: pointer;
    transition: background var(--transition-fast), color var(--transition-fast);
}

.channel-btn+.channel-btn {
    border-left: 1px solid var(--border);
}

.channel-btn .material-symbols-outlined {
    font-size: 15px;
}

.channel-btn.active {
    background: var(--tag-bg);
    color: var(--primary);
}

.channel-btn:disabled {
    opacity: .45;
    cursor: not-allowed;
}

.channel-hint {
    display: flex;
    align-items: center;
    gap: .35rem;
    font-size: .76rem;
    color: var(--text-subtle);
}

.channel-hint .material-symbols-outlined {
    font-size: 14px;
}

.form-label {
    font-size: .8rem;
    font-weight: var(--font-weight-medium);
    color: var(--text-muted);
}

.field-error {
    font-size: .78rem;
    color: var(--danger);
}


/* =================================
   RESPONSIVE
================================= */

@media (max-width: 640px) {

    .message-row {
        flex-wrap: wrap;
        padding: 1rem;
    }

    .row-chevron {
        display: none;
    }

    .meta-grid {
        grid-template-columns: 1fr;
    }

    .meta-item.span-2 {
        grid-column: span 1;
    }

}
</style>