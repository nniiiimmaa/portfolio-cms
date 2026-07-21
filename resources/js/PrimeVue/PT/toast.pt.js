const toastPt = {
    root: {
        class: [
            'w-full max-w-sm',
        ],
    },

    message: ({ props }) => ({
        class: [
            'rounded-xl',
            'border',
            'shadow-lg',
            'backdrop-blur-md',

            'px-5',
            'py-4',

            props.message.severity === 'success' &&
                'bg-green-500/10 border-green-500/30 text-green-500',

            props.message.severity === 'warn' &&
                'bg-yellow-500/10 border-yellow-500/30 text-yellow-500',

            props.message.severity === 'error' &&
                'bg-red-500/10 border-red-500/30 text-red-500',

            props.message.severity === 'info' &&
                'bg-blue-500/10 border-blue-500/30 text-blue-500',
        ],
    }),

    icon: {
        class: [
            'text-xl',
        ],
    },

    summary: {
        class: [
            'font-semibold',
            'text-sm',
            'ms-1',
        ],
    },

    detail: {
        class: [
            'text-sm',
            'opacity-80',
        ],
    },

    closeButton: {
        class: [
            'rounded-full',
            'hover:bg-black/10',
            'p-1'
        ],
    },
};

export { toastPt };