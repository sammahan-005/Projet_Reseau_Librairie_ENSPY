<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';

const props = defineProps<{
  book: any;
}>();

const breadcrumbs = [
  {
    title: 'Gestion Catalogue',
    href: '/admin/catalog',
  },
  {
    title: 'Modifier un livre',
    href: `/admin/catalog/${props.book.id}/edit`,
  },
];

const form = useForm({
  _method: 'PUT',
  title: props.book.title || '',
  author: props.book.author || '',
  published_year: props.book.published_year || '',
  genre: props.book.genre || '',
  cover_image: null,
  pdf: null,
});

function submit() {
  // Use post with _method=PUT to support file uploads on some environments
  form.post(`/admin/api/books/${props.book.id}`, {
    preserveScroll: true,
  });
}
</script>

<template>
  <Head title="Modifier le livre" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex h-full flex-1 flex-col gap-4 p-4">
      <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold">Modifier le livre</h1>
      </div>

      <Card class="mx-auto w-full max-w-2xl">
        <CardHeader>
          <CardTitle>Informations du livre</CardTitle>
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
              <Input id="cover_image" type="file" @input="form.cover_image = $event.target.files[0]" accept="image/*" />
              <p class="text-xs text-muted-foreground">Laissez vide pour conserver l'image actuelle.</p>
            </div>

            <div class="space-y-2">
              <Label for="pdf">Fichier PDF</Label>
              <Input id="pdf" type="file" @input="form.pdf = $event.target.files[0]" accept=".pdf" />
              <p class="text-xs text-muted-foreground">Laissez vide pour conserver le fichier actuel.</p>
            </div>

            <div class="flex justify-end gap-3">
              <Button variant="outline" as-child>
                <Link href="/admin/catalog">Annuler</Link>
              </Button>
              <Button type="submit" :disabled="form.processing">
                {{ form.processing ? 'Enregistrement...' : 'Enregistrer les modifications' }}
              </Button>
            </div>
          </form>
        </CardContent>
      </Card>
    </div>
  </AppLayout>
</template>
