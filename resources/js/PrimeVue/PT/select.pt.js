/**
 * PrimeVue Select Pass Through Configuration
 *
 * @module PrimeVue/PT/select
 * @description Contains reusable Pass Through configurations
 * for PrimeVue Select components.
 */


/**
 * Language Switcher Select customization.
 *
 * @type {Object}
 */
const languageSelectPt = {
    root: {
        class: [
            'min-w-[120px]',
            'bg-[linear-gradient(180deg,rgba(255,255,255,0.04),rgba(255,255,255,0.01))]',
            'border',
            'border-[var(--border)]',
            'rounded-full',
            'backdrop-blur-xl',
            'text-[var(--text)]',
            'transition-all',
            'duration-300',
            'hover:border-[var(--primary)]',
            'hover:-translate-y-0.5',
            'hover:shadow-[0_8px_20px_var(--glow)]'
        ]
    },
    label: {
        class: [
            'flex',
            'items-center',
            'text-[var(--text)]',
            'px-3',
            'py-2',
            'text-sm'
        ]
    },
    dropdown: {
        class: [
            'text-[var(--text-muted)]'
        ]
    },
    overlay: {
        class: [
            'bg-[var(--card)]',
            'border',
            'border-[var(--border)]',
            'rounded-[var(--radius)]',
            'shadow-[0_20px_40px_rgba(0,0,0,0.18)]',
            'backdrop-blur-xl'
        ]
    },
    option: {
        class: [
            'text-[var(--text-muted)]',
            'rounded-[var(--radius-sm)]',
            'mx-1',
            'my-1',
            'px-3',
            'py-2',
            'transition-all',
            'duration-200',
            'hover:bg-[var(--tag-bg)]',
            'hover:text-[var(--text)]'
        ]
    },
    optionLabel: {
        class: [
            'flex',
            'items-center',
            'gap-2'
        ]
    }
}

export { languageSelectPt }