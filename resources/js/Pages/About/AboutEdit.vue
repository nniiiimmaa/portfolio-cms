<template>
    <AdminLayout>
        <template #title>{{ $t('adminAbout.title') }}</template>

        <div class="about-page">

            <section class="panel-card">
                <div class="panel-header">
                    <div>
                        <h3 class="panel-title">{{ $t('adminAbout.title') }}</h3>
                        <p class="panel-subtitle">{{ $t('adminAbout.subtitle') }}</p>
                    </div>

                    <div class="availability-toggle">
                        <span class="toggle-label">{{ $t('adminAbout.available') }}</span>
                        <ToggleSwitch v-model="form.available" />
                    </div>
                </div>

                <form @submit.prevent="submit">

                    <div class="photo-row">
                        <div class="photo-preview">
                            <img v-if="photoPreview" :src="photoPreview" :alt="$t('adminAbout.photo_alt')" />
                            <span v-else>{{ initials }}</span>
                            <button v-if="photoPreview" type="button" class="photo-remove"
                                :aria-label="$t('adminAbout.remove_photo')" @click="removeImage">
                                <span class="material-symbols-outlined">close</span>
                            </button>
                        </div>
                        <div class="photo-actions">
                            <label class="btn-outline file-btn">
                                <span class="material-symbols-outlined">upload</span>
                                {{ $t('adminAbout.upload_photo') }}
                                <input type="file" accept="image/*" hidden @change="onImageChange" />
                            </label>
                            <span v-if="form.errors.image" class="field-error">{{ form.errors.image }}</span>
                        </div>
                    </div>

                    <Tabs :value="activeLang" class="lang-tabs">
                        <TabList :pt="langTabListPt">
                            <Tab v-for="lang in LANGUAGES" :key="lang.id" :value="lang.id" :pt="langTabPt"
                                @click="activeLang = lang.id">
                                {{ lang.label }}
                                <span v-if="!isLangComplete(lang.id)" class="incomplete-dot"
                                    :title="$t('adminAbout.incomplete_language')"></span>
                            </Tab>
                        </TabList>

                        <TabPanels :pt="langTabPanelsPt">
                            <TabPanel v-for="lang in LANGUAGES" :key="lang.id" :value="lang.id">

                                <div class="form-row">
                                    <div class="form-group">
                                        <label class="form-label" :for="`name-${lang.id}`">
                                            {{ $t('adminAbout.fields.name') }}
                                        </label>
                                        <InputText :id="`name-${lang.id}`" v-model="form.translations[lang.id].name"
                                            :pt="formInputPt" />
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" :for="`title-${lang.id}`">
                                            {{ $t('adminAbout.fields.title') }}
                                        </label>
                                        <InputText :id="`title-${lang.id}`" v-model="form.translations[lang.id].title"
                                            :pt="formInputPt" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label" :for="`availability-${lang.id}`">
                                        {{ $t('adminAbout.fields.availability_text') }}
                                    </label>
                                    <InputText :id="`availability-${lang.id}`"
                                        v-model="form.translations[lang.id].availability_text" :pt="formInputPt" />
                                </div>

                                <div class="form-group">
                                    <label class="form-label" :for="`description-${lang.id}`">
                                        {{ $t('adminAbout.fields.description') }}
                                    </label>
                                    <Textarea :id="`description-${lang.id}`"
                                        v-model="form.translations[lang.id].description" :pt="textareaPt" rows="5" />
                                </div>

                            </TabPanel>
                        </TabPanels>
                    </Tabs>

                    <div class="form-footer">
                        <span v-if="form.recentlySuccessful" class="success-note">
                            <span class="material-symbols-outlined">check_circle</span>
                            {{ $t('adminAbout.saved') }}
                        </span>

                        <Button type="submit" :pt="primaryButtonPt"
                            :label="form.processing ? $t('adminAbout.saving') : $t('adminAbout.save_changes')"
                            :disabled="form.processing" />
                    </div>
                </form>
            </section>

        </div>
    </AdminLayout>

</template>
<script setup>
// -----------------------------
// Imports
// -----------------------------
import { computed, ref } from 'vue'
import { Head, useForm } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/Admin/AdminLayout.vue'

import InputText from 'primevue/inputtext'
import Textarea from 'primevue/textarea'
import Button from 'primevue/button'
import ToggleSwitch from 'primevue/toggleswitch'
import Tabs from 'primevue/tabs'
import TabList from 'primevue/tablist'
import Tab from 'primevue/tab'
import TabPanels from 'primevue/tabpanels'
import TabPanel from 'primevue/tabpanel'
import { useToast } from 'primevue/usetoast'
import { useI18n } from 'vue-i18n'

import { formInputPt } from '@/PrimeVue/PT/inputText.pt'
import { primaryButtonPt } from '@/PrimeVue/PT/button.pt'
import { textareaPt } from '@/PrimeVue/PT/textarea.pt'
import { langTabListPt, langTabPt, langTabPanelsPt } from '@/PrimeVue/PT/tab.pt'
import { useFormErrors } from '@/Composables/useFormErrors'


// -----------------------------
// Props & Emits
// -----------------------------
const props = defineProps({
    about: {
        type: Object,
        default: null,
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

// same seeded language table used across the public site
const LANGUAGES = [
    { id: 1, code: 'en', label: 'English' },
    { id: 2, code: 'pt', label: 'Português' },
    { id: 3, code: 'es', label: 'Español' },
    { id: 4, code: 'de', label: 'Deutsch' },
    { id: 5, code: 'tr', label: 'Türkçe' },
    { id: 6, code: 'fa', label: 'فارسی' },
    { id: 7, code: 'ar', label: 'العربية' },
]

const emptyTranslation = { name: '', title: '', description: '', availability_text: '' }

function buildTranslationsMap(translations) {
    const map = {}
    for (const lang of LANGUAGES) {
        const existing = translations?.find((tr) => tr.language_id === lang.id)
        map[lang.id] = existing ? { ...emptyTranslation, ...existing } : { ...emptyTranslation }
    }
    return map
}

const form = useForm({
    available: props.about?.available ?? false,
    image: null,
    remove_image: false,
    translations: buildTranslationsMap(props.about?.translations),
})

const activeLang = ref(1)
const photoPreview = ref(props.about?.image ?? null)


// -----------------------------
// Computed & Watch
// -----------------------------
const initials = computed(() => {
    const name = form.translations[1]?.name ?? ''
    return name.split(' ').map((p) => p[0]).slice(0, 2).join('').toUpperCase()
})


// -----------------------------
// Methods
// -----------------------------
function isLangComplete(langId) {
    const tr = form.translations[langId]
    return Boolean(tr.name && tr.title && tr.description)
}

function onImageChange(event) {
    const file = event.target.files?.[0]
    if (!file) return
    form.image = file
    form.remove_image = false
    if (photoPreview.value?.startsWith('blob:')) URL.revokeObjectURL(photoPreview.value)
    photoPreview.value = URL.createObjectURL(file)
}

function removeImage() {
    form.image = null
    form.remove_image = true
    if (photoPreview.value?.startsWith('blob:')) URL.revokeObjectURL(photoPreview.value)
    photoPreview.value = null
}

function submit() {
    form.transform((data) => ({
        ...data,
        _method: 'put',
    })).post(route('about.update'), {
        forceFormData: true,
        preserveScroll: true,

        onSuccess: () => {
            toast.add({
                severity: 'success',
                summary: t('adminAbout.about_updated_title'),
                detail: t('adminAbout.about_updated_message'),
                life: 4000,
            })
        },

        onError: (errors) => {
            console.log(errors);
            showFormErrors(errors)
        },
    })
}
</script>
<style scoped>
/* =================================
   PAGE
================================= */

.about-page {
    max-width: 860px;
    margin: 0 auto;
}


/* =================================
   PANEL
================================= */

.panel-card {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 1.8rem 2rem;
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

.panel-title {
    font-family: var(--font-heading);
    font-size: 1.1rem;
    font-weight: var(--font-weight-semibold);
    color: var(--text);
    margin-bottom: .3rem;
}

.panel-subtitle {
    font-size: .84rem;
    color: var(--text-muted);
    line-height: 1.6;
    max-width: 520px;
}

.availability-toggle {
    display: flex;
    align-items: center;
    gap: .7rem;
}

.toggle-label {
    font-size: .82rem;
    color: var(--text-muted);
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
    position: relative;
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

.photo-remove {
    position: absolute;
    top: 0;
    right: 0;
    width: 22px;
    height: 22px;
    border-radius: 50%;
    border: none;
    background: rgba(0, 0, 0, .6);
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
   LANGUAGE TABS
================================= */

.lang-tabs {
    margin-bottom: 1.2rem;
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
   RESPONSIVE
================================= */

@media (max-width: 640px) {

    .panel-card {
        padding: 1.4rem 1.3rem;
    }

    .form-row {
        grid-template-columns: 1fr;
    }

    .panel-header {
        flex-direction: column;
        align-items: stretch;
    }

    :deep(.lang-tabs .p-tablist-tab-list) {
        overflow-x: auto;
    }

}
</style>