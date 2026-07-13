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
        }
    },

    // showIcon: {
    //     class: [
    //         'absolute',
    //         'right-4',
    //         'top-1/2',
    //         '-translate-y-1/2',
    //         'cursor-pointer',
    //         'text-[var(--text-muted)]',
    //         'hover:text-[var(--primary)]',
    //         'transition-colors',
    //         'duration-200'
    //     ]
    // },

    // hideIcon: {
    //     class: [
    //         'absolute',
    //         'right-4',
    //         'top-1/2',
    //         '-translate-y-1/2',
    //         'cursor-pointer',
    //         'text-[var(--text-muted)]',
    //         'hover:text-[var(--primary)]',
    //         'transition-colors',
    //         'duration-200'
    //     ]
    // }
};

export { loginPasswordPt };