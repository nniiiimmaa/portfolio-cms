const dialogPt = {
    root: {
        class: [
            'overflow-hidden',
            'bg-[var(--card)]',
            'text-[var(--text)]',
            'border',
            'border-[var(--border)]',
            'rounded-[calc(var(--radius)+6px)]',
            'shadow-[0_30px_70px_-20px_rgba(0,0,0,.5)]'
        ]
    },

    header: {
        class: [
            'bg-[var(--card)]',
            'text-[var(--text)]',
            'border-b',
            'border-[var(--border)]',
            'pt-[1.6rem]',
            'px-[1.75rem]',
            'pb-[1.4rem]'
        ]
    },

    content: {
        class: [
            'bg-[var(--card)]',
            'text-[var(--text)]',
            'pt-[1.6rem]',
            'px-[1.75rem]',
            'pb-[1.75rem]'
        ]
    },

    footer: {
        class: [
            'bg-[var(--card)]',
            'text-[var(--text)]',
            'border-t',
            'border-[var(--border)]',
            'py-[1.3rem]',
            'px-[1.75rem]',
            'flex',
            'justify-end',
            'gap-3'
        ]
    },

    closeButton: {
        class: [
            'text-[var(--text-muted)]',
            'rounded-[var(--radius-sm)]',
            'transition-colors',
            'hover:text-[var(--text)]',
            'hover:bg-[var(--tag-bg)]'
        ]
    },

    mask: {
        class: [
            'bg-[rgba(0,0,0,.6)]',
            'backdrop-blur-[2px]'
        ]
    }
};

export { dialogPt };