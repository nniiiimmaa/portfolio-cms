<template>
    <Link href="/" class="flex items-center gap-2">
        <Logo :size="50" />
        <Brand :size="30" />
    </Link>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import Logo from '@/Components/Shared/Logo/Logo.vue';
import Brand from '@/Components/Shared/Logo/Brand.vue';
</script>
<style scoped></style>