<template>

    <section id="projects" class="projects-section">

        <div class="section-header">
            <span class="section-label">{{ $t('publicProject.eyebrow') }}</span>
            <h2 class="section-title">{{ $t('publicProject.title') }}</h2>
        </div>

        <div class="projects-grid">
            <div
                v-for="(project, i) in visibleProjects"
                :key="project.id"
                class="project-card"
                :style="{ '--i': i }"
                role="button"
                tabindex="0"
                @click="openDetails(project)"
                @keydown.enter="openDetails(project)"
            >

                <div class="project-card-top">
                    <div class="project-icon">
                        <img v-if="project.logo" :src="project.logo" :alt="titleOf(project)" />
                        <span v-else>{{ initials(titleOf(project)) }}</span>
                    </div>

                    <div class="project-links">
                        <a
                            v-if="project.github_url"
                            :href="project.github_url"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="icon-link"
                            :aria-label="$t('publicProject.github')"
                            :title="$t('publicProject.github_tooltip')"
                            @click.stop
                        >
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor">
                                <path d="M12 .5C5.73.5.98 5.24.98 11.52c0 5.02 3.26 9.28 7.77 10.78.57.1.78-.25.78-.55 0-.27-.01-1.16-.02-2.1-3.16.69-3.83-1.34-3.83-1.34-.52-1.31-1.26-1.66-1.26-1.66-1.03-.7.08-.69.08-.69 1.14.08 1.74 1.17 1.74 1.17 1.01 1.74 2.65 1.24 3.3.95.1-.73.4-1.24.72-1.53-2.52-.29-5.17-1.26-5.17-5.6 0-1.24.44-2.25 1.17-3.04-.12-.29-.51-1.45.11-3.02 0 0 .96-.31 3.14 1.16a10.9 10.9 0 0 1 5.72 0c2.18-1.47 3.14-1.16 3.14-1.16.62 1.57.23 2.73.11 3.02.73.79 1.17 1.8 1.17 3.04 0 4.35-2.65 5.31-5.18 5.59.41.35.77 1.04.77 2.1 0 1.52-.01 2.74-.01 3.11 0 .3.2.66.79.55 4.5-1.5 7.76-5.76 7.76-10.78C23.02 5.24 18.27.5 12 .5Z" />
                            </svg>
                        </a>
                        <a
                            v-if="project.live_url"
                            :href="project.live_url"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="icon-link"
                            :aria-label="$t('publicProject.live_demo')"
                            :title="$t('publicProject.live_demo_tooltip')"
                            @click.stop
                        >
                            <span class="material-symbols-outlined">open_in_new</span>
                        </a>
                    </div>
                </div>

                <div class="project-body">

                    <div class="project-badges">
                        <span v-if="project.featured" class="badge featured">
                            <span class="material-symbols-outlined">star</span>
                            {{ $t('publicProject.featured') }}
                        </span>
                        <span class="badge status" :class="statusClass(project)">
                            {{ statusNameOf(project) }}
                        </span>
                        <span class="badge type">{{ typeNameOf(project) }}</span>
                    </div>

                    <h3 class="project-title">{{ titleOf(project) }}</h3>

                    <div v-if="project.technologies?.length" class="tech-tags">
                        <span v-for="tech in project.technologies" :key="tech" class="tech-tag">
                            {{ tech }}
                        </span>
                    </div>

                    <span class="view-details">
                        {{ $t('publicProject.view_details') }}
                        <span class="material-symbols-outlined">arrow_forward</span>
                    </span>

                </div>

            </div>
        </div>

        <button v-if="hasMore" class="toggle-btn" @click="expanded = !expanded">
            {{ expanded ? $t('publicProject.showLess') : $t('publicProject.showMore') }}
            <span class="material-symbols-outlined toggle-icon" :class="{ rotated: expanded }">
                expand_more
            </span>
        </button>

        <Dialog
            v-model:visible="detailsOpen"
            modal
            dismissable-mask
            class="project-dialog"
            :style="{ width: '38rem', maxWidth: '94vw' }"
            :pt="dialogPt"
        >
            <template #header>
                <div v-if="activeProject" class="dialog-head">
                    <div class="dialog-icon">
                        <img
                            v-if="activeProject.logo"
                            :src="activeProject.logo"
                            :alt="titleOf(activeProject)"
                        />
                        <span v-else>{{ initials(titleOf(activeProject)) }}</span>
                    </div>
                    <div class="dialog-head-text">
                        <h3 class="dialog-title">{{ titleOf(activeProject) }}</h3>
                        <div class="dialog-badges">
                            <span v-if="activeProject.featured" class="badge featured">
                                <span class="material-symbols-outlined">star</span>
                                {{ $t('publicProject.featured') }}
                            </span>
                            <span class="badge status" :class="statusClass(activeProject)">
                                {{ statusNameOf(activeProject) }}
                            </span>
                            <span class="badge type">{{ typeNameOf(activeProject) }}</span>
                        </div>
                    </div>
                </div>
            </template>

            <template v-if="activeProject">

                <!-- image carousel -->
                <div class="dialog-gallery">
                    <div v-if="activeProject.images?.length" class="gallery-frame">
                        <img
                            :src="imageUrl(activeProject.images[activeImageIndex])"
                            :alt="titleOf(activeProject)"
                            class="gallery-image"
                        />

                        <template v-if="activeProject.images.length > 1">
                            <button
                                type="button"
                                class="gallery-nav prev"
                                :aria-label="$t('publicProject.previous_image')"
                                @click="prevImage"
                            >
                                <span class="material-symbols-outlined">chevron_left</span>
                            </button>
                            <button
                                type="button"
                                class="gallery-nav next"
                                :aria-label="$t('publicProject.next_image')"
                                @click="nextImage"
                            >
                                <span class="material-symbols-outlined">chevron_right</span>
                            </button>

                            <span class="gallery-counter">
                                {{ activeImageIndex + 1 }} / {{ activeProject.images.length }}
                            </span>

                            <div class="gallery-dots">
                                <button
                                    v-for="(img, idx) in activeProject.images"
                                    :key="idx"
                                    type="button"
                                    class="gallery-dot"
                                    :class="{ active: idx === activeImageIndex }"
                                    :aria-label="`${$t('publicProject.go_to_image')} ${idx + 1}`"
                                    @click="activeImageIndex = idx"
                                ></button>
                            </div>
                        </template>
                    </div>

                    <div v-else class="gallery-frame gallery-empty">
                        <div class="project-icon large">
                            <img
                                v-if="activeProject.logo"
                                :src="activeProject.logo"
                                :alt="titleOf(activeProject)"
                            />
                            <span v-else>{{ initials(titleOf(activeProject)) }}</span>
                        </div>
                    </div>

                    <div v-if="activeProject.images?.length > 1" class="gallery-thumbs">
                        <button
                            v-for="(img, idx) in activeProject.images"
                            :key="idx"
                            type="button"
                            class="gallery-thumb"
                            :class="{ active: idx === activeImageIndex }"
                            @click="activeImageIndex = idx"
                        >
                            <img :src="imageUrl(img)" :alt="`${titleOf(activeProject)} ${idx + 1}`" />
                        </button>
                    </div>
                </div>

                <p class="dialog-description">{{ descriptionOf(activeProject) }}</p>

                <div v-if="activeProject.technologies?.length" class="tech-tags">
                    <span v-for="tech in activeProject.technologies" :key="tech" class="tech-tag">
                        {{ tech }}
                    </span>
                </div>

            </template>

            <template #footer>
                <a
                    v-if="activeProject?.github_url"
                    :href="activeProject.github_url"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="btn btn-outline"
                >
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor">
                        <path d="M12 .5C5.73.5.98 5.24.98 11.52c0 5.02 3.26 9.28 7.77 10.78.57.1.78-.25.78-.55 0-.27-.01-1.16-.02-2.1-3.16.69-3.83-1.34-3.83-1.34-.52-1.31-1.26-1.66-1.26-1.66-1.03-.7.08-.69.08-.69 1.14.08 1.74 1.17 1.74 1.17 1.01 1.74 2.65 1.24 3.3.95.1-.73.4-1.24.72-1.53-2.52-.29-5.17-1.26-5.17-5.6 0-1.24.44-2.25 1.17-3.04-.12-.29-.51-1.45.11-3.02 0 0 .96-.31 3.14 1.16a10.9 10.9 0 0 1 5.72 0c2.18-1.47 3.14-1.16 3.14-1.16.62 1.57.23 2.73.11 3.02.73.79 1.17 1.8 1.17 3.04 0 4.35-2.65 5.31-5.18 5.59.41.35.77 1.04.77 2.1 0 1.52-.01 2.74-.01 3.11 0 .3.2.66.79.55 4.5-1.5 7.76-5.76 7.76-10.78C23.02 5.24 18.27.5 12 .5Z" />
                    </svg>
                    {{ $t('publicProject.github') }}
                </a>
                <a
                    v-if="activeProject?.live_url"
                    :href="activeProject.live_url"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="btn btn-primary"
                >
                    {{ $t('publicProject.live_demo') }}
                    <span class="material-symbols-outlined">open_in_new</span>
                </a>
            </template>
        </Dialog>

    </section>

</template>
<script setup>
// -----------------------------
// Imports
// -----------------------------
import { computed, onBeforeUnmount, ref, watch } from 'vue'
import { useI18n } from 'vue-i18n'
import Dialog from 'primevue/dialog'
import { dialogPt } from '@/PrimeVue/PT/dialog.pt'


// -----------------------------
// Props & Emits
// -----------------------------
const props = defineProps({
    projects: {
        type: Array,
        required: true,
    },
})


// -----------------------------
// Stores & Composables
// -----------------------------
const { locale } = useI18n()


// -----------------------------
// Refs & Reactives & Vars
// -----------------------------
const expanded = ref(false)
const visibleCount = 6

const detailsOpen = ref(false)
const activeProject = ref(null)
const activeImageIndex = ref(0)

// translations are keyed by numeric language_id rather than locale —
// map the app's locale codes to the seeded language table
const LOCALE_TO_LANGUAGE_ID = {
    en: 1,
    pt: 2,
    es: 3,
    de: 4,
    tr: 5,
    fa: 6,
    ar: 7,
}

const STATUS_CLASS_MAP = {
    'in-progress': 'status-progress',
    'completed': 'status-completed',
    'on-hold': 'status-hold',
    'planned': 'status-planned',
}


// -----------------------------
// Computed & Watch
// -----------------------------
const sortedProjects = computed(() =>
    [...props.projects].sort((a, b) => a.order - b.order)
)

const hasMore = computed(() => sortedProjects.value.length > visibleCount)

const visibleProjects = computed(() =>
    expanded.value ? sortedProjects.value : sortedProjects.value.slice(0, visibleCount)
)

// reset the carousel every time a different project is opened
watch(activeProject, () => {
    activeImageIndex.value = 0
})

// arrow-key navigation for the gallery, only while the dialog is open
watch(detailsOpen, (isOpen) => {
    if (isOpen) {
        window.addEventListener('keydown', handleGalleryKeydown)
    } else {
        window.removeEventListener('keydown', handleGalleryKeydown)
    }
})


// -----------------------------
// Methods
// -----------------------------
function openDetails(project) {
    activeProject.value = project
    detailsOpen.value = true
}

function imageUrl(image) {
    return typeof image === 'string' ? image : image?.path ?? ''
}

function prevImage() {
    const total = activeProject.value?.images?.length ?? 0
    if (!total) return
    activeImageIndex.value = (activeImageIndex.value - 1 + total) % total
}

function nextImage() {
    const total = activeProject.value?.images?.length ?? 0
    if (!total) return
    activeImageIndex.value = (activeImageIndex.value + 1) % total
}

function handleGalleryKeydown(event) {
    if (event.key === 'ArrowLeft') prevImage()
    if (event.key === 'ArrowRight') nextImage()
}


// -----------------------------
// Hooks
// -----------------------------
onBeforeUnmount(() => {
    window.removeEventListener('keydown', handleGalleryKeydown)
})

function pickTranslation(translations) {
    if (!translations?.length) return null

    const currentId = LOCALE_TO_LANGUAGE_ID[locale.value] ?? 1

    return (
        translations.find((tr) => tr.language_id === currentId) ||
        translations.find((tr) => tr.language_id === LOCALE_TO_LANGUAGE_ID.en) ||
        translations[0]
    )
}

function titleOf(project) {
    return pickTranslation(project.translations)?.title ?? ''
}

function descriptionOf(project) {
    return pickTranslation(project.translations)?.description ?? ''
}

function typeNameOf(project) {
    return pickTranslation(project.type?.translations)?.name ?? ''
}

function statusNameOf(project) {
    return pickTranslation(project.status?.translations)?.name ?? ''
}

function statusClass(project) {
    return STATUS_CLASS_MAP[project.status?.slug] ?? 'status-planned'
}

function initials(title) {
    if (!title) return ''
    return title
        .split(' ')
        .map((word) => word[0])
        .slice(0, 2)
        .join('')
        .toUpperCase()
}
</script>
<style scoped>
/* =================================
   SECTION
================================= */

.projects-section {
    padding: 5.5rem 2rem;
    max-width: 1080px;
    margin: 0 auto;
}

.section-header {
    text-align: center;
    margin-bottom: 3rem;
}

.section-label {
    display: inline-block;
    font-size: .78rem;
    font-weight: var(--font-weight-semibold);
    letter-spacing: .14em;
    text-transform: uppercase;
    color: var(--primary);
    margin-bottom: .6rem;
}

.section-title {
    font-family: var(--font-heading);
    font-size: clamp(1.7rem, 3.5vw, 2.3rem);
    font-weight: var(--font-weight-bold);
    letter-spacing: -.01em;
}


/* =================================
   GRID
================================= */

.projects-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.5rem;
}


/* =================================
   CARD — description removed; click anywhere
   on the card to open the full details dialog
================================= */

.project-card {
    position: relative;
    display: flex;
    flex-direction: column;
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    overflow: hidden;
    cursor: pointer;

    animation: cardRise .6s cubic-bezier(.22, 1, .36, 1) calc(.08s * var(--i)) backwards;

    transition:
        transform var(--transition-normal),
        border-color var(--transition-normal),
        box-shadow var(--transition-normal);
}

@keyframes cardRise {
    from {
        opacity: 0;
        transform: translateY(18px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.project-card:hover {
    z-index: 2;
    transform: scale(1.03);
    border-color: var(--primary);
    box-shadow:
        0 24px 48px -12px rgba(0, 0, 0, .35),
        0 0 0 1px var(--primary),
        0 0 30px var(--glow);
}

.project-card:focus-visible {
    outline: 2px solid var(--primary);
    outline-offset: 3px;
}

.project-card-top {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1.4rem 1.6rem 0;
}

.project-icon {
    width: 44px;
    height: 44px;
    border-radius: var(--radius-sm);
    background: var(--tag-bg);
    border: 1px solid var(--border);
    color: var(--primary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: .8rem;
    font-weight: var(--font-weight-semibold);
    overflow: hidden;
    flex-shrink: 0;
    transition: transform var(--transition-normal), box-shadow var(--transition-normal);
}

.project-icon img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.project-card:hover .project-icon {
    transform: rotate(-6deg) scale(1.06);
    box-shadow: 0 0 14px var(--glow);
}

.project-links {
    display: flex;
    gap: .5rem;
}

.icon-link {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    border-radius: var(--radius-sm);
    background: var(--bg-3);
    border: 1px solid var(--border);
    color: var(--text-muted);
    transition:
        color var(--transition-fast),
        border-color var(--transition-fast),
        transform var(--transition-fast);
}

.icon-link .material-symbols-outlined {
    font-size: 17px;
}

.icon-link:hover {
    color: var(--primary);
    border-color: var(--primary);
    transform: translateY(-2px);
}

.project-body {
    padding: 1.2rem 1.6rem 1.6rem;
}

.project-badges {
    display: flex;
    flex-wrap: wrap;
    gap: .4rem;
    margin-bottom: .8rem;
}

.badge {
    display: inline-flex;
    align-items: center;
    gap: .3rem;
    border-radius: 999px;
    padding: .2rem .65rem;
    font-size: .7rem;
    font-weight: var(--font-weight-medium);
}

.badge .material-symbols-outlined {
    font-size: 13px;
}

.badge.featured {
    background: rgba(217, 119, 6, .12);
    color: var(--warning);
}

.badge.type {
    background: var(--bg-3);
    color: var(--text-muted);
    border: 1px solid var(--border);
}

.badge.status {
    border: 1px solid transparent;
}

.badge.status-progress {
    background: var(--tag-bg);
    color: var(--primary);
}

.badge.status-completed {
    background: rgba(5, 150, 105, .12);
    color: var(--success);
}

.badge.status-hold {
    background: rgba(217, 119, 6, .12);
    color: var(--warning);
}

.badge.status-planned {
    background: var(--bg-3);
    color: var(--text-subtle);
    border-color: var(--border);
}

.project-title {
    font-size: 1.02rem;
    font-weight: var(--font-weight-semibold);
    color: var(--text);
    margin-bottom: .8rem;
    transition: color var(--transition-fast);
}

.project-card:hover .project-title {
    color: var(--primary);
}

.tech-tags {
    display: flex;
    flex-wrap: wrap;
    gap: .5rem;
}

.tech-tag {
    background: var(--tag-bg);
    color: var(--tag-text);
    border: 1px solid var(--border);
    border-radius: 999px;
    padding: .3rem .75rem;
    font-size: .74rem;
    font-weight: var(--font-weight-medium);
    transition: transform var(--transition-fast), border-color var(--transition-fast);
}

.tech-tag:hover {
    transform: translateY(-2px);
    border-color: var(--primary);
}

.view-details {
    display: inline-flex;
    align-items: center;
    gap: .35rem;
    margin-top: 1.1rem;
    color: var(--primary);
    font-size: .82rem;
    font-weight: var(--font-weight-medium);
}

.view-details .material-symbols-outlined {
    font-size: 16px;
    transition: transform var(--transition-fast);
}

.project-card:hover .view-details .material-symbols-outlined {
    transform: translateX(3px);
}


/* =================================
   TOGGLE BUTTON
================================= */

.toggle-btn {
    display: flex;
    align-items: center;
    gap: .4rem;
    margin: 2.5rem auto 0;
    padding: .7rem 1.6rem;
    border-radius: 999px;
    border: 1px solid var(--border-strong);
    background: transparent;
    color: var(--text);
    font-family: var(--font-primary);
    font-size: .85rem;
    font-weight: var(--font-weight-medium);
    cursor: pointer;
    transition:
        border-color var(--transition-fast),
        background var(--transition-fast),
        transform var(--transition-fast);
}

.toggle-btn:hover {
    border-color: var(--primary);
    background: var(--tag-bg);
    transform: translateY(-2px);
}

.toggle-icon {
    font-size: 18px;
    transition: transform var(--transition-normal);
}

.toggle-icon.rotated {
    transform: rotate(180deg);
}


/* =================================
   DETAILS DIALOG
================================= */

.dialog-head {
    display: flex;
    align-items: center;
    gap: 1.1rem;
}

.dialog-icon {
    width: 52px;
    height: 52px;
    flex-shrink: 0;
    border-radius: var(--radius-sm);
    background: var(--tag-bg);
    border: 1px solid var(--border);
    color: var(--primary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: .85rem;
    font-weight: var(--font-weight-semibold);
    overflow: hidden;
}

.dialog-icon img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.dialog-head-text {
    min-width: 0;
}

.dialog-title {
    font-family: var(--font-heading);
    font-size: 1.15rem;
    font-weight: var(--font-weight-semibold);
    color: var(--text);
    margin-bottom: .5rem;
}

.dialog-badges {
    display: flex;
    flex-wrap: wrap;
    gap: .4rem;
}

.dialog-description {
    font-size: .93rem;
    color: var(--text-muted);
    line-height: 1.8;
    margin: 1.5rem 0;
}


/* =================================
   IMAGE GALLERY
================================= */

.dialog-gallery {
    margin-bottom: .5rem;
}

.gallery-frame {
    position: relative;
    width: 100%;
    aspect-ratio: 16 / 9;
    border-radius: var(--radius-sm);
    overflow: hidden;
    background: var(--bg-3);
    border: 1px solid var(--border);
}

.gallery-empty {
    display: flex;
    align-items: center;
    justify-content: center;
}

.project-icon.large {
    width: 72px;
    height: 72px;
    font-size: 1.4rem;
}

.gallery-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.gallery-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    display: flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    border: none;
    background: rgba(0, 0, 0, .5);
    color: #fff;
    cursor: pointer;
    backdrop-filter: blur(4px);
    transition: background var(--transition-fast), transform var(--transition-fast);
}

.gallery-nav:hover {
    background: rgba(0, 0, 0, .7);
    transform: translateY(-50%) scale(1.08);
}

.gallery-nav.prev {
    left: .7rem;
}

.gallery-nav.next {
    right: .7rem;
}

.gallery-dots {
    position: absolute;
    bottom: .7rem;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: .4rem;
}

.gallery-dot {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    border: none;
    background: rgba(255, 255, 255, .45);
    cursor: pointer;
    padding: 0;
    transition: background var(--transition-fast), transform var(--transition-fast);
}

.gallery-dot:hover {
    background: rgba(255, 255, 255, .75);
}

.gallery-dot.active {
    background: #fff;
    transform: scale(1.2);
}

.gallery-counter {
    position: absolute;
    top: .7rem;
    right: .7rem;
    background: rgba(0, 0, 0, .55);
    color: #fff;
    font-size: .72rem;
    font-family: var(--font-monospace);
    padding: .25rem .6rem;
    border-radius: 999px;
    backdrop-filter: blur(4px);
}

.gallery-thumbs {
    display: flex;
    gap: .5rem;
    margin-top: .6rem;
    overflow-x: auto;
    padding-bottom: .2rem;
}

.gallery-thumb {
    flex-shrink: 0;
    width: 56px;
    height: 40px;
    border-radius: var(--radius-sm);
    overflow: hidden;
    border: 2px solid transparent;
    padding: 0;
    cursor: pointer;
    opacity: .6;
    transition: opacity var(--transition-fast), border-color var(--transition-fast);
}

.gallery-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.gallery-thumb:hover {
    opacity: .85;
}

.gallery-thumb.active {
    opacity: 1;
    border-color: var(--primary);
}


/* =================================
   DIALOG BUTTONS
================================= */

.btn {
    display: inline-flex;
    align-items: center;
    gap: .4rem;
    border-radius: 999px;
    padding: .65rem 1.5rem;
    font-family: var(--font-primary);
    font-size: .85rem;
    font-weight: var(--font-weight-medium);
    text-decoration: none;
    cursor: pointer;
    border: 1px solid transparent;
    transition:
        transform var(--transition-fast),
        box-shadow var(--transition-fast),
        background var(--transition-fast),
        border-color var(--transition-fast);
}

.btn .material-symbols-outlined {
    font-size: 16px;
}

.btn-primary {
    background: var(--primary);
    border-color: var(--primary);
    color: #fff;
}

.btn-primary:hover {
    background: var(--primary-hover);
    border-color: var(--primary-hover);
    transform: translateY(-2px);
    box-shadow: 0 10px 22px -8px var(--glow);
}

.btn-outline {
    background: transparent;
    border-color: var(--border-strong);
    color: var(--text);
}

.btn-outline:hover {
    border-color: var(--primary);
    background: var(--tag-bg);
    transform: translateY(-2px);
}


/* =================================
   RESPONSIVE
================================= */

@media (max-width: 640px) {

    .projects-section {
        padding: 3.5rem 1.25rem;
    }

    .projects-grid {
        grid-template-columns: 1fr;
    }

    .project-card:hover {
        transform: scale(1.01);
    }

}


/* =================================
   MOTION SAFETY
================================= */

@media (prefers-reduced-motion: reduce) {
    .project-card,
    .project-icon,
    .icon-link,
    .toggle-icon,
    .gallery-nav,
    .gallery-dot {
        animation: none !important;
        transition: none !important;
        opacity: 1 !important;
        transform: none !important;
    }
}
</style>