<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3';
import AuthShell from '@/components/auth/AuthShell.vue';
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

defineProps<{
    status?: string;
    canResetPassword: boolean;
    canRegister: boolean;
}>();
</script>

<template>
    <Head title="Se connecter" />

    <AuthShell
        title="Se connecter"
        description="Entrez vos identifiants pour retrouver votre espace personnel."
        mode="login"
    >
        <div v-if="status" class="mb-4 rounded-md border border-emerald-500/30 bg-emerald-500/10 px-4 py-3 text-sm font-medium text-emerald-600 dark:text-emerald-300">{{ status }}</div>

        <Form
            v-bind="store.form()"
            :reset-on-success="['password']"
            v-slot="{ errors, processing }"
            class="flex flex-col gap-6"
        >
            <div class="grid gap-5">
                <div class="grid gap-2">
                    <Label for="email" class="text-[var(--foreground)]">Email</Label>
                    <Input id="email" type="email" name="email" required autofocus :tabindex="1" autocomplete="email" placeholder="email@example.com" class="auth-input" />
                    <InputError :message="errors.email" />
                </div>

                <div class="grid gap-2">
                    <div class="flex items-center justify-between gap-3">
                        <Label for="password" class="text-[var(--foreground)]">Mot de passe</Label>
                        <TextLink v-if="canResetPassword" :href="request()" class="text-sm text-[var(--brand)]" :tabindex="5">Mot de passe oublié ?</TextLink>
                    </div>
                    <PasswordInput id="password" name="password" required :tabindex="2" autocomplete="current-password" placeholder="Mot de passe" class="auth-input" />
                    <InputError :message="errors.password" />
                </div>

                <div class="flex items-center justify-between">
                    <Label for="remember" class="flex items-center space-x-3 text-[var(--auth-muted)]">
                        <Checkbox id="remember" name="remember" :tabindex="3" />
                        <span>Se souvenir de moi</span>
                    </Label>
                </div>

                <Button type="submit" class="mt-2 w-full bg-[var(--brand)] text-white hover:bg-[var(--brand-strong)]" :tabindex="4" :disabled="processing" data-test="login-button">
                    <Spinner v-if="processing" />
                    Se connecter
                </Button>
            </div>

            <div class="text-center text-sm text-[var(--auth-muted)]" v-if="canRegister">
                Vous n'avez pas de compte ?
                <TextLink :href="register()" :tabindex="5" class="font-semibold text-[var(--brand)]">Créer un compte</TextLink>
            </div>
        </Form>
    </AuthShell>
</template>
