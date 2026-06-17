<script setup lang="ts">
const props = defineProps<{ user: any, stats: any }>();
</script>

<template>
  <section class="rounded-xl p-6" :style="{ background: 'linear-gradient(90deg,#050B1D 0%, #08152F 100%)' }">
    <div class="flex flex-col lg:flex-row items-center gap-6">
      <div class="flex-1">
        <h2 class="text-2xl font-semibold">Bonjour, {{ props.user?.name || 'Lecteur' }}</h2>
        <p class="text-violet-200/80 mt-2">Continuez votre aventure de lecture 📚</p>

        <div class="mt-4 grid grid-cols-2 sm:grid-cols-4 gap-3">
          <div class="p-3 bg-white/5 rounded">
            <div class="text-sm text-violet-100">Livres enregistrés</div>
            <div class="text-xl font-bold">{{ props.stats?.saved ?? 0 }}</div>
          </div>
          <div class="p-3 bg-white/5 rounded">
            <div class="text-sm text-violet-100">Livres lus</div>
            <div class="text-xl font-bold">{{ props.stats?.finished ?? 0 }}</div>
          </div>
          <div class="p-3 bg-white/5 rounded">
            <div class="text-sm text-violet-100">En cours</div>
            <div class="text-xl font-bold">{{ props.stats?.reading ?? 0 }}</div>
          </div>
          <div class="p-3 bg-white/5 rounded">
            <div class="text-sm text-violet-100">Favoris</div>
            <div class="text-xl font-bold">{{ props.stats?.favorites ?? 0 }}</div>
          </div>
        </div>

        <div class="mt-6 flex gap-3">
          <a href="#" class="btn-accent">Continuer ma lecture</a>
          <a href="/books" class="btn-outline-accent">Explorer la bibliothèque</a>
        </div>
      </div>

      <div class="w-full lg:w-80">
        <div class="rounded-lg p-4" style="background:linear-gradient(180deg, rgba(139,61,255,0.06), rgba(168,85,247,0.04));">
          <div class="text-sm text-violet-100 mb-2">Statut rapide</div>
          <div class="space-y-3">
            <div class="flex items-center justify-between">
              <div class="text-sm text-violet-200">Lecture en cours</div>
              <div class="text-sm font-semibold">{{ props.stats?.reading ?? 0 }}</div>
            </div>
            <div class="h-2 bg-white/5 rounded overflow-hidden">
              <div class="h-2 bg-[linear-gradient(90deg,#8B3DFF,#A855F7)]" style="width:40%"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
