<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Livres (Books Index)</h1>
    <div v-if="books && books.length">
      <ul>
        <li v-for="book in books" :key="book.id" class="mb-2">
          <strong>{{ book.titre || book.title }}</strong>
          <div class="text-sm text-gray-600">Auteur: {{ book.auteur || book.author }}</div>
        </li>
      </ul>
    </div>
    <div v-else>
      <p>Aucun livre trouvé.</p>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    books: {
      type: Array,
      default: () => []
    }
  }
}
</script>

<style scoped>
.text-gray-600 { color: #4B5563 }
</style>
