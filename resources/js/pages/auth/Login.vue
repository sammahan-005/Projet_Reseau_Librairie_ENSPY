<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3';
import InputError from '@/components/InputError.vue';
import PasswordInput from '@/components/PasswordInput.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import { register } from '@/routes';
import { store } from '@/routes/login';
import { request } from '@/routes/password';

defineOptions({
    layout: {
        title: 'Se connecter',
        description: 'Entrez votre email et mot de passe pour vous connecter',
    },
});

defineProps<{
    status?: string;
    canResetPassword: boolean;
    canRegister: boolean;
}>();
</script>

<template>
    <Head title="Se connecter" />

    <div class="min-h-screen flex items-center justify-center py-12 px-4">
        <div class="w-full max-w-md bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8">

            <div v-if="status" class="mb-4 text-center text-sm font-medium text-green-600">{{ status }}</div>

            <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white mb-6">Se connecter</h2>

            <Form
                v-bind="store.form()"
                :reset-on-success="['password']"
                v-slot="{ errors, processing }"
                class="flex flex-col gap-6"
            >
                <div class="grid gap-6">
                    <div class="grid gap-2">
                        <Label for="email">Email</Label>
                        <Input id="email" type="email" name="email" required autofocus :tabindex="1" autocomplete="email" placeholder="email@example.com" />
                        <InputError :message="errors.email" />
                    </div>

                    <div class="grid gap-2">
                        <div class="flex items-center justify-between">
                            <Label for="password">Mot de passe</Label>
                            <TextLink v-if="canResetPassword" :href="request()" class="text-sm" :tabindex="5">Mot de passe oublié ?</TextLink>
                        </div>
                        <PasswordInput id="password" name="password" required :tabindex="2" autocomplete="current-password" placeholder="Mot de passe" />
                        <InputError :message="errors.password" />
                    </div>

                    <div class="flex items-center justify-between">
                        <Label for="remember" class="flex items-center space-x-3">
                            <Checkbox id="remember" name="remember" :tabindex="3" />
                            <span>Se souvenir de moi</span>
                        </Label>
                    </div>

                    <Button type="submit" class="mt-4 w-full bg-orange-500 hover:bg-orange-600 dark:bg-purple-500 dark:hover:bg-purple-600 text-white" :tabindex="4" :disabled="processing" data-test="login-button">
                        <Spinner v-if="processing" />
                        Se connecter
                    </Button>
                </div>

                <div class="text-center text-sm text-muted-foreground" v-if="canRegister">
                    Vous n'avez pas de compte ?
                    <TextLink :href="register()" :tabindex="5" class="text-orange-500 dark:text-purple-400">Créer un compte</TextLink>
                </div>
            </Form>
        </div>
    </div>
</template>
