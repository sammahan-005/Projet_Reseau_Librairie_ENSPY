<template>
  <footer class="footer">
    
    <div class="footer-container">

      <!-- Colonne 1 -->
      <div class="column">
        <h3>MonSite</h3>
        <p>Une solution simple pour vos besoins digitaux.</p>
      </div>

      <!-- Colonne 2 -->
      <div class="column">
        <h4>Liens</h4>
        <ul>
          <li><a href="/">Accueil</a></li>
          <li><a href="/about">À propos</a></li>
          <li><a href="/services">Services</a></li>
        </ul>
      </div>

      <!-- Colonne 3 -->
      <div class="column">
        <h4>Support</h4>
        <ul>
          <li><a href="/contact">Contact</a></li>
          <li><a href="#">FAQ</a></li>
          <li><a href="#">Aide</a></li>
        </ul>
      </div>

      <!-- Colonne 4 -->
      <div class="column">
        <h4>Suivez-nous</h4>
        <ul>
          <li><a href="#">Facebook</a></li>
          <li><a href="#">Twitter</a></li>
          <li><a href="#">Instagram</a></li>
        </ul>
      </div>

    </div>

    <!-- Bas du footer -->
    <div class="footer-bottom">
      <p>© 2026 MonSite. Tous droits réservés.</p>
    </div>

  </footer>
</template>

<script setup>
</script>

<style scoped>
.footer {
  background-color: #111;
  color: #fff;
  padding: 40px 20px 20px;
}

/* Conteneur principal */
.footer-container {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 20px;
}

/* Colonnes */
.column h3,
.column h4 {
  margin-bottom: 10px;
}

.column p {
  font-size: 14px;
  color: #ccc;
}

.column ul {
  list-style: none;
  padding: 0;
}

.column ul li {
  margin-bottom: 8px;
}

.column a {
  text-decoration: none;
  color: #ccc;
  font-size: 14px;
}

.column a:hover {
  color: #42b983;
}

/* Bas */
.footer-bottom {
  text-align: center;
  margin-top: 30px;
  border-top: 1px solid #333;
  padding-top: 15px;
  font-size: 13px;
  color: #aaa;
}

/* Responsive */
@media (max-width: 768px) {
  .footer-container {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (max-width: 480px) {
  .footer-container {
    grid-template-columns: 1fr;
    text-align: center;
  }
}
</style>