<template>

    <section id="experience" class="experience-section">

        <div class="section-header">
            <span class="section-label">{{ $t('publicExperienc.eyebrow') }}</span>
            <h2 class="section-title">{{ $t('publicExperienc.title') }}</h2>
        </div>

        <div class="timeline">
            <div
                v-for="(exp, i) in visibleExperiences"
                :key="exp.id"
                class="timeline-item"
                :style="{ '--i': i }"
            >

                <div class="timeline-marker">
                    <span class="timeline-dot" :class="{ current: exp.current }"></span>
                    <span v-if="i !== visibleExperiences.length - 1" class="timeline-line"></span>
                </div>

                <div class="timeline-card">

                    <div class="timeline-card-header">

                        <div class="company-logo">
                            <img v-if="exp.logo" :src="exp.logo" :alt="exp.company" />
                            <span v-else>{{ initials(exp.company) }}</span>
                        </div>

                        <div class="timeline-heading">
                            <div class="company-row">
                                <h3 class="company-name">{{ exp.company }}</h3>
                                <span v-if="exp.current" class="current-badge">
                                    <span class="current-dot"></span>
                                    {{ $t('publicExperienc.current') }}
                                </span>
                            </div>

                            <p v-if="translationOf(exp)" class="position">
                                {{ translationOf(exp).position }}
                            </p>

                            <div class="meta-row">
                                <span class="meta-item">
                                    <span class="material-symbols-outlined">location_on</span>
                                    {{ exp.location }}
                                </span>
                                <span class="meta-item">
                                    <span class="material-symbols-outlined">calendar_today</span>
                                    {{ dateRange(exp) }}
                                </span>
                            </div>
                        </div>

                    </div>

                    <p v-if="translationOf(exp)" class="description">
                        {{ translationOf(exp).description }}
                    </p>

                    <div v-if="exp.technologies?.length" class="tech-tags">
                        <span v-for="tech in exp.technologies" :key="tech" class="tech-tag">
                            {{ tech }}
                        </span>
                    </div>

                </div>

            </div>
        </div>

        <div class="toggle-btn-container">
            <Button v-if="hasMore" outlined :pt="outlineButtonPt" @click="expanded = !expanded">
                {{ expanded ? $t('publicExperienc.showLess') : $t('publicExperienc.showMore') }}
                <span class="material-symbols-outlined toggle-icon" :class="{ rotated: expanded }">
                    expand_more
                </span>
            </Button>
        </div>

    </section>

</template>
<script setup>
// -----------------------------
// Imports
// -----------------------------
import { computed, ref } from 'vue'
import { useI18n } from 'vue-i18n'
import { outlineButtonPt } from '@/PrimeVue/PT/button.pt'
import { Button } from 'primevue'


// -----------------------------
// Props & Emits
// -----------------------------
const props = defineProps({
    experiences: {
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
const visibleCount = 2
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
const hasMore = computed(() => props.experiences.length > visibleCount)

const visibleExperiences = computed(() =>
    expanded.value
        ? props.experiences
        : props.experiences.slice(0, visibleCount)
)


// -----------------------------
// Methods
// -----------------------------
function translationOf(exp) {
    if (!exp.translations?.length) return null

    const currentId = LOCALE_TO_LANGUAGE_ID[locale.value] ?? 1

    return (
        exp.translations.find((tr) => tr.language_id === currentId) ||
        exp.translations.find(
            (tr) => tr.language_id === LOCALE_TO_LANGUAGE_ID.en
        ) ||
        exp.translations[0]
    )
}

function initials(company) {
    if (!company) return ''
    return company
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

function dateRange(exp) {
    const start = formatDate(exp.start_date)
    const end = exp.current ? t('experience.present') : formatDate(exp.end_date)
    return `${start} — ${end}`
}
</script>
<style scoped>
/* =================================
   SECTION
================================= */

.experience-section {
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
   TIMELINE
================================= */

 
.timeline-item {
    display: flex;
    gap: 1.5rem;
 
    opacity: 0;
    animation: itemRise .7s cubic-bezier(.22, 1, .36, 1) forwards;
    animation-delay: calc(.12s * var(--i));
}
 
@keyframes itemRise {
    from {
        opacity: 0;
        transform: translateY(24px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
 
 
/* -----------------------------
   Dot + connecting line
   ----------------------------- */
 
.timeline-marker {
    display: flex;
    flex-direction: column;
    align-items: center;
    flex-shrink: 0;
    padding-top: 8px;
}
 
.timeline-dot {
    position: relative;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: var(--border-strong);
    flex-shrink: 0;
 
    opacity: 0;
    transform: scale(.4);
    animation: dotIn .45s ease forwards;
    animation-delay: calc(.12s * var(--i));
}
 
@keyframes dotIn {
    to {
        opacity: 1;
        transform: scale(1);
    }
}
 
/* current role: solid color + one soft, continuous glow pulse */
.timeline-dot.current {
    background: var(--primary);
    box-shadow: 0 0 0 4px var(--tag-bg);
    animation:
        dotIn .45s ease forwards,
        dotGlow 2.4s ease-in-out calc(.12s * var(--i) + .45s) infinite;
}
 
@keyframes dotGlow {
    0%, 100% {
        box-shadow: 0 0 0 4px var(--tag-bg), 0 0 0 0 var(--glow);
    }
    50% {
        box-shadow: 0 0 0 4px var(--tag-bg), 0 0 12px 3px var(--glow);
    }
}
 
/* the line itself is just the static track; the fill draws over it,
   timed just after the dot above it appears — reads like progress
   being drawn down the timeline as you scroll to it */
.timeline-line {
    position: relative;
    width: 1px;
    flex: 1;
    margin-top: 6px;
    background: var(--border);
    overflow: hidden;
}
 
/* a beam travels from the bottom of the line to the top, disappears,
   and loops — continuous, not a one-time reveal */
.timeline-line::after {
    content: "";
    position: absolute;
    left: 0;
    width: 100%;
    height: 40%;
    bottom: -40%;
    background: linear-gradient(to top, var(--primary), transparent);
    animation: lineTravel 2.2s linear infinite;
    animation-delay: calc(.2s * var(--i));
}
 
@keyframes lineTravel {
    from { bottom: -40%; }
    to { bottom: 100%; }
}


/* -----------------------------
   Card
   ----------------------------- */

.timeline-card {
    flex: 1;
    min-width: 0;
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 1.6rem 1.8rem;
    margin-bottom: 1.75rem;
    transition:
        transform var(--transition-normal),
        border-color var(--transition-normal),
        box-shadow var(--transition-normal);
}

.timeline-card:hover {
    transform: translateY(-4px);
    border-color: var(--primary);
    box-shadow: 0 16px 32px -20px var(--glow);
}

.timeline-card-header {
    display: flex;
    gap: 1rem;
    align-items: flex-start;
}

.company-logo {
    width: 46px;
    height: 46px;
    border-radius: var(--radius-sm);
    background: var(--tag-bg);
    border: 1px solid var(--border);
    color: var(--primary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: .82rem;
    font-weight: var(--font-weight-semibold);
    flex-shrink: 0;
    overflow: hidden;
}

.company-logo img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.timeline-heading {
    flex: 1;
    min-width: 0;
}

.company-row {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: .6rem;
}

.company-name {
    font-size: 1.02rem;
    font-weight: var(--font-weight-semibold);
    color: var(--text);
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

.position {
    font-size: .9rem;
    color: var(--primary);
    font-weight: var(--font-weight-medium);
    margin-top: .2rem;
}

.meta-row {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    margin-top: .5rem;
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

.description {
    font-size: .88rem;
    color: var(--text-muted);
    line-height: 1.75;
    margin-top: 1rem;
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

.toggle-btn-container {
    display: flex;
    justify-content: center;
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

    .experience-section {
        padding: 3.5rem 1.25rem;
    }

    .timeline-item {
        gap: 1rem;
    }

    .timeline-card {
        padding: 1.25rem 1.35rem;
    }

    .timeline-card-header {
        flex-wrap: wrap;
    }

}


/* =================================
   MOTION SAFETY
================================= */

@media (prefers-reduced-motion: reduce) {
    .timeline-item,
    .timeline-dot,
    .timeline-dot.current,
    .timeline-line::after,
    .toggle-icon {
        animation: none !important;
        transition: none !important;
        opacity: 1 !important;
        transform: none !important;
    }
}
</style>