<template>

    <Head :title="$t('auth.confirm_password.page_title')" />

    <AuthLayout :title="$t('auth.confirm_password.title')" :subtitle="$t('auth.confirm_password.subtitle')">

        <form class="login-form" @submit.prevent="submit">

            <div class="field">

                <label for="password">
                    {{ $t('auth.confirm_password.password') }}
                </label>


                <Password id="password" v-model="form.password"
                    :placeholder="$t('auth.confirm_password.password_placeholder')" autocomplete="current-password"
                    toggleMask fluid autofocus :invalid="!!form.errors.password" :pt="passwordPt" />


                <Message v-if="form.errors.password" severity="error" size="small" :pt="authMessagePt">
                    {{ form.errors.password }}
                </Message>

            </div>


            <Button type="submit" :label="$t('auth.confirm_password.submit')" :loading="form.processing"
                :pt="secondaryButtonPt" />

        </form>

    </AuthLayout>

</template>


<script setup>
// -----------------------------
// Imports
// -----------------------------
import { Head, useForm } from '@inertiajs/vue3'
import AuthLayout from '@/Components/Auth/AuthLayout.vue'
import Password from 'primevue/password'
import Button from 'primevue/button'
import Message from 'primevue/message'

import { passwordPt } from '@/PrimeVue/PT/password.pt'
import { secondaryButtonPt } from '@/PrimeVue/PT/button.pt'
import { authMessagePt } from '@/PrimeVue/PT/message.pt'


// -----------------------------
// Props & Emits
// -----------------------------


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
    password: '',
})


// -----------------------------
// Computed & Watch
// -----------------------------


// -----------------------------
// Methods
// -----------------------------
const submit = () => {

    form.post(route('password.confirm'), {

        onFinish: () => {

            form.reset()

        },

    })

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
</style>