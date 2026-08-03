<template>
    <!-- CTA -->
    <section class="cta">
        <Card :pt="cardPt">
            <template #content>
                <h2>{{ $t('welcome.cta.title') }}</h2>
                <p>{{ $t('welcome.cta.description') }}</p>
                <div class="cta-actions">
                    <Link :href="route('login')">
                        <Button :label="$t('welcome.login')" :pt="secondaryButtonPt" />
                    </Link>

                    <!-- <Link :href="route('register')">
                        <Button outlined :label="$t('welcome.register')" :pt="secondaryButtonPt" />
                    </Link> -->
                </div>
            </template>
        </Card>
    </section>
</template>

<script setup>
// -----------------------------
// Imports
// -----------------------------
import { Link } from '@inertiajs/vue3'
import Button from 'primevue/button'
import Card from 'primevue/card'
import { secondaryButtonPt } from '@/PrimeVue/PT/button.pt'
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
   CTA
================================= */
.cta {
    padding: 4rem 0 7rem;
}

.cta h2 {
    font-size: 2rem;
    font-weight: var(--font-weight-bold);
    text-align: center;
}

.cta p {
    text-align: center;
    color: var(--text-muted);
    margin: 1rem auto 3rem;
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

    0%,
    100% {
        opacity: .5;
        transform: scale(1);
    }

    50% {
        opacity: .9;
        transform: scale(1.06);
    }
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
   RESPONSIVE
================================= */

@media(max-width:640px) {
    .cta {
        padding: 2.5rem 0 4.5rem;
    }

    :deep(.cta .p-card) {
        padding: 2.5rem 1.5rem;
    }

}
</style>