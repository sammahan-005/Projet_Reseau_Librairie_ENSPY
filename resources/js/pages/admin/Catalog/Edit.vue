<script setup lang="ts">
import { ref } from 'vue';
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

const coverPreview = ref(
  props.book.cover_url ?? null
);

const form = useForm({
  _method: 'PUT',
  title: props.book.title || '',
  author: props.book.author || '',
  published_year: props.book.published_year || '',
  genre: props.book.genre || '',

  cover_image: null as File | null,
  pdf_path: null as File | null,

  remove_cover_image: false,
  remove_pdf: false,
});

function handleCoverChange(event: Event) {
  const target = event.target as HTMLInputElement;

  if (!target.files?.length) return;

  const file = target.files[0];

  form.cover_image = file;
  form.remove_cover_image = false;

  coverPreview.value = URL.createObjectURL(file);
}

function handlePdfChange(event: Event) {
  const target = event.target as HTMLInputElement;

  if (!target.files?.length) return;

  form.pdf_path = target.files[0];
  form.remove_pdf = false;
}

function removeCover() {
  form.remove_cover_image = true;
  form.cover_image = null;
  coverPreview.value = null;
}

function removePdf() {
  form.remove_pdf = true;
  form.pdf_path = null;
}

function submit() {
  form.post(`/admin/api/books/${props.book.id}`, {
      preserveScroll: true,
      forceFormData: true,

      onSuccess: () => {
          console.log("Livre modifié");
      },

      onError: (errors) => {
          console.log(errors);
      }
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

              <div v-if="coverPreview && !form.remove_cover_image" class="rounded-lg border p-4">
                <img :src="coverPreview" alt="Couverture" class="h-48 rounded object-cover" />

                <div class="mt-3 flex gap-2">
                  <Button type="button" variant="destructive" @click="removeCover">
                    Supprimer l'image
                  </Button>
                </div>
              </div>

              <Input id="cover_image" type="file" accept="image/*" @change="handleCoverChange" />

              <p class="text-xs text-muted-foreground">
                Sélectionnez une nouvelle image pour remplacer l'ancienne.
              </p>
            </div>

            <div class="space-y-2">
              <Label for="pdf">Fichier PDF</Label>

              <div v-if="props.book.pdf_url && !form.remove_pdf" class="rounded-lg border p-4">
                <div class="flex items-center justify-between">
                  <a :href="props.book.pdf_url" target="_blank" class="text-primary underline">
                    Voir le PDF actuel
                  </a>

                  <Button type="button" variant="destructive" @click="removePdf">
                    Supprimer le PDF
                  </Button>
                </div>
              </div>

              <Input id="pdf" type="file" accept=".pdf" @change="handlePdfChange" />

              <p v-if="form.pdf_path" class="text-sm text-green-600">
                Nouveau fichier sélectionné :
                {{ form.pdf_path.name }}
              </p>

              <p class="text-xs text-muted-foreground">
                Sélectionnez un nouveau PDF pour remplacer l'ancien.
              </p>
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
