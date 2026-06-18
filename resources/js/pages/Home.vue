<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import { updateTheme } from '@/composables/useAppearance';
import AppLayout from '@/layouts/AppLayout.vue';
import HeroSection from '@/components/home/HeroSection.vue';
import CategoriesSection from '@/components/home/CategoriesSection.vue';
import PopularBooksSection from '@/components/home/PopularBooksSection.vue';
import NewCarousel from '@/components/home/NewCarousel.vue';
import WhyChoose from '@/components/home/WhyChoose.vue';
import StatsSection from '@/components/home/StatsSection.vue';
import FinalCTA from '@/components/home/FinalCTA.vue';

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

onMounted(() => {
    updateTheme('dark');
});
</script>

<template>
    <AppLayout>
        <Head title="Accueil" />
        
        <HeroSection />

        <main class="mx-auto max-w-7xl px-6">
            <CategoriesSection />

            <PopularBooksSection :books="books" />

            <NewCarousel :items="books.slice(0, 8)" />

            <WhyChoose />

            <StatsSection />

            <FinalCTA />
        </main>
    </AppLayout>
</template>