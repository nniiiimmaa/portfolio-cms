<template>
    <Navbar />

    <main v-bind="$attrs">
        <slot />
    </main>

    <Footer />

    <AppLoader />
</template>

<script setup>
// -----------------------------
// Imports
// -----------------------------
import Navbar from './_Navbar.vue';
import Footer from './_Footer.vue';
import AppLoader from '@/Components/Shared/Logo/AppLoader.vue';
</script>
<style scoped></style>