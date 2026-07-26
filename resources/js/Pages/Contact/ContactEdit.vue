<template>
    <AdminLayout>
        <template #title>{{ $t('adminContact.title') }}</template>

        <div class="contact-page">

            <div class="page-header">
                <p class="page-subtitle">{{ $t('adminContact.subtitle') }}</p>
            </div>

            <form class="contact-form" @submit.prevent="submitForm">

                <!-- ═══ GENERAL ═══ -->
                <section class="form-card">
                    <h3 class="section-title">{{ $t('adminContact.sections.general') }}</h3>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="email">{{ $t('adminContact.fields.email') }}</label>
                            <InputText id="email" v-model="form.email" type="email" :pt="formInputPt"
                                :invalid="!!form.errors.email" />
                            <span v-if="form.errors.email" class="field-error">{{ form.errors.email }}</span>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="whatsapp">{{ $t('adminContact.fields.whatsapp') }}</label>
                            <InputText id="whatsapp" v-model="form.whatsapp" :pt="formInputPt"
                                :invalid="!!form.errors.whatsapp" />
                            <span v-if="form.errors.whatsapp" class="field-error">{{ form.errors.whatsapp }}</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="google-maps-url">{{ $t('adminContact.fields.google_maps_url')
                            }}</label>
                        <InputText id="google-maps-url" v-model="form.google_maps_url" type="url" :pt="formInputPt"
                            :invalid="!!form.errors.google_maps_url" placeholder="https://maps.google.com/..." />
                        <span v-if="form.errors.google_maps_url" class="field-error">{{ form.errors.google_maps_url
                            }}</span>
                    </div>

                    <div class="current-row">
                        <ToggleSwitch v-model="form.available" input-id="available-contact" />
                        <label for="available-contact">{{ $t('adminContact.fields.available') }}</label>
                    </div>
                </section>

                <!-- ═══ TRANSLATED DETAILS ═══ -->
                <section class="form-card">
                    <h3 class="section-title">{{ $t('adminContact.sections.details') }}</h3>

                    <!-- all 7 languages live in one form; the tabs only
                         control which one is visible — saving always sends
                         every language's translation together -->
                    <Tabs :value="activeLang" class="lang-tabs">
                        <TabList :pt="langTabListPt">
                            <Tab v-for="lang in LANGUAGES" :key="lang.id" :value="lang.id" :pt="langTabPt"
                                @click="activeLang = lang.id">
                                {{ lang.label }}
                                <span v-if="!isLangComplete(lang.id)" class="incomplete-dot"
                                    :title="$t('adminContact.incomplete_language')"></span>
                            </Tab>
                        </TabList>

                        <TabPanels :pt="langTabPanelsPt">
                            <TabPanel v-for="lang in LANGUAGES" :key="lang.id" :value="lang.id">

                                <div class="form-group">
                                    <label class="form-label" :for="`description-${lang.id}`">
                                        {{ $t('adminContact.fields.description') }}
                                    </label>
                                    <Textarea :id="`description-${lang.id}`"
                                        v-model="form.translations[lang.id].description" :pt="textareaPt" rows="3" />
                                </div>

                                <div class="form-group">
                                    <label class="form-label" :for="`address-${lang.id}`">
                                        {{ $t('adminContact.fields.address') }}
                                    </label>
                                    <InputText :id="`address-${lang.id}`" v-model="form.translations[lang.id].address"
                                        :pt="formInputPt" />
                                </div>

                                <div class="form-row three">
                                    <div class="form-group">
                                        <label class="form-label" :for="`city-${lang.id}`">
                                            {{ $t('adminContact.fields.city') }}
                                        </label>
                                        <InputText :id="`city-${lang.id}`" v-model="form.translations[lang.id].city"
                                            :pt="formInputPt" />
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" :for="`state-${lang.id}`">
                                            {{ $t('adminContact.fields.state') }}
                                        </label>
                                        <InputText :id="`state-${lang.id}`" v-model="form.translations[lang.id].state"
                                            :pt="formInputPt" />
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" :for="`postal-code-${lang.id}`">
                                            {{ $t('adminContact.fields.postal_code') }}
                                        </label>
                                        <InputText :id="`postal-code-${lang.id}`"
                                            v-model="form.translations[lang.id].postal_code" :pt="formInputPt" />
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group">
                                        <label class="form-label" :for="`country-${lang.id}`">
                                            {{ $t('adminContact.fields.country') }}
                                        </label>
                                        <InputText :id="`country-${lang.id}`"
                                            v-model="form.translations[lang.id].country" :pt="formInputPt" />
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" :for="`working-hours-${lang.id}`">
                                            {{ $t('adminContact.fields.working_hours') }}
                                        </label>
                                        <InputText :id="`working-hours-${lang.id}`"
                                            v-model="form.translations[lang.id].working_hours" :pt="formInputPt" />
                                    </div>
                                </div>

                            </TabPanel>
                        </TabPanels>
                    </Tabs>
                </section>

                <div class="button-container">
                    <Button :pt="primaryButtonPt"
                        :label="form.processing ? $t('adminContact.saving') : $t('adminContact.save')"
                        :disabled="form.processing" @click="submitForm" />
                </div>
            </form>

        </div>

    </AdminLayout>

</template>
<script setup>
// -----------------------------
// Imports
// -----------------------------
import { ref } from 'vue'
import { useForm } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/Admin/AdminLayout.vue'
import { useI18n } from 'vue-i18n'

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

import { formInputPt } from '@/PrimeVue/PT/inputText.pt'
import { primaryButtonPt } from '@/PrimeVue/PT/button.pt'
import { textareaPt } from '@/PrimeVue/PT/textarea.pt'
import { langTabListPt, langTabPt, langTabPanelsPt } from '@/PrimeVue/PT/tab.pt'
import { useFormErrors } from '@/Composables/useFormErrors'


// -----------------------------
// Props & Emits
// -----------------------------
// contact is a singleton — there is only ever one record, so this page
// edits it directly instead of listing/creating/deleting like the other
// admin resources
const props = defineProps({
    contact: {
        type: Object,
        required: true,
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

const emptyTranslation = {
    description: '',
    address: '',
    city: '',
    state: '',
    country: '',
    postal_code: '',
    working_hours: '',
}

function buildTranslationsMap(translations) {
    const map = {}
    for (const lang of LANGUAGES) {
        const existing = translations?.find((tr) => tr.language_id === lang.id)
        map[lang.id] = existing ? { ...emptyTranslation, ...existing } : { ...emptyTranslation }
    }
    return map
}

const form = useForm({
    email: props.contact.email ?? '',
    whatsapp: props.contact.whatsapp ?? '',
    google_maps_url: props.contact.google_maps_url ?? '',
    available: props.contact.available ?? false,
    translations: buildTranslationsMap(props.contact.translations),
})

const activeLang = ref(1)


// -----------------------------
// Methods
// -----------------------------
function isLangComplete(langId) {
    const tr = form.translations[langId]
    return Boolean(tr.description && tr.address && tr.city && tr.country)
}

function submitForm() {
    form.put(route('contact.update', props.contact.id), {
        preserveScroll: true,

        onSuccess: () => {
            toast.add({
                severity: 'success',
                summary: t('adminContact.contact_updated_title'),
                detail: t('adminContact.contact_updated_message'),
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

.contact-page {
    max-width: 780px;
    margin: 0 auto;
}

.page-header {
    margin-bottom: 1.8rem;
}

.page-subtitle {
    font-size: .87rem;
    color: var(--text-muted);
}

.contact-form {
    display: flex;
    flex-direction: column;
    gap: 1.25rem;
}


/* =================================
   FORM CARD
================================= */

.form-card {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 1.75rem;
}

.section-title {
    font-family: var(--font-heading);
    font-size: .95rem;
    font-weight: var(--font-weight-semibold);
    color: var(--text);
    margin-bottom: 1.4rem;
}


/* =================================
   SHARED FIELDS
================================= */

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
}

.current-row label {
    font-size: .85rem;
    color: var(--text-muted);
    font-weight: var(--font-weight-medium);
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

.button-container {
    display: flex;
    justify-content: flex-end;
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