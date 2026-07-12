/**
 * PrimeVue Select Pass Through Configuration
 *
 * @module PrimeVue/PT/select
 * @description Contains reusable Pass Through configurations
 * for PrimeVue Select components.
 */


/**
 * Language Switcher Select customization.
 *
 * @type {Object}
 */
export const languageSelectPt = {
    root: {
        class: [
            'language-select',
        ],
    },

    label: {
        class: [
            'flex',
            'items-center',
            'gap-2',
        ],
    },

    dropdown: {
        class: [
            'language-select-dropdown',
        ],
    },

    panel: {
        class: [
            'language-select-panel',
        ],
    },

    option: {
        class: [
            'flex',
            'items-center',
            'gap-2',
        ],
    },
};