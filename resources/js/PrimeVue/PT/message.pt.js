const authMessagePt = {
    root: {
        class: [
            'mt-2',
            'px-3',
            'py-2',
            'rounded-[var(--radius-sm)]',
            'border',
            'border-[color:color-mix(in_srgb,var(--danger),transparent_65%)]',
            'bg-[color:color-mix(in_srgb,var(--danger),transparent_92%)]',
            'backdrop-blur-md',
            'shadow-sm'
        ]
    },

    content: {
        class: [
            'flex',
            'items-center',
            'gap-2'
        ]
    },

    text: {
        class: [
            'text-xs',
            'font-medium',
            'leading-5',
            'text-[var(--danger)]'
        ]
    },

    icon: {
        class: [
            'text-[var(--danger)]',
            'text-sm',
            'shrink-0'
        ]
    }
}

export { authMessagePt }