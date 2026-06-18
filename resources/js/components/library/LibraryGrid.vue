<script setup lang="ts">
import LibraryBookCard from '@/components/library/LibraryBookCard.vue';

const props = defineProps<{ books: any[] }>();
</script>

<template>
  <div>
    <div v-if="!books || !books.length" class="py-12 text-center text-muted-foreground">Vous n'avez aucun livre pour le moment.</div>

    <div v-else class="grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5">
      <LibraryBookCard v-for="b in books" :key="b.id" :book="b" />
    </div>
  </div>
</template>
