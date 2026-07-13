/**
 * Theme Toggle Button PT Configuration
 *
 * @module PrimeVue/PT/toggleButton
 * @description Defines PrimeVue ToggleButton customization.
 */

const themeTogglePt = {
    root: {
        class: [
            'w-10',
            'h-10',
            'flex',
            'items-center',
            'justify-center',
            'rounded-full',
            'bg-[linear-gradient(180deg,rgba(255,255,255,0.04),rgba(255,255,255,0.01))]',
            'border',
            'border-[var(--border)]',
            'text-[var(--text-muted)]',
            'backdrop-blur-xl',
            'transition-all',
            'duration-300',
            'hover:border-[var(--primary)]',
            'hover:text-[var(--primary)]',
            'hover:-translate-y-0.5',
            'hover:shadow-[0_8px_20px_var(--glow)]',
            'active:scale-95'
        ]
    },

    icon: {
        class: [
            'flex',
            'items-center',
            'justify-center',
            'text-base',
            'transition-transform',
            'duration-300'
        ]
    }
}

export { themeTogglePt }