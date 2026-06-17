<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import {
  Table,
  TableBody,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from '@/components/ui/table';
import { Badge } from '@/components/ui/badge';
import { Plus, Pencil, Trash2 } from 'lucide-vue-next';

defineProps<{
  books: {
    data: any[];
    links: any[];
  };
  categories: any[];
}>();

const breadcrumbs = [
  {
    title: 'Gestion Catalogue',
    href: '/admin/catalog',
  },
];

function deleteBook(id: number) {
  if (confirm('Supprimer ce livre ?')) {
    router.delete(`/admin/api/books/${id}`);
  }
}
</script>

<template>
  <Head title="Gestion du Catalogue" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex h-full flex-1 flex-col gap-4 p-4">
      <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold">Catalogue</h1>
        <Button as-child>
          <Link href="/admin/catalog/create">
            <Plus class="mr-2 h-4 w-4" />
            Ajouter un livre
          </Link>
        </Button>
      </div>

      <div class="rounded-md border bg-card text-card-foreground shadow-sm">
        <Table>
          <TableHeader>
            <TableRow>
              <TableHead>Titre</TableHead>
              <TableHead>Auteur</TableHead>
              <TableHead>Genre</TableHead>
              <TableHead>Catégories</TableHead>
              <TableHead class="text-right">Actions</TableHead>
            </TableRow>
          </TableHeader>
          <TableBody>
            <TableRow v-for="book in books.data" :key="book.id">
              <TableCell class="font-medium">{{ book.title }}</TableCell>
              <TableCell>{{ book.author }}</TableCell>
              <TableCell>{{ book.genre }}</TableCell>
              <TableCell>
                <div class="flex flex-wrap gap-1">
                  <Badge v-for="cat in book.categories" :key="cat.id" variant="secondary" class="text-xs">
                    {{ cat.name }}
                  </Badge>
                </div>
              </TableCell>
              <TableCell class="text-right">
                <div class="flex justify-end gap-2">
                  <Button variant="ghost" size="icon" as-child title="Modifier">
                    <Link :href="`/admin/catalog/${book.id}/edit`">
                      <Pencil class="h-4 w-4" />
                    </Link>
                  </Button>
                  <Button variant="ghost" size="icon" @click="deleteBook(book.id)" class="text-destructive" title="Supprimer">
                    <Trash2 class="h-4 w-4" />
                  </Button>
                </div>
              </TableCell>
            </TableRow>
          </TableBody>
        </Table>
      </div>
    </div>
  </AppLayout>
</template>
