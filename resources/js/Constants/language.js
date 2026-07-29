// -----------------------------
// Application Languages
// -----------------------------

export const Language = Object.freeze({
    ENGLISH: 'en',
    SPANISH: 'es',
    PORTUGUESE: 'pt',
    PERSIAN: 'fa',
    TURKISH: 'tr',
    ARABIC: 'ar',
    GERMAN: 'de',
});


// -----------------------------
// Supported Languages
// -----------------------------

export const SUPPORTED_LANGUAGES = Object.values(Language);


// -----------------------------
// Default Language
// -----------------------------

export const DEFAULT_LANGUAGE = Language.ENGLISH;