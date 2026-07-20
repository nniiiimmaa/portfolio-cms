<template>

    <section id="skills" class="skills-section">

        <div class="section-header">
            <span class="section-label">{{ $t('publicSkill.eyebrow') }}</span>
            <h2 class="section-title">{{ $t('publicSkill.title') }}</h2>
        </div>

        <div class="skills-categories">
            <div
                v-for="(cat, ci) in categoriesWithSkills"
                :key="cat.id"
                class="skill-group"
                :style="{ '--ci': ci }"
                role="button"
                tabindex="0"
                @click="openDetails(cat)"
                @keydown.enter="openDetails(cat)"
            >
                <div class="group-icon">
                    <span class="material-symbols-outlined">{{ iconFor(cat) }}</span>
                </div>

                <h3 class="group-title">{{ categoryName(cat) }}</h3>

                <span class="group-count">
                    {{ sortedSkills(cat).length }}
                    {{ $t('publicSkill.skill', sortedSkills(cat).length) }}
                </span>

                <span class="card-arrow material-symbols-outlined">arrow_forward</span>
            </div>
        </div>

        <Dialog
            v-model:visible="detailsOpen"
            modal
            dismissable-mask
            class="skills-dialog"
            :style="{ width: '30rem', maxWidth: '92vw' }"
            :pt="skillsDialogPt"
        >
            <template #header>
                <div v-if="activeCategory" class="dialog-head">
                    <span class="dialog-icon material-symbols-outlined">{{ iconFor(activeCategory) }}</span>
                    <h3 class="dialog-title">{{ categoryName(activeCategory) }}</h3>
                </div>
            </template>

            <div v-if="activeCategory" class="skill-list">
                <div
                    v-for="skill in sortedSkills(activeCategory)"
                    :key="skill.id"
                    class="skill-row"
                >
                    <div class="skill-row-top">
                        <span class="skill-name">
                            {{ skillName(skill) }}
                            <span v-if="skill.featured" class="material-symbols-outlined featured-star">
                                star
                            </span>
                        </span>
                        <span class="skill-level">{{ skill.level }}%</span>
                    </div>

                    <div class="skill-bar-track">
                        <div class="skill-bar-fill" :style="{ '--level': skill.level + '%' }"></div>
                    </div>

                    <span v-if="skill.years_experience" class="skill-years">
                        {{ skill.years_experience }}
                        {{ $t('publicSkill.year', skill.years_experience) }}
                    </span>
                </div>
            </div>
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
import { skillsDialogPt } from '@/PrimeVue/PT/dialog.pt'


// -----------------------------
// Props & Emits
// -----------------------------
const props = defineProps({
    categories: {
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
const detailsOpen = ref(false)
const activeCategory = ref(null)

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

// the category "icon" field holds a generic name, not a guaranteed
// Material Symbols ligature — map the known ones, fall back sensibly
const CATEGORY_ICON_MAP = {
    code: 'code',
    server: 'dns',
    database: 'database',
    tool: 'build',
    language: 'translate',
}


// -----------------------------
// Computed & Watch
// -----------------------------
const sortedCategories = computed(() =>
    [...props.categories].sort((a, b) => a.order - b.order)
)

// categories with no skills yet (e.g. "Languages" in the sample data)
// simply don't render — nothing to open in the dialog either
const categoriesWithSkills = computed(() =>
    sortedCategories.value.filter((cat) => cat.skills?.length)
)


// -----------------------------
// Methods
// -----------------------------
function openDetails(cat) {
    activeCategory.value = cat
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

// several skills in the sample data have no translations at all —
// fall back to a title-cased version of the slug ("sql-server" -> "Sql Server")
function titleFromSlug(slug) {
    if (!slug) return ''
    return slug
        .split('-')
        .map((word) => word.charAt(0).toUpperCase() + word.slice(1))
        .join(' ')
}

function categoryName(cat) {
    return pickTranslation(cat.translations)?.name ?? titleFromSlug(cat.slug)
}

function skillName(skill) {
    return pickTranslation(skill.translations)?.name ?? titleFromSlug(skill.slug)
}

function iconFor(cat) {
    return CATEGORY_ICON_MAP[cat.icon] ?? 'category'
}

function sortedSkills(cat) {
    return [...(cat.skills ?? [])].sort((a, b) => a.order - b.order)
}
</script>
<style scoped>
/* =================================
   SECTION
================================= */

.skills-section {
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
   CATEGORY GRID

   Cards deliberately show only icon + name + skill count, so every
   card is the same height regardless of how many skills the category
   actually has. Click any card to see the full list in the dialog.
================================= */

.skills-categories {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 1.25rem;
}

.skill-group {
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 1.5rem;
    height: 148px;
    cursor: pointer;
    overflow: hidden;

    animation: groupRise .55s cubic-bezier(.22, 1, .36, 1) calc(.08s * var(--ci)) backwards;

    transition:
        transform var(--transition-normal),
        border-color var(--transition-normal),
        box-shadow var(--transition-normal);
}

@keyframes groupRise {
    from {
        opacity: 0;
        transform: translateY(16px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.skill-group:hover {
    z-index: 2;
    transform: translateY(-4px) scale(1.02);
    border-color: var(--primary);
    box-shadow:
        0 20px 40px -18px rgba(0, 0, 0, .3),
        0 0 0 1px var(--primary),
        0 0 24px var(--glow);
}

.skill-group:focus-visible {
    outline: 2px solid var(--primary);
    outline-offset: 3px;
}

.group-icon {
    width: 40px;
    height: 40px;
    border-radius: var(--radius-sm);
    background: var(--tag-bg);
    color: var(--primary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 19px;
    flex-shrink: 0;
    margin-bottom: .9rem;
    transition: transform var(--transition-normal), box-shadow var(--transition-normal);
}

.skill-group:hover .group-icon {
    transform: rotate(-6deg) scale(1.08);
    box-shadow: 0 0 14px var(--glow);
}

.group-title {
    font-size: .92rem;
    font-weight: var(--font-weight-semibold);
    color: var(--text);
    margin-bottom: .3rem;
    transition: color var(--transition-fast);
}

.skill-group:hover .group-title {
    color: var(--primary);
}

.group-count {
    font-size: .78rem;
    color: var(--text-subtle);
}

.card-arrow {
    position: absolute;
    bottom: 1.1rem;
    right: 1.1rem;
    font-size: 17px;
    color: var(--primary);
    opacity: 0;
    transform: translate(-4px, 4px);
    transition: opacity var(--transition-fast), transform var(--transition-fast);
}

.skill-group:hover .card-arrow {
    opacity: 1;
    transform: translate(0, 0);
}


/* =================================
   SKILL ROWS (inside the dialog)
================================= */

.skill-list {
    display: flex;
    flex-direction: column;
    gap: 1.3rem;
}

.skill-row-top {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: .5rem;
}

.skill-name {
    display: inline-flex;
    align-items: center;
    gap: .35rem;
    font-size: .88rem;
    color: var(--text);
    font-weight: var(--font-weight-medium);
}

.featured-star {
    font-size: 14px;
    color: var(--warning);
}

.skill-level {
    font-size: .78rem;
    color: var(--text-subtle);
    font-family: var(--font-monospace);
}

.skill-bar-track {
    width: 100%;
    height: 6px;
    border-radius: 999px;
    background: var(--bg-3);
    overflow: hidden;
}

.skill-bar-fill {
    height: 100%;
    width: var(--level);
    border-radius: 999px;
    background: linear-gradient(90deg, var(--primary), var(--primary-light));
}

.skill-years {
    display: inline-block;
    margin-top: .4rem;
    font-size: .74rem;
    color: var(--text-subtle);
}


/* =================================
   DETAILS DIALOG
================================= */


.dialog-head {
    display: flex;
    align-items: center;
    gap: .8rem;
}

.dialog-icon {
    width: 44px;
    height: 44px;
    flex-shrink: 0;
    border-radius: var(--radius-sm);
    background: var(--tag-bg);
    color: var(--primary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 21px;
}

.dialog-title {
    font-family: var(--font-heading);
    font-size: 1.08rem;
    font-weight: var(--font-weight-semibold);
    color: var(--text);
}


/* =================================
   RESPONSIVE
================================= */

@media (max-width: 640px) {

    .skills-section {
        padding: 3.5rem 1.25rem;
    }

    .skills-categories {
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        gap: 1rem;
    }

    .skill-group {
        height: 132px;
        padding: 1.25rem;
    }

}


/* =================================
   MOTION SAFETY
================================= */

@media (prefers-reduced-motion: reduce) {
    .skill-group,
    .card-arrow {
        animation: none !important;
        transition: none !important;
        opacity: 1 !important;
        transform: none !important;
    }
}
</style>