<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, router } from '@inertiajs/vue3';
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

defineProps<{
  users: {
    data: any[];
    links: any[];
  };
}>();

const breadcrumbs = [
  {
    title: 'Utilisateurs',
    href: '/admin/users',
  },
];

function suspend(id: number) {
  if (confirm('Suspendre cet utilisateur ?')) {
    router.post(`/admin/users/${id}/suspend`);
  }
}

function unsuspend(id: number) {
  router.post(`/admin/users/${id}/unsuspend`);
}

function remove(id: number) {
  if (confirm('Supprimer définitivement cet utilisateur ?')) {
    router.delete(`/admin/users/${id}`);
  }
}
</script>

<template>
  <Head title="Gestion des Utilisateurs" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex h-full flex-1 flex-col gap-4 p-4">
      <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold">Utilisateurs</h1>
      </div>

      <div class="rounded-md border bg-card text-card-foreground shadow-sm">
        <Table>
          <TableHeader>
            <TableRow>
              <TableHead>Nom</TableHead>
              <TableHead>Email</TableHead>
              <TableHead>Rôle</TableHead>
              <TableHead>Statut</TableHead>
              <TableHead class="text-right">Actions</TableHead>
            </TableRow>
          </TableHeader>
          <TableBody>
            <TableRow v-for="user in users.data" :key="user.id">
              <TableCell class="font-medium">{{ user.name }}</TableCell>
              <TableCell>{{ user.email }}</TableCell>
              <TableCell>
                <Badge variant="outline" class="capitalize">{{ user.role }}</Badge>
              </TableCell>
              <TableCell>
                <Badge :variant="user.suspended_at ? 'destructive' : 'default'">
                  {{ user.suspended_at ? 'Suspendu' : 'Actif' }}
                </Badge>
              </TableCell>
              <TableCell class="text-right">
                <div class="flex justify-end gap-2">
                  <Button
                    v-if="!user.suspended_at"
                    variant="outline"
                    size="sm"
                    @click="suspend(user.id)"
                  >
                    Suspendre
                  </Button>
                  <Button
                    v-else
                    variant="outline"
                    size="sm"
                    @click="unsuspend(user.id)"
                    class="text-green-600 hover:text-green-700"
                  >
                    Rétablir
                  </Button>
                  <Button
                    variant="destructive"
                    size="sm"
                    @click="remove(user.id)"
                  >
                    Supprimer
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
