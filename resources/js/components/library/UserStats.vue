<script setup lang="ts">
const props = defineProps<{ stats: any }>();
</script>

<template>
  <div class="space-y-3">
    <div class="p-4 rounded-lg bg-white/3">
      <div class="text-sm text-violet-200">Nombre de livres</div>
      <div class="text-2xl font-bold">{{ props.stats?.saved ?? 0 }}</div>
    </div>
    <div class="p-4 rounded-lg bg-white/3">
      <div class="text-sm text-violet-200">Heures de lecture</div>
      <div class="text-2xl font-bold">{{ props.stats?.hours ?? 0 }}</div>
    </div>
    <div class="p-4 rounded-lg bg-white/3">
      <div class="text-sm text-violet-200">Livres terminés</div>
      <div class="text-2xl font-bold">{{ props.stats?.finished ?? 0 }}</div>
    </div>
    <div class="p-4 rounded-lg bg-white/3">
      <div class="text-sm text-violet-200">Catégorie favorite</div>
      <div class="text-2xl font-bold">{{ props.stats?.favorite_category ?? '-' }}</div>
    </div>
  </div>
</template>
