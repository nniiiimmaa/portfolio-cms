/**
 * Design Tokens
 *
 * @module Design/tokens/colors
 * @description Defines the application's color tokens.
 *
 * These tokens are the single source of truth for the design system.
 * They are consumed by generators to produce:
 *
 * - CSS Variables
 * - PrimeVue Theme
 * - Tailwind Theme (future)
 * *
 * @see ../generate.js
 */

export const DESIGN_TOKENS = {
    // -------------------------------------------------------------------------
    // Brand Colors
    // -------------------------------------------------------------------------

    /**
     * Brand identity colors.
     */
    brand: {
        /**
         * Primary application color.
         */
        primary: '#06B6D4',

        /**
         * Success color.
         */
        success: '#10B981',

        /**
         * Warning color.
         */
        warning: '#F59E0B',

        /**
         * Danger color.
         */
        danger: '#EF4444',

        /**
         * Information color.
         */
        info: '#0EA5E9',
    },

    // -------------------------------------------------------------------------
    // Light Theme
    // -------------------------------------------------------------------------

    light: {
        surface: {
            background: '#F8FAFC',

            backgroundSecondary: '#FFFFFF',

            backgroundTertiary: '#E0F2FE',

            card: '#FFFFFF',
        },

        text: {
            primary: '#0F172A',

            secondary: '#475569',

            muted: '#94A3B8',
        },

        border: {
            primary: 'rgba(15, 23, 42, 0.08)',

            secondary: 'rgba(15, 23, 42, 0.15)',
        },

        effects: {
            glow: 'rgba(6, 182, 212, 0.12)',
        },
    },

    // -------------------------------------------------------------------------
    // Dark Theme
    // -------------------------------------------------------------------------

    dark: {
        surface: {
            background: '#07111A',

            backgroundSecondary: '#0B1724',

            backgroundTertiary: '#102333',

            card: '#0F1C2B',
        },

        text: {
            primary: '#F8FAFC',

            secondary: '#94A3B8',

            muted: '#64748B',
        },

        border: {
            primary: 'rgba(255, 255, 255, 0.08)',

            secondary: 'rgba(255, 255, 255, 0.15)',
        },

        effects: {
            glow: 'rgba(6, 182, 212, 0.18)',
        },
    },
};