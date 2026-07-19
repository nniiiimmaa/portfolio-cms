// -----------------------------
// Imports
// -----------------------------

import { createI18n } from 'vue-i18n'

// Constants
import { DEFAULT_LANGUAGE } from '@/Constants/language'

// English
import enAuth from '@/Lang/en/auth.json'
import enWelcome from '@/Lang/en/welcome.json'
import enLayout from '@/Lang/en/layout.json'
import enPublicAbout from '@/Lang/en/public/about.json'
import enPublicExperience from '@/Lang/en/public/experience.json'
// import enDashboard from '@/Lang/en/dashboard.json'

// Portuguese
import ptAuth from '@/Lang/pt/auth.json'
import ptWelcome from '@/Lang/pt/welcome.json'
import ptLayout from '@/Lang/pt/layout.json'
import ptPublicAbout from '@/Lang/pt/public/about.json'
import ptPublicExperience from '@/Lang/pt/public/experience.json'
// import ptDashboard from '@/Lang/pt/dashboard.json'

// Spanish
import esAuth from '@/Lang/es/auth.json'
import esWelcome from '@/Lang/es/welcome.json'
import esLayout from '@/Lang/es/layout.json'
import esPublicAbout from '@/Lang/es/public/about.json'
import esPublicExperience from '@/Lang/es/public/experience.json'
// import esDashboard from '@/Lang/es/dashboard.json'

// Persian
import faAuth from '@/Lang/fa/auth.json'
import faWelcome from '@/Lang/fa/welcome.json'
import faLayout from '@/Lang/fa/layout.json'
import faPublicAbout from '@/Lang/fa/public/about.json'
import faPublicExperience from '@/Lang/fa/public/experience.json'
// import faDashboard from '@/Lang/fa/dashboard.json'

// Turkish
import trAuth from '@/Lang/tr/auth.json'
import trWelcome from '@/Lang/tr/welcome.json'
import trLayout from '@/Lang/tr/layout.json'
import trPublicAbout from '@/Lang/tr/public/about.json'
import trPublicExperience from '@/Lang/tr/public/experience.json'
// import trDashboard from '@/Lang/tr/dashboard.json'

// Arabic
import arAuth from '@/Lang/ar/auth.json'
import arWelcome from '@/Lang/ar/welcome.json'
import arLayout from '@/Lang/ar/layout.json'
import arPublicAbout from '@/Lang/ar/public/about.json'
import arPublicExperience from '@/Lang/ar/public/experience.json'
// import arDashboard from '@/Lang/ar/dashboard.json'

// German
import deAuth from '@/Lang/de/auth.json'
import deWelcome from '@/Lang/de/welcome.json'
import deLayout from '@/Lang/de/layout.json'
import dePublicAbout from '@/Lang/de/public/about.json'
import dePublicExperience from '@/Lang/de/public/experience.json'
// import deDashboard from '@/Lang/de/dashboard.json'

// -----------------------------
// Messages
// -----------------------------

const messages = {
    en: {
        auth: enAuth,
        welcome: enWelcome,
        layout: enLayout,
        publicAbout: enPublicAbout,
        publicExperienc: enPublicExperience,
        // dashboard: enDashboard,
    },

    pt: {
        auth: ptAuth,
        welcome: ptWelcome,
        layout: ptLayout,
        publicAbout: ptPublicAbout,
        publicExperienc: ptPublicExperience,
        // dashboard: ptDashboard,
    },

    es: {
        auth: esAuth,
        welcome: esWelcome,
        layout: esLayout,
        publicAbout: esPublicAbout,
        publicExperienc: esPublicExperience,
        // dashboard: esDashboard,
    },

    fa: {
        auth: faAuth,
        welcome: faWelcome,
        layout: faLayout,
        publicAbout: faPublicAbout,
        publicExperienc: faPublicExperience,
        // dashboard: faDashboard,
    },

    tr: {
        auth: trAuth,
        welcome: trWelcome,
        layout: trLayout,
        publicAbout: trPublicAbout,
        publicExperienc: trPublicExperience,
        // dashboard: trDashboard,
    },

    ar: {
        auth: arAuth,
        welcome: arWelcome,
        layout: arLayout,
        publicAbout: arPublicAbout,
        publicExperienc: arPublicExperience,
        // dashboard: arDashboard,
    },

    de: {
        auth: deAuth,
        welcome: deWelcome,
        layout: deLayout,
        publicAbout: dePublicAbout,
        publicExperienc: dePublicExperience,
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