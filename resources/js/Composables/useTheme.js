// -----------------------------
// Imports
// -----------------------------

import { computed } from "vue";

// Constants
import { Theme } from "@/Constants/theme";
import { THEME_STORAGE_KEY } from "@/Constants/storage";

// Stores
import { useThemeStore } from "@/Stores/theme";

/**
 * Theme Composable
 *
 * @module Composables/useTheme
 * @description Manages application theme operations.
 *
 * @flow
 *
 *        Application Starts
 *              │
 *              ▼
 *      Initialize Theme
 *              │
 *              ▼
 *      Read localStorage
 *              │
 *        ┌─────┴─────┐
 *        │           │
 *     Exists      Not Found
 *        │           │
 *        ▼           ▼
 *  Saved Theme   System Preference
 *        │           │
 *        └─────┬─────┘
 *              │
 *              ▼
 *        applyTheme()
 *              │
 *      ┌───────┼────────┐
 *      │       │        │
 *      ▼       ▼        ▼
 *  Document  Pinia   localStorage
 *  Class     Store   Persistence
 *      │       │        │
 *      ▼       ▼        ▼
 *  .dark    Current   Saved
 *  class    Theme    Theme
 *
 *
 * User Interaction
 *
 *      ThemeSwitcher.vue
 *              │
 *              ▼
 *          useTheme()
 *              │
 *              ▼
 *        toggleTheme()
 *              │
 *              ▼
 *        applyTheme()
 *              │
 *              ▼
 *   Update Application Theme
 *
 *
 * Theme Integration
 *
 *  Document class
 *        │
 *        ▼
 *  CSS Variables + PrimeVue Theme
 *
 * @see {@link ../Stores/theme.js}
 * @see {@link ../PrimeVue/preset.js}
 */
export function useTheme() {
    // -----------------------------
    // Stores
    // -----------------------------

    const themeStore = useThemeStore();

    // -----------------------------
    // Private Methods
    // -----------------------------

    /**
     * Updates the document theme.
     *
     * @param {string} theme - Theme to apply.
     * @returns {void}
     */
    function updateDocumentTheme(theme) {
        document.documentElement.classList.toggle(
            Theme.DARK,
            theme === Theme.DARK,
        );
    }

    // -----------------------------
    // Public Methods
    // -----------------------------

    /**
     * Applies the selected application theme.
     *
     * @param {string} theme - Theme to apply.
     * @returns {void}
     */
    function applyTheme(theme) {
        updateDocumentTheme(theme);

        themeStore.setTheme(theme);

        localStorage.setItem(THEME_STORAGE_KEY, theme);
    }

    /**
     * Initializes the application theme.
     *
     * @description
     * Loads the saved theme from localStorage or,
     * if unavailable, falls back to the user's
     * system preference.
     *
     * @returns {void}
     */
    function initializeTheme() {

        const savedTheme = localStorage.getItem(
            THEME_STORAGE_KEY,
        );

        if (savedTheme) {
            applyTheme(savedTheme);

            return;
        }

        const prefersDark = window.matchMedia(
            "(prefers-color-scheme: dark)",
        ).matches;

        applyTheme(
            prefersDark ? Theme.DARK : Theme.LIGHT,
        );
    }

    /**
     * Toggles the application theme.
     *
     * @returns {void}
     */
    function toggleTheme() {
        applyTheme(themeStore.theme === Theme.LIGHT ? Theme.DARK : Theme.LIGHT);
    }

    // -----------------------------
    // computed
    // -----------------------------

    /**
     * Current application theme.
     *
     * @type {string}
     */
    const currentTheme = computed(() => {
        return themeStore.theme;
    });

    // -----------------------------
    // Expose
    // -----------------------------

    return {
        applyTheme,
        initializeTheme,
        toggleTheme,
        currentTheme,
    };
}

/*
 Application Starts
         │
         ▼
 Read localStorage
         │
         ├── Exists → Use saved theme
         │
         └── Doesn't exist
                 │
                 ▼
       Read system preference
                 │
                 ▼
         Apply theme
                 │
                 ▼
       Update Theme Store
*/
