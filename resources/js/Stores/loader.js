// -----------------------------
// Imports
// -----------------------------

import { defineStore } from 'pinia';
import { ref } from 'vue';


/**
 * Loader Store
 *
 * @module Stores/loader
 * @description
 * Stores and manages the global application loading state.
 *
 * @flow
 *
 * Application Starts
 *        │
 *        ▼
 * Initialize Loader Store
 *        │
 *        ▼
 * isLoading = true
 *        │
 *        ▼
 * Display AppLoader
 *        │
 *        ▼
 * Application Ready
 *        │
 *        ▼
 * hideLoader()
 *        │
 *        ▼
 * Remove AppLoader
 *
 *
 * Manual Loading:
 *
 * User Action
 *        │
 *        ▼
 * showLoader()
 *        │
 *        ▼
 * Execute operation
 *        │
 *        ▼
 * hideLoader()
 */
export const useLoaderStore = defineStore('loader', () => {

    // -----------------------------
    // State
    // -----------------------------

    /**
     * Application loading state.
     *
     * @type {boolean}
     */
    const isLoading = ref(true);


    // -----------------------------
    // Actions
    // -----------------------------

    /**
     * Shows application loader.
     *
     * @returns {void}
     */
    function showLoader() {
        isLoading.value = true;
    }


    /**
     * Hides application loader.
     *
     * @returns {void}
     */
    function hideLoader() {
        isLoading.value = false;
    }


    // -----------------------------
    // Expose
    // -----------------------------

    return {
        isLoading,
        showLoader,
        hideLoader,
    };
});