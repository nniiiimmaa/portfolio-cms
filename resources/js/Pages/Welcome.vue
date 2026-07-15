<template>

    <Head :title="$t('welcome.page_title')" />

    <div class="welcome-page">

        <!-- Navigation -->
        <nav class="navbar">
            <Toolbar class="navbar-toolbar">

                <template #start>
                    <Link :href="route('welcome')" class="nav-logo">
                        <NavLogo />
                    </Link>
                </template>

                <template #center>
                    <div class="nav-links">
                        <a href="#features">{{ $t('welcome.features') }}</a>
                        <a href="#tech">{{ $t('welcome.technologies') }}</a>
                    </div>
                </template>

                <template #end>
                    <div class="nav-actions">
                        <LanguageSwitcher />
                        <ThemeSwitcher />

                        <Link :href="route('login')">
                            <Button text :label="$t('welcome.login')" :pt="authButtonPt" />
                        </Link>
                        <Link :href="route('register')">
                            <Button :label="$t('welcome.register')" :pt="authButtonPt" />
                        </Link>
                    </div>
                </template>
            </Toolbar>
        </nav>


        <main>
            <!-- Hero -->
            <section class="hero">
                <Tag severity="contrast" :value="$t('welcome.hero.eyebrow')" />
                <h1>{{ $t('welcome.hero.title') }}</h1>
                <p>{{ $t('welcome.hero.description') }}</p>
                <div class="hero-actions">
                    <Link :href="route('login')">
                        <Button :label="$t('welcome.login')" :pt="authButtonPt" />
                    </Link>

                    <Link :href="route('register')">
                        <Button outlined :label="$t('welcome.register')" :pt="authButtonPt" />
                    </Link>
                </div>
            </section>

            <Divider />

            <!-- Features -->
            <section id="features" class="features">
                <h2>{{ $t('welcome.sections.features.title') }}</h2>
                <p>{{ $t('welcome.sections.features.subtitle') }}</p>
                <div class="feature-grid">
                    <Card v-for="card in featureCards" :key="card.title" class="feature-card">
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

            <Divider />

            <!-- Technologies -->
            <section id="tech" class="technologies">
                <h2>{{ $t('welcome.sections.tech.title') }}</h2>
                <p>{{ $t('welcome.sections.tech.subtitle') }}</p>
                <div class="tech-stack">
                    <Chip v-for="tech in technologies" :key="tech" :label="tech" />
                </div>
            </section>

            <Divider />

            <!-- CTA -->
            <section class="cta">
                <Card>
                    <template #content>
                        <h2>{{ $t('welcome.cta.title') }}</h2>
                        <p>{{ $t('welcome.cta.description') }}</p>
                        <div class="cta-actions">
                            <Link :href="route('login')">
                                <Button :label="$t('welcome.login')" :pt="authButtonPt" />
                            </Link>

                            <Link :href="route('register')">
                                <Button outlined :label="$t('welcome.register')" :pt="authButtonPt" />
                            </Link>
                        </div>
                    </template>
                </Card>
            </section>
        </main>

        <footer class="footer">
            <Divider />
            <p>{{ $t('welcome.footer') }}</p>
        </footer>
    </div>

</template>
<script setup>
// -----------------------------
// Imports
// -----------------------------
import { Head, Link } from '@inertiajs/vue3'
import NavLogo from '@/Components/Shared/Logo/NavLogo.vue'

import Toolbar from 'primevue/toolbar'
import Button from 'primevue/button'
import Card from 'primevue/card'
import Chip from 'primevue/chip'
import Divider from 'primevue/divider'
import Tag from 'primevue/tag'

import LanguageSwitcher from '@/Components/Shared/LanguageSwitcher.vue'
import ThemeSwitcher from '@/Components/Shared/ThemeSwitcher.vue'

import { authButtonPt } from '@/PrimeVue/PT/button.pt'


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
   PAGE
================================= */

.welcome-page {
    min-height: 100vh;
    background: var(--bg);
    color: var(--text);
    font-family: var(--font-primary);
    position: relative;
    overflow-x: hidden;
}

.welcome-page::before {
    content: "";
    position: fixed;
    inset: 0;
    z-index: 0;
    background:
        radial-gradient(circle at 15% 10%, var(--glow), transparent 45%),
        radial-gradient(circle at 85% 30%, var(--glow), transparent 40%);
    pointer-events: none;
    animation: drift 18s ease-in-out infinite alternate;
}

/* slow ambient drift so the glow never feels static */
@keyframes drift {
    0% {
        background-position: 0% 0%, 100% 0%;
        opacity: .85;
    }
    100% {
        background-position: 6% 8%, 92% 12%;
        opacity: 1;
    }
}


/* =================================
   NAVBAR
================================= */

.navbar {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 100;
}

:deep(.navbar-toolbar) {
    height: 64px;
    padding: 0 2rem;
    background: color-mix(in srgb, var(--bg) 85%, transparent);
    backdrop-filter: blur(16px);
    border: none;
    border-bottom: 1px solid var(--border);
    transition: border-color var(--transition-normal), background var(--transition-normal);
}

.nav-links {
    display: flex;
    gap: 2rem;
}

.nav-links a {
    position: relative;
    color: var(--text-muted);
    text-decoration: none;
    font-size: .9rem;
    transition: color var(--transition-fast);
}

/* animated underline sweeping in from the left */
.nav-links a::after {
    content: "";
    position: absolute;
    left: 0;
    bottom: -4px;
    width: 100%;
    height: 1px;
    background: var(--primary);
    transform: scaleX(0);
    transform-origin: left;
    transition: transform var(--transition-normal);
}

.nav-links a:hover {
    color: var(--primary);
}

.nav-links a:hover::after {
    transform: scaleX(1);
}

.nav-actions {
    display: flex;
    align-items: center;
    gap: .75rem;
}


/* =================================
   MAIN
================================= */

main {
    position: relative;
    z-index: 1;
    max-width: 960px;
    margin: auto;
    padding: 9.5rem 2rem 0;
}


/* =================================
   HERO
================================= */

.hero {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    padding-bottom: 5.5rem;
}

/* stagger every direct child of the hero in on load */
.hero > * {
    opacity: 0;
    animation: rise .7s cubic-bezier(.22, 1, .36, 1) forwards;
}

.hero > *:nth-child(1) { animation-delay: .05s; }
.hero > *:nth-child(2) { animation-delay: .15s; }
.hero > *:nth-child(3) { animation-delay: .28s; }
.hero > *:nth-child(4) { animation-delay: .4s; }

@keyframes rise {
    from {
        opacity: 0;
        transform: translateY(18px);
        filter: blur(6px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
        filter: blur(0);
    }
}

.hero h1 {
    margin-top: 1.75rem;
    margin-bottom: .25rem;
    max-width: 720px;
    font-family: var(--font-heading);
    font-size: clamp(2.5rem, 6vw, 4rem);
    font-weight: var(--font-weight-bold);
    line-height: 1.1;
    letter-spacing: -.03em;
    background: linear-gradient(100deg, var(--text) 40%, var(--primary) 55%, var(--text) 70%);
    background-size: 220% auto;
    background-position: 0% 50%;
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    animation:
        rise .7s cubic-bezier(.22, 1, .36, 1) forwards,
        shimmer 6s ease-in-out .8s infinite;
}

@keyframes shimmer {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
}

.hero p {
    max-width: 560px;
    margin: 1.25rem 0 2.5rem;
    color: var(--text-muted);
    line-height: 1.8;
}

.hero-actions {
    display: flex;
    gap: 15px;
}


/* =================================
   TAG
================================= */

:deep(.p-tag) {
    background: var(--tag-bg);
    color: var(--tag-text);
    border: 1px solid var(--border);
    border-radius: 999px;
    animation: pulseTag 2.4s ease-in-out infinite;
}

@keyframes pulseTag {
    0%, 100% { box-shadow: 0 0 0 0 var(--glow); }
    50% { box-shadow: 0 0 0 6px transparent; }
}


/* =================================
   BUTTONS
================================= */

:deep(.p-button) {
    position: relative;
    overflow: hidden;
    border-radius: 999px;
    padding: .7rem 1.6rem;
    font-weight: var(--font-weight-medium);
    transition:
        transform var(--transition-fast),
        box-shadow var(--transition-fast),
        background var(--transition-fast),
        border-color var(--transition-fast);
}

/* shine sweep on hover */
:deep(.p-button::before) {
    content: "";
    position: absolute;
    top: -120%;
    left: -120%;
    width: 60%;
    height: 300%;
    transform: rotate(25deg);
    background: linear-gradient(to right, transparent, rgba(255, 255, 255, .35), transparent);
    opacity: 0;
    transition: opacity .25s ease;
}

:deep(.p-button:hover::before) {
    opacity: 1;
    animation: shine .9s ease;
}

@keyframes shine {
    from { left: -120%; }
    to { left: 180%; }
}

:deep(.p-button:not(.p-button-outlined)) {
    background: var(--primary);
    border-color: var(--primary);
}

:deep(.p-button:not(.p-button-outlined):hover) {
    background: var(--primary-hover);
    border-color: var(--primary-hover);
    transform: translateY(-2px);
    box-shadow: 0 10px 24px -8px var(--glow);
}

:deep(.p-button:not(.p-button-outlined):active) {
    transform: translateY(0) scale(.97);
}

:deep(.p-button-outlined) {
    color: var(--text);
    border-color: var(--border-strong);
    background: transparent;
}

:deep(.p-button-outlined:hover) {
    border-color: var(--primary);
    background: var(--tag-bg);
    transform: translateY(-2px);
}

:deep(.p-button-outlined:active) {
    transform: translateY(0) scale(.97);
}


/* =================================
   DIVIDER
================================= */

:deep(.p-divider) {
    margin: 2rem 0;
}

:deep(.p-divider::before) {
    border-top-color: var(--border);
}


/* =================================
   FEATURES
================================= */

.features,
.technologies {
    padding: 4rem 0 6rem;
}

.features h2,
.technologies h2,
.cta h2 {
    font-size: 2rem;
    font-weight: var(--font-weight-bold);
    text-align: center;
}

.features>p,
.technologies>p {
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

:deep(.feature-card) {
    position: relative;
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 2rem 1.75rem;
    overflow: hidden;
    transition:
        transform var(--transition-normal),
        border-color var(--transition-normal),
        box-shadow var(--transition-normal);
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
   TECHNOLOGIES
================================= */

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
   CTA
================================= */

.cta {
    padding: 4rem 0 7rem;
}

:deep(.cta .p-card) {
    position: relative;
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 3.5rem 2.5rem;
    text-align: center;
    overflow: hidden;
    transition: border-color var(--transition-normal), box-shadow var(--transition-normal);
}

.cta h2 {
    margin-bottom: .75rem;
}

:deep(.cta .p-card > p) {
    max-width: 480px;
    margin: 0 auto 2rem;
    color: var(--text-muted);
}

:deep(.cta .p-card::before) {
    content: "";
    position: absolute;
    inset: 0;
    background: radial-gradient(circle, var(--glow), transparent 60%);
    opacity: .7;
    pointer-events: none;
    animation: ctaPulse 4s ease-in-out infinite;
}

@keyframes ctaPulse {
    0%, 100% { opacity: .5; transform: scale(1); }
    50% { opacity: .9; transform: scale(1.06); }
}

:deep(.cta .p-card:hover) {
    border-color: var(--primary);
    box-shadow: 0 20px 40px -22px var(--glow);
}

.cta-actions {
    display: flex;
    justify-content: center;
    gap: 1.25rem;
    flex-wrap: wrap;
    margin-top: 20px;
}


/* =================================
   FOOTER
================================= */

.footer {
    position: relative;
    z-index: 1;
    border-top: 1px solid var(--border);
    padding: 1.75rem 1.5rem;
    text-align: center;
    color: var(--text-muted);
    font-size: .85rem;
}


/* =================================
   RESPONSIVE
================================= */

@media(max-width:640px) {

    .navbar {
        position: sticky;
    }

    main {
        padding: 2.5rem 1.2rem 0;
    }

    :deep(.navbar-toolbar) {
        flex-wrap: wrap;
        height: auto;
        row-gap: .65rem;
        padding: .85rem 1rem;
    }

    :deep(.p-toolbar-start) {
        order: 1;
    }

    :deep(.p-toolbar-end) {
        order: 2;
        margin-left: auto;
    }

    :deep(.p-toolbar-center) {
        order: 3;
        width: 100%;
    }

    .nav-links {
        justify-content: center;
        flex-wrap: wrap;
        gap: 1.5rem;
        font-size: .85rem;
    }

    .nav-actions {
        gap: .4rem;
    }

    :deep(.nav-actions .p-button) {
        padding: .55rem 1rem;
        font-size: .85rem;
    }

    .hero {
        padding-bottom: 3.5rem;
    }

    .hero h1 {
        font-size: 2.4rem;
    }

    .features,
    .technologies {
        padding: 3rem 0 4rem;
    }

    .cta {
        padding: 2.5rem 0 4.5rem;
    }

    :deep(.cta .p-card) {
        padding: 2.5rem 1.5rem;
    }

    .feature-grid {
        gap: 1.25rem;
    }

}

@media(max-width:400px) {

    :deep(.nav-actions .p-button) {
        padding: .5rem .8rem;
        font-size: .8rem;
    }

    .nav-links {
        gap: 1rem;
        font-size: .8rem;
    }

}


/* =================================
   MOTION SAFETY
================================= */

@media (prefers-reduced-motion: reduce) {
    *,
    *::before,
    *::after {
        animation-duration: 0.001ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.001ms !important;
    }

    .hero > * {
        opacity: 1;
        filter: none;
        transform: none;
    }
}
</style>