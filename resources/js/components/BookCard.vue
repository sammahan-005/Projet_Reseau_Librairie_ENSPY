<script setup lang="ts">

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
    <div class="relative rounded-xl overflow-hidden cursor-pointer group shadow-md hover:shadow-xl transition-shadow duration-300">

        <div class="aspect-[3/4] w-full relative overflow-hidden">

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

                <!-- Icône cadenas SVG centrée -->
                <div class="flex justify-center items-center flex-1">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-12 h-12 text-white/70"
                        viewBox="0 0 24 24"
                        fill="currentColor"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M12 1.5a5.25 5.25 0 0 0-5.25 5.25v3a3 3 0 0 0-3 3v6.75a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3v-6.75a3 3 0 0 0-3-3v-3c0-2.9-2.35-5.25-5.25-5.25Zm3.75 8.25v-3a3.75 3.75 0 1 0-7.5 0v3h7.5Z"
                            clip-rule="evenodd"
                        />
                    </svg>
                </div>

            </div>

            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-all duration-300"></div>

        </div>

        <!-- Bandeau bas -->
        <div class="absolute bottom-0 left-0 right-0 bg-orange-500/90 dark:bg-purple-700/90 text-white text-xs py-2 px-3 flex items-center gap-2">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="w-3 h-3 shrink-0"
                viewBox="0 0 24 24"
                fill="currentColor"
            >
                <path
                    fill-rule="evenodd"
                    d="M12 1.5a5.25 5.25 0 0 0-5.25 5.25v3a3 3 0 0 0-3 3v6.75a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3v-6.75a3 3 0 0 0-3-3v-3c0-2.9-2.35-5.25-5.25-5.25Zm3.75 8.25v-3a3.75 3.75 0 1 0-7.5 0v3h7.5Z"
                    clip-rule="evenodd"
                />
            </svg>
            <span>Connectez-vous pour voir l'aperçu.</span>
        </div>

    </div>
</template>