<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { BarChart3, BookOpenCheck, Clock3, LibraryBig, TimerReset } from 'lucide-vue-next';
import { dashboard } from '@/routes';

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Tableau de bord',
                href: dashboard(),
            },
        ],
    },
});

defineProps<{
    stats: {
        books_read: number;
        reading_hours: number;
        sessions: number;
        favorite_genre: string;
        subscription: string;
    };
    genres: Array<{ label: string; minutes: number; percent: number }>;
    weekly: Array<{ label: string; minutes: number; height: number }>;
    recent: Array<{ id: number; title: string; genre: string; duration: number }>;
}>();
</script>

<template>
    <Head title="Tableau de bord" />

    <main class="min-h-screen bg-background px-4 py-6 text-foreground md:px-6">
        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.18em] text-[var(--brand)]">Espace lecteur</p>
                <h1 class="mt-2 text-3xl font-bold">Tableau de bord</h1>
                <p class="mt-2 text-sm text-muted-foreground">Suivez votre activité de lecture et votre abonnement.</p>
            </div>

            <Link href="/library" class="inline-flex items-center justify-center gap-2 rounded-md bg-[var(--brand)] px-4 py-2 text-sm font-semibold text-white hover:bg-[var(--brand-strong)]">
                <LibraryBig class="size-4" />
                Mes lectures
            </Link>
        </div>

        <section class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
            <div class="rounded-lg border border-border bg-card p-5">
                <BookOpenCheck class="mb-4 size-6 text-[var(--brand)]" />
                <div class="text-3xl font-bold">{{ stats.books_read }}</div>
                <div class="mt-1 text-sm text-muted-foreground">Livres consultés</div>
            </div>
            <div class="rounded-lg border border-border bg-card p-5">
                <Clock3 class="mb-4 size-6 text-[var(--brand)]" />
                <div class="text-3xl font-bold">{{ stats.reading_hours }}h</div>
                <div class="mt-1 text-sm text-muted-foreground">Temps de lecture</div>
            </div>
            <div class="rounded-lg border border-border bg-card p-5">
                <BarChart3 class="mb-4 size-6 text-[var(--brand)]" />
                <div class="text-3xl font-bold">{{ stats.sessions }}</div>
                <div class="mt-1 text-sm text-muted-foreground">Sessions lancées</div>
            </div>
            <div class="rounded-lg border border-border bg-card p-5">
                <TimerReset class="mb-4 size-6 text-[var(--brand)]" />
                <div class="text-3xl font-bold capitalize">{{ stats.subscription }}</div>
                <div class="mt-1 text-sm text-muted-foreground">Abonnement actif</div>
            </div>
        </section>

        <section class="mt-6 grid gap-6 xl:grid-cols-[1.25fr_0.75fr]">
            <div class="rounded-lg border border-border bg-card p-5">
                <div class="mb-6 flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-semibold">Lecture sur 7 jours</h2>
                        <p class="text-sm text-muted-foreground">Minutes enregistrées par jour.</p>
                    </div>
                </div>

                <div class="flex h-72 items-end gap-3 border-b border-border pb-4">
                    <div v-for="day in weekly" :key="day.label" class="flex h-full flex-1 flex-col justify-end gap-2">
                        <div class="flex flex-1 items-end">
                            <div class="w-full rounded-t-md bg-[var(--brand)]/85 transition-all" :style="{ height: `${day.height}%` }"></div>
                        </div>
                        <div class="text-center text-xs text-muted-foreground">{{ day.label }}</div>
                        <div class="text-center text-xs font-semibold">{{ day.minutes }}m</div>
                    </div>
                </div>
            </div>

            <div class="rounded-lg border border-border bg-card p-5">
                <h2 class="text-lg font-semibold">Genres préférés</h2>
                <p class="mt-1 text-sm text-muted-foreground">Catégorie favorite: {{ stats.favorite_genre }}</p>

                <div class="mt-6 space-y-4">
                    <div v-for="genre in genres" :key="genre.label">
                        <div class="mb-2 flex items-center justify-between text-sm">
                            <span class="capitalize">{{ genre.label }}</span>
                            <span class="text-muted-foreground">{{ genre.minutes }}m</span>
                        </div>
                        <div class="h-2 rounded-full bg-muted">
                            <div class="h-2 rounded-full bg-[var(--brand)]" :style="{ width: `${genre.percent}%` }"></div>
                        </div>
                    </div>
                    <div v-if="genres.length === 0" class="rounded-md bg-muted p-4 text-sm text-muted-foreground">
                        Aucune statistique disponible pour le moment.
                    </div>
                </div>
            </div>
        </section>

        <section class="mt-6 rounded-lg border border-border bg-card p-5">
            <h2 class="text-lg font-semibold">Dernières lectures</h2>
            <div class="mt-4 divide-y divide-border">
                <div v-for="book in recent" :key="book.id" class="flex items-center justify-between gap-4 py-3">
                    <div>
                        <div class="font-medium">{{ book.title }}</div>
                        <div class="text-sm capitalize text-muted-foreground">{{ book.genre }}</div>
                    </div>
                    <div class="text-sm font-semibold text-[var(--brand)]">{{ book.duration ?? 0 }}m</div>
                </div>
                <div v-if="recent.length === 0" class="py-6 text-sm text-muted-foreground">
                    Commencez une lecture pour remplir votre historique.
                </div>
            </div>
        </section>
    </main>
</template>
