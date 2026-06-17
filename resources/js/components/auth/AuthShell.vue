<script setup lang="ts">
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';
import { ArrowLeft, BookOpenCheck } from 'lucide-vue-next';
import { home } from '@/routes';

const props = defineProps<{
    title: string;
    description: string;
    mode: 'login' | 'register' | 'forgot';
}>();

const panel = computed(() => {
    const messages = {
        login: {
            eyebrow: 'Bon retour',
            title: 'Votre bibliothèque vous attend.',
            text: 'Reprenez vos lectures, consultez votre historique et retrouvez les recommandations préparées pour vous.',
        },
        register: {
            eyebrow: 'Bienvenue',
            title: 'Construisez votre espace de lecture.',
            text: 'Créez votre compte, choisissez vos préférences et commencez une expérience adaptée à votre rythme.',
        },
        forgot: {
            eyebrow: 'Aucun souci',
            title: 'Récupérez votre accès en douceur.',
            text: 'Recevez un lien sécurisé et revenez rapidement à vos livres, documents et abonnements.',
        },
    };

    return messages[props.mode];
});
</script>

<template>
    <main class="auth-page min-h-screen bg-[var(--auth-bg)] px-4 py-6 text-[var(--foreground)] transition-colors duration-300 sm:px-6 lg:px-8">
        <div class="mx-auto grid min-h-[calc(100vh-3rem)] w-full max-w-6xl overflow-hidden rounded-lg border border-[var(--auth-border)] bg-[var(--auth-card)] shadow-2xl shadow-black/10 lg:grid-cols-[1.02fr_0.98fr]">
            <section class="flex min-h-[560px] flex-col justify-between px-6 py-6 sm:px-10 lg:px-12">
                <div class="flex items-center justify-between gap-4">
                    <Link :href="home()" class="inline-flex items-center gap-2 text-sm font-semibold text-[var(--auth-muted)] transition hover:text-[var(--foreground)]">
                        <ArrowLeft class="size-4" />
                        Retour
                    </Link>

                    <Link :href="home()" class="inline-flex items-center gap-2 font-semibold text-[var(--foreground)]">
                        <span class="flex size-9 items-center justify-center rounded-md bg-[var(--brand)] text-white shadow-lg shadow-[var(--brand-shadow)]">
                            <BookOpenCheck class="size-5" />
                        </span>
                        <span>Librairie ENSPY</span>
                    </Link>
                </div>

                <div class="mx-auto flex w-full max-w-md flex-1 flex-col justify-center py-10">
                    <div class="mb-8">
                        <p class="mb-2 text-sm font-semibold uppercase tracking-[0.18em] text-[var(--brand)]">Plateforme de lecture</p>
                        <h1 class="text-3xl font-bold tracking-normal text-[var(--foreground)]">{{ title }}</h1>
                        <p class="mt-3 text-sm leading-6 text-[var(--auth-muted)]">{{ description }}</p>
                    </div>

                    <slot />
                </div>
            </section>

            <aside class="relative hidden min-h-[560px] overflow-hidden bg-[var(--auth-panel)] p-10 text-white lg:flex lg:flex-col lg:justify-between">
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_20%,rgba(255,255,255,0.24),transparent_28%),radial-gradient(circle_at_78%_12%,rgba(255,255,255,0.16),transparent_24%)]" />
                <div class="relative z-10">
                    <p class="text-sm font-semibold uppercase tracking-[0.24em] text-white/75">{{ panel.eyebrow }}</p>
                    <h2 class="mt-5 max-w-md text-4xl font-bold leading-tight tracking-normal">{{ panel.title }}</h2>
                    <p class="mt-5 max-w-md text-base leading-7 text-white/78">{{ panel.text }}</p>
                </div>

                <div class="relative z-10 grid grid-cols-3 gap-3">
                    <div class="rounded-md border border-white/16 bg-white/10 p-4 backdrop-blur">
                        <div class="text-2xl font-bold">24h</div>
                        <div class="mt-1 text-xs text-white/70">lecture suivie</div>
                    </div>
                    <div class="rounded-md border border-white/16 bg-white/10 p-4 backdrop-blur">
                        <div class="text-2xl font-bold">PDF</div>
                        <div class="mt-1 text-xs text-white/70">documents</div>
                    </div>
                    <div class="rounded-md border border-white/16 bg-white/10 p-4 backdrop-blur">
                        <div class="text-2xl font-bold">ENSPY</div>
                        <div class="mt-1 text-xs text-white/70">catalogue</div>
                    </div>
                </div>
            </aside>
        </div>
    </main>
</template>
