const loginPasswordPt = {
    root: {
        class: [
            'relative',
            'w-full'
        ]
    },

    pcInputText: {
        root: {
            class: [
                'w-full',
                'px-4',
                'py-3',
                'pr-12',
                'rounded-lg',
                'border',
                'border-[var(--border)]',
                'bg-[var(--bg-3)]',
                'text-[var(--text)]',
                'placeholder:text-[var(--text-subtle)]',
                'outline-none',
                'transition-all',
                'duration-300',
                'focus:border-[var(--primary)]',
                'focus:ring-4',
                'focus:ring-[var(--glow)]'
            ]
        },
    },
};

export { loginPasswordPt };