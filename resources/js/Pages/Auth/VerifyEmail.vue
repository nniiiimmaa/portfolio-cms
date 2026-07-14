<template>

    <Head :title="$t('auth.verify_email.page_title')" />

    <AuthLayout :title="$t('auth.verify_email.title')" :subtitle="$t('auth.verify_email.subtitle')">

        <div v-if="verificationLinkSent" class="status-message">
            {{ $t('auth.verify_email.link_sent') }}
        </div>


        <form class="login-form" @submit.prevent="submit">

            <Button type="submit" :label="$t('auth.verify_email.resend')" :loading="form.processing"
                :pt="authButtonPt" />


            <Link :href="route('logout')" method="post" as="button" class="logout-link">
                {{ $t('auth.verify_email.logout') }}
            </Link>

        </form>

    </AuthLayout>

</template>


<script setup>
// -----------------------------
// Imports
// -----------------------------
import { computed } from 'vue'
import { Head, Link, useForm } from '@inertiajs/vue3'
import AuthLayout from '@/Components/Auth/AuthLayout.vue'
import Button from 'primevue/button'

import { authButtonPt } from '@/PrimeVue/PT/button.pt'


// -----------------------------
// Props & Emits
// -----------------------------
const props = defineProps({

    status: {
        type: String,
        default: '',
    },

})


// -----------------------------
// Stores & Composables
// -----------------------------


// -----------------------------
// Provides & Injects
// -----------------------------


// -----------------------------
// Refs & Reactives & Vars
// -----------------------------
const form = useForm({})


// -----------------------------
// Computed & Watch
// -----------------------------
const verificationLinkSent = computed(() => {

    return props.status === 'verification-link-sent'

})


// -----------------------------
// Methods
// -----------------------------
const submit = () => {

    form.post(route('verification.send'))

}


// -----------------------------
// Hooks
// -----------------------------

</script>


<style scoped>
.login-form {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}


.status-message {
    margin-bottom: 1rem;
    padding: .85rem 1rem;
    border-radius: var(--radius-md);
    background: var(--success-bg);
    color: var(--success);
    font-size: .9rem;
}


.logout-link {
    background: none;
    border: none;
    color: var(--primary);
    font-size: .9rem;
    font-weight: var(--font-weight-medium);
    cursor: pointer;
    text-decoration: none;
    transition:
        color var(--transition-fast),
        opacity var(--transition-fast);
}


.logout-link:hover {
    color: var(--primary-hover);
    text-decoration: underline;
}
</style>