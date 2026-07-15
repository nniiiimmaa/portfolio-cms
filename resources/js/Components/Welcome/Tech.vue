<template>
            <!-- Technologies -->
            <section id="tech" class="technologies">
                <h2>{{ $t('welcome.sections.tech.title') }}</h2>
                <p>{{ $t('welcome.sections.tech.subtitle') }}</p>
                <div class="tech-stack">
                    <Chip v-for="tech in technologies" :key="tech" :label="tech" />
                </div>
            </section>
</template>

<script setup>
// -----------------------------
// Imports
// -----------------------------
import Chip from 'primevue/chip'

// -----------------------------
// Props & Emits
// -----------------------------

// -----------------------------
// Stores & Composables
// -----------------------------

// -----------------------------
// Provides & Injects
// -----------------------------

// -----------------------------
// Refs & Reactives & Vars
// -----------------------------
const technologies = [
    'Laravel 13',
    'Vue 3',
    'Inertia.js',
    'PrimeVue',
    'Pinia',
    'Vue I18n',
    'Tailwind CSS',
    'Vite',
]

// -----------------------------
// Computed & Watch
// -----------------------------

// -----------------------------
// Methods
// -----------------------------

// -----------------------------
// Hooks
// -----------------------------
</script>
<style scoped>
/* =================================
   TECHNOLOGIES
================================= */
.technologies {
    padding: 4rem 0 6rem;
}

.technologies h2 {
    font-size: 2rem;
    font-weight: var(--font-weight-bold);
    text-align: center;
}

.technologies>p {
    text-align: center;
    color: var(--text-muted);
    margin: 1rem auto 3rem;
}

.tech-stack {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: .875rem;
}

:deep(.p-chip) {
    background: var(--tag-bg);
    color: var(--tag-text);
    border: 1px solid var(--border);
    transition:
        transform var(--transition-fast),
        border-color var(--transition-fast),
        box-shadow var(--transition-fast);
}

:deep(.p-chip:hover) {
    transform: translateY(-3px) scale(1.05);
    border-color: var(--primary);
    box-shadow: 0 8px 18px -10px var(--glow);
}

/* =================================
   RESPONSIVE
================================= */

@media(max-width:640px) {
    .technologies {
        padding: 3rem 0 4rem;
    }

}
</style>