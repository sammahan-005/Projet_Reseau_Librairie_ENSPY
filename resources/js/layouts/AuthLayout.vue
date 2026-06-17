<script setup lang="ts">
import AuthShell from '@/components/auth/AuthShell.vue';

const { title = 'Accès sécurisé', description = 'Confirmez votre identité pour continuer.' } = defineProps<{
    title?: string;
    description?: string;
}>();
</script>

<template>
    <AuthShell :title="title" :description="description" mode="forgot">
        <slot />
    </AuthShell>
</template>
