<script setup lang="ts">
import { ref } from 'vue';
const tabs = ['Tous les livres','En cours','À lire','Terminés','Favoris','Téléchargés'];
const active = ref(tabs[0]);
</script>

<template>
  <div class="rounded-xl bg-[#08152F] p-2">
    <div class="flex gap-2 overflow-auto">
      <button v-for="t in tabs" :key="t" @click="active = t" :class="['px-4 py-2 rounded-lg transition', active===t? 'bg-[linear-gradient(90deg,#8B3DFF,#A855F7)] text-white':'text-violet-200/70']">{{ t }}</button>
    </div>
  </div>
</template>
