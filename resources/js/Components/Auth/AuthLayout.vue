<template>
    <div class="login-page">
        <Logo size="45vw" class="absolute opacity-25"/>

        <div class="login-card">

            <div class="login-tools">
                <LanguageSwitcher />
                <ThemeSwitcher />
            </div>

            <div class="login-header">
                <h1>{{ title }}</h1>
                <p>{{ subtitle }}</p>
            </div>

            <slot />

        </div>
    </div>
</template>
<script setup>
// -----------------------------
// Imports
// -----------------------------
import Logo from '@/Components/Shared/Logo/Logo.vue'
import ThemeSwitcher from '@/Components/Shared/ThemeSwitcher.vue'
import LanguageSwitcher from '@/Components/Shared/LanguageSwitcher.vue'

// -----------------------------
// Props & Emits
// -----------------------------
const props = defineProps({
    title: {
        type: String,
        required: true,
    },

    subtitle: {
        type: String,
        required: true,
    },
})
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
    max-width: 550px;
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