<template>

    <Head :title="$t('welcome.page_title')" />

    <div class="welcome-page">
        <Navbar />
        <main>
            <Hero />

            <Features />

            <Tech />

            <CTA />
        </main>

        <Footer />
    </div>

</template>
<script setup>
// -----------------------------
// Imports
// -----------------------------
import { Head, Link } from '@inertiajs/vue3'
import Navbar from '@/Components/Welcome/Navbar.vue'
import Hero from '@/Components/Welcome/Hero.vue'
import Footer from '@/Components/Welcome/Footer.vue'
import Features from '@/Components/Welcome/Features.vue'
import Tech from '@/Components/Welcome/Tech.vue'
import CTA from '@/Components/Welcome/CTA.vue'



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
    from {
        left: -120%;
    }

    to {
        left: 180%;
    }
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
   RESPONSIVE
================================= */

@media(max-width:640px) {
    main {
        padding: 2.5rem 1.2rem 0;
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

    .hero>* {
        opacity: 1;
        filter: none;
        transform: none;
    }
}
</style>