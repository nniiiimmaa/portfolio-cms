const authInputTextPt = {
    root: {
        class: [
            'w-full',
            'px-4',
            'py-3',
            'rounded-lg',
            'border',
            'border-[var(--border)]',
            'bg-[var(--bg-3)]',
            'text-[var(--text)]',
            'placeholder:text-[var(--text-subtle)]',
            'transition-all',
            'duration-300',            
            'outline-none',
            'focus:bg-[var(--bg-1)]',
            'focus:border-[var(--primary)]',
            'focus:ring-4',
            'focus:ring-[var(--glow)]'
        ]
    }
}

const formInputPt = {
    root: {
        class: [
            'w-full',
            'px-3.5',
            'py-2.5',
            'rounded-[var(--radius-sm)]',
            'border',
            'border-[var(--border)]',
            'bg-[var(--bg-3)]',
            'text-[var(--text)]',
            'font-[var(--font-primary)]',
            'text-[0.9rem]',
            'transition-all',
            'duration-200',
            'focus:outline-none',
            'focus:border-[var(--primary)]',
            'focus:ring-4',
            'focus:ring-[var(--tag-bg)]',
            'invalid:border-[var(--danger)]'
        ]
    }
}

export { authInputTextPt, formInputPt }