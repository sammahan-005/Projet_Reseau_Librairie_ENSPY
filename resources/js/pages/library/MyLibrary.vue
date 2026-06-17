<script setup lang="ts">
import AppNavbar from '@/components/AppNavbar.vue';
import PersonalHero from '@/components/library/PersonalHero.vue';
import CollectionsTabs from '@/components/library/CollectionsTabs.vue';
import LibraryGrid from '@/components/library/LibraryGrid.vue';
import ContinueCarousel from '@/components/library/ContinueCarousel.vue';
import Recommendations from '@/components/library/Recommendations.vue';
import ActivityTimeline from '@/components/library/ActivityTimeline.vue';
import UserStats from '@/components/library/UserStats.vue';

defineProps<{ 
  user: any,
  books: any[],
  recommendations: any[],
  activity: any[],
  stats: any,
}>();
</script>

<template>
  <div class="min-h-screen bg-[#050B1D] text-white">
    <AppNavbar />

    <main class="max-w-7xl mx-auto px-6 py-8">
      <PersonalHero :user="user" :stats="stats" />

      <div class="mt-8">
        <CollectionsTabs />
      </div>

      <section class="mt-6">
        <LibraryGrid :books="books" />
      </section>

      <section class="mt-12">
        <h2 class="text-2xl font-semibold mb-4">Reprendre là où vous vous êtes arrêté</h2>
        <ContinueCarousel :items="books.filter(b => b.progress)" />
      </section>

      <section class="mt-12">
        <h2 class="text-2xl font-semibold mb-4">Suggestions pour vous</h2>
        <Recommendations :items="recommendations" />
      </section>

      <section class="mt-12 grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="col-span-2">
          <h3 class="text-xl font-semibold mb-3">Activité récente</h3>
          <ActivityTimeline :items="activity" />
        </div>
        <aside>
          <UserStats :stats="stats" />
        </aside>
      </section>

    </main>
  </div>
</template>
