<template>

    <Head :title="$t('auth.forgot_password.page_title')" />

    <AuthLayout :title="$t('auth.forgot_password.title')" :subtitle="$t('auth.forgot_password.subtitle')">

        <div v-if="status" class="status-message">
            {{ status }}
        </div>


        <form class="login-form" @submit.prevent="submit">

            <div class="field">

                <label for="email">
                    {{ $t('auth.forgot_password.email') }}
                </label>


                <InputText id="email" v-model="form.email" type="email"
                    :placeholder="$t('auth.forgot_password.email_placeholder')" autocomplete="username" autofocus
                    :invalid="!!form.errors.email" :pt="authInputTextPt" />


                <Message v-if="form.errors.email" severity="error" size="small" :pt="authMessagePt">
                    {{ form.errors.email }}
                </Message>

            </div>


            <Button type="submit" :label="$t('auth.forgot_password.submit')" :loading="form.processing"
                :pt="authButtonPt" />

        </form>

    </AuthLayout>

</template>


<script setup>
// -----------------------------
// Imports
// -----------------------------
import { Head, useForm } from '@inertiajs/vue3'
import AuthLayout from '@/Components/Auth/AuthLayout.vue'
import InputText from 'primevue/inputtext'
import Button from 'primevue/button'
import Message from 'primevue/message'

import { authInputTextPt } from '@/PrimeVue/PT/inputText.pt'
import { authButtonPt } from '@/PrimeVue/PT/button.pt'
import { authMessagePt } from '@/PrimeVue/PT/message.pt'


// -----------------------------
// Props & Emits
// -----------------------------
defineProps({

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
const form = useForm({
    email: '',
})


// -----------------------------
// Computed & Watch
// -----------------------------


// -----------------------------
// Methods
// -----------------------------
const submit = () => {

    form.post(route('password.email'))

}


// -----------------------------
// Hooks
// -----------------------------

</script>


<style scoped>
.login-form {
    display: flex;
    flex-direction: column;
    gap: 1.2rem;
}


.field {
    display: flex;
    flex-direction: column;
    gap: .5rem;
}


.field label {
    color: var(--text);
    font-size: .85rem;
}


.status-message {
    margin-bottom: 1rem;
    padding: .85rem 1rem;
    border-radius: var(--radius-md);
    background: var(--success-bg);
    color: var(--success);
    font-size: .9rem;
}
</style>