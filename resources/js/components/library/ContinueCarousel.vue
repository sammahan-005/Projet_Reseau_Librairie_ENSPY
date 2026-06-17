<script setup lang="ts">
import { ref } from 'vue';
const props = defineProps<{ items: any[] }>();
const container = ref<HTMLElement | null>(null);
function left(){ if(container.value) container.value.scrollBy({ left: -300, behavior:'smooth' }) }
function right(){ if(container.value) container.value.scrollBy({ left: 300, behavior:'smooth' }) }
</script>

<template>
  <div class="relative">
    <button @click="left" class="absolute left-0 top-1/2 -translate-y-1/2 z-10 p-2 bg-white/5 rounded">‹</button>
    <div ref="container" class="flex gap-4 overflow-x-auto scroll-smooth p-2">
      <div v-for="it in items" :key="it.id" class="min-w-[220px] bg-white/3 rounded p-3">
        <img v-if="it.cover_image" :src="`/storage/${it.cover_image}`" class="w-full h-40 object-cover rounded" />
        <div class="mt-2 text-sm font-semibold">{{ it.title }}</div>
        <div class="text-xs text-violet-200">{{ Math.round(it.progress*100) }}% lu</div>
      </div>
    </div>
    <button @click="right" class="absolute right-0 top-1/2 -translate-y-1/2 z-10 p-2 bg-white/5 rounded">›</button>
  </div>
</template>
