<script setup lang="ts">
import BookCard from '@/components/BookCard.vue';
import { usePage, Link } from '@inertiajs/vue3';

interface Book {
  id: number;
  title: string;
  author: string;
  genre: string;
  cover_image: string | null;
}

const props = defineProps<{ books: Book[] }>();
const page = usePage();
</script>

<template>
  <section class="py-12">
    <div class="max-w-7xl mx-auto px-6">
      <h2 class="text-2xl font-bold text-white mb-6">Livres populaires</h2>

      <div v-if="!$page.props.auth.user" class="mb-4 p-4 rounded-lg bg-gradient-to-r from-violet-700 to-indigo-800 text-white">Connectez-vous pour accéder au contenu</div>

      <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">
        <BookCard v-for="book in books" :key="book.id" :book="book" />
      </div>
    </div>
  </section>
</template>
