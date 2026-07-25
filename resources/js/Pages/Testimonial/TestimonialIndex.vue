<template>
    <AdminLayout>
        <template #title>{{ $t('adminTestimonial.title') }}</template>

        <div class="testimonials-page">

            <div class="page-header">
                <p class="page-subtitle">{{ $t('adminTestimonial.subtitle') }}</p>
                <Button
                    :pt="primaryButtonPt"
                    :label="$t('adminTestimonial.add_new')"
                    @click="openCreate"
                >
                    <span class="material-symbols-outlined">add</span>
                </Button>
            </div>

            <div v-if="sortedTestimonials.length" class="testimonials-grid">
                <div v-for="testimonial in sortedTestimonials" :key="testimonial.id" class="testimonial-card">

                    <div class="testimonial-card-top">
                        <div class="reviewer-photo">
                            <img v-if="testimonial.photo" :src="testimonial.photo" :alt="nameOf(testimonial)" />
                            <span v-else>{{ initialsOf(nameOf(testimonial)) }}</span>
                        </div>

                        <div class="testimonial-card-actions">
                            <button
                                type="button"
                                class="icon-btn"
                                :aria-label="$t('adminTestimonial.edit')"
                                @click="openEdit(testimonial)"
                            >
                                <span class="material-symbols-outlined">edit</span>
                            </button>
                            <button
                                type="button"
                                class="icon-btn danger"
                                :aria-label="$t('adminTestimonial.delete')"
                                @click="confirmDelete(testimonial)"
                            >
                                <span class="material-symbols-outlined">delete</span>
                            </button>
                        </div>
                    </div>

                    <h3 class="reviewer-name">{{ nameOf(testimonial) }}</h3>

                    <p class="reviewer-role">
                        {{ positionOf(testimonial) }}<template v-if="companyOf(testimonial)"> · {{ companyOf(testimonial) }}</template>
                    </p>

                    <div class="star-row" :aria-label="`${testimonial.rating} / 5`">
                        <span
                            v-for="n in 5"
                            :key="n"
                            class="material-symbols-outlined star"
                            :class="{ filled: n <= testimonial.rating }"
                        >star</span>
                    </div>

                    <p v-if="messageOf(testimonial)" class="reviewer-message">
                        {{ messageOf(testimonial) }}
                    </p>

                    <div class="testimonial-meta">
                        <span v-if="testimonial.featured" class="featured-badge">
                            <span class="material-symbols-outlined">star</span>
                            {{ $t('adminTestimonial.featured') }}
                        </span>
                        <span class="status-badge" :class="testimonial.approved ? 'approved' : 'pending'">
                            <span class="material-symbols-outlined">{{ testimonial.approved ? 'check_circle' : 'hourglass_empty' }}</span>
                            {{ testimonial.approved ? $t('adminTestimonial.approved') : $t('adminTestimonial.pending') }}
                        </span>
                        <span class="order-badge">
                            {{ $t('adminTestimonial.order') }} {{ testimonial.order }}
                        </span>
                    </div>

                    <div v-if="testimonial.company_logo" class="company-logo-strip">
                        <img :src="testimonial.company_logo" :alt="companyOf(testimonial)" />
                    </div>

                </div>
            </div>

            <div v-else class="empty-state">
                <span class="material-symbols-outlined">format_quote</span>
                <p>{{ $t('adminTestimonial.empty') }}</p>
            </div>

        </div>

        <!-- ═══ CREATE / EDIT DIALOG ═══ -->
        <Dialog
            v-model:visible="formDialogOpen"
            modal
            :pt="dialogPt"
            dismissable-mask
            class="testimonial-dialog"
            :style="{ width: '46rem', maxWidth: '94vw' }"
            @hide="resetForm"
        >
            <template #header>
                <h3 class="dialog-title">
                    {{ formMode === 'create' ? $t('adminTestimonial.add_new') : $t('adminTestimonial.edit_title') }}
                </h3>
            </template>

            <form @submit.prevent="submitForm">

                <div class="photos-row">

                    <div class="photo-field">
                        <span class="form-label">{{ $t('adminTestimonial.fields.photo') }}</span>
                        <div class="round-preview">
                            <img v-if="photoPreview" :src="photoPreview" :alt="$t('adminTestimonial.fields.photo')" />
                            <span v-else class="material-symbols-outlined placeholder-icon">person</span>
                            <button
                                v-if="photoPreview"
                                type="button"
                                class="preview-remove"
                                :aria-label="$t('adminTestimonial.remove_photo')"
                                @click="clearPhoto"
                            >
                                <span class="material-symbols-outlined">close</span>
                            </button>
                        </div>
                        <label class="btn-outline file-btn">
                            <span class="material-symbols-outlined">upload</span>
                            {{ $t('adminTestimonial.upload_photo') }}
                            <input type="file" accept="image/*" hidden @change="onPhotoChange" />
                        </label>
                        <span v-if="form.errors.photo" class="field-error">{{ form.errors.photo }}</span>
                    </div>

                    <div class="photo-field">
                        <span class="form-label">{{ $t('adminTestimonial.fields.company_logo') }}</span>
                        <div class="square-preview">
                            <img v-if="logoPreview" :src="logoPreview" :alt="$t('adminTestimonial.fields.company_logo')" />
                            <span v-else class="material-symbols-outlined placeholder-icon">business</span>
                            <button
                                v-if="logoPreview"
                                type="button"
                                class="preview-remove"
                                :aria-label="$t('adminTestimonial.remove_logo')"
                                @click="clearLogo"
                            >
                                <span class="material-symbols-outlined">close</span>
                            </button>
                        </div>
                        <label class="btn-outline file-btn">
                            <span class="material-symbols-outlined">upload</span>
                            {{ $t('adminTestimonial.upload_logo') }}
                            <input type="file" accept="image/*" hidden @change="onLogoChange" />
                        </label>
                        <span v-if="form.errors.company_logo" class="field-error">{{ form.errors.company_logo }}</span>
                    </div>

                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">{{ $t('adminTestimonial.fields.rating') }}</label>
                        <div class="star-picker">
                            <button
                                v-for="n in 5"
                                :key="n"
                                type="button"
                                class="star-picker-btn"
                                :aria-label="`${n} / 5`"
                                @click="form.rating = n"
                            >
                                <span
                                    class="material-symbols-outlined star"
                                    :class="{ filled: n <= form.rating }"
                                >star</span>
                            </button>
                        </div>
                        <span v-if="form.errors.rating" class="field-error">{{ form.errors.rating }}</span>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="order">{{ $t('adminTestimonial.fields.order') }}</label>
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

                <div class="toggle-row">
                    <div class="current-row">
                        <ToggleSwitch v-model="form.approved" input-id="approved-testimonial" />
                        <label for="approved-testimonial">{{ $t('adminTestimonial.fields.approved') }}</label>
                    </div>
                    <div class="current-row">
                        <ToggleSwitch v-model="form.featured" input-id="featured-testimonial" />
                        <label for="featured-testimonial">{{ $t('adminTestimonial.fields.featured') }}</label>
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
                                :title="$t('adminTestimonial.incomplete_language')"
                            ></span>
                        </Tab>
                    </TabList>

                    <TabPanels :pt="langTabPanelsPt">
                        <TabPanel v-for="lang in LANGUAGES" :key="lang.id" :value="lang.id">

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label" :for="`name-${lang.id}`">
                                        {{ $t('adminTestimonial.fields.name') }}
                                    </label>
                                    <InputText
                                        :id="`name-${lang.id}`"
                                        v-model="form.translations[lang.id].name"
                                        :pt="formInputPt"
                                    />
                                </div>
                                <div class="form-group">
                                    <label class="form-label" :for="`position-${lang.id}`">
                                        {{ $t('adminTestimonial.fields.position') }}
                                    </label>
                                    <InputText
                                        :id="`position-${lang.id}`"
                                        v-model="form.translations[lang.id].position"
                                        :pt="formInputPt"
                                    />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" :for="`company-${lang.id}`">
                                    {{ $t('adminTestimonial.fields.company') }}
                                </label>
                                <InputText
                                    :id="`company-${lang.id}`"
                                    v-model="form.translations[lang.id].company"
                                    :pt="formInputPt"
                                />
                            </div>

                            <div class="form-group">
                                <label class="form-label" :for="`message-${lang.id}`">
                                    {{ $t('adminTestimonial.fields.message') }}
                                </label>
                                <Textarea
                                    :id="`message-${lang.id}`"
                                    v-model="form.translations[lang.id].message"
                                    :pt="textareaPt"
                                    rows="4"
                                />
                            </div>

                        </TabPanel>
                    </TabPanels>
                </Tabs>

            </form>

            <template #footer>
                <Button :pt="outlineButtonPt" :label="$t('adminTestimonial.cancel')" @click="formDialogOpen = false" />
                <Button
                    :pt="primaryButtonPt"
                    :label="form.processing ? $t('adminTestimonial.saving') : $t('adminTestimonial.save')"
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
                <h3 class="dialog-title">{{ $t('adminTestimonial.delete_confirm_title') }}</h3>
            </template>

            <p class="dialog-text">
                {{ $t('adminTestimonial.delete_confirm_text', { name: deletingTestimonial ? nameOf(deletingTestimonial) : '' }) }}
            </p>

            <template #footer>
                <Button :pt="outlineButtonPt" :label="$t('adminTestimonial.cancel')" @click="closeDeleteDialog" />
                <Button
                    :pt="dangerButtonPt"
                    :label="deleteForm.processing ? $t('adminTestimonial.deleting') : $t('adminTestimonial.delete')"
                    :disabled="deleteForm.processing"
                    @click="deleteTestimonial"
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
import { Head, useForm } from '@inertiajs/vue3'
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
    testimonials: {
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

const emptyTranslation = { name: '', position: '', company: '', message: '' }

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
        photo: null,
        company_logo: null,
        remove_photo: false,
        remove_company_logo: false,
        rating: 5,
        approved: true,
        featured: false,
        order: 0,
        translations: buildTranslationsMap(null),
    }
}

const form = useForm(emptyFormShape())

const formMode = ref('create') // 'create' | 'edit'
const activeTestimonialId = ref(null)
const formDialogOpen = ref(false)
const activeLang = ref(1)
const photoPreview = ref(null)
const logoPreview = ref(null)

const deleteDialogOpen = ref(false)
const deletingTestimonial = ref(null)
const deleteForm = useForm({})


// -----------------------------
// Computed & Watch
// -----------------------------
const sortedTestimonials = computed(() =>
    [...props.testimonials].sort((a, b) => a.order - b.order)
)


// -----------------------------
// Methods
// -----------------------------

// display copy always prefers the active locale's translation and
// falls back to English (language_id 1) when it's missing
function nameOf(testimonial) {
    return translationOf(testimonial?.translations, 'name')
}

function positionOf(testimonial) {
    return translationOf(testimonial?.translations, 'position')
}

function companyOf(testimonial) {
    return translationOf(testimonial?.translations, 'company')
}

function messageOf(testimonial) {
    return translationOf(testimonial?.translations, 'message')
}

function isLangComplete(langId) {
    const tr = form.translations[langId]
    return Boolean(tr.name && tr.position && tr.message)
}

function initialsOf(name) {
    if (!name) return ''
    return name.split(' ').map((w) => w[0]).slice(0, 2).join('').toUpperCase()
}

/* Create / Edit dialog */
function openCreate() {
    formMode.value = 'create'
    activeTestimonialId.value = null
    form.defaults(emptyFormShape())
    form.reset()
    photoPreview.value = null
    logoPreview.value = null
    activeLang.value = 1
    formDialogOpen.value = true
}

function openEdit(testimonial) {
    formMode.value = 'edit'
    activeTestimonialId.value = testimonial.id

    const shape = {
        photo: null,
        company_logo: null,
        remove_photo: false,
        remove_company_logo: false,
        rating: testimonial.rating ?? 5,
        approved: testimonial.approved ?? false,
        featured: testimonial.featured ?? false,
        order: testimonial.order ?? 0,
        translations: buildTranslationsMap(testimonial.translations),
    }

    form.defaults(shape)
    form.reset()

    photoPreview.value = testimonial.photo ?? null
    logoPreview.value = testimonial.company_logo ?? null
    activeLang.value = 1
    formDialogOpen.value = true
}

function resetForm() {
    form.clearErrors()
}

/* Photo / logo uploads */
function onPhotoChange(event) {
    const file = event.target.files?.[0]
    if (!file) return
    form.photo = file
    form.remove_photo = false
    photoPreview.value = URL.createObjectURL(file)
}

function clearPhoto() {
    form.photo = null
    form.remove_photo = true
    photoPreview.value = null
}

function onLogoChange(event) {
    const file = event.target.files?.[0]
    if (!file) return
    form.company_logo = file
    form.remove_company_logo = false
    logoPreview.value = URL.createObjectURL(file)
}

function clearLogo() {
    form.company_logo = null
    form.remove_company_logo = true
    logoPreview.value = null
}

function submitForm() {
    const options = {
        forceFormData: true,
        preserveScroll: true,

        onSuccess: () => {
            formDialogOpen.value = false
            toast.add({
                severity: 'success',
                summary: formMode.value === 'create' ? 'Testimonial Added' : 'Testimonial Updated',
                detail: formMode.value === 'create'
                    ? 'The new testimonial has been created successfully.'
                    : 'The testimonial has been updated successfully.',
                life: 4000,
            })
        },

        onError: (errors) => {
            showFormErrors(errors)
        },
    }

    if (formMode.value === 'create') {
        // NOTE: adjust the route name to match your actual backend endpoint
        form.post(route('testimonials.store'), options)
    } else {
        // file upload + PUT semantics via Inertia's method-spoofing convention
        form.transform((data) => ({ ...data, _method: 'put' }))
            .post(route('testimonials.update', activeTestimonialId.value), options)
    }
}

/* Delete */
function confirmDelete(testimonial) {
    deletingTestimonial.value = testimonial
    deleteDialogOpen.value = true
}

function closeDeleteDialog() {
    deleteDialogOpen.value = false
    deletingTestimonial.value = null
    deleteForm.clearErrors()
}

function deleteTestimonial() {
    if (!deletingTestimonial.value) return

    // NOTE: adjust the route name to match your actual backend endpoint
    deleteForm.delete(route('testimonials.destroy', deletingTestimonial.value.id), {
        preserveScroll: true,

        onSuccess: () => {
            toast.add({
                severity: 'success',
                summary: 'Testimonial Deleted',
                detail: 'The testimonial has been removed successfully.',
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

.testimonials-page {
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

.testimonials-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.25rem;
}

.testimonial-card {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 1.5rem;
    transition: border-color var(--transition-fast), box-shadow var(--transition-fast);
}

.testimonial-card:hover {
    border-color: var(--border-strong);
}

.testimonial-card-top {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    margin-bottom: 1rem;
}

.reviewer-photo {
    width: 44px;
    height: 44px;
    border-radius: 50%;
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

.reviewer-photo img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.testimonial-card-actions {
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

.reviewer-name {
    font-size: 1rem;
    font-weight: var(--font-weight-semibold);
    color: var(--text);
    margin-bottom: .25rem;
}

.reviewer-role {
    font-size: .8rem;
    color: var(--text-muted);
    margin-bottom: .6rem;
}

.star-row {
    display: flex;
    gap: .1rem;
    margin-bottom: .7rem;
}

.star-row .star,
.star-picker .star {
    font-size: 17px;
    color: var(--border-strong);
}

.star-row .star.filled,
.star-picker .star.filled {
    color: var(--warning);
    font-variation-settings: 'FILL' 1;
}

.reviewer-message {
    font-size: .82rem;
    color: var(--text-muted);
    line-height: 1.55;
    margin-bottom: .9rem;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.testimonial-meta {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: .5rem;
}

.featured-badge,
.status-badge,
.order-badge {
    display: inline-flex;
    align-items: center;
    gap: .3rem;
    border-radius: 999px;
    padding: .2rem .6rem;
    font-size: .7rem;
    font-weight: var(--font-weight-medium);
}

.featured-badge {
    background: var(--tag-bg);
    color: var(--primary);
}

.featured-badge .material-symbols-outlined {
    font-size: 13px;
}

.status-badge .material-symbols-outlined {
    font-size: 13px;
}

.status-badge.approved {
    background: var(--tag-bg);
    color: var(--success);
}

.status-badge.pending {
    background: var(--bg-3);
    color: var(--text-muted);
    border: 1px solid var(--border);
}

.order-badge {
    background: var(--bg-3);
    color: var(--text-muted);
    border: 1px solid var(--border);
}

.company-logo-strip {
    display: flex;
    align-items: center;
    margin-top: 1rem;
    padding-top: 1rem;
    border-top: 1px solid var(--border);
}

.company-logo-strip img {
    max-height: 22px;
    max-width: 110px;
    object-fit: contain;
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

.toggle-row {
    display: flex;
    gap: 2rem;
    margin-bottom: 1.4rem;
}

.current-row {
    display: flex;
    align-items: center;
    gap: .7rem;
}

.current-row label {
    font-size: .85rem;
    color: var(--text-muted);
    font-weight: var(--font-weight-medium);
}


/* =================================
   PHOTO / LOGO UPLOADS
================================= */

.photos-row {
    display: flex;
    gap: 2rem;
    margin-bottom: 1.6rem;
}

.photo-field {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: .6rem;
}

.round-preview,
.square-preview {
    position: relative;
    width: 72px;
    height: 72px;
    background: var(--tag-bg);
    color: var(--text-subtle);
    border: 1px solid var(--border);
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    flex-shrink: 0;
}

.round-preview {
    border-radius: 50%;
}

.square-preview {
    border-radius: var(--radius-sm);
}

.round-preview img,
.square-preview img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.square-preview img {
    object-fit: contain;
    padding: 6px;
}

.placeholder-icon {
    font-size: 26px;
}

.preview-remove {
    position: absolute;
    top: 2px;
    right: 2px;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    border: none;
    background: rgba(0, 0, 0, .55);
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: background var(--transition-fast);
}

.preview-remove .material-symbols-outlined {
    font-size: 13px;
}

.preview-remove:hover {
    background: var(--danger);
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
   RATING PICKER
================================= */

.star-picker {
    display: flex;
    gap: .15rem;
}

.star-picker-btn {
    background: none;
    border: none;
    padding: 0;
    cursor: pointer;
    line-height: 1;
}

.star-picker .star {
    font-size: 22px;
    transition: color var(--transition-fast);
}

.star-picker-btn:hover .star {
    color: var(--warning);
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

    .form-row {
        grid-template-columns: 1fr;
    }

    .photos-row {
        gap: 1.2rem;
    }

    :deep(.lang-tabs .p-tablist-tab-list) {
        overflow-x: auto;
    }

}
</style>