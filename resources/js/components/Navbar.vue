<template>
  <nav class="navbar">
    
    <!-- Logo (gauche) -->
    <div class="logo">
      <img src="@/assets/livre.jpeg" alt="Logo" />
      <span>MonSite</span>
    </div>

    <!-- Partie droite -->
    <div class="nav-right">
      
      <!-- Liens -->
      <ul class="links">
        <li><a href="/">Accueil</a></li>
        <li><a href="/about">À propos</a></li>
        <li><a href="/services">Services</a></li>
        <li><a href="/contact">Contact</a></li>
      </ul>

      <!-- Langue -->
      <button class="btn" @click="toggleLanguage">
        {{ currentLang }}
      </button>

      <!-- Dark / Light -->
      <button class="btn" @click="toggleTheme">
        {{ isDark ? '🌙' : '☀️' }}
      </button>

    </div>

  </nav>
</template>

<script setup>
import { ref, onMounted } from 'vue'

const currentLang = ref('FR')
const isDark = ref(false)

const toggleLanguage = () => {
  currentLang.value = currentLang.value === 'FR' ? 'EN' : 'FR'
}

const toggleTheme = () => {
  isDark.value = !isDark.value
  document.documentElement.classList.toggle('dark')
}

// Charger le thème sauvegardé
onMounted(() => {
  const savedTheme = localStorage.getItem('theme')
  if (savedTheme === 'dark') {
    isDark.value = true
    document.documentElement.classList.add('dark')
  }
})

// Sauvegarde du thème
watch(isDark, (val) => {
  localStorage.setItem('theme', val ? 'dark' : 'light')
})
</script>

<style scoped>
.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 15px 30px;
  background-color: var(--bg-color, #fff);
  color: var(--text-color, #000);
  border-bottom: 1px solid #ddd;
}

/* Logo */
.logo {
  display: flex;
  align-items: center;
  gap: 10px;
}

.logo img {
  width: 40px;
}

/* Partie droite */
.nav-right {
  display: flex;
  align-items: center;
  gap: 20px;
}

/* Liens */
.links {
  display: flex;
  list-style: none;
  gap: 20px;
}

.links a {
  text-decoration: none;
  color: inherit;
  font-weight: 500;
}

.links a:hover {
  color: #42b983;
}

/* Boutons */
.btn {
  padding: 6px 12px;
  border: none;
  cursor: pointer;
  background: #42b983;
  color: white;
  border-radius: 5px;
}

/* Dark mode */
.dark {
  --bg-color: #121212;
  --text-color: #ffffff;
}
</style>