// -----------------------------
// Imports
// -----------------------------

import { i18n } from "@/Plugins/i18n";
import { computed } from "vue";

// Constants
import { DEFAULT_LANGUAGE, Language } from "@/Constants/language";

import { getLocale } from '@/Utils/locale';
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
 *User opens website
 *        |
 *        ▼
 *Laravel receives request
 *        |
 *        ▼
 *Check if user already selected language?
 *        |
 *   ┌────┴────┐
 *   │         │
 * Yes        No
 *   │         │
 *   ▼         ▼
 * Use saved  Detect country
 * language   from request IP
 *             |
 *             ▼
 *        Convert country
 *        → supported language
 *             |
 *             ▼
 *        Fallback English
 *             |
 *             ▼
 *        Share locale with Inertia
 *             |
 *             ▼
 *        Vue i18n initializes
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
        const locale = getLocale(language);

        document.documentElement.lang = locale?.locale ?? language;
    }

    /**
     * Updates the document text direction.
     *
     * @param {string} language - Current language.
     * @returns {void}
     */
    function updateDocumentDirection(language) {
        const locale = getLocale(language);

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
        const locale = Object.values(Language).includes(language)
            ? language
            : DEFAULT_LANGUAGE;

        i18n.global.locale.value = language;

        window.axios.defaults.headers.common["X-Locale"] = language;

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
    function initializeLanguage(serverLanguage = null) {
        const savedLanguage = localStorage.getItem(
            LANGUAGE_STORAGE_KEY
        );


        setLanguage(
            savedLanguage
            ?? serverLanguage
            ?? DEFAULT_LANGUAGE
        );
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
