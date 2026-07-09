import { createI18n } from 'vue-i18n';

import en from '../Lang/en.json';
import es from '../Lang/es.json';
import pt from '../Lang/pt.json';
import fa from '../Lang/fa.json';
import tr from '../Lang/tr.json';
import ar from '../Lang/ar.json';
import de from '../Lang/de.json';

const i18n = createI18n({
    legacy: false,

    locale: 'en',

    fallbackLocale: 'en',

    messages: {
        en,
        es,
        pt,
        fa,
        tr,
        ar,
        de,
    },
});

export default i18n;