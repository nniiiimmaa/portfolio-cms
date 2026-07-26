<template>
    <AdminLayout>
        <template #title>{{ $t('adminMedia.title') }}</template>

        <div class="social-links-page">

            <div class="page-header">
                <p class="page-subtitle">{{ $t('adminMedia.subtitle') }}</p>
                <Button :pt="primaryButtonPt" :label="$t('adminMedia.add_new')" @click="openCreate">
                    <span class="material-symbols-outlined">add</span>
                </Button>
            </div>

            <div v-if="sortedLinks.length" class="social-links-grid">
                <div v-for="link in sortedLinks" :key="link.id" class="social-card">

                    <div class="social-card-top">
                        <div class="social-icon" :style="{ '--icon-color': link.color || 'var(--primary)' }">
                            <span class="material-symbols-outlined">{{ form.icon }}</span>
                        </div>

                        <div class="social-card-actions">
                            <button type="button" class="icon-btn" :aria-label="$t('adminMedia.edit')"
                                @click="openEdit(link)">
                                <span class="material-symbols-outlined">edit</span>
                            </button>
                            <button type="button" class="icon-btn danger" :aria-label="$t('adminMedia.delete')"
                                @click="confirmDelete(link)">
                                <span class="material-symbols-outlined">delete</span>
                            </button>
                        </div>
                    </div>

                    <h3 class="social-name">{{ link.name }}</h3>

                    <p v-if="link.username" class="social-username">
                        <span class="material-symbols-outlined">alternate_email</span>
                        {{ link.username }}
                    </p>

                    <a :href="link.url" target="_blank" rel="noopener noreferrer" class="social-url">
                        <span class="material-symbols-outlined">link</span>
                        <span class="social-url-text">{{ link.url }}</span>
                    </a>

                    <div class="social-meta">
                        <span class="status-badge" :class="link.active ? 'active' : 'inactive'">
                            <span class="status-dot"></span>
                            {{ link.active ? $t('adminMedia.active') : $t('adminMedia.inactive') }}
                        </span>
                        <span class="order-badge">
                            {{ $t('adminMedia.order') }} {{ link.order }}
                        </span>
                    </div>

                </div>
            </div>

            <div v-else class="empty-state">
                <span class="material-symbols-outlined">share</span>
                <p>{{ $t('adminMedia.empty') }}</p>
            </div>

        </div>

        <!-- ═══ CREATE / EDIT DIALOG ═══ -->
        <Dialog v-model:visible="formDialogOpen" modal :pt="dialogPt" dismissable-mask class="social-link-dialog"
            :style="{ width: '32rem', maxWidth: '94vw' }" @hide="resetForm">
            <template #header>
                <h3 class="dialog-title">
                    {{ formMode === 'create' ? $t('adminMedia.add_new') : $t('adminMedia.edit_title') }}
                </h3>
            </template>

            <form @submit.prevent="submitForm">

                <div class="form-group">
                    <label class="form-label" for="name">{{ $t('adminMedia.fields.name') }}</label>
                    <InputText id="name" v-model="form.name" :pt="formInputPt" :invalid="!!form.errors.name"
                        placeholder="GitHub" />
                    <span v-if="form.errors.name" class="field-error">{{ form.errors.name }}</span>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="icon">{{ $t('adminMedia.fields.icon') }}</label>
                        <div class="icon-input-row">
                            <span class="icon-preview" :style="{ '--icon-color': form.color || 'var(--primary)' }">
                                <span class="material-symbols-outlined">{{ form.icon }}</span>
                            </span>
                            <InputText id="icon" v-model="form.icon" :pt="formInputPt" :invalid="!!form.errors.icon"
                                placeholder="devicon-github-original" />
                        </div>
                        <span v-if="form.errors.icon" class="field-error">{{ form.errors.icon }}</span>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="color">{{ $t('adminMedia.fields.color') }}</label>
                        <div class="color-input-row">
                            <input id="color" v-model="form.color" type="color" class="native-color-input" />
                            <InputText v-model="form.color" :pt="formInputPt" :invalid="!!form.errors.color"
                                placeholder="#181717" />
                        </div>
                        <span v-if="form.errors.color" class="field-error">{{ form.errors.color }}</span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="url">{{ $t('adminMedia.fields.url') }}</label>
                    <InputText id="url" v-model="form.url" type="url" :pt="formInputPt" :invalid="!!form.errors.url"
                        placeholder="https://github.com/your-username" />
                    <span v-if="form.errors.url" class="field-error">{{ form.errors.url }}</span>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="username">{{ $t('adminMedia.fields.username') }}</label>
                        <InputText id="username" v-model="form.username" :pt="formInputPt"
                            :invalid="!!form.errors.username" placeholder="your-username" />
                        <span v-if="form.errors.username" class="field-error">{{ form.errors.username }}</span>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="order">{{ $t('adminMedia.fields.order') }}</label>
                        <InputText id="order" v-model.number="form.order" type="number" :pt="formInputPt"
                            :invalid="!!form.errors.order" />
                        <span v-if="form.errors.order" class="field-error">{{ form.errors.order }}</span>
                    </div>
                </div>

                <div class="current-row">
                    <ToggleSwitch v-model="form.active" input-id="active-link" />
                    <label for="active-link">{{ $t('adminMedia.fields.active') }}</label>
                </div>

            </form>

            <template #footer>
                <Button :pt="outlineButtonPt" :label="$t('adminMedia.cancel')" @click="formDialogOpen = false" />
                <Button :pt="primaryButtonPt" :label="form.processing ? $t('adminMedia.saving') : $t('adminMedia.save')"
                    :disabled="form.processing" @click="submitForm" />
            </template>
        </Dialog>

        <!-- ═══ DELETE CONFIRMATION DIALOG ═══ -->
        <Dialog v-model:visible="deleteDialogOpen" modal :pt="dialogPt" dismissable-mask class="delete-dialog"
            :style="{ width: '26rem', maxWidth: '92vw' }" @hide="closeDeleteDialog">
            <template #header>
                <h3 class="dialog-title">{{ $t('adminMedia.delete_confirm_title') }}</h3>
            </template>

            <p class="dialog-text">
                {{ $t('adminMedia.delete_confirm_text', { name: deletingLink?.name }) }}
            </p>

            <template #footer>
                <Button :pt="outlineButtonPt" :label="$t('adminMedia.cancel')" @click="closeDeleteDialog" />
                <Button :pt="dangerButtonPt"
                    :label="deleteForm.processing ? $t('adminMedia.deleting') : $t('adminMedia.delete')"
                    :disabled="deleteForm.processing" @click="deleteLink" />
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
import { useI18n } from 'vue-i18n'

import InputText from 'primevue/inputtext'
import Button from 'primevue/button'
import ToggleSwitch from 'primevue/toggleswitch'
import Dialog from 'primevue/dialog'
import { useToast } from 'primevue/usetoast'

import { formInputPt } from '@/PrimeVue/PT/inputText.pt'
import { primaryButtonPt, outlineButtonPt, dangerButtonPt } from '@/PrimeVue/PT/button.pt'
import { dialogPt } from '@/PrimeVue/PT/dialog.pt'
import { useFormErrors } from '@/Composables/useFormErrors'


// -----------------------------
// Props & Emits
// -----------------------------
const props = defineProps({
    links: {
        type: Array,
        default: () => [],
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
function emptyFormShape() {
    return {
        name: '',
        icon: '',
        url: '',
        username: '',
        color: '#181717',
        active: true,
        order: 0,
    }
}

const form = useForm(emptyFormShape())

const formMode = ref('create') // 'create' | 'edit'
const activeLinkId = ref(null)
const formDialogOpen = ref(false)

const deleteDialogOpen = ref(false)
const deletingLink = ref(null)
const deleteForm = useForm({})


// -----------------------------
// Computed & Watch
// -----------------------------
const sortedLinks = computed(() =>
    [...props.links].sort((a, b) => a.order - b.order)
)


// -----------------------------
// Methods
// -----------------------------

/* Create / Edit dialog */
function openCreate() {
    formMode.value = 'create'
    activeLinkId.value = null
    form.defaults(emptyFormShape())
    form.reset()
    formDialogOpen.value = true
}

function openEdit(link) {
    formMode.value = 'edit'
    activeLinkId.value = link.id

    const shape = {
        name: link.name ?? '',
        icon: link.icon ?? '',
        url: link.url ?? '',
        username: link.username ?? '',
        color: link.color ?? '#181717',
        active: link.active ?? true,
        order: link.order ?? 0,
    }

    form.defaults(shape)
    form.reset()
    formDialogOpen.value = true
}

function resetForm() {
    form.clearErrors()
}

function submitForm() {
    const options = {
        preserveScroll: true,

        onSuccess: () => {
            formDialogOpen.value = false
            toast.add({
                severity: 'success',
                summary: t(
                    formMode.value === 'create'
                        ? 'adminMedia.social_link_added_title'
                        : 'adminMedia.social_link_updated_title'
                ),
                detail: t(
                    formMode.value === 'create'
                        ? 'adminMedia.social_link_added_message'
                        : 'adminMedia.social_link_updated_message'
                ),
                life: 4000,
            })
        },

        onError: (errors) => {
            showFormErrors(errors)
        },
    }

    if (formMode.value === 'create') {
        form.post(route('medias.store'), options)
    } else {
        form.put(route('medias.update', activeLinkId.value), options)
    }
}

/* Delete */
function confirmDelete(link) {
    deletingLink.value = link
    deleteDialogOpen.value = true
}

function closeDeleteDialog() {
    deleteDialogOpen.value = false
    deletingLink.value = null
    deleteForm.clearErrors()
}

function deleteLink() {
    if (!deletingLink.value) return

    deleteForm.delete(route('medias.destroy', deletingLink.value.id), {
        preserveScroll: true,

        onSuccess: () => {
            toast.add({
                severity: 'success',
                summary: t('adminMedia.social_link_deleted_title'),
                detail: t('adminMedia.social_link_deleted_message'),
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

.social-links-page {
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

.social-links-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 1.25rem;
}

.social-card {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 1.5rem;
    transition: border-color var(--transition-fast), box-shadow var(--transition-fast);
}

.social-card:hover {
    border-color: var(--border-strong);
}

.social-card-top {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    margin-bottom: 1rem;
}

.social-icon {
    width: 44px;
    height: 44px;
    border-radius: var(--radius-sm);
    background: var(--tag-bg);
    color: var(--icon-color, var(--primary));
    border: 1px solid var(--border);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    flex-shrink: 0;
}

.social-card-actions {
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

.social-name {
    font-size: 1rem;
    font-weight: var(--font-weight-semibold);
    color: var(--text);
    margin-bottom: .4rem;
}

.social-username {
    display: flex;
    align-items: center;
    gap: .35rem;
    font-size: .82rem;
    color: var(--text-muted);
    margin-bottom: .5rem;
}

.social-username .material-symbols-outlined {
    font-size: 15px;
}

.social-url {
    display: flex;
    align-items: center;
    gap: .35rem;
    font-size: .8rem;
    color: var(--text-subtle);
    text-decoration: none;
    margin-bottom: 1rem;
    transition: color var(--transition-fast);
}

.social-url:hover {
    color: var(--primary);
}

.social-url .material-symbols-outlined {
    font-size: 14px;
    flex-shrink: 0;
}

.social-url-text {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.social-meta {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: .5rem;
}

.status-badge,
.order-badge {
    display: inline-flex;
    align-items: center;
    gap: .35rem;
    border-radius: 999px;
    padding: .2rem .6rem;
    font-size: .7rem;
    font-weight: var(--font-weight-medium);
}

.status-badge.active {
    background: var(--tag-bg);
    color: var(--success);
}

.status-badge.inactive {
    background: var(--bg-3);
    color: var(--text-muted);
    border: 1px solid var(--border);
}

.status-dot {
    width: 5px;
    height: 5px;
    border-radius: 50%;
    background: currentColor;
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
   ICON / COLOR FIELDS
================================= */

.icon-input-row,
.color-input-row {
    display: flex;
    align-items: center;
    gap: .6rem;
}

.icon-preview {
    width: 42px;
    height: 42px;
    border-radius: var(--radius-sm);
    background: var(--tag-bg);
    color: var(--icon-color, var(--primary));
    border: 1px solid var(--border);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    flex-shrink: 0;
}

.icon-input-row :deep(.p-inputtext),
.color-input-row :deep(.p-inputtext) {
    flex: 1;
}

.native-color-input {
    width: 42px;
    height: 42px;
    padding: 0;
    border: 1px solid var(--border);
    border-radius: var(--radius-sm);
    background: var(--bg-3);
    cursor: pointer;
    flex-shrink: 0;
}

.native-color-input::-webkit-color-swatch-wrapper {
    padding: 3px;
}

.native-color-input::-webkit-color-swatch {
    border: none;
    border-radius: 3px;
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

}
</style>