<template>
    <nav class="navbar">
        <Toolbar class="navbar-toolbar">

            <template #start>
                <Link :href="route('home.index')" class="nav-logo">
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

                    <!-- <Link :href="route('login')">
                            <Button text :label="$t('home.login')" :pt="secondaryButtonPt" />
                        </Link>
                        <Link :href="route('register')">
                            <Button :label="$t('home.register')" :pt="secondaryButtonPt" />
                        </Link> -->
                </div>

                <button class="hamburger" :class="{ open: mobileOpen }" @click="mobileOpen = true"
                    aria-label="Open menu">
                    <span></span><span></span><span></span>
                </button>
            </template>

        </Toolbar>

        <!-- Mobile drawer -->
        <Drawer v-model:visible="mobileOpen" position="right" :pt="mobileDrawerPt">
            <template #header>
                <Link :href="route('home.index')" class="nav-logo" @click="mobileOpen = false">
                    <NavLogo />
                </Link>
            </template>

            <div class="mobile-menu">
                <div class="mobile-links">
                    <a v-for="link in navLinks" :key="link.href" :href="link.href" class="mobile-link"
                        @click="mobileOpen = false">
                        <span>{{ $t(link.label) }}</span>
                    </a>
                </div>

                <Divider :pt="sectionDividerPt" />

                <div class="mobile-actions">
                    <div class="mobile-options">
                        <LanguageSwitcher />
                        <ThemeSwitcher />
                    </div>

                    <!--
                        <Link :href="route('login')" @click="mobileOpen = false">
                            <Button fluid text :label="$t('home.login')" :pt="textButtonPt" />
                        </Link>

                        <Link :href="route('register')" @click="mobileOpen = false">
                            <Button fluid :label="$t('home.register')" :pt="primaryButtonPt" />
                        </Link>
                        -->
                </div>
            </div>
        </Drawer>
    </nav>
</template>

<script setup>
// -----------------------------
// Imports
// -----------------------------
import { ref } from 'vue'
import { Link } from '@inertiajs/vue3'
import NavLogo from '@/Components/Shared/Logo/NavLogo.vue'
import LanguageSwitcher from '@/Components/Shared/LanguageSwitcher.vue'
import ThemeSwitcher from '@/Components/Shared/ThemeSwitcher.vue'
import { secondaryButtonPt } from '@/PrimeVue/PT/button.pt'
import { mobileDrawerPt } from '@/PrimeVue/PT/drawer.pt'
import { sectionDividerPt } from '@/PrimeVue/PT/devider.pt'
import { Drawer } from 'primevue'
import Toolbar from 'primevue/toolbar'
import Button from 'primevue/button'
import Divider from 'primevue/divider'

// -----------------------------
// Props & Emits
// -----------------------------
const props = defineProps({
    navLinks: Array,
});

// -----------------------------
// Stores & Composables
// -----------------------------

// -----------------------------
// Provides & Injects
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


/* =================================
   MOBILE MENU
================================= */

.mobile-menu {
    display: flex;
    flex-direction: column;
    height: 100%;
    background: linear-gradient(180deg,
            var(--bg-2) 0%,
            var(--bg) 100%);
}

.mobile-links {
    display: flex;
    flex-direction: column;
    gap: .75rem;
}

.mobile-link {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 0.5rem 1.2rem;
    border: 1px solid var(--border);
    border-radius: var(--radius);
    background: var(--card);
    color: var(--text);
    text-decoration: none;
    font-weight: var(--font-weight-medium);
    transition:
        background var(--transition-fast),
        border-color var(--transition-fast),
        color var(--transition-fast),
        transform var(--transition-fast),
        box-shadow var(--transition-fast);
}

.mobile-link:hover {
    color: var(--primary);
    background: var(--tag-bg);
    border-color: var(--primary);
    transform: translateY(-2px);
    box-shadow: 0 10px 24px -16px var(--glow);
}

.mobile-link .material-symbols-outlined {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 2.5rem;
    height: 2.5rem;
    font-size: 1.35rem;
    color: var(--primary);
    background: var(--tag-bg);
    border: 1px solid var(--border);
    border-radius: 50%;
    transition:
        transform var(--transition-fast),
        background var(--transition-fast),
        border-color var(--transition-fast);
}

.mobile-link:hover .material-symbols-outlined {
    transform: rotate(-8deg) scale(1.08);
    border-color: var(--primary);
}

.mobile-options {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    margin: 1.5rem 0;
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: var(--radius);
}

.mobile-actions {
    display: flex;
    flex-direction: column;
    gap: .75rem;
    margin-top: auto;
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
}
</style>