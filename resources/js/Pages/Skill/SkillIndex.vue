<template>
    <AdminLayout>
        <template #title>{{ $t('adminSkill.title') }}</template>

        <div class="skills-page">

            <div class="page-header">
                <p class="page-subtitle">{{ $t('adminSkill.subtitle') }}</p>
                <Button
                    :pt="primaryButtonPt"
                    :label="$t('adminSkill.add_category')"
                    @click="openCreateCategory"
                >
                    <span class="material-symbols-outlined">add</span>
                </Button>
            </div>

            <div v-if="sortedCategories.length" class="category-list">
                <div v-for="cat in sortedCategories" :key="cat.id" class="category-section">

                    <div class="category-header">
                        <div class="category-heading">
                            <span class="category-icon material-symbols-outlined">{{ cat.icon || 'category' }}</span>
                            <h3 class="category-name">{{ categoryNameOf(cat) }}</h3>
                        </div>

                        <div class="category-actions">
                            <button type="button" class="btn-outline small" @click="openCreateSkill(cat.id)">
                                <span class="material-symbols-outlined">add</span>
                                {{ $t('adminSkill.add_skill') }}
                            </button>
                            <button
                                type="button"
                                class="icon-btn"
                                :aria-label="$t('adminSkill.edit_category')"
                                @click="openEditCategory(cat)"
                            >
                                <span class="material-symbols-outlined">edit</span>
                            </button>
                            <button
                                type="button"
                                class="icon-btn danger"
                                :aria-label="$t('adminSkill.delete_category')"
                                @click="confirmDeleteCategory(cat)"
                            >
                                <span class="material-symbols-outlined">delete</span>
                            </button>
                        </div>
                    </div>

                    <div v-if="sortedSkillsOf(cat).length" class="skills-grid">
                        <div v-for="skill in sortedSkillsOf(cat)" :key="skill.id" class="skill-card">

                            <div class="skill-card-top">
                                <h4 class="skill-name">
                                    {{ skillNameOf(skill) }}
                                    <span v-if="skill.featured" class="featured-badge" :title="$t('adminSkill.fields.featured')">
                                        <span class="material-symbols-outlined">star</span>
                                    </span>
                                </h4>
                                <div class="skill-card-actions">
                                    <button
                                        type="button"
                                        class="icon-btn small"
                                        :aria-label="$t('adminSkill.edit_skill')"
                                        @click="openEditSkill(skill, cat.id)"
                                    >
                                        <span class="material-symbols-outlined">edit</span>
                                    </button>
                                    <button
                                        type="button"
                                        class="icon-btn small danger"
                                        :aria-label="$t('adminSkill.delete_skill')"
                                        @click="confirmDeleteSkill(skill)"
                                    >
                                        <span class="material-symbols-outlined">delete</span>
                                    </button>
                                </div>
                            </div>

                            <div class="skill-level-row">
                                <div class="skill-level-track">
                                    <div class="skill-level-fill" :style="{ width: `${skill.level}%` }"></div>
                                </div>
                                <span class="skill-level-value">{{ skill.level }}%</span>
                            </div>

                            <p class="skill-meta">
                                <span class="material-symbols-outlined">schedule</span>
                                {{ yearsLabel(skill.years_experience) }}
                            </p>

                        </div>
                    </div>
                    <p v-else class="category-empty">{{ $t('adminSkill.category_empty') }}</p>

                </div>
            </div>

            <div v-else class="empty-state">
                <span class="material-symbols-outlined">psychology</span>
                <p>{{ $t('adminSkill.empty') }}</p>
            </div>

        </div>

        <!-- ═══ CATEGORY CREATE / EDIT DIALOG ═══ -->
        <Dialog
            v-model:visible="categoryFormDialogOpen"
            modal
            :pt="dialogPt"
            dismissable-mask
            class="category-dialog"
            :style="{ width: '38rem', maxWidth: '94vw' }"
            @hide="resetCategoryForm"
        >
            <template #header>
                <h3 class="dialog-title">
                    {{ categoryFormMode === 'create' ? $t('adminSkill.add_category') : $t('adminSkill.edit_category_title') }}
                </h3>
            </template>

            <form @submit.prevent="submitCategoryForm">

                <div class="icon-row">
                    <div class="icon-preview">
                        <span class="material-symbols-outlined">{{ categoryForm.icon || 'category' }}</span>
                    </div>
                    <div class="form-group icon-input">
                        <label class="form-label" for="category-icon">{{ $t('adminSkill.fields.icon') }}</label>
                        <InputText
                            id="category-icon"
                            v-model="categoryForm.icon"
                            :pt="formInputPt"
                            placeholder="e.g. code, server, palette"
                            :invalid="!!categoryForm.errors.icon"
                        />
                        <span v-if="categoryForm.errors.icon" class="field-error">{{ categoryForm.errors.icon }}</span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="category-order">{{ $t('adminSkill.fields.order') }}</label>
                    <InputText
                        id="category-order"
                        v-model.number="categoryForm.order"
                        type="number"
                        :pt="formInputPt"
                        :invalid="!!categoryForm.errors.order"
                    />
                    <span v-if="categoryForm.errors.order" class="field-error">{{ categoryForm.errors.order }}</span>
                </div>

                <!-- all 7 languages live in one form; the tabs only
                     control which one is visible — saving always sends
                     every language's translation together -->
                <Tabs :value="categoryActiveLang" class="lang-tabs">
                    <TabList :pt="langTabListPt">
                        <Tab
                            v-for="lang in LANGUAGES"
                            :key="lang.id"
                            :value="lang.id"
                            :pt="langTabPt"
                            @click="categoryActiveLang = lang.id"
                        >
                            {{ lang.label }}
                            <span
                                v-if="!isCategoryLangComplete(lang.id)"
                                class="incomplete-dot"
                                :title="$t('adminSkill.incomplete_language')"
                            ></span>
                        </Tab>
                    </TabList>

                    <TabPanels :pt="langTabPanelsPt">
                        <TabPanel v-for="lang in LANGUAGES" :key="lang.id" :value="lang.id">
                            <div class="form-group">
                                <label class="form-label" :for="`category-name-${lang.id}`">
                                    {{ $t('adminSkill.fields.category_name') }}
                                </label>
                                <InputText
                                    :id="`category-name-${lang.id}`"
                                    v-model="categoryForm.translations[lang.id].name"
                                    :pt="formInputPt"
                                />
                            </div>
                        </TabPanel>
                    </TabPanels>
                </Tabs>

            </form>

            <template #footer>
                <Button :pt="secondaryButtonPt" :label="$t('adminSkill.cancel')" @click="categoryFormDialogOpen = false" />
                <Button
                    :pt="primaryButtonPt"
                    :label="categoryForm.processing ? $t('adminSkill.saving') : $t('adminSkill.save')"
                    :disabled="categoryForm.processing"
                    @click="submitCategoryForm"
                />
            </template>
        </Dialog>

        <!-- ═══ SKILL CREATE / EDIT DIALOG ═══ -->
        <Dialog
            v-model:visible="skillFormDialogOpen"
            modal
            :pt="dialogPt"
            dismissable-mask
            class="skill-dialog"
            :style="{ width: '44rem', maxWidth: '94vw' }"
            @hide="resetSkillForm"
        >
            <template #header>
                <h3 class="dialog-title">
                    {{ skillFormMode === 'create' ? $t('adminSkill.add_skill') : $t('adminSkill.edit_skill_title') }}
                </h3>
            </template>

            <form @submit.prevent="submitSkillForm">

                <div class="form-group">
                    <label class="form-label" for="skill-category">{{ $t('adminSkill.fields.category') }}</label>
                    <select
                        id="skill-category"
                        v-model.number="skillForm.skill_category_id"
                        class="native-input"
                        :class="{ invalid: !!skillForm.errors.skill_category_id }"
                    >
                        <option :value="null" disabled>{{ $t('adminSkill.select_placeholder') }}</option>
                        <option v-for="cat in sortedCategories" :key="cat.id" :value="cat.id">
                            {{ categoryNameOf(cat) }}
                        </option>
                    </select>
                    <span v-if="skillForm.errors.skill_category_id" class="field-error">{{ skillForm.errors.skill_category_id }}</span>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="skill-slug">{{ $t('adminSkill.fields.slug') }}</label>
                        <InputText
                            id="skill-slug"
                            v-model="skillForm.slug"
                            :pt="formInputPt"
                            :invalid="!!skillForm.errors.slug"
                        />
                        <span v-if="skillForm.errors.slug" class="field-error">{{ skillForm.errors.slug }}</span>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="skill-icon">{{ $t('adminSkill.fields.icon') }}</label>
                        <InputText
                            id="skill-icon"
                            v-model="skillForm.icon"
                            :pt="formInputPt"
                            placeholder="e.g. javascript, database"
                            :invalid="!!skillForm.errors.icon"
                        />
                        <span v-if="skillForm.errors.icon" class="field-error">{{ skillForm.errors.icon }}</span>
                    </div>
                </div>

                <div class="form-row three">
                    <div class="form-group">
                        <label class="form-label" for="skill-level">{{ $t('adminSkill.fields.level') }}</label>
                        <InputText
                            id="skill-level"
                            v-model.number="skillForm.level"
                            type="number"
                            min="0"
                            max="100"
                            :pt="formInputPt"
                            :invalid="!!skillForm.errors.level"
                        />
                        <span v-if="skillForm.errors.level" class="field-error">{{ skillForm.errors.level }}</span>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="skill-years">{{ $t('adminSkill.fields.years_experience') }}</label>
                        <InputText
                            id="skill-years"
                            v-model.number="skillForm.years_experience"
                            type="number"
                            min="0"
                            :pt="formInputPt"
                            :invalid="!!skillForm.errors.years_experience"
                        />
                        <span v-if="skillForm.errors.years_experience" class="field-error">{{ skillForm.errors.years_experience }}</span>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="skill-order">{{ $t('adminSkill.fields.order') }}</label>
                        <InputText
                            id="skill-order"
                            v-model.number="skillForm.order"
                            type="number"
                            :pt="formInputPt"
                            :invalid="!!skillForm.errors.order"
                        />
                        <span v-if="skillForm.errors.order" class="field-error">{{ skillForm.errors.order }}</span>
                    </div>
                </div>

                <div class="current-row">
                    <ToggleSwitch v-model="skillForm.featured" input-id="featured-skill" />
                    <label for="featured-skill">{{ $t('adminSkill.fields.featured_hint') }}</label>
                </div>

                <!-- all 7 languages live in one form; the tabs only
                     control which one is visible — saving always sends
                     every language's translation together -->
                <Tabs :value="skillActiveLang" class="lang-tabs">
                    <TabList :pt="langTabListPt">
                        <Tab
                            v-for="lang in LANGUAGES"
                            :key="lang.id"
                            :value="lang.id"
                            :pt="langTabPt"
                            @click="skillActiveLang = lang.id"
                        >
                            {{ lang.label }}
                            <span
                                v-if="!isSkillLangComplete(lang.id)"
                                class="incomplete-dot"
                                :title="$t('adminSkill.incomplete_language')"
                            ></span>
                        </Tab>
                    </TabList>

                    <TabPanels :pt="langTabPanelsPt">
                        <TabPanel v-for="lang in LANGUAGES" :key="lang.id" :value="lang.id">

                            <div class="form-group">
                                <label class="form-label" :for="`skill-name-${lang.id}`">
                                    {{ $t('adminSkill.fields.skill_name') }}
                                </label>
                                <InputText
                                    :id="`skill-name-${lang.id}`"
                                    v-model="skillForm.translations[lang.id].name"
                                    :pt="formInputPt"
                                />
                            </div>

                            <div class="form-group">
                                <label class="form-label" :for="`skill-description-${lang.id}`">
                                    {{ $t('adminSkill.fields.description') }}
                                </label>
                                <Textarea
                                    :id="`skill-description-${lang.id}`"
                                    v-model="skillForm.translations[lang.id].description"
                                    :pt="textareaPt"
                                    rows="3"
                                />
                            </div>

                        </TabPanel>
                    </TabPanels>
                </Tabs>

            </form>

            <template #footer>
                <Button :pt="secondaryButtonPt" :label="$t('adminSkill.cancel')" @click="skillFormDialogOpen = false" />
                <Button
                    :pt="primaryButtonPt"
                    :label="skillForm.processing ? $t('adminSkill.saving') : $t('adminSkill.save')"
                    :disabled="skillForm.processing"
                    @click="submitSkillForm"
                />
            </template>
        </Dialog>

        <!-- ═══ DELETE CATEGORY CONFIRMATION DIALOG ═══ -->
        <Dialog
            v-model:visible="deleteCategoryDialogOpen"
            modal
            :pt="dialogPt"
            dismissable-mask
            class="delete-dialog"
            :style="{ width: '26rem', maxWidth: '92vw' }"
            @hide="closeDeleteCategoryDialog"
        >
            <template #header>
                <h3 class="dialog-title">{{ $t('adminSkill.delete_category_confirm_title') }}</h3>
            </template>

            <p class="dialog-text">
                {{ $t('adminSkill.delete_category_confirm_text', { name: categoryNameOf(deletingCategory) }) }}
            </p>

            <template #footer>
                <Button :pt="secondaryButtonPt" :label="$t('adminSkill.cancel')" @click="closeDeleteCategoryDialog" />
                <Button
                    :pt="dangerButtonPt"
                    :label="deleteCategoryForm.processing ? $t('adminSkill.deleting') : $t('adminSkill.delete')"
                    :disabled="deleteCategoryForm.processing"
                    @click="deleteCategory"
                />
            </template>
        </Dialog>

        <!-- ═══ DELETE SKILL CONFIRMATION DIALOG ═══ -->
        <Dialog
            v-model:visible="deleteSkillDialogOpen"
            modal
            :pt="dialogPt"
            dismissable-mask
            class="delete-dialog"
            :style="{ width: '26rem', maxWidth: '92vw' }"
            @hide="closeDeleteSkillDialog"
        >
            <template #header>
                <h3 class="dialog-title">{{ $t('adminSkill.delete_skill_confirm_title') }}</h3>
            </template>

            <p class="dialog-text">
                {{ $t('adminSkill.delete_skill_confirm_text', { name: skillNameOf(deletingSkill) }) }}
            </p>

            <template #footer>
                <Button :pt="secondaryButtonPt" :label="$t('adminSkill.cancel')" @click="closeDeleteSkillDialog" />
                <Button
                    :pt="dangerButtonPt"
                    :label="deleteSkillForm.processing ? $t('adminSkill.deleting') : $t('adminSkill.delete')"
                    :disabled="deleteSkillForm.processing"
                    @click="deleteSkill"
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
import { primaryButtonPt, secondaryButtonPt, dangerButtonPt } from '@/PrimeVue/PT/button.pt'
import { textareaPt } from '@/PrimeVue/PT/textarea.pt'
import { langTabListPt, langTabPt, langTabPanelsPt } from '@/PrimeVue/PT/tab.pt'
import { dialogPt } from '@/PrimeVue/PT/dialog.pt'
import { useFormErrors } from '@/Composables/useFormErrors'


// -----------------------------
// Props & Emits
// -----------------------------
const props = defineProps({
    // each category arrives with its own nested `skills` array,
    // matching the backend's eager-loaded shape
    skillCategories: {
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

// shared by both categories and skills — display copy always prefers
// the active locale's translation and falls back to English (language_id 1)
function translationOf(translations, key) {
    if (!translations) return ''
    const current = translations.find((tr) => tr.language_id === currentLanguageId.value)
    if (current?.[key]) return current[key]
    const fallback = translations.find((tr) => tr.language_id === 1)
    return fallback?.[key] ?? ''
}

/* ---------- Category form ---------- */
const emptyCategoryTranslation = { name: '' }

function buildCategoryTranslationsMap(translations) {
    const map = {}
    for (const lang of LANGUAGES) {
        const existing = translations?.find((tr) => tr.language_id === lang.id)
        map[lang.id] = existing ? { ...emptyCategoryTranslation, ...existing } : { ...emptyCategoryTranslation }
    }
    return map
}

function emptyCategoryFormShape() {
    return {
        icon: '',
        order: 0,
        translations: buildCategoryTranslationsMap(null),
    }
}

const categoryForm = useForm(emptyCategoryFormShape())
const categoryFormMode = ref('create') // 'create' | 'edit'
const activeCategoryId = ref(null)
const categoryFormDialogOpen = ref(false)
const categoryActiveLang = ref(1)

const deleteCategoryDialogOpen = ref(false)
const deletingCategory = ref(null)
const deleteCategoryForm = useForm({})

/* ---------- Skill form ---------- */
const emptySkillTranslation = { name: '', description: '' }

function buildSkillTranslationsMap(translations) {
    const map = {}
    for (const lang of LANGUAGES) {
        const existing = translations?.find((tr) => tr.language_id === lang.id)
        map[lang.id] = existing ? { ...emptySkillTranslation, ...existing } : { ...emptySkillTranslation }
    }
    return map
}

function emptySkillFormShape(categoryId = null) {
    return {
        skill_category_id: categoryId,
        slug: '',
        icon: '',
        level: 50,
        years_experience: 0,
        featured: false,
        order: 0,
        translations: buildSkillTranslationsMap(null),
    }
}

const skillForm = useForm(emptySkillFormShape())
const skillFormMode = ref('create') // 'create' | 'edit'
const activeSkillId = ref(null)
const skillFormDialogOpen = ref(false)
const skillActiveLang = ref(1)

const deleteSkillDialogOpen = ref(false)
const deletingSkill = ref(null)
const deleteSkillForm = useForm({})


// -----------------------------
// Computed & Watch
// -----------------------------
const sortedCategories = computed(() =>
    [...props.skillCategories].sort((a, b) => a.order - b.order)
)


// -----------------------------
// Methods
// -----------------------------

// display copy always prefers the active locale's translation and
// falls back to English (language_id 1), then the slug, when missing
function categoryNameOf(cat) {
    if (!cat) return ''
    return translationOf(cat.translations, 'name') || cat.slug || ''
}

function skillNameOf(skill) {
    if (!skill) return ''
    return translationOf(skill.translations, 'name') || skill.slug || ''
}

function sortedSkillsOf(cat) {
    return [...(cat.skills ?? [])].sort((a, b) => a.order - b.order)
}

function yearsLabel(years) {
    if (years === null || years === undefined) return ''
    return years === 1 ? '1 year' : `${years} years`
}

function isCategoryLangComplete(langId) {
    return Boolean(categoryForm.translations[langId].name)
}

function isSkillLangComplete(langId) {
    const tr = skillForm.translations[langId]
    return Boolean(tr.name && tr.description)
}

/* Category create / edit */
function openCreateCategory() {
    categoryFormMode.value = 'create'
    activeCategoryId.value = null
    categoryForm.defaults(emptyCategoryFormShape())
    categoryForm.reset()
    categoryActiveLang.value = 1
    categoryFormDialogOpen.value = true
}

function openEditCategory(cat) {
    categoryFormMode.value = 'edit'
    activeCategoryId.value = cat.id

    const shape = {
        icon: cat.icon ?? '',
        order: cat.order ?? 0,
        translations: buildCategoryTranslationsMap(cat.translations),
    }

    categoryForm.defaults(shape)
    categoryForm.reset()
    categoryActiveLang.value = 1
    categoryFormDialogOpen.value = true
}

function resetCategoryForm() {
    categoryForm.clearErrors()
}

function submitCategoryForm() {
    const options = {
        preserveScroll: true,

        onSuccess: () => {
            categoryFormDialogOpen.value = false
            toast.add({
                severity: 'success',
                summary: categoryFormMode.value === 'create' ? 'Category Added' : 'Category Updated',
                detail: categoryFormMode.value === 'create'
                    ? 'The new skill category has been created successfully.'
                    : 'The skill category has been updated successfully.',
                life: 4000,
            })
        },

        onError: (errors) => {
            showFormErrors(errors)
        },
    }

    if (categoryFormMode.value === 'create') {
        // NOTE: adjust the route name to match your actual backend endpoint
        categoryForm.post(route('skill-categories.store'), options)
    } else {
        categoryForm.put(route('skill-categories.update', activeCategoryId.value), options)
    }
}

/* Category delete */
function confirmDeleteCategory(cat) {
    deletingCategory.value = cat
    deleteCategoryDialogOpen.value = true
}

function closeDeleteCategoryDialog() {
    deleteCategoryDialogOpen.value = false
    deletingCategory.value = null
    deleteCategoryForm.clearErrors()
}

function deleteCategory() {
    if (!deletingCategory.value) return

    // NOTE: adjust the route name to match your actual backend endpoint
    deleteCategoryForm.delete(route('skill-categories.destroy', deletingCategory.value.id), {
        preserveScroll: true,

        onSuccess: () => {
            toast.add({
                severity: 'success',
                summary: 'Category Deleted',
                detail: 'The skill category and its skills have been removed successfully.',
                life: 4000,
            })
            closeDeleteCategoryDialog()
        },

        onError: (errors) => {
            showFormErrors(errors)
        },
    })
}

/* Skill create / edit */
function openCreateSkill(categoryId) {
    skillFormMode.value = 'create'
    activeSkillId.value = null
    skillForm.defaults(emptySkillFormShape(categoryId))
    skillForm.reset()
    skillForm.skill_category_id = categoryId
    skillActiveLang.value = 1
    skillFormDialogOpen.value = true
}

function openEditSkill(skill, categoryId) {
    skillFormMode.value = 'edit'
    activeSkillId.value = skill.id

    const shape = {
        skill_category_id: skill.skill_category_id ?? categoryId,
        slug: skill.slug ?? '',
        icon: skill.icon ?? '',
        level: skill.level ?? 0,
        years_experience: skill.years_experience ?? 0,
        featured: skill.featured ?? false,
        order: skill.order ?? 0,
        translations: buildSkillTranslationsMap(skill.translations),
    }

    skillForm.defaults(shape)
    skillForm.reset()
    skillActiveLang.value = 1
    skillFormDialogOpen.value = true
}

function resetSkillForm() {
    skillForm.clearErrors()
}

function submitSkillForm() {
    const options = {
        preserveScroll: true,

        onSuccess: () => {
            skillFormDialogOpen.value = false
            toast.add({
                severity: 'success',
                summary: skillFormMode.value === 'create' ? 'Skill Added' : 'Skill Updated',
                detail: skillFormMode.value === 'create'
                    ? 'The new skill has been created successfully.'
                    : 'The skill has been updated successfully.',
                life: 4000,
            })
        },

        onError: (errors) => {
            showFormErrors(errors)
        },
    }

    if (skillFormMode.value === 'create') {
        // NOTE: adjust the route name to match your actual backend endpoint
        skillForm.post(route('skills.store'), options)
    } else {
        skillForm.put(route('skills.update', activeSkillId.value), options)
    }
}

/* Skill delete */
function confirmDeleteSkill(skill) {
    deletingSkill.value = skill
    deleteSkillDialogOpen.value = true
}

function closeDeleteSkillDialog() {
    deleteSkillDialogOpen.value = false
    deletingSkill.value = null
    deleteSkillForm.clearErrors()
}

function deleteSkill() {
    if (!deletingSkill.value) return

    // NOTE: adjust the route name to match your actual backend endpoint
    deleteSkillForm.delete(route('skills.destroy', deletingSkill.value.id), {
        preserveScroll: true,

        onSuccess: () => {
            toast.add({
                severity: 'success',
                summary: 'Skill Deleted',
                detail: 'The skill has been removed successfully.',
                life: 4000,
            })
            closeDeleteSkillDialog()
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

.skills-page {
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
   CATEGORY SECTIONS
================================= */

.category-list {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.category-section {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 1.5rem;
}

.category-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
    flex-wrap: wrap;
    margin-bottom: 1.2rem;
}

.category-heading {
    display: flex;
    align-items: center;
    gap: .6rem;
}

.category-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 34px;
    height: 34px;
    border-radius: var(--radius-sm);
    background: var(--tag-bg);
    color: var(--primary);
    font-size: 19px;
    flex-shrink: 0;
}

.category-name {
    font-size: 1.02rem;
    font-weight: var(--font-weight-semibold);
    color: var(--text);
}

.category-actions {
    display: flex;
    align-items: center;
    gap: .5rem;
}

.category-empty {
    font-size: .82rem;
    color: var(--text-subtle);
    padding: .5rem 0 0;
}


/* =================================
   SKILLS GRID
================================= */

.skills-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 1rem;
}

.skill-card {
    background: var(--bg-3);
    border: 1px solid var(--border);
    border-radius: var(--radius-sm);
    padding: 1rem;
    transition: border-color var(--transition-fast);
}

.skill-card:hover {
    border-color: var(--border-strong);
}

.skill-card-top {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: .5rem;
    margin-bottom: .7rem;
}

.skill-name {
    display: flex;
    align-items: center;
    gap: .35rem;
    font-size: .88rem;
    font-weight: var(--font-weight-semibold);
    color: var(--text);
}

.featured-badge {
    display: inline-flex;
    color: var(--warning, #d99a1b);
}

.featured-badge .material-symbols-outlined {
    font-size: 15px;
    font-variation-settings: 'FILL' 1;
}

.skill-card-actions {
    display: flex;
    gap: .3rem;
    flex-shrink: 0;
}

.skill-level-row {
    display: flex;
    align-items: center;
    gap: .6rem;
    margin-bottom: .6rem;
}

.skill-level-track {
    flex: 1;
    height: 6px;
    border-radius: 999px;
    background: var(--border);
    overflow: hidden;
}

.skill-level-fill {
    height: 100%;
    border-radius: 999px;
    background: var(--primary);
}

.skill-level-value {
    font-size: .72rem;
    font-weight: var(--font-weight-medium);
    color: var(--text-muted);
    min-width: 2.4em;
    text-align: right;
}

.skill-meta {
    display: flex;
    align-items: center;
    gap: .35rem;
    font-size: .76rem;
    color: var(--text-subtle);
}

.skill-meta .material-symbols-outlined {
    font-size: 14px;
}


/* =================================
   ICON BUTTONS
================================= */

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

.icon-btn.small {
    width: 28px;
    height: 28px;
}

.icon-btn .material-symbols-outlined {
    font-size: 17px;
}

.icon-btn.small .material-symbols-outlined {
    font-size: 15px;
}

.icon-btn:hover {
    color: var(--primary);
    border-color: var(--primary);
}

.icon-btn.danger:hover {
    color: var(--danger);
    border-color: var(--danger);
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

/* native select — no PrimeVue PT exists for this in the project
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
   ICON INPUT (category dialog)
================================= */

.icon-row {
    display: flex;
    align-items: flex-end;
    gap: 1.25rem;
    margin-bottom: 1.6rem;
}

.icon-preview {
    width: 64px;
    height: 64px;
    border-radius: var(--radius-sm);
    background: var(--tag-bg);
    color: var(--primary);
    border: 1px solid var(--border);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 26px;
    flex-shrink: 0;
}

.icon-input {
    flex: 1;
}

.btn-outline {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: .3rem;
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

.btn-outline.small {
    padding: .38rem .85rem;
    font-size: .76rem;
}

.btn-outline.small .material-symbols-outlined {
    font-size: 15px;
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

    .category-header {
        flex-direction: column;
        align-items: stretch;
    }

    .category-actions {
        justify-content: space-between;
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