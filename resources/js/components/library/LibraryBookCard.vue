<script setup lang="ts">
const props = defineProps<{ book: any }>();
</script>

<template>
  <div class="relative rounded-lg overflow-hidden group bg-white/2">
    <img v-if="props.book.cover_image" :src="`/storage/${props.book.cover_image}`" alt="cover" class="w-full h-56 object-cover" />
    <div v-else class="w-full h-56 bg-white/5 flex items-center justify-center">No cover</div>

    <div class="p-3">
      <div class="text-sm text-violet-100 font-semibold">{{ props.book.title }}</div>
      <div class="text-xs text-violet-200">{{ props.book.author }}</div>
      <div class="text-xs text-violet-300 mt-2">{{ props.book.genre }}</div>
    </div>

    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition-opacity flex items-end justify-center p-3 opacity-0 group-hover:opacity-100">
      <div class="flex gap-2">
        <a href="#" class="px-3 py-2 rounded bg-violet-600 text-white text-sm">Continuer</a>
        <a href="#" class="px-3 py-2 rounded bg-white/5 text-white text-sm">Détails</a>
        <button class="px-3 py-2 rounded bg-white/5 text-white text-sm">❤</button>
      </div>
    </div>

    <!-- progress -->
    <div v-if="props.book.progress" class="absolute left-3 right-3 bottom-12 h-2 bg-white/5 rounded overflow-hidden">
      <div class="h-2 bg-[linear-gradient(90deg,#8B3DFF,#A855F7)]" :style="{ width: (props.book.progress*100)+'%' }"></div>
    </div>

    <!-- badges -->
    <div class="absolute top-3 left-3 space-y-1">
      <span v-if="props.book.is_new" class="text-xs bg-violet-700/70 px-2 py-1 rounded">Nouveau</span>
      <span v-if="props.book.is_favorite" class="text-xs bg-violet-700/70 px-2 py-1 rounded">Favori</span>
      <span v-if="props.book.is_downloaded" class="text-xs bg-violet-700/70 px-2 py-1 rounded">Téléchargé</span>
    </div>
  </div>
</template>
