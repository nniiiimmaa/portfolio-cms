// -----------------------------
// Imports
// -----------------------------

import { LOCALES } from '@/Constants/locales';


// -----------------------------
// Methods
// -----------------------------

/**
 * Finds locale metadata by language code.
 *
 * @module Utils/locale
 *
 * @param {string} language - Application language code.
 *
 * @returns {Object|undefined}
 */
export function getLocale(language) {

    return LOCALES.find(
        (item) => item.code === language
    );

}


/**
 * Finds application language by country code.
 *
 * @module Utils/locale
 *
 * @param {string} country - Country ISO code.
 *
 * @returns {string|null}
 */
export function getLanguageByCountry(country) {

    const locale = LOCALES.find(
        (item) => item.countries?.includes(country)
    );


    return locale?.code ?? null;

}