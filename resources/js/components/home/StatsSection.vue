<script setup lang="ts">
import { ref, onMounted } from 'vue';

function useCount(target: number, duration = 1200) {
  const value = ref(0);
  onMounted(() => {
    const start = performance.now();
    const step = (now: number) => {
      const t = Math.min(1, (now - start) / duration);
      value.value = Math.floor(t * target);
      if (t < 1) requestAnimationFrame(step);
      else value.value = target;
    };
    requestAnimationFrame(step);
  });
  return value;
}

const books = useCount(10000);
const users = useCount(5000);
const categories = useCount(250);
const news = useCount(50);
</script>

<template>
  <section class="py-12">
    <div class="max-w-7xl mx-auto px-6">
      <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
        <div class="p-6 rounded-lg bg-white/5">
          <div class="text-3xl font-bold text-white">{{ books }}+</div>
          <div class="text-sm text-violet-200 mt-2">Livres</div>
        </div>

        <div class="p-6 rounded-lg bg-white/5">
          <div class="text-3xl font-bold text-white">{{ users }}+</div>
          <div class="text-sm text-violet-200 mt-2">Utilisateurs</div>
        </div>

        <div class="p-6 rounded-lg bg-white/5">
          <div class="text-3xl font-bold text-white">{{ categories }}+</div>
          <div class="text-sm text-violet-200 mt-2">Catégories</div>
        </div>

        <div class="p-6 rounded-lg bg-white/5">
          <div class="text-3xl font-bold text-white">{{ news }}+</div>
          <div class="text-sm text-violet-200 mt-2">Nouveautés / mois</div>
        </div>
      </div>
    </div>
  </section>
</template>
