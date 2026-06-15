<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3';
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import { login } from '@/routes';
import { email } from '@/routes/password';

defineOptions({
    layout: {
        title: 'Forgot password',
        description: 'Enter your email to receive a password reset link',
    },
});

defineProps<{
    status?: string;
}>();
</script>

<template>
    <Head title="Forgot password" />

    <div class="min-h-screen flex items-center justify-center py-12 px-4">
        <div class="w-full max-w-md bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8">

            <div v-if="status" class="mb-4 text-center text-sm font-medium text-green-600">{{ status }}</div>

            <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white mb-6">Mot de passe oublié</h2>

            <Form v-bind="email.form()" v-slot="{ errors, processing }">
                <div class="grid gap-2">
                    <Label for="email">Email</Label>
                    <Input id="email" type="email" name="email" autocomplete="off" autofocus placeholder="email@example.com" />
                    <InputError :message="errors.email" />
                </div>

                <div class="my-6 flex items-center justify-start">
                    <Button class="w-full bg-orange-500 hover:bg-orange-600 dark:bg-purple-500 dark:hover:bg-purple-600 text-white" :disabled="processing" data-test="email-password-reset-link-button">
                        <Spinner v-if="processing" />
                        Envoyer le lien de réinitialisation
                    </Button>
                </div>
            </Form>

            <div class="space-x-1 text-center text-sm text-muted-foreground">
                <span>Ou, revenir à</span>
                <TextLink :href="login()" class="text-orange-500 dark:text-purple-400">se connecter</TextLink>
            </div>
        </div>
    </div>
</template>
