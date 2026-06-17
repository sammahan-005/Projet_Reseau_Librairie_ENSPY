<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3';
import AuthShell from '@/components/auth/AuthShell.vue';
import InputError from '@/components/InputError.vue';
import PasswordInput from '@/components/PasswordInput.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import { login } from '@/routes';
import { store } from '@/routes/register';

</script>

<template>
    <Head title="Créer un compte" />

    <AuthShell
        title="Créer un compte"
        description="Renseignez vos informations et personnalisez vos premières recommandations."
        mode="register"
    >
        <Form
            v-bind="store.form()"
            :reset-on-success="['password', 'password_confirmation']"
            v-slot="{ errors, processing }"
            class="flex flex-col gap-6"
        >
            <div class="grid gap-5">
                <div class="grid gap-2">
                        <Label for="name" class="text-[var(--foreground)]">Nom</Label>
                        <Input
                            id="name"
                            type="text"
                            required
                            autofocus
                            :tabindex="1"
                            autocomplete="name"
                            name="name"
                            placeholder="Nom complet"
                            class="auth-input"
                        />
                        <InputError :message="errors.name" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="email" class="text-[var(--foreground)]">Email</Label>
                        <Input
                            id="email"
                            type="email"
                            required
                            :tabindex="2"
                            autocomplete="email"
                            name="email"
                            placeholder="email@example.com"
                            class="auth-input"
                        />
                        <InputError :message="errors.email" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="password" class="text-[var(--foreground)]">Mot de passe</Label>
                        <PasswordInput
                            id="password"
                            required
                            :tabindex="3"
                            autocomplete="new-password"
                            name="password"
                            placeholder="Mot de passe"
                            class="auth-input"
                        />
                        <InputError :message="errors.password" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="password_confirmation" class="text-[var(--foreground)]">Confirmer le mot de passe</Label>
                        <PasswordInput
                            id="password_confirmation"
                            required
                            :tabindex="4"
                            autocomplete="new-password"
                            name="password_confirmation"
                            placeholder="Confirmer le mot de passe"
                            class="auth-input"
                        />
                        <InputError :message="errors.password_confirmation" />
                    </div>

                    <div class="pt-2">
                        <Label class="text-[var(--foreground)]">Choisissez vos catégories préférées</Label>
                        <div class="grid grid-cols-2 gap-2 mt-2">
                            <label class="inline-flex items-center gap-2 text-[var(--auth-muted)]">
                                <input type="checkbox" name="preferences[]" value="Informatique" class="rounded border-[var(--auth-border)] accent-[var(--brand)]" />
                                <span class="text-sm">Informatique</span>
                            </label>
                            <label class="inline-flex items-center gap-2 text-[var(--auth-muted)]">
                                <input type="checkbox" name="preferences[]" value="Réseaux" class="rounded border-[var(--auth-border)] accent-[var(--brand)]" />
                                <span class="text-sm">Réseaux</span>
                            </label>
                            <label class="inline-flex items-center gap-2 text-[var(--auth-muted)]">
                                <input type="checkbox" name="preferences[]" value="Intelligence Artificielle" class="rounded border-[var(--auth-border)] accent-[var(--brand)]" />
                                <span class="text-sm">Intelligence Artificielle</span>
                            </label>
                            <label class="inline-flex items-center gap-2 text-[var(--auth-muted)]">
                                <input type="checkbox" name="preferences[]" value="Développement Web" class="rounded border-[var(--auth-border)] accent-[var(--brand)]" />
                                <span class="text-sm">Développement Web</span>
                            </label>
                            <label class="inline-flex items-center gap-2 text-[var(--auth-muted)]">
                                <input type="checkbox" name="preferences[]" value="Bases de Données" class="rounded border-[var(--auth-border)] accent-[var(--brand)]" />
                                <span class="text-sm">Bases de Données</span>
                            </label>
                            <label class="inline-flex items-center gap-2 text-[var(--auth-muted)]">
                                <input type="checkbox" name="preferences[]" value="Cybersécurité" class="rounded border-[var(--auth-border)] accent-[var(--brand)]" />
                                <span class="text-sm">Cybersécurité</span>
                            </label>
                        </div>
                        <p class="text-xs text-[var(--auth-muted)] mt-2">Vous pourrez modifier ces préférences plus tard dans votre profil.</p>
                    </div>

                    <Button type="submit" class="mt-2 w-full bg-[var(--brand)] text-white hover:bg-[var(--brand-strong)]" tabindex="5" :disabled="processing" data-test="register-user-button">
                        <Spinner v-if="processing" />
                        Créer un compte
                    </Button>
                </div>
                <div class="text-center text-sm text-[var(--auth-muted)]">
                    Vous avez déjà un compte ?
                    <TextLink :href="login()" class="font-semibold text-[var(--brand)]" :tabindex="6">Se connecter</TextLink>
                </div>
            </Form>
    </AuthShell>
</template>
