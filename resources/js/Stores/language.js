// -----------------------------
// Imports
// -----------------------------

import { defineStore } from 'pinia';
import { ref } from 'vue';

// Constants
import {
    Language,
    DEFAULT_LANGUAGE,
} from '@/Constants/language';

/**
 * Language Store
 *
 * @module Stores/language
 * @description Stores and manages the application's current language.
 * 
 * Application Starts
 *        │
 *        ▼
 * Read saved language
 *       │
 *        ├── Exists
 *        │       │
 *        │       ▼
 *        │  Apply language
 *        │
 *        └── Doesn't exist
 *                │
 *                ▼
 *          Use default language
 *
 *                │
 *                ▼
 *
 *        Update Vue I18n
 *                │
 *                ▼
 *        Update Pinia Store
 *                │
 *                ▼
 *        Update HTML:
 *        lang="pt-BR"
 *        dir="ltr"
 *
 * @see {@link ../Composables/useLanguage.js}
 */
export const useLanguageStore = defineStore('language', () => {
    // -----------------------------
    // State
    // -----------------------------

    /**
     * Current application language.
     */
    const language = ref(DEFAULT_LANGUAGE);

    // -----------------------------
    // Actions
    // -----------------------------

    /**
     * Sets the current application language.
     *
     * @param {string} value - Language to apply.
     * @returns {void}
     */
    function setLanguage(value) {
        language.value = value;
    }

    // -----------------------------
    // Expose Public API
    // -----------------------------

    return {
        language,
        setLanguage,
    };
});