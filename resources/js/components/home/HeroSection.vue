<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
</script>

<template>
  <section class="w-full bg-gradient-to-b from-[#071032] to-[#04132a] relative overflow-hidden">
    <div class="absolute inset-0 opacity-30 mix-blend-screen pointer-events-none" aria-hidden>
      <div class="w-full h-full bg-gradient-to-r from-violet-800/20 via-transparent to-indigo-900/20"></div>
    </div>

    <div class="max-w-7xl mx-auto px-6 py-20 lg:py-28">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
        <div class="text-center lg:text-left">
          <span class="inline-block bg-violet-900/30 text-violet-200 text-xs font-semibold px-4 py-1 rounded-full mb-4">Votre bibliothèque numérique</span>

          <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold leading-tight text-white drop-shadow-lg">Accédez à des milliers de livres instantanément</h1>

          <p class="mt-6 text-lg text-violet-100/80 max-w-xl">Parcourez notre catalogue, créez des collections et lisez en streaming sur tous vos appareils. Commencez dès maintenant.</p>

            <div class="mt-8 flex gap-3 justify-center lg:justify-start flex-wrap">
            <Link href="/books" class="btn-accent hover:scale-[1.02] transform transition">Explorer les livres</Link>
            <Link href="/register" class="btn-outline-accent">Créer un compte</Link>
          </div>
        </div>

        <div class="flex justify-center lg:justify-end">
          <div class="relative w-80 h-96 lg:w-[360px] lg:h-[420px]">
            <!-- stack of book covers -->
            <div class="absolute left-0 top-6 transform -rotate-6 shadow-2xl hover:translate-y-[-6px] transition-transform duration-300">
              <div class="w-48 h-64 rounded-lg overflow-hidden bg-gradient-to-br from-indigo-600 to-violet-600 shadow-xl">
                <img src="/images/book-sample-1.jpg" alt="book" class="w-full h-full object-cover" />
              </div>
            </div>

            <div class="absolute left-8 top-0 transform rotate-3 shadow-xl hover:translate-y-[-6px] transition-transform duration-300">
              <div class="w-52 h-72 rounded-lg overflow-hidden bg-gradient-to-br from-blue-700 to-indigo-700 shadow-2xl">
                <img src="/images/book-sample-2.jpg" alt="book" class="w-full h-full object-cover" />
              </div>
            </div>

            <div class="absolute left-20 top-12 transform rotate-0 shadow-lg hover:translate-y-[-6px] transition-transform duration-300">
              <div class="w-56 h-80 rounded-lg overflow-hidden bg-gradient-to-br from-violet-700 to-blue-900 shadow-2xl">
                <img src="/images/book-sample-3.jpg" alt="book" class="w-full h-full object-cover" />
              </div>
            </div>

            <div class="absolute inset-0 rounded-lg pointer-events-none" style="box-shadow: 0 30px 80px rgba(10,8,30,0.6);"></div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
