<template>

    <Head :title="title" />

    <div class="admin-layout">

        <!-- Sidebar -->
        <Sidebar />
        <!-- Main -->
        <div class="admin-main">

            <header class="admin-topbar">
                <button class="sidebar-toggle" @click="sidebarStore.openSidebar()" aria-label="Open menu">
                    <span class="material-symbols-outlined">menu</span>
                </button>
                <h1 class="page-title">
                    <slot name="title">{{ title }}</slot>
                </h1>
            </header>

            <main v-bind="$attrs" class="admin-content">
                <slot />
            </main>

        </div>

    </div>

    <Toast />
    <AppLoader />
</template>

<script setup>
// -----------------------------
// Imports
// -----------------------------
import Sidebar from './_Sidebar.vue';
import AppLoader from '@/Components/Shared/Logo/AppLoader.vue';
import { Head } from '@inertiajs/vue3'
import { useSidebarStore } from '@/Stores/sibebar.js';
import Toast from 'primevue/toast'
// import { toastPt } from '@/PrimeVue/PT/toast.pt.js';

// -----------------------------
// Props & Emits
// -----------------------------
const props = defineProps({
    title: {
        type: String,
        default: '',
    },
})


// -----------------------------
// Stores & Composables
// -----------------------------
const sidebarStore = useSidebarStore()

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
   LAYOUT SHELL
================================= */

.admin-layout {
    min-height: 100vh;
    background: var(--bg);
    color: var(--text);
    font-family: var(--font-primary);
    display: flex;
}

/* =================================
   MAIN
================================= */

.admin-main {
    flex: 1;
    min-width: 0;
    margin-left: 264px;
    display: flex;
    flex-direction: column;
}

.admin-topbar {
    position: sticky;
    top: 0;
    z-index: 90;
    display: flex;
    align-items: center;
    gap: 1rem;
    height: 64px;
    padding: 0 2rem;
    background: color-mix(in srgb, var(--bg) 85%, transparent);
    backdrop-filter: blur(16px);
    border-bottom: 1px solid var(--border);
}

.sidebar-toggle {
    display: none;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    border: 1px solid var(--border);
    border-radius: var(--radius-sm);
    background: var(--bg-3);
    color: var(--text-muted);
    cursor: pointer;
    flex-shrink: 0;
    transition: border-color var(--transition-fast), color var(--transition-fast);
}

.sidebar-toggle:hover {
    border-color: var(--border-strong);
    color: var(--text);
}

.page-title {
    font-family: var(--font-heading);
    font-size: 1.15rem;
    font-weight: var(--font-weight-semibold);
    letter-spacing: -.01em;
}

.admin-content {
    flex: 1;
    padding: 2rem;
}


/* =================================
   RESPONSIVE
================================= */

@media (max-width: 960px) {
    .admin-main {
        margin-left: 0;
    }

    .sidebar-toggle {
        display: flex;
    }


    .admin-content {
        padding: 1.5rem 1.2rem;
    }

}


/* =================================
   MOTION SAFETY
================================= */

@media (prefers-reduced-motion: reduce) {

    .sidebar,
    .sidebar-link,
    .sidebar-link .material-symbols-outlined,
    .sidebar-backdrop,
    .sidebar-user,
    .sidebar-toggle,
    .sidebar-close,
    .user-logout {
        transition-duration: .001ms !important;
    }
}
</style>