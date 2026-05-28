<script setup lang="ts">

import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import BookCard from '@/components/BookCard.vue';
// import { login, register } from '@/routes';

interface Book {
    id: number;
    title: string;
    author: string;
    genre: string;
    cover_image: string | null;
}

defineProps<{
    books: Book[];
}>();

const isDark = ref(document.documentElement.classList.contains('dark'));

function toggleDark(): void {
    isDark.value = !isDark.value;
    document.documentElement.classList.toggle('dark', isDark.value);
    localStorage.setItem('theme', isDark.value ? 'dark' : 'light');
}

</script>

<template>
    <Head title="Booksly - Accueil" />

    <div class="min-h-screen bg-white dark:bg-gray-950 text-gray-900 dark:text-white">

        <!-- NAVBAR -->
		<nav class="flex items-center justify-between px-8 py-4 border-b border-gray-100 dark:border-gray-800">

			<div class="flex items-center gap-2 font-bold text-xl text-orange-500 dark:text-purple-400">
				Booksly
			</div>

			<div class="hidden md:flex items-center gap-8 text-sm font-medium text-gray-600 dark:text-gray-300">
				<a href="#" class="hover:text-orange-500 dark:hover:text-purple-400 transition-colors">Nos Offres</a>
				<a href="#" class="hover:text-orange-500 dark:hover:text-purple-400 transition-colors">Catégories</a>
				<a href="#" class="hover:text-orange-500 dark:hover:text-purple-400 transition-colors">FAQ</a>
			</div>

			<div class="flex items-center gap-3">

				<!-- Bouton dark mode -->
				<button
					@click="toggleDark"
					class="w-9 h-9 flex items-center justify-center rounded-full border border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors"
					:title="isDark ? 'Passer en mode clair' : 'Passer en mode sombre'"
				>
					<!-- Icône soleil (mode clair) -->
					<svg
						v-if="isDark"
						xmlns="http://www.w3.org/2000/svg"
						class="w-5 h-5"
						viewBox="0 0 24 24"
						fill="currentColor"
					>
						<path d="M12 2.25a.75.75 0 0 1 .75.75v2.25a.75.75 0 0 1-1.5 0V3a.75.75 0 0 1 .75-.75ZM7.5 12a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM18.894 6.166a.75.75 0 0 0-1.06-1.06l-1.591 1.59a.75.75 0 1 0 1.06 1.061l1.591-1.59ZM21.75 12a.75.75 0 0 1-.75.75h-2.25a.75.75 0 0 1 0-1.5H21a.75.75 0 0 1 .75.75ZM17.834 18.894a.75.75 0 0 0 1.06-1.06l-1.59-1.591a.75.75 0 1 0-1.061 1.06l1.59 1.591ZM12 18a.75.75 0 0 1 .75.75V21a.75.75 0 0 1-1.5 0v-2.25A.75.75 0 0 1 12 18ZM7.758 17.303a.75.75 0 0 0-1.061-1.06l-1.591 1.59a.75.75 0 0 0 1.06 1.061l1.591-1.59ZM6 12a.75.75 0 0 1-.75.75H3a.75.75 0 0 1 0-1.5h2.25A.75.75 0 0 1 6 12ZM6.697 7.757a.75.75 0 0 0 1.06-1.06l-1.59-1.591a.75.75 0 0 0-1.061 1.06l1.59 1.591Z" />
					</svg>

					<!-- Icône lune (mode sombre) -->
					<svg
						v-else
						xmlns="http://www.w3.org/2000/svg"
						class="w-5 h-5"
						viewBox="0 0 24 24"
						fill="currentColor"
					>
						<path fill-rule="evenodd" d="M9.528 1.718a.75.75 0 0 1 .162.819A8.97 8.97 0 0 0 9 6a9 9 0 0 0 9 9 8.97 8.97 0 0 0 3.463-.69.75.75 0 0 1 .981.98 10.503 10.503 0 0 1-9.694 6.46c-5.799 0-10.5-4.7-10.5-10.5 0-4.368 2.667-8.112 6.46-9.694a.75.75 0 0 1 .818.162Z" clip-rule="evenodd" />
					</svg>
				</button>

				<Link
					href="/login"
					class="px-5 py-2 rounded-full border-2 border-orange-500 dark:border-purple-400 text-orange-500 dark:text-purple-400 text-sm font-semibold hover:bg-orange-500 hover:text-white dark:hover:bg-purple-400 dark:hover:text-gray-950 transition-all"
				>
					Se Connecter
				</Link>

			</div>

		</nav>

        <!-- ========== HERO ========== -->
        <section class="flex flex-col md:flex-row items-center justify-between px-8 md:px-16 py-16 gap-10">

            <!-- Texte gauche -->
            <div class="flex-1 max-w-lg">
                <span class="inline-block bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300 text-xs font-semibold px-4 py-1 rounded-full mb-4">
                    Votre Bibliothèque en Ligne
                </span>

                <h1 class="text-4xl md:text-5xl font-extrabold leading-tight mb-6 text-gray-900 dark:text-white">
                    Accédez à des milliers de livres instantanément.
                </h1>

                <div class="flex gap-4 flex-wrap">
                    <Link
                        href="#"
                        class="px-6 py-3 rounded-full bg-orange-500 dark:bg-purple-500 text-white font-semibold hover:bg-orange-600 dark:hover:bg-purple-600 transition-colors"
                    >
                        Explorer les Forfaits
                    </Link>
                    <Link
                        href="/register"
                        class="px-6 py-3 rounded-full border-2 border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 font-semibold hover:border-orange-500 dark:hover:border-purple-400 transition-colors"
                    >
                        Créer un Compte Gratuit
                    </Link>
                </div>
            </div>

            <!-- Illustration droite -->
            <div class="flex-1 flex justify-center">
                <div class="w-64 h-64 md:w-80 md:h-80 rounded-full bg-orange-50 dark:bg-gray-800 flex items-center justify-center text-9xl">
                    📚
                </div>
            </div>

        </section>

        <!-- ========== SÉLECTION DU MOMENT ========== -->
        <section class="px-8 md:px-16 py-12 bg-gray-50 dark:bg-gray-900">

            <h2 class="text-2xl font-bold text-center mb-10 text-gray-900 dark:text-white">
                Sélection du Moment
            </h2>

            <!-- Grille de livres -->
            <div
                v-if="books && books.length"
                class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6"
            >
                <BookCard
                    v-for="book in books"
                    :key="book.id"
                    :book="book"
                />
            </div>

            <!-- Aucun livre -->
            <div v-else class="text-center text-gray-500 dark:text-gray-400 py-10">
                Aucun livre disponible pour le moment.
            </div>

        </section>

    </div>
</template>