<template>
    <!-- <footer class="footer">
        <Divider />
        <div class="footer-inner">
            <Link :href="route('home.index')" class="nav-logo">
                <NavLogo />
            </Link>
            <div class="footer-socials">
                <a v-for="social in socialLinks" :key="social.name" :href="social.url" target="_blank"
                    rel="noopener noreferrer" class="social-icon" :aria-label="social.name">
                    <img :src="social.icon" :alt="social.name" />
                </a>
            </div>
        </div>
        <p class="footer-bottom">
            ©
            {{ new Date().getFullYear() }}
            -
            {{ $t('layout.public.footer') }}
        </p>
    </footer> -->
</template>

<script setup>
// -----------------------------
// Imports
// -----------------------------
import { Link } from '@inertiajs/vue3'
import Divider from 'primevue/divider'
import NavLogo from '@/Components/Shared/Logo/NavLogo.vue'

// -----------------------------
// Props & Emits
// -----------------------------
const props = defineProps({
    socialLinks: Array,
});

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
   FOOTER
================================= */

.footer {
    position: relative;
    z-index: 1;
    padding: 0 2rem 2rem;
}

:deep(.footer .p-divider) {
    margin: 0 0 1.5rem;
}

.footer-inner {
    max-width: 960px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1.5rem;
    flex-wrap: wrap;
}

.footer-socials {
    display: flex;
    align-items: center;
    gap: .6rem;
}

.social-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: var(--bg-3);
    border: 1px solid var(--border);
    transition:
        transform var(--transition-fast),
        border-color var(--transition-fast),
        box-shadow var(--transition-fast);
}

.social-icon img {
    width: 46%;
    height: auto;
}

.social-icon:hover {
    transform: translateY(-3px);
    border-color: var(--primary);
    box-shadow: 0 8px 18px -8px var(--glow);
}

.footer-bottom {
    max-width: 960px;
    margin: 1.5rem auto 0;
    text-align: center;
    font-size: .78rem;
    color: var(--text-subtle);
}

/* =================================
   RESPONSIVE
================================= */

@media (max-width: 1024px) {
    .footer {
        padding: 0 1.2rem 1.5rem;
    }

    .footer-inner {
        flex-direction: column;
        text-align: center;
    }

}
</style>