<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3';
import { ArrowLeft, BookOpen, Clock3 } from 'lucide-vue-next';
import { computed, onBeforeUnmount, onMounted, ref } from 'vue';

const props = defineProps<{
    book: {
        id: number;
        title: string;
        author: string;
        genre: string;
        cover_image: string | null;
    };
    subscription: {
        type: string;
        daily_minutes: number;
        daily_seconds: number;
    };
    pdfUrl: string;
    libraryUrl: string;
}>();

const remaining = ref(props.subscription.daily_seconds);
const finished = ref(false);
let timer: number | undefined;

const formattedTime = computed(() => {
    const minutes = Math.floor(remaining.value / 60).toString().padStart(2, '0');
    const seconds = (remaining.value % 60).toString().padStart(2, '0');

    return `${minutes}:${seconds}`;
});

const progress = computed(() => {
    return Math.max(0, Math.round((remaining.value / props.subscription.daily_seconds) * 100));
});

function leaveReader() {
    router.visit(props.libraryUrl);
}

onMounted(() => {
    timer = window.setInterval(() => {
        remaining.value -= 1;

        if (remaining.value <= 0) {
            remaining.value = 0;
            finished.value = true;
            window.clearInterval(timer);
            window.setTimeout(leaveReader, 3500);
        }
    }, 1000);
});

onBeforeUnmount(() => {
    if (timer) {
        window.clearInterval(timer);
    }
});
</script>

<template>
    <Head :title="`Lecture - ${book.title}`" />

    <main class="min-h-screen bg-background text-foreground">
        <header class="border-b border-border bg-card/90 px-4 py-4 backdrop-blur md:px-8">
            <div class="mx-auto flex max-w-7xl flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <div class="flex items-center gap-4">
                    <button @click="leaveReader" class="inline-flex size-10 items-center justify-center rounded-md border border-border hover:bg-accent">
                        <ArrowLeft class="size-5" />
                    </button>
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[var(--brand)]">Lecture en cours</p>
                        <h1 class="text-xl font-bold">{{ book.title }}</h1>
                        <p class="text-sm text-muted-foreground">{{ book.author }} · {{ book.genre }}</p>
                    </div>
                </div>

                <div class="flex items-center gap-3 rounded-lg border border-border bg-background px-4 py-3">
                    <Clock3 class="size-5 text-[var(--brand)]" />
                    <div>
                        <div class="text-xs text-muted-foreground">Temps journalier {{ subscription.type }}</div>
                        <div class="font-mono text-lg font-bold">{{ formattedTime }}</div>
                    </div>
                </div>
            </div>
        </header>

        <section class="mx-auto grid max-w-7xl gap-5 px-4 py-5 lg:grid-cols-[280px_1fr] md:px-8">
            <aside class="rounded-lg border border-border bg-card p-5">
                <div class="flex items-center gap-3">
                    <div class="flex size-12 items-center justify-center rounded-md bg-[var(--brand)] text-white">
                        <BookOpen class="size-6" />
                    </div>
                    <div>
                        <div class="font-semibold">{{ subscription.daily_minutes }} min / jour</div>
                        <div class="text-sm text-muted-foreground">Forfait {{ subscription.type }}</div>
                    </div>
                </div>

                <div class="mt-6">
                    <div class="mb-2 flex items-center justify-between text-sm">
                        <span>Temps restant</span>
                        <span>{{ progress }}%</span>
                    </div>
                    <div class="h-2 rounded-full bg-muted">
                        <div class="h-2 rounded-full bg-[var(--brand)] transition-all" :style="{ width: `${progress}%` }"></div>
                    </div>
                </div>

                <button @click="leaveReader" class="mt-6 w-full rounded-md border border-border px-4 py-2 text-sm font-semibold hover:bg-accent">
                    Retour à mes lectures
                </button>
            </aside>

            <div class="min-h-[75vh] overflow-hidden rounded-lg border border-border bg-card shadow-xl shadow-black/10">
                <iframe :src="pdfUrl" class="h-[78vh] w-full" title="Lecteur PDF"></iframe>
            </div>
        </section>

        <div v-if="finished" class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 px-4">
            <div class="w-full max-w-md rounded-lg border border-border bg-card p-6 text-center shadow-2xl">
                <div class="mx-auto mb-4 flex size-14 items-center justify-center rounded-full bg-[var(--brand)] text-white">
                    <Clock3 class="size-7" />
                </div>
                <h2 class="text-2xl font-bold">Temps de lecture terminé</h2>
                <p class="mt-3 text-sm leading-6 text-muted-foreground">
                    Votre temps journalier autorisé pour l'abonnement {{ subscription.type }} est écoulé. Vous allez être redirigé vers vos lectures.
                </p>
                <button @click="leaveReader" class="mt-6 w-full rounded-md bg-[var(--brand)] px-4 py-2 font-semibold text-white hover:bg-[var(--brand-strong)]">
                    Retourner à mes lectures
                </button>
            </div>
        </div>
    </main>
</template>
