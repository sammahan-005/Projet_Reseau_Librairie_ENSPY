<template>
  <div class="p-6 max-w-3xl">
    <h1 class="text-2xl font-bold">Envoyer une notification</h1>
    <form @submit.prevent="submit" class="mt-4 space-y-4">
      <div>
        <label class="block text-sm font-medium">Titre</label>
        <input v-model="form.title" class="mt-1 w-full rounded-md" />
      </div>

      <div>
        <label class="block text-sm font-medium">Message</label>
        <textarea v-model="form.message" class="mt-1 w-full rounded-md"></textarea>
      </div>

      <div>
        <label class="block text-sm font-medium">Cible (role ou email)</label>
        <input v-model="form.target" class="mt-1 w-full rounded-md" />
      </div>

      <div class="flex gap-2">
        <button type="submit" class="btn-accent">Envoyer</button>
        <inertia-link href="/admin/notifications" class="btn-outline-accent">Annuler</inertia-link>
      </div>
    </form>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';

const form = useForm({ title: '', message: '', target: '' });

function submit() {
  form.post('/admin/api/notifications');
}
</script>
