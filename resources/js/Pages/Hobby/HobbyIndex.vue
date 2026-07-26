<template>
    <AdminLayout>
        <template #title>{{ $t('adminHobby.title') }}</template>

        <div class="hobbies-page">

            <div class="page-header">
                <p class="page-subtitle">{{ $t('adminHobby.subtitle') }}</p>
                <Button :pt="primaryButtonPt" :label="$t('adminHobby.add_new')" @click="openCreate">
                    <span class="material-symbols-outlined">add</span>
                </Button>
            </div>

            <div v-if="sortedHobbies.length" class="hobbies-grid">
                <div v-for="hobby in sortedHobbies" :key="hobby.id" class="hobby-card">

                    <div class="hobby-card-top">
                        <div class="hobby-icon">
                            <span class="material-symbols-outlined">{{ hobby.icon }}</span>
                        </div>

                        <div class="hobby-card-actions">
                            <button type="button" class="icon-btn" :aria-label="$t('adminHobby.edit')"
                                @click="openEdit(hobby)">
                                <span class="material-symbols-outlined">edit</span>
                            </button>
                            <button type="button" class="icon-btn danger" :aria-label="$t('adminHobby.delete')"
                                @click="confirmDelete(hobby)">
                                <span class="material-symbols-outlined">delete</span>
                            </button>
                        </div>
                    </div>

                    <h3 class="hobby-name">{{ nameOf(hobby) }}</h3>

                    <p v-if="descriptionOf(hobby)" class="hobby-description">
                        {{ descriptionOf(hobby) }}
                    </p>

                    <div class="hobby-meta">
                        <span v-if="hobby.featured" class="featured-badge">
                            <span class="material-symbols-outlined">star</span>
                            {{ $t('adminHobby.featured') }}
                        </span>
                        <span class="photo-count-badge">
                            <span class="material-symbols-outlined">photo_library</span>
                            {{ hobby.images?.length ?? 0 }}
                        </span>
                        <span class="order-badge">
                            {{ $t('adminHobby.order') }} {{ hobby.order }}
                        </span>
                    </div>

                </div>
            </div>

            <div v-else class="empty-state">
                <span class="material-symbols-outlined">interests</span>
                <p>{{ $t('adminHobby.empty') }}</p>
            </div>

        </div>

        <!-- ═══ CREATE / EDIT DIALOG ═══ -->
        <Dialog v-model:visible="formDialogOpen" modal :pt="dialogPt" dismissable-mask class="hobby-dialog"
            :style="{ width: '46rem', maxWidth: '94vw' }" @hide="resetForm">
            <template #header>
                <h3 class="dialog-title">
                    {{ formMode === 'create' ? $t('adminHobby.add_new') : $t('adminHobby.edit_title') }}
                </h3>
            </template>

            <form @submit.prevent="submitForm">

                <div class="form-row three">
                    <div class="form-group">
                        <label class="form-label" for="icon">{{ $t('adminHobby.fields.icon') }}</label>
                        <div class="icon-input-row">
                            <span class="material-symbols-outlined">{{ form.icon }}</span>
                            <InputText id="icon" v-model="form.icon" :pt="formInputPt" placeholder="pi pi-camera"
                                :invalid="!!form.errors.icon" />
                        </div>
                        <span v-if="form.errors.icon" class="field-error">{{ form.errors.icon }}</span>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="slug">{{ $t('adminHobby.fields.slug') }}</label>
                        <InputText id="slug" v-model="form.slug" :pt="formInputPt" :invalid="!!form.errors.slug"
                            @input="slugTouched = true" />
                        <span v-if="form.errors.slug" class="field-error">{{ form.errors.slug }}</span>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="order">{{ $t('adminHobby.fields.order') }}</label>
                        <InputText id="order" v-model.number="form.order" type="number" :pt="formInputPt"
                            :invalid="!!form.errors.order" />
                        <span v-if="form.errors.order" class="field-error">{{ form.errors.order }}</span>
                    </div>
                </div>

                <div class="current-row">
                    <ToggleSwitch v-model="form.featured" input-id="featured-hobby" />
                    <label for="featured-hobby">{{ $t('adminHobby.fields.featured') }}</label>
                </div>

                <!-- ═══ PHOTOS ═══ -->
                <div class="form-group photos-group">
                    <label class="form-label">{{ $t('adminHobby.fields.photos') }}</label>

                    <div v-if="existingImages.length || pendingImages.length" class="photo-grid">

                        <div v-for="image in existingImages" :key="`existing-${image.id}`" class="photo-thumb">
                            <img :src="image.url" :alt="nameOf(activeHobby)" />
                            <button type="button" class="photo-remove" :aria-label="$t('adminHobby.remove_photo')"
                                @click="removeExistingImage(image.id)">
                                <span class="material-symbols-outlined">close</span>
                            </button>
                        </div>

                        <div v-for="pending in pendingImages" :key="pending.key" class="photo-thumb pending">
                            <img :src="pending.preview" :alt="pending.file.name" />
                            <span class="photo-new-badge">{{ $t('adminHobby.new') }}</span>
                            <button type="button" class="photo-remove" :aria-label="$t('adminHobby.remove_photo')"
                                @click="removePendingImage(pending.key)">
                                <span class="material-symbols-outlined">close</span>
                            </button>
                        </div>

                    </div>

                    <p v-else class="photos-empty">{{ $t('adminHobby.no_photos') }}</p>

                    <label class="btn-outline file-btn add-photos-btn">
                        <span class="material-symbols-outlined">add_photo_alternate</span>
                        {{ $t('adminHobby.add_photos') }}
                        <input type="file" accept="image/*" multiple hidden @change="onImagesChange" />
                    </label>
                    <span v-if="form.errors.images" class="field-error">{{ form.errors.images }}</span>
                </div>

                <!-- all 7 languages live in one form; the tabs only
                     control which one is visible — saving always sends
                     every language's translation together -->
                <Tabs :value="activeLang" class="lang-tabs">
                    <TabList :pt="langTabListPt">
                        <Tab v-for="lang in LANGUAGES" :key="lang.id" :value="lang.id" :pt="langTabPt"
                            @click="activeLang = lang.id">
                            {{ lang.label }}
                            <span v-if="!isLangComplete(lang.id)" class="incomplete-dot"
                                :title="$t('adminHobby.incomplete_language')"></span>
                        </Tab>
                    </TabList>

                    <TabPanels :pt="langTabPanelsPt">
                        <TabPanel v-for="lang in LANGUAGES" :key="lang.id" :value="lang.id">

                            <div class="form-group">
                                <label class="form-label" :for="`name-${lang.id}`">
                                    {{ $t('adminHobby.fields.name') }}
                                </label>
                                <InputText :id="`name-${lang.id}`" v-model="form.translations[lang.id].name"
                                    :pt="formInputPt" @input="lang.id === 1 && onEnglishNameInput()" />
                            </div>

                            <div class="form-group">
                                <label class="form-label" :for="`description-${lang.id}`">
                                    {{ $t('adminHobby.fields.description') }}
                                </label>
                                <Textarea :id="`description-${lang.id}`"
                                    v-model="form.translations[lang.id].description" :pt="textareaPt" rows="4" />
                            </div>

                        </TabPanel>
                    </TabPanels>
                </Tabs>

            </form>

            <template #footer>
                <Button class="cancel-btn" :pt="outlineButtonPt" :label="$t('adminHobby.cancel')"
                    @click="formDialogOpen = false" />
                <Button :pt="primaryButtonPt" :label="form.processing ? $t('adminHobby.saving') : $t('adminHobby.save')"
                    :disabled="form.processing" @click="submitForm" />
            </template>
        </Dialog>

        <!-- ═══ DELETE CONFIRMATION DIALOG ═══ -->
        <Dialog v-model:visible="deleteDialogOpen" modal :pt="dialogPt" dismissable-mask class="delete-dialog"
            :style="{ width: '26rem', maxWidth: '92vw' }" @hide="closeDeleteDialog">
            <template #header>
                <h3 class="dialog-title">{{ $t('adminHobby.delete_confirm_title') }}</h3>
            </template>

            <p class="dialog-text">
                {{ $t('adminHobby.delete_confirm_text', { hobby: deletingHobby ? nameOf(deletingHobby) : '' }) }}
            </p>

            <template #footer>
                <Button class="cancel-btn" :pt="outlineButtonPt" :label="$t('adminHobby.cancel')"
                    @click="closeDeleteDialog" />
                <Button :pt="dangerButtonPt"
                    :label="deleteForm.processing ? $t('adminHobby.deleting') : $t('adminHobby.delete')"
                    :disabled="deleteForm.processing" @click="deleteHobby" />
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
    hobbies: {
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

const emptyTranslation = { name: '', description: '' }

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
        slug: '',
        icon: '',
        featured: false,
        order: 0,
        translations: buildTranslationsMap(null),
        images: [],
        removed_image_ids: [],
    }
}

const form = useForm(emptyFormShape())

const formMode = ref('create') // 'create' | 'edit'
const activeHobby = ref(null)
const activeHobbyId = ref(null)
const formDialogOpen = ref(false)
const activeLang = ref(1)
const slugTouched = ref(false)

// existing photos already saved on the hobby (id + url) — removals are
// queued here and only applied server-side when the form is saved
const existingImages = ref([])
// newly picked photos not yet uploaded — { key, file, preview }
const pendingImages = ref([])
let pendingKeySeed = 0

const deleteDialogOpen = ref(false)
const deletingHobby = ref(null)
const deleteForm = useForm({})


// -----------------------------
// Computed & Watch
// -----------------------------
const sortedHobbies = computed(() =>
    [...props.hobbies].sort((a, b) => a.order - b.order)
)


// -----------------------------
// Methods
// -----------------------------

// display copy always prefers the active locale's translation and
// falls back to English (language_id 1) when it's missing
function nameOf(hobby) {
    return translationOf(hobby?.translations, 'name')
}

function descriptionOf(hobby) {
    return translationOf(hobby?.translations, 'description')
}

function isLangComplete(langId) {
    const tr = form.translations[langId]
    return Boolean(tr.name && tr.description)
}

function slugify(value) {
    return value
        .toString()
        .trim()
        .toLowerCase()
        .replace(/[^a-z0-9]+/g, '-')
        .replace(/(^-|-$)/g, '')
}

function onEnglishNameInput() {
    if (slugTouched.value) return
    form.slug = slugify(form.translations[1].name)
}

/* Create / Edit dialog */
function openCreate() {
    formMode.value = 'create'
    activeHobby.value = null
    activeHobbyId.value = null
    form.defaults(emptyFormShape())
    form.reset()
    slugTouched.value = false
    existingImages.value = []
    pendingImages.value = []
    activeLang.value = 1
    formDialogOpen.value = true
}

function openEdit(hobby) {
    formMode.value = 'edit'
    activeHobby.value = hobby
    activeHobbyId.value = hobby.id

    const shape = {
        slug: hobby.slug ?? '',
        icon: hobby.icon ?? '',
        featured: hobby.featured ?? false,
        order: hobby.order ?? 0,
        translations: buildTranslationsMap(hobby.translations),
        images: [],
        removed_image_ids: [],
    }

    form.defaults(shape)
    form.reset()

    slugTouched.value = true // editing an existing hobby — don't auto-rewrite its slug
    existingImages.value = [...(hobby.images ?? [])]
    pendingImages.value = []
    activeLang.value = 1
    formDialogOpen.value = true
}

function resetForm() {
    form.clearErrors()
    pendingImages.value.forEach((p) => URL.revokeObjectURL(p.preview))
    pendingImages.value = []
}

/* Photos */
function onImagesChange(event) {
    const files = Array.from(event.target.files ?? [])
    for (const file of files) {
        pendingImages.value.push({
            key: `new-${pendingKeySeed++}`,
            file,
            preview: URL.createObjectURL(file),
        })
    }
    form.images = pendingImages.value.map((p) => p.file)
    event.target.value = '' // allow picking the same file again later
}

function removePendingImage(key) {
    const found = pendingImages.value.find((p) => p.key === key)
    if (found) URL.revokeObjectURL(found.preview)
    pendingImages.value = pendingImages.value.filter((p) => p.key !== key)
    form.images = pendingImages.value.map((p) => p.file)
}

function removeExistingImage(imageId) {
    existingImages.value = existingImages.value.filter((img) => img.id !== imageId)
    form.removed_image_ids.push(imageId)
}

function submitForm() {
    const options = {
        forceFormData: true,
        preserveScroll: true,

        onSuccess: () => {
            formDialogOpen.value = false
            toast.add({
                severity: 'success',
                summary: t(
                    formMode.value === 'create'
                        ? 'adminHobby.hobby_added_title'
                        : 'adminHobby.hobby_updated_title'
                ),
                detail: t(
                    formMode.value === 'create'
                        ? 'adminHobby.hobby_added_message'
                        : 'adminHobby.hobby_updated_message'
                ),
                life: 4000,
            })
        },

        onError: (errors) => {
            showFormErrors(errors)
        },
    }

    if (formMode.value === 'create') {
        form.post(route('hobbies.store'), options)
    } else {
        // file upload + PUT semantics via Inertia's method-spoofing convention
        form.transform((data) => ({ ...data, _method: 'put' }))
            .post(route('hobbies.update', activeHobbyId.value), options)
    }
}

/* Delete */
function confirmDelete(hobby) {
    deletingHobby.value = hobby
    deleteDialogOpen.value = true
}

function closeDeleteDialog() {
    deleteDialogOpen.value = false
    deletingHobby.value = null
    deleteForm.clearErrors()
}

function deleteHobby() {
    if (!deletingHobby.value) return

    deleteForm.delete(route('hobbies.destroy', deletingHobby.value.id), {
        preserveScroll: true,

        onSuccess: () => {
            toast.add({
                severity: 'success',
                summary: t('adminHobby.hobby_deleted_title'),
                detail: t('adminHobby.hobby_deleted_message'),
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

.hobbies-page {
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

.hobbies-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.25rem;
}

.hobby-card {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 1.5rem;
    transition: border-color var(--transition-fast), box-shadow var(--transition-fast);
}

.hobby-card:hover {
    border-color: var(--border-strong);
}

.hobby-card-top {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    margin-bottom: 1rem;
}

.hobby-icon {
    width: 44px;
    height: 44px;
    border-radius: var(--radius-sm);
    background: var(--tag-bg);
    color: var(--primary);
    border: 1px solid var(--border);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
    flex-shrink: 0;
}

.hobby-card-actions {
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

.hobby-name {
    font-size: 1rem;
    font-weight: var(--font-weight-semibold);
    color: var(--text);
    margin-bottom: .4rem;
}

.hobby-description {
    font-size: .82rem;
    color: var(--text-muted);
    line-height: 1.55;
    margin-bottom: .9rem;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.hobby-meta {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: .5rem;
}

.featured-badge,
.photo-count-badge,
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

.photo-count-badge {
    background: var(--bg-3);
    color: var(--text-muted);
    border: 1px solid var(--border);
}

.photo-count-badge .material-symbols-outlined {
    font-size: 13px;
}

.order-badge {
    background: var(--bg-3);
    color: var(--text-muted);
    border: 1px solid var(--border);
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
   ICON FIELD
================================= */

.icon-input-row {
    display: flex;
    align-items: center;
    gap: .6rem;
}

.icon-preview {
    width: 42px;
    height: 42px;
    border-radius: var(--radius-sm);
    background: var(--tag-bg);
    color: var(--primary);
    border: 1px solid var(--border);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    flex-shrink: 0;
}

.icon-input-row :deep(.p-inputtext) {
    flex: 1;
}


/* =================================
   PHOTOS
================================= */

.photos-group {
    margin-bottom: 1.6rem;
}

.photo-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(96px, 1fr));
    gap: .7rem;
    margin-bottom: .9rem;
}

.photo-thumb {
    position: relative;
    aspect-ratio: 1;
    border-radius: var(--radius-sm);
    overflow: hidden;
    border: 1px solid var(--border);
    background: var(--bg-3);
}

.photo-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.photo-thumb.pending {
    border-color: var(--primary);
}

.photo-new-badge {
    position: absolute;
    left: 4px;
    bottom: 4px;
    background: var(--primary);
    color: var(--bg);
    font-size: .6rem;
    font-weight: var(--font-weight-semibold);
    padding: .1rem .4rem;
    border-radius: 999px;
    line-height: 1.4;
}

.photo-remove {
    position: absolute;
    top: 4px;
    right: 4px;
    width: 22px;
    height: 22px;
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

.photo-remove .material-symbols-outlined {
    font-size: 14px;
}

.photo-remove:hover {
    background: var(--danger);
}

.photos-empty {
    font-size: .82rem;
    color: var(--text-subtle);
    margin-bottom: .9rem;
}

.add-photos-btn {
    width: fit-content;
}


/* =================================
   FILE UPLOAD BUTTON (shared)
================================= */

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