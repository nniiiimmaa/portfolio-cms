<template>

    <section id="hobbies" class="hobbies-section">

        <div class="section-header">
            <span class="section-label">{{ $t('publicHobby.eyebrow') }}</span>
            <h2 class="section-title">{{ $t('publicHobby.title') }}</h2>
        </div>

        <div class="hobbies-grid">
            <div
                v-for="(hobby, i) in visibleHobbies"
                :key="hobby.id"
                class="hobby-card"
                :style="{ '--i': i }"
                role="button"
                tabindex="0"
                @click="openDetails(hobby)"
                @keydown.enter="openDetails(hobby)"
            >
                <span v-if="hobby.featured" class="featured-star material-symbols-outlined">star</span>

                <div class="hobby-icon">
                    <i :class="hobby.icon"></i>
                </div>

                <h3 class="hobby-name">{{ nameOf(hobby) }}</h3>

                <span class="card-arrow material-symbols-outlined">arrow_forward</span>
            </div>
        </div>

        <button v-if="hasMore" class="toggle-btn" @click="expanded = !expanded">
            {{ expanded ? $t('publicHobby.showLess') : $t('publicHobby.showMore') }}
            <span class="material-symbols-outlined toggle-icon" :class="{ rotated: expanded }">
                expand_more
            </span>
        </button>

        <Dialog
            v-model:visible="detailsOpen"
            modal
            dismissable-mask
            class="hobby-dialog"
            :style="{ width: '36rem', maxWidth: '94vw' }"
            :pt="dialogPt"
        >
            <template #header>
                <div v-if="activeHobby" class="dialog-head">
                    <div class="dialog-icon">
                        <i :class="activeHobby.icon"></i>
                    </div>
                    <div class="dialog-head-text">
                        <h3 class="dialog-title">{{ nameOf(activeHobby) }}</h3>
                        <span v-if="activeHobby.featured" class="badge featured">
                            <span class="material-symbols-outlined">star</span>
                            {{ $t('publicHobby.featured') }}
                        </span>
                    </div>
                </div>
            </template>

            <template v-if="activeHobby">

                <!-- image gallery -->
                <div class="dialog-gallery">
                    <div v-if="activeHobby.images?.length" class="gallery-frame">
                        <img
                            :src="imageUrl(activeHobby.images[activeImageIndex])"
                            :alt="nameOf(activeHobby)"
                            class="gallery-image"
                        />

                        <template v-if="activeHobby.images.length > 1">
                            <button
                                type="button"
                                class="gallery-nav prev"
                                :aria-label="$t('publicHobby.previous_image')"
                                @click="prevImage"
                            >
                                <span class="material-symbols-outlined">chevron_left</span>
                            </button>
                            <button
                                type="button"
                                class="gallery-nav next"
                                :aria-label="$t('publicHobby.next_image')"
                                @click="nextImage"
                            >
                                <span class="material-symbols-outlined">chevron_right</span>
                            </button>

                            <span class="gallery-counter">
                                {{ activeImageIndex + 1 }} / {{ activeHobby.images.length }}
                            </span>

                            <div class="gallery-dots">
                                <button
                                    v-for="(img, idx) in activeHobby.images"
                                    :key="idx"
                                    type="button"
                                    class="gallery-dot"
                                    :class="{ active: idx === activeImageIndex }"
                                    :aria-label="`${$t('publicHobby.go_to_image')} ${idx + 1}`"
                                    @click="activeImageIndex = idx"
                                ></button>
                            </div>
                        </template>
                    </div>

                    <div v-else class="gallery-frame gallery-empty">
                        <div class="hobby-icon large">
                            <i :class="activeHobby.icon"></i>
                        </div>
                    </div>

                    <div v-if="activeHobby.images?.length > 1" class="gallery-thumbs">
                        <button
                            v-for="(img, idx) in activeHobby.images"
                            :key="idx"
                            type="button"
                            class="gallery-thumb"
                            :class="{ active: idx === activeImageIndex }"
                            @click="activeImageIndex = idx"
                        >
                            <img :src="imageUrl(img)" :alt="`${nameOf(activeHobby)} ${idx + 1}`" />
                        </button>
                    </div>
                </div>

                <p class="dialog-description">{{ descriptionOf(activeHobby) }}</p>

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
    hobbies: {
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
const visibleCount = 8

const detailsOpen = ref(false)
const activeHobby = ref(null)
const activeImageIndex = ref(0)

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
const sortedHobbies = computed(() =>
    [...props.hobbies].sort((a, b) => a.order - b.order)
)

const hasMore = computed(() => sortedHobbies.value.length > visibleCount)

const visibleHobbies = computed(() =>
    expanded.value ? sortedHobbies.value : sortedHobbies.value.slice(0, visibleCount)
)

// reset the carousel every time a different hobby is opened
watch(activeHobby, () => {
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
function openDetails(hobby) {
    activeHobby.value = hobby
    detailsOpen.value = true
}

function imageUrl(image) {
    return typeof image === 'string' ? image : image?.url ?? ''
}

function prevImage() {
    const total = activeHobby.value?.images?.length ?? 0
    if (!total) return
    activeImageIndex.value = (activeImageIndex.value - 1 + total) % total
}

function nextImage() {
    const total = activeHobby.value?.images?.length ?? 0
    if (!total) return
    activeImageIndex.value = (activeImageIndex.value + 1) % total
}

function handleGalleryKeydown(event) {
    if (event.key === 'ArrowLeft') prevImage()
    if (event.key === 'ArrowRight') nextImage()
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

function nameOf(hobby) {
    return pickTranslation(hobby.translations)?.name ?? ''
}

function descriptionOf(hobby) {
    return pickTranslation(hobby.translations)?.description ?? ''
}


// -----------------------------
// Hooks
// -----------------------------
onBeforeUnmount(() => {
    window.removeEventListener('keydown', handleGalleryKeydown)
})
</script>
<style scoped>
/* =================================
   SECTION
================================= */

.hobbies-section {
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
   CARD GRID — uniform icon + name cards,
   click any card for the full description + gallery
================================= */

.hobbies-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
    gap: 1.25rem;
}

.hobby-card {
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 1.5rem 1rem;
    height: 140px;
    cursor: pointer;
    overflow: hidden;

    animation: hobbyRise .55s cubic-bezier(.22, 1, .36, 1) calc(.06s * var(--i)) backwards;

    transition:
        transform var(--transition-normal),
        border-color var(--transition-normal),
        box-shadow var(--transition-normal);
}

@keyframes hobbyRise {
    from {
        opacity: 0;
        transform: translateY(16px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.hobby-card:hover {
    z-index: 2;
    transform: translateY(-4px) scale(1.04);
    border-color: var(--primary);
    box-shadow:
        0 20px 40px -18px rgba(0, 0, 0, .3),
        0 0 0 1px var(--primary),
        0 0 24px var(--glow);
}

.hobby-card:focus-visible {
    outline: 2px solid var(--primary);
    outline-offset: 3px;
}

.featured-star {
    position: absolute;
    top: .8rem;
    right: .8rem;
    font-size: 15px;
    color: var(--warning);
}

.hobby-icon {
    width: 46px;
    height: 46px;
    border-radius: var(--radius-sm);
    background: var(--tag-bg);
    color: var(--primary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 21px;
    margin-bottom: .9rem;
    transition: transform var(--transition-normal), box-shadow var(--transition-normal);
}

.hobby-card:hover .hobby-icon {
    transform: rotate(-6deg) scale(1.1);
    box-shadow: 0 0 14px var(--glow);
}

.hobby-name {
    font-size: .9rem;
    font-weight: var(--font-weight-semibold);
    color: var(--text);
    transition: color var(--transition-fast);
}

.hobby-card:hover .hobby-name {
    color: var(--primary);
}

.card-arrow {
    position: absolute;
    bottom: .8rem;
    right: .8rem;
    font-size: 15px;
    color: var(--primary);
    opacity: 0;
    transform: translate(-4px, 4px);
    transition: opacity var(--transition-fast), transform var(--transition-fast);
}

.hobby-card:hover .card-arrow {
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
    gap: 1rem;
}

.dialog-icon {
    width: 50px;
    height: 50px;
    flex-shrink: 0;
    border-radius: var(--radius-sm);
    background: var(--tag-bg);
    color: var(--primary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
}

.dialog-title {
    font-family: var(--font-heading);
    font-size: 1.12rem;
    font-weight: var(--font-weight-semibold);
    color: var(--text);
    margin-bottom: .4rem;
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

.dialog-description {
    font-size: .93rem;
    color: var(--text-muted);
    line-height: 1.8;
    margin-top: 1.5rem;
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

.hobby-icon.large {
    width: 72px;
    height: 72px;
    font-size: 2rem;
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
   RESPONSIVE
================================= */

@media (max-width: 640px) {

    .hobbies-section {
        padding: 3.5rem 1.25rem;
    }

    .hobbies-grid {
        grid-template-columns: repeat(auto-fit, minmax(130px, 1fr));
        gap: 1rem;
    }

    .hobby-card {
        height: 120px;
        padding: 1.25rem .8rem;
    }

}


/* =================================
   MOTION SAFETY
================================= */

@media (prefers-reduced-motion: reduce) {
    .hobby-card,
    .hobby-icon,
    .card-arrow,
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