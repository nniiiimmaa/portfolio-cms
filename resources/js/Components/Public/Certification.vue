<template>

    <section id="certifications" class="certifications-section">

        <div class="section-header">
            <span class="section-label">{{ $t('publicCertification.eyebrow') }}</span>
            <h2 class="section-title">{{ $t('publicCertification.title') }}</h2>
        </div>

        <div class="certifications-grid">
            <div
                v-for="(cert, i) in visibleCertifications"
                :key="cert.id"
                class="cert-card"
                :style="{ '--i': i }"
                role="button"
                tabindex="0"
                @click="openDetails(cert)"
                @keydown.enter="openDetails(cert)"
            >
                <span
                    class="status-dot"
                    :class="{ expired: isExpired(cert), permanent: !cert.expiration_date }"
                ></span>

                <div class="cert-icon">
                    <img v-if="cert.image" :src="cert.image" :alt="translationOf(cert).title" />
                    <span v-else class="material-symbols-outlined">workspace_premium</span>
                </div>

                <h3 class="cert-title">{{ translationOf(cert).title }}</h3>
                <p class="cert-issuer">{{ translationOf(cert).issuer_name }}</p>

                <span class="card-arrow material-symbols-outlined">arrow_forward</span>
            </div>
        </div>

        <button v-if="hasMore" class="toggle-btn" @click="expanded = !expanded">
            {{ expanded ? $t('publicCertification.showLess') : $t('publicCertification.showMore') }}
            <span class="material-symbols-outlined toggle-icon" :class="{ rotated: expanded }">
                expand_more
            </span>
        </button>

        <Dialog
            v-model:visible="detailsOpen"
            modal
            dismissable-mask
            class="cert-dialog"
            :style="{ width: '36rem', maxWidth: '92vw' }"
            :pt="certDialogPt"
        >
            <template #header>
                <div v-if="activeCert" class="dialog-head">
                    <div class="dialog-icon">
                        <img
                            v-if="activeCert.image"
                            :src="activeCert.image"
                            :alt="translationOf(activeCert).title"
                        />
                        <span v-else class="material-symbols-outlined">workspace_premium</span>
                    </div>
                    <div class="dialog-head-text">
                        <h3 class="dialog-title">{{ translationOf(activeCert).title }}</h3>
                        <p class="dialog-subtitle">
                            {{ translationOf(activeCert).issuer_name }}
                            <span class="dot">·</span>
                            {{ translationOf(activeCert).issuer_country }}
                        </p>
                    </div>
                </div>
            </template>

            <template v-if="activeCert">
                <p class="dialog-description">{{ translationOf(activeCert).description }}</p>

                <div class="dialog-stats">
                    <div class="stat">
                        <span class="stat-label">{{ $t('publicCertification.issued') }}</span>
                        <span class="stat-value">{{ formatDate(activeCert.issue_date) }}</span>
                    </div>
                    <div class="stat">
                        <span class="stat-label">{{ $t('publicCertification.status') }}</span>
                        <span class="stat-value">
                            <span
                                class="status-pill"
                                :class="{ expired: isExpired(activeCert), permanent: !activeCert.expiration_date }"
                            >
                                {{ expiryLabel(activeCert) }}
                            </span>
                        </span>
                    </div>
                    <div class="stat">
                        <span class="stat-label">{{ $t('publicCertification.credential_id') }}</span>
                        <span class="stat-value mono">{{ activeCert.credential_id }}</span>
                    </div>
                </div>
            </template>

            <template #footer>
                <a
                    v-if="activeCert?.credential_url"
                    :href="activeCert.credential_url"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="btn btn-primary"
                >
                    {{ $t('publicCertification.view_credential') }}
                    <span class="material-symbols-outlined">open_in_new</span>
                </a>
            </template>
        </Dialog>

    </section>

</template>
<script setup>
// -----------------------------
// Imports
// -----------------------------
import { computed, ref } from 'vue'
import { useI18n } from 'vue-i18n'
import Dialog from 'primevue/dialog'
import { certDialogPt } from '@/PrimeVue/PT/dialog.pt'


// -----------------------------
// Props & Emits
// -----------------------------
const props = defineProps({
    certifications: {
        type: Array,
        required: true,
    },
})


// -----------------------------
// Stores & Composables
// -----------------------------
const { locale, t } = useI18n()


// -----------------------------
// Refs & Reactives & Vars
// -----------------------------
const expanded = ref(false)
const visibleCount = 6

const detailsOpen = ref(false)
const activeCert = ref(null)

// translations are keyed by numeric language_id, same seeded table used elsewhere
const LOCALE_TO_LANGUAGE_ID = {
    en: 1,
    pt: 2,
    es: 3,
    de: 4,
    tr: 5,
    fa: 6,
    ar: 7,
}


// -----------------------------
// Computed & Watch
// -----------------------------
const sortedCertifications = computed(() =>
    [...props.certifications].sort((a, b) => a.order - b.order)
)

const hasMore = computed(() => sortedCertifications.value.length > visibleCount)

const visibleCertifications = computed(() =>
    expanded.value
        ? sortedCertifications.value
        : sortedCertifications.value.slice(0, visibleCount)
)


// -----------------------------
// Methods
// -----------------------------
function openDetails(cert) {
    activeCert.value = cert
    detailsOpen.value = true
}

function translationOf(cert) {
    const currentId = LOCALE_TO_LANGUAGE_ID[locale.value] ?? 1

    return (
        cert.translations.find((tr) => tr.language_id === currentId) ||
        cert.translations.find((tr) => tr.language_id === LOCALE_TO_LANGUAGE_ID.en) ||
        cert.translations[0]
    )
}

function formatDate(dateStr) {
    if (!dateStr) return ''
    return new Date(dateStr).toLocaleDateString(locale.value, {
        month: 'short',
        year: 'numeric',
    })
}

function isExpired(cert) {
    if (!cert.expiration_date) return false
    return new Date(cert.expiration_date) < new Date()
}

function expiryLabel(cert) {
    if (!cert.expiration_date) return t('publicCertification.no_expiration')
    if (isExpired(cert)) return `${t('publicCertification.expired')} ${formatDate(cert.expiration_date)}`
    return `${t('publicCertification.expires')} ${formatDate(cert.expiration_date)}`
}
</script>
<style scoped>
/* =================================
   SECTION
================================= */

.certifications-section {
    padding: 5.5rem 2rem;
    max-width: 1080px;
    margin: 0 auto;
}

.section-header {
    text-align: center;
    margin-bottom: 3rem;
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
}


/* =================================
   GRID
================================= */

.certifications-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 1.25rem;
}


/* =================================
   CARD — deliberately minimal: icon, title,
   issuer, a status dot, and a hover hint. Everything
   else lives in the dialog.
================================= */

.cert-card {
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 1.5rem;
    cursor: pointer;
    overflow: hidden;

    animation: certRise .55s cubic-bezier(.22, 1, .36, 1) calc(.06s * var(--i)) backwards;

    transition:
        transform var(--transition-normal),
        border-color var(--transition-normal),
        box-shadow var(--transition-normal);
}

@keyframes certRise {
    from {
        opacity: 0;
        transform: translateY(16px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.cert-card:hover {
    z-index: 2;
    transform: translateY(-4px) scale(1.02);
    border-color: var(--primary);
    box-shadow:
        0 20px 40px -18px rgba(0, 0, 0, .3),
        0 0 0 1px var(--primary),
        0 0 24px var(--glow);
}

.cert-card:focus-visible {
    outline: 2px solid var(--primary);
    outline-offset: 3px;
}

.status-dot {
    position: absolute;
    top: 1.1rem;
    right: 1.1rem;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: var(--success);
}

.status-dot.permanent {
    background: var(--primary);
}

.status-dot.expired {
    background: var(--danger);
}

.cert-icon {
    width: 44px;
    height: 44px;
    border-radius: var(--radius-sm);
    background: linear-gradient(135deg, var(--tag-bg), transparent);
    border: 1px solid var(--border);
    color: var(--primary);
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    margin-bottom: 1rem;
    transition: transform var(--transition-normal), box-shadow var(--transition-normal);
}

.cert-icon .material-symbols-outlined {
    font-size: 21px;
}

.cert-icon img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.cert-card:hover .cert-icon {
    transform: rotate(-6deg) scale(1.08);
    box-shadow: 0 0 14px var(--glow);
}

.cert-title {
    font-size: .95rem;
    font-weight: var(--font-weight-semibold);
    color: var(--text);
    line-height: 1.4;
    margin-bottom: .3rem;
    transition: color var(--transition-fast);

    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.cert-card:hover .cert-title {
    color: var(--primary);
}

.cert-issuer {
    font-size: .78rem;
    color: var(--text-subtle);
}

.card-arrow {
    position: absolute;
    bottom: 1.1rem;
    right: 1.1rem;
    font-size: 17px;
    color: var(--primary);
    opacity: 0;
    transform: translate(-4px, 4px);
    transition: opacity var(--transition-fast), transform var(--transition-fast);
}

.cert-card:hover .card-arrow {
    opacity: 1;
    transform: translate(0, 0);
}


/* =================================
   TOGGLE BUTTON
================================= */

.toggle-btn {
    display: flex;
    align-items: center;
    gap: .4rem;
    margin: 2.5rem auto 0;
    padding: .7rem 1.6rem;
    border-radius: 999px;
    border: 1px solid var(--border-strong);
    background: transparent;
    color: var(--text);
    font-family: var(--font-primary);
    font-size: .85rem;
    font-weight: var(--font-weight-medium);
    cursor: pointer;
    transition:
        border-color var(--transition-fast),
        background var(--transition-fast),
        transform var(--transition-fast);
}

.toggle-btn:hover {
    border-color: var(--primary);
    background: var(--tag-bg);
    transform: translateY(-2px);
}

.toggle-icon {
    font-size: 18px;
    transition: transform var(--transition-normal);
}

.toggle-icon.rotated {
    transform: rotate(180deg);
}


/* =================================
   DETAILS DIALOG
================================= */

/* :deep(.cert-dialog) {
    --p-dialog-background: var(--card);
    --p-dialog-color: var(--text);
    --p-dialog-border-color: var(--border);
    --p-dialog-border-radius: calc(var(--radius) + 6px);
    --p-dialog-shadow: 0 30px 70px -20px rgba(0, 0, 0, .5);

    --p-dialog-header-background: var(--card);
    --p-dialog-header-color: var(--text);
    --p-dialog-header-padding: 1.75rem 1.75rem 1.5rem;

    --p-dialog-content-background: var(--card);
    --p-dialog-content-color: var(--text);
    --p-dialog-content-padding: 0 1.75rem 1.75rem;

    --p-dialog-footer-background: var(--card);
    --p-dialog-footer-padding: 1.4rem 1.75rem;

    background: var(--card);
    color: var(--text);
    border: 1px solid var(--border);
    border-radius: calc(var(--radius) + 6px);
    box-shadow: 0 30px 70px -20px rgba(0, 0, 0, .5);
    overflow: hidden;
}

:deep(.cert-dialog .p-dialog-header),
:deep(.cert-dialog .p-dialog-content),
:deep(.cert-dialog .p-dialog-footer) {
    background: var(--card);
    color: var(--text);
}

:deep(.cert-dialog .p-dialog-header) {
    border-bottom: 1px solid var(--border);
    padding: 1.75rem 1.75rem 1.5rem;
}

:deep(.cert-dialog .p-dialog-content) {
    padding: 1.6rem 1.75rem 1.75rem;
}

:deep(.cert-dialog .p-dialog-footer) {
    border-top: 1px solid var(--border);
    padding: 1.4rem 1.75rem;
    display: flex;
    justify-content: flex-end;
}

:deep(.cert-dialog .p-dialog-header-icon) {
    color: var(--text-muted);
    border-radius: var(--radius-sm);
}

:deep(.cert-dialog .p-dialog-header-icon:hover) {
    color: var(--text);
    background: var(--tag-bg);
}


:deep(.p-dialog-mask) {
    background: rgba(0, 0, 0, .6);
    backdrop-filter: blur(2px);
} */

.dialog-head {
    display: flex;
    align-items: center;
    gap: 1.1rem;
}

.dialog-icon {
    width: 56px;
    height: 56px;
    flex-shrink: 0;
    border-radius: var(--radius-sm);
    background: linear-gradient(135deg, var(--tag-bg), transparent);
    border: 1px solid var(--border);
    color: var(--primary);
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.dialog-icon .material-symbols-outlined {
    font-size: 28px;
}

.dialog-icon img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.dialog-title {
    font-family: var(--font-heading);
    font-size: 1.2rem;
    font-weight: var(--font-weight-semibold);
    color: var(--text);
    line-height: 1.35;
    margin-bottom: .3rem;
}

.dialog-subtitle {
    font-size: .88rem;
    color: var(--primary);
    font-weight: var(--font-weight-medium);
}

.dialog-subtitle .dot {
    color: var(--text-subtle);
    margin: 0 .2rem;
}

.dialog-description {
    font-size: .95rem;
    color: var(--text-muted);
    line-height: 1.85;
    margin: 1.5rem 0;
}

.dialog-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
    gap: 1.25rem;
    background: var(--bg-3);
    border: 1px solid var(--border);
    border-radius: var(--radius-sm);
    padding: 1.1rem 1.25rem;
}

.stat {
    display: flex;
    flex-direction: column;
    gap: .4rem;
}

.stat-label {
    font-size: .68rem;
    letter-spacing: .07em;
    text-transform: uppercase;
    color: var(--text-subtle);
    font-weight: var(--font-weight-medium);
}

.stat-value {
    font-size: .9rem;
    color: var(--text);
    font-weight: var(--font-weight-medium);
}

.stat-value.mono {
    font-family: var(--font-monospace);
    font-size: .82rem;
    letter-spacing: .02em;
}

.status-pill {
    display: inline-flex;
    align-items: center;
    background: rgba(5, 150, 105, .12);
    color: var(--success);
    border-radius: 999px;
    padding: .2rem .65rem;
    font-size: .78rem;
    font-weight: var(--font-weight-medium);
}

.status-pill.permanent {
    background: var(--tag-bg);
    color: var(--primary);
}

.status-pill.expired {
    background: rgba(225, 29, 72, .12);
    color: var(--danger);
}

.btn {
    display: inline-flex;
    align-items: center;
    gap: .4rem;
    border-radius: 999px;
    padding: .65rem 1.5rem;
    font-family: var(--font-primary);
    font-size: .85rem;
    font-weight: var(--font-weight-medium);
    text-decoration: none;
    cursor: pointer;
    border: 1px solid transparent;
    transition:
        transform var(--transition-fast),
        box-shadow var(--transition-fast),
        background var(--transition-fast);
}

.btn .material-symbols-outlined {
    font-size: 16px;
}

.btn-primary {
    background: var(--primary);
    border-color: var(--primary);
    color: #fff;
}

.btn-primary:hover {
    background: var(--primary-hover);
    border-color: var(--primary-hover);
    transform: translateY(-2px);
    box-shadow: 0 10px 22px -8px var(--glow);
}


/* =================================
   RESPONSIVE
================================= */

@media (max-width: 640px) {

    .certifications-section {
        padding: 3.5rem 1.25rem;
    }

    .certifications-grid {
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 1rem;
    }

    .cert-card:hover {
        transform: translateY(-2px) scale(1.01);
    }

    .dialog-stats {
        grid-template-columns: 1fr 1fr;
    }

}


/* =================================
   MOTION SAFETY
================================= */

@media (prefers-reduced-motion: reduce) {
    .cert-card,
    .cert-icon,
    .card-arrow,
    .toggle-icon {
        animation: none !important;
        transition: none !important;
        opacity: 1 !important;
        transform: none !important;
    }
}
</style>