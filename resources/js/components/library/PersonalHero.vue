<script setup lang="ts">
const props = defineProps<{ user: any, stats: any }>();
</script>

<template>
  <section class="rounded-xl p-6 bg-card border border-border shadow-sm">
    <div class="flex flex-col lg:flex-row items-center gap-6">
      <div class="flex-1">
        <h2 class="text-2xl font-semibold text-foreground">Bonjour, {{ props.user?.name || 'Lecteur' }}</h2>
        <p class="text-muted-foreground mt-2">Continuez votre aventure de lecture 📚</p>

        <div class="mt-4 grid grid-cols-2 sm:grid-cols-4 gap-3">
          <div class="p-3 bg-secondary rounded-lg">
            <div class="text-sm text-secondary-foreground/70">Livres enregistrés</div>
            <div class="text-xl font-bold text-foreground">{{ props.stats?.saved ?? 0 }}</div>
          </div>
          <div class="p-3 bg-secondary rounded-lg">
            <div class="text-sm text-secondary-foreground/70">Livres lus</div>
            <div class="text-xl font-bold text-foreground">{{ props.stats?.finished ?? 0 }}</div>
          </div>
          <div class="p-3 bg-secondary rounded-lg">
            <div class="text-sm text-secondary-foreground/70">En cours</div>
            <div class="text-xl font-bold text-foreground">{{ props.stats?.reading ?? 0 }}</div>
          </div>
          <div class="p-3 bg-secondary rounded-lg">
            <div class="text-sm text-secondary-foreground/70">Favoris</div>
            <div class="text-xl font-bold text-foreground">{{ props.stats?.favorites ?? 0 }}</div>
          </div>
        </div>

        <div class="mt-6 flex gap-3">
          <a href="#" class="btn-accent">Continuer ma lecture</a>
          <a href="/books" class="btn-outline-accent">Explorer la bibliothèque</a>
        </div>
      </div>

      <div class="w-full lg:w-80">
        <div class="rounded-lg p-4 bg-secondary border border-border">
          <div class="text-sm text-muted-foreground mb-2">Statut rapide</div>
          <div class="space-y-3">
            <div class="flex items-center justify-between">
              <div class="text-sm text-foreground">Lecture en cours</div>
              <div class="text-sm font-semibold text-foreground">{{ props.stats?.reading ?? 0 }}</div>
            </div>
            <div class="h-2 bg-muted rounded overflow-hidden">
              <div class="h-2 bg-primary rounded-full" style="width:40%"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
