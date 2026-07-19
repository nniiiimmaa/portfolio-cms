<template>

    <section id="education" class="education-section">

        <div class="section-header">
            <span class="section-label">{{ $t('publicEducation.eyebrow') }}</span>
            <h2 class="section-title">{{ $t('publicEducation.title') }}</h2>
        </div>

        <div class="education-list">
            <div
                v-for="(edu, i) in visibleEducation"
                :key="edu.id"
                class="edu-card"
                :style="{ '--i': i }"
            >

                <div class="edu-icon">
                    <img v-if="edu.logo" :src="edu.logo" :alt="translationOf(edu).institution" />
                    <span v-else>{{ initials(translationOf(edu).institution) }}</span>
                </div>

                <div class="edu-content">

                    <div class="edu-top-row">
                        <h3 class="edu-degree">{{ translationOf(edu).degree }}</h3>
                        <span v-if="edu.current" class="current-badge">
                            <span class="current-dot"></span>
                            {{ $t('publicEducation.current') }}
                        </span>
                    </div>

                    <p class="edu-institution">{{ translationOf(edu).institution }}</p>

                    <div class="edu-meta">
                        <span class="meta-item">
                            <span class="material-symbols-outlined">school</span>
                            {{ translationOf(edu).field }}
                        </span>
                        <span class="meta-item">
                            <span class="material-symbols-outlined">location_on</span>
                            {{ translationOf(edu).location }}
                        </span>
                        <span class="meta-item">
                            <span class="material-symbols-outlined">calendar_today</span>
                            {{ dateRange(edu) }}
                        </span>
                    </div>

                    <p class="edu-description">{{ translationOf(edu).description }}</p>

                    <div class="edu-badges">
                        <span v-if="edu.score" class="score-badge">
                            <span class="material-symbols-outlined">military_tech</span>
                            {{ $t('publicEducation.score') }}: {{ edu.score }}
                        </span>

                        <a
                            v-if="edu.verification_url"
                            :href="edu.verification_url"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="verify-badge"
                        >
                            <span class="material-symbols-outlined">verified</span>
                            {{ $t('publicEducation.verify') }}
                        </a>
                    </div>

                </div>

            </div>
        </div>

        <button v-if="hasMore" class="toggle-btn" @click="expanded = !expanded">
            {{ expanded ? $t('publicEducation.showLess') : $t('publicEducation.showMore') }}
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
    education: {
        type: Array,
        required: true,
    },
})


// -----------------------------
// Stores & Composables
// -----------------------------
const { locale, t } = useI18n()


// -----------------------------
// Refs & Reactives & Vars
// -----------------------------
const expanded = ref(false)
const visibleCount = 3

// translations are keyed by numeric language_id, same seeded table as projects
const LOCALE_TO_LANGUAGE_ID = {
    en: 1,
    pt: 2,
    es: 3,
    de: 4,
    tr: 5,
    fa: 6,
    ar: 7,
}


// -----------------------------
// Computed & Watch
// -----------------------------
const sortedEducation = computed(() =>
    [...props.education].sort((a, b) => a.order - b.order)
)

const hasMore = computed(() => sortedEducation.value.length > visibleCount)

const visibleEducation = computed(() =>
    expanded.value ? sortedEducation.value : sortedEducation.value.slice(0, visibleCount)
)


// -----------------------------
// Methods
// -----------------------------
function translationOf(edu) {
    const currentId = LOCALE_TO_LANGUAGE_ID[locale.value] ?? 1

    return (
        edu.translations.find((tr) => tr.language_id === currentId) ||
        edu.translations.find((tr) => tr.language_id === LOCALE_TO_LANGUAGE_ID.en) ||
        edu.translations[0]
    )
}

function initials(institution) {
    if (!institution) return ''
    return institution
        .split(' ')
        .map((word) => word[0])
        .slice(0, 2)
        .join('')
        .toUpperCase()
}

function formatDate(dateStr) {
    if (!dateStr) return ''
    return new Date(dateStr).toLocaleDateString(locale.value, {
        month: 'short',
        year: 'numeric',
    })
}

function dateRange(edu) {
    const start = formatDate(edu.start_date)
    const end = edu.current ? t('education.present') : formatDate(edu.end_date)
    return `${start} — ${end}`
}
</script>
<style scoped>
/* =================================
   SECTION
================================= */

.education-section {
    padding: 5.5rem 2rem;
    max-width: 880px;
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
   LIST
================================= */

.education-list {
    display: flex;
    flex-direction: column;
    gap: 1.25rem;
}


/* =================================
   CARD
================================= */

.edu-card {
    position: relative;
    display: flex;
    gap: 1.4rem;
    align-items: flex-start;
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 1.6rem 1.8rem;

    animation: eduRise .6s cubic-bezier(.22, 1, .36, 1) calc(.1s * var(--i)) backwards;

    transition:
        transform var(--transition-normal),
        border-color var(--transition-normal),
        box-shadow var(--transition-normal);
}

@keyframes eduRise {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.edu-card:hover {
    z-index: 2;
    transform: scale(1.02);
    border-color: var(--primary);
    box-shadow:
        0 22px 44px -16px rgba(0, 0, 0, .3),
        0 0 0 1px var(--primary),
        0 0 28px var(--glow);
}

.edu-icon {
    width: 52px;
    height: 52px;
    border-radius: var(--radius-sm);
    background: var(--tag-bg);
    border: 1px solid var(--border);
    color: var(--primary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: .85rem;
    font-weight: var(--font-weight-semibold);
    flex-shrink: 0;
    overflow: hidden;
    transition: transform var(--transition-normal), box-shadow var(--transition-normal);
}

.edu-icon img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.edu-card:hover .edu-icon {
    transform: rotate(-6deg) scale(1.08);
    box-shadow: 0 0 16px var(--glow);
}

.edu-content {
    flex: 1;
    min-width: 0;
}

.edu-top-row {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: .6rem;
}

.edu-degree {
    font-size: 1.02rem;
    font-weight: var(--font-weight-semibold);
    color: var(--text);
    transition: color var(--transition-fast);
}

.edu-card:hover .edu-degree {
    color: var(--primary);
}

.current-badge {
    display: inline-flex;
    align-items: center;
    gap: .4rem;
    background: var(--tag-bg);
    color: var(--tag-text);
    border-radius: 999px;
    padding: .2rem .65rem;
    font-size: .7rem;
    font-weight: var(--font-weight-medium);
}

.current-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: var(--success);
}

.edu-institution {
    font-size: .92rem;
    color: var(--primary);
    font-weight: var(--font-weight-medium);
    margin-top: .2rem;
}

.edu-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    margin-top: .6rem;
}

.meta-item {
    display: inline-flex;
    align-items: center;
    gap: .3rem;
    font-size: .8rem;
    color: var(--text-subtle);
}

.meta-item .material-symbols-outlined {
    font-size: 15px;
}

.edu-description {
    font-size: .88rem;
    color: var(--text-muted);
    line-height: 1.75;
    margin-top: .9rem;
}

.edu-badges {
    display: flex;
    flex-wrap: wrap;
    gap: .6rem;
    margin-top: 1rem;
}

.score-badge {
    display: inline-flex;
    align-items: center;
    gap: .35rem;
    background: rgba(5, 150, 105, .12);
    color: var(--success);
    border-radius: 999px;
    padding: .3rem .8rem;
    font-size: .74rem;
    font-weight: var(--font-weight-medium);
}

.score-badge .material-symbols-outlined {
    font-size: 15px;
}

.verify-badge {
    display: inline-flex;
    align-items: center;
    gap: .35rem;
    background: var(--tag-bg);
    color: var(--tag-text);
    border: 1px solid var(--border);
    border-radius: 999px;
    padding: .3rem .8rem;
    font-size: .74rem;
    font-weight: var(--font-weight-medium);
    text-decoration: none;
    transition:
        transform var(--transition-fast),
        border-color var(--transition-fast),
        box-shadow var(--transition-fast);
}

.verify-badge .material-symbols-outlined {
    font-size: 15px;
}

.verify-badge:hover {
    transform: translateY(-2px);
    border-color: var(--primary);
    box-shadow: 0 8px 18px -10px var(--glow);
}


/* =================================
   TOGGLE BUTTON
================================= */

.toggle-btn {
    display: flex;
    align-items: center;
    gap: .4rem;
    margin: 2rem auto 0;
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

    .education-section {
        padding: 3.5rem 1.25rem;
    }

    .edu-card {
        flex-direction: column;
        padding: 1.4rem 1.5rem;
    }

    .edu-card:hover {
        transform: scale(1.015);
    }

}


/* =================================
   MOTION SAFETY
================================= */

@media (prefers-reduced-motion: reduce) {
    .edu-card,
    .edu-icon,
    .toggle-icon {
        animation: none !important;
        transition: none !important;
        opacity: 1 !important;
        transform: none !important;
    }
}
</style>