<script setup lang="ts">
import { ref } from 'vue';

interface Item {
  id: number;
  title: string;
  author: string;
  cover_image: string | null;
  added_at?: string;
}

const props = defineProps<{ items: Item[] }>();
const container = ref<HTMLElement | null>(null);

function scrollLeft() {
  if (!container.value) return;
  container.value.scrollBy({ left: -300, behavior: 'smooth' });
}

function scrollRight() {
  if (!container.value) return;
  container.value.scrollBy({ left: 300, behavior: 'smooth' });
}
</script>

<template>
  <section class="py-12">
    <div class="max-w-7xl mx-auto px-6">
      <h2 class="text-2xl font-bold text-white mb-6">Nouveautés</h2>

      <div class="relative">
        <button @click="scrollLeft" class="absolute left-0 top-1/2 -translate-y-1/2 z-10 p-2 bg-black/40 text-white rounded-full">‹</button>
        <div ref="container" class="overflow-x-auto no-scrollbar flex gap-4 py-2 scroll-smooth">
          <div v-for="item in items" :key="item.id" class="min-w-[220px] bg-white/5 rounded-lg p-3">
            <img v-if="item.cover_image" :src="`/storage/${item.cover_image}`" class="w-full h-44 object-cover rounded-md" />
            <div class="mt-2 text-sm text-white font-semibold">{{ item.title }}</div>
            <div class="text-xs text-violet-200">{{ item.author }}</div>
            <div class="text-xs text-violet-300 mt-1">{{ item.added_at }}</div>
          </div>
        </div>
        <button @click="scrollRight" class="absolute right-0 top-1/2 -translate-y-1/2 z-10 p-2 bg-black/40 text-white rounded-full">›</button>
      </div>
    </div>
  </section>
</template>
