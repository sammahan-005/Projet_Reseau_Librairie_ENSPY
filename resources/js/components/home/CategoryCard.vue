<script setup lang="ts">
const props = withDefaults(defineProps<{
  icon: string;
  name: string;
  count: number;
}>(), { icon: 'book', name: '', count: 0 });
</script>

<template>
  <div class="p-4 rounded-xl bg-white/5 border border-transparent hover:border-violet-500 transition-all duration-300 shadow-sm hover:shadow-lg">
    <div class="flex items-center gap-4">
      <div class="w-12 h-12 rounded-lg bg-violet-600/20 text-white flex items-center justify-center">
        <i :class="props.icon"></i>
      </div>
      <div>
        <div class="text-sm font-semibold text-white">{{ props.name }}</div>
        <div class="text-xs text-violet-200/80">{{ props.count }} livres</div>
      </div>
    </div>
  </div>
</template>
