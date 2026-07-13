<template>

    <Head :title="$t('auth.login.page_title')" />

    <div class="login-page">
        <Logo size="45vw" class="absolute opacity-25" />
        <div class="login-card">
            <div class="login-tools">
                <LanguageSwitcher />
                <ThemeSwitcher />
            </div>

            <div class="login-header">
                <h1>{{ $t('auth.login.title') }}</h1>
                <p>{{ $t('auth.login.subtitle') }}</p>
            </div>

            <form class="login-form" @submit.prevent="submit">
                <div class="field">
                    <label for="email">{{ $t('auth.login.email') }}</label>

                    <InputText id="email" v-model="form.email" type="email" :placeholder="$t('auth.login.email_placeholder')"
                        autocomplete="username" :invalid="!!form.errors.email" :pt="loginInputTextPt" />

                    <Message v-if="form.errors.email" severity="error" size="small" :pt="loginMessagePt">
                        {{ form.errors.email }}
                    </Message>
                </div>

                <div class="field">
                    <label for="password">{{ $t('auth.login.password') }}</label>

                    <Password id="password" v-model="form.password" :placeholder="$t('auth.login.password_placeholder')"
                        autocomplete="current-password" toggleMask fluid :invalid="!!form.errors.password"
                        :pt="loginPasswordPt" />

                    <Message v-if="form.errors.password" severity="error" size="small" :pt="loginMessagePt">
                        {{ form.errors.password }}
                    </Message>
                </div>

                <div class="remember">
                    <Checkbox v-model="form.remember" inputId="remember" binary :pt="loginCheckboxPt" />

                    <label for="remember">{{ $t('auth.login.remember') }}</label>
                </div>

                <div class="login-links">
                    <Link v-if="canResetPassword" :href="route('password.request')" class="login-link">
                        {{ $t('auth.login.forgot_password') }}
                    </Link>
                </div>

                <Button type="submit" :label="$t('auth.login.submit')" :loading="form.processing" :pt="loginButtonPt" />

                <div class="register-link">
                    <span>{{ $t('auth.login.no_account') }}</span>

                    <Link :href="route('register')" class="login-link">
                        {{ $t('auth.login.create_account') }}
                    </Link>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
// -----------------------------
// Imports
// -----------------------------
import { Head, useForm, Link } from '@inertiajs/vue3'
import Logo from '@/Components/Shared/Logo/Logo.vue'
import InputText from 'primevue/inputtext'
import Password from 'primevue/password'
import Checkbox from 'primevue/checkbox'
import Button from 'primevue/button'
import Message from 'primevue/message'
import ThemeSwitcher from '@/Components/Shared/ThemeSwitcher.vue'
import LanguageSwitcher from '@/Components/Shared/LanguageSwitcher.vue'
import { loginInputTextPt } from '@/PrimeVue/PT/inputText.pt'
import { loginPasswordPt } from '@/PrimeVue/PT/password.pt'
import { loginButtonPt } from '@/PrimeVue/PT/button.pt'
import { loginCheckboxPt } from '@/PrimeVue/PT/checkbox.pt'
import { loginMessagePt } from '@/PrimeVue/PT/message.pt'

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
    email: '',
    password: '',
    remember: false,
})


// -----------------------------
// Composables
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
.login-page {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem;
    background:
        radial-gradient(circle at top,
            var(--glow),
            transparent 55%),
        var(--bg);
}


.login-card {
    position: relative;
    width: 100%;
    max-width: 430px;
    padding: 2rem;
    border-radius: 24px;
    background:
        linear-gradient(135deg,
            rgb(from var(--card) r g b / .55),
            rgb(from var(--card) r g b / .35));
    border: 1px solid rgb(from white r g b / .12);
    backdrop-filter: blur(24px) saturate(180%);
    -webkit-backdrop-filter: blur(24px) saturate(180%);
    overflow: hidden;
    isolation: isolate;
    box-shadow:
        0 30px 60px rgba(0, 0, 0, .25),
        inset 0 1px rgba(255, 255, 255, .18);
}


.login-card::after {
    content: "";
    position: absolute;
    inset: 1px;
    border-radius: inherit;
    background:
        linear-gradient(180deg,
            rgba(255, 255, 255, .10),
            rgba(255, 255, 255, .02) 35%,
            transparent 70%);
    pointer-events: none;
    z-index: -1;
}


@keyframes loginBorder {
    to {
        transform: rotate(360deg);
    }
}


.login-tools {
    display: flex;
    justify-content: flex-end;
    gap: .6rem;
    margin-bottom: 1.8rem;
}


.login-header {
    text-align: center;
    margin-bottom: 2rem;
}


.login-header h1 {
    margin: 0;
    color: var(--text);
    font-family: var(--font-heading);
    font-size: 2rem;
    font-weight: 700;
    letter-spacing: -.04em;
}


.login-header p {
    margin-top: .6rem;
    color: var(--text);
    font-size: .9rem;
}


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


:deep(.p-password-toggle-mask-icon),
:deep(.p-password-toggle-unmask-icon) {
    position: absolute;
    right: 1rem;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    color: var(--text-muted);
    transition: color var(--transition-fast), transform var(--transition-fast);
}

:deep(.p-password-toggle-mask-icon:hover),
:deep(.p-password-toggle-unmask-icon:hover) {
    color: var(--primary);
    transform: translateY(-50%) scale(1.1);
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


@media(max-width:480px) {
    .login-page {
        padding: 1rem;
    }

    .login-card {
        padding: 1.5rem;
    }

    .login-header h1 {
        font-size: 1.6rem;
    }
}
</style>