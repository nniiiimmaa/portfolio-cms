<template>
    <span class="brand" :style="style" v-bind="$attrs">
        Nima
    </span>
</template>

<script setup>
import { computed } from 'vue';

const { size } = defineProps({
    size: {
        type: Number,
        default: 24,
    },
});

const style = computed(() => ({
    fontSize: `${size}px`,
}));
</script>

<style scoped>
.brand {
    color: var(--primary);
    font-family: var(--font-logo);
    font-weight: var(--font-weight-regular);
    font-style: normal;
}
</style>