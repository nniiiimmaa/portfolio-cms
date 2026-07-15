<template>
    <!-- Features -->
    <section id="features" class="features">
        <h2>{{ $t('welcome.sections.features.title') }}</h2>
        <p>{{ $t('welcome.sections.features.subtitle') }}</p>
        <div class="feature-grid">
            <Card v-for="card in featureCards" :key="card.title" :pt="cardPt" class="feature-card">
                <template #content>
                    <span class="material-symbols-outlined">
                        {{ card.icon }}
                    </span>
                    <h3>{{ $t(card.title) }}</h3>
                    <p>{{ $t(card.description) }}</p>
                </template>
            </Card>
        </div>
    </section>
</template>

<script setup>
// -----------------------------
// Imports
// -----------------------------
import Card from 'primevue/card'
import { cardPt } from '@/PrimeVue/PT/card.pt';

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
const featureCards = [
    {
        icon: 'dashboard',
        title: 'welcome.cards.dashboard.title',
        description: 'welcome.cards.dashboard.description',
    },
    {
        icon: 'folder_open',
        title: 'welcome.cards.projects.title',
        description: 'welcome.cards.projects.description',
    },
    {
        icon: 'work',
        title: 'welcome.cards.experience.title',
        description: 'welcome.cards.experience.description',
    },
    {
        icon: 'school',
        title: 'welcome.cards.education.title',
        description: 'welcome.cards.education.description',
    },
    {
        icon: 'code',
        title: 'welcome.cards.skills.title',
        description: 'welcome.cards.skills.description',
    },
    {
        icon: 'mail',
        title: 'welcome.cards.messages.title',
        description: 'welcome.cards.messages.description',
    },
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
   FEATURES
================================= */

.features{
    padding: 4rem 0 6rem;
}

.features h2{
    font-size: 2rem;
    font-weight: var(--font-weight-bold);
    text-align: center;
}

.features>p {
    text-align: center;
    color: var(--text-muted);
    margin: 1rem auto 3rem;
}


/* =================================
   FEATURE CARDS
================================= */

.feature-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 1.5rem;
}

/* soft glow that only appears on hover, following the card's own radius */
:deep(.feature-card::after) {
    content: "";
    position: absolute;
    inset: 0;
    border-radius: inherit;
    background: radial-gradient(circle at 50% 0%, var(--glow), transparent 70%);
    opacity: 0;
    transition: opacity var(--transition-normal);
    pointer-events: none;
}

:deep(.feature-card:hover) {
    transform: translateY(-8px);
    border-color: var(--primary);
    box-shadow: 0 18px 34px -18px var(--glow);
}

:deep(.feature-card:hover::after) {
    opacity: 1;
}

.material-symbols-outlined {
    display: inline-flex;
    width: 42px;
    height: 42px;
    align-items: center;
    justify-content: center;
    border-radius: var(--radius-sm);
    background: var(--tag-bg);
    color: var(--primary);
    margin-bottom: 1.25rem;
    transition:
        transform var(--transition-normal),
        box-shadow var(--transition-normal);
}

:deep(.feature-card:hover) .material-symbols-outlined {
    transform: translateY(-3px) rotate(-6deg) scale(1.08);
    box-shadow: 0 0 16px var(--glow);
}

.feature-card h3 {
    color: var(--text);
    font-size: 1rem;
    margin-bottom: .5rem;
    transition: color var(--transition-fast);
}

.feature-card p {
    color: var(--text-muted);
    font-size: .9rem;
    line-height: 1.65;
}

/* =================================
   RESPONSIVE
================================= */

@media(max-width:640px) {
    .features {
        padding: 3rem 0 4rem;
    }

    .feature-grid {
        gap: 1.25rem;
    }

}
</style>