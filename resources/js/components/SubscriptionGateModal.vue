<script setup lang="ts">
import { computed, ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import { Check, Clock3, Crown, ImageUp, Phone, WalletCards, X } from 'lucide-vue-next';

const props = defineProps<{
    bookId: number;
    open: boolean;
}>();

const emit = defineEmits<{
    close: [];
}>();

type Step = 'choice' | 'hourly' | 'plan';

const step = ref<Step>('choice');
const selectedPlan = ref<'standard' | 'medium' | 'premium'>('standard');
const screenshotName = ref('');

const plans = [
    {
        id: 'standard',
        name: 'Standard',
        hours: '30 min / jour',
        price: '2 500 FCFA',
        tone: 'bg-orange-500',
    },
    {
        id: 'medium',
        name: 'Medium',
        hours: '1 h / jour',
        price: '5 000 FCFA',
        tone: 'bg-violet-600',
    },
    {
        id: 'premium',
        name: 'Premium',
        hours: '2 h / jour',
        price: '9 000 FCFA',
        tone: 'bg-emerald-600',
    },
] as const;

const form = useForm({
    book_id: props.bookId,
    kind: 'hourly',
    hours: 1,
    plan: 'standard',
    name: '',
    phone: '',
    payment_mode: 'Mobile Money',
    payment_password: '',
    screenshot: null as File | null,
});

const title = computed(() => {
    if (step.value === 'hourly') {
        return 'Souscription horaire';
    }

    if (step.value === 'plan') {
        return 'Abonnement mensuel';
    }

    return 'Choisir un accès';
});

function resetAndClose() {
    step.value = 'choice';
    form.reset();
    form.clearErrors();
    screenshotName.value = '';
    emit('close');
}

function chooseHourly() {
    step.value = 'hourly';
    form.kind = 'hourly';
    form.plan = 'standard';
}

function choosePlan(plan: 'standard' | 'medium' | 'premium') {
    selectedPlan.value = plan;
    form.kind = 'plan';
    form.plan = plan;
}

function openPlanForm() {
    step.value = 'plan';
    form.kind = 'plan';
    form.plan = selectedPlan.value;
}

function selectScreenshot(event: Event) {
    const input = event.target as HTMLInputElement;
    const file = input.files?.[0] ?? null;

    form.screenshot = file;
    screenshotName.value = file?.name ?? '';
}

function submit() {
    form.book_id = props.bookId;

    if (step.value === 'plan') {
        form.plan = selectedPlan.value;
    }

    form.post('/subscriptions/simulate', {
        forceFormData: true,
        preserveScroll: true,
    });
}
</script>

<template>
    <div v-if="open" class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 px-4 py-6">
        <div class="max-h-[92vh] w-full max-w-2xl overflow-y-auto rounded-lg border border-border bg-card text-foreground shadow-2xl">
            <div class="flex items-center justify-between border-b border-border px-5 py-4">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[var(--brand)]">Accès requis</p>
                    <h2 class="text-xl font-bold">{{ title }}</h2>
                </div>
                <button @click="resetAndClose" class="inline-flex size-9 items-center justify-center rounded-md hover:bg-accent">
                    <X class="size-5" />
                </button>
            </div>

            <div v-if="step === 'choice'" class="grid gap-4 p-5 md:grid-cols-2">
                <button @click="chooseHourly" class="rounded-lg border border-border bg-background p-5 text-left transition hover:border-[var(--brand)] hover:shadow-lg">
                    <Clock3 class="mb-4 size-8 text-[var(--brand)]" />
                    <h3 class="text-lg font-semibold">Souscription horaire</h3>
                    <p class="mt-2 text-sm leading-6 text-muted-foreground">Choisissez un nombre d'heures ponctuel pour lire immédiatement ce livre.</p>
                    <div class="mt-4 text-sm font-semibold text-[var(--brand)]">À partir de 700 FCFA / heure</div>
                </button>

                <button @click="openPlanForm" class="rounded-lg border border-border bg-background p-5 text-left transition hover:border-[var(--brand)] hover:shadow-lg">
                    <Crown class="mb-4 size-8 text-[var(--brand)]" />
                    <h3 class="text-lg font-semibold">Abonnement mensuel</h3>
                    <p class="mt-2 text-sm leading-6 text-muted-foreground">Débloquez un temps de lecture quotidien selon votre plan.</p>
                    <div class="mt-4 text-sm font-semibold text-[var(--brand)]">Standard, Medium ou Premium</div>
                </button>
            </div>

            <div v-else class="p-5">
                <div v-if="step === 'hourly'" class="mb-5 rounded-lg border border-border bg-background p-4">
                    <label class="text-sm font-semibold">Nombre d'heures souhaité</label>
                    <input v-model="form.hours" type="number" min="1" max="12" class="mt-2 h-10 w-full rounded-md border border-border bg-card px-3 outline-none focus:ring-2 focus:ring-[var(--brand)]" />
                    <p class="mt-2 text-xs text-muted-foreground">Prix simulé: {{ Number(form.hours || 0) * 700 }} FCFA</p>
                    <p v-if="form.errors.hours" class="mt-2 text-sm text-red-500">{{ form.errors.hours }}</p>
                </div>

                <div v-if="step === 'plan'" class="mb-5 grid gap-3 md:grid-cols-3">
                    <button
                        v-for="plan in plans"
                        :key="plan.id"
                        @click="choosePlan(plan.id)"
                        class="rounded-lg border p-4 text-left transition"
                        :class="selectedPlan === plan.id ? 'border-[var(--brand)] bg-[var(--brand)]/10' : 'border-border bg-background hover:border-[var(--brand)]'"
                    >
                        <div class="mb-3 flex items-center justify-between">
                            <span :class="['rounded px-2 py-1 text-xs font-bold text-white', plan.tone]">{{ plan.name }}</span>
                            <Check v-if="selectedPlan === plan.id" class="size-5 text-[var(--brand)]" />
                        </div>
                        <div class="font-semibold">{{ plan.hours }}</div>
                        <div class="mt-1 text-sm text-muted-foreground">{{ plan.price }}</div>
                    </button>
                </div>

                <div class="grid gap-4">
                    <div>
                        <label class="text-sm font-semibold">Nom complet</label>
                        <input v-model="form.name" type="text" class="mt-2 h-10 w-full rounded-md border border-border bg-background px-3 outline-none focus:ring-2 focus:ring-[var(--brand)]" placeholder="Votre nom" />
                        <p v-if="form.errors.name" class="mt-2 text-sm text-red-500">{{ form.errors.name }}</p>
                    </div>

                    <div>
                        <label class="flex items-center gap-2 text-sm font-semibold">
                            <Phone class="size-4" />
                            Numéro de téléphone
                        </label>
                        <input v-model="form.phone" type="tel" class="mt-2 h-10 w-full rounded-md border border-border bg-background px-3 outline-none focus:ring-2 focus:ring-[var(--brand)]" placeholder="+237 6XX XXX XXX" />
                        <p v-if="form.errors.phone" class="mt-2 text-sm text-red-500">{{ form.errors.phone }}</p>
                    </div>

                    <div class="grid gap-4 md:grid-cols-2">
                        <div>
                            <label class="flex items-center gap-2 text-sm font-semibold">
                                <WalletCards class="size-4" />
                                Mode de payment
                            </label>
                            <select v-model="form.payment_mode" class="mt-2 h-10 w-full rounded-md border border-border bg-background px-3 outline-none focus:ring-2 focus:ring-[var(--brand)]">
                                <option>Mobile Money</option>
                                <option>Orange Money</option>
                                <option>Carte bancaire</option>
                            </select>
                            <p v-if="form.errors.payment_mode" class="mt-2 text-sm text-red-500">{{ form.errors.payment_mode }}</p>
                        </div>

                        <div>
                            <label class="text-sm font-semibold">Mot de passe de validation</label>
                            <input v-model="form.payment_password" type="password" class="mt-2 h-10 w-full rounded-md border border-border bg-background px-3 outline-none focus:ring-2 focus:ring-[var(--brand)]" placeholder="••••••" />
                            <p v-if="form.errors.payment_password" class="mt-2 text-sm text-red-500">{{ form.errors.payment_password }}</p>
                        </div>
                    </div>

                    <label class="flex cursor-pointer items-center gap-3 rounded-lg border border-dashed border-border bg-background p-4 hover:border-[var(--brand)]">
                        <ImageUp class="size-6 text-[var(--brand)]" />
                        <div>
                            <div class="text-sm font-semibold">Capture d'écran du payment</div>
                            <div class="text-xs text-muted-foreground">{{ screenshotName || 'Ajouter une image justificative' }}</div>
                        </div>
                        <input type="file" accept="image/*" class="hidden" @change="selectScreenshot" />
                    </label>
                    <p v-if="form.errors.screenshot" class="text-sm text-red-500">{{ form.errors.screenshot }}</p>
                </div>

                <div class="mt-6 flex flex-col-reverse gap-3 sm:flex-row sm:justify-between">
                    <button @click="step = 'choice'" class="rounded-md border border-border px-4 py-2 text-sm font-semibold hover:bg-accent">Retour</button>
                    <button @click="submit" :disabled="form.processing" class="rounded-md bg-[var(--brand)] px-5 py-2 text-sm font-semibold text-white hover:bg-[var(--brand-strong)] disabled:opacity-60">
                        {{ form.processing ? 'Validation...' : 'Valider et lire' }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
