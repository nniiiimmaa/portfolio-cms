<template>
    <section id="about" class="about-section">
        <div class="about-grid">

            <div class="about-text">

                <Tag v-if="translation.available" class="availability-tag" :value="translation.availability_text">
                    <template #default>
                        <span class="availability-dot"></span>
                        {{ translation.availability_text }}
                    </template>
                </Tag>

                <h1 class="about-name" aria-label="Nima" ref="nameEl" :style="nameTiltStyle" @mousemove="handleNameTilt"
                    @mouseleave="resetNameTilt">
                    <span v-for="(letter, i) in nameLetters" :key="i" :style="{ '--i': i }">
                        {{ letter === ' ' ? '\u00A0' : letter }}
                    </span>
                </h1>

                <p class="about-title">
                    {{ translation.title }}
                </p>

                <p class="about-description">
                    {{ translation.description }}
                </p>

                <div class="about-actions">
                    <a href="#contact" class="btn btn-primary" >
                        {{ $t('publicAbout.contactMe') }}
                    </a>

                    <a href="#cv" class="btn btn-outline">
                        <span class="material-symbols-outlined">
                            download
                        </span>
                        {{ $t('publicAbout.downloadCv') }}
                    </a>
                </div>

            </div>

            <div class="about-photo-wrap">
                <div class="about-photo">
                    <img v-if="about.image" :src="about.image" :alt="translation.name" />

                    <span v-else class="about-photo-fallback">
                        {{ initials }}
                    </span>
                </div>
            </div>

        </div>
    </section>
</template>

<script setup>
// -----------------------------
// Imports
// -----------------------------
import { computed, reactive, ref } from 'vue';
import Tag from 'primevue/tag';
import { useI18n } from 'vue-i18n';

// -----------------------------
// Props & Emits
// -----------------------------
const { about } = defineProps({
    about: {
        type: Object,
        required: true
    }
});

// -----------------------------
// Stores & Composables
// -----------------------------
const { locale } = useI18n();

// -----------------------------
// Provides & Injects
// -----------------------------

// -----------------------------
// Refs & Reactives & Vars
// -----------------------------
const nameEl = ref(null);

const tilt = reactive({
    x: 0,
    y: 0
});

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
const translation = computed(() => {
    if (!about.translations?.length) return {}

    const currentId = LOCALE_TO_LANGUAGE_ID[locale.value] ?? 1

    return (
        about.translations.find((item) => item.language_id === currentId) ||
        about.translations.find(
            (item) => item.language_id === LOCALE_TO_LANGUAGE_ID.en
        ) ||
        about.translations[0] ||
        {}
    )
})

const nameLetters = computed(() => {
    const name = translation.value.name;

    if (!name) return [];

    const rtlLocales = ['ar', 'fa'];

    if (rtlLocales.includes(locale.value)) {
        return [name];
    }

    return name.split('');
});

const initials = computed(() => {
    const name = translation.value.name;

    if (!name) return '';

    return name
        .split(' ')
        .map((part) => part[0])
        .slice(0, 2)
        .join('')
        .toUpperCase();
});

const nameTiltStyle = computed(() => ({
    transform: `
        perspective(700px)
        rotateX(${tilt.x}deg)
        rotateY(${tilt.y}deg)
    `
}));

// -----------------------------
// Methods
// -----------------------------
function handleNameTilt(event) {
    if (
        window.matchMedia('(prefers-reduced-motion: reduce)').matches
    ) {
        return;
    }

    const rect = nameEl.value.getBoundingClientRect();

    const relX =
        (event.clientX - rect.left) / rect.width - 0.5;

    const relY =
        (event.clientY - rect.top) / rect.height - 0.5;

    tilt.y = relX * 12;
    tilt.x = relY * -10;
}

function resetNameTilt() {
    tilt.x = 0;
    tilt.y = 0;
}

// -----------------------------
// Hooks
// -----------------------------

</script>
<style scoped>
/* =================================
   SECTION
================================= */

.about-section {
    padding: 5.5rem 2rem;
}

.about-grid {
    max-width: 1080px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 3.5rem;
}

.about-text {
    flex: 1;
    min-width: 0;
}

/* every direct child rises in, staggered */
.about-text>* {
    opacity: 0;
    animation: rise .7s cubic-bezier(.22, 1, .36, 1) forwards;
}

.about-text>*:nth-child(1) {
    animation-delay: .05s;
}

.about-text>*:nth-child(2) {
    animation-delay: .15s;
}

.about-text>*:nth-child(3) {
    animation-delay: .32s;
}

.about-text>*:nth-child(4) {
    animation-delay: .48s;
}

.about-text>*:nth-child(5) {
    animation-delay: .62s;
}

@keyframes rise {
    from {
        opacity: 0;
        transform: translateY(20px);
        filter: blur(6px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
        filter: blur(0);
    }
}


/* =================================
   AVAILABILITY TAG
================================= */

:deep(.availability-tag.p-tag) {
    display: inline-flex;
    align-items: center;
    gap: .45rem;
    background: var(--tag-bg);
    color: var(--tag-text);
    border: 1px solid var(--border);
    border-radius: 999px;
    padding: .4rem .9rem .4rem .7rem;
    font-size: .78rem;
    font-weight: var(--font-weight-medium);
    margin-bottom: 1.5rem;
}

.availability-dot {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: var(--success);
    box-shadow: 0 0 0 0 rgba(5, 150, 105, .5);
    animation: dotPulse 2s infinite;
    flex-shrink: 0;
}

@keyframes dotPulse {
    0% {
        box-shadow: 0 0 0 0 rgba(5, 150, 105, .45);
    }

    70% {
        box-shadow: 0 0 0 8px rgba(5, 150, 105, 0);
    }

    100% {
        box-shadow: 0 0 0 0 rgba(5, 150, 105, 0);
    }
}


/* =================================
   NAME — the centerpiece
================================= */

.about-name {
    display: flex;
    flex-wrap: wrap;
    gap: .01em;

    font-family: var(--font-heading);
    font-size: clamp(3rem, 7vw, 5.5rem);
    font-weight: var(--font-weight-bold);
    letter-spacing: -.03em;
    line-height: 1;

    margin-bottom: .5rem;
    cursor: default;

    transform-style: preserve-3d;
    transition: transform .25s cubic-bezier(.22, 1, .36, 1);
    will-change: transform;
}

.about-name span {
    display: inline-block;
    position: relative;

    background: linear-gradient(100deg, var(--text) 40%, var(--primary) 55%, var(--text) 70%);
    background-size: 220% auto;
    background-position: 0% 50%;
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;

    opacity: 0;
    transform: translateY(24px) rotate(6deg);
    animation:
        letterIn .6s cubic-bezier(.22, 1, .36, 1) forwards,
        shimmer 6s ease-in-out 1.2s infinite;
    animation-delay: calc(.05s * var(--i)), 1.2s;

    transition: transform .3s cubic-bezier(.22, 1, .36, 1);
    will-change: transform;
}

@keyframes letterIn {
    to {
        opacity: 1;
        transform: translateY(0) rotate(0deg);
    }
}

@keyframes shimmer {

    0%,
    100% {
        background-position: 0% 50%;
    }

    50% {
        background-position: 100% 50%;
    }
}

/* playful per-letter hover */
.about-name span:hover {
    animation:
        letterIn .6s cubic-bezier(.22, 1, .36, 1) forwards,
        shimmer 6s ease-in-out 1.2s infinite,
        letterHover .6s ease-in-out infinite alternate;

    z-index: 2;
}

@keyframes letterHover {
    0% {
        transform: translateY(0) rotate(0deg) scale(1);
    }

    25% {
        transform: translateY(-6px) rotate(-4deg) scale(1.06);
    }

    50% {
        transform: translateY(-10px) rotate(4deg) scale(1.1);
    }

    75% {
        transform: translateY(-6px) rotate(-2deg) scale(1.06);
    }

    100% {
        transform: translateY(-2px) rotate(2deg) scale(1.03);
    }
}


/* =================================
   TITLE / DESCRIPTION
================================= */

.about-title {
    font-size: 1.15rem;
    color: var(--primary);
    font-weight: var(--font-weight-medium);
    margin-bottom: 1.5rem;
}

.about-description {
    max-width: 560px;
    font-size: 1rem;
    color: var(--text-muted);
    line-height: 1.85;
    margin-bottom: 2.25rem;
}


/* =================================
   ACTIONS
================================= */

.about-actions {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.btn {
    position: relative;
    overflow: hidden;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: .45rem;
    border-radius: 999px;
    padding: .8rem 1.8rem;
    font-family: var(--font-primary);
    font-size: .9rem;
    font-weight: var(--font-weight-medium);
    text-decoration: none;
    cursor: pointer;
    border: 1px solid transparent;
    transition:
        transform var(--transition-fast),
        box-shadow var(--transition-fast),
        background var(--transition-fast),
        border-color var(--transition-fast);
}
 
.btn .material-symbols-outlined {
    font-size: 18px;
}
 
.btn::before {
    content: "";
    position: absolute;
    top: -120%;
    left: -120%;
    width: 60%;
    height: 300%;
    transform: rotate(25deg);
    background: linear-gradient(to right, transparent, rgba(255, 255, 255, .35), transparent);
    opacity: 0;
    transition: opacity .25s ease;
}
 
.btn:hover::before {
    opacity: 1;
    animation: shine .9s ease;
}
 
@keyframes shine {
    from { left: -120%; }
    to { left: 180%; }
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
    box-shadow: 0 10px 24px -8px var(--glow);
}
 
.btn-outline {
    background: transparent;
    border-color: var(--border-strong);
    color: var(--text);
}
 
.btn-outline:hover {
    border-color: var(--primary);
    background: var(--tag-bg);
    transform: translateY(-2px);
}

/* =================================
   PHOTO
================================= */

.about-photo-wrap {
    flex-shrink: 0;
    opacity: 0;
    animation: photoIn .8s cubic-bezier(.22, 1, .36, 1) .3s forwards;
}

@keyframes photoIn {
    from {
        opacity: 0;
        transform: scale(.88) translateY(14px);
    }

    to {
        opacity: 1;
        transform: scale(1) translateY(0);
    }
}

.about-photo {
    position: relative;
    width: 260px;
    height: 260px;
    border-radius: 32px;
    border: 1px solid var(--border-strong);
    background: var(--bg-3);
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: border-color var(--transition-normal), box-shadow var(--transition-normal);
}

.about-photo:hover {
    border-color: var(--primary);
    box-shadow: 0 20px 44px -20px var(--glow);
}

.about-photo img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center top;
    transition: transform .7s cubic-bezier(.22, 1, .36, 1), filter .5s ease;
}

.about-photo:hover img {
    transform: scale(1.06) rotate(1deg);
    filter: brightness(1.05) contrast(1.05);
}

.about-photo-fallback {
    font-family: var(--font-heading);
    font-size: 4rem;
    font-weight: var(--font-weight-bold);
    color: var(--primary);
    background: linear-gradient(135deg, var(--tag-bg), transparent);
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* animated light sweep, matches the button/card shine elsewhere */
.about-photo::before {
    content: "";
    position: absolute;
    top: -150%;
    left: -120%;
    width: 60%;
    height: 300%;
    transform: rotate(25deg);
    background: linear-gradient(to right, transparent, rgba(255, 255, 255, .28), transparent);
    opacity: 0;
    transition: opacity .3s ease;
    z-index: 2;
    pointer-events: none;
}

.about-photo:hover::before {
    opacity: 1;
    animation: photoShine 1.1s ease;
}

@keyframes photoShine {
    from {
        left: -120%;
    }

    to {
        left: 180%;
    }
}

/* soft ambient glow behind the photo */
.about-photo::after {
    content: "";
    position: absolute;
    inset: 0;
    border-radius: inherit;
    background: radial-gradient(circle at top, var(--glow), transparent 70%);
    opacity: 0;
    transition: opacity .5s ease, transform .5s ease;
    transform: scale(.9);
    pointer-events: none;
}

.about-photo:hover::after {
    opacity: 1;
    transform: scale(1);
}


/* =================================
   RESPONSIVE
================================= */

@media (max-width: 900px) {

    .about-section {
        padding: 3.5rem 1.5rem;
    }

    .about-grid {
        flex-direction: column-reverse;
        text-align: center;
        gap: 2rem;
    }

    .about-name {
        justify-content: center;
    }

    .about-description {
        margin-inline: auto;
    }

    .about-actions {
        justify-content: center;
    }

    .about-photo {
        width: 190px;
        height: 190px;
        border-radius: 24px;
    }

    .about-photo-fallback {
        font-size: 2.75rem;
    }

}

@media (max-width: 640px) {

    .about-section {
        padding: 3.5rem 1.25rem;
    }

}


/* =================================
   MOTION SAFETY
================================= */

@media (prefers-reduced-motion: reduce) {

    .about-text>*,
    .about-name,
    .about-name span,
    .about-photo-wrap,
    .availability-dot {
        animation: none !important;
        opacity: 1 !important;
        transform: none !important;
        filter: none !important;
    }
}
</style>