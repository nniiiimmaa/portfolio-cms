<template>
            <!-- Hero -->
            <section class="hero">
                <Tag :pt="tagPt" severity="danger" :value="$t('welcome.hero.eyebrow')" />
                <h1>{{ $t('welcome.hero.title') }}</h1>
                <p>{{ $t('welcome.hero.description') }}</p>
                <div class="hero-actions">
                    <Link :href="route('login')">
                        <Button :label="$t('welcome.login')" :pt="secondaryButtonPt" />
                    </Link>

                    <Link :href="route('register')">
                        <Button outlined :label="$t('welcome.register')" :pt="secondaryButtonPt" />
                    </Link>
                </div>
            </section>
</template>

<script setup>
// -----------------------------
// Imports
// -----------------------------
import { Link } from '@inertiajs/vue3'
import Tag from 'primevue/tag'
import Button from 'primevue/button'
import { secondaryButtonPt } from '@/PrimeVue/PT/button.pt'
import { tagPt } from '@/PrimeVue/PT/tag.pt';

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
.hero>* {
    opacity: 0;
    animation: rise .7s cubic-bezier(.22, 1, .36, 1) forwards;
}

.hero>*:nth-child(1) {
    animation-delay: .05s;
}

.hero>*:nth-child(2) {
    animation-delay: .15s;
}

.hero>*:nth-child(3) {
    animation-delay: .28s;
}

.hero>*:nth-child(4) {
    animation-delay: .4s;
}

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

    0%,
    100% {
        background-position: 0% 50%;
    }

    50% {
        background-position: 100% 50%;
    }
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
@keyframes pulseTag {

    0%,
    100% {
        box-shadow: 0 0 0 0 var(--glow);
    }

    50% {
        box-shadow: 0 0 0 6px transparent;
    }
}

/* =================================
   RESPONSIVE
================================= */

@media(max-width:640px) {
    .hero {
        padding-bottom: 3.5rem;
    }

    .hero h1 {
        font-size: 2.4rem;
    }

}
</style>