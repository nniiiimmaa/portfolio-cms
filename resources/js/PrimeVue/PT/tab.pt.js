const langTabListPt = {
    root: {
        class: [
            'mb-6',
            'bg-transparent',
            'border-b',
            'border-[var(--border)]',
            'gap-1'
        ]
    },
    activeBar: {
        class: [
            'bg-[var(--primary)]'
        ]
    }
}

const langTabPt = {
    root: {
        class: [
            'inline-flex',
            'items-center',
            'gap-1.5',
            'bg-transparent',
            'border-0',
            'border-b-2',
            'border-transparent',
            'text-[var(--text-muted)]',
            'font-[var(--font-primary)]',
            'text-[0.85rem]',
            'font-[var(--font-weight-medium)]',
            'px-4',
            'py-2.5',
            'transition-colors',
            'duration-200',
            'hover:text-[var(--text)]'
        ]
    }
}

const langTabPanelsPt = {
    root: {
        class: [
            'bg-transparent',
            'p-0'
        ]
    }
}

export {
    langTabListPt,
    langTabPt,
    langTabPanelsPt
}