<script setup lang="ts">

import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import BookCard from '@/components/BookCard.vue';
import AppNavbar from '@/components/AppNavbar.vue';
import HeroSection from '@/components/home/HeroSection.vue';
import CategoriesSection from '@/components/home/CategoriesSection.vue';
import PopularBooksSection from '@/components/home/PopularBooksSection.vue';
import NewCarousel from '@/components/home/NewCarousel.vue';
import WhyChoose from '@/components/home/WhyChoose.vue';
import StatsSection from '@/components/home/StatsSection.vue';
import FinalCTA from '@/components/home/FinalCTA.vue';
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

    <div class="min-h-screen bg-[#041328] text-white">
    <AppNavbar />
        <HeroSection />

        <main class="max-w-7xl mx-auto px-6">
            <CategoriesSection />

            <PopularBooksSection :books="books" />

            <NewCarousel :items="books.slice(0, 8)" />

            <WhyChoose />

            <StatsSection />

            <FinalCTA />
        </main>
    </div>
</template>