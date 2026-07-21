<template>

    <Head :title="title" />

    <div class="public-layout">

        <Navbar />

        <!-- Body -->
        <main class="public-body">
            <slot />
        </main>

        <Footer :socialLinks="props?.socialLinks" />

         <ScrollTop />
         <Toast :pt="toastPt" />
    </div>

</template>
<script setup>
// -----------------------------
// Imports
// -----------------------------
import { Head } from '@inertiajs/vue3'
import Navbar from './_Navbar.vue'
import Footer from './_Footer.vue';
import ScrollTop from 'primevue/scrolltop'
import Toast from 'primevue/toast';
import { toastPt } from '@/PrimeVue/PT/toast.pt.js';

// -----------------------------
// Props & Emits
// -----------------------------
const props = defineProps({
    title: String,
    socialLinks: Array
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
    display: flex;
    flex-direction: column;
}


/* =================================
   BODY
================================= */

.public-body {
    flex: 1;
    position: relative;
    z-index: 1;
    padding: 2vh 5vw;
}

/* =================================
   MOTION SAFETY
================================= */

@media (prefers-reduced-motion: reduce) {

    .hamburger span,
    .mobile-drawer-backdrop,
    .mobile-drawer-panel,
    .drawer-link {
        transition-duration: .001ms !important;
    }
}
</style>