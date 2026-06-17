<template>
  <div class="p-6 max-w-3xl">
    <h1 class="text-2xl font-bold">Ajouter un livre</h1>
    <form @submit.prevent="submit" class="mt-4 space-y-4">
      <div>
        <label class="block text-sm font-medium">Titre</label>
        <input v-model="form.title" class="mt-1 w-full rounded-md" />
      </div>

      <div>
        <label class="block text-sm font-medium">Auteur</label>
        <input v-model="form.author" class="mt-1 w-full rounded-md" />
      </div>

      <div>
        <label class="block text-sm font-medium">Année de publication</label>
        <input type="date" v-model="form.published_year" class="mt-1 w-full rounded-md" />
      </div>

      <div>
        <label class="block text-sm font-medium">Couverture</label>
        <input type="file" @change="onCover" class="mt-1" />
      </div>

      <div>
        <label class="block text-sm font-medium">PDF (optionnel)</label>
        <input type="file" @change="onPdf" class="mt-1" />
      </div>

      <div class="flex gap-2">
        <button type="submit" class="btn-accent">Créer</button>
        <inertia-link href="/admin/catalog" class="btn-outline-accent">Annuler</inertia-link>
      </div>
    </form>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const form = useForm({ title: '', author: '', published_year: '', cover_image: null, pdf: null });

function onCover(e) {
  form.cover_image = e.target.files[0];
}

function onPdf(e) {
  form.pdf = e.target.files[0];
}

function submit() {
  form.post('/admin/api/books', { forceFormData: true });
}
</script>
