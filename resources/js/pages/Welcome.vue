<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { dashboard, login, register } from '@/routes';

withDefaults(
    defineProps<{
        canRegister: boolean;
    }>(),
    {
        canRegister: true,
    },
);
</script>

<template>
    <Head title="Welcome">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>

    <div class="flex min-h-screen items-center justify-center bg-background p-6">
        <main class="mx-auto w-full max-w-4xl rounded-lg bg-card p-8 shadow-sm">
            <div class="flex flex-col-reverse gap-6 lg:flex-row lg:items-center">
                <div class="flex-1 text-center lg:text-left">
                    <h1 class="text-2xl font-semibold">Bienvenue à la Librairie ENSPY</h1>
                    <p class="mt-2 text-muted-foreground">Explorez les livres, gérez vos lectures et suivez vos abonnements.</p>

                    <div class="mt-6 flex justify-center gap-3 lg:justify-start">
                        <Link v-if="$page.props.auth.user" :href="dashboard()" class="btn btn-primary">Dashboard</Link>
                        <template v-else>
                            <Link :href="login()" class="btn">Se connecter</Link>
                            <Link v-if="canRegister" :href="register()" class="btn btn-primary">S'inscrire</Link>
                        </template>
                    </div>
                </div>

                <div class="flex-1 flex items-center justify-center">
                    <!-- Simple book illustration -->
                    <svg class="w-40 h-40 text-primary" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3 5a2 2 0 0 1 2-2h11a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H5a2 2 0 0 1-2-2V5z" fill="currentColor" />
                        <path d="M7 6v12" stroke="white" stroke-width="1.2" />
                    </svg>
                </div>
            </div>
        </main>
        <div class="hidden h-14.5 lg:block"></div>
    </div>
</template>
