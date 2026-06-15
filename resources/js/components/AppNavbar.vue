<template>
  <nav class="navbar">
    <!-- Logo (gauche) -->
    <div class="logo">
      <img src="@/assets/livre.jpeg" alt="Logo" />
      <span class="ml-2 font-semibold">Librairie ENSPY</span>
    </div>

    <!-- Partie droite -->
    <div class="nav-right">
      <!-- Liens -->
      <ul class="links">
        <li><a href="/">Accueil</a></li>
        <li><a href="/books">Livres</a></li>
        <li><a href="/about">À propos</a></li>
      </ul>

      <!-- Langue -->
      <select v-model="currentLang" @change="setLocale(currentLang)" class="px-2 py-1 rounded bg-transparent border border-white/10 text-white">
        <option value="fr">FR</option>
        <option value="en">EN</option>
      </select>

      <!-- Theme selector (dark / light-orange) -->
      <button class="btn" @click="toggleTheme">{{ themeLabel }}</button>

      <a href="/login" class="btn login">Se connecter</a>
    </div>
  </nav>
</template>

<script setup lang="ts">
import { ref, onMounted, computed } from 'vue'

const currentLang = ref(localStorage.getItem('locale') || 'fr')
const theme = ref(localStorage.getItem('theme') || (document.documentElement.classList.contains('dark') ? 'dark' : 'light'))

function setLocale(val: string) {
  localStorage.setItem('locale', val)
  window.location.reload()
}

function applyTheme(t: string) {
  if (t === 'dark') {
    document.documentElement.classList.add('dark')
    document.documentElement.classList.remove('light-orange')
  } else if (t === 'light-orange') {
    document.documentElement.classList.remove('dark')
    document.documentElement.classList.add('light-orange')
  } else {
    document.documentElement.classList.remove('dark')
    document.documentElement.classList.remove('light-orange')
  }
}

function toggleTheme() {
  if (theme.value === 'dark') theme.value = 'light-orange'
  else theme.value = (theme.value === 'light-orange') ? 'light' : 'dark'
  localStorage.setItem('theme', theme.value)
  applyTheme(theme.value)
}

const themeLabel = computed(() => theme.value === 'dark' ? 'Dark' : (theme.value === 'light-orange' ? 'Light-Orange' : 'Light'))

onMounted(() => {
  applyTheme(theme.value)
})
</script>

<style scoped>
.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 12px 20px;
  background: transparent;
}

.logo { display:flex; align-items:center }
.logo img { width:40px; height:40px; object-fit:cover; border-radius:6px }

.nav-right { display:flex; align-items:center; gap:12px }
.links { display:flex; gap:16px; list-style:none; margin:0; padding:0 }
.links a { color:inherit; text-decoration:none; opacity:0.9 }

.btn { padding:6px 10px; border-radius:6px; background:rgba(255,255,255,0.08); color:var(--foreground); border:1px solid rgba(255,255,255,0.06) }
.btn.login { background:linear-gradient(90deg,#7c3aed,#4f46e5); color:white }
</style>
