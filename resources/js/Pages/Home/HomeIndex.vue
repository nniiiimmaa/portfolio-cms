<template>
    <PublicLayout :title="$t('layout.public.home')" :socialLinks="props?.socialLinks">
        <pre>
            <!-- {{ props.projects }} -->
        </pre>
        <About :about="props?.about" />
        <Experience :experiences="props?.experiences" />
        <Project :projects="props?.projects" />
    </PublicLayout>
</template>

<script setup>
// -----------------------------
// Imports
// -----------------------------
import PublicLayout from '@/Layouts/Public/PublicLayout.vue';
import About from '@/Components/Public/About.vue';
import Experience from '@/Components/Public/Experience.vue';
import Project from '@/Components/Public/Project.vue';

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