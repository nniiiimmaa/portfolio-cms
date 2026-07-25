<template>
    <AdminLayout>
        <template #title>{{ $t('adminCertification.title') }}</template>

        <div class="certifications-page">

            <div class="page-header">
                <p class="page-subtitle">{{ $t('adminCertification.subtitle') }}</p>
                <Button
                    :pt="primaryButtonPt"
                    :label="$t('adminCertification.add_new')"
                    @click="openCreate"
                >
                    <span class="material-symbols-outlined">add</span>
                </Button>
            </div>

            <div v-if="sortedCertifications.length" class="certification-grid">
                <div v-for="cert in sortedCertifications" :key="cert.id" class="cert-card">

                    <div class="cert-card-top">
                        <div class="cert-image">
                            <img v-if="cert.image" :src="cert.image" :alt="titleOf(cert)" />
                            <span v-else>{{ initialsOf(titleOf(cert)) }}</span>
                        </div>

                        <div class="cert-card-actions">
                            <button
                                type="button"
                                class="icon-btn"
                                :aria-label="$t('adminCertification.edit')"
                                @click="openEdit(cert)"
                            >
                                <span class="material-symbols-outlined">edit</span>
                            </button>
                            <button
                                type="button"
                                class="icon-btn danger"
                                :aria-label="$t('adminCertification.delete')"
                                @click="confirmDelete(cert)"
                            >
                                <span class="material-symbols-outlined">delete</span>
                            </button>
                        </div>
                    </div>

                    <h3 class="cert-title">{{ titleOf(cert) }}</h3>

                    <p class="cert-issuer">
                        {{ issuerNameOf(cert) }}
                        <span v-if="issuerCountryOf(cert)" class="cert-issuer-country">— {{ issuerCountryOf(cert) }}</span>
                    </p>

                    <p class="cert-dates">
                        <span class="material-symbols-outlined">calendar_today</span>
                        {{ formatDateRange(cert) }}
                        <span v-if="isExpired(cert)" class="expired-badge">
                            <span class="expired-dot"></span>
                            {{ $t('adminCertification.expired') }}
                        </span>
                    </p>

                    <div class="meta-row">
                        <span v-if="cert.credential_id" class="credential-badge">
                            <span class="material-symbols-outlined">tag</span>
                            {{ cert.credential_id }}
                        </span>
                        <a
                            v-if="cert.credential_url"
                            :href="cert.credential_url"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="link-chip"
                        >
                            <span class="material-symbols-outlined">verified</span>
                            {{ $t('adminCertification.fields.verify') }}
                        </a>
                    </div>

                </div>
            </div>

            <div v-else class="empty-state">
                <span class="material-symbols-outlined">workspace_premium</span>
                <p>{{ $t('adminCertification.empty') }}</p>
            </div>

        </div>

        <!-- ═══ CREATE / EDIT DIALOG ═══ -->
        <Dialog
            v-model:visible="formDialogOpen"
            modal
            :pt="dialogPt"
            dismissable-mask
            class="certification-dialog"
            :style="{ width: '45rem', maxWidth: '94vw' }"
            @hide="resetForm"
        >
            <template #header>
                <h3 class="dialog-title">
                    {{ formMode === 'create' ? $t('adminCertification.add_new') : $t('adminCertification.edit_title') }}
                </h3>
            </template>

            <form @submit.prevent="submitForm">

                <div class="logo-row">
                    <div class="logo-preview">
                        <img v-if="imagePreview" :src="imagePreview" :alt="$t('adminCertification.image_alt')" />
                        <span v-else>{{ initialsOf(form.translations[1]?.title) }}</span>
                    </div>
                    <div class="logo-actions">
                        <label class="btn-outline file-btn">
                            <span class="material-symbols-outlined">upload</span>
                            {{ $t('adminCertification.upload_image') }}
                            <input type="file" accept="image/*" hidden @change="onImageChange" />
                        </label>
                        <span v-if="form.errors.image" class="field-error">{{ form.errors.image }}</span>
                    </div>
                </div>

                <div class="form-row three">
                    <div class="form-group">
                        <label class="form-label" for="issue-date">{{ $t('adminCertification.fields.issue_date') }}</label>
                        <input
                            id="issue-date"
                            v-model="form.issue_date"
                            type="date"
                            class="native-input"
                            :class="{ invalid: !!form.errors.issue_date }"
                        />
                        <span v-if="form.errors.issue_date" class="field-error">{{ form.errors.issue_date }}</span>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="expiration-date">{{ $t('adminCertification.fields.expiration_date') }}</label>
                        <input
                            id="expiration-date"
                            v-model="form.expiration_date"
                            type="date"
                            class="native-input"
                            :disabled="form.no_expiration"
                            :class="{ invalid: !!form.errors.expiration_date }"
                        />
                        <span v-if="form.errors.expiration_date" class="field-error">{{ form.errors.expiration_date }}</span>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="order">{{ $t('adminCertification.fields.order') }}</label>
                        <InputText
                            id="order"
                            v-model.number="form.order"
                            type="number"
                            :pt="formInputPt"
                            :invalid="!!form.errors.order"
                        />
                        <span v-if="form.errors.order" class="field-error">{{ form.errors.order }}</span>
                    </div>
                </div>

                <div class="current-row">
                    <ToggleSwitch v-model="form.no_expiration" input-id="no-expiration" @change="onNoExpirationToggle" />
                    <label for="no-expiration">{{ $t('adminCertification.fields.no_expiration') }}</label>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="credential-id">{{ $t('adminCertification.fields.credential_id') }}</label>
                        <InputText
                            id="credential-id"
                            v-model="form.credential_id"
                            :pt="formInputPt"
                            :invalid="!!form.errors.credential_id"
                        />
                        <span v-if="form.errors.credential_id" class="field-error">{{ form.errors.credential_id }}</span>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="credential-url">{{ $t('adminCertification.fields.credential_url') }}</label>
                        <InputText
                            id="credential-url"
                            v-model="form.credential_url"
                            :pt="formInputPt"
                            placeholder="https://..."
                            :invalid="!!form.errors.credential_url"
                        />
                        <span v-if="form.errors.credential_url" class="field-error">{{ form.errors.credential_url }}</span>
                    </div>
                </div>

                <!-- all 7 languages live in one form; the tabs only
                     control which one is visible — saving always sends
                     every language's translation together -->
                <Tabs :value="activeLang" class="lang-tabs">
                    <TabList :pt="langTabListPt">
                        <Tab
                            v-for="lang in LANGUAGES"
                            :key="lang.id"
                            :value="lang.id"
                            :pt="langTabPt"
                            @click="activeLang = lang.id"
                        >
                            {{ lang.label }}
                            <span
                                v-if="!isLangComplete(lang.id)"
                                class="incomplete-dot"
                                :title="$t('adminCertification.incomplete_language')"
                            ></span>
                        </Tab>
                    </TabList>

                    <TabPanels :pt="langTabPanelsPt">
                        <TabPanel v-for="lang in LANGUAGES" :key="lang.id" :value="lang.id">

                            <div class="form-group">
                                <label class="form-label" :for="`title-${lang.id}`">
                                    {{ $t('adminCertification.fields.cert_title') }}
                                </label>
                                <InputText
                                    :id="`title-${lang.id}`"
                                    v-model="form.translations[lang.id].title"
                                    :pt="formInputPt"
                                />
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label" :for="`issuer-name-${lang.id}`">
                                        {{ $t('adminCertification.fields.issuer_name') }}
                                    </label>
                                    <InputText
                                        :id="`issuer-name-${lang.id}`"
                                        v-model="form.translations[lang.id].issuer_name"
                                        :pt="formInputPt"
                                    />
                                </div>
                                <div class="form-group">
                                    <label class="form-label" :for="`issuer-country-${lang.id}`">
                                        {{ $t('adminCertification.fields.issuer_country') }}
                                    </label>
                                    <InputText
                                        :id="`issuer-country-${lang.id}`"
                                        v-model="form.translations[lang.id].issuer_country"
                                        :pt="formInputPt"
                                    />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" :for="`description-${lang.id}`">
                                    {{ $t('adminCertification.fields.description') }}
                                </label>
                                <Textarea
                                    :id="`description-${lang.id}`"
                                    v-model="form.translations[lang.id].description"
                                    :pt="textareaPt"
                                    rows="4"
                                />
                            </div>

                        </TabPanel>
                    </TabPanels>
                </Tabs>

            </form>

            <template #footer>
                <Button class="cacel-btn" :pt="outlineButtonPt" :label="$t('adminCertification.cancel')" @click="formDialogOpen = false" />
                <Button
                    :pt="primaryButtonPt"
                    :label="form.processing ? $t('adminCertification.saving') : $t('adminCertification.save')"
                    :disabled="form.processing"
                    @click="submitForm"
                />
            </template>
        </Dialog>

        <!-- ═══ DELETE CONFIRMATION DIALOG ═══ -->
        <Dialog
            v-model:visible="deleteDialogOpen"
            modal
            :pt="dialogPt"
            dismissable-mask
            class="delete-dialog"
            :style="{ width: '26rem', maxWidth: '92vw' }"
            @hide="closeDeleteDialog"
        >
            <template #header>
                <h3 class="dialog-title">{{ $t('adminCertification.delete_confirm_title') }}</h3>
            </template>

            <p class="dialog-text">
                {{ $t('adminCertification.delete_confirm_text', { title: titleOf(deletingCertification) }) }}
            </p>

            <template #footer>
                <Button class="cacel-btn" :pt="outlineButtonPt" :label="$t('adminCertification.cancel')" @click="closeDeleteDialog" />
                <Button
                    :pt="dangerButtonPt"
                    :label="deleteForm.processing ? $t('adminCertification.deleting') : $t('adminCertification.delete')"
                    :disabled="deleteForm.processing"
                    @click="deleteCertification"
                />
            </template>
        </Dialog>

    </AdminLayout>

</template>
<script setup>
// -----------------------------
// Imports
// -----------------------------
import { computed, ref } from 'vue'
import { useForm } from '@inertiajs/vue3'
import { useI18n } from 'vue-i18n'
import AdminLayout from '@/Layouts/Admin/AdminLayout.vue'
 
import InputText from 'primevue/inputtext'
import Textarea from 'primevue/textarea'
import Button from 'primevue/button'
import ToggleSwitch from 'primevue/toggleswitch'
import Dialog from 'primevue/dialog'
import Tabs from 'primevue/tabs'
import TabList from 'primevue/tablist'
import Tab from 'primevue/tab'
import TabPanels from 'primevue/tabpanels'
import TabPanel from 'primevue/tabpanel'
import { useToast } from 'primevue/usetoast'
 
import { formInputPt } from '@/PrimeVue/PT/inputText.pt'
import { primaryButtonPt, outlineButtonPt, dangerButtonPt } from '@/PrimeVue/PT/button.pt'
import { textareaPt } from '@/PrimeVue/PT/textarea.pt'
import { langTabListPt, langTabPt, langTabPanelsPt } from '@/PrimeVue/PT/tab.pt'
import { dialogPt } from '@/PrimeVue/PT/dialog.pt'
import { useFormErrors } from '@/Composables/useFormErrors'
 
 
// -----------------------------
// Props & Emits
// -----------------------------
const props = defineProps({
    certifications: {
        type: Array,
        default: () => [],
    },
})
 
 
// -----------------------------
// Stores & Composables
// -----------------------------
const toast = useToast()
const { showFormErrors } = useFormErrors()
const { locale, t } = useI18n()
 
 
// -----------------------------
// Refs & Reactives & Vars
// -----------------------------
 
// same seeded language table used across the public site / About page
const LANGUAGES = [
    { id: 1, code: 'en', label: 'English' },
    { id: 2, code: 'pt', label: 'Português' },
    { id: 3, code: 'es', label: 'Español' },
    { id: 4, code: 'de', label: 'Deutsch' },
    { id: 5, code: 'tr', label: 'Türkçe' },
    { id: 6, code: 'fa', label: 'فارسی' },
    { id: 7, code: 'ar', label: 'العربية' },
]
 
// maps the active i18n locale (e.g. 'pt') to the numeric language_id
// the translation rows use — falls back to English if the locale
// doesn't match any seeded language
const currentLanguageId = computed(() => {
    const match = LANGUAGES.find((lang) => lang.code === locale.value)
    return match?.id ?? 1
})
 
// display copy always prefers the active locale's translation and
// falls back to English (language_id 1) when it's missing
function translationOf(translations, key) {
    if (!translations) return ''
    const current = translations.find((tr) => tr.language_id === currentLanguageId.value)
    if (current?.[key]) return current[key]
    const fallback = translations.find((tr) => tr.language_id === 1)
    return fallback?.[key] ?? ''
}
 
const emptyTranslation = { title: '', issuer_name: '', issuer_country: '', description: '' }
 
function buildTranslationsMap(translations) {
    const map = {}
    for (const lang of LANGUAGES) {
        const existing = translations?.find((tr) => tr.language_id === lang.id)
        map[lang.id] = existing ? { ...emptyTranslation, ...existing } : { ...emptyTranslation }
    }
    return map
}
 
function emptyFormShape() {
    return {
        image: null,
        issue_date: '',
        expiration_date: '',
        no_expiration: false,
        credential_id: '',
        credential_url: '',
        order: 0,
        translations: buildTranslationsMap(null),
    }
}
 
const form = useForm(emptyFormShape())
 
const formMode = ref('create') // 'create' | 'edit'
const activeCertificationId = ref(null)
const formDialogOpen = ref(false)
const activeLang = ref(1)
const imagePreview = ref(null)
 
const deleteDialogOpen = ref(false)
const deletingCertification = ref(null)
const deleteForm = useForm({})
 
 
// -----------------------------
// Computed & Watch
// -----------------------------
const sortedCertifications = computed(() =>
    [...props.certifications].sort((a, b) => a.order - b.order)
)
 
 
// -----------------------------
// Methods
// -----------------------------
function initialsOf(name) {
    if (!name) return ''
    return name.split(' ').map((w) => w[0]).slice(0, 2).join('').toUpperCase()
}
 
// display copy always prefers the active locale's translation and
// falls back to English (language_id 1) when it's missing
function titleOf(cert) {
    return translationOf(cert?.translations, 'title')
}
 
function issuerNameOf(cert) {
    return translationOf(cert?.translations, 'issuer_name')
}
 
function issuerCountryOf(cert) {
    return translationOf(cert?.translations, 'issuer_country')
}
 
function formatDateRange(cert) {
    const issued = cert.issue_date ? new Date(cert.issue_date).toLocaleDateString(undefined, { month: 'short', year: 'numeric' }) : ''
    const expires = cert.expiration_date
        ? new Date(cert.expiration_date).toLocaleDateString(undefined, { month: 'short', year: 'numeric' })
        : t('adminCertification.fields.no_expiration')
    return `${issued} — ${expires}`
}
 
function isExpired(cert) {
    if (!cert.expiration_date) return false
    return new Date(cert.expiration_date) < new Date()
}
 
function isLangComplete(langId) {
    const tr = form.translations[langId]
    return Boolean(tr.title && tr.issuer_name)
}
 
/* Create / Edit dialog */
function openCreate() {
    formMode.value = 'create'
    activeCertificationId.value = null
    form.defaults(emptyFormShape())
    form.reset()
    imagePreview.value = null
    activeLang.value = 1
    formDialogOpen.value = true
}
 
function openEdit(cert) {
    formMode.value = 'edit'
    activeCertificationId.value = cert.id
 
    const shape = {
        image: null,
        issue_date: cert.issue_date ? cert.issue_date.slice(0, 10) : '',
        expiration_date: cert.expiration_date ? cert.expiration_date.slice(0, 10) : '',
        no_expiration: !cert.expiration_date,
        credential_id: cert.credential_id ?? '',
        credential_url: cert.credential_url ?? '',
        order: cert.order ?? 0,
        translations: buildTranslationsMap(cert.translations),
    }
 
    form.defaults(shape)
    form.reset()
 
    imagePreview.value = cert.image ?? null
    activeLang.value = 1
    formDialogOpen.value = true
}
 
function resetForm() {
    form.clearErrors()
}
 
function onNoExpirationToggle() {
    if (form.no_expiration) form.expiration_date = ''
}
 
function onImageChange(event) {
    const file = event.target.files?.[0]
    if (!file) return
    form.image = file
    imagePreview.value = URL.createObjectURL(file)
}
 
function submitForm() {
    const options = {
        forceFormData: true,
        preserveScroll: true,
 
        onSuccess: () => {
            formDialogOpen.value = false
            toast.add({
                severity: 'success',
                summary: formMode.value === 'create' ? 'Certification Added' : 'Certification Updated',
                detail: formMode.value === 'create'
                    ? 'The new certification has been created successfully.'
                    : 'The certification has been updated successfully.',
                life: 4000,
            })
        },
 
        onError: (errors) => {
            showFormErrors(errors)
        },
    }
 
    if (formMode.value === 'create') {
        // NOTE: adjust the route name to match your actual backend endpoint
        form.post(route('certifications.store'), options)
    } else {
        // file upload + PUT semantics via Inertia's method-spoofing convention
        form.transform((data) => ({ ...data, _method: 'put' }))
            .post(route('certifications.update', activeCertificationId.value), options)
    }
}
 
/* Delete */
function confirmDelete(cert) {
    deletingCertification.value = cert
    deleteDialogOpen.value = true
}
 
function closeDeleteDialog() {
    deleteDialogOpen.value = false
    deletingCertification.value = null
    deleteForm.clearErrors()
}
 
function deleteCertification() {
    if (!deletingCertification.value) return
 
    // NOTE: adjust the route name to match your actual backend endpoint
    deleteForm.delete(route('certifications.destroy', deletingCertification.value.id), {
        preserveScroll: true,
 
        onSuccess: () => {
            toast.add({
                severity: 'success',
                summary: 'Certification Deleted',
                detail: 'The certification has been removed successfully.',
                life: 4000,
            })
            closeDeleteDialog()
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

.certifications-page {
    max-width: 1080px;
    margin: 0 auto;
}

.page-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
    margin-bottom: 1.8rem;
}

.page-subtitle {
    font-size: .87rem;
    color: var(--text-muted);
}


/* =================================
   GRID
================================= */

.certification-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.25rem;
}

.cert-card {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 1.5rem;
    transition: border-color var(--transition-fast), box-shadow var(--transition-fast);
}

.cert-card:hover {
    border-color: var(--border-strong);
}

.cert-card-top {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    margin-bottom: 1rem;
}

.cert-image {
    width: 44px;
    height: 44px;
    border-radius: var(--radius-sm);
    background: var(--tag-bg);
    color: var(--primary);
    border: 1px solid var(--border);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: .8rem;
    font-weight: var(--font-weight-semibold);
    overflow: hidden;
    flex-shrink: 0;
}

.cert-image img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.cert-card-actions {
    display: flex;
    gap: .4rem;
}

.icon-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    border-radius: var(--radius-sm);
    border: 1px solid var(--border);
    background: var(--bg-3);
    color: var(--text-muted);
    cursor: pointer;
    transition: color var(--transition-fast), border-color var(--transition-fast);
}

.icon-btn .material-symbols-outlined {
    font-size: 17px;
}

.icon-btn:hover {
    color: var(--primary);
    border-color: var(--primary);
}

.icon-btn.danger:hover {
    color: var(--danger);
    border-color: var(--danger);
}

.cert-title {
    font-size: 1rem;
    font-weight: var(--font-weight-semibold);
    color: var(--text);
    margin-bottom: .3rem;
}

.cert-issuer {
    font-size: .85rem;
    color: var(--text-muted);
    margin-bottom: .5rem;
}

.cert-issuer-country {
    color: var(--text-subtle);
}

.cert-dates {
    display: flex;
    align-items: center;
    gap: .4rem;
    font-size: .82rem;
    color: var(--text-muted);
    margin-bottom: .4rem;
}

.cert-dates .material-symbols-outlined {
    font-size: 15px;
}

.expired-badge {
    display: inline-flex;
    align-items: center;
    gap: .35rem;
    background: var(--tag-bg);
    color: var(--danger);
    border-radius: 999px;
    padding: .15rem .6rem;
    font-size: .68rem;
    font-weight: var(--font-weight-medium);
    margin-left: .3rem;
}

.expired-dot {
    width: 5px;
    height: 5px;
    border-radius: 50%;
    background: var(--danger);
}

.meta-row {
    display: flex;
    flex-wrap: wrap;
    gap: .5rem;
    margin-top: .9rem;
}

.credential-badge {
    display: inline-flex;
    align-items: center;
    gap: .3rem;
    background: var(--tag-bg);
    color: var(--tag-text);
    border: 1px solid var(--border);
    border-radius: 999px;
    padding: .25rem .7rem;
    font-size: .72rem;
    font-weight: var(--font-weight-medium);
}

.credential-badge .material-symbols-outlined {
    font-size: 14px;
}

.link-chip {
    display: inline-flex;
    align-items: center;
    gap: .3rem;
    font-size: .78rem;
    color: var(--text-muted);
    text-decoration: none;
    border: 1px solid var(--border);
    border-radius: var(--radius-sm);
    padding: .3rem .6rem;
    transition: color var(--transition-fast), border-color var(--transition-fast);
}

.link-chip .material-symbols-outlined {
    font-size: 15px;
}

.link-chip:hover {
    color: var(--primary);
    border-color: var(--primary);
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
   DIALOG SHARED FIELDS
================================= */

.dialog-title {
    font-family: var(--font-heading);
    font-size: 1.08rem;
    font-weight: var(--font-weight-semibold);
    color: var(--text);
}

.dialog-text {
    font-size: .87rem;
    color: var(--text-muted);
    line-height: 1.7;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.2rem;
    margin-bottom: 1.2rem;
}

.form-row.three {
    grid-template-columns: 1fr 1fr 1fr;
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

/* native date input — no PrimeVue PT exists for this in the project
   yet, so it's styled directly to match InputText's PT appearance */
.native-input {
    background: var(--bg-3);
    border: 1px solid var(--border);
    border-radius: var(--radius-sm);
    padding: .65rem .8rem;
    color: var(--text);
    font-family: var(--font-primary);
    font-size: .88rem;
    width: 100%;
    transition: border-color var(--transition-fast), box-shadow var(--transition-fast);
}

.native-input:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px var(--tag-bg);
}

.native-input.invalid {
    border-color: var(--danger);
}

.native-input:disabled {
    opacity: .5;
}

.current-row {
    display: flex;
    align-items: center;
    gap: .7rem;
    margin-bottom: 1.4rem;
}

.current-row label {
    font-size: .85rem;
    color: var(--text-muted);
    font-weight: var(--font-weight-medium);
}


/* =================================
   IMAGE UPLOAD
================================= */

.logo-row {
    display: flex;
    align-items: center;
    gap: 1.25rem;
    margin-bottom: 1.6rem;
}

.logo-preview {
    width: 64px;
    height: 64px;
    border-radius: var(--radius-sm);
    background: var(--tag-bg);
    color: var(--primary);
    border: 1px solid var(--border);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
    font-weight: var(--font-weight-semibold);
    overflow: hidden;
    flex-shrink: 0;
}

.logo-preview img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.logo-actions {
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

.btn-outline {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 999px;
    padding: .5rem 1.1rem;
    font-family: var(--font-primary);
    font-size: .8rem;
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
   LANGUAGE TABS
================================= */

.lang-tabs {
    margin-top: .4rem;
}

:deep(.lang-tabs .p-tab:not(.p-disabled):hover) {
    color: var(--text);
}

:deep(.lang-tabs .p-tab-active) {
    color: var(--primary);
    border-color: var(--primary);
}

:deep(.lang-tabs .p-tablist-active-bar) {
    background: var(--primary);
}

.incomplete-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: var(--warning);
    flex-shrink: 0;
}

/* =================================
   RESPONSIVE
================================= */

@media (max-width: 640px) {

    .page-header {
        flex-direction: column;
        align-items: stretch;
    }

    .form-row,
    .form-row.three {
        grid-template-columns: 1fr;
    }

    :deep(.lang-tabs .p-tablist-tab-list) {
        overflow-x: auto;
    }

}
</style>