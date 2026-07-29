<template>

    <Head :title="$t('auth.register.page_title')" />

    <AuthLayout :title="$t('auth.register.title')" :subtitle="$t('auth.register.subtitle')">

        <form class="login-form" @submit.prevent="submit">

            <div class="form-row">
                <div class="field">
                    <label for="first_name">
                        {{ $t('auth.register.first_name') }}
                    </label>
                    <InputText id="first_name" v-model="form.first_name" type="text"
                        :placeholder="$t('auth.register.first_name_placeholder')" autocomplete="given-name"
                        :invalid="!!form.errors.first_name" :pt="authInputTextPt" />
                    <Message v-if="form.errors.first_name" severity="error" size="small" :pt="authMessagePt">
                        {{ form.errors.first_name }}
                    </Message>
                </div>

                <div class="field">
                    <label for="last_name">
                        {{ $t('auth.register.last_name') }}
                    </label>
                    <InputText id="last_name" v-model="form.last_name" type="text"
                        :placeholder="$t('auth.register.last_name_placeholder')" autocomplete="family-name"
                        :invalid="!!form.errors.last_name" :pt="authInputTextPt" />
                    <Message v-if="form.errors.last_name" severity="error" size="small" :pt="authMessagePt">
                        {{ form.errors.last_name }}
                    </Message>
                </div>
            </div>

            <div class="field">
                <label for="username">
                    {{ $t('auth.register.username') }}
                </label>
                <InputText id="username" v-model="form.username" type="text"
                    :placeholder="$t('auth.register.username_placeholder')" autocomplete="username"
                    :invalid="!!form.errors.username" :pt="authInputTextPt" />
                <Message v-if="form.errors.username" severity="error" size="small" :pt="authMessagePt">
                    {{ form.errors.username }}
                </Message>
            </div>


            <div class="field">
                <label for="email">
                    {{ $t('auth.register.email') }}
                </label>
                <InputText id="email" v-model="form.email" type="email"
                    :placeholder="$t('auth.register.email_placeholder')" autocomplete="email"
                    :invalid="!!form.errors.email" :pt="authInputTextPt" />

                <Message v-if="form.errors.email" severity="error" size="small" :pt="authMessagePt">
                    {{ form.errors.email }}
                </Message>
            </div>

            <div class="form-row">
                <div class="field">
                    <label for="password">
                        {{ $t('auth.register.password') }}
                    </label>
                    <Password id="password" v-model="form.password"
                        :placeholder="$t('auth.register.password_placeholder')" autocomplete="new-password" toggleMask
                        fluid :invalid="!!form.errors.password" :pt="passwordPt" />
                    <Message v-if="form.errors.password" severity="error" size="small" :pt="authMessagePt">
                        {{ form.errors.password }}
                    </Message>
                </div>

                <div class="field">
                    <label for="password_confirmation">
                        {{ $t('auth.register.confirm_password') }}
                    </label>
                    <Password id="password_confirmation" v-model="form.password_confirmation"
                        :placeholder="$t('auth.register.confirm_password_placeholder')" autocomplete="new-password"
                        toggleMask fluid :invalid="!!form.errors.password_confirmation" :pt="passwordPt" />
                    <Message v-if="form.errors.password_confirmation" severity="error" size="small" :pt="authMessagePt">
                        {{ form.errors.password_confirmation }}
                    </Message>
                </div>
            </div>
            <Button type="submit" :label="$t('auth.register.submit')" :loading="form.processing"
                :pt="secondaryButtonPt" />
            <div class="register-link">
                <span>
                    {{ $t('auth.register.have_account') }}
                </span>
                <Link :href="route('login')" class="login-link">
                    {{ $t('auth.register.login') }}
                </Link>
            </div>
        </form>
    </AuthLayout>

</template>


<script setup>
// -----------------------------
// Imports
// -----------------------------
import { Head, Link, useForm } from '@inertiajs/vue3'
import AuthLayout from '@/Components/Auth/AuthLayout.vue'
import InputText from 'primevue/inputtext'
import Password from 'primevue/password'
import Button from 'primevue/button'
import Message from 'primevue/message'

import { authInputTextPt } from '@/PrimeVue/PT/inputText.pt'
import { passwordPt } from '@/PrimeVue/PT/password.pt'
import { secondaryButtonPt } from '@/PrimeVue/PT/button.pt'
import { authMessagePt } from '@/PrimeVue/PT/message.pt'


// -----------------------------
// Props & Emits
// -----------------------------


// -----------------------------
// Stores & Composables
// -----------------------------
import { useI18n } from 'vue-i18n'


// -----------------------------
// Provides & Injects
// -----------------------------
const { t } = useI18n()


// -----------------------------
// Refs & Reactives & Vars
// -----------------------------
const form = useForm({
    first_name: '',
    last_name: '',
    username: '',
    email: '',
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

    form.post(route('register'), {

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



.form-row {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
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



.register-link {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: .35rem;
    margin-top: 1rem;
    font-size: .9rem;
    color: var(--text);
}



.login-link {
    color: var(--primary);
    text-decoration: none;
    font-weight: var(--font-weight-medium);
    transition:
        color var(--transition-fast),
        opacity var(--transition-fast);
}



.login-link:hover {
    color: var(--primary-hover);
    text-decoration: underline;
}



@media (max-width: 600px) {
    .form-row {
        grid-template-columns: 1fr;
    }
}
</style>