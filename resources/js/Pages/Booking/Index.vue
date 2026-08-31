<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import PublicLayout from '@/Layouts/PublicLayout.vue';
import { computed } from 'vue';

const props = defineProps({
    rooms: Array,
});

const form = useForm({
    room_id: '',
    guest_name: '',
    guest_email: '',
    guest_phone: '',
    check_in: '',
    check_out: '',
    guests: 1,
    notes: '',
});

const selectedRoom = computed(() => props.rooms.find(r => r.id == form.room_id));

const nights = computed(() => {
    if (!form.check_in || !form.check_out) return 0;
    const start = new Date(form.check_in);
    const end = new Date(form.check_out);
    const diff = (end - start) / (1000 * 60 * 60 * 24);
    return diff > 0 ? diff : 0;
});

const totalPrice = computed(() => {
    if (!selectedRoom.value || nights.value === 0) return 0;
    return selectedRoom.value.price_per_night * nights.value;
});

const submit = () => {
    form.post(route('booking.store'), {
        onSuccess: () => form.reset(),
    });
};
</script>

<template>
    <PublicLayout>
        <Head title="Book Your Stay" />

        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center mb-16">
                <h1 class="text-4xl md:text-5xl font-serif font-bold text-stone-900 mb-4">Book Your Stay</h1>
                <p class="text-stone-600 text-lg">Select your dates and preferred room</p>
            </div>

            <div class="grid lg:grid-cols-3 gap-12">
                <!-- Booking Form -->
                <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-stone-200 p-8">
                    <form @submit.prevent="submit" class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-stone-700 mb-1">Room</label>
                            <select
                                v-model="form.room_id"
                                required
                                class="w-full rounded-lg border-stone-300 focus:border-stone-500 focus:ring-stone-500"
                            >
                                <option value="" disabled>Select a room</option>
                                <option v-for="room in rooms" :key="room.id" :value="room.id">
                                    {{ room.name }} — ${{ Number(room.price_per_night).toFixed(0) }}/night
                                </option>
                            </select>
                        </div>

                        <div class="grid sm:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-stone-700 mb-1">Check-in</label>
                                <input
                                    v-model="form.check_in"
                                    type="date"
                                    required
                                    class="w-full rounded-lg border-stone-300 focus:border-stone-500 focus:ring-stone-500"
                                />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-stone-700 mb-1">Check-out</label>
                                <input
                                    v-model="form.check_out"
                                    type="date"
                                    required
                                    class="w-full rounded-lg border-stone-300 focus:border-stone-500 focus:ring-stone-500"
                                />
                            </div>
                        </div>

                        <div class="grid sm:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-stone-700 mb-1">Guests</label>
                                <input
                                    v-model="form.guests"
                                    type="number"
                                    min="1"
                                    :max="selectedRoom?.capacity || 4"
                                    required
                                    class="w-full rounded-lg border-stone-300 focus:border-stone-500 focus:ring-stone-500"
                                />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-stone-700 mb-1">Phone</label>
                                <input
                                    v-model="form.guest_phone"
                                    type="tel"
                                    class="w-full rounded-lg border-stone-300 focus:border-stone-500 focus:ring-stone-500"
                                />
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-stone-700 mb-1">Full Name</label>
                            <input
                                v-model="form.guest_name"
                                type="text"
                                required
                                class="w-full rounded-lg border-stone-300 focus:border-stone-500 focus:ring-stone-500"
                            />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-stone-700 mb-1">Email</label>
                            <input
                                v-model="form.guest_email"
                                type="email"
                                required
                                class="w-full rounded-lg border-stone-300 focus:border-stone-500 focus:ring-stone-500"
                            />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-stone-700 mb-1">Special Requests (optional)</label>
                            <textarea
                                v-model="form.notes"
                                rows="3"
                                class="w-full rounded-lg border-stone-300 focus:border-stone-500 focus:ring-stone-500"
                            ></textarea>
                        </div>

                        <button
                            type="submit"
                            :disabled="form.processing || !form.room_id"
                            class="w-full py-3.5 bg-stone-900 text-white font-semibold rounded-full hover:bg-stone-800 transition disabled:opacity-50"
                        >
                            {{ form.processing ? 'Processing...' : 'Request Booking' }}
                        </button>
                    </form>
                </div>

                <!-- Summary -->
                <div class="lg:col-span-1">
                    <div class="sticky top-24 bg-stone-50 rounded-2xl border border-stone-200 p-6">
                        <h3 class="text-lg font-semibold text-stone-900 mb-4">Booking Summary</h3>

                        <div v-if="selectedRoom" class="space-y-4">
                            <img :src="selectedRoom.image" class="w-full h-40 object-cover rounded-xl" :alt="selectedRoom.name" />
                            <div>
                                <p class="font-medium text-stone-900">{{ selectedRoom.name }}</p>
                                <p class="text-sm text-stone-500">Up to {{ selectedRoom.capacity }} guests</p>
                            </div>
                            <div class="border-t border-stone-200 pt-4 space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-stone-600">Price per night</span>
                                    <span>${{ Number(selectedRoom.price_per_night).toFixed(0) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-stone-600">Nights</span>
                                    <span>{{ nights }}</span>
                                </div>
                                <div class="flex justify-between font-semibold text-base pt-2 border-t border-stone-200">
                                    <span>Total</span>
                                    <span>${{ totalPrice.toFixed(0) }}</span>
                                </div>
                            </div>
                        </div>
                        <p v-else class="text-stone-500 text-sm">Select a room to see the summary</p>
                    </div>
                </div>
            </div>
        </section>
    </PublicLayout>
</template>