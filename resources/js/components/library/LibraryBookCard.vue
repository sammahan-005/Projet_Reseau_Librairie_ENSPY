<script setup lang="ts">
import { computed, ref } from 'vue';
import { usePage, Link } from '@inertiajs/vue3';
import SubscriptionGateModal from '@/components/SubscriptionGateModal.vue';
import { useReadingTimer } from '@/composables/useReadingTimer';

const { remainingSeconds } = useReadingTimer();

const props = defineProps<{ book: any }>();

const page = usePage();
const showSubscriptionModal = ref(false);
const authUser = computed(() => page.props.auth?.user);
const activeSubscription = computed(() => (page.props.auth as any)?.subscription);
const hasMonthly = computed(() => activeSubscription.value?.kind === 'monthly');
const hasHourly = computed(() => activeSubscription.value?.kind === 'hourly');
const hasTimeLeft = computed(() => remainingSeconds.value !== null && remainingSeconds.value > 0);
const canRead = computed(() => Boolean(authUser.value && (hasMonthly.value || hasHourly.value) && hasTimeLeft.value));

function continueReading(event: MouseEvent) {
  if (authUser.value && !canRead.value) {
    event.preventDefault();
    showSubscriptionModal.value = true;
  }
}
</script>

<template>
  <div class="relative rounded-lg overflow-hidden group bg-card border border-border">
    <img v-if="props.book.cover_image" :src="`/storage/${props.book.cover_image}`" alt="cover" class="w-full h-56 object-cover" />
    <div v-else class="w-full h-56 bg-muted flex items-center justify-center text-muted-foreground">No cover</div>

    <div class="p-3">
      <div class="text-sm font-semibold text-foreground">{{ props.book.title }}</div>
      <div class="text-xs text-muted-foreground">{{ props.book.author }}</div>
      <div class="text-xs text-primary mt-2">{{ props.book.genre }}</div>
    </div>

    <div class="absolute inset-0 bg-background/50 backdrop-blur-sm transition-opacity flex items-end justify-center p-3 opacity-0 group-hover:opacity-100">
      <div class="flex gap-2">
        <!-- Continuer action -->
        <component
          :is="canRead ? Link : 'button'"
          :href="canRead ? `/books/${props.book.id}/read` : undefined"
          class="px-3 py-2 rounded bg-primary text-primary-foreground text-sm"
          @click="continueReading"
        >
          Continuer
        </component>
        <Link :href="`/books/${props.book.id}`" class="px-3 py-2 rounded bg-secondary text-secondary-foreground text-sm">Détails</Link>
        <button class="px-3 py-2 rounded bg-secondary text-secondary-foreground text-sm">❤</button>
      </div>
    </div>

    <!-- progress -->
    <div v-if="props.book.progress" class="absolute left-3 right-3 bottom-16 h-2 bg-muted rounded overflow-hidden">
      <div class="h-2 bg-primary rounded-full" :style="{ width: (props.book.progress*100)+'%' }"></div>
    </div>

    <!-- badges -->
    <div class="absolute top-3 left-3 space-y-1">
      <span v-if="props.book.is_new" class="text-xs bg-primary text-primary-foreground px-2 py-1 rounded">Nouveau</span>
      <span v-if="props.book.is_favorite" class="text-xs bg-primary text-primary-foreground px-2 py-1 rounded">Favori</span>
    </div>

    <SubscriptionGateModal :book-id="props.book.id" :open="showSubscriptionModal" @close="showSubscriptionModal = false" />
  </div>
</template>
