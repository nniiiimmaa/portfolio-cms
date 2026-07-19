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
                    <p class="project-description">{{ descriptionOf(project) }}</p>

                    <div v-if="project.technologies?.length" class="tech-tags">
                        <span v-for="tech in project.technologies" :key="tech" class="tech-tag">
                            {{ tech }}
                        </span>
                    </div>

                </div>

            </div>
        </div>

        <button v-if="hasMore" class="toggle-btn" @click="expanded = !expanded">
            {{ expanded ? $t('publicProject.showLess') : $t('publicProject.showMore') }}
            <span class="material-symbols-outlined toggle-icon" :class="{ rotated: expanded }">
                expand_more
            </span>
        </button>

    </section>

</template>
<script setup>
// -----------------------------
// Imports
// -----------------------------
import { computed, ref } from 'vue'
import { useI18n } from 'vue-i18n'


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


// -----------------------------
// Methods
// -----------------------------
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
   CARD
================================= */


.project-card {
    position: relative;
    display: flex;
    flex-direction: column;
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    overflow: hidden;
 
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
    transform: scale(1.08);
    border-color: var(--primary);
    box-shadow:
        0 24px 48px -12px rgba(0, 0, 0, .35),
        0 0 0 1px var(--primary),
        0 0 30px var(--glow);
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
    margin-bottom: .5rem;
    transition: color var(--transition-fast);
}
 
.project-card:hover .project-title {
    color: var(--primary);
}
 
.project-description {
    font-size: .87rem;
    color: var(--text-muted);
    line-height: 1.7;
 
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
 
.tech-tags {
    display: flex;
    flex-wrap: wrap;
    gap: .5rem;
    margin-top: 1.1rem;
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
   RESPONSIVE
================================= */

@media (max-width: 640px) {

    .projects-section {
        padding: 3.5rem 1.25rem;
    }

    .projects-grid {
        grid-template-columns: 1fr;
    }

}


/* =================================
   MOTION SAFETY
================================= */

@media (prefers-reduced-motion: reduce) {
    .project-card,
    .project-icon,
    .icon-link,
    .toggle-icon {
        animation: none !important;
        transition: none !important;
        opacity: 1 !important;
        transform: none !important;
    }
}
</style>