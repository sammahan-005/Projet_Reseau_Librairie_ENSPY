<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import Heading from '@/components/Heading.vue';
import { edit } from '@/routes/appearance';

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Appearance settings',
                href: edit(),
            },
        ],
    },
});
</script>

<template>
    <Head title="Appearance settings" />

    <h1 class="sr-only">Appearance settings</h1>

    <div class="space-y-6">
        <Heading
            variant="small"
            title="Appearance settings"
            description="Le thème sombre est appliqué par défaut à toute la plateforme."
        />
        <div class="rounded-lg border border-border p-4 bg-card">
            <p class="text-sm text-muted-foreground">Le mode sombre est activé en permanence pour une meilleure expérience de lecture.</p>
        </div>
    </div>
</template>
