<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';

const breadcrumbs = [
  {
    title: 'Gestion Catalogue',
    href: '/admin/catalog',
  },
  {
    title: 'Ajouter un livre',
    href: '/admin/catalog/create',
  },
];

const form = useForm({
  title: '',
  author: '',
  published_year: '',
  genre: '',
  cover_image: null,
  pdf: null,
});

function submit() {
  form.post('/admin/api/books', {
    preserveScroll: true,
  });
}
</script>

<template>
  <Head title="Ajouter un livre" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex h-full flex-1 flex-col gap-4 p-4">
      <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold">Ajouter un livre au catalogue</h1>
      </div>

      <Card class="mx-auto w-full max-w-2xl">
        <CardHeader>
          <CardTitle>Nouveau Livre</CardTitle>
        </CardHeader>
        <CardContent>
          <form @submit.prevent="submit" class="space-y-6">
            <div class="space-y-2">
              <Label for="title">Titre</Label>
              <Input id="title" v-model="form.title" placeholder="Titre du livre" required />
            </div>

            <div class="space-y-2">
              <Label for="author">Auteur</Label>
              <Input id="author" v-model="form.author" placeholder="Nom de l'auteur" required />
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <Label for="published_year">Année de publication</Label>
                    <Input id="published_year" type="date" v-model="form.published_year" required />
                </div>
                <div class="space-y-2">
                    <Label for="genre">Genre</Label>
                    <Input id="genre" v-model="form.genre" placeholder="Ex: Fiction, Science" />
                </div>
            </div>

            <div class="space-y-2">
              <Label for="cover_image">Image de couverture</Label>
              <Input id="cover_image" type="file" @input="form.cover_image = $event.target.files[0]" accept="image/*" required />
            </div>

            <div class="space-y-2">
              <Label for="pdf">Fichier PDF</Label>
              <Input id="pdf" type="file" @input="form.pdf = $event.target.files[0]" accept=".pdf" required />
            </div>

            <div class="flex justify-end gap-3">
              <Button variant="outline" as-child>
                <Link href="/admin/catalog">Annuler</Link>
              </Button>
              <Button type="submit" :disabled="form.processing">
                {{ form.processing ? 'Création...' : 'Créer le livre' }}
              </Button>
            </div>
          </form>
        </CardContent>
      </Card>
    </div>
  </AppLayout>
</template>
