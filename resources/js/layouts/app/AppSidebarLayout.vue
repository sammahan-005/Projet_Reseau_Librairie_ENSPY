<script setup lang="ts">
import { usePage } from '@inertiajs/vue3';
import { onMounted, watch } from 'vue';
import { useReadingTimer } from '@/composables/useReadingTimer';
import AppContent from '@/components/AppContent.vue';
import AppShell from '@/components/AppShell.vue';
import AppSidebar from '@/components/AppSidebar.vue';
import AppSidebarHeader from '@/components/AppSidebarHeader.vue';
import type { BreadcrumbItem } from '@/types';

type Props = {
    breadcrumbs?: BreadcrumbItem[];
};

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});

// Detect current Inertia page component to hide the sidebar on specific pages (Home)
const page = usePage();
const pageComponent = page.component as string;

// Initialize global reading timer
const { initTimer, resetTimer } = useReadingTimer();

onMounted(() => {
    const subscription = (page.props.auth as any)?.subscription;
    if (subscription) {
        initTimer({
            remaining_seconds: subscription.remaining_seconds,
            pivot_id: subscription.pivot_id,
            type: subscription.type,
            daily_minutes: subscription.duration
        });
    }
});

watch(() => (page.props.auth as any)?.user, (newUser) => {
    if (!newUser) {
        resetTimer();
    }
});

watch(() => (page.props.auth as any)?.subscription, (newSub) => {
    if (newSub) {
        initTimer({
            remaining_seconds: newSub.remaining_seconds,
            pivot_id: newSub.pivot_id,
            type: newSub.type,
            daily_minutes: newSub.duration
        });
    }
}, { deep: true });
</script>

<template>
    <AppShell variant="sidebar">
        <!-- Hide the sidebar on the Home page to match user's request -->
        <AppSidebar v-if="pageComponent !== 'Home'" />
        <AppContent variant="sidebar" class="overflow-x-hidden">
            <AppSidebarHeader :breadcrumbs="breadcrumbs" />
            <slot />
        </AppContent>
    </AppShell>
</template>
