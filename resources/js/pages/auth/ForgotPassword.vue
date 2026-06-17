<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3';
import AuthShell from '@/components/auth/AuthShell.vue';
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import { login } from '@/routes';
import { email } from '@/routes/password';

defineProps<{
    status?: string;
}>();
</script>

<template>
    <Head title="Mot de passe oublié" />

    <AuthShell
        title="Mot de passe oublié"
        description="Indiquez votre email pour recevoir un lien de réinitialisation."
        mode="forgot"
    >
        <div v-if="status" class="mb-4 rounded-md border border-emerald-500/30 bg-emerald-500/10 px-4 py-3 text-sm font-medium text-emerald-600 dark:text-emerald-300">{{ status }}</div>

        <Form v-bind="email.form()" v-slot="{ errors, processing }">
            <div class="grid gap-2">
                <Label for="email" class="text-[var(--foreground)]">Email</Label>
                <Input id="email" type="email" name="email" autocomplete="off" autofocus placeholder="email@example.com" class="auth-input" />
                <InputError :message="errors.email" />
            </div>

            <div class="my-6 flex items-center justify-start">
                <Button class="w-full bg-[var(--brand)] text-white hover:bg-[var(--brand-strong)]" :disabled="processing" data-test="email-password-reset-link-button">
                    <Spinner v-if="processing" />
                    Envoyer le lien de réinitialisation
                </Button>
            </div>
        </Form>

        <div class="space-x-1 text-center text-sm text-[var(--auth-muted)]">
            <span>Ou, revenir à</span>
            <TextLink :href="login()" class="font-semibold text-[var(--brand)]">se connecter</TextLink>
        </div>
    </AuthShell>
</template>
