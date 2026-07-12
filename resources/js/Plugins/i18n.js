// -----------------------------
// Imports
// -----------------------------

import { createI18n } from 'vue-i18n';

// Constants
import { DEFAULT_LANGUAGE } from '@/Constants/language';

// Languages
import en from '../Lang/en.json';
import es from '../Lang/es.json';
import pt from '../Lang/pt.json';
import fa from '../Lang/fa.json';
import tr from '../Lang/tr.json';
import ar from '../Lang/ar.json';
import de from '../Lang/de.json';

// -----------------------------
// Messages
// -----------------------------

const messages = {
    en,
    es,
    pt,
    fa,
    tr,
    ar,
    de,
};

/**
 * Vue I18n Plugin
 *
 * @module Plugins/i18n
 * @description Configures the application's internationalization.
 *
 * @see {@link ../Constants/language.js}
 * @see {@link ../Constants/locales.js}
 */
export const i18n = createI18n({
    /**
     * Enables the Composition API.
     */
    legacy: false,

    /**
     * Default application language.
     */
    locale: DEFAULT_LANGUAGE,

    /**
     * Fallback language used when a translation is missing.
     */
    fallbackLocale: DEFAULT_LANGUAGE,

    /**
     * Registered application languages.
     */
    messages,
});

export default i18n;