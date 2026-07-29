/**
 * Design System Colors
 *
 * @module Design/colors
 * @description Defines the application's color palettes used by the
 * design system and PrimeVue theme.
 *
 * @todo Replace the manually maintained palettes with an automatically
 * generated file based on the design tokens located in
 * `Design/tokens/colors.js`.
 *
 * This file currently serves as the bridge between the design tokens
 * and the PrimeVue theme.
 *
 * @see ./tokens/colors.js
 */

// -----------------------------
// Primary Palette
// -----------------------------

/**
 * Primary brand color palette (Cyan).
 *
 * Used for:
 * - Primary buttons
 * - Links
 * - Active states
 * - Focus states
 */
export const PRIMARY_COLORS = {
    50: '#ecfeff',
    100: '#cffafe',
    200: '#a5f3fc',
    300: '#67e8f9',
    400: '#22d3ee',
    500: '#06b6d4',
    600: '#0891b2',
    700: '#0e7490',
    800: '#155e75',
    900: '#164e63',
    950: '#083344',
};

// -----------------------------
// Success Palette
// -----------------------------

/**
 * Success color palette (Emerald).
 *
 * Used for:
 * - Success messages
 * - Valid states
 * - Confirmations
 */
export const SUCCESS_COLORS = {
    50: '#ecfdf5',
    100: '#d1fae5',
    200: '#a7f3d0',
    300: '#6ee7b7',
    400: '#34d399',
    500: '#10b981',
    600: '#059669',
    700: '#047857',
    800: '#065f46',
    900: '#064e3b',
    950: '#022c22',
};

// -----------------------------
// Warning Palette
// -----------------------------

/**
 * Warning color palette (Amber).
 *
 * Used for:
 * - Warning messages
 * - Pending states
 * - Attention indicators
 */
export const WARNING_COLORS = {
    50: '#fffbeb',
    100: '#fef3c7',
    200: '#fde68a',
    300: '#fcd34d',
    400: '#fbbf24',
    500: '#f59e0b',
    600: '#d97706',
    700: '#b45309',
    800: '#92400e',
    900: '#78350f',
    950: '#451a03',
};

// -----------------------------
// Danger Palette
// -----------------------------

/**
 * Danger color palette (Red).
 *
 * Used for:
 * - Errors
 * - Delete actions
 * - Invalid states
 */
export const DANGER_COLORS = {
    50: '#fef2f2',
    100: '#fee2e2',
    200: '#fecaca',
    300: '#fca5a5',
    400: '#f87171',
    500: '#ef4444',
    600: '#dc2626',
    700: '#b91c1c',
    800: '#991b1b',
    900: '#7f1d1d',
    950: '#450a0a',
};

// -----------------------------
// Info Palette
// -----------------------------

/**
 * Information color palette (Sky Blue).
 *
 * Used for:
 * - Information messages
 * - Help components
 * - Neutral highlights
 */
export const INFO_COLORS = {
    50: '#f0f9ff',
    100: '#e0f2fe',
    200: '#bae6fd',
    300: '#7dd3fc',
    400: '#38bdf8',
    500: '#0ea5e9',
    600: '#0284c7',
    700: '#0369a1',
    800: '#075985',
    900: '#0c4a6e',
    950: '#082f49',
};

// -----------------------------
// Light Surface Palette
// -----------------------------

/**
 * Surface colors used in light mode.
 */
export const LIGHT_SURFACE_COLORS = {
    0: '#ffffff',
    50: '#f8fafc',
    100: '#f1f5f9',
    200: '#e2e8f0',
    300: '#cbd5e1',
    400: '#94a3b8',
    500: '#64748b',
    600: '#475569',
    700: '#334155',
    800: '#1e293b',
    900: '#0f172a',
};

// -----------------------------
// Dark Surface Palette
// -----------------------------

/**
 * Surface colors used in dark mode.
 */
export const DARK_SURFACE_COLORS = {
    0: '#020617',
    50: '#07111a',
    100: '#0b1724',
    200: '#102333',
    300: '#1e293b',
    400: '#334155',
    500: '#475569',
    600: '#64748b',
    700: '#94a3b8',
    800: '#cbd5e1',
    900: '#f8fafc',
};