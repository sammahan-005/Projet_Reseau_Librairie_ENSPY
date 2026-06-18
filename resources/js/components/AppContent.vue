<script setup lang="ts">
import { computed } from 'vue';
import { SidebarInset } from '@/components/ui/sidebar';
import type { AppVariant } from '@/types';

type Props = {
    variant?: AppVariant;
    class?: string;
};

const props = withDefaults(defineProps<Props>(), {
    variant: 'sidebar',
});
const className = computed(() => props.class);

const componentToRender = computed(() => props.variant === 'sidebar' ? SidebarInset : 'main');
const componentClass = computed(() => props.variant === 'sidebar' 
    ? className.value 
    : `mx-auto flex h-full w-full max-w-7xl flex-1 flex-col gap-4 rounded-xl ${className.value || ''}`);
</script>

<template>
    <component :is="componentToRender" :class="componentClass">
        <slot />
    </component>
</template>
