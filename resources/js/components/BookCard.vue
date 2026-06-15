<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

interface Book {
    id: number;
    title: string;
    author: string;
    genre: string;
    cover_image: string | null;
}

defineProps<{
    book: Book;
}>();

function genreColor(genre: string): string {
    const colors: Record<string, string> = {
        'roman':           'from-blue-600 to-blue-900',
        'poême':           'from-pink-500 to-rose-700',
        'théâtre':         'from-yellow-500 to-orange-700',
        'science-fiction': 'from-cyan-500 to-indigo-800',
        'roman-policier':  'from-gray-600 to-gray-900',
        'bande-dessinée':  'from-green-500 to-teal-700',
    };

    return colors[genre] ?? 'from-purple-500 to-indigo-700';
}

</script>

<template>
    <div class="relative rounded-xl overflow-hidden cursor-pointer group shadow-lg hover:shadow-2xl transition-shadow duration-300">

    <Link :href="$page.props.auth.user ? `/books/${book.id}` : '/login'" class="block">
            <div class="aspect-[3/4] w-full relative overflow-hidden rounded-t-lg">

            <img
                v-if="book.cover_image"
                :src="`/storage/${book.cover_image}`"
                :alt="book.title"
                class="w-full h-full object-cover"
            />

            <div
                v-else
                class="w-full h-full flex flex-col justify-between p-4 bg-gradient-to-br"
                :class="genreColor(book.genre)"
            >
                <!-- Titre du livre -->
                <span class="text-white font-bold text-sm leading-tight drop-shadow">
                    {{ book.title }}
                </span>

                <!-- Icône livre SVG centrée -->
                <div class="flex justify-center items-center flex-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-white/80" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M3 5a2 2 0 0 1 2-2h11a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H5a2 2 0 0 1-2-2V5z" />
                    </svg>
                </div>

            </div>

            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-all duration-300"></div>

            </div>
        </Link>

        <!-- Bandeau bas -->
        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-r from-violet-600 to-indigo-700 text-white text-xs py-2 px-3 flex items-center gap-2 rounded-b-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 shrink-0" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 2a7 7 0 0 0-7 7v3H4a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2h-1V9a7 7 0 0 0-7-7z" />
            </svg>
            <span>Connectez-vous pour accéder au contenu</span>
        </div>

    </div>
</template>