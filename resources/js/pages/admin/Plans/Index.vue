<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import {
  Table,
  TableBody,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from '@/components/ui/table';
import { Badge } from '@/components/ui/badge';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Banknote, Calendar } from 'lucide-vue-next';

defineProps<{
  subscriptions: {
    data: any[];
    links: any[];
  };
  totalRevenue: number;
}>();

const breadcrumbs = [
  {
    title: 'Plans & Abonnements',
    href: '/admin/plans',
  },
];
</script>

<template>
  <Head title="Plans & Abonnements" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex h-full flex-1 flex-col gap-4 p-4">
      <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold">Abonnements & Revenus</h1>
      </div>

      <div class="grid gap-4 md:grid-cols-2">
        <Card>
          <CardHeader class="flex flex-row items-center justify-between space-y-0 pb-2">
            <CardTitle class="text-sm font-medium">Revenu Total</CardTitle>
            <Banknote class="h-4 w-4 text-muted-foreground" />
          </CardHeader>
          <CardContent>
            <div class="text-2xl font-bold">{{ totalRevenue }} FCFA</div>
            <p class="text-xs text-muted-foreground">Transactions complétées</p>
          </CardContent>
        </Card>
        <Card>
          <CardHeader class="flex flex-row items-center justify-between space-y-0 pb-2">
            <CardTitle class="text-sm font-medium">Total Abonnements</CardTitle>
            <Calendar class="h-4 w-4 text-muted-foreground" />
          </CardHeader>
          <CardContent>
            <div class="text-2xl font-bold">{{ subscriptions.data.length }}</div>
            <p class="text-xs text-muted-foreground">Sur cette page</p>
          </CardContent>
        </Card>
      </div>

      <div class="rounded-md border bg-card text-card-foreground shadow-sm">
        <Table>
          <TableHeader>
            <TableRow>
              <TableHead>Type</TableHead>
              <TableHead>Utilisateur</TableHead>
              <TableHead>Prix</TableHead>
              <TableHead>Date</TableHead>
              <TableHead>Statut Paiement</TableHead>
            </TableRow>
          </TableHeader>
          <TableBody>
            <TableRow v-for="sub in subscriptions.data" :key="sub.id">
              <TableCell>
                <Badge class="capitalize">{{ sub.type }}</Badge>
              </TableCell>
              <TableCell>
                <div v-for="u in sub.users" :key="u.id">{{ u.name }}</div>
              </TableCell>
              <TableCell>{{ sub.price }} FCFA</TableCell>
              <TableCell>{{ new Date(sub.created_at).toLocaleDateString() }}</TableCell>
              <TableCell>
                <Badge :variant="sub.paiement?.status === 'completed' ? 'default' : 'secondary'">
                  {{ sub.paiement?.status || 'N/A' }}
                </Badge>
              </TableCell>
            </TableRow>
          </TableBody>
        </Table>
      </div>
    </div>
  </AppLayout>
</template>
