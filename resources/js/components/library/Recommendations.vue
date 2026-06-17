<script setup lang="ts">
const props = defineProps<{ items: any[] }>();
</script>

<template>
  <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
    <div v-for="it in props.items" :key="it.id" class="rounded-lg overflow-hidden bg-white/3 p-3">
      <img v-if="it.cover_image" :src="`/storage/${it.cover_image}`" class="w-full h-40 object-cover rounded" />
      <div class="mt-2 text-sm font-semibold">{{ it.title }}</div>
      <div class="text-xs text-violet-200">{{ it.author }}</div>
    </div>
  </div>
</template>
