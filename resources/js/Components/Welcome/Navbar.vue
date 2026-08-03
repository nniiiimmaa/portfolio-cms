<template>
    <!-- Navigation -->
    <nav class="navbar">
        <Toolbar :pt="navbarToolbarPt">
            <template #start>
                <Link :href="route('welcome')" class="nav-logo">
                    <NavLogo />
                </Link>
            </template>

            <template #center>
                <div class="nav-links">
                    <a href="#features">
                        {{ $t('welcome.features') }}
                    </a>

                    <a href="#tech">
                        {{ $t('welcome.technologies') }}
                    </a>
                </div>
            </template>

            <template #end>
                <div class="nav-actions">
                    <LanguageSwitcher />

                    <ThemeSwitcher />

                    <Link :href="route('login')">
                        <Button text :label="$t('welcome.login')" :pt="primaryButtonPt" />
                    </Link>

                    <!-- <Link :href="route('register')">
                        <Button :label="$t('welcome.register')" :pt="primaryButtonPt" />
                    </Link> -->
                </div>

                <Button text :pt="menuButtonPt" class="nav-menu-button" @click="mobileMenu = true">
                    <span class="material-symbols-outlined">
                        menu
                    </span>
                </Button>
            </template>
        </Toolbar>

        <Drawer v-model:visible="mobileMenu" position="right" :pt="mobileDrawerPt">
            <template #header>
                <Link :href="route('welcome')" class="nav-logo">
                    <NavLogo />
                </Link>
            </template>

            <div class="mobile-menu">
                <div class="mobile-links">
                    <a href="#features" class="mobile-link" @click="mobileMenu = false">
                        <span class="material-symbols-outlined">
                            dashboard
                        </span>

                        <span>{{ $t('welcome.features') }}</span>
                    </a>

                    <a href="#tech" class="mobile-link" @click="mobileMenu = false">
                        <span class="material-symbols-outlined">
                            code
                        </span>

                        <span>{{ $t('welcome.technologies') }}</span>
                    </a>
                </div>

                <Divider :pt="sectionDividerPt" />


                <div class="mobile-actions">
                    <div class="mobile-options">
                        <LanguageSwitcher />

                        <ThemeSwitcher />
                    </div>
                    <Link :href="route('login')" @click="mobileMenu = false">
                        <Button fluid text :label="$t('welcome.login')" :pt="textButtonPt" />
                    </Link>

                    <Link :href="route('register')" @click="mobileMenu = false">
                        <Button fluid :label="$t('welcome.register')" :pt="primaryButtonPt" />
                    </Link>
                </div>
            </div>
        </Drawer>
    </nav>
</template>

<script setup>
// -----------------------------
// Imports
// -----------------------------
import { Link } from '@inertiajs/vue3'
import { ref } from 'vue'
import Toolbar from 'primevue/toolbar'
import Drawer from 'primevue/drawer'
import Button from 'primevue/button'
import Divider from 'primevue/divider'
import NavLogo from '@/Components/Shared/Logo/NavLogo.vue'
import LanguageSwitcher from '@/Components/Shared/LanguageSwitcher.vue'
import ThemeSwitcher from '@/Components/Shared/ThemeSwitcher.vue'
import { navbarToolbarPt } from '@/PrimeVue/PT/toolbar.pt'
import { mobileDrawerPt } from '@/PrimeVue/PT/drawer.pt'
import { primaryButtonPt, textButtonPt, menuButtonPt } from '@/PrimeVue/PT/button.pt'
import { sectionDividerPt } from '@/PrimeVue/PT/devider.pt'


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
const mobileMenu = ref(false);


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
    position: fixed;
    inset: 0 0 auto;
    z-index: 1000;
}

.nav-logo {
    display: flex;
    align-items: center;
    text-decoration: none;
}

.nav-links {
    display: flex;
    align-items: center;
    gap: 2rem;
}

.nav-links a {
    color: var(--text-muted);
    text-decoration: none;
    font-weight: var(--font-weight-medium);
    transition: color var(--transition-fast);
}

.nav-links a:hover {
    color: var(--primary);
}

.nav-actions {
    display: flex;
    align-items: center;
    gap: .75rem;
}

.nav-menu-button {
    display: none;
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

@media(max-width:640px) {

    .navbar {
        position: sticky;
    }

    :deep(.navbar-toolbar) {
        flex-wrap: wrap;
        height: auto;
        row-gap: .65rem;
        padding: .85rem 1rem;
    }

    :deep(.p-toolbar-start) {
        order: 1;
    }

    :deep(.p-toolbar-end) {
        order: 2;
        margin-left: auto;
    }

    :deep(.p-toolbar-center) {
        order: 3;
        width: 100%;
    }

    .nav-links {
        justify-content: center;
        flex-wrap: wrap;
        gap: 1.5rem;
        font-size: .85rem;
    }

    .nav-actions {
        gap: .4rem;
    }

    :deep(.nav-actions .p-button) {
        padding: .55rem 1rem;
        font-size: .85rem;
    }
}

@media (max-width: 992px) {

    .nav-links,
    .nav-actions {
        display: none;
    }

    .nav-menu-button {
        display: flex;
        align-items: center;
        justify-content: center;
    }

}

@media (min-width: 993px) {

    .mobile-menu {
        display: none;
    }

}

@media(max-width:400px) {

    :deep(.nav-actions .p-button) {
        padding: .5rem .8rem;
        font-size: .8rem;
    }

    .nav-links {
        gap: 1rem;
        font-size: .8rem;
    }

}
</style>