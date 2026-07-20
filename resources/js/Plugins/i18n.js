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
import enPublicProject from '@/Lang/en/public/project.json'
import enPublicEducation from '@/Lang/en/public/education.json'
import enPublicCertification from '@/Lang/en/public/certification.json'
import enPublicSkill from '@/Lang/en/public/skill.json'
// import enDashboard from '@/Lang/en/dashboard.json'

// Portuguese
import ptAuth from '@/Lang/pt/auth.json'
import ptWelcome from '@/Lang/pt/welcome.json'
import ptLayout from '@/Lang/pt/layout.json'
import ptPublicAbout from '@/Lang/pt/public/about.json'
import ptPublicExperience from '@/Lang/pt/public/experience.json'
import ptPublicProject from '@/Lang/pt/public/project.json'
import ptPublicEducation from '@/Lang/pt/public/education.json'
import ptPublicCertification from '@/Lang/pt/public/certification.json'
import ptPublicSkill from '@/Lang/pt/public/skill.json'
// import ptDashboard from '@/Lang/pt/dashboard.json'

// Spanish
import esAuth from '@/Lang/es/auth.json'
import esWelcome from '@/Lang/es/welcome.json'
import esLayout from '@/Lang/es/layout.json'
import esPublicAbout from '@/Lang/es/public/about.json'
import esPublicExperience from '@/Lang/es/public/experience.json'
import esPublicProject from '@/Lang/es/public/project.json'
import esPublicEducation from '@/Lang/es/public/education.json'
import esPublicCertification from '@/Lang/es/public/certification.json'
import esPublicSkill from '@/Lang/es/public/skill.json'
// import esDashboard from '@/Lang/es/dashboard.json'

// Persian
import faAuth from '@/Lang/fa/auth.json'
import faWelcome from '@/Lang/fa/welcome.json'
import faLayout from '@/Lang/fa/layout.json'
import faPublicAbout from '@/Lang/fa/public/about.json'
import faPublicExperience from '@/Lang/fa/public/experience.json'
import faPublicProject from '@/Lang/fa/public/project.json'
import faPublicEducation from '@/Lang/fa/public/education.json'
import faPublicCertification from '@/Lang/fa/public/certification.json'
import faPublicSkill from '@/Lang/fa/public/skill.json'
// import faDashboard from '@/Lang/fa/dashboard.json'

// Turkish
import trAuth from '@/Lang/tr/auth.json'
import trWelcome from '@/Lang/tr/welcome.json'
import trLayout from '@/Lang/tr/layout.json'
import trPublicAbout from '@/Lang/tr/public/about.json'
import trPublicExperience from '@/Lang/tr/public/experience.json'
import trPublicProject from '@/Lang/tr/public/project.json'
import trPublicEducation from '@/Lang/tr/public/education.json'
import trPublicCertification from '@/Lang/tr/public/certification.json'
import trPublicSkill from '@/Lang/tr/public/skill.json'
// import trDashboard from '@/Lang/tr/dashboard.json'

// Arabic
import arAuth from '@/Lang/ar/auth.json'
import arWelcome from '@/Lang/ar/welcome.json'
import arLayout from '@/Lang/ar/layout.json'
import arPublicAbout from '@/Lang/ar/public/about.json'
import arPublicExperience from '@/Lang/ar/public/experience.json'
import arPublicProject from '@/Lang/ar/public/project.json'
import arPublicEducation from '@/Lang/ar/public/education.json'
import arPublicCertification from '@/Lang/ar/public/certification.json'
import arPublicSkill from '@/Lang/ar/public/skill.json'
// import arDashboard from '@/Lang/ar/dashboard.json'

// German
import deAuth from '@/Lang/de/auth.json'
import deWelcome from '@/Lang/de/welcome.json'
import deLayout from '@/Lang/de/layout.json'
import dePublicAbout from '@/Lang/de/public/about.json'
import dePublicExperience from '@/Lang/de/public/experience.json'
import dePublicProject from '@/Lang/de/public/project.json'
import dePublicEducation from '@/Lang/de/public/education.json'
import dePublicCertification from '@/Lang/de/public/certification.json'
import dePublicSkill from '@/Lang/de/public/skill.json'
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
        publicProject: enPublicProject,
        publicEducation: enPublicEducation,
        publicCertification: enPublicCertification,
        publicSkill: enPublicSkill,
        // dashboard: enDashboard,
    },

    pt: {
        auth: ptAuth,
        welcome: ptWelcome,
        layout: ptLayout,
        publicAbout: ptPublicAbout,
        publicExperienc: ptPublicExperience,
        publicProject: ptPublicProject,
        publicEducation: ptPublicEducation,
        publicCertification: ptPublicCertification,
        publicSkill: ptPublicSkill,
        // dashboard: ptDashboard,
    },

    es: {
        auth: esAuth,
        welcome: esWelcome,
        layout: esLayout,
        publicAbout: esPublicAbout,
        publicExperienc: esPublicExperience,
        publicProject: esPublicProject,
        publicEducation: esPublicEducation,
        publicCertification: esPublicCertification,
        publicSkill: esPublicSkill,
        // dashboard: esDashboard,
    },

    fa: {
        auth: faAuth,
        welcome: faWelcome,
        layout: faLayout,
        publicAbout: faPublicAbout,
        publicExperienc: faPublicExperience,
        publicProject: faPublicProject,
        publicEducation: faPublicEducation,
        publicCertification: faPublicCertification,
        publicSkill: faPublicSkill,
        // dashboard: faDashboard,
    },

    tr: {
        auth: trAuth,
        welcome: trWelcome,
        layout: trLayout,
        publicAbout: trPublicAbout,
        publicExperienc: trPublicExperience,
        publicProject: trPublicProject,
        publicEducation: trPublicEducation,
        publicCertification: trPublicCertification,
        publicSkill: trPublicSkill,
        // dashboard: trDashboard,
    },

    ar: {
        auth: arAuth,
        welcome: arWelcome,
        layout: arLayout,
        publicAbout: arPublicAbout,
        publicExperienc: arPublicExperience,
        publicProject: arPublicProject,
        publicEducation: arPublicEducation,
        publicCertification: arPublicCertification,
        publicSkill: arPublicSkill,
        // dashboard: arDashboard,
    },

    de: {
        auth: deAuth,
        welcome: deWelcome,
        layout: deLayout,
        publicAbout: dePublicAbout,
        publicExperienc: dePublicExperience,
        publicProject: dePublicProject,
        publicEducation: dePublicEducation,
        publicCertification: dePublicCertification,
        publicSkill: dePublicSkill,
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