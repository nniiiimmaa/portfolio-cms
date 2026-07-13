// -----------------------------
// Imports
// -----------------------------

// PrimeVue
import PrimeVue from "primevue/config";
import ToastService from "primevue/toastservice";
import ConfirmationService from "primevue/confirmationservice";

// Configuration
import theme from "../PrimeVue/theme";
import pt from "../PrimeVue/pt";
import options from "../PrimeVue/options";

/**
 * PrimeVue Plugin
 *
 * @module Plugins/primevue
 * @description Registers and configures PrimeVue and its services.
 */
export default {
    /**
     * Installs the PrimeVue plugin.
     *
     * @param {import('vue').App} app - Vue application instance.
     * @returns {void}
     */
    install(app) {
        app.use(PrimeVue, {
            theme: {
                theme,

                options: {
                    darkModeSelector: ".dark",
                    cssLayer: {
                        name: "primevue",
                        order: "primevue, base, components, utilities",
                    },
                },

                pt,
            },

            ...options,
        });

        app.use(ToastService);

        app.use(ConfirmationService);
    },
};
