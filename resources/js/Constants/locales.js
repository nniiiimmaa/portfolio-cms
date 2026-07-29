// -----------------------------
// Imports
// -----------------------------

import { Language } from '@/Constants/language';

/**
 * Supported Locales
 *
 * @module Constants/locales
 * @description Defines supported languages and localization metadata.
 *
 * @see {@link ./language.js}
 */
export const LOCALES = Object.freeze([
    {
        code: Language.ENGLISH,
        locale: 'en-US',
        name: 'English',
        label: 'English',
        flag: '🇺🇸',
        rtl: false,
        countries: [
            'US',
            'GB',
            'CA',
            'AU',
        ],
    },
    {
        code: Language.SPANISH,
        locale: 'es-ES',
        name: 'Spanish',
        label: 'Español',
        flag: '🇪🇸',
        rtl: false,
        countries: [
            'ES',
            'MX',
            'AR',
            'CO',
        ],
    },
    {
        code: Language.PORTUGUESE,
        locale: 'pt-BR',
        name: 'Portuguese',
        label: 'Português',
        flag: '🇧🇷',
        rtl: false,
        countries: [
            'BR',
            'PT',
        ],
    },
    {
        code: Language.PERSIAN,
        locale: 'fa-IR',
        name: 'Persian',
        label: 'فارسی',
        flag: '🇮🇷',
        rtl: true,
        countries: [
            'IR',
        ],
    },
    {
        code: Language.TURKISH,
        locale: 'tr-TR',
        name: 'Turkish',
        label: 'Türkçe',
        flag: '🇹🇷',
        rtl: false,
        countries: [
            'TR',
        ],
    },
    {
        code: Language.ARABIC,
        locale: 'ar-AE',
        name: 'Arabic',
        label: 'العربية',
        flag: '🇦🇪',
        rtl: true,
        countries: [
            'AE',
            'SA',
            'QA',
            'EG',
        ],
    },
    {
        code: Language.GERMAN,
        locale: 'de-DE',
        name: 'German',
        label: 'Deutsch',
        flag: '🇩🇪',
        rtl: false,
        countries: [
            'DE',
            'AT',
            'CH',
        ],
    },
]);