import axios from 'axios';
import { DEFAULT_LANGUAGE } from '@/Constants/language';
import { LANGUAGE_STORAGE_KEY } from '@/Constants/storage';

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.axios.defaults.headers.common['X-Locale'] =
    localStorage.getItem(LANGUAGE_STORAGE_KEY) ?? DEFAULT_LANGUAGE;