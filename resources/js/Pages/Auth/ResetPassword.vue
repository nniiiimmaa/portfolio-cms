<template>

    <Head :title="$t('auth.reset_password.page_title')" />

    <AuthLayout :title="$t('auth.reset_password.title')" :subtitle="$t('auth.reset_password.subtitle')">

        <form class="login-form" @submit.prevent="submit">

            <div class="field">

                <label for="email">
                    {{ $t('auth.reset_password.email') }}
                </label>


                <InputText id="email" v-model="form.email" type="email"
                    :placeholder="$t('auth.reset_password.email_placeholder')" autocomplete="username" autofocus
                    :invalid="!!form.errors.email" :pt="authInputTextPt" />


                <Message v-if="form.errors.email" severity="error" size="small" :pt="authMessagePt">
                    {{ form.errors.email }}
                </Message>

            </div>


            <div class="field">

                <label for="password">
                    {{ $t('auth.reset_password.password') }}
                </label>


                <Password id="password" v-model="form.password"
                    :placeholder="$t('auth.reset_password.password_placeholder')" autocomplete="new-password" toggleMask
                    fluid :invalid="!!form.errors.password" :pt="authPasswordPt" />


                <Message v-if="form.errors.password" severity="error" size="small" :pt="authMessagePt">
                    {{ form.errors.password }}
                </Message>

            </div>


            <div class="field">

                <label for="password_confirmation">
                    {{ $t('auth.reset_password.confirm_password') }}
                </label>


                <Password id="password_confirmation" v-model="form.password_confirmation"
                    :placeholder="$t('auth.reset_password.confirm_password_placeholder')" autocomplete="new-password"
                    toggleMask fluid :invalid="!!form.errors.password_confirmation" :pt="authPasswordPt" />


                <Message v-if="form.errors.password_confirmation" severity="error" size="small" :pt="authMessagePt">
                    {{ form.errors.password_confirmation }}
                </Message>

            </div>


            <Button type="submit" :label="$t('auth.reset_password.submit')" :loading="form.processing"
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
import InputText from 'primevue/inputtext'
import Password from 'primevue/password'
import Button from 'primevue/button'
import Message from 'primevue/message'

import { authInputTextPt } from '@/PrimeVue/PT/inputText.pt'
import { authPasswordPt } from '@/PrimeVue/PT/password.pt'
import { secondaryButtonPt } from '@/PrimeVue/PT/button.pt'
import { authMessagePt } from '@/PrimeVue/PT/message.pt'


// -----------------------------
// Props & Emits
// -----------------------------
const props = defineProps({

    email: {
        type: String,
        required: true,
    },

    token: {
        type: String,
        required: true,
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
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
})


// -----------------------------
// Computed & Watch
// -----------------------------


// -----------------------------
// Methods
// -----------------------------
const submit = () => {

    form.post(route('password.store'), {

        onFinish: () => {

            form.reset(
                'password',
                'password_confirmation'
            )

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