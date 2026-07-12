// -----------------------------
// Imports
// -----------------------------

import { ref } from 'vue';
import { defineStore } from 'pinia';

// Constants
import { Theme } from '@/Constants/theme';

/**
 * Theme Store
 *
 * @module Stores/theme
 * @description Stores and manages the application's current theme.
 *
 * @see {@link ../Composables/useTheme.js}
 */
export const useThemeStore = defineStore('theme', () => {
    // -----------------------------
    // State
    // -----------------------------

    /**
     * Current application theme.
     *
     * @type {string}
     */
    const theme = ref(Theme.LIGHT);

    // -----------------------------
    // Actions
    // -----------------------------

    /**
     * Sets the current application theme.
     *
     * @param {string} value - Theme to apply.
     * @returns {void}
     */
    function setTheme(value) {
        theme.value = value;
    }

    /**
     * Toggles the application theme.
     *
     * @returns {void}
     */
    function toggleTheme() {
        theme.value = theme.value === Theme.LIGHT
            ? Theme.DARK
            : Theme.LIGHT;
    }

    // -----------------------------
    // Expose
    // -----------------------------

    return {
        theme,
        setTheme,
        toggleTheme,
    };
});