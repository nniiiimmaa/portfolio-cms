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
import enPublicHobby from '@/Lang/en/public/hobby.json'
import enPublicTestimonial from '@/Lang/en/public/testimonial.json'
import enPublicContact from '@/Lang/en/public/contact.json'
import enPublicCv from '@/Lang/en/public/cv.json'
import enAdminProfile from '@/Lang/en/admin/profile.json'
import enAdminAbout from '@/Lang/en/admin/about.json'
import enAdminExperience from '@/Lang/en/admin/experience.json'
import enAdminProject from '@/Lang/en/admin/project.json'
import enAdminEducation from '@/Lang/en/admin/education.json'
import enAdminCertification from '@/Lang/en/admin/certification.json'
import enAdminSkill from '@/Lang/en/admin/skill.json'
import enAdminHobby from '@/Lang/en/admin/hobby.json'
import enAdminContact from '@/Lang/en/admin/contact.json'
import enAdminTestimonial from '@/Lang/en/admin/testimonial.json'
import enAdminMedia from '@/Lang/en/admin/media.json'
import enAdminMessage from '@/Lang/en/admin/message.json'
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
import ptPublicHobby from '@/Lang/pt/public/hobby.json'
import ptPublicTestimonial from '@/Lang/pt/public/testimonial.json'
import ptPublicContact from '@/Lang/pt/public/contact.json'
import ptPublicCv from '@/Lang/pt/public/cv.json'
import ptAdminProfile from '@/Lang/pt/admin/profile.json'
import ptAdminAbout from '@/Lang/pt/admin/about.json'
import ptAdminExperience from '@/Lang/pt/admin/experience.json'
import ptAdminProject from '@/Lang/pt/admin/project.json'
import ptAdminEducation from '@/Lang/pt/admin/education.json'
import ptAdminCertification from '@/Lang/pt/admin/certification.json'
import ptAdminSkill from '@/Lang/pt/admin/skill.json'
import ptAdminHobby from '@/Lang/pt/admin/hobby.json'
import ptAdminContact from '@/Lang/pt/admin/contact.json'
import ptAdminTestimonial from '@/Lang/pt/admin/testimonial.json'
import ptAdminMedia from '@/Lang/pt/admin/media.json'
import ptAdminMessage from '@/Lang/pt/admin/message.json'
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
import esPublicHobby from '@/Lang/es/public/hobby.json'
import esPublicTestimonial from '@/Lang/es/public/testimonial.json'
import esPublicContact from '@/Lang/es/public/contact.json'
import esPublicCv from '@/Lang/es/public/cv.json'
import esAdminProfile from '@/Lang/es/admin/profile.json'
import esAdminAbout from '@/Lang/es/admin/about.json'
import esAdminExperience from '@/Lang/es/admin/experience.json'
import esAdminProject from '@/Lang/es/admin/project.json'
import esAdminEducation from '@/Lang/es/admin/education.json'
import esAdminCertification from '@/Lang/es/admin/certification.json'
import esAdminSkill from '@/Lang/es/admin/skill.json'
import esAdminHobby from '@/Lang/es/admin/hobby.json'
import esAdminContact from '@/Lang/es/admin/contact.json'
import esAdminTestimonial from '@/Lang/es/admin/testimonial.json'
import esAdminMedia from '@/Lang/es/admin/media.json'
import esAdminMessage from '@/Lang/es/admin/message.json'
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
import faPublicHobby from '@/Lang/fa/public/hobby.json'
import faPublicTestimonial from '@/Lang/fa/public/testimonial.json'
import faPublicContact from '@/Lang/fa/public/contact.json'
import faPublicCv from '@/Lang/fa/public/cv.json'
import faAdminProfile from '@/Lang/fa/admin/profile.json'
import faAdminAbout from '@/Lang/fa/admin/about.json'
import faAdminExperience from '@/Lang/fa/admin/experience.json'
import faAdminProject from '@/Lang/fa/admin/project.json'
import faAdminEducation from '@/Lang/fa/admin/education.json'
import faAdminCertification from '@/Lang/fa/admin/certification.json'
import faAdminSkill from '@/Lang/fa/admin/skill.json'
import faAdminHobby from '@/Lang/fa/admin/hobby.json'
import faAdminContact from '@/Lang/fa/admin/contact.json'
import faAdminTestimonial from '@/Lang/fa/admin/testimonial.json'
import faAdminMedia from '@/Lang/fa/admin/media.json'
import faAdminMessage from '@/Lang/fa/admin/message.json'
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
import trPublicHobby from '@/Lang/tr/public/hobby.json'
import trPublicTestimonial from '@/Lang/tr/public/testimonial.json'
import trPublicContact from '@/Lang/tr/public/contact.json'
import trPublicCv from '@/Lang/tr/public/cv.json'
import trAdminProfile from '@/Lang/tr/admin/profile.json'
import trAdminAbout from '@/Lang/tr/admin/about.json'
import trAdminExperience from '@/Lang/tr/admin/experience.json'
import trAdminProject from '@/Lang/tr/admin/project.json'
import trAdminEducation from '@/Lang/tr/admin/education.json'
import trAdminCertification from '@/Lang/tr/admin/certification.json'
import trAdminSkill from '@/Lang/tr/admin/skill.json'
import trAdminHobby from '@/Lang/tr/admin/hobby.json'
import trAdminContact from '@/Lang/tr/admin/contact.json'
import trAdminTestimonial from '@/Lang/tr/admin/testimonial.json'
import trAdminMedia from '@/Lang/tr/admin/media.json'
import trAdminMessage from '@/Lang/tr/admin/message.json'
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
import arPublicHobby from '@/Lang/ar/public/hobby.json'
import arPublicTestimonial from '@/Lang/ar/public/testimonial.json'
import arPublicContact from '@/Lang/ar/public/contact.json'
import arPublicCv from '@/Lang/ar/public/cv.json'
import arAdminProfile from '@/Lang/ar/admin/profile.json'
import arAdminAbout from '@/Lang/ar/admin/about.json'
import arAdminExperience from '@/Lang/ar/admin/experience.json'
import arAdminProject from '@/Lang/ar/admin/project.json'
import arAdminEducation from '@/Lang/ar/admin/education.json'
import arAdminCertification from '@/Lang/ar/admin/certification.json'
import arAdminSkill from '@/Lang/ar/admin/skill.json'
import arAdminHobby from '@/Lang/ar/admin/hobby.json'
import arAdminContact from '@/Lang/ar/admin/contact.json'
import arAdminTestimonial from '@/Lang/ar/admin/testimonial.json'
import arAdminMedia from '@/Lang/ar/admin/media.json'
import arAdminMessage from '@/Lang/ar/admin/message.json'
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
import dePublicHobby from '@/Lang/de/public/hobby.json'
import dePublicTestimonial from '@/Lang/de/public/testimonial.json'
import dePublicContact from '@/Lang/de/public/contact.json'
import dePublicCv from '@/Lang/de/public/cv.json'
import deAdminProfile from '@/Lang/de/admin/profile.json'
import deAdminAbout from '@/Lang/de/admin/about.json'
import deAdminExperience from '@/Lang/de/admin/experience.json'
import deAdminProject from '@/Lang/de/admin/project.json'
import deAdminEducation from '@/Lang/de/admin/education.json'
import deAdminCertification from '@/Lang/de/admin/certification.json'
import deAdminSkill from '@/Lang/de/admin/skill.json'
import deAdminHobby from '@/Lang/de/admin/hobby.json'
import deAdminContact from '@/Lang/de/admin/contact.json'
import deAdminTestimonial from '@/Lang/de/admin/testimonial.json'
import deAdminMedia from '@/Lang/de/admin/media.json'
import deAdminMessage from '@/Lang/de/admin/message.json'
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
        publicHobby: enPublicHobby,
        publicTestimonial: enPublicTestimonial,
        publicContact: enPublicContact,
        publicCv: enPublicCv,
        adminProfile: enAdminProfile,
        adminAbout: enAdminAbout,
        adminExperience: enAdminExperience,
        adminProject: enAdminProject,
        adminEducation: enAdminEducation,
        adminCertification: enAdminCertification,
        adminSkill: enAdminSkill,
        adminHobby: enAdminHobby,
        adminContact: enAdminContact,
        adminTestimonial: enAdminTestimonial,
        adminMedia: enAdminMedia,
        adminMessage: enAdminMessage,
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
        publicHobby: ptPublicHobby,
        publicTestimonial: ptPublicTestimonial,
        publicContact: ptPublicContact,
        publicCv: ptPublicCv,
        adminProfile: ptAdminProfile,
        adminAbout: ptAdminAbout,
        adminExperience: ptAdminExperience,
        adminProject: ptAdminProject,
        adminEducation: ptAdminEducation,
        adminCertification: ptAdminCertification,
        adminSkill: ptAdminSkill,
        adminHobby: ptAdminHobby,
        adminContact: ptAdminContact,
        adminTestimonial: ptAdminTestimonial,
        adminMedia: ptAdminMedia,
        adminMessage: ptAdminMessage,
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
        publicHobby: esPublicHobby,
        publicTestimonial: esPublicTestimonial,
        publicContact: esPublicContact,
        publicCv: esPublicCv,
        adminProfile: esAdminProfile,
        adminAbout: esAdminAbout,
        adminExperience: esAdminExperience,
        adminProject: esAdminProject,
        adminEducation: esAdminEducation,
        adminCertification: esAdminCertification,
        adminSkill: esAdminSkill,
        adminHobby: esAdminHobby,
        adminContact: esAdminContact,
        adminTestimonial: esAdminTestimonial,
        adminMedia: esAdminMedia,
        adminMessage: esAdminMessage,
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
        publicHobby: faPublicHobby,
        publicTestimonial: faPublicTestimonial,
        publicContact: faPublicContact,
        publicCv: faPublicCv,
        adminProfile: faAdminProfile,
        adminAbout: faAdminAbout,
        adminExperience: faAdminExperience,
        adminProject: faAdminProject,
        adminEducation: faAdminEducation,
        adminCertification: faAdminCertification,
        adminSkill: faAdminSkill,
        adminHobby: faAdminHobby,
        adminContact: faAdminContact,
        adminTestimonial: faAdminTestimonial,
        adminMedia: faAdminMedia,
        adminMessage: faAdminMessage,
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
        publicHobby: trPublicHobby,
        publicTestimonial: trPublicTestimonial,
        publicContact: trPublicContact,
        publicCv: trPublicCv,
        adminProfile: trAdminProfile,
        adminAbout: trAdminAbout,
        adminExperience: trAdminExperience,
        adminProject: trAdminProject,
        adminEducation: trAdminEducation,
        adminCertification: trAdminCertification,
        adminSkill: trAdminSkill,
        adminHobby: trAdminHobby,
        adminContact: trAdminContact,
        adminTestimonial: trAdminTestimonial,
        adminMedia: trAdminMedia,
        adminMessage: trAdminMessage,
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
        publicHobby: arPublicHobby,
        publicTestimonial: arPublicTestimonial,
        publicContact: arPublicContact,
        publicCv: arPublicCv,
        adminProfile: arAdminProfile,
        adminAbout: arAdminAbout,
        adminExperience: arAdminExperience,
        adminProject: arAdminProject,
        adminEducation: arAdminEducation,
        adminCertification: arAdminCertification,
        adminSkill: arAdminSkill,
        adminHobby: arAdminHobby,
        adminContact: arAdminContact,
        adminTestimonial: arAdminTestimonial,
        adminMedia: arAdminMedia,
        adminMessage: arAdminMessage,
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
        publicHobby: dePublicHobby,
        publicTestimonial: dePublicTestimonial,
        publicContact: dePublicContact,
        publicCv: dePublicCv,
        adminProfile: deAdminProfile,
        adminAbout: deAdminAbout,
        adminExperience: deAdminExperience,
        adminProject: deAdminProject,
        adminEducation: deAdminEducation,
        adminCertification: deAdminCertification,
        adminSkill: deAdminSkill,
        adminHobby: deAdminHobby,
        adminContact: deAdminContact,
        adminTestimonial: deAdminTestimonial,
        adminMedia: deAdminMedia,
        adminMessage: deAdminMessage,
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