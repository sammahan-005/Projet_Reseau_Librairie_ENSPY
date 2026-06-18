import { ref, computed, onMounted, onUnmounted } from 'vue';
import { router, usePage } from '@inertiajs/vue3';

// Global state for the timer
const remainingSeconds = ref<number | null>(null);
const isActive = ref(false);
const pivotId = ref<number | null>(null);
const subscriptionType = ref<string | null>(null);
const dailyMinutes = ref<number | null>(null);

let interval: number | null = null;

export function useReadingTimer() {
    const formattedTime = computed(() => {
        if (remainingSeconds.value === null) return '00:00';
        const minutes = Math.floor(remainingSeconds.value / 60).toString().padStart(2, '0');
        const seconds = (remainingSeconds.value % 60).toString().padStart(2, '0');
        return `${minutes}:${seconds}`;
    });

    const progress = computed(() => {
        if (remainingSeconds.value === null || !dailyMinutes.value) return 0;
        return Math.max(0, Math.round((remainingSeconds.value / (dailyMinutes.value * 60)) * 100));
    });

    const startTimer = () => {
        if (interval) return;
        
        isActive.value = true;
        interval = window.setInterval(() => {
            if (remainingSeconds.value !== null && remainingSeconds.value > 0) {
                remainingSeconds.value--;

                // Sync with server every 30 seconds
                if (remainingSeconds.value % 30 === 0 && pivotId.value) {
                    syncWithServer();
                }

                if (remainingSeconds.value <= 0) {
                    stopTimer();
                    syncWithServer();
                    window.dispatchEvent(new CustomEvent('reading-time-expired'));
                }
            }
        }, 1000);
    };

    const stopTimer = () => {
        isActive.value = false;
        if (interval) {
            window.clearInterval(interval);
            interval = null;
        }
    };

    const syncWithServer = async () => {
        if (pivotId.value && remainingSeconds.value !== null) {
            try {
                // Get CSRF token from meta tag
                const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

                await fetch(route('subscription.update-remaining'), {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        pivot_id: pivotId.value,
                        remaining_seconds: remainingSeconds.value,
                    }),
                });
            } catch (error) {
                console.error('Failed to sync timer with server:', error);
            }
        }
    };


    const initTimer = (data: { remaining_seconds: number, pivot_id: number, type: string, daily_minutes: number }) => {
        if (pivotId.value !== data.pivot_id) {
            remainingSeconds.value = data.remaining_seconds;
            pivotId.value = data.pivot_id;
            subscriptionType.value = data.type;
            dailyMinutes.value = data.daily_minutes;
        } else if (remainingSeconds.value === null) {
            remainingSeconds.value = data.remaining_seconds;
        }
    };

    const resetTimer = () => {
        stopTimer();
        remainingSeconds.value = null;
        pivotId.value = null;
        subscriptionType.value = null;
        dailyMinutes.value = null;
    };

    // Auto-sync on page unload
    onMounted(() => {
        window.addEventListener('beforeunload', syncWithServer);
    });

    onUnmounted(() => {
        window.removeEventListener('beforeunload', syncWithServer);
        stopTimer();
        syncWithServer();
    });

    return {
        remainingSeconds,
        isActive,
        formattedTime,
        progress,
        startTimer,
        stopTimer,
        initTimer,
        resetTimer,
        syncWithServer
    };
}
