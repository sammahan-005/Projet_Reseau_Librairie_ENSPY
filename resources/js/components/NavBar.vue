<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { Link } from '@inertiajs/vue3';

const theme = ref(localStorage.getItem('theme') || (document.documentElement.classList.contains('dark') ? 'dark' : 'light'));
const locale = ref(localStorage.getItem('locale') || 'fr');

function setTheme(t: string) {
  theme.value = t;
  if (t === 'dark') {
    document.documentElement.classList.add('dark');
    document.documentElement.classList.remove('light-orange');
  } else if (t === 'light-orange') {
    document.documentElement.classList.remove('dark');
    document.documentElement.classList.add('light-orange');
  } else {
    document.documentElement.classList.remove('dark');
    document.documentElement.classList.remove('light-orange');
  }
  localStorage.setItem('theme', t);
}

function toggleTheme() {
  if (theme.value === 'dark') setTheme('light-orange');
  else setTheme('dark');
}

function setLocale(l: string) {
  locale.value = l;
  localStorage.setItem('locale', l);
  // simple page reload to apply locale server-side or by other logic
  window.location.reload();
}

onMounted(() => {
  setTheme(theme.value);
});
</script>

<template>
  <nav class="w-full bg-transparent py-4">
    <div class="max-w-7xl mx-auto px-6 flex items-center justify-between gap-4">
      <div class="flex items-center gap-4">
        <Link href="/" class="text-xl font-bold text-white">Librairie ENSPY</Link>
        <Link href="/books" class="text-sm text-white/80 hover:text-white">Livres</Link>
        <Link href="/about" class="text-sm text-white/80 hover:text-white">À propos</Link>
      </div>

      <div class="flex items-center gap-3">
        <select v-model="locale" @change="setLocale(locale)" class="bg-transparent border border-white/10 text-white rounded px-2 py-1 text-sm">
          <option value="fr">FR</option>
          <option value="en">EN</option>
        </select>

        <button @click="toggleTheme" class="px-3 py-1 rounded bg-white/10 text-white text-sm">Theme</button>

        <Link href="/login" class="px-3 py-1 rounded bg-violet-600 text-white text-sm">Se connecter</Link>
      </div>
    </div>
  </nav>
</template>
