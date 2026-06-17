<template>
  <div class="p-6 max-w-3xl">
    <h1 class="text-2xl font-bold">Modifier l'utilisateur</h1>
    <form @submit.prevent="submit" class="mt-4 space-y-4">
      <div>
        <label class="block text-sm font-medium">Nom</label>
        <input v-model="form.name" class="mt-1 w-full rounded-md" />
      </div>

      <div>
        <label class="block text-sm font-medium">Email</label>
        <input v-model="form.email" class="mt-1 w-full rounded-md" />
      </div>

      <div class="flex gap-2">
        <button type="submit" class="btn-accent">Enregistrer</button>
        <inertia-link href="/admin/users" class="btn-outline-accent">Annuler</inertia-link>
      </div>
    </form>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';

const page = usePage();
const user = page.props.user || {};

const form = useForm({ name: user.name || '', email: user.email || '' });

function submit() {
  // For now we just send a simple patch via inertia
  form.put(`/admin/users/${user.id}`);
}
</script>
