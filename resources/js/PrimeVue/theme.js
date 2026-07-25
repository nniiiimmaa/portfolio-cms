// -----------------------------
// Imports
// -----------------------------

import { definePreset } from "@primeuix/themes";
import Aura from "@primeuix/themes/aura";

import {
    PRIMARY_COLORS,
    SUCCESS_COLORS,
    WARNING_COLORS,
    DANGER_COLORS,
    INFO_COLORS,
    LIGHT_SURFACE_COLORS,
    DARK_SURFACE_COLORS,
} from "@/Design/colors";

// -----------------------------
// Theme
// -----------------------------

/**
 * PrimeVue Theme
 *
 * @module PrimeVue/theme
 * @description Defines the application's custom PrimeVue theme based on
 * the Aura preset and the project's design system.
 *
 * @see {@link ../Design/colors.js}
 */
const theme = definePreset(Aura, {
    semantic: {
        // -----------------------------
        // Brand Palette
        // -----------------------------

        primary: PRIMARY_COLORS,

        // -----------------------------
        // Semantic Palettes
        // -----------------------------

        success: SUCCESS_COLORS,

        warning: WARNING_COLORS,

        danger: DANGER_COLORS,

        info: INFO_COLORS,

        // -----------------------------
        // Color Schemes
        // -----------------------------

        colorScheme: {
            light: {
                surface: LIGHT_SURFACE_COLORS,

                primary: {
                    color: "{primary.500}",
                    contrastColor: "{surface.0}",
                    hoverColor: "{primary.600}",
                    activeColor: "{primary.700}",
                },

                success: {
                    color: "{success.500}",
                    contrastColor: "{surface.0}",
                    hoverColor: "{success.600}",
                    activeColor: "{success.700}",
                },

                warning: {
                    color: "{warning.500}",
                    contrastColor: "{surface.900}",
                    hoverColor: "{warning.600}",
                    activeColor: "{warning.700}",
                },

                danger: {
                    color: "{danger.500}",
                    contrastColor: "{surface.0}",
                    hoverColor: "{danger.600}",
                    activeColor: "{danger.700}",
                },

                info: {
                    color: "{info.500}",
                    contrastColor: "{surface.0}",
                    hoverColor: "{info.600}",
                    activeColor: "{info.700}",
                },
            },

            dark: {
                surface: DARK_SURFACE_COLORS,

                primary: {
                    color: "{primary.400}",
                    contrastColor: "{surface.900}",
                    hoverColor: "{primary.300}",
                    activeColor: "{primary.200}",
                },

                success: {
                    color: "{success.400}",
                    contrastColor: "{surface.900}",
                    hoverColor: "{success.300}",
                    activeColor: "{success.200}",
                },

                warning: {
                    color: "{warning.400}",
                    contrastColor: "{surface.900}",
                    hoverColor: "{warning.300}",
                    activeColor: "{warning.200}",
                },

                danger: {
                    color: "{danger.400}",
                    contrastColor: "{surface.900}",
                    hoverColor: "{danger.300}",
                    activeColor: "{danger.200}",
                },

                info: {
                    color: "{info.400}",
                    contrastColor: "{surface.900}",
                    hoverColor: "{info.300}",
                    activeColor: "{info.200}",
                },
            },
        },
    },

    // -----------------------------
    // Component Tokens
    // -----------------------------

    components: {
        
    },
});

export default theme;
