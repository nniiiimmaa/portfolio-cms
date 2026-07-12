<template>
    <Select v-model="selectedLocale" :options="locales" optionLabel="label" optionValue="code" :pt="languageSelectPt"
        aria-label="Select language">

        <!-- Selected value -->
        <template #value="slotProps">

            <div v-if="slotProps.value" class="language-value">

                <span class="language-flag">
                    {{ getLocale(slotProps.value).flag }}
                </span>


                <span class="language-label">
                    {{ getLocale(slotProps.value).label }}
                </span>

            </div>

        </template>


        <!-- Dropdown options -->
        <template #option="slotProps">

            <div class="language-option">

                <span class="language-flag">
                    {{ slotProps.option.flag }}
                </span>


                <span>
                    {{ slotProps.option.label }}
                </span>

            </div>

        </template>

    </Select>
</template>


<script setup>
// -----------------------------
// Imports
// -----------------------------

import { computed } from 'vue';
import Select from 'primevue/select';
import { LOCALES } from '@/Constants/locales';
import { useLanguage } from '@/Composables/useLanguage';
import {
    languageSelectPt,
} from '@/PrimeVue/PT/select.pt';


// -----------------------------
// Composables
// -----------------------------

const {
    currentLanguage,
    setLanguage,
} = useLanguage();


// -----------------------------
// Constants
// -----------------------------

/**
 * Available application locales.
 *
 * @type {Array<Object>}
 */
const locales = LOCALES;
console.log('Current language:', currentLanguage.value);

console.log(
    'Available values:',
    locales.map(item => item.code),
);

// -----------------------------
// Computed
// -----------------------------

/**
 * Selected application language.
 *
 * @type {string}
 */
const selectedLocale = computed({

    get() {
        return currentLanguage.value;
    },

    set(value) {
        setLanguage(value);
    },

});


// -----------------------------
// Methods
// -----------------------------

/**
 * Gets locale information.
 *
 * @param {string} languageCode - Language identifier.
 * @returns {Object}
 */
function getLocale(languageCode) {

    return (
        locales.find(
            (item) => item.code === languageCode,
        )
        ?? locales[0]
    );
}

</script>


<style scoped>
.language-value,
.language-option {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}


.language-flag {
    font-size: 1.2rem;
}


.language-label {
    white-space: nowrap;
}


/*
Responsive behavior

Desktop:
🇧🇷 Português

Mobile:
🇧🇷
*/

@media (max-width: 640px) {

    .language-label {
        display: none;
    }

}
</style>