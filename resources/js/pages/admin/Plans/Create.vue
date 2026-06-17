<template>
  <div class="p-6 max-w-3xl">
    <h1 class="text-2xl font-bold">Créer un plan</h1>
    <form @submit.prevent="submit" class="mt-4 space-y-4">
      <div>
        <label class="block text-sm font-medium">Nom</label>
        <input v-model="form.name" class="mt-1 w-full rounded-md" />
      </div>

      <div>
        <label class="block text-sm font-medium">Durée (minutes)</label>
        <input type="number" v-model="form.duration" class="mt-1 w-full rounded-md" />
      </div>

      <div>
        <label class="block text-sm font-medium">Prix (FCFA)</label>
        <input type="number" v-model="form.price" class="mt-1 w-full rounded-md" />
      </div>

      <div class="flex gap-2">
        <button type="submit" class="btn-accent">Créer</button>
        <inertia-link href="/admin/plans" class="btn-outline-accent">Annuler</inertia-link>
      </div>
    </form>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';

const form = useForm({ name: '', duration: 30, price: 0 });

function submit() {
  form.post('/admin/api/plans');
}
</script>
