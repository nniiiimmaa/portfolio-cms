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
    },
    {
        code: Language.SPANISH,
        locale: 'es-ES',
        name: 'Spanish',
        label: 'Español',
        flag: '🇪🇸',
        rtl: false,
    },
    {
        code: Language.PORTUGUESE,
        locale: 'pt-BR',
        name: 'Portuguese',
        label: 'Português',
        flag: '🇧🇷',
        rtl: false,
    },
    {
        code: Language.PERSIAN,
        locale: 'fa-IR',
        name: 'Persian',
        label: 'فارسی',
        flag: '🇮🇷',
        rtl: true,
    },
    {
        code: Language.TURKISH,
        locale: 'tr-TR',
        name: 'Turkish',
        label: 'Türkçe',
        flag: '🇹🇷',
        rtl: false,
    },
    {
        code: Language.ARABIC,
        locale: 'ar-AE',
        name: 'Arabic',
        label: 'العربية',
        flag: '🇦🇪',
        rtl: true,
    },
    {
        code: Language.GERMAN,
        locale: 'de-DE',
        name: 'German',
        label: 'Deutsch',
        flag: '🇩🇪',
        rtl: false,
    },
]);