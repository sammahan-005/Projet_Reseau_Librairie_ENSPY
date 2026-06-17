<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold">Historique de lecture</h1>
    <p class="mt-2 text-sm text-muted-foreground">Liste de toutes les sessions de lecture avec dates, durées et heures consommées.</p>
    <div class="mt-6">
      <table class="w-full table-auto">
        <thead>
          <tr class="text-left text-xs uppercase text-muted-foreground">
            <th>Titre</th>
            <th>Durée (min)</th>
            <th>Dernière session</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in $page.props.history" :key="item.id" class="border-t">
            <td class="py-2">{{ item.title }}</td>
            <td class="py-2">{{ Math.round(item.duration/60) }}</td>
            <td class="py-2">{{ item.updated_at }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
<script setup>
</script>
