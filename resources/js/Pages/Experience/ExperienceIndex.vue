<template>

    <AdminLayout>
        <template #title>{{ $t('adminExperience.title') }}</template>

        <div class="experience-page">

            <div class="page-header">
                <p class="page-subtitle">{{ $t('adminExperience.subtitle') }}</p>
                <Button
                    :pt="primaryButtonPt"
                    :label="$t('adminExperience.add_new')"
                    @click="openCreate"
                >
                    <span class="material-symbols-outlined">add</span>
                </Button>
            </div>

            <div v-if="sortedExperiences.length" class="experience-grid">
                <div v-for="exp in sortedExperiences" :key="exp.id" class="exp-card">

                    <div class="exp-card-top">
                        <div class="exp-logo">
                            <img v-if="exp.logo" :src="exp.logo" :alt="exp.company" />
                            <span v-else>{{ initialsOf(exp.company) }}</span>
                        </div>

                        <div class="exp-card-actions">
                            <button
                                type="button"
                                class="icon-btn"
                                :aria-label="$t('adminExperience.edit')"
                                @click="openEdit(exp)"
                            >
                                <span class="material-symbols-outlined">edit</span>
                            </button>
                            <button
                                type="button"
                                class="icon-btn danger"
                                :aria-label="$t('adminExperience.delete')"
                                @click="confirmDelete(exp)"
                            >
                                <span class="material-symbols-outlined">delete</span>
                            </button>
                        </div>
                    </div>

                    <h3 class="exp-company">{{ exp.company }}</h3>

                    <p class="exp-location">
                        <span class="material-symbols-outlined">location_on</span>
                        {{ exp.location }}
                    </p>

                    <p class="exp-dates">
                        <span class="material-symbols-outlined">calendar_today</span>
                        {{ formatDateRange(exp) }}
                        <span v-if="exp.current" class="current-badge">
                            <span class="current-dot"></span>
                            {{ $t('adminExperience.current') }}
                        </span>
                    </p>

                    <div v-if="exp.technologies?.length" class="tech-tags">
                        <span v-for="tech in exp.technologies" :key="tech" class="tech-tag">{{ tech }}</span>
                    </div>

                </div>
            </div>

            <div v-else class="empty-state">
                <span class="material-symbols-outlined">work_history</span>
                <p>{{ $t('adminExperience.empty') }}</p>
            </div>

        </div>

        <!-- ═══ CREATE / EDIT DIALOG ═══ -->
        <Dialog
            v-model:visible="formDialogOpen"
            modal
            :pt="dialogPt"
            dismissable-mask
            class="experience-dialog"
            :style="{ width: '44rem', maxWidth: '94vw' }"
            @hide="resetForm"
        >
            <template #header>
                <h3 class="dialog-title">
                    {{ formMode === 'create' ? $t('adminExperience.add_new') : $t('adminExperience.edit_title') }}
                </h3>
            </template>

            <form @submit.prevent="submitForm">

                <div class="logo-row">
                    <div class="logo-preview">
                        <img v-if="logoPreview" :src="logoPreview" :alt="$t('adminExperience.logo_alt')" />
                        <span v-else>{{ initialsOf(form.company) }}</span>
                    </div>
                    <div class="logo-actions">
                        <label class="btn-outline file-btn">
                            <span class="material-symbols-outlined">upload</span>
                            {{ $t('adminExperience.upload_logo') }}
                            <input type="file" accept="image/*" hidden @change="onLogoChange" />
                        </label>
                        <span v-if="form.errors.logo" class="field-error">{{ form.errors.logo }}</span>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="company">{{ $t('adminExperience.fields.company') }}</label>
                        <InputText
                            id="company"
                            v-model="form.company"
                            :pt="formInputPt"
                            :invalid="!!form.errors.company"
                        />
                        <span v-if="form.errors.company" class="field-error">{{ form.errors.company }}</span>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="location">{{ $t('adminExperience.fields.location') }}</label>
                        <InputText
                            id="location"
                            v-model="form.location"
                            :pt="formInputPt"
                            :invalid="!!form.errors.location"
                        />
                        <span v-if="form.errors.location" class="field-error">{{ form.errors.location }}</span>
                    </div>
                </div>

                <div class="form-row three">
                    <div class="form-group">
                        <label class="form-label" for="start-date">{{ $t('adminExperience.fields.start_date') }}</label>
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
                        <label class="form-label" for="end-date">{{ $t('adminExperience.fields.end_date') }}</label>
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
                        <label class="form-label" for="order">{{ $t('adminExperience.fields.order') }}</label>
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
                    <ToggleSwitch v-model="form.current" input-id="current-role" @change="onCurrentToggle" />
                    <label for="current-role">{{ $t('adminExperience.fields.current') }}</label>
                </div>

                <div class="form-group">
                    <label class="form-label">{{ $t('adminExperience.fields.technologies') }}</label>
                    <div class="tech-input-row">
                        <InputText
                            v-model="techInput"
                            :pt="formInputPt"
                            :placeholder="$t('adminExperience.tech_placeholder')"
                            @keydown.enter.prevent="addTechnology"
                        />
                        <Button
                            type="button"
                            :pt="secondaryButtonPt"
                            class="add-tech-btn"
                            :label="$t('adminExperience.add')"
                            @click="addTechnology"
                        />
                    </div>
                    <div v-if="form.technologies.length" class="tech-tags editable">
                        <span v-for="(tech, i) in form.technologies" :key="tech" class="tech-tag">
                            {{ tech }}
                            <button type="button" class="tag-remove" @click="removeTechnology(i)">
                                <span class="material-symbols-outlined">close</span>
                            </button>
                        </span>
                    </div>
                    <span v-if="form.errors.technologies" class="field-error">{{ form.errors.technologies }}</span>
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
                                :title="$t('adminExperience.incomplete_language')"
                            ></span>
                        </Tab>
                    </TabList>

                    <TabPanels :pt="langTabPanelsPt">
                        <TabPanel v-for="lang in LANGUAGES" :key="lang.id" :value="lang.id">

                            <div class="form-group">
                                <label class="form-label" :for="`position-${lang.id}`">
                                    {{ $t('adminExperience.fields.position') }}
                                </label>
                                <InputText
                                    :id="`position-${lang.id}`"
                                    v-model="form.translations[lang.id].position"
                                    :pt="formInputPt"
                                />
                            </div>

                            <div class="form-group">
                                <label class="form-label" :for="`description-${lang.id}`">
                                    {{ $t('adminExperience.fields.description') }}
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
                <Button class="cancel-btn" outlined :pt="outlineButtonPt" :label="$t('adminExperience.cancel')" @click="formDialogOpen = false" />
                <Button
                    :pt="primaryButtonPt"
                    :label="form.processing ? $t('adminExperience.saving') : $t('adminExperience.save')"
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
                <h3 class="dialog-title">{{ $t('adminExperience.delete_confirm_title') }}</h3>
            </template>

            <p class="dialog-text">
                {{ $t('adminExperience.delete_confirm_text', { company: deletingExperience?.company }) }}
            </p>

            <template #footer>
                <Button :pt="outlineButtonPt" :label="$t('adminExperience.cancel')" @click="closeDeleteDialog" />
                <Button
                    :pt="dangerButtonPt"
                    :label="deleteForm.processing ? $t('adminExperience.deleting') : $t('adminExperience.delete')"
                    :disabled="deleteForm.processing"
                    @click="deleteExperience"
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
import { primaryButtonPt, secondaryButtonPt, dangerButtonPt, outlineButtonPt } from '@/PrimeVue/PT/button.pt'
import { textareaPt } from '@/PrimeVue/PT/textarea.pt'
import { langTabListPt, langTabPt, langTabPanelsPt } from '@/PrimeVue/PT/tab.pt'
import { dialogPt } from '@/PrimeVue/PT/dialog.pt'
import { useFormErrors } from '@/Composables/useFormErrors'


// -----------------------------
// Props & Emits
// -----------------------------
const props = defineProps({
    experiences: {
        type: Array,
        default: () => [],
    },
})


// -----------------------------
// Stores & Composables
// -----------------------------
const toast = useToast()
const { showFormErrors } = useFormErrors()


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

const emptyTranslation = { position: '', description: '' }

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
        company: '',
        location: '',
        logo: null,
        start_date: '',
        end_date: '',
        current: false,
        technologies: [],
        order: 0,
        translations: buildTranslationsMap(null),
    }
}

const form = useForm(emptyFormShape())

const formMode = ref('create') // 'create' | 'edit'
const activeExperienceId = ref(null)
const formDialogOpen = ref(false)
const activeLang = ref(1)
const logoPreview = ref(null)
const techInput = ref('')

const deleteDialogOpen = ref(false)
const deletingExperience = ref(null)
const deleteForm = useForm({})


// -----------------------------
// Computed & Watch
// -----------------------------
const sortedExperiences = computed(() =>
    [...props.experiences].sort((a, b) => a.order - b.order)
)


// -----------------------------
// Methods
// -----------------------------
function initialsOf(name) {
    if (!name) return ''
    return name.split(' ').map((w) => w[0]).slice(0, 2).join('').toUpperCase()
}

function formatDateRange(exp) {
    const start = exp.start_date ? new Date(exp.start_date).toLocaleDateString(undefined, { month: 'short', year: 'numeric' }) : ''
    const end = exp.current
        ? 'Present'
        : exp.end_date
            ? new Date(exp.end_date).toLocaleDateString(undefined, { month: 'short', year: 'numeric' })
            : ''
    return `${start} — ${end}`
}

function isLangComplete(langId) {
    const tr = form.translations[langId]
    return Boolean(tr.position && tr.description)
}

/* Create / Edit dialog */
function openCreate() {
    formMode.value = 'create'
    activeExperienceId.value = null
    form.defaults(emptyFormShape())
    form.reset()
    logoPreview.value = null
    techInput.value = ''
    activeLang.value = 1
    formDialogOpen.value = true
}

function openEdit(exp) {
    formMode.value = 'edit'
    activeExperienceId.value = exp.id

    const shape = {
        company: exp.company ?? '',
        location: exp.location ?? '',
        logo: null,
        start_date: exp.start_date ? exp.start_date.slice(0, 10) : '',
        end_date: exp.end_date ? exp.end_date.slice(0, 10) : '',
        current: exp.current ?? false,
        technologies: [...(exp.technologies ?? [])],
        order: exp.order ?? 0,
        translations: buildTranslationsMap(exp.translations),
    }

    form.defaults(shape)
    form.reset()

    logoPreview.value = exp.logo ?? null
    techInput.value = ''
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

function addTechnology() {
    const value = techInput.value.trim()
    if (!value || form.technologies.includes(value)) {
        techInput.value = ''
        return
    }
    form.technologies.push(value)
    techInput.value = ''
}

function removeTechnology(index) {
    form.technologies.splice(index, 1)
}

function submitForm() {
    const options = {
        forceFormData: true,
        preserveScroll: true,

        onSuccess: () => {
            formDialogOpen.value = false
            toast.add({
                severity: 'success',
                summary: formMode.value === 'create' ? 'Experience Added' : 'Experience Updated',
                detail: formMode.value === 'create'
                    ? 'The new experience has been created successfully.'
                    : 'The experience has been updated successfully.',
                life: 4000,
            })
        },

        onError: (errors) => {
            showFormErrors(errors)
        },
    }

    if (formMode.value === 'create') {
        form.post(route('experience.store'), options)
    } else {
        // file upload + PUT semantics via Inertia's method-spoofing convention
        form.transform((data) => ({ ...data, _method: 'put' }))
            .post(route('experience.update', activeExperienceId.value), options)
    }
}

/* Delete */
function confirmDelete(exp) {
    deletingExperience.value = exp
    deleteDialogOpen.value = true
}

function closeDeleteDialog() {
    deleteDialogOpen.value = false
    deletingExperience.value = null
    deleteForm.clearErrors()
}

function deleteExperience() {
    if (!deletingExperience.value) return

    deleteForm.delete(route('experience.destroy', deletingExperience.value.id), {
        preserveScroll: true,

        onSuccess: () => {
            toast.add({
                severity: 'success',
                summary: 'Experience Deleted',
                detail: 'The experience has been removed successfully.',
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

.experience-page {
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

.experience-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.25rem;
}

.exp-card {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 1.5rem;
    transition: border-color var(--transition-fast), box-shadow var(--transition-fast);
}

.exp-card:hover {
    border-color: var(--border-strong);
}

.exp-card-top {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    margin-bottom: 1rem;
}

.exp-logo {
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

.exp-logo img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.exp-card-actions {
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

.exp-company {
    font-size: 1rem;
    font-weight: var(--font-weight-semibold);
    color: var(--text);
    margin-bottom: .4rem;
}

.exp-location,
.exp-dates {
    display: flex;
    align-items: center;
    gap: .4rem;
    font-size: .82rem;
    color: var(--text-muted);
    margin-bottom: .4rem;
}

.exp-location .material-symbols-outlined,
.exp-dates .material-symbols-outlined {
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

.tech-tags {
    display: flex;
    flex-wrap: wrap;
    gap: .45rem;
    margin-top: .9rem;
}

.tech-tag {
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

.tech-tags.editable .tech-tag {
    padding-right: .35rem;
}

.tag-remove {
    display: flex;
    align-items: center;
    justify-content: center;
    border: none;
    background: none;
    color: inherit;
    cursor: pointer;
    padding: 0;
}

.tag-remove .material-symbols-outlined {
    font-size: 13px;
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
   TECHNOLOGIES INPUT
================================= */

.tech-input-row {
    display: flex;
    gap: .6rem;
    align-items: flex-start;
}

.tech-input-row > :first-child {
    flex: 1;
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