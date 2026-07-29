<template>

    <section id="cv" class="cv-section">

        <div class="section-header">
            <span class="section-label">{{ $t('publicCv.eyebrow') }}</span>
            <h2 class="section-title">{{ $t('publicCv.title') }}</h2>
            <p class="section-subtitle">{{ $t('publicCv.subtitle') }}</p>
        </div>

        <div class="cv-card">

            <div class="cv-card-top">
                <span class="selected-count">
                    {{ $t('publicCv.selected_count', { count: enabledCount, total: sections.length }) }}
                </span>
                <div class="quick-actions">
                    <button type="button" class="text-btn" @click="selectAll">{{ $t('publicCv.select_all') }}</button>
                    <span class="dot">·</span>
                    <button type="button" class="text-btn" @click="selectNone">{{ $t('publicCv.select_none') }}</button>
                </div>
            </div>

            <div class="section-grid">
                <label
                    v-for="section in sections"
                    :key="section.key"
                    class="section-toggle"
                    :class="{ active: selected[section.key] }"
                >
                    <span class="toggle-icon">
                        <span class="material-symbols-outlined">{{ section.icon }}</span>
                    </span>
                    <span class="toggle-label">{{ $t(`publicCv.sections.${section.key}`) }}</span>
                    <input
                        type="checkbox"
                        class="toggle-input"
                        v-model="selected[section.key]"
                    />
                    <span class="toggle-switch"></span>
                </label>
            </div>

            <div class="cv-footer">
                <p class="cv-hint">
                    <span class="material-symbols-outlined">info</span>
                    {{ $t('publicCv.hint') }}
                </p>

                <button
                    type="button"
                    class="generate-btn"
                    :disabled="enabledCount === 0 || generating"
                    @click="generatePdf"
                >
                    <span v-if="!generating" class="material-symbols-outlined">picture_as_pdf</span>
                    <span v-else class="material-symbols-outlined spin">progress_activity</span>
                    {{ generating ? $t('publicCv.generating') : $t('publicCv.generate') }}
                </button>
            </div>

        </div>

    </section>

</template>
<script setup>
// -----------------------------
// Imports
// -----------------------------
import { computed, reactive, ref, watch } from 'vue'


// -----------------------------
// Refs & Reactives & Vars
// -----------------------------
const STORAGE_KEY = 'cv-section-preferences'

const sections = [
    { key: 'about', icon: 'person' },
    { key: 'experience', icon: 'work' },
    { key: 'projects', icon: 'folder_open' },
    { key: 'education', icon: 'school' },
    { key: 'certificates', icon: 'workspace_premium' },
    { key: 'skills', icon: 'code' },
    { key: 'hobbies', icon: 'interests' },
    // { key: 'testimonials', icon: 'forum' },
    { key: 'contact', icon: 'mail' },
]

const selected = reactive(loadInitialSelection())

const generating = ref(false)


// -----------------------------
// Computed & Watch
// -----------------------------
const enabledCount = computed(() =>
    Object.values(selected).filter(Boolean).length
)

// remember the person's preference for next time they visit
watch(selected, (value) => {
    try {
        localStorage.setItem(STORAGE_KEY, JSON.stringify(value))
    } catch {
        // localStorage may be unavailable (private browsing, etc.) —
        // preference just won't persist, nothing to do about it
    }
}, { deep: true })


// -----------------------------
// Methods
// -----------------------------
function loadInitialSelection() {
    const defaults = Object.fromEntries(sections.map((s) => [s.key, true]))

    try {
        const saved = JSON.parse(localStorage.getItem(STORAGE_KEY))
        if (saved && typeof saved === 'object') {
            return { ...defaults, ...saved }
        }
    } catch {
        // ignore malformed/absent storage, fall back to defaults
    }

    return defaults
}

function selectAll() {
    for (const section of sections) selected[section.key] = true
}

function selectNone() {
    for (const section of sections) selected[section.key] = false
}

function generatePdf() {
    const enabledKeys = sections
        .filter((s) => selected[s.key])
        .map((s) => s.key)

    generating.value = true

    // A full navigation (not an XHR) is used deliberately, since the
    // response is a file download, not JSON — the browser handles the
    // download natively once the response arrives.
    const url = route('cv.generate', { sections: enabledKeys })
    window.location.href = url

    // there's no reliable client-side "download finished" event for a
    // plain navigation, so just give the button a moment before
    // resetting, purely so it doesn't look stuck if generation is quick
    setTimeout(() => {
        generating.value = false
    }, 2500)
}
</script>
<style scoped>
/* =================================
   SECTION
================================= */

.cv-section {
    padding: 5.5rem 2rem;
    max-width: 880px;
    margin: 0 auto;
}

.section-header {
    text-align: center;
    margin-bottom: 2.5rem;
}

.section-label {
    display: inline-block;
    font-size: .78rem;
    font-weight: var(--font-weight-semibold);
    letter-spacing: .14em;
    text-transform: uppercase;
    color: var(--primary);
    margin-bottom: .6rem;
}

.section-title {
    font-family: var(--font-heading);
    font-size: clamp(1.7rem, 3.5vw, 2.3rem);
    font-weight: var(--font-weight-bold);
    letter-spacing: -.01em;
    margin-bottom: .6rem;
}

.section-subtitle {
    font-size: .92rem;
    color: var(--text-muted);
    max-width: 480px;
    margin: 0 auto;
}


/* =================================
   CARD
================================= */

.cv-card {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 1.8rem 2rem;

    opacity: 0;
    animation: cardRise .6s cubic-bezier(.22, 1, .36, 1) forwards;
}

@keyframes cardRise {
    from {
        opacity: 0;
        transform: translateY(18px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.cv-card-top {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: .75rem;
    margin-bottom: 1.4rem;
    padding-bottom: 1.2rem;
    border-bottom: 1px solid var(--border);
}

.selected-count {
    font-size: .82rem;
    color: var(--text-muted);
    font-weight: var(--font-weight-medium);
}

.quick-actions {
    display: flex;
    align-items: center;
    gap: .5rem;
    font-size: .8rem;
    color: var(--text-subtle);
}

.text-btn {
    background: none;
    border: none;
    padding: 0;
    color: var(--primary);
    font-family: var(--font-primary);
    font-size: .8rem;
    font-weight: var(--font-weight-medium);
    cursor: pointer;
    transition: color var(--transition-fast);
}

.text-btn:hover {
    color: var(--primary-hover);
}


/* =================================
   SECTION TOGGLES
================================= */

.section-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: .75rem;
    margin-bottom: 1.6rem;
}

.section-toggle {
    position: relative;
    display: flex;
    align-items: center;
    gap: .7rem;
    padding: .85rem 1rem;
    border-radius: var(--radius-sm);
    border: 1px solid var(--border);
    background: var(--bg-3);
    cursor: pointer;
    transition:
        border-color var(--transition-fast),
        background var(--transition-fast),
        transform var(--transition-fast);
}

.section-toggle:hover {
    border-color: var(--border-strong);
    transform: translateY(-1px);
}

.section-toggle.active {
    border-color: var(--primary);
    background: var(--tag-bg);
}

.toggle-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    border-radius: var(--radius-sm);
    background: var(--card);
    color: var(--text-muted);
    flex-shrink: 0;
    transition: color var(--transition-fast);
}

.toggle-icon .material-symbols-outlined {
    font-size: 17px;
}

.section-toggle.active .toggle-icon {
    color: var(--primary);
}

.toggle-label {
    flex: 1;
    font-size: .86rem;
    font-weight: var(--font-weight-medium);
    color: var(--text);
}

.toggle-input {
    position: absolute;
    opacity: 0;
    width: 0;
    height: 0;
}

.toggle-switch {
    position: relative;
    width: 34px;
    height: 19px;
    border-radius: 999px;
    background: var(--border-strong);
    flex-shrink: 0;
    transition: background var(--transition-fast);
}

.toggle-switch::before {
    content: "";
    position: absolute;
    top: 2px;
    left: 2px;
    width: 15px;
    height: 15px;
    border-radius: 50%;
    background: #fff;
    transition: transform var(--transition-fast);
}

.toggle-input:checked + .toggle-switch {
    background: var(--primary);
}

.toggle-input:checked + .toggle-switch::before {
    transform: translateX(15px);
}

.toggle-input:focus-visible + .toggle-switch {
    outline: 2px solid var(--primary);
    outline-offset: 2px;
}


/* =================================
   FOOTER
================================= */

.cv-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 1rem;
}

.cv-hint {
    display: flex;
    align-items: center;
    gap: .4rem;
    font-size: .8rem;
    color: var(--text-subtle);
    max-width: 360px;
}

.cv-hint .material-symbols-outlined {
    font-size: 16px;
    flex-shrink: 0;
}

.generate-btn {
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    border-radius: 999px;
    padding: .75rem 1.6rem;
    background: var(--primary);
    border: 1px solid var(--primary);
    color: #fff;
    font-family: var(--font-primary);
    font-size: .88rem;
    font-weight: var(--font-weight-medium);
    cursor: pointer;
    white-space: nowrap;
    transition:
        background var(--transition-fast),
        transform var(--transition-fast),
        box-shadow var(--transition-fast);
}

.generate-btn:hover:not(:disabled) {
    background: var(--primary-hover);
    transform: translateY(-2px);
    box-shadow: 0 10px 24px -8px var(--glow);
}

.generate-btn:disabled {
    opacity: .55;
    cursor: default;
}

.spin {
    animation: spin .9s linear infinite;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}


/* =================================
   RESPONSIVE
================================= */

@media (max-width: 640px) {

    .cv-section {
        padding: 3.5rem 1.25rem;
    }

    .cv-card {
        padding: 1.4rem 1.3rem;
    }

    .cv-card-top {
        flex-direction: column;
        align-items: flex-start;
    }

    .cv-footer {
        flex-direction: column;
        align-items: stretch;
    }

    .generate-btn {
        justify-content: center;
    }

}


/* =================================
   MOTION SAFETY
================================= */

@media (prefers-reduced-motion: reduce) {
    .cv-card,
    .section-toggle,
    .generate-btn,
    .spin {
        animation: none !important;
        transition: none !important;
        opacity: 1 !important;
        transform: none !important;
    }
}
</style>