<template>
  <div class="home">

    <!-- Section 1 : Navbar -->
    <Navbar />

    <!-- Section 2 : Texte + Image -->
    <section class="hero">
      <div class="hero-content">
        <div class="text">
          <h1>Bienvenue sur notre site</h1>
          <p>
            Découvrez nos services et profitez d'une expérience unique.
            Nous mettons à votre disposition des solutions adaptées à vos besoins.
          </p>
        </div>
        <div class="image">
          <img src="@/assets/livre.jpeg" alt="Livre Image" />
        </div>
      </div>
    </section>

    <!-- Section 3 : Grille de cartes -->
    <section class="cards">
      <h2>Nos services</h2>
      <div class="card-grid">
        <Card 
          v-for="(item, index) in cards" 
          :key="index"
          :title="item.title"
          :description="item.description"
          :image="item.image"
        />
      </div>
    </section>

    <!-- Section 4 : Footer -->
    <Footer />

  </div>
</template>

<script setup>
import Navbar from '@/components/Navbar.vue'
import Card from '@/components/ui/card/Card.vue'
import Footer from '@/components/Footer.vue'

const cards = [
  {
    title: "Service 1",
    description: "Description du service 1",
    image: "@/assets/livre.jpeg"
  },
  {
    title: "Service 2",
    description: "Description du service 2",
    image: "@/assets/livre.jpeg"
  },
  {
    title: "Service 3",
    description: "Description du service 3",
    image: "@/assets/livre.jpeg"
  },
  {
    title: "Service 4",
    description: "Description du service 4",
    image: "@/assets/livre.jpeg"
  }
]
</script>

<style scoped>
.home {
  display: flex;
  flex-direction: column;
}

/* Section 2 */
.hero {
  padding: 50px;
  background: #f5f5f5;
}

.hero-content {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 30px;
}

.text {
  flex: 1;
}

.image {
  flex: 1;
}

.image img {
  width: 100%;
  border-radius: 10px;
}

/* Section 3 */
.cards {
  padding: 50px;
}

.cards h2 {
  text-align: center;
  margin-bottom: 30px;
}

.card-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 20px;
}
</style>