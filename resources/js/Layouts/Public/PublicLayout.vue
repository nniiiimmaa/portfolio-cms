<template>

    <Head :title="title" />

    <div class="public-layout">

        <Navbar :navLinks="props.navLinks" />

        <!-- Body -->
        <main class="public-body">
            <slot />
        </main>

        <Footer :socialLinks="props.socialLinks" />

    </div>

</template>
<script setup>
// -----------------------------
// Imports
// -----------------------------
import { Head } from '@inertiajs/vue3'
import Navbar from './_Navbar.vue'
import Footer from './_Footer.vue';

// -----------------------------
// Props & Emits
// -----------------------------
const props = defineProps({
    title: {
        type: String,
        default: '',
    },
    navLinks: {
        type: Array,
        default: () => ([
            { label: 'layout.public.about', href: '#about' },
            { label: 'layout.public.experience', href: '#experience' },
            { label: 'layout.public.projects', href: '#projects' },
            { label: 'layout.public.education', href: '#education' },
            { label: 'layout.public.certificates', href: '#certificates' },
            { label: 'layout.public.skills', href: '#skills' },
            { label: 'layout.public.hobbies', href: '#hobbies' },
            { label: 'layout.public.testimonials', href: '#testimonials' },
            { label: 'layout.public.contact', href: '#contact' },
        ]),
    },
    socialLinks: {
        type: Array,
        default: () => ([
            { name: 'GitHub', url: 'https://github.com/nniiiimmaa', icon: '/images/icons/github.svg' },
            { name: 'LinkedIn', url: 'https://linkedin.com/in/nniiiimmaa', icon: '/images/icons/linkedin.svg' },
            { name: 'Instagram', url: 'https://instagram.com/nniiiimmaa', icon: '/images/icons/instagram.svg' },
            { name: 'Email', url: 'mailto:nima.javascript@gmail.com', icon: '/images/icons/mail.svg' },
        ]),
    },
});


// -----------------------------
// Stores & Composables
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

.public-layout {
    min-height: 100vh;
    background: var(--bg);
    color: var(--text);
    font-family: var(--font-primary);
    position: relative;
    overflow-x: hidden;
    display: flex;
    flex-direction: column;
}

/* =================================
   BUTTONS (shared shine treatment)
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


/* =================================
   BODY
================================= */

.public-body {
    flex: 1;
    position: relative;
    z-index: 1;
}

/* =================================
   MOTION SAFETY
================================= */

@media (prefers-reduced-motion: reduce) {

    .hamburger span,
    .mobile-drawer-backdrop,
    .mobile-drawer-panel,
    .drawer-link,
    :deep(.p-button) {
        transition-duration: .001ms !important;
    }
}
</style>