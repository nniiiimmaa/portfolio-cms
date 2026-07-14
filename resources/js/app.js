// -----------------------------
// Imports
// -----------------------------

import '../css/app.css';
import './bootstrap';

import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createApp, h } from 'vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';

// Plugins
import pinia from './Plugins/pinia';
import i18n from './Plugins/i18n';
import primevue from './Plugins/primevue';

// Composables
import { useLanguage } from './Composables/useLanguage';
import { useTheme } from './Composables/useTheme';

// Stores
import { useLoaderStore } from './Stores/loader';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,

    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue'),
        ),

    setup({ el, App, props, plugin }) {
        const vueApp = createApp({
            render: () => h(App, props),
        });


        // -----------------------------
        // Register Plugins
        // -----------------------------

        vueApp
            .use(plugin)
            .use(ZiggyVue)
            .use(pinia)
            .use(i18n)
            .use(primevue);

        // -----------------------------
        // Initialize Application
        // -----------------------------

        const { initializeLanguage } = useLanguage();
        const { initializeTheme } = useTheme();
        
        initializeLanguage(props.initialPage.props.locale);
        console.log(props.initialPage.props.locale);
        initializeTheme();
        
        const loaderStore = useLoaderStore();
        // -----------------------------
        // Mount Application
        // -----------------------------

        vueApp.mount(el);
        loaderStore.hideLoader();

        return vueApp;
    },

    progress: {
        color: '#4B5563',
    },
});