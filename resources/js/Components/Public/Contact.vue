<template>

    <section id="contact" class="contact-section">

        <div class="section-header">
            <span class="section-label">{{ $t('publicContact.eyebrow') }}</span>
            <h2 class="section-title">{{ $t('publicContact.title') }}</h2>
        </div>

        <div class="contact-grid">

            <!-- Info panel -->
            <div class="contact-info">

                <span v-if="safeContact.available" class="availability-badge">
                    <span class="availability-dot"></span>
                    {{ $t('publicContact.available') }}
                </span>

                <p class="contact-description">{{ translation.description }}</p>

                <div class="contact-links">
                    <a v-if="safeContact.email" :href="`mailto:${safeContact.email}`" class="contact-row">
                        <span class="contact-icon material-symbols-outlined">mail</span>
                        <span class="contact-row-text">
                            <span class="contact-label">{{ $t('publicContact.email') }}</span>
                            <span class="contact-value">{{ safeContact.email }}</span>
                        </span>
                    </a>

                    <a v-if="safeContact.whatsapp" :href="whatsappUrl" target="_blank" rel="noopener noreferrer"
                        class="contact-row">
                        <span class="contact-icon material-symbols-outlined">chat</span>
                        <span class="contact-row-text">
                            <span class="contact-label">{{ $t('publicContact.whatsapp') }}</span>
                            <span class="contact-value">{{ safeContact.whatsapp }}</span>
                        </span>
                    </a>

                    <div v-if="fullAddress" class="contact-row static">
                        <span class="contact-icon material-symbols-outlined">location_on</span>
                        <span class="contact-row-text">
                            <span class="contact-label">{{ $t('publicContact.address') }}</span>
                            <span class="contact-value">{{ fullAddress }}</span>
                        </span>
                    </div>

                    <div v-if="translation.working_hours" class="contact-row static">
                        <span class="contact-icon material-symbols-outlined">schedule</span>
                        <span class="contact-row-text">
                            <span class="contact-label">{{ $t('publicContact.working_hours') }}</span>
                            <span class="contact-value">{{ translation.working_hours }}</span>
                        </span>
                    </div>
                </div>

            </div>

            <!-- Map -->
            <div v-if="safeContact.google_maps_url" class="contact-map">
                <iframe
                    :src="safeContact.google_maps_url"
                    class="map-frame"
                    width="600"
                    height="450"
                    style="border:0;"
                    allowfullscreen
                    loading="lazy"
                    referrerpolicy="strict-origin-when-cross-origin"
                    :title="$t('publicContact.map_title')"
                />
                <a :href="googleMapsLink" target="_blank" rel="noopener noreferrer" class="map-open-link">
                    <span class="material-symbols-outlined">open_in_new</span>
                    {{ $t('publicContact.open_in_maps') }}
                </a>
            </div>

        </div>

        <!-- Form -->
        <form class="contact-form" @submit.prevent="handleSubmit">

            <div class="form-row">

                <div class="form-group">
                    <label class="form-label" for="contact-name">
                        {{ $t('publicContact.form.name') }} <span class="required">*</span>
                    </label>
                    <InputText id="contact-name" v-model="form.name" class="form-input"
                        :placeholder="$t('publicContact.form.name_placeholder')" :invalid="!!form.errors.name"
                        required />
                    <span v-if="form.errors.name" class="field-error">{{ form.errors.name }}</span>
                </div>

                <div class="form-group">
                    <label class="form-label" for="contact-email">
                        {{ $t('publicContact.form.email') }} <span class="required">*</span>
                    </label>
                    <InputText id="contact-email" v-model="form.email" type="email" class="form-input"
                        :placeholder="$t('publicContact.form.email_placeholder')" :invalid="!!form.errors.email"
                        required />
                    <span v-if="form.errors.email" class="field-error">{{ form.errors.email }}</span>
                </div>

            </div>

            <div class="form-row">

                <div class="form-group">
                    <label class="form-label" for="contact-phone">
                        {{ $t('publicContact.form.phone') }}
                    </label>
                    <InputText id="contact-phone" v-model="form.phone" type="tel" class="form-input"
                        :placeholder="$t('publicContact.form.phone_placeholder')" :invalid="!!form.errors.phone" />
                    <span v-if="form.errors.phone" class="field-error">{{ form.errors.phone }}</span>
                </div>

                <div class="form-group">
                    <label class="form-label" for="contact-subject">
                        {{ $t('publicContact.form.subject') }}
                    </label>
                    <InputText id="contact-subject" v-model="form.subject" class="form-input"
                        :placeholder="$t('publicContact.form.subject_placeholder')" :invalid="!!form.errors.subject" />
                    <span v-if="form.errors.subject" class="field-error">{{ form.errors.subject }}</span>
                </div>

            </div>

            <div class="form-group">
                <label class="form-label" for="contact-message">
                    {{ $t('publicContact.form.message') }} <span class="required">*</span>
                </label>
                <Textarea id="contact-message" v-model="form.message" class="form-textarea" rows="5"
                    :placeholder="$t('publicContact.form.message_placeholder')" :invalid="!!form.errors.message"
                    required />
                <span v-if="form.errors.message" class="field-error">{{ form.errors.message }}</span>
            </div>

            <div class="form-footer">
                <span v-if="form.recentlySuccessful" class="success-note">
                    <span class="material-symbols-outlined">check_circle</span>
                    {{ $t('publicContact.form.success') }}
                </span>

                <Button type="submit" class="submit-btn"
                    :label="form.processing ? $t('publicContact.form.sending') : $t('publicContact.form.send')"
                    :disabled="form.processing">
                    <span class="material-symbols-outlined">
                        {{ form.processing ? 'progress_activity' : 'send' }}
                    </span>
                </Button>
            </div>

        </form>

    </section>

</template>
<script setup>
// -----------------------------
// Imports
// -----------------------------
import { computed } from 'vue'
import { useForm } from '@inertiajs/vue3'
import { useI18n } from 'vue-i18n'
import InputText from 'primevue/inputtext'
import Textarea from 'primevue/textarea'
import Button from 'primevue/button'
import { useToast } from 'primevue/usetoast'

// -----------------------------
// Props & Emits
// -----------------------------
const props = defineProps({
    contact: {
        type: Object,
        default: () => ({}),
    },
})


// -----------------------------
// Stores & Composables
// -----------------------------
const { locale } = useI18n()

const form = useForm({
    name: '',
    email: '',
    phone: '',
    subject: '',
    message: '',
})

const toast = useToast()
const { t } = useI18n()


// -----------------------------
// Refs & Reactives & Vars
// -----------------------------

// translations are keyed by numeric language_id, same seeded table used elsewhere
const LOCALE_TO_LANGUAGE_ID = {
    en: 1,
    pt: 2,
    es: 3,
    de: 4,
    tr: 5,
    fa: 6,
    ar: 7,
}


// -----------------------------
// Computed & Watch
// -----------------------------
const safeContact = computed(() => props.contact ?? {})

const translation = computed(() => {
    const translations = safeContact.value.translations ?? []
    if (!translations.length) return {}

    const currentId = LOCALE_TO_LANGUAGE_ID[locale.value] ?? 1

    return (
        translations.find((tr) => tr.language_id === currentId) ||
        translations.find((tr) => tr.language_id === LOCALE_TO_LANGUAGE_ID.en) ||
        translations[0]
    )
})

const fullAddress = computed(() => {
    const tr = translation.value
    return [tr.address, tr.city, tr.state, tr.postal_code, tr.country]
        .filter(Boolean)
        .join(', ')
})

const whatsappUrl = computed(() => {
    const digitsOnly = safeContact.value.whatsapp?.replace(/\D/g, '') ?? ''
    return `https://wa.me/${digitsOnly}`
})

const googleMapsLink = computed(() => {
    const parts = [
        safeContact.address,
        safeContact.city,
        safeContact.state,
        safeContact.country,
        safeContact.postal_code,
    ].filter(Boolean)

    return `https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(parts.join(', '))}`
})


// -----------------------------
// Methods
// -----------------------------
function handleSubmit() {
    form.post(route('contact.store'), {
        preserveScroll: true,

        onSuccess: (page) => {
            form.reset()

            toast.add({
                severity: 'success',
                summary: 'Success',
                detail: t('publicContact.form.success'),
                life: 5000,
            })
        },

        onError: (errors) => {
            const firstError = Object.values(errors)[0]
            toast.add({
                severity: 'error',
                summary: 'Validation Error',
                detail: Array.isArray(firstError)
                    ? firstError[0]
                    : firstError,
                life: 6000,
            })
        },
    })
}
</script>
<style scoped>
/* =================================
   SECTION
================================= */

.contact-section {
    padding: 5.5rem 2rem;
    max-width: 1080px;
    margin: 0 auto;
}

.section-header {
    text-align: center;
    margin-bottom: 3rem;
}

.section-label {
    display: inline-block;
    font-size: .78rem;
    font-weight: var(--font-weight-semibold);
    letter-spacing: .14em;
    text-transform: uppercase;
    color: var(--primary);
    margin-bottom: .6rem;
}

.section-title {
    font-family: var(--font-heading);
    font-size: clamp(1.7rem, 3.5vw, 2.3rem);
    font-weight: var(--font-weight-bold);
    letter-spacing: -.01em;
}


/* =================================
   LAYOUT
================================= */

.contact-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
    align-items: stretch;
    margin-bottom: 2.5rem;
}


/* =================================
   INFO PANEL
================================= */

.contact-info {
    opacity: 0;
    animation: slideIn .6s cubic-bezier(.22, 1, .36, 1) forwards;
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateX(-16px);
    }

    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.availability-badge {
    display: inline-flex;
    align-items: center;
    gap: .45rem;
    background: var(--tag-bg);
    color: var(--tag-text);
    border: 1px solid var(--border);
    border-radius: 999px;
    padding: .4rem .9rem .4rem .7rem;
    font-size: .78rem;
    font-weight: var(--font-weight-medium);
    margin-bottom: 1.4rem;
}

.availability-dot {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: var(--success);
    animation: dotPulse 2s infinite;
}

@keyframes dotPulse {
    0% {
        box-shadow: 0 0 0 0 rgba(5, 150, 105, .45);
    }

    70% {
        box-shadow: 0 0 0 8px rgba(5, 150, 105, 0);
    }

    100% {
        box-shadow: 0 0 0 0 rgba(5, 150, 105, 0);
    }
}

.contact-description {
    font-size: .95rem;
    color: var(--text-muted);
    line-height: 1.8;
    margin-bottom: 2rem;
    max-width: 440px;
}

.contact-links {
    display: flex;
    flex-direction: column;
    gap: .6rem;
}

.contact-row {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: .9rem 1rem;
    border-radius: var(--radius-sm);
    text-decoration: none;
    color: inherit;
    border: 1px solid transparent;
    transition:
        background var(--transition-fast),
        border-color var(--transition-fast),
        transform var(--transition-fast);
}

a.contact-row:hover {
    background: var(--tag-bg);
    border-color: var(--border);
    transform: translateX(4px);
}

.contact-row.static {
    cursor: default;
}

.contact-icon {
    width: 38px;
    height: 38px;
    flex-shrink: 0;
    border-radius: var(--radius-sm);
    background: var(--tag-bg);
    color: var(--primary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 19px;
}

.contact-row-text {
    display: flex;
    flex-direction: column;
    min-width: 0;
}

.contact-label {
    font-size: .72rem;
    color: var(--text-subtle);
    text-transform: uppercase;
    letter-spacing: .05em;
    margin-bottom: .15rem;
}

.contact-value {
    font-size: .88rem;
    color: var(--text);
    font-weight: var(--font-weight-medium);
    word-break: break-word;
}


/* =================================
   MAP
================================= */

.contact-map {
    position: relative;
    border-radius: var(--radius);
    overflow: hidden;
    border: 1px solid var(--border);
    background: var(--bg-3);
    min-height: 280px;

    opacity: 0;
    animation: slideIn .6s cubic-bezier(.22, 1, .36, 1) .12s forwards;
}

.map-frame {
    display: block;
    width: 100%;
    height: 100%;
    min-height: 280px;
    border: none;
    filter: grayscale(.15) contrast(1.05);
}

.map-open-link {
    position: absolute;
    bottom: .8rem;
    right: .8rem;
    display: inline-flex;
    align-items: center;
    gap: .4rem;
    background: var(--card);
    color: var(--text);
    border: 1px solid var(--border);
    border-radius: 999px;
    padding: .5rem 1rem;
    font-size: .78rem;
    font-weight: var(--font-weight-medium);
    text-decoration: none;
    box-shadow: 0 8px 20px -8px rgba(0, 0, 0, .35);
    transition:
        border-color var(--transition-fast),
        background var(--transition-fast),
        transform var(--transition-fast);
}

.map-open-link .material-symbols-outlined {
    font-size: 16px;
}

.map-open-link:hover {
    border-color: var(--primary);
    background: var(--tag-bg);
    transform: translateY(-2px);
}


/* =================================
   FORM
================================= */

.contact-form {
    display: flex;
    flex-direction: column;
    gap: 1.2rem;
    width: 100%;
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 2rem;

    opacity: 0;
    animation: slideInRight .6s cubic-bezier(.22, 1, .36, 1) .1s forwards;
}

@keyframes slideInRight {
    from {
        opacity: 0;
        transform: translateX(16px);
    }

    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.2rem;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: .5rem;
}

.form-label {
    font-size: .8rem;
    font-weight: var(--font-weight-medium);
    color: var(--text-muted);
}

.required {
    color: var(--danger);
}

.field-error {
    font-size: .78rem;
    color: var(--danger);
}

:deep(.form-input),
:deep(.form-textarea) {
    background: var(--bg-3);
    border: 1px solid var(--border);
    border-radius: var(--radius-sm);
    padding: .7rem .9rem;
    color: var(--text);
    font-family: var(--font-primary);
    font-size: .9rem;
    width: 100%;
    transition: border-color var(--transition-fast), box-shadow var(--transition-fast);
}

:deep(.form-textarea) {
    resize: vertical;
    line-height: 1.6;
}

:deep(.form-input:focus),
:deep(.form-textarea:focus) {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px var(--tag-bg);
}

:deep(.form-input.p-invalid),
:deep(.form-textarea.p-invalid) {
    border-color: var(--danger);
}

.form-footer {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 1.2rem;
    margin-top: .4rem;
}

.success-note {
    display: inline-flex;
    align-items: center;
    gap: .4rem;
    color: var(--success);
    font-size: .85rem;
    font-weight: var(--font-weight-medium);
}

.success-note .material-symbols-outlined {
    font-size: 18px;
}

:deep(.submit-btn) {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: .5rem;
    margin-top: .4rem;
    padding: .8rem 1.6rem;
    border-radius: 999px;
    background: var(--primary);
    border: 1px solid var(--primary);
    color: #fff;
    font-family: var(--font-primary);
    font-size: .9rem;
    font-weight: var(--font-weight-medium);
    cursor: pointer;
    transition:
        background var(--transition-fast),
        transform var(--transition-fast),
        box-shadow var(--transition-fast);
}

:deep(.submit-btn:hover:not(:disabled)) {
    background: var(--primary-hover);
    transform: translateY(-2px);
    box-shadow: 0 10px 24px -8px var(--glow);
}

:deep(.submit-btn:disabled) {
    opacity: .7;
    cursor: default;
}

:deep(.submit-btn .material-symbols-outlined) {
    font-size: 18px;
}

:deep(.submit-btn:disabled .material-symbols-outlined) {
    animation: spin .8s linear infinite;
}

@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}


/* =================================
   RESPONSIVE
================================= */

@media (max-width: 768px) {

    .contact-grid {
        grid-template-columns: 1fr;
    }

    .form-row {
        grid-template-columns: 1fr;
    }

    .form-footer {
        flex-direction: column-reverse;
        align-items: stretch;
    }

    :deep(.submit-btn) {
        width: 100%;
    }

}

@media (max-width: 640px) {

    .contact-section {
        padding: 3.5rem 1.25rem;
    }

    .contact-form {
        padding: 1.5rem;
    }

}


/* =================================
   MOTION SAFETY
================================= */

@media (prefers-reduced-motion: reduce) {

    .contact-info,
    .contact-form,
    .contact-map,
    .availability-dot,
    .contact-row {
        animation: none !important;
        transition: none !important;
        opacity: 1 !important;
        transform: none !important;
    }
}
</style>