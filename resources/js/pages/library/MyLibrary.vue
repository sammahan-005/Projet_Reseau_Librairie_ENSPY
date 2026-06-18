<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import PersonalHero from '@/components/library/PersonalHero.vue';
import CollectionsTabs from '@/components/library/CollectionsTabs.vue';
import LibraryGrid from '@/components/library/LibraryGrid.vue';
import ContinueCarousel from '@/components/library/ContinueCarousel.vue';
import Recommendations from '@/components/library/Recommendations.vue';
import ActivityTimeline from '@/components/library/ActivityTimeline.vue';
import UserStats from '@/components/library/UserStats.vue';
import type { BreadcrumbItem } from '@/types';

defineProps<{ 
  user: any,
  books: { data: any[], links: any[] },
  allBooks: any[],
  recommendations: any[],
  activity: any[],
  stats: any,
}>();

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Bibliothèque', href: '/library' },
];
</script>

<template>
  <AppLayout :breadcrumbs="breadcrumbs">
    <Head title="Ma Bibliothèque" />
    
    <main class="mx-auto max-w-7xl px-4 py-8">
      <PersonalHero :user="user" :stats="stats" />

      <div class="mt-8">
        <CollectionsTabs />
      </div>

      <section class="mt-6">
        <LibraryGrid :books="books.data" />
        <div class="mt-4 flex gap-2">
            <Link v-for="link in books.links" :key="link.label" :href="link.url ?? '#'" v-html="link.label" :class="{'text-[var(--brand)]': link.active, 'text-muted-foreground': !link.url}" class="rounded px-2 py-1" />
        </div>
      </section>

      <section class="mt-12">
        <h2 class="mb-4 text-2xl font-semibold">Reprendre là où vous vous êtes arrêté</h2>
        <ContinueCarousel :items="allBooks.filter(b => b.progress)" />
      </section>

      <section class="mt-12">
        <h2 class="mb-4 text-2xl font-semibold">Suggestions pour vous</h2>
        <Recommendations :items="recommendations" />
      </section>

      <section class="mt-12 grid grid-cols-1 gap-6 lg:grid-cols-3">
        <div class="col-span-2">
          <h3 class="mb-3 text-xl font-semibold">Activité récente</h3>
          <ActivityTimeline :items="activity" />
        </div>
        <aside>
          <UserStats :stats="stats" />
        </aside>
      </section>
    </main>
  </AppLayout>
</template>
