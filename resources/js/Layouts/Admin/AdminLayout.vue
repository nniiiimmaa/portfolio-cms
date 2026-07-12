<template>
    <Sidebar />

    <main v-bind="$attrs" >
        <slot />
    </main>

    <AppLoader />
</template>

<script setup>
// -----------------------------
// Imports
// -----------------------------
import Sidebar from './_Sidebar.vue';
import AppLoader from '@/Components/Shared/Logo/AppLoader.vue';
</script>
<style scoped>

</style>