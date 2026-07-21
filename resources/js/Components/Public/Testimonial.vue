<template>
<!-- <pre>{{ testimonials }}</pre> -->
    <section id="testimonials" class="testimonials-section">

        <div class="section-header">
            <span class="section-label">{{ $t('publicTestimonial.eyebrow') }}</span>
            <h2 class="section-title">{{ $t('publicTestimonial.title') }}</h2>
        </div>

        <div class="testimonials-grid">
            <div
                v-for="(item, i) in visibleTestimonials"
                :key="item.id"
                class="testimonial-card"
                :style="{ '--i': i }"
                role="button"
                tabindex="0"
                @click="openDetails(item)"
                @keydown.enter="openDetails(item)"
            >
                <span v-if="item.featured" class="featured-star material-symbols-outlined">star</span>

                <div class="testimonial-avatar">
                    <img v-if="item.photo" :src="item.photo" :alt="nameOf(item)" />
                    <span v-else>{{ initials(nameOf(item)) }}</span>
                </div>

                <h3 class="testimonial-name">{{ nameOf(item) }}</h3>
                <p class="testimonial-role">
                    {{ positionOf(item) }}<span class="dot">·</span>{{ companyOf(item) }}
                </p>

                <div class="rating-row">
                    <span
                        v-for="n in 5"
                        :key="n"
                        class="material-symbols-outlined star"
                        :class="{ filled: n <= item.rating }"
                    >star</span>
                </div>

                <span class="card-arrow material-symbols-outlined">arrow_forward</span>
            </div>
        </div>

        <button v-if="hasMore" class="toggle-btn" @click="expanded = !expanded">
            {{ expanded ? $t('publicTestimonial.showLess') : $t('publicTestimonial.showMore') }}
            <span class="material-symbols-outlined toggle-icon" :class="{ rotated: expanded }">
                expand_more
            </span>
        </button>

        <Dialog
            v-model:visible="detailsOpen"
            modal
            dismissable-mask
            class="testimonial-dialog"
            :style="{ width: '32rem', maxWidth: '92vw' }"
            :pt="dialogPt"
        >
            <template #header>
                <div v-if="activeTestimonial" class="dialog-head">
                    <div class="dialog-avatar">
                        <img
                            v-if="activeTestimonial.photo"
                            :src="activeTestimonial.photo"
                            :alt="nameOf(activeTestimonial)"
                        />
                        <span v-else>{{ initials(nameOf(activeTestimonial)) }}</span>
                    </div>
                    <div class="dialog-head-text">
                        <h3 class="dialog-name">{{ nameOf(activeTestimonial) }}</h3>
                        <p class="dialog-role">
                            {{ positionOf(activeTestimonial) }}<span class="dot">·</span>{{ companyOf(activeTestimonial) }}
                        </p>
                    </div>
                    <div v-if="activeTestimonial.company_logo" class="dialog-company-logo">
                        <img :src="activeTestimonial.company_logo" :alt="companyOf(activeTestimonial)" />
                    </div>
                </div>
            </template>

            <template v-if="activeTestimonial">
                <div class="rating-row large">
                    <span
                        v-for="n in 5"
                        :key="n"
                        class="material-symbols-outlined star"
                        :class="{ filled: n <= activeTestimonial.rating }"
                    >star</span>
                </div>

                <p class="dialog-message">
                    <span class="quote-mark">“</span>{{ messageOf(activeTestimonial) }}<span class="quote-mark">”</span>
                </p>

                <div v-if="activeTestimonial.featured" class="badge featured">
                    <span class="material-symbols-outlined">star</span>
                    {{ $t('publicTestimonial.featured') }}
                </div>
            </template>
        </Dialog>

    </section>

</template>
<script setup>
// -----------------------------
// Imports
// -----------------------------
import { computed, ref } from 'vue'
import { useI18n } from 'vue-i18n'
import Dialog from 'primevue/dialog'
import { dialogPt } from '@/PrimeVue/PT/dialog.pt'


// -----------------------------
// Props & Emits
// -----------------------------
const props = defineProps({
    testimonials: {
        type: Array,
        default: () => [],
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
const visibleCount = 4

const detailsOpen = ref(false)
const activeTestimonial = ref(null)

// translations are keyed by numeric language_id, same seeded table used elsewhere
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
const sortedTestimonials = computed(() =>
    [...(props.testimonials ?? [])].sort((a, b) => a.order - b.order)
)

const hasMore = computed(() => sortedTestimonials.value.length > visibleCount)

const visibleTestimonials = computed(() =>
    expanded.value ? sortedTestimonials.value : sortedTestimonials.value.slice(0, visibleCount)
)


// -----------------------------
// Methods
// -----------------------------
function openDetails(item) {
    activeTestimonial.value = item
    detailsOpen.value = true
}

function pickTranslation(translations) {
    if (!translations?.length) return null

    const currentId = LOCALE_TO_LANGUAGE_ID[locale.value] ?? 1

    return (
        translations.find((tr) => tr.language_id === currentId) ||
        translations.find((tr) => tr.language_id === LOCALE_TO_LANGUAGE_ID.en) ||
        translations[0]
    )
}

function nameOf(item) {
    return pickTranslation(item.translations)?.name ?? ''
}

function positionOf(item) {
    return pickTranslation(item.translations)?.position ?? ''
}

function companyOf(item) {
    return pickTranslation(item.translations)?.company ?? ''
}

function messageOf(item) {
    return pickTranslation(item.translations)?.message ?? ''
}

function initials(name) {
    if (!name) return ''
    return name
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

.testimonials-section {
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
   CARD GRID — avatar, name, role, and rating
   only; the full quote lives in the dialog
================================= */

.testimonials-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 1.25rem;
}

.testimonial-card {
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 1.75rem 1.5rem;
    height: 190px;
    cursor: pointer;
    overflow: hidden;

    animation: cardRise .55s cubic-bezier(.22, 1, .36, 1) calc(.07s * var(--i)) backwards;

    transition:
        transform var(--transition-normal),
        border-color var(--transition-normal),
        box-shadow var(--transition-normal);
}

@keyframes cardRise {
    from {
        opacity: 0;
        transform: translateY(16px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.testimonial-card:hover {
    z-index: 2;
    transform: translateY(-4px) scale(1.03);
    border-color: var(--primary);
    box-shadow:
        0 20px 40px -18px rgba(0, 0, 0, .3),
        0 0 0 1px var(--primary),
        0 0 24px var(--glow);
}

.testimonial-card:focus-visible {
    outline: 2px solid var(--primary);
    outline-offset: 3px;
}

.featured-star {
    position: absolute;
    top: .9rem;
    right: .9rem;
    font-size: 15px;
    color: var(--warning);
}

.testimonial-avatar {
    width: 52px;
    height: 52px;
    border-radius: 50%;
    background: var(--tag-bg);
    color: var(--primary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: .85rem;
    font-weight: var(--font-weight-semibold);
    overflow: hidden;
    margin-bottom: .8rem;
    flex-shrink: 0;
    transition: transform var(--transition-normal), box-shadow var(--transition-normal);
}

.testimonial-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.testimonial-card:hover .testimonial-avatar {
    transform: scale(1.08);
    box-shadow: 0 0 14px var(--glow);
}

.testimonial-name {
    font-size: .92rem;
    font-weight: var(--font-weight-semibold);
    color: var(--text);
    margin-bottom: .25rem;
    transition: color var(--transition-fast);
}

.testimonial-card:hover .testimonial-name {
    color: var(--primary);
}

.testimonial-role {
    font-size: .76rem;
    color: var(--text-subtle);
    margin-bottom: .8rem;

    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 100%;
}

.testimonial-role .dot {
    margin: 0 .3rem;
}

.rating-row {
    display: flex;
    gap: .15rem;
}

.rating-row .star {
    font-size: 15px;
    color: var(--border-strong);
}

.rating-row .star.filled {
    color: var(--warning);
    font-variation-settings: 'FILL' 1;
}

.rating-row.large .star {
    font-size: 20px;
}

.card-arrow {
    position: absolute;
    bottom: .9rem;
    right: .9rem;
    font-size: 16px;
    color: var(--primary);
    opacity: 0;
    transform: translate(-4px, 4px);
    transition: opacity var(--transition-fast), transform var(--transition-fast);
}

.testimonial-card:hover .card-arrow {
    opacity: 1;
    transform: translate(0, 0);
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
    gap: .9rem;
}

.dialog-avatar {
    width: 54px;
    height: 54px;
    flex-shrink: 0;
    border-radius: 50%;
    background: var(--tag-bg);
    color: var(--primary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: .9rem;
    font-weight: var(--font-weight-semibold);
    overflow: hidden;
}

.dialog-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.dialog-head-text {
    min-width: 0;
    flex: 1;
}

.dialog-name {
    font-family: var(--font-heading);
    font-size: 1.05rem;
    font-weight: var(--font-weight-semibold);
    color: var(--text);
    margin-bottom: .25rem;
}

.dialog-role {
    font-size: .82rem;
    color: var(--primary);
    font-weight: var(--font-weight-medium);
}

.dialog-role .dot {
    margin: 0 .3rem;
    color: var(--text-subtle);
}

.dialog-company-logo {
    width: 40px;
    height: 40px;
    flex-shrink: 0;
    border-radius: var(--radius-sm);
    border: 1px solid var(--border);
    background: var(--bg-3);
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.dialog-company-logo img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.dialog-message {
    position: relative;
    font-size: 1rem;
    color: var(--text);
    line-height: 1.85;
    margin-top: 1.4rem;
}

.quote-mark {
    color: var(--primary);
    font-family: var(--font-heading);
    font-size: 1.3rem;
    font-weight: var(--font-weight-bold);
}

.badge {
    display: inline-flex;
    align-items: center;
    gap: .3rem;
    border-radius: 999px;
    padding: .25rem .7rem;
    font-size: .74rem;
    font-weight: var(--font-weight-medium);
    margin-top: 1.4rem;
}

.badge .material-symbols-outlined {
    font-size: 14px;
}

.badge.featured {
    background: rgba(217, 119, 6, .12);
    color: var(--warning);
}


/* =================================
   RESPONSIVE
================================= */

@media (max-width: 640px) {

    .testimonials-section {
        padding: 3.5rem 1.25rem;
    }

    .testimonials-grid {
        grid-template-columns: 1fr;
    }

    .testimonial-card:hover {
        transform: translateY(-2px) scale(1.01);
    }

}


/* =================================
   MOTION SAFETY
================================= */

@media (prefers-reduced-motion: reduce) {
    .testimonial-card,
    .testimonial-avatar,
    .card-arrow,
    .toggle-icon {
        animation: none !important;
        transition: none !important;
        opacity: 1 !important;
        transform: none !important;
    }
}
</style>