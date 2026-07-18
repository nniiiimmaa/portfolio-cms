<template>
    <PublicLayout title="Home" :socialLinks="props?.socialLinks">
        <!-- <pre>
            {{ props }}
        </pre> -->
        <About :about="props?.about" />
    </PublicLayout>
</template>

<script setup>
// -----------------------------
// Imports
// -----------------------------
import PublicLayout from '@/Layouts/Public/PublicLayout.vue';
import About from '@/Components/Public/About.vue';

// -----------------------------
// Props & Emits
// -----------------------------
const props = defineProps({
    about: Object,
    experiences: Array,
    projects: Array,
    education: Array,
    skillCategories: Array,
    certifications: Array,
    socialLinks: Array,
    testimonials: Array,
    contact: Object,
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

</style>