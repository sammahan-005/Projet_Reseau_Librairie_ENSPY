import type { ComputedRef, Ref } from 'vue';
import { computed, onMounted, ref } from 'vue';
import type { Appearance, ResolvedAppearance } from '@/types';

export type { Appearance, ResolvedAppearance };

export type UseAppearanceReturn = {
    appearance: Ref<Appearance>;
    resolvedAppearance: ComputedRef<ResolvedAppearance>;
    updateAppearance: (value: Appearance) => void;
};

export function updateTheme(value: Appearance): void {
    if (typeof window === 'undefined') {
        return;
    }

    const applyResolvedTheme = (theme: ResolvedAppearance) => {
        document.documentElement.classList.add('dark');
        document.documentElement.classList.remove('light-orange');
        localStorage.setItem('theme', 'dark');
        localStorage.setItem('appearance', 'dark');
    };

    applyResolvedTheme('dark');
}

const setCookie = (name: string, value: string, days = 365) => {
    if (typeof document === 'undefined') {
        return;
    }

    const maxAge = days * 24 * 60 * 60;

    document.cookie = `${name}=${value};path=/;max-age=${maxAge};SameSite=Lax`;
};

const mediaQuery = () => {
    return null;
};

const getStoredAppearance = () => {
    return 'dark';
};

const prefersDark = (): boolean => {
    return true;
};

const handleSystemThemeChange = () => {
    updateTheme('dark');
};

export function initializeTheme(): void {
    if (typeof window === 'undefined') {
        return;
    }

    updateTheme('dark');
}

const appearance = ref<Appearance>('dark');

export function useAppearance(): UseAppearanceReturn {
    onMounted(() => {
        appearance.value = 'dark';
    });

    const resolvedAppearance = computed<ResolvedAppearance>(() => 'dark');

    function updateAppearance(value: Appearance) {
        appearance.value = 'dark';
        localStorage.setItem('appearance', 'dark');
        setCookie('appearance', 'dark');
        updateTheme('dark');
    }

    return {
        appearance,
        resolvedAppearance,
        updateAppearance,
    };
}
