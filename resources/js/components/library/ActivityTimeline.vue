<script setup lang="ts">
const props = defineProps<{ items: any[] }>();
</script>

<template>
  <div class="space-y-3">
    <div v-for="(it, idx) in props.items" :key="idx" class="p-3 bg-white/3 rounded flex items-start gap-3">
      <div class="w-10 h-10 rounded bg-violet-700/60 flex items-center justify-center">🔔</div>
      <div>
        <div class="text-sm">{{ it.message }}</div>
        <div class="text-xs text-violet-200">{{ it.when }}</div>
      </div>
    </div>
  </div>
</template>
