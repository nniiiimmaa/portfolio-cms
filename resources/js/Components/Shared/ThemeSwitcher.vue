<template>
    <ToggleButton
        v-model="isDarkMode"
        onLabel=""
        offLabel=""
        aria-label="Toggle theme"
        :pt="themeTogglePt"
    >

        <template #icon>

            <span>
                {{ isDarkMode ? '🌙' : '☀️' }}
            </span>

        </template>

    </ToggleButton>

</template>


<script setup>

// -----------------------------
// Imports
// -----------------------------

import { computed } from 'vue';
import ToggleButton from 'primevue/togglebutton';
import { useTheme } from '@/Composables/useTheme';
import { Theme } from '@/Constants/theme';
import { themeTogglePt } from '@/PrimeVue/PT/toggleButton.pt';


// -----------------------------
// Composables
// -----------------------------

const {
    currentTheme,
    toggleTheme,
} = useTheme();


// -----------------------------
// Computed
// -----------------------------

/**
 * Toggle state.
 *
 * @type {boolean}
 */
const isDarkMode = computed({

    get() {
        return currentTheme.value === Theme.DARK;
    },

    set() {
        toggleTheme();
    },

});

</script>