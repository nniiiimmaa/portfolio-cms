const primaryButtonPt = {
    root: {
        class: [
            'rounded-full',
            'px-6',
            'py-3',
            'font-medium',
            'border',
            'border-[var(--primary)]',
            'bg-[var(--primary)]',
            'text-white',
            'transition-all',
            'duration-200',
            'hover:bg-[var(--primary-hover)]',
            'hover:border-[var(--primary-hover)]',
            'hover:-translate-y-0.5',
            'hover:shadow-[0_10px_24px_-8px_var(--glow)]',
            'active:scale-95'
        ]
    }
}

const secondaryButtonPt = {
    root: {
        class: [
            'w-full',
            'py-3',
            'rounded-full',
            'border-none',
            'bg-[var(--primary)]',
            'text-white',
            'font-semibold',
            'transition-all',
            'duration-300',
            'hover:bg-[var(--primary-hover)]',
            'hover:-translate-y-1',
            'hover:shadow-[0_10px_30px_var(--glow)]',
            'active:translate-y-0'
        ]
    }
}

const outlineButtonPt = {
    root: {
        class: [
            'relative overflow-hidden inline-flex items-center justify-center gap-[0.45rem]',
            'rounded-full px-[1.8rem] py-[0.8rem]',
            'font-[var(--font-primary)]',
            'text-[0.9rem]',
            'font-[var(--font-weight-medium)]',
            'no-underline',
            'cursor-pointer',
            'bg-transparent',
            'border border-[var(--border-strong)]',
            'text-[var(--text)]',
            'transition-all',
            'duration-200',
            'hover:border-[var(--primary)]',
            'hover:bg-[var(--tag-bg)]',
            'hover:-translate-y-0.5'
        ]
    }
}

const menuButtonPt = {
    root: {
        class: [
            'rounded-full',
            '!bg-transparent',
            'text-[var(--text)]',
            'transition-all',
            'duration-200',
            'hover:bg-[var(--tag-bg)]',
            'hover:border-[var(--border)]',
            'hover:text-[var(--primary)]',
            'hover:shadow-[0_8px_20px_-12px_var(--glow)]',
            'active:scale-95'
        ]
    }
}

const textButtonPt = {
    root: {
        class: [
            'rounded-full',
            'px-6',
            'py-3',
            'font-medium',
            'text-[var(--text)]',
            'transition-all',
            'duration-200',
            'hover:bg-[var(--tag-bg)]',
            'hover:text-[var(--primary)]',
            'hover:-translate-y-0.5',
            'active:scale-95'
        ]
    }
}

const dangerButtonPt = {
    root: {
        class: [
            'rounded-full',
            'px-6',
            'py-3',
            'font-medium',
            'border',
            'border-[var(--danger)]',
            'bg-[var(--danger)]',
            'text-white',
            'font-[var(--font-primary)]',
            'text-[0.85rem]',
            'transition-all',
            'duration-200',
            'hover:opacity-90',
            'hover:-translate-y-0.5',
            'active:scale-95',
            'disabled:opacity-70',
            'disabled:cursor-default'
        ]
    }
}

export { secondaryButtonPt, primaryButtonPt, textButtonPt, menuButtonPt, outlineButtonPt, dangerButtonPt }