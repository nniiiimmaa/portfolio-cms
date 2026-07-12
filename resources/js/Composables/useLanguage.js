// -----------------------------
// Imports
// -----------------------------

import { i18n } from "@/Plugins/i18n";
import { computed } from "vue";

// Constants
import { DEFAULT_LANGUAGE, Language } from "@/Constants/language";

import { LOCALES } from "@/Constants/locales";
import { LANGUAGE_STORAGE_KEY } from "@/Constants/storage";

// Stores
import { useLanguageStore } from "@/Stores/language";

/**
 * Language Composable
 *
 * @module Composables/useLanguage
 * @description Manages application language operations.
 *
 * @flow
 * Application Language Flow
 *
 *        Application Starts
 *              │
 *              ▼
 *      Initialize Language
 *              │
 *              ▼
 *      Read localStorage
 *              │
 *        ┌─────┴─────┐
 *        │           │
 *     Exists      Not Found
 *        │           │
 *        ▼           ▼
 *   Saved Code   Default Language
 *        │           │
 *        └─────┬─────┘
 *              │
 *              ▼
 *       setLanguage()
 *              │
 *     ┌────────┼────────┐
 *     │        │        │
 *     ▼        ▼        ▼
 *  Vue I18n  Pinia   localStorage
 *     │        │        │
 *     ▼        ▼        ▼
 * Translation Current  Persist
 * Updates    Language  Preference
 *
 *              │
 *              ▼
 *      Update Document
 *              │
 *      ┌───────┴────────┐
 *      ▼                ▼
 *  html lang        html dir
 *  pt-BR            ltr
 *  fa-IR            rtl
 *
 * Component Usage
 *
 * LanguageSwitcher.vue
 *          │
 *          ▼
 *    useLanguage()
 *          │
 *          ▼
 *    Language Store
 *          │
 *          ▼
 *    Vue I18n + Document Settings
 *
 * @see {@link ../Stores/language.js}
 * @see {@link ../Plugins/i18n.js}
 * @see {@link ../Constants/locales.js}
 */
export function useLanguage() {
    // -----------------------------
    // Stores
    // -----------------------------

    const languageStore = useLanguageStore();

    // -----------------------------
    // Private Methods
    // -----------------------------

    /**
     * Updates the document language attribute.
     *
     * @param {string} language - Current language.
     * @returns {void}
     */
    function updateDocumentLanguage(language) {
        const locale = LOCALES.find((item) => item.code === language);

        document.documentElement.lang = locale?.locale ?? language;
    }

    /**
     * Updates the document text direction.
     *
     * @param {string} language - Current language.
     * @returns {void}
     */
    function updateDocumentDirection(language) {
        const locale = LOCALES.find((item) => item.code === language);

        document.documentElement.dir = locale?.rtl ? "rtl" : "ltr";
    }

    // -----------------------------
    // Public Methods
    // -----------------------------

    /**
     * Applies the selected application language.
     *
     * @param {string} language - Language to apply.
     * @returns {void}
     */
    function setLanguage(language) {
        i18n.global.locale.value = language;

        languageStore.setLanguage(language);

        localStorage.setItem(LANGUAGE_STORAGE_KEY, language);

        updateDocumentLanguage(language);

        updateDocumentDirection(language);
    }

    /**
     * Initializes the application language.
     *
     * @returns {void}
     */
    function initializeLanguage() {
        const savedLanguage = localStorage.getItem(LANGUAGE_STORAGE_KEY);

        setLanguage(savedLanguage ?? DEFAULT_LANGUAGE);
    }

    // -----------------------------
    // Computed
    // -----------------------------

    /**
     * Current application language.
     *
     * @type {string}
     */
    const currentLanguage = computed(() => {
        return languageStore.language;
    });

    // -----------------------------
    // Expose Public API
    // -----------------------------

    return {
        currentLanguage,
        initializeLanguage,
        setLanguage,
    };
}
