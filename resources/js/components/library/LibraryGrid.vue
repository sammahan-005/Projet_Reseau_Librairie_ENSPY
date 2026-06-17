<script setup lang="ts">
const props = defineProps<{ books: any[] }>();
</script>

<template>
  <div>
    <div v-if="!books || !books.length" class="text-violet-200/70 py-12 text-center">Vous n'avez aucun livre pour le moment.</div>

    <div v-else class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
      <LibraryBookCard v-for="b in books" :key="b.id" :book="b" />
    </div>
  </div>
</template>
