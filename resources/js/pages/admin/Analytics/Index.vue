<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Users, Clock, Banknote, Trophy } from 'lucide-vue-next';

defineProps<{
  active_users: number;
  reading_hours: number;
  revenue: number;
  top_books: any[];
}>();

const breadcrumbs = [
  {
    title: 'Administration',
    href: '/admin',
  },
];
</script>

<template>
  <Head title="Tableau de bord analytique" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex h-full flex-1 flex-col gap-4 p-4">
      <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
        <Card>
          <CardHeader class="flex flex-row items-center justify-between space-y-0 pb-2">
            <CardTitle class="text-sm font-medium">Utilisateurs Actifs</CardTitle>
            <Users class="h-4 w-4 text-muted-foreground" />
          </CardHeader>
          <CardContent>
            <div class="text-2xl font-bold">{{ active_users }}</div>
            <p class="text-xs text-muted-foreground">Ce mois-ci</p>
          </CardContent>
        </Card>
        <Card>
          <CardHeader class="flex flex-row items-center justify-between space-y-0 pb-2">
            <CardTitle class="text-sm font-medium">Heures de lecture</CardTitle>
            <Clock class="h-4 w-4 text-muted-foreground" />
          </CardHeader>
          <CardContent>
            <div class="text-2xl font-bold">{{ reading_hours }}h</div>
            <p class="text-xs text-muted-foreground">Consommation totale</p>
          </CardContent>
        </Card>
        <Card>
          <CardHeader class="flex flex-row items-center justify-between space-y-0 pb-2">
            <CardTitle class="text-sm font-medium">Revenus</CardTitle>
            <Banknote class="h-4 w-4 text-muted-foreground" />
          </CardHeader>
          <CardContent>
            <div class="text-2xl font-bold">{{ revenue }} FCFA</div>
            <p class="text-xs text-muted-foreground">Total des abonnements</p>
          </CardContent>
        </Card>
      </div>

      <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-7">
        <Card class="col-span-4">
          <CardHeader>
            <CardTitle>Livres les plus lus</CardTitle>
          </CardHeader>
          <CardContent>
            <div class="space-y-4">
              <div v-for="(book, index) in top_books" :key="book.id" class="flex items-center gap-4">
                <div class="flex h-9 w-9 items-center justify-center rounded-full bg-muted font-bold">
                    {{ index + 1 }}
                </div>
                <div class="flex flex-1 flex-col">
                  <span class="text-sm font-medium">{{ book.title }}</span>
                  <span class="text-xs text-muted-foreground">{{ book.read_count }} lectures</span>
                </div>
                <Trophy v-if="index === 0" class="h-4 w-4 text-yellow-500" />
              </div>
            </div>
          </CardContent>
        </Card>
      </div>
    </div>
  </AppLayout>
</template>
