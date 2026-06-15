<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3';
import InputError from '@/components/InputError.vue';
import PasswordInput from '@/components/PasswordInput.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import { login } from '@/routes';
import { store } from '@/routes/register';

defineOptions({
    layout: {
        title: 'Create an account',
        description: 'Enter your details below to create your account',
    },
});
</script>

<template>
    <Head title="Register" />

    <div class="min-h-screen flex items-center justify-center py-12 px-4">
        <div class="w-full max-w-md bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8">

            <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white mb-6">Créer un compte</h2>

            <Form
                v-bind="store.form()"
                :reset-on-success="['password', 'password_confirmation']"
                v-slot="{ errors, processing }"
                class="flex flex-col gap-6"
            >
                <div class="grid gap-6">
                    <div class="grid gap-2">
                        <Label for="name">Nom</Label>
                        <Input
                            id="name"
                            type="text"
                            required
                            autofocus
                            :tabindex="1"
                            autocomplete="name"
                            name="name"
                            placeholder="Nom complet"
                        />
                        <InputError :message="errors.name" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="email">Email</Label>
                        <Input
                            id="email"
                            type="email"
                            required
                            :tabindex="2"
                            autocomplete="email"
                            name="email"
                            placeholder="email@example.com"
                        />
                        <InputError :message="errors.email" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="password">Mot de passe</Label>
                        <PasswordInput
                            id="password"
                            required
                            :tabindex="3"
                            autocomplete="new-password"
                            name="password"
                            placeholder="Mot de passe"
                        />
                        <InputError :message="errors.password" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="password_confirmation">Confirmer le mot de passe</Label>
                        <PasswordInput
                            id="password_confirmation"
                            required
                            :tabindex="4"
                            autocomplete="new-password"
                            name="password_confirmation"
                            placeholder="Confirmer le mot de passe"
                        />
                        <InputError :message="errors.password_confirmation" />
                    </div>

                    <!-- Preferences: categories selection -->
                    <div class="pt-2">
                        <Label>Choisissez vos catégories préférées</Label>
                        <div class="grid grid-cols-2 gap-2 mt-2">
                            <label class="inline-flex items-center gap-2">
                                <input type="checkbox" name="preferences[]" value="Informatique" class="rounded" />
                                <span class="text-sm">Informatique</span>
                            </label>
                            <label class="inline-flex items-center gap-2">
                                <input type="checkbox" name="preferences[]" value="Réseaux" class="rounded" />
                                <span class="text-sm">Réseaux</span>
                            </label>
                            <label class="inline-flex items-center gap-2">
                                <input type="checkbox" name="preferences[]" value="Intelligence Artificielle" class="rounded" />
                                <span class="text-sm">Intelligence Artificielle</span>
                            </label>
                            <label class="inline-flex items-center gap-2">
                                <input type="checkbox" name="preferences[]" value="Développement Web" class="rounded" />
                                <span class="text-sm">Développement Web</span>
                            </label>
                            <label class="inline-flex items-center gap-2">
                                <input type="checkbox" name="preferences[]" value="Bases de Données" class="rounded" />
                                <span class="text-sm">Bases de Données</span>
                            </label>
                            <label class="inline-flex items-center gap-2">
                                <input type="checkbox" name="preferences[]" value="Cybersécurité" class="rounded" />
                                <span class="text-sm">Cybersécurité</span>
                            </label>
                        </div>
                        <p class="text-xs text-muted-foreground mt-2">Vous pourrez modifier ces préférences plus tard dans votre profil.</p>
                    </div>

                    <Button type="submit" class="mt-2 w-full btn-accent" tabindex="5" :disabled="processing" data-test="register-user-button">
                        <Spinner v-if="processing" />
                        Créer un compte
                    </Button>
                </div>
                <div class="text-center text-sm text-muted-foreground">
                    Vous avez déjà un compte ?
                    <TextLink :href="login()" class="text-violet-500 dark:text-violet-300" :tabindex="6">Se connecter</TextLink>
                </div>
            </Form>
        </div>
    </div>
</template>
