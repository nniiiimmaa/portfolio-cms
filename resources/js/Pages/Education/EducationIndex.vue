<template>

    <AdminLayout>
        <template #title>{{ $t('adminEducation.title') }}</template>

        <div class="education-page">

            <div class="page-header">
                <p class="page-subtitle">{{ $t('adminEducation.subtitle') }}</p>
                <Button
                    :pt="primaryButtonPt"
                    :label="$t('adminEducation.add_new')"
                    @click="openCreate"
                >
                    <span class="material-symbols-outlined">add</span>
                </Button>
            </div>

            <div v-if="sortedEducations.length" class="education-grid">
                <div v-for="edu in sortedEducations" :key="edu.id" class="edu-card">

                    <div class="edu-card-top">
                        <div class="edu-logo">
                            <img v-if="edu.logo" :src="edu.logo" :alt="institutionOf(edu)" />
                            <span v-else>{{ initialsOf(institutionOf(edu)) }}</span>
                        </div>

                        <div class="edu-card-actions">
                            <button
                                type="button"
                                class="icon-btn"
                                :aria-label="$t('adminEducation.edit')"
                                @click="openEdit(edu)"
                            >
                                <span class="material-symbols-outlined">edit</span>
                            </button>
                            <button
                                type="button"
                                class="icon-btn danger"
                                :aria-label="$t('adminEducation.delete')"
                                @click="confirmDelete(edu)"
                            >
                                <span class="material-symbols-outlined">delete</span>
                            </button>
                        </div>
                    </div>

                    <h3 class="edu-institution">{{ institutionOf(edu) }}</h3>

                    <p class="edu-degree">{{ degreeOf(edu) }}<span v-if="fieldOf(edu)"> — {{ fieldOf(edu) }}</span></p>

                    <p v-if="locationOf(edu)" class="edu-location">
                        <span class="material-symbols-outlined">location_on</span>
                        {{ locationOf(edu) }}
                    </p>

                    <p class="edu-dates">
                        <span class="material-symbols-outlined">calendar_today</span>
                        {{ formatDateRange(edu) }}
                        <span v-if="edu.current" class="current-badge">
                            <span class="current-dot"></span>
                            {{ $t('adminEducation.current') }}
                        </span>
                    </p>

                    <div class="meta-row">
                        <span v-if="edu.score" class="score-badge">
                            <span class="material-symbols-outlined">grade</span>
                            {{ edu.score }}
                        </span>
                        <a
                            v-if="edu.verification_url"
                            :href="edu.verification_url"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="link-chip"
                        >
                            <span class="material-symbols-outlined">verified</span>
                            {{ $t('adminEducation.fields.verify') }}
                        </a>
                    </div>

                </div>
            </div>

            <div v-else class="empty-state">
                <span class="material-symbols-outlined">school</span>
                <p>{{ $t('adminEducation.empty') }}</p>
            </div>

        </div>

        <!-- ═══ CREATE / EDIT DIALOG ═══ -->
        <Dialog
            v-model:visible="formDialogOpen"
            modal
            :pt="dialogPt"
            dismissable-mask
            class="education-dialog"
            :style="{ width: '45rem', maxWidth: '94vw' }"
            @hide="resetForm"
        >
            <template #header>
                <h3 class="dialog-title">
                    {{ formMode === 'create' ? $t('adminEducation.add_new') : $t('adminEducation.edit_title') }}
                </h3>
            </template>

            <form @submit.prevent="submitForm">

                <div class="logo-row">
                    <div class="logo-preview">
                        <img v-if="logoPreview" :src="logoPreview" :alt="$t('adminEducation.logo_alt')" />
                        <span v-else>{{ initialsOf(form.translations[1]?.institution) }}</span>
                    </div>
                    <div class="logo-actions">
                        <label class="btn-outline file-btn">
                            <span class="material-symbols-outlined">upload</span>
                            {{ $t('adminEducation.upload_logo') }}
                            <input type="file" accept="image/*" hidden @change="onLogoChange" />
                        </label>
                        <span v-if="form.errors.logo" class="field-error">{{ form.errors.logo }}</span>
                    </div>
                </div>

                <div class="form-row three">
                    <div class="form-group">
                        <label class="form-label" for="start-date">{{ $t('adminEducation.fields.start_date') }}</label>
                        <input
                            id="start-date"
                            v-model="form.start_date"
                            type="date"
                            class="native-input"
                            :class="{ invalid: !!form.errors.start_date }"
                        />
                        <span v-if="form.errors.start_date" class="field-error">{{ form.errors.start_date }}</span>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="end-date">{{ $t('adminEducation.fields.end_date') }}</label>
                        <input
                            id="end-date"
                            v-model="form.end_date"
                            type="date"
                            class="native-input"
                            :disabled="form.current"
                            :class="{ invalid: !!form.errors.end_date }"
                        />
                        <span v-if="form.errors.end_date" class="field-error">{{ form.errors.end_date }}</span>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="order">{{ $t('adminEducation.fields.order') }}</label>
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
                    <ToggleSwitch v-model="form.current" input-id="current-education" @change="onCurrentToggle" />
                    <label for="current-education">{{ $t('adminEducation.fields.current') }}</label>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="score">{{ $t('adminEducation.fields.score') }}</label>
                        <InputText
                            id="score"
                            v-model="form.score"
                            :pt="formInputPt"
                            placeholder="e.g. 8.27 or 3.9 GPA"
                            :invalid="!!form.errors.score"
                        />
                        <span v-if="form.errors.score" class="field-error">{{ form.errors.score }}</span>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="verification-url">{{ $t('adminEducation.fields.verify_url') }}</label>
                        <InputText
                            id="verification-url"
                            v-model="form.verification_url"
                            :pt="formInputPt"
                            placeholder="https://..."
                            :invalid="!!form.errors.verification_url"
                        />
                        <span v-if="form.errors.verification_url" class="field-error">{{ form.errors.verification_url }}</span>
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
                                :title="$t('adminEducation.incomplete_language')"
                            ></span>
                        </Tab>
                    </TabList>

                    <TabPanels :pt="langTabPanelsPt">
                        <TabPanel v-for="lang in LANGUAGES" :key="lang.id" :value="lang.id">

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label" :for="`institution-${lang.id}`">
                                        {{ $t('adminEducation.fields.institution') }}
                                    </label>
                                    <InputText
                                        :id="`institution-${lang.id}`"
                                        v-model="form.translations[lang.id].institution"
                                        :pt="formInputPt"
                                    />
                                </div>
                                <div class="form-group">
                                    <label class="form-label" :for="`location-${lang.id}`">
                                        {{ $t('adminEducation.fields.location') }}
                                    </label>
                                    <InputText
                                        :id="`location-${lang.id}`"
                                        v-model="form.translations[lang.id].location"
                                        :pt="formInputPt"
                                    />
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label" :for="`degree-${lang.id}`">
                                        {{ $t('adminEducation.fields.degree') }}
                                    </label>
                                    <InputText
                                        :id="`degree-${lang.id}`"
                                        v-model="form.translations[lang.id].degree"
                                        :pt="formInputPt"
                                    />
                                </div>
                                <div class="form-group">
                                    <label class="form-label" :for="`field-${lang.id}`">
                                        {{ $t('adminEducation.fields.field') }}
                                    </label>
                                    <InputText
                                        :id="`field-${lang.id}`"
                                        v-model="form.translations[lang.id].field"
                                        :pt="formInputPt"
                                    />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" :for="`description-${lang.id}`">
                                    {{ $t('adminEducation.fields.description') }}
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
                <Button class="cancel-btn" :pt="outlineButtonPt" :label="$t('adminEducation.cancel')" @click="formDialogOpen = false" />
                <Button
                    :pt="primaryButtonPt"
                    :label="form.processing ? $t('adminEducation.saving') : $t('adminEducation.save')"
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
                <h3 class="dialog-title">{{ $t('adminEducation.delete_confirm_title') }}</h3>
            </template>

            <p class="dialog-text">
                {{ $t('adminEducation.delete_confirm_text', { institution: institutionOf(deletingEducation) }) }}
            </p>

            <template #footer>
                <Button class="cancel-btn" :pt="outlineButtonPt" :label="$t('adminEducation.cancel')" @click="closeDeleteDialog" />
                <Button
                    :pt="dangerButtonPt"
                    :label="deleteForm.processing ? $t('adminEducation.deleting') : $t('adminEducation.delete')"
                    :disabled="deleteForm.processing"
                    @click="deleteEducation"
                />
            </template>
        </Dialog>

    </AdminLayout>

</template>
<script setup>
// -----------------------------
// Imports
// -----------------------------
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
import { primaryButtonPt, dangerButtonPt, outlineButtonPt } from '@/PrimeVue/PT/button.pt'
import { textareaPt } from '@/PrimeVue/PT/textarea.pt'
import { langTabListPt, langTabPt, langTabPanelsPt } from '@/PrimeVue/PT/tab.pt'
import { dialogPt } from '@/PrimeVue/PT/dialog.pt'
import { useFormErrors } from '@/Composables/useFormErrors'
 
 
// -----------------------------
// Props & Emits
// -----------------------------
const props = defineProps({
    educations: {
        type: Array,
        default: () => [],
    },
})
 
 
// -----------------------------
// Stores & Composables
// -----------------------------
const toast = useToast()
const { showFormErrors } = useFormErrors()
const { locale } = useI18n()
 
 
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
 
const emptyTranslation = { institution: '', degree: '', field: '', location: '', description: '' }
 
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
        logo: null,
        start_date: '',
        end_date: '',
        current: false,
        score: '',
        verification_url: '',
        order: 0,
        translations: buildTranslationsMap(null),
    }
}
 
const form = useForm(emptyFormShape())
 
const formMode = ref('create') // 'create' | 'edit'
const activeEducationId = ref(null)
const formDialogOpen = ref(false)
const activeLang = ref(1)
const logoPreview = ref(null)
 
const deleteDialogOpen = ref(false)
const deletingEducation = ref(null)
const deleteForm = useForm({})
 
 
// -----------------------------
// Computed & Watch
// -----------------------------
const sortedEducations = computed(() =>
    [...props.educations].sort((a, b) => a.order - b.order)
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
function institutionOf(edu) {
    return translationOf(edu?.translations, 'institution')
}
 
function degreeOf(edu) {
    return translationOf(edu?.translations, 'degree')
}
 
function fieldOf(edu) {
    return translationOf(edu?.translations, 'field')
}
 
function locationOf(edu) {
    return translationOf(edu?.translations, 'location')
}
 
function formatDateRange(edu) {
    const start = edu.start_date ? new Date(edu.start_date).toLocaleDateString(undefined, { month: 'short', year: 'numeric' }) : ''
    const end = edu.current
        ? 'Present'
        : edu.end_date
            ? new Date(edu.end_date).toLocaleDateString(undefined, { month: 'short', year: 'numeric' })
            : ''
    return `${start} — ${end}`
}
 
function isLangComplete(langId) {
    const tr = form.translations[langId]
    return Boolean(tr.institution && tr.degree)
}
 
/* Create / Edit dialog */
function openCreate() {
    formMode.value = 'create'
    activeEducationId.value = null
    form.defaults(emptyFormShape())
    form.reset()
    logoPreview.value = null
    activeLang.value = 1
    formDialogOpen.value = true
}
 
function openEdit(edu) {
    formMode.value = 'edit'
    activeEducationId.value = edu.id
 
    const shape = {
        logo: null,
        start_date: edu.start_date ? edu.start_date.slice(0, 10) : '',
        end_date: edu.end_date ? edu.end_date.slice(0, 10) : '',
        current: edu.current ?? false,
        score: edu.score ?? '',
        verification_url: edu.verification_url ?? '',
        order: edu.order ?? 0,
        translations: buildTranslationsMap(edu.translations),
    }
 
    form.defaults(shape)
    form.reset()
 
    logoPreview.value = edu.logo ?? null
    activeLang.value = 1
    formDialogOpen.value = true
}
 
function resetForm() {
    form.clearErrors()
}
 
function onCurrentToggle() {
    if (form.current) form.end_date = ''
}
 
function onLogoChange(event) {
    const file = event.target.files?.[0]
    if (!file) return
    form.logo = file
    logoPreview.value = URL.createObjectURL(file)
}
 
function submitForm() {
    const options = {
        forceFormData: true,
        preserveScroll: true,
 
        onSuccess: () => {
            formDialogOpen.value = false
            toast.add({
                severity: 'success',
                summary: formMode.value === 'create' ? 'Education Added' : 'Education Updated',
                detail: formMode.value === 'create'
                    ? 'The new education entry has been created successfully.'
                    : 'The education entry has been updated successfully.',
                life: 4000,
            })
        },
 
        onError: (errors) => {
            showFormErrors(errors)
        },
    }
 
    if (formMode.value === 'create') {
        // NOTE: adjust the route name to match your actual backend endpoint
        form.post(route('education.store'), options)
    } else {
        // file upload + PUT semantics via Inertia's method-spoofing convention
        form.transform((data) => ({ ...data, _method: 'put' }))
            .post(route('education.update', activeEducationId.value), options)
    }
}
 
/* Delete */
function confirmDelete(edu) {
    deletingEducation.value = edu
    deleteDialogOpen.value = true
}
 
function closeDeleteDialog() {
    deleteDialogOpen.value = false
    deletingEducation.value = null
    deleteForm.clearErrors()
}
 
function deleteEducation() {
    if (!deletingEducation.value) return
 
    // NOTE: adjust the route name to match your actual backend endpoint
    deleteForm.delete(route('education.destroy', deletingEducation.value.id), {
        preserveScroll: true,
 
        onSuccess: () => {
            toast.add({
                severity: 'success',
                summary: 'Education Deleted',
                detail: 'The education entry has been removed successfully.',
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

.education-page {
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

.education-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.25rem;
}

.edu-card {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 1.5rem;
    transition: border-color var(--transition-fast), box-shadow var(--transition-fast);
}

.edu-card:hover {
    border-color: var(--border-strong);
}

.edu-card-top {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    margin-bottom: 1rem;
}

.edu-logo {
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

.edu-logo img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.edu-card-actions {
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

.edu-institution {
    font-size: 1rem;
    font-weight: var(--font-weight-semibold);
    color: var(--text);
    margin-bottom: .3rem;
}

.edu-degree {
    font-size: .85rem;
    color: var(--text-muted);
    margin-bottom: .5rem;
}

.edu-location,
.edu-dates {
    display: flex;
    align-items: center;
    gap: .4rem;
    font-size: .82rem;
    color: var(--text-muted);
    margin-bottom: .4rem;
}

.edu-location .material-symbols-outlined,
.edu-dates .material-symbols-outlined {
    font-size: 15px;
}

.current-badge {
    display: inline-flex;
    align-items: center;
    gap: .35rem;
    background: var(--tag-bg);
    color: var(--primary);
    border-radius: 999px;
    padding: .15rem .6rem;
    font-size: .68rem;
    font-weight: var(--font-weight-medium);
    margin-left: .3rem;
}

.current-dot {
    width: 5px;
    height: 5px;
    border-radius: 50%;
    background: var(--success);
}

.meta-row {
    display: flex;
    flex-wrap: wrap;
    gap: .5rem;
    margin-top: .9rem;
}

.score-badge {
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

.score-badge .material-symbols-outlined {
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
   LOGO UPLOAD
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

.cancel-btn {
    max-width: 100px;
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