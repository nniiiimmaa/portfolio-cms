<template>

    <AdminLayout>
        <template #title>{{ $t('adminProject.title') }}</template>

        <div class="projects-page">

            <div class="page-header">
                <p class="page-subtitle">{{ $t('adminProject.subtitle') }}</p>
                <div class="header-actions">
                    <Button class="cancel-btn" :pt="outlineButtonPt" :label="$t('adminProject.manage_lookup_title')"
                        @click="manageDialogOpen = true">
                        <span class="material-symbols-outlined">tune</span>
                    </Button>
                    <Button :pt="primaryButtonPt" :label="$t('adminProject.add_new')" @click="openCreate">
                        <span class="material-symbols-outlined">add</span>
                    </Button>
                </div>
            </div>

            <div v-if="props.projects.length" class="project-grid">
                <div v-for="proj in props.projects" :key="proj.id" class="proj-card">

                    <div class="proj-card-top">
                        <div class="proj-logo">
                            <img v-if="proj.logo" :src="proj.logo" :alt="titleOf(proj)" />
                            <span v-else>{{ initialsOf(titleOf(proj)) }}</span>
                        </div>

                        <div class="proj-card-actions">
                            <button type="button" class="icon-btn" :aria-label="$t('adminProject.edit')"
                                @click="openEdit(proj)">
                                <span class="material-symbols-outlined">edit</span>
                            </button>
                            <button type="button" class="icon-btn danger" :aria-label="$t('adminProject.delete')"
                                @click="confirmDelete(proj)">
                                <span class="material-symbols-outlined">delete</span>
                            </button>
                        </div>
                    </div>

                    <h3 class="proj-title">
                        {{ titleOf(proj) }}
                        <span v-if="proj.featured" class="featured-badge" :title="$t('adminProject.fields.featured')">
                            <span class="material-symbols-outlined">star</span>
                        </span>
                    </h3>

                    <p class="proj-slug">{{ proj.slug }}</p>

                    <div class="badge-row">
                        <span class="type-badge" :style="typeBadgeStyle(proj)">{{ typeName(proj) }}</span>
                        <span class="status-badge" :class="`status-${statusSlugOf(proj)}`"
                            :style="statusBadgeStyle(proj)">
                            <span class="status-dot"></span>
                            {{ statusName(proj) }}
                        </span>
                        <span v-if="proj.images?.length" class="photo-count-badge">
                            <span class="material-symbols-outlined">photo_library</span>
                            {{ proj.images.length }}
                        </span>
                    </div>

                    <div class="link-row">
                        <a v-if="proj.github_url" :href="proj.github_url" target="_blank" rel="noopener noreferrer"
                            class="link-chip">
                            <span class="material-symbols-outlined">code</span>
                            {{ $t('adminProject.fields.github') }}
                        </a>
                        <a v-if="proj.live_url" :href="proj.live_url" target="_blank" rel="noopener noreferrer"
                            class="link-chip">
                            <span class="material-symbols-outlined">open_in_new</span>
                            {{ $t('adminProject.fields.live') }}
                        </a>
                    </div>

                    <div v-if="proj.technologies?.length" class="tech-tags">
                        <span v-for="tech in proj.technologies" :key="tech" class="tech-tag">{{ tech }}</span>
                    </div>

                </div>
            </div>

            <div v-else class="empty-state">
                <span class="material-symbols-outlined">deployed_code</span>
                <p>{{ $t('adminProject.empty') }}</p>
            </div>

        </div>

        <!-- ═══ CREATE / EDIT DIALOG ═══ -->
        <Dialog v-model:visible="formDialogOpen" modal :pt="dialogPt" dismissable-mask class="project-dialog"
            :style="{ width: '46rem', maxWidth: '94vw' }" @hide="resetForm">
            <template #header>
                <h3 class="dialog-title">
                    {{ formMode === 'create' ? $t('adminProject.add_new') : $t('adminProject.edit_title') }}
                </h3>
            </template>

            <form @submit.prevent="submitForm">

                <div class="logo-row">
                    <div class="logo-preview">
                        <img v-if="logoPreview" :src="logoPreview" :alt="$t('adminProject.logo_alt')" />
                        <span v-else>{{ initialsOf(form.translations[1]?.title) }}</span>
                    </div>
                    <div class="logo-actions">
                        <label class="btn-outline file-btn">
                            <span class="material-symbols-outlined">upload</span>
                            {{ $t('adminProject.upload_logo') }}
                            <input type="file" accept="image/*" hidden @change="onLogoChange" />
                        </label>
                        <span v-if="form.errors.logo" class="field-error">{{ form.errors.logo }}</span>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="slug">{{ $t('adminProject.fields.slug') }}</label>
                        <InputText id="slug" v-model="form.slug" :pt="formInputPt" :invalid="!!form.errors.slug" />
                        <span v-if="form.errors.slug" class="field-error">{{ form.errors.slug }}</span>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="order">{{ $t('adminProject.fields.order') }}</label>
                        <InputText id="order" v-model.number="form.order" type="number" :pt="formInputPt"
                            :invalid="!!form.errors.order" />
                        <span v-if="form.errors.order" class="field-error">{{ form.errors.order }}</span>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="github-url">{{ $t('adminProject.fields.github') }}</label>
                        <InputText id="github-url" v-model="form.github_url" :pt="formInputPt"
                            placeholder="https://github.com/..." :invalid="!!form.errors.github_url" />
                        <span v-if="form.errors.github_url" class="field-error">{{ form.errors.github_url }}</span>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="live-url">{{ $t('adminProject.fields.live') }}</label>
                        <InputText id="live-url" v-model="form.live_url" :pt="formInputPt" placeholder="https://..."
                            :invalid="!!form.errors.live_url" />
                        <span v-if="form.errors.live_url" class="field-error">{{ form.errors.live_url }}</span>
                    </div>
                </div>

                <div class="form-row three">
                    <div class="form-group">
                        <label class="form-label" for="project-type">{{ $t('adminProject.fields.type') }}</label>
                        <select id="project-type" v-model.number="form.project_type_id" class="native-input"
                            :class="{ invalid: !!form.errors.project_type_id }">
                            <option :value="null" disabled>{{ $t('adminProject.select_placeholder') }}</option>
                            <option v-for="type in projectTypes" :key="type.id" :value="type.id">
                                {{ typeLabel(type) }}
                            </option>
                        </select>
                        <span v-if="form.errors.project_type_id" class="field-error">{{ form.errors.project_type_id
                        }}</span>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="project-status">{{ $t('adminProject.fields.status') }}</label>
                        <select id="project-status" v-model.number="form.project_status_id" class="native-input"
                            :class="{ invalid: !!form.errors.project_status_id }">
                            <option :value="null" disabled>{{ $t('adminProject.select_placeholder') }}</option>
                            <option v-for="status in projectStatuses" :key="status.id" :value="status.id">
                                {{ statusLabel(status) }}
                            </option>
                        </select>
                        <span v-if="form.errors.project_status_id" class="field-error">{{ form.errors.project_status_id
                        }}</span>
                    </div>
                    <div class="form-group">
                        <label class="form-label">{{ $t('adminProject.fields.featured') }}</label>
                        <div class="featured-row">
                            <ToggleSwitch v-model="form.featured" input-id="featured-project" />
                            <label for="featured-project">{{ $t('adminProject.fields.featured_hint') }}</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">{{ $t('adminProject.fields.technologies') }}</label>
                    <InputText v-model="techInput" :pt="formInputPt" :placeholder="$t('adminProject.tech_placeholder')"
                        @keydown.enter.prevent="addTechnology" />
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

                <!-- ═══ PHOTOS ═══ existing project photos can be removed here,
                     and new ones queued for upload — both apply on Save -->
                <div class="form-group">
                    <label class="form-label">{{ $t('adminProject.fields.images') }}</label>

                    <div v-if="existingImages.length || newImagePreviews.length" class="image-gallery">

                        <div v-for="img in existingImages" :key="`existing-${img.id}`" class="image-thumb">
                            <img :src="img.url" :alt="$t('adminProject.image_alt')" />
                            <button type="button" class="thumb-remove" :aria-label="$t('adminProject.remove_image')"
                                @click="removeExistingImage(img.id)">
                                <span class="material-symbols-outlined">close</span>
                            </button>
                        </div>

                        <div v-for="(src, i) in newImagePreviews" :key="`new-${i}`" class="image-thumb pending">
                            <img :src="src" :alt="$t('adminProject.image_alt')" />
                            <span class="new-badge">{{ $t('adminProject.new') }}</span>
                            <button type="button" class="thumb-remove" :aria-label="$t('adminProject.remove_image')"
                                @click="removeNewImage(i)">
                                <span class="material-symbols-outlined">close</span>
                            </button>
                        </div>

                    </div>

                    <p v-else class="images-empty">{{ $t('adminProject.no_images') }}</p>

                    <label class="btn-outline file-btn">
                        <span class="material-symbols-outlined">add_photo_alternate</span>
                        {{ $t('adminProject.upload_images') }}
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
                                :title="$t('adminProject.incomplete_language')"></span>
                        </Tab>
                    </TabList>

                    <TabPanels :pt="langTabPanelsPt">
                        <TabPanel v-for="lang in LANGUAGES" :key="lang.id" :value="lang.id">

                            <div class="form-group">
                                <label class="form-label" :for="`title-${lang.id}`">
                                    {{ $t('adminProject.fields.proj_title') }}
                                </label>
                                <InputText :id="`title-${lang.id}`" v-model="form.translations[lang.id].title"
                                    :pt="formInputPt" />
                            </div>

                            <div class="form-group">
                                <label class="form-label" :for="`description-${lang.id}`">
                                    {{ $t('adminProject.fields.description') }}
                                </label>
                                <Textarea :id="`description-${lang.id}`"
                                    v-model="form.translations[lang.id].description" :pt="textareaPt" rows="4" />
                            </div>

                        </TabPanel>
                    </TabPanels>
                </Tabs>

            </form>

            <template #footer>
                <Button class="cancel-btn" :pt="outlineButtonPt" :label="$t('adminProject.cancel')"
                    @click="formDialogOpen = false" />
                <Button :pt="primaryButtonPt"
                    :label="form.processing ? $t('adminProject.saving') : $t('adminProject.save')"
                    :disabled="form.processing" @click="submitForm" />
            </template>
        </Dialog>

        <!-- ═══ DELETE CONFIRMATION DIALOG ═══ -->
        <Dialog v-model:visible="deleteDialogOpen" modal :pt="dialogPt" dismissable-mask class="delete-dialog"
            :style="{ width: '26rem', maxWidth: '92vw' }" @hide="closeDeleteDialog">
            <template #header>
                <h3 class="dialog-title">{{ $t('adminProject.delete_confirm_title') }}</h3>
            </template>

            <p class="dialog-text">
                {{ $t('adminProject.delete_confirm_text', { title: deletingProject ? titleOf(deletingProject) : '' }) }}
            </p>

            <template #footer>
                <Button class="cancel-btn" :pt="outlineButtonPt" :label="$t('adminProject.cancel')"
                    @click="closeDeleteDialog" />
                <Button :pt="dangerButtonPt"
                    :label="deleteForm.processing ? $t('adminProject.deleting') : $t('adminProject.delete')"
                    :disabled="deleteForm.processing" @click="deleteProject" />
            </template>
        </Dialog>

        <!-- ═══ MANAGE TYPES & STATUSES DIALOG ═══ -->
        <Dialog v-model:visible="manageDialogOpen" modal :pt="dialogPt" dismissable-mask class="manage-lookup-dialog"
            :style="{ width: '34rem', maxWidth: '94vw' }">
            <template #header>
                <h3 class="dialog-title">{{ $t('adminProject.manage_lookup_title') }}</h3>
            </template>

            <Tabs :value="manageActiveTab" class="lookup-tabs">
                <TabList :pt="langTabListPt">
                    <Tab value="types" :pt="langTabPt" @click="manageActiveTab = 'types'">
                        {{ $t('adminProject.fields.type') }}
                    </Tab>
                    <Tab value="statuses" :pt="langTabPt" @click="manageActiveTab = 'statuses'">
                        {{ $t('adminProject.fields.status') }}
                    </Tab>
                </TabList>

                <TabPanels :pt="langTabPanelsPt">

                    <!-- Types -->
                    <TabPanel value="types">
                        <div class="lookup-list">
                            <div v-for="type in projectTypes" :key="type.id" class="lookup-row">
                                <div class="lookup-row-info">
                                    <span class="color-swatch"
                                        :style="{ background: type.color || 'var(--tag-bg)' }"></span>
                                    <span class="lookup-row-name">{{ typeLabel(type) }}</span>
                                    <span class="lookup-row-slug">{{ type.slug }}</span>
                                </div>
                                <div class="lookup-row-actions">
                                    <button type="button" class="icon-btn small"
                                        :aria-label="$t('adminProject.edit_type')" @click="openEditType(type)">
                                        <span class="material-symbols-outlined">edit</span>
                                    </button>
                                    <button type="button" class="icon-btn small danger"
                                        :aria-label="$t('adminProject.delete_type')"
                                        @click="confirmDeleteLookup('type', type)">
                                        <span class="material-symbols-outlined">delete</span>
                                    </button>
                                </div>
                            </div>
                            <p v-if="!projectTypes.length" class="lookup-empty">{{ $t('adminProject.no_types') }}</p>
                        </div>

                        <button type="button" class="btn-outline small add-lookup-btn" @click="openCreateType">
                            <span class="material-symbols-outlined">add</span>
                            {{ $t('adminProject.add_type') }}
                        </button>
                    </TabPanel>

                    <!-- Statuses -->
                    <TabPanel value="statuses">
                        <div class="lookup-list">
                            <div v-for="status in projectStatuses" :key="status.id" class="lookup-row">
                                <div class="lookup-row-info">
                                    <span class="color-swatch"
                                        :style="{ background: status.color || 'var(--tag-bg)' }"></span>
                                    <span class="lookup-row-name">{{ statusLabel(status) }}</span>
                                    <span class="lookup-row-slug">{{ status.slug }}</span>
                                </div>
                                <div class="lookup-row-actions">
                                    <button type="button" class="icon-btn small"
                                        :aria-label="$t('adminProject.edit_status')" @click="openEditStatus(status)">
                                        <span class="material-symbols-outlined">edit</span>
                                    </button>
                                    <button type="button" class="icon-btn small danger"
                                        :aria-label="$t('adminProject.delete_status')"
                                        @click="confirmDeleteLookup('status', status)">
                                        <span class="material-symbols-outlined">delete</span>
                                    </button>
                                </div>
                            </div>
                            <p v-if="!projectStatuses.length" class="lookup-empty">{{ $t('adminProject.no_statuses') }}
                            </p>
                        </div>

                        <button type="button" class="btn-outline small add-lookup-btn" @click="openCreateStatus">
                            <span class="material-symbols-outlined">add</span>
                            {{ $t('adminProject.add_status') }}
                        </button>
                    </TabPanel>

                </TabPanels>
            </Tabs>

            <template #footer>
                <Button class="cancel-btn" :pt="outlineButtonPt" :label="$t('adminProject.close')"
                    @click="manageDialogOpen = false" />
            </template>
        </Dialog>

        <!-- ═══ TYPE CREATE / EDIT DIALOG ═══ -->
        <Dialog v-model:visible="typeFormDialogOpen" modal :pt="dialogPt" dismissable-mask class="lookup-form-dialog"
            :style="{ width: '45rem', maxWidth: '92vw' }" @hide="resetTypeForm">
            <template #header>
                <h3 class="dialog-title">
                    {{ typeFormMode === 'create' ? $t('adminProject.add_type') : $t('adminProject.edit_type_title') }}
                </h3>
            </template>

            <form @submit.prevent="submitTypeForm">

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="type-slug">{{ $t('adminProject.fields.slug') }}</label>
                        <InputText id="type-slug" v-model="typeForm.slug" :pt="formInputPt"
                            :invalid="!!typeForm.errors.slug" />
                        <span v-if="typeForm.errors.slug" class="field-error">{{ typeForm.errors.slug }}</span>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="type-color">{{ $t('adminProject.fields.color') }}</label>
                        <div class="color-input-row">
                            <input id="type-color" v-model="typeForm.color" type="color" class="color-input" />
                            <div class="color-hex-wrapper">
                                <InputText v-model="typeForm.color" :pt="formInputPt" placeholder="#6366F1"
                                    :invalid="!!typeForm.errors.color" />
                            </div>
                        </div>
                        <span v-if="typeForm.errors.color" class="field-error">{{ typeForm.errors.color }}</span>
                    </div>
                </div>

                <Tabs :value="typeActiveLang" class="lang-tabs">
                    <TabList :pt="langTabListPt">
                        <Tab v-for="lang in LANGUAGES" :key="lang.id" :value="lang.id" :pt="langTabPt"
                            @click="typeActiveLang = lang.id">
                            {{ lang.label }}
                            <span v-if="!typeForm.translations[lang.id].name" class="incomplete-dot"
                                :title="$t('adminProject.incomplete_language')"></span>
                        </Tab>
                    </TabList>

                    <TabPanels :pt="langTabPanelsPt">
                        <TabPanel v-for="lang in LANGUAGES" :key="lang.id" :value="lang.id">
                            <div class="form-group">
                                <label class="form-label" :for="`type-name-${lang.id}`">
                                    {{ $t('adminProject.fields.lookup_name') }}
                                </label>
                                <InputText :id="`type-name-${lang.id}`" v-model="typeForm.translations[lang.id].name"
                                    :pt="formInputPt" />
                            </div>
                        </TabPanel>
                    </TabPanels>
                </Tabs>

            </form>

            <template #footer>
                <Button class="cancel-btn" :pt="outlineButtonPt" :label="$t('adminProject.cancel')"
                    @click="typeFormDialogOpen = false" />
                <Button :pt="primaryButtonPt"
                    :label="typeForm.processing ? $t('adminProject.saving') : $t('adminProject.save')"
                    :disabled="typeForm.processing" @click="submitTypeForm" />
            </template>
        </Dialog>

        <!-- ═══ STATUS CREATE / EDIT DIALOG ═══ -->
        <Dialog v-model:visible="statusFormDialogOpen" modal :pt="dialogPt" dismissable-mask class="lookup-form-dialog"
            :style="{ width: '45rem', maxWidth: '92vw' }" @hide="resetStatusForm">
            <template #header>
                <h3 class="dialog-title">
                    {{ statusFormMode === 'create' ? $t('adminProject.add_status') :
                        $t('adminProject.edit_status_title') }}
                </h3>
            </template>

            <form @submit.prevent="submitStatusForm">

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="status-slug">{{ $t('adminProject.fields.slug') }}</label>
                        <InputText id="status-slug" v-model="statusForm.slug" :pt="formInputPt"
                            :invalid="!!statusForm.errors.slug" />
                        <span v-if="statusForm.errors.slug" class="field-error">{{ statusForm.errors.slug }}</span>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="status-color">{{ $t('adminProject.fields.color') }}</label>
                        <div class="color-input-row">
                            <input id="status-color" v-model="statusForm.color" type="color" class="color-input" />
                            <div class="color-hex-wrapper">
                                <InputText v-model="statusForm.color" :pt="formInputPt" placeholder="#22C55E"
                                    :invalid="!!statusForm.errors.color" />
                            </div>
                        </div>
                        <span v-if="statusForm.errors.color" class="field-error">{{ statusForm.errors.color }}</span>
                    </div>
                </div>

                <Tabs :value="statusActiveLang" class="lang-tabs">
                    <TabList :pt="langTabListPt">
                        <Tab v-for="lang in LANGUAGES" :key="lang.id" :value="lang.id" :pt="langTabPt"
                            @click="statusActiveLang = lang.id">
                            {{ lang.label }}
                            <span v-if="!statusForm.translations[lang.id].name" class="incomplete-dot"
                                :title="$t('adminProject.incomplete_language')"></span>
                        </Tab>
                    </TabList>

                    <TabPanels :pt="langTabPanelsPt">
                        <TabPanel v-for="lang in LANGUAGES" :key="lang.id" :value="lang.id">
                            <div class="form-group">
                                <label class="form-label" :for="`status-name-${lang.id}`">
                                    {{ $t('adminProject.fields.lookup_name') }}
                                </label>
                                <InputText :id="`status-name-${lang.id}`"
                                    v-model="statusForm.translations[lang.id].name" :pt="formInputPt" />
                            </div>
                        </TabPanel>
                    </TabPanels>
                </Tabs>

            </form>

            <template #footer>
                <Button class="cancel-btn" :pt="outlineButtonPt" :label="$t('adminProject.cancel')"
                    @click="statusFormDialogOpen = false" />
                <Button :pt="primaryButtonPt"
                    :label="statusForm.processing ? $t('adminProject.saving') : $t('adminProject.save')"
                    :disabled="statusForm.processing" @click="submitStatusForm" />
            </template>
        </Dialog>

        <!-- ═══ DELETE TYPE/STATUS CONFIRMATION DIALOG ═══ -->
        <Dialog v-model:visible="deleteLookupDialogOpen" modal :pt="dialogPt" dismissable-mask class="delete-dialog"
            :style="{ width: '26rem', maxWidth: '92vw' }" @hide="closeDeleteLookupDialog">
            <template #header>
                <h3 class="dialog-title">{{ $t('adminProject.delete_lookup_confirm_title') }}</h3>
            </template>

            <p class="dialog-text">
                {{ $t('adminProject.delete_lookup_confirm_text', {
                    name: deletingLookupItem ?
                        lookupLabel(deletingLookupItem) :
                        ''
                }) }}
            </p>

            <template #footer>
                <Button class="cancel-btn" :pt="outlineButtonPt" :label="$t('adminProject.cancel')"
                    @click="closeDeleteLookupDialog" />
                <Button :pt="dangerButtonPt"
                    :label="deleteLookupForm.processing ? $t('adminProject.deleting') : $t('adminProject.delete')"
                    :disabled="deleteLookupForm.processing" @click="deleteLookupItem" />
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
import { primaryButtonPt, dangerButtonPt, outlineButtonPt } from '@/PrimeVue/PT/button.pt'
import { textareaPt } from '@/PrimeVue/PT/textarea.pt'
import { langTabListPt, langTabPt, langTabPanelsPt } from '@/PrimeVue/PT/tab.pt'
import { dialogPt } from '@/PrimeVue/PT/dialog.pt'
import { useFormErrors } from '@/Composables/useFormErrors'


// -----------------------------
// Props & Emits
// -----------------------------
const props = defineProps({
    projects: {
        type: Array,
        default: () => [],
    },
    // full lookup lists so the select inputs — and the card labels, since
    // a project only carries project_type_id / project_status_id, not a
    // nested type/status relation — have every option available
    projectTypes: {
        type: Array,
        default: () => [],
    },
    projectStatuses: {
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

const emptyTranslation = { title: '', description: '' }

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
        logo: null,
        github_url: '',
        live_url: '',
        featured: false,
        order: 0,
        project_type_id: null,
        project_status_id: null,
        technologies: [],
        images: [],
        deleted_image_ids: [],
        translations: buildTranslationsMap(null),
    }
}

const form = useForm(emptyFormShape())

const formMode = ref('create') // 'create' | 'edit'
const activeProjectId = ref(null)
const formDialogOpen = ref(false)
const activeLang = ref(1)
const logoPreview = ref(null)
const techInput = ref('')

// existing photos already saved on the project — removals are queued
// here and only applied server-side when the form is saved
const existingImages = ref([]) // [{ id, url }]
const newImageFiles = ref([])
const newImagePreviews = ref([])

const deleteDialogOpen = ref(false)
const deletingProject = ref(null)
const deleteForm = useForm({})


// -----------------------------
// Computed & Watch
// -----------------------------

// -----------------------------
// Methods
// -----------------------------
function initialsOf(name) {
    if (!name) return ''
    return name.split(' ').map((w) => w[0]).slice(0, 2).join('').toUpperCase()
}

// display copy always falls back to the English (language_id 1) translation
function titleOf(proj) {
    if (!proj) return ''
    return translationOf(proj.translations, 'title') || proj.slug || ''
}

// projects only carry project_type_id / project_status_id — look the
// readable name up from the lookup lists passed in as props
function typeOf(proj) {
    return props.projectTypes.find((t) => t.id === proj.project_type_id)
}

function statusOf(proj) {
    return props.projectStatuses.find((s) => s.id === proj.project_status_id)
}

function typeName(proj) {
    const type = typeOf(proj)
    if (!type) return ''
    return translationOf(type.translations, 'name') || type.slug || ''
}

function statusName(proj) {
    const status = statusOf(proj)
    if (!status) return ''
    return translationOf(status.translations, 'name') || status.slug || ''
}

function statusSlugOf(proj) {
    return statusOf(proj)?.slug ?? ''
}

function typeLabel(type) {
    return translationOf(type.translations, 'name') || type.slug
}

function statusLabel(status) {
    return translationOf(status.translations, 'name') || status.slug
}

// only overrides the CSS color when the lookup row has one set —
// otherwise the existing slug-based CSS classes (status-planning, etc.) apply
function typeBadgeStyle(proj) {
    const color = typeOf(proj)?.color
    return color ? { color } : {}
}

function statusBadgeStyle(proj) {
    const color = statusOf(proj)?.color
    return color ? { color } : {}
}

function isLangComplete(langId) {
    const tr = form.translations[langId]
    return Boolean(tr.title && tr.description)
}

/* Create / Edit dialog */
function openCreate() {
    formMode.value = 'create'
    activeProjectId.value = null
    form.defaults(emptyFormShape())
    form.reset()
    logoPreview.value = null
    techInput.value = ''
    existingImages.value = []
    newImageFiles.value = []
    newImagePreviews.value = []
    activeLang.value = 1
    formDialogOpen.value = true
}

function openEdit(proj) {
    formMode.value = 'edit'
    activeProjectId.value = proj.id

    const shape = {
        slug: proj.slug ?? '',
        logo: null,
        github_url: proj.github_url ?? '',
        live_url: proj.live_url ?? '',
        featured: proj.featured ?? false,
        order: proj.order ?? 0,
        project_type_id: proj.project_type_id ?? null,
        project_status_id: proj.project_status_id ?? null,
        technologies: [...(proj.technologies ?? [])],
        images: [],
        deleted_image_ids: [],
        translations: buildTranslationsMap(proj.translations),
    }

    form.defaults(shape)
    form.reset()

    logoPreview.value = proj.logo ?? null
    techInput.value = ''
    existingImages.value = (proj.images ?? []).map((img) => ({
        id: img.id,
        url: img.url ?? img.path,
    }))
    newImageFiles.value = []
    newImagePreviews.value = []
    activeLang.value = 1
    formDialogOpen.value = true
}

function resetForm() {
    form.clearErrors()
    newImagePreviews.value.forEach((src) => URL.revokeObjectURL(src))
    newImageFiles.value = []
    newImagePreviews.value = []
}

function onLogoChange(event) {
    const file = event.target.files?.[0]
    if (!file) return
    form.logo = file
    logoPreview.value = URL.createObjectURL(file)
}

/* Photos */
function onImagesChange(event) {
    const files = Array.from(event.target.files ?? [])
    for (const file of files) {
        newImageFiles.value.push(file)
        newImagePreviews.value.push(URL.createObjectURL(file))
    }
    form.images = newImageFiles.value
    event.target.value = '' // allow picking the same file again later
}

function removeNewImage(index) {
    URL.revokeObjectURL(newImagePreviews.value[index])
    newImageFiles.value.splice(index, 1)
    newImagePreviews.value.splice(index, 1)
    form.images = newImageFiles.value
}

function removeExistingImage(imageId) {
    existingImages.value = existingImages.value.filter((img) => img.id !== imageId)
    form.deleted_image_ids.push(imageId)
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
                summary: t(
                    formMode.value === 'create'
                        ? 'adminProject.project_added_title'
                        : 'adminProject.project_updated_title'
                ),
                detail: t(
                    formMode.value === 'create'
                        ? 'adminProject.project_added_message'
                        : 'adminProject.project_updated_message'
                ),
                life: 4000,
            })
        },

        onError: (errors) => {
            showFormErrors(errors)
        },
    }

    if (formMode.value === 'create') {
        form.post(route('projects.store'), options)
    } else {
        form.transform((data) => ({ ...data, _method: 'put' }))
            .post(route('projects.update', activeProjectId.value), options)
    }
}

/* Delete */
function confirmDelete(proj) {
    deletingProject.value = proj
    deleteDialogOpen.value = true
}

function closeDeleteDialog() {
    deleteDialogOpen.value = false
    deletingProject.value = null
    deleteForm.clearErrors()
}

function deleteProject() {
    if (!deletingProject.value) return

    deleteForm.delete(route('projects.destroy', deletingProject.value.id), {
        preserveScroll: true,

        onSuccess: () => {
            toast.add({
                severity: 'success',
                summary: t('adminProject.project_deleted_title'),
                detail: t('adminProject.project_deleted_message'),
                life: 4000,
            })
            closeDeleteDialog()
        },

        onError: (errors) => {
            showFormErrors(errors)
        },
    })
}


// -----------------------------
// Type / Status lookup management
// -----------------------------
// project_type / project_status only carry a slug + per-language `name`
// (no icon, no order) — this section manages both tables from one place
const manageDialogOpen = ref(false)
const manageActiveTab = ref('types') // 'types' | 'statuses'

const emptyLookupTranslation = { name: '' }

function buildLookupTranslationsMap(translations) {
    const map = {}
    for (const lang of LANGUAGES) {
        const existing = translations?.find((tr) => tr.language_id === lang.id)
        map[lang.id] = existing ? { ...emptyLookupTranslation, ...existing } : { ...emptyLookupTranslation }
    }
    return map
}

function emptyLookupFormShape() {
    return {
        slug: '',
        color: '#6366F1',
        translations: buildLookupTranslationsMap(null),
    }
}

/* Types */
const typeForm = useForm(emptyLookupFormShape())
const typeFormMode = ref('create') // 'create' | 'edit'
const activeTypeId = ref(null)
const typeFormDialogOpen = ref(false)
const typeActiveLang = ref(1)

function openCreateType() {
    typeFormMode.value = 'create'
    activeTypeId.value = null
    typeForm.defaults(emptyLookupFormShape())
    typeForm.reset()
    typeActiveLang.value = 1
    typeFormDialogOpen.value = true
}

function openEditType(type) {
    typeFormMode.value = 'edit'
    activeTypeId.value = type.id

    const shape = {
        slug: type.slug ?? '',
        color: type.color ?? '#6366F1',
        translations: buildLookupTranslationsMap(type.translations),
    }

    typeForm.defaults(shape)
    typeForm.reset()
    typeActiveLang.value = 1
    typeFormDialogOpen.value = true
}

function resetTypeForm() {
    typeForm.clearErrors()
}

function submitTypeForm() {
    const options = {
        preserveScroll: true,

        onSuccess: () => {
            typeFormDialogOpen.value = false
            toast.add({
                severity: 'success',
                summary: t(
                    typeFormMode.value === 'create'
                        ? 'adminProject.type_added_title'
                        : 'adminProject.type_updated_title'
                ),
                detail: t(
                    typeFormMode.value === 'create'
                        ? 'adminProject.type_added_message'
                        : 'adminProject.type_updated_message'
                ),
                life: 4000,
            })
        },

        onError: (errors) => {
            showFormErrors(errors)
        },
    }

    if (typeFormMode.value === 'create') {
        typeForm.post(route('projecttypes.store'), options)
    } else {
        typeForm.put(route('projecttypes.update', activeTypeId.value), options)
    }
}

/* Statuses */
const statusForm = useForm(emptyLookupFormShape())
const statusFormMode = ref('create') // 'create' | 'edit'
const activeStatusId = ref(null)
const statusFormDialogOpen = ref(false)
const statusActiveLang = ref(1)

function openCreateStatus() {
    statusFormMode.value = 'create'
    activeStatusId.value = null
    statusForm.defaults(emptyLookupFormShape())
    statusForm.reset()
    statusActiveLang.value = 1
    statusFormDialogOpen.value = true
}

function openEditStatus(status) {
    statusFormMode.value = 'edit'
    activeStatusId.value = status.id

    const shape = {
        slug: status.slug ?? '',
        color: status.color ?? '#6366F1',
        translations: buildLookupTranslationsMap(status.translations),
    }

    statusForm.defaults(shape)
    statusForm.reset()
    statusActiveLang.value = 1
    statusFormDialogOpen.value = true
}

function resetStatusForm() {
    statusForm.clearErrors()
}

function submitStatusForm() {
    const options = {
        preserveScroll: true,

        onSuccess: () => {
            statusFormDialogOpen.value = false
            toast.add({
                severity: 'success',
                summary: t(
                    statusFormMode.value === 'create'
                        ? 'adminProject.status_added_title'
                        : 'adminProject.status_updated_title'
                ),
                detail: t(
                    statusFormMode.value === 'create'
                        ? 'adminProject.status_added_message'
                        : 'adminProject.status_updated_message'
                ),
                life: 4000,
            })
        },

        onError: (errors) => {
            showFormErrors(errors)
        },
    }

    if (statusFormMode.value === 'create') {
        statusForm.post(route('projectstatuses.store'), options)
    } else {
        statusForm.put(route('projectstatuses.update', activeStatusId.value), options)
    }
}

/* Delete — shared between types & statuses */
const deleteLookupDialogOpen = ref(false)
const deletingLookupItem = ref(null) // { kind: 'type' | 'status', id, slug, translations }
const deleteLookupForm = useForm({})

function lookupLabel(item) {
    if (!item) return ''
    return item.kind === 'type' ? typeLabel(item) : statusLabel(item)
}

function confirmDeleteLookup(kind, item) {
    deletingLookupItem.value = { ...item, kind }
    deleteLookupDialogOpen.value = true
}

function closeDeleteLookupDialog() {
    deleteLookupDialogOpen.value = false
    deletingLookupItem.value = null
    deleteLookupForm.clearErrors()
}

function deleteLookupItem() {
    if (!deletingLookupItem.value) return

    const kind = deletingLookupItem.value.kind
    const routeName = kind === 'type' ? 'projecttypes.destroy' : 'projectstatuses.destroy'

    deleteLookupForm.delete(route(routeName, deletingLookupItem.value.id), {
        preserveScroll: true,

        onSuccess: () => {
            toast.add({
                severity: 'success',
                summary: t(
                    kind === 'type'
                        ? 'adminProject.type_deleted_title'
                        : 'adminProject.status_deleted_title'
                ),
                detail: t(
                    kind === 'type'
                        ? 'adminProject.type_deleted_message'
                        : 'adminProject.status_deleted_message'
                ),
                life: 4000,
            })
            closeDeleteLookupDialog()
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

.projects-page {
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

.header-actions {
    display: flex;
    align-items: center;
    gap: .7rem;
}


/* =================================
   GRID
================================= */

.project-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.25rem;
}

.proj-card {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 1.5rem;
    transition: border-color var(--transition-fast), box-shadow var(--transition-fast);
}

.proj-card:hover {
    border-color: var(--border-strong);
}

.proj-card-top {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    margin-bottom: 1rem;
}

.proj-logo {
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

.proj-logo img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.proj-card-actions {
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

.proj-title {
    display: flex;
    align-items: center;
    gap: .4rem;
    font-size: 1rem;
    font-weight: var(--font-weight-semibold);
    color: var(--text);
    margin-bottom: .3rem;
}

.featured-badge {
    display: inline-flex;
    color: var(--warning, #d99a1b);
}

.featured-badge .material-symbols-outlined {
    font-size: 17px;
    font-variation-settings: 'FILL' 1;
}

.proj-slug {
    font-size: .78rem;
    color: var(--text-subtle);
    margin-bottom: .8rem;
    word-break: break-all;
}

.badge-row {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: .5rem;
    margin-bottom: .8rem;
}

.type-badge {
    background: var(--tag-bg);
    color: var(--tag-text);
    border: 1px solid var(--border);
    border-radius: 999px;
    padding: .2rem .65rem;
    font-size: .72rem;
    font-weight: var(--font-weight-medium);
}

.status-badge {
    display: inline-flex;
    align-items: center;
    gap: .35rem;
    border-radius: 999px;
    padding: .2rem .65rem .2rem .55rem;
    font-size: .72rem;
    font-weight: var(--font-weight-medium);
    background: var(--tag-bg);
    color: var(--text-muted);
}

.status-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: currentColor;
}

.status-badge.status-planning {
    color: var(--text-subtle);
}

.status-badge.status-in-progress {
    color: var(--primary);
}

.status-badge.status-on-hold {
    color: var(--warning, #d99a1b);
}

.status-badge.status-completed {
    color: var(--success);
}

.status-badge.status-cancelled {
    color: var(--danger);
}

.photo-count-badge {
    display: inline-flex;
    align-items: center;
    gap: .3rem;
    background: var(--bg-3);
    color: var(--text-muted);
    border: 1px solid var(--border);
    border-radius: 999px;
    padding: .2rem .6rem;
    font-size: .7rem;
    font-weight: var(--font-weight-medium);
}

.photo-count-badge .material-symbols-outlined {
    font-size: 13px;
}

.link-row {
    display: flex;
    flex-wrap: wrap;
    gap: .5rem;
    margin-bottom: .6rem;
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

/* native select — no PrimeVue PT exists for this in the project
   yet, so it's styled directly to match InputText's PT appearance,
   the same approach used for native date inputs elsewhere */
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

.featured-row {
    display: flex;
    align-items: center;
    gap: .7rem;
    height: 100%;
}

.featured-row label {
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
    padding: .4rem .9rem;
    font-size: .76rem;
}

.btn-outline.small .material-symbols-outlined {
    font-size: 15px;
}


/* =================================
   IMAGE GALLERY
================================= */

.image-gallery {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(84px, 1fr));
    gap: .6rem;
    margin-bottom: .7rem;
}

.image-thumb {
    position: relative;
    width: 100%;
    aspect-ratio: 1 / 1;
    border-radius: var(--radius-sm);
    border: 1px solid var(--border);
    overflow: hidden;
    background: var(--bg-3);
}

.image-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.image-thumb.pending {
    border-color: var(--primary);
}

.new-badge {
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

.thumb-remove {
    position: absolute;
    top: 4px;
    right: 4px;
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

.thumb-remove .material-symbols-outlined {
    font-size: 14px;
}

.thumb-remove:hover {
    background: var(--danger);
}

.images-empty {
    font-size: .82rem;
    color: var(--text-subtle);
    margin-bottom: .9rem;
}


/* =================================
   LANGUAGE TABS
================================= */

.lang-tabs {
    margin-top: .4rem;
}

:deep(.p-tab:not(.p-disabled):hover) {
    color: var(--text);
}

:deep(.p-tab-active) {
    color: var(--primary);
    border-color: var(--primary);
}

:deep(.p-tablist-active-bar) {
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
   MANAGE TYPES & STATUSES
================================= */

.lookup-tabs {
    margin-top: .2rem;
}

.lookup-list {
    display: flex;
    flex-direction: column;
    gap: .5rem;
    margin-bottom: 1rem;
}

.lookup-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: .8rem;
    background: var(--bg-3);
    border: 1px solid var(--border);
    border-radius: var(--radius-sm);
    padding: .6rem .8rem;
}

.lookup-row-info {
    display: flex;
    align-items: center;
    gap: .55rem;
    min-width: 0;
}

.lookup-row-name {
    font-size: .85rem;
    font-weight: var(--font-weight-medium);
    color: var(--text);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.lookup-row-slug {
    font-size: .74rem;
    color: var(--text-subtle);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.lookup-row-actions {
    display: flex;
    gap: .3rem;
    flex-shrink: 0;
}

.lookup-empty {
    font-size: .82rem;
    color: var(--text-subtle);
    padding: .5rem 0;
}

.color-swatch {
    width: 15px;
    height: 15px;
    border-radius: 50%;
    border: 1px solid var(--border-strong);
    flex-shrink: 0;
}

.add-lookup-btn {
    width: fit-content;
}


/* =================================
   COLOR INPUT (type/status dialogs)
================================= */

.color-input-row {
    display: flex;
    align-items: center;
    gap: .6rem;
}

.color-input {
    width: 44px;
    height: 38px;
    padding: 2px;
    border-radius: var(--radius-sm);
    border: 1px solid var(--border);
    background: var(--bg-3);
    cursor: pointer;
    flex-shrink: 0;
}

.color-hex-wrapper {
    flex: 1;
    min-width: 0;
}


/* =================================
   added
================================= */

.canel-btn {
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

    .header-actions {
        justify-content: stretch;
    }

    .header-actions .p-button {
        flex: 1;
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