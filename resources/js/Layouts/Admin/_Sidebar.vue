<template>
    <aside class="sidebar" :class="{ open: sidebarStore.open }">

        <div class="sidebar-header">
            <Link :href="route('dashboard')" class="sidebar-logo">
                <NavLogo />
            </Link>
            <button class="sidebar-close" @click="sidebarStore.closeSidebar()" aria-label="Close menu">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>

        <nav class="sidebar-nav">
            <Link v-for="item in navItems" :key="item.route" :href="route(item.route)" class="sidebar-link"
                :class="{ active: route().current(item.route) }" @click="sidebarStore.closeSidebar()">
                <span class="material-symbols-outlined">{{ item.icon }}</span>
                <span class="sidebar-link-label">{{ $t(item.label) }}</span>
            </Link>
        </nav>

        <div class="sidebar-footer">

            <div class="sidebar-controls">
                <LanguageSwitcher />
                <ThemeSwitcher />
            </div>

            <div class="sidebar-divider"></div>

            <div class="sidebar-user">
                <Avatar :label="!user?.avatar ? initials : undefined" :image="user?.avatar || undefined" shape="circle"
                    class="user-avatar" />
                <div class="user-info">
                    <span class="user-name">{{ user?.name }}</span>
                    <span class="user-email">{{ user?.email }}</span>
                </div>
                <Link :href="route('logout')" method="post" as="button" class="user-logout" :title="$t('layout.admin.logout')">
                    <span class="material-symbols-outlined">logout</span>
                </Link>
            </div>

        </div>

    </aside>

    <div class="sidebar-backdrop" :class="{ open: sidebarStore.open }" @click="sidebarStore.closeSidebar()"></div>

</template>

<script setup>
// -----------------------------
// Imports
// -----------------------------
import NavLogo from '@/Components/Shared/Logo/NavLogo.vue'
import Avatar from 'primevue/avatar'
import LanguageSwitcher from '@/Components/Shared/LanguageSwitcher.vue'
import ThemeSwitcher from '@/Components/Shared/ThemeSwitcher.vue'
import { Link, usePage } from '@inertiajs/vue3'
import { computed } from 'vue'
import { useSidebarStore } from '@/Stores/sibebar'


// -----------------------------
// Stores & Composables
// -----------------------------
const page = usePage()
const sidebarStore = useSidebarStore()

// -----------------------------
// Refs & Reactives & Vars
// -----------------------------
const navItems = [
    { icon: 'dashboard', label: 'layout.admin.dashboard', route: 'dashboard' },
    // { icon: 'folder_open', label: 'layout.admin.projects', route: 'projects.index' },
    // { icon: 'work', label: 'layout.admin.experience', route: 'experience.index' },
    // { icon: 'school', label: 'layout.admin.education', route: 'education.index' },
    // { icon: 'code', label: 'layout.admin.skills', route: 'skills.index' },
    // { icon: 'mail', label: 'layout.admin.messages', route: 'messages.index' },
    // { icon: 'settings', label: 'layout.admin.settings', route: 'settings.index' },
]

// -----------------------------
// Computed & Watch
// -----------------------------
const user = computed(() => page.props.auth?.user)

const initials = computed(() => {
    if (!user.value?.name) return ''
    return user.value.name
        .split(' ')
        .map((part) => part[0])
        .slice(0, 2)
        .join('')
        .toUpperCase()
})

// -----------------------------
// Methods
// -----------------------------


// -----------------------------
// Hooks
// -----------------------------


</script>
<style scoped>
/* =================================
   SIDEBAR
================================= */

.sidebar {
    position: fixed;
    top: 0;
    left: 0;
    bottom: 0;
    z-index: 110;
    width: 264px;
    display: flex;
    flex-direction: column;
    background: var(--bg-2);
    border-right: 1px solid var(--border);
    transition: transform var(--transition-normal);
}

.sidebar-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    height: 64px;
    padding: 0 1.25rem;
    border-bottom: 1px solid var(--border);
    flex-shrink: 0;
}

.sidebar-logo {
    display: flex;
    align-items: center;
    transition: transform var(--transition-fast);
}

.sidebar-logo:hover {
    transform: translateY(-1px);
}

.sidebar-close {
    display: none;
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

.sidebar-close:hover {
    border-color: var(--border-strong);
    color: var(--text);
}


/* -----------------------------
   Nav links
   ----------------------------- */

.sidebar-nav {
    flex: 1;
    overflow-y: auto;
    padding: 1.25rem .875rem;
    display: flex;
    flex-direction: column;
    gap: .25rem;
}

.sidebar-link {
    position: relative;
    display: flex;
    align-items: center;
    gap: .8rem;
    padding: .7rem .9rem;
    border-radius: var(--radius-sm);
    color: var(--text-muted);
    text-decoration: none;
    font-size: .92rem;
    overflow: hidden;
    transition:
        background var(--transition-fast),
        color var(--transition-fast),
        transform var(--transition-fast);
}

.sidebar-link .material-symbols-outlined {
    font-size: 20px;
    transition: transform var(--transition-fast);
}

.sidebar-link:hover {
    background: var(--tag-bg);
    color: var(--text);
    transform: translateX(3px);
}

.sidebar-link:hover .material-symbols-outlined {
    transform: scale(1.08);
}

/* active indicator bar */
.sidebar-link::before {
    content: "";
    position: absolute;
    left: 0;
    top: 50%;
    width: 3px;
    height: 0;
    border-radius: 0 3px 3px 0;
    background: var(--primary);
    transform: translateY(-50%);
    transition: height var(--transition-fast);
}

.sidebar-link.active {
    background: var(--tag-bg);
    color: var(--primary);
}

.sidebar-link.active::before {
    height: 60%;
}

.sidebar-link.active .material-symbols-outlined {
    color: var(--primary);
}


/* -----------------------------
   Footer: controls + user
   ----------------------------- */

.sidebar-footer {
    flex-shrink: 0;
    padding: 1rem .875rem 1.25rem;
    border-top: 1px solid var(--border);
}

.sidebar-controls {
    display: flex;
    align-items: center;
    gap: .5rem;
}

.sidebar-divider {
    height: 1px;
    background: var(--border);
    margin: 1rem 0;
}

.sidebar-user {
    display: flex;
    align-items: center;
    gap: .7rem;
    padding: .5rem;
    border-radius: var(--radius-sm);
    transition: background var(--transition-fast);
}

.sidebar-user:hover {
    background: var(--bg-3);
}

:deep(.user-avatar) {
    flex-shrink: 0;
    min-width: 1.5rem;
    background: var(--tag-bg);
    color: var(--primary);
    font-weight: var(--font-weight-semibold);
}

.user-info {
    display: flex;
    flex-direction: column;
    min-width: 0;
    flex: 1;
}

.user-name {
    font-size: .86rem;
    font-weight: var(--font-weight-medium);
    color: var(--text);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.user-email {
    font-size: .75rem;
    color: var(--text-subtle);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.user-logout {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    flex-shrink: 0;
    border: none;
    border-radius: var(--radius-sm);
    background: transparent;
    color: var(--text-subtle);
    cursor: pointer;
    transition: background var(--transition-fast), color var(--transition-fast);
}

.user-logout:hover {
    background: rgba(225, 29, 72, .12);
    color: var(--danger);
}


/* -----------------------------
   Backdrop (mobile only)
   ----------------------------- */

.sidebar-backdrop {
    display: none;
    position: fixed;
    inset: 0;
    z-index: 105;
    background: rgba(0, 0, 0, .5);
    backdrop-filter: blur(3px);
    opacity: 0;
    pointer-events: none;
    transition: opacity var(--transition-normal);
}

/* =================================
   RESPONSIVE
================================= */

@media (max-width: 960px) {

    .sidebar {
        transform: translateX(-100%);
        box-shadow: 18px 0 40px rgba(0, 0, 0, .18);
    }

    .sidebar.open {
        transform: translateX(0);
    }

    .sidebar-close {
        display: flex;
    }

    .sidebar-backdrop.open {
        opacity: 1;
        pointer-events: all;
    }

    .admin-main {
        margin-left: 0;
    }

    .sidebar-toggle {
        display: flex;
    }
}

</style>