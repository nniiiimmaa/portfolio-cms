import PrimeVue from 'primevue/config';

import ToastService from 'primevue/toastservice';
import ConfirmationService from 'primevue/confirmationservice';

import preset from '../PrimeVue/preset';
import pt from '../PrimeVue/pt';
import options from '../PrimeVue/options';

export default {
    install(app) {
        app.use(PrimeVue, {
            theme: {
                preset,
                options: {
                    darkModeSelector: '.dark',
                },
                pt,
            },

            ...options,
        });

        app.use(ToastService);

        app.use(ConfirmationService);
    },
};