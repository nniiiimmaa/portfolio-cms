<template>

    <Head :title="$t('auth.login.page_title')" />
    <AuthLayout :title="$t('auth.login.title')" :subtitle="$t('auth.login.subtitle')">
        <form class="login-form" @submit.prevent="submit">
            <div class="field">
                <label for="login">{{ $t('auth.login.login') }}</label>

                <InputText id="login" v-model="form.login" type="login"
                    :placeholder="$t('auth.login.login_placeholder')" autocomplete="username"
                    :invalid="!!form.errors.login" :pt="authInputTextPt" />

                <Message v-if="form.errors.login" severity="error" size="small" :pt="authMessagePt">
                    {{ form.errors.login }}
                </Message>
            </div>

            <div class="field">
                <label for="password">{{ $t('auth.login.password') }}</label>

                <Password id="password" v-model="form.password" :placeholder="$t('auth.login.password_placeholder')"
                    autocomplete="current-password" toggleMask fluid :invalid="!!form.errors.password"
                    :pt="authPasswordPt" />

                <Message v-if="form.errors.password" severity="error" size="small" :pt="authMessagePt">
                    {{ form.errors.password }}
                </Message>
            </div>

            <div class="remember">
                <Checkbox v-model="form.remember" inputId="remember" binary :pt="authCheckboxPt" />

                <label for="remember">{{ $t('auth.login.remember') }}</label>
            </div>

            <div class="login-links">
                <Link v-if="canResetPassword" :href="route('password.request')" class="login-link">
                    {{ $t('auth.login.forgot_password') }}
                </Link>
            </div>

            <Button type="submit" :label="$t('auth.login.submit')" :loading="form.processing" :pt="secondaryButtonPt" />

            <div class="register-link">
                <span>{{ $t('auth.login.no_account') }}</span>

                <Link :href="route('register')" class="login-link">
                    {{ $t('auth.login.create_account') }}
                </Link>
            </div>
        </form>
    </AuthLayout>
</template>

<script setup>
// -----------------------------
// Imports
// -----------------------------
import { Head, useForm, Link } from '@inertiajs/vue3'
import AuthLayout from '@/Components/Auth/AuthLayout.vue'
import InputText from 'primevue/inputtext'
import Password from 'primevue/password'
import Checkbox from 'primevue/checkbox'
import Button from 'primevue/button'
import Message from 'primevue/message'
import { authInputTextPt } from '@/PrimeVue/PT/inputText.pt'
import { authPasswordPt } from '@/PrimeVue/PT/password.pt'
import { secondaryButtonPt } from '@/PrimeVue/PT/button.pt'
import { authCheckboxPt } from '@/PrimeVue/PT/checkbox.pt'
import { authMessagePt } from '@/PrimeVue/PT/message.pt'

// -----------------------------
// Props & Emits
// -----------------------------
defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
})


// -----------------------------
// Composables
// -----------------------------
const form = useForm({
    login: '',
    password: '',
    remember: false,
})


// -----------------------------
// Methods
// -----------------------------
const submit = () => {

    form.post(route('login'), {

        onFinish: () => {
            form.reset('password')
        },

    })

}
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

.remember {
    display: flex;
    align-items: center;
    gap: .6rem;
    color: var(--text);
    font-size: .85rem;
}


.login-button {
    width: 100%;
}

.login-links {
    display: flex;
    justify-content: flex-end;
    margin-top: -.3rem;
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
</style>