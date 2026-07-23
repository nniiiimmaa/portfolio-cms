<template>

    <AdminLayout>
        <template #title>{{ $t('adminProfile.title') }}</template>

        <div class="profile-page">

            <!-- ═══ 1. ACCOUNT ═══ -->
            <section class="panel-card">
                <div class="panel-header">
                    <div>
                        <h3 class="panel-title">{{ $t('adminProfile.account.title') }}</h3>
                        <p class="panel-subtitle">{{ $t('adminProfile.account.subtitle') }}</p>
                    </div>
                </div>

                <form @submit.prevent="submitAccount">

                    <div class="photo-row">
                        <div class="photo-preview">
                            <img v-if="photoPreview" :src="photoPreview" :alt="$t('adminProfile.account.photo_alt')" />
                            <span v-else>{{ accountInitials }}</span>
                        </div>
                        <div class="photo-actions">
                            <label class="btn-outline file-btn">
                                <span class="material-symbols-outlined">upload</span>
                                {{ $t('adminProfile.account.upload_photo') }}
                                <input type="file" accept="image/*" hidden @change="onPhotoChange" />
                            </label>
                            <span v-if="accountForm.errors.photo" class="field-error">{{ accountForm.errors.photo
                                }}</span>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="first-name">{{ $t('adminProfile.fields.first_name')
                                }}</label>
                            <InputText id="first-name" v-model="accountForm.first_name" :pt="formInputPt"
                                :invalid="!!accountForm.errors.first_name" required autofocus />
                            <span v-if="accountForm.errors.first_name" class="field-error">{{
                                accountForm.errors.first_name
                                }}</span>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="last-name">{{ $t('adminProfile.fields.last_name') }}</label>
                            <InputText id="last-name" v-model="accountForm.last_name" :pt="formInputPt"
                                :invalid="!!accountForm.errors.last_name" required />
                            <span v-if="accountForm.errors.last_name" class="field-error">{{
                                accountForm.errors.last_name
                                }}</span>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="username">{{ $t('adminProfile.fields.username') }}</label>
                            <InputText id="username" v-model="accountForm.username" :pt="formInputPt"
                                :invalid="!!accountForm.errors.username" required />
                            <span v-if="accountForm.errors.username" class="field-error">{{ accountForm.errors.username
                                }}</span>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="account-email">{{ $t('adminProfile.fields.email') }}</label>
                            <InputText id="account-email" v-model="accountForm.email" type="email" :pt="formInputPt"
                                :invalid="!!accountForm.errors.email" required />
                            <span v-if="accountForm.errors.email" class="field-error">{{ accountForm.errors.email
                                }}</span>
                        </div>
                    </div>

                    <div v-if="mustVerifyEmail && !user.email_verified_at" class="verify-notice">
                        <p>
                            {{ $t('adminProfile.verification.unverified') }}
                            <Link :href="route('verification.send')" method="post" as="button" class="verify-link">
                                {{ $t('adminProfile.verification.resend') }}
                            </Link>
                        </p>

                        <p v-if="status === 'verification-link-sent'" class="verify-success">
                            {{ $t('adminProfile.verification.sent') }}
                        </p>
                    </div>

                    <div class="status-panel">
                        <div class="status-item">
                            <span class="status-label">{{ $t('adminProfile.status.account_status') }}</span>

                            <span class="status-pill" :class="{ inactive: !user.active }">
                                <span class="status-dot"></span>
                                {{ user.active ? $t('adminProfile.status.active') : $t('adminProfile.status.inactive')
                                }}
                            </span>
                        </div>

                        <div class="status-item">
                            <span class="status-label">{{ $t('adminProfile.status.last_login') }}</span>

                            <span class="status-value">
                                {{ user.last_login_at ? formatDate(user.last_login_at) : '—' }}
                                <span v-if="user.last_login_ip" class="status-sub">
                                    ({{ user.last_login_ip }})
                                </span>
                            </span>
                        </div>
                    </div>

                    <div class="form-footer">
                        <span v-if="accountForm.recentlySuccessful" class="success-note">
                            <span class="material-symbols-outlined">check_circle</span>
                            {{ $t('adminProfile.saved') }}
                        </span>

                        <Button type="submit" :pt="primaryButtonPt"
                            :label="accountForm.processing ? $t('adminProfile.saving') : $t('adminProfile.save_changes')"
                            :disabled="accountForm.processing" />
                    </div>

                </form>

                <div class="section-divider">
                    <span class="material-symbols-outlined">lock</span>
                    {{ $t('adminProfile.password.title') }}
                </div>

                <form @submit.prevent="submitPassword">

                    <div class="form-group">
                        <label class="form-label" for="current-password">
                            {{ $t('adminProfile.password.current') }}
                        </label>

                        <Password id="current-password" ref="currentPasswordInput"
                            v-model="passwordForm.current_password" :pt="passwordPt" :feedback="false"
                            toggle-mask :invalid="!!passwordForm.errors.current_password"
                            autocomplete="current-password" />

                        <span v-if="passwordForm.errors.current_password" class="field-error">
                            {{ passwordForm.errors.current_password }}
                        </span>
                    </div>

                    <div class="form-row">

                        <div class="form-group">
                            <label class="form-label" for="new-password">
                                {{ $t('adminProfile.password.new') }}
                            </label>

                            <Password id="new-password" ref="newPasswordInput" v-model="passwordForm.password"
                                :pt="passwordPt" :feedback="false" toggle-mask
                                :invalid="!!passwordForm.errors.password" autocomplete="new-password" />

                            <span v-if="passwordForm.errors.password" class="field-error">
                                {{ passwordForm.errors.password }}
                            </span>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="confirm-password">
                                {{ $t('adminProfile.password.confirm') }}
                            </label>

                            <Password id="confirm-password" v-model="passwordForm.password_confirmation"
                                :pt="passwordPt" :feedback="false" toggle-mask
                                :invalid="!!passwordForm.errors.password_confirmation" autocomplete="new-password" />

                            <span v-if="passwordForm.errors.password_confirmation" class="field-error">
                                {{ passwordForm.errors.password_confirmation }}
                            </span>
                        </div>

                    </div>

                    <div class="form-footer">
                        <span v-if="passwordForm.recentlySuccessful" class="success-note">
                            <span class="material-symbols-outlined">check_circle</span>
                            {{ $t('adminProfile.saved') }}
                        </span>

                        <Button type="submit" :pt="primaryButtonPt"
                            :label="passwordForm.processing ? $t('adminProfile.saving') : $t('adminProfile.save_changes')"
                            :disabled="passwordForm.processing" />
                    </div>

                </form>
            </section>

            <!-- DELETE ACCOUNT -->
            <section class="panel-card danger">
                <div class="panel-header no-border">
                    <div>
                        <h3 class="panel-title danger-title">
                            {{ $t('adminProfile.delete.title') }}
                        </h3>

                        <p class="panel-subtitle">
                            {{ $t('adminProfile.delete.description') }}
                        </p>
                    </div>
                </div>

                <Button :pt="dangerButtonPt" :label="$t('adminProfile.delete.button')" @click="confirmDeletion" />
            </section>

        </div>

        <Dialog v-model:visible="confirmingDeletion" modal :pt="dialogPt" dismissable-mask class="delete-dialog"
            :style="{ width: '26rem', maxWidth: '92vw' }" @hide="closeDeleteDialog">
            <template #header>
                <h3 class="dialog-title">
                    {{ $t('adminProfile.delete.confirm_title') }}
                </h3>
            </template>

            <p class="dialog-text">
                {{ $t('adminProfile.delete.confirm_description') }}
            </p>

            <div class="form-group">
                <label class="form-label" for="delete-password">
                    {{ $t('adminProfile.password.title') }}
                </label>

                <Password id="delete-password" ref="deletePasswordInput" v-model="deleteForm.password"
                    :pt="passwordPt" :feedback="false" toggle-mask
                    :invalid="!!deleteForm.errors.password" :placeholder="$t('adminProfile.password.placeholder')"
                    @keyup.enter="deleteAccount" />

                <span v-if="deleteForm.errors.password" class="field-error">
                    {{ deleteForm.errors.password }}
                </span>
            </div>

            <template #footer>

                <Button class="btn-outline" :label="$t('adminProfile.cancel')" @click="closeDeleteDialog" />

                <Button :pt="dangerButtonPt"
                    :label="deleteForm.processing ? $t('adminProfile.deleting') : $t('adminProfile.delete.button')"
                    :disabled="deleteForm.processing" @click="deleteAccount" />

            </template>

        </Dialog>
    </AdminLayout>
</template>

<script setup>
// -----------------------------
// Imports
// -----------------------------
import { computed, nextTick, ref } from 'vue'
import { Link, useForm, usePage } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/Admin/AdminLayout.vue'

import InputText from 'primevue/inputtext'
import Password from 'primevue/password'
import Button from 'primevue/button'
import Dialog from 'primevue/dialog'
import { useToast } from 'primevue/usetoast'
import { dialogPt } from '@/PrimeVue/PT/dialog.pt'
import { primaryButtonPt, dangerButtonPt } from '@/PrimeVue/PT/button.pt'
import { formInputPt } from '@/PrimeVue/PT/inputText.pt'
import { passwordPt } from '@/PrimeVue/PT/password.pt'
import { useFormErrors } from '@/Composables/useFormErrors'

// -----------------------------
// Props & Emits
// -----------------------------
const props = defineProps({
    mustVerifyEmail: {
        type: Boolean,
        default: false,
    },
    status: {
        type: String,
        default: null,
    },
})


// -----------------------------
// Stores & Composables
// -----------------------------
const page = usePage()
const { showFormErrors } = useFormErrors()
const toast = useToast()

// -----------------------------
// Refs & Reactives & Vars
// -----------------------------
const user = computed(() => page.props.auth?.user ?? {})

const accountForm = useForm({
    first_name: user.value.first_name ?? '',
    last_name: user.value.last_name ?? '',
    username: user.value.username ?? '',
    email: user.value.email ?? '',
    photo: null,
})
const photoPreview = ref(user.value.photo ?? null)

const passwordForm = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
})
const currentPasswordInput = ref(null)
const newPasswordInput = ref(null)

const confirmingDeletion = ref(false)
const deletePasswordInput = ref(null)
const deleteForm = useForm({ password: '' })


// -----------------------------
// Computed & Watch
// -----------------------------
const accountInitials = computed(() => {
    const first = accountForm.first_name?.[0] ?? ''
    const last = accountForm.last_name?.[0] ?? ''
    return (first + last).toUpperCase()
})


// -----------------------------
// Methods
// -----------------------------
function formatDate(dateStr) {
    if (!dateStr) return '—'
    return new Date(dateStr).toLocaleString(undefined, {
        dateStyle: 'medium',
        timeStyle: 'short',
    })
}

/* Account */
function onPhotoChange(event) {
    const file = event.target.files?.[0]
    if (!file) return
    accountForm.photo = file
    photoPreview.value = URL.createObjectURL(file)
}

function submitAccount() {
    accountForm.patch(route('profile.update'), {
        forceFormData: true,
        preserveScroll: true,

        onSuccess: () => {
            toast.add({
                severity: 'success',
                summary: 'Profile Updated',
                detail: 'Your profile information has been updated successfully.',
                life: 4000,
            })
        },

        onError: (errors) => {
            showFormErrors(errors)
        },
    })
}


function submitPassword() {
    passwordForm.put(route('password.update'), {
        preserveScroll: true,
        onSuccess: () => {
            passwordForm.reset()

            toast.add({
                severity: 'success',
                summary: 'Password Updated',
                detail: 'Your password has been updated successfully.',
                life: 4000,
            })
        },
        onError: (errors) => {
            showFormErrors(errors)
            if (errors.password) {
                passwordForm.reset('password', 'password_confirmation')
                newPasswordInput.value?.$el?.querySelector('input')?.focus()
            }
            if (errors.current_password) {
                passwordForm.reset('current_password')
                currentPasswordInput.value?.$el?.querySelector('input')?.focus()
            }
        },
    })
}

/* Delete account */
function confirmDeletion() {
    confirmingDeletion.value = true
    nextTick(() => deletePasswordInput.value?.$el?.querySelector('input')?.focus())
}

function deleteAccount() {
    deleteForm.delete(route('profile.destroy'), {
        preserveScroll: true,
        onSuccess: () => {
            toast.add({
                severity: 'success',
                summary: 'Account Deleted',
                detail: 'Your account has been deleted successfully.',
                life: 4000,
            })

            closeDeleteDialog()
        },

        onError: (errors) => {
            showFormErrors(errors)

            deletePasswordInput.value?.$el?.querySelector('input')?.focus()
        },

        onFinish: () => {
            deleteForm.reset()
        },
    })
}

function closeDeleteDialog() {
    confirmingDeletion.value = false
    deleteForm.clearErrors()
    deleteForm.reset()
}

</script>

<style scoped>
/* =================================
   PAGE
================================= */

.profile-page {
    max-width: 860px;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}


/* =================================
   PANELS
================================= */

.panel-card {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 1.8rem 2rem;
}

.panel-card.danger {
    border-color: rgba(225, 29, 72, .25);
}

.panel-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 1rem;
    margin-bottom: 1.6rem;
    padding-bottom: 1.4rem;
    border-bottom: 1px solid var(--border);
}

.panel-header.no-border {
    border-bottom: none;
    padding-bottom: 0;
    margin-bottom: 1.4rem;
}

.panel-title {
    font-family: var(--font-heading);
    font-size: 1.1rem;
    font-weight: var(--font-weight-semibold);
    color: var(--text);
    margin-bottom: .3rem;
}

.panel-title.danger-title {
    color: var(--danger);
}

.panel-subtitle {
    font-size: .84rem;
    color: var(--text-muted);
    line-height: 1.6;
    max-width: 520px;
}


/* =================================
   EMAIL VERIFICATION NOTICE
================================= */

.verify-notice {
    background: rgba(217, 119, 6, .1);
    border: 1px solid rgba(217, 119, 6, .25);
    border-radius: var(--radius-sm);
    padding: .9rem 1.1rem;
    margin-bottom: 1.4rem;
    font-size: .85rem;
    color: var(--text-muted);
    line-height: 1.6;
}

.verify-link {
    background: none;
    border: none;
    padding: 0;
    color: var(--primary);
    font-weight: var(--font-weight-medium);
    cursor: pointer;
    text-decoration: underline;
}

.verify-success {
    margin-top: .5rem;
    color: var(--success);
    font-weight: var(--font-weight-medium);
}


/* =================================
   PHOTO UPLOAD
================================= */

.photo-row {
    display: flex;
    align-items: center;
    gap: 1.25rem;
    margin-bottom: 1.8rem;
}

.photo-preview {
    width: 76px;
    height: 76px;
    border-radius: 50%;
    background: var(--tag-bg);
    color: var(--primary);
    border: 1px solid var(--border);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.4rem;
    font-weight: var(--font-weight-semibold);
    overflow: hidden;
    flex-shrink: 0;
}

.photo-preview img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.photo-actions {
    display: flex;
    flex-direction: column;
    gap: .4rem;
}

.file-btn {
    display: inline-flex;
    align-items: center;
    gap: .4rem;
    width: fit-content;
}

.file-btn .material-symbols-outlined {
    font-size: 17px;
}


/* =================================
   FORM FIELDS
================================= */

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.2rem;
    margin-bottom: 1.2rem;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: .5rem;
    margin-bottom: 1.2rem;
}

.form-row .form-group {
    margin-bottom: 0;
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

/* divider that visually separates the password fields from the
   profile fields within the same merged "Account" panel */
.section-divider {
    display: flex;
    align-items: center;
    gap: .5rem;
    margin: 1.8rem 0 1.4rem;
    padding-top: 1.6rem;
    border-top: 1px dashed var(--border);
    font-size: .85rem;
    font-weight: var(--font-weight-semibold);
    color: var(--text);
}

.section-divider .material-symbols-outlined {
    font-size: 18px;
    color: var(--primary);
}

:deep(.p-password-toggle-mask-icon),
:deep(.p-password-toggle-unmask-icon) {
    position: absolute;
    right: 1rem;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    color: var(--text-muted);
    transition: color var(--transition-fast), transform var(--transition-fast);
}

:deep(.p-password-toggle-mask-icon:hover),
:deep(.p-password-toggle-unmask-icon:hover) {
    color: var(--primary);
    transform: translateY(-50%) scale(1.1);
} 

.btn-outline {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 999px;
    padding: .55rem 1.2rem;
    font-family: var(--font-primary);
    font-size: .82rem;
    font-weight: var(--font-weight-medium);
    color: var(--text);
    background: transparent;
    border: 1px solid var(--border-strong);
    cursor: pointer;
    transition: border-color var(--transition-fast), background var(--transition-fast);
}

.btn-outline:hover {
    border-color: var(--primary);
    background: var(--tag-bg);
}


/* =================================
   READ-ONLY ACCOUNT STATUS
   (active, last_login_at, last_login_ip — system-managed columns,
   shown for visibility only, never editable here)
================================= */

.status-panel {
    display: flex;
    flex-wrap: wrap;
    gap: 1.5rem;
    background: var(--bg-3);
    border: 1px solid var(--border);
    border-radius: var(--radius-sm);
    padding: 1rem 1.25rem;
    margin-bottom: 1.4rem;
}

.status-item {
    display: flex;
    flex-direction: column;
    gap: .35rem;
}

.status-label {
    font-size: .7rem;
    letter-spacing: .05em;
    text-transform: uppercase;
    color: var(--text-subtle);
    font-weight: var(--font-weight-medium);
}

.status-value {
    font-size: .85rem;
    color: var(--text);
}

.status-sub {
    color: var(--text-subtle);
    font-size: .78rem;
}

.status-pill {
    display: inline-flex;
    align-items: center;
    gap: .4rem;
    width: fit-content;
    background: rgba(5, 150, 105, .12);
    color: var(--success);
    border-radius: 999px;
    padding: .25rem .7rem;
    font-size: .8rem;
    font-weight: var(--font-weight-medium);
}

.status-pill.inactive {
    background: rgba(225, 29, 72, .12);
    color: var(--danger);
}

.status-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: currentColor;
}


/* =================================
   FOOTER
================================= */

.form-footer {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 1.2rem;
    margin-top: .6rem;
    padding-top: 1.4rem;
    border-top: 1px solid var(--border);
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


/* =================================
   DELETE DIALOG
================================= */

.dialog-title {
    font-family: var(--font-heading);
    font-size: 1.05rem;
    font-weight: var(--font-weight-semibold);
    color: var(--text);
}

.dialog-text {
    font-size: .87rem;
    color: var(--text-muted);
    line-height: 1.7;
    margin-bottom: 1.2rem;
}


/* =================================
   RESPONSIVE
================================= */

@media (max-width: 640px) {

    .panel-card {
        padding: 1.4rem 1.3rem;
    }

    .form-row {
        grid-template-columns: 1fr;
    }

    .status-panel {
        flex-direction: column;
        gap: .9rem;
    }

    .panel-header {
        flex-direction: column;
        align-items: stretch;
    }

}
</style>