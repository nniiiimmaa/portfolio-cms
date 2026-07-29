<template>
    <footer class="footer">
        <p>
            ©
            {{ new Date().getFullYear() }}
            -
            {{ $t('welcome.footer') }}
        </p>
    </footer>
</template>

<script setup>
// -----------------------------
// Imports
// -----------------------------
import Divider from 'primevue/divider'

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
</style>