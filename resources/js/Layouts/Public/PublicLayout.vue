<template>

    <Head :title="title" />

    <div class="public-layout">

        <!-- Navbar -->
        <nav class="navbar">
            <Toolbar class="navbar-toolbar">

                <template #start>
                    <Link :href="route('welcome')" class="nav-logo">
                        <NavLogo />
                    </Link>
                </template>

                <template #center>
                    <div class="nav-links">
                        <a v-for="link in navLinks" :key="link.href" :href="link.href">
                            {{ $t(link.label) }}
                        </a>
                    </div>
                </template>

                <template #end>
                    <div class="nav-actions">
                        <LanguageSwitcher />
                        <ThemeSwitcher />

                        <Link :href="route('login')">
                            <Button text :label="$t('welcome.login')" :pt="secondaryButtonPt" />
                        </Link>
                        <Link :href="route('register')">
                            <Button :label="$t('welcome.register')" :pt="secondaryButtonPt" />
                        </Link>
                    </div>

                    <button class="hamburger" :class="{ open: mobileOpen }" @click="mobileOpen = true" aria-label="Open menu">
                        <span></span><span></span><span></span>
                    </button>
                </template>

            </Toolbar>
        </nav>

        <!-- Mobile drawer -->
        <div class="mobile-drawer" :class="{ open: mobileOpen }">
            <div class="mobile-drawer-backdrop" @click="mobileOpen = false"></div>
            <div class="mobile-drawer-panel">

                <div class="mobile-drawer-header">
                    <Link :href="route('welcome')" class="nav-logo" @click="mobileOpen = false">
                        <NavLogo />
                    </Link>
                    <button class="icon-btn" @click="mobileOpen = false" aria-label="Close menu">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>

                <a
                    v-for="link in navLinks"
                    :key="link.href"
                    :href="link.href"
                    class="drawer-link"
                    @click="mobileOpen = false"
                >
                    {{ $t(link.label) }}
                </a>

                <div class="drawer-divider"></div>

                <div class="drawer-controls">
                    <LanguageSwitcher />
                    <ThemeSwitcher />
                </div>

                <div class="drawer-actions">
                    <Link :href="route('login')" @click="mobileOpen = false">
                        <Button outlined :label="$t('welcome.login')" :pt="secondaryButtonPt" class="drawer-btn" />
                    </Link>
                    <Link :href="route('register')" @click="mobileOpen = false">
                        <Button :label="$t('welcome.register')" :pt="secondaryButtonPt" class="drawer-btn" />
                    </Link>
                </div>

            </div>
        </div>

        <!-- Body -->
        <main class="public-body">
            <slot />
        </main>

        <!-- Footer -->
        <footer class="footer">
            <Divider />
            <div class="footer-inner">
                <Link :href="route('welcome')" class="nav-logo">
                    <NavLogo />
                </Link>
                <div class="footer-socials">
                    <a
                        v-for="social in socialLinks"
                        :key="social.name"
                        :href="social.url"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="social-icon"
                        :aria-label="social.name"
                    >
                        <img :src="social.icon" :alt="social.name" />
                    </a>
                </div>
            </div>
            <p class="footer-bottom">{{ $t('welcome.footer') }}</p>
        </footer>

    </div>

</template>
<script setup>
// -----------------------------
// Imports
// -----------------------------
import { ref } from 'vue'
import { Head, Link } from '@inertiajs/vue3'
import NavLogo from '@/Components/Shared/Logo/NavLogo.vue'

import Toolbar from 'primevue/toolbar'
import Button from 'primevue/button'
import Divider from 'primevue/divider'

import LanguageSwitcher from '@/Components/Shared/LanguageSwitcher.vue'
import ThemeSwitcher from '@/Components/Shared/ThemeSwitcher.vue'

import { secondaryButtonPt } from '@/PrimeVue/PT/button.pt'


// -----------------------------
// Props & Emits
// -----------------------------
const props = defineProps({
    title: {
        type: String,
        default: '',
    },
    navLinks: {
        type: Array,
        default: () => ([
            { label: 'welcome.about', href: '#about' },
            { label: 'welcome.experience', href: '#experience' },
            { label: 'welcome.projects', href: '#projects' },
            { label: 'welcome.education', href: '#education' },
            { label: 'welcome.certificates', href: '#certificates' },
            { label: 'welcome.skills', href: '#skills' },
            { label: 'welcome.hobbies', href: '#hobbies' },
            { label: 'welcome.testimonials', href: '#testimonials' },
            { label: 'welcome.contact', href: '#contact' },
        ]),
    },
    socialLinks: {
        type: Array,
        // replace with your real profiles/icons — these are placeholders
        default: () => ([
            { name: 'GitHub', url: 'https://github.com/your-username', icon: '/images/icons/github.svg' },
            { name: 'LinkedIn', url: 'https://linkedin.com/in/your-username', icon: '/images/icons/linkedin.svg' },
            { name: 'Instagram', url: 'https://instagram.com/your-username', icon: '/images/icons/instagram.svg' },
            { name: 'Email', url: 'mailto:you@example.com', icon: '/images/icons/mail.svg' },
        ]),
    },
})


// -----------------------------
// Stores & Composables
// -----------------------------


// -----------------------------
// Refs & Reactives & Vars
// -----------------------------
const mobileOpen = ref(false)


// -----------------------------
// Computed & Watch
// -----------------------------


// -----------------------------
// Methods
// -----------------------------


// -----------------------------
// Hooks
// -----------------------------
</script>
<style scoped>
/* =================================
   PAGE
================================= */

.public-layout {
    min-height: 100vh;
    background: var(--bg);
    color: var(--text);
    font-family: var(--font-primary);
    position: relative;
    overflow-x: hidden;
    display: flex;
    flex-direction: column;
}


/* =================================
   NAVBAR
================================= */

.navbar {
    position: sticky;
    top: 0;
    z-index: 100;
}

:deep(.navbar-toolbar) {
    height: 64px;
    padding: 0 2rem;
    background: color-mix(in srgb, var(--bg) 85%, transparent);
    backdrop-filter: blur(16px);
    border: none;
    border-bottom: 1px solid var(--border);
    transition: border-color var(--transition-normal), background var(--transition-normal);
}

.nav-logo {
    display: flex;
    align-items: center;
    transition: transform var(--transition-fast);
}

.nav-logo:hover {
    transform: translateY(-1px);
}

.nav-links {
    display: flex;
    gap: 1.15rem;
}

.nav-links a {
    position: relative;
    color: var(--text-muted);
    text-decoration: none;
    font-size: .85rem;
    white-space: nowrap;
    transition: color var(--transition-fast);
}

.nav-links a::after {
    content: "";
    position: absolute;
    left: 0;
    bottom: -4px;
    width: 100%;
    height: 1px;
    background: var(--primary);
    transform: scaleX(0);
    transform-origin: left;
    transition: transform var(--transition-normal);
}

.nav-links a:hover {
    color: var(--primary);
}

.nav-links a:hover::after {
    transform: scaleX(1);
}

.nav-actions {
    display: flex;
    align-items: center;
    gap: .75rem;
}

.icon-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 34px;
    height: 34px;
    border: 1px solid var(--border);
    border-radius: var(--radius-sm);
    background: var(--bg-3);
    color: var(--text-muted);
    cursor: pointer;
    transition: border-color var(--transition-fast), color var(--transition-fast);
}

.icon-btn:hover {
    border-color: var(--border-strong);
    color: var(--text);
}


/* -----------------------------
   Hamburger trigger (mobile)
   ----------------------------- */

.hamburger {
    display: none;
    flex-direction: column;
    justify-content: center;
    gap: 5px;
    width: 38px;
    height: 38px;
    background: var(--bg-3);
    border: 1px solid var(--border);
    border-radius: var(--radius-sm);
    cursor: pointer;
    padding: 8px;
    flex-shrink: 0;
    transition: border-color var(--transition-fast);
}

.hamburger:hover {
    border-color: var(--border-strong);
}

.hamburger span {
    display: block;
    height: 2px;
    width: 100%;
    background: var(--text-muted);
    border-radius: 2px;
    transform-origin: center;
    transition:
        transform .32s cubic-bezier(.77, 0, .18, 1),
        opacity .22s ease,
        background var(--transition-fast);
}

.hamburger.open span {
    background: var(--primary);
}

.hamburger.open span:nth-child(1) {
    transform: translateY(7px) rotate(45deg);
}

.hamburger.open span:nth-child(2) {
    opacity: 0;
    transform: scaleX(0);
}

.hamburger.open span:nth-child(3) {
    transform: translateY(-7px) rotate(-45deg);
}


/* -----------------------------
   Mobile drawer
   ----------------------------- */

.mobile-drawer {
    position: fixed;
    inset: 0;
    z-index: 199;
    pointer-events: none;
}

.mobile-drawer-backdrop {
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, .5);
    backdrop-filter: blur(3px);
    opacity: 0;
    transition: opacity .32s ease;
}

.mobile-drawer-panel {
    position: absolute;
    top: 0;
    right: 0;
    width: min(300px, 82vw);
    height: 100%;
    background: var(--bg-2);
    border-left: 1px solid var(--border);
    box-shadow: -18px 0 40px rgba(0, 0, 0, .18);
    transform: translateX(100%);
    transition: transform .38s cubic-bezier(.77, 0, .18, 1);
    padding: 1.5rem;
    display: flex;
    flex-direction: column;
    gap: 6px;
    overflow-y: auto;
}

.mobile-drawer-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 1rem;
}

.mobile-drawer.open {
    pointer-events: all;
}

.mobile-drawer.open .mobile-drawer-backdrop {
    opacity: 1;
}

.mobile-drawer.open .mobile-drawer-panel {
    transform: translateX(0);
}

.drawer-link {
    position: relative;
    display: block;
    text-decoration: none;
    color: var(--text-muted);
    font-size: .95rem;
    padding: 12px 14px;
    border-radius: var(--radius-sm);
    transition:
        background var(--transition-fast),
        color var(--transition-fast),
        transform var(--transition-fast);
}

.drawer-link:hover {
    background: var(--tag-bg);
    color: var(--primary);
    transform: translateX(4px);
}

.drawer-divider {
    height: 1px;
    background: var(--border);
    margin: .75rem 0;
}

.drawer-controls {
    display: flex;
    align-items: center;
    gap: .5rem;
    padding: 0 14px;
    margin-bottom: .5rem;
}

.drawer-actions {
    display: flex;
    flex-direction: column;
    gap: .6rem;
    padding: 0 14px;
    margin-top: .25rem;
}

:deep(.drawer-btn) {
    width: 100%;
    justify-content: center;
}


/* =================================
   BUTTONS (shared shine treatment)
================================= */

:deep(.p-button) {
    position: relative;
    overflow: hidden;
    border-radius: 999px;
    padding: .7rem 1.6rem;
    font-weight: var(--font-weight-medium);
    transition:
        transform var(--transition-fast),
        box-shadow var(--transition-fast),
        background var(--transition-fast),
        border-color var(--transition-fast);
}

:deep(.p-button::before) {
    content: "";
    position: absolute;
    top: -120%;
    left: -120%;
    width: 60%;
    height: 300%;
    transform: rotate(25deg);
    background: linear-gradient(to right, transparent, rgba(255, 255, 255, .35), transparent);
    opacity: 0;
    transition: opacity .25s ease;
}

:deep(.p-button:hover::before) {
    opacity: 1;
    animation: shine .9s ease;
}

@keyframes shine {
    from { left: -120%; }
    to { left: 180%; }
}

:deep(.p-button:not(.p-button-outlined)) {
    background: var(--primary);
    border-color: var(--primary);
}

:deep(.p-button:not(.p-button-outlined):hover) {
    background: var(--primary-hover);
    border-color: var(--primary-hover);
    transform: translateY(-2px);
    box-shadow: 0 10px 24px -8px var(--glow);
}

:deep(.p-button-outlined) {
    color: var(--text);
    border-color: var(--border-strong);
    background: transparent;
}

:deep(.p-button-outlined:hover) {
    border-color: var(--primary);
    background: var(--tag-bg);
    transform: translateY(-2px);
}


/* =================================
   BODY
================================= */

.public-body {
    flex: 1;
    position: relative;
    z-index: 1;
}


/* =================================
   FOOTER
================================= */

.footer {
    position: relative;
    z-index: 1;
    padding: 0 2rem 2rem;
}

:deep(.footer .p-divider) {
    margin: 0 0 1.5rem;
}

.footer-inner {
    max-width: 960px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1.5rem;
    flex-wrap: wrap;
}

.footer-socials {
    display: flex;
    align-items: center;
    gap: .6rem;
}

.social-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: var(--bg-3);
    border: 1px solid var(--border);
    transition:
        transform var(--transition-fast),
        border-color var(--transition-fast),
        box-shadow var(--transition-fast);
}

.social-icon img {
    width: 46%;
    height: auto;
}

.social-icon:hover {
    transform: translateY(-3px);
    border-color: var(--primary);
    box-shadow: 0 8px 18px -8px var(--glow);
}

.footer-bottom {
    max-width: 960px;
    margin: 1.5rem auto 0;
    text-align: center;
    font-size: .78rem;
    color: var(--text-subtle);
}


/* =================================
   RESPONSIVE
================================= */

@media (max-width: 1024px) {

    :deep(.navbar-toolbar) {
        padding: 0 1.2rem;
    }

    .nav-links {
        display: none;
    }

    .nav-actions {
        display: none;
    }

    .hamburger {
        display: flex;
    }

    .footer {
        padding: 0 1.2rem 1.5rem;
    }

    .footer-inner {
        flex-direction: column;
        text-align: center;
    }

}


/* =================================
   MOTION SAFETY
================================= */

@media (prefers-reduced-motion: reduce) {
    .hamburger span,
    .mobile-drawer-backdrop,
    .mobile-drawer-panel,
    .drawer-link,
    :deep(.p-button) {
        transition-duration: .001ms !important;
    }
}
</style>