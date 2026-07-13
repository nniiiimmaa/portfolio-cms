// -----------------------------
// Imports
// -----------------------------

import { createI18n } from 'vue-i18n'

// Constants
import { DEFAULT_LANGUAGE } from '@/Constants/language'

// English
import enAuth from '@/Lang/en/auth.json'
// import enCommon from '@/Lang/en/common.json'
// import enDashboard from '@/Lang/en/dashboard.json'

// Portuguese
import ptAuth from '@/Lang/pt/auth.json'
// import ptCommon from '@/Lang/pt/common.json'
// import ptDashboard from '@/Lang/pt/dashboard.json'

// Spanish
import esAuth from '@/Lang/es/auth.json'
// import esCommon from '@/Lang/es/common.json'
// import esDashboard from '@/Lang/es/dashboard.json'

// Persian
import faAuth from '@/Lang/fa/auth.json'
// import faCommon from '@/Lang/fa/common.json'
// import faDashboard from '@/Lang/fa/dashboard.json'

// Turkish
import trAuth from '@/Lang/tr/auth.json'
// import trCommon from '@/Lang/tr/common.json'
// import trDashboard from '@/Lang/tr/dashboard.json'

// Arabic
import arAuth from '@/Lang/ar/auth.json'
// import arCommon from '@/Lang/ar/common.json'
// import arDashboard from '@/Lang/ar/dashboard.json'

// German
import deAuth from '@/Lang/de/auth.json'
// import deCommon from '@/Lang/de/common.json'
// import deDashboard from '@/Lang/de/dashboard.json'

// -----------------------------
// Messages
// -----------------------------

const messages = {
    en: {
        auth: enAuth,
        // common: enCommon,
        // dashboard: enDashboard,
    },

    pt: {
        auth: ptAuth,
        // common: ptCommon,
        // dashboard: ptDashboard,
    },

    es: {
        auth: esAuth,
        // common: esCommon,
        // dashboard: esDashboard,
    },

    fa: {
        auth: faAuth,
        // common: faCommon,
        // dashboard: faDashboard,
    },

    tr: {
        auth: trAuth,
        // common: trCommon,
        // dashboard: trDashboard,
    },

    ar: {
        auth: arAuth,
        // common: arCommon,
        // dashboard: arDashboard,
    },

    de: {
        auth: deAuth,
        // common: deCommon,
        // dashboard: deDashboard,
    },
}

// -----------------------------
// I18n
// -----------------------------

export const i18n = createI18n({
    legacy: false,
    locale: DEFAULT_LANGUAGE,
    fallbackLocale: DEFAULT_LANGUAGE,
    messages,
})

export default i18n