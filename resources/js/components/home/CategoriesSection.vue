<script setup lang="ts">
import CategoryCard from './CategoryCard.vue';
</script>

<template>
  <section class="py-12">
    <div class="max-w-7xl mx-auto px-6">
      <h2 class="text-2xl font-bold text-white mb-6">Explorer par catégorie</h2>

      <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-4">
        <CategoryCard name="Informatique" :count="1240" icon="ph ph-laptop" />
        <CategoryCard name="Réseaux" :count="980" icon="ph ph-network" />
        <CategoryCard name="Intelligence Artificielle" :count="760" icon="ph ph-brain" />
        <CategoryCard name="Développement Web" :count="1340" icon="ph ph-code" />
        <CategoryCard name="Bases de Données" :count="430" icon="ph ph-database" />
        <CategoryCard name="Cybersécurité" :count="520" icon="ph ph-shield-check" />
      </div>
    </div>
  </section>
</template>
