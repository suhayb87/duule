<script setup>
import { Head, useForm, Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

const props = defineProps({
    booking: Object,
    rooms: Array,
});

const form = useForm({
    room_id: props.booking.room_id,
    guest_name: props.booking.guest_name,
    guest_email: props.booking.guest_email,
    guest_phone: props.booking.guest_phone || '',
    check_in: props.booking.check_in,
    check_out: props.booking.check_out,
    guests: props.booking.guests,
    status: props.booking.status,
    total_price: props.booking.total_price,
    notes: props.booking.notes || '',
});

const submit = () => {
    form.put(route('admin.bookings.update', props.booking.id));
};
</script>

<template>
    <AdminLayout>
        <Head title="Edit Booking" />

        <div class="mb-8">
            <Link :href="route('admin.bookings.show', booking.id)" class="text-sm text-stone-600 hover:text-stone-900">
                ← Back to Booking
            </Link>
            <h1 class="text-2xl font-bold text-stone-900 mt-2">Edit Booking #{{ booking.id }}</h1>
        </div>

        <form @submit.prevent="submit" class="bg-white rounded-xl border border-stone-200 p-8 max-w-3xl space-y-6">
            <!-- Room -->
            <div>
                <label class="block text-sm font-medium text-stone-700 mb-1">Room</label>
                <select v-model="form.room_id" required class="w-full rounded-lg border-stone-300 focus:border-stone-500 focus:ring-stone-500">
                    <option v-for="room in rooms" :key="room.id" :value="room.id">
                        {{ room.name }}
                    </option>
                </select>
            </div>

            <!-- Guest Info -->
            <div class="grid sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-stone-700 mb-1">Guest Name</label>
                    <input v-model="form.guest_name" type="text" required class="w-full rounded-lg border-stone-300" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-stone-700 mb-1">Email</label>
                    <input v-model="form.guest_email" type="email" required class="w-full rounded-lg border-stone-300" />
                </div>
            </div>

            <div class="grid sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-stone-700 mb-1">Phone</label>
                    <input v-model="form.guest_phone" type="tel" class="w-full rounded-lg border-stone-300" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-stone-700 mb-1">Guests</label>
                    <input v-model="form.guests" type="number" min="1" required class="w-full rounded-lg border-stone-300" />
                </div>
            </div>

            <!-- Dates -->
            <div class="grid sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-stone-700 mb-1">Check-in</label>
                    <input v-model="form.check_in" type="date" required class="w-full rounded-lg border-stone-300" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-stone-700 mb-1">Check-out</label>
                    <input v-model="form.check_out" type="date" required class="w-full rounded-lg border-stone-300" />
                </div>
            </div>

            <!-- Status & Price -->
            <div class="grid sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-stone-700 mb-1">Status</label>
                    <select v-model="form.status" required class="w-full rounded-lg border-stone-300">
                        <option value="pending">Pending</option>
                        <option value="confirmed">Confirmed</option>
                        <option value="cancelled">Cancelled</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-stone-700 mb-1">Total Price ($)</label>
                    <input v-model="form.total_price" type="number" step="0.01" min="0" required class="w-full rounded-lg border-stone-300" />
                </div>
            </div>

            <!-- Notes -->
            <div>
                <label class="block text-sm font-medium text-stone-700 mb-1">Notes / Special Requests</label>
                <textarea v-model="form.notes" rows="4" class="w-full rounded-lg border-stone-300"></textarea>
            </div>

            <!-- Actions -->
            <div class="flex gap-4 pt-4">
                <button
                    type="submit"
                    :disabled="form.processing"
                    class="px-6 py-2.5 bg-stone-900 text-white rounded-lg hover:bg-stone-800 disabled:opacity-50"
                >
                    {{ form.processing ? 'Saving...' : 'Update Booking' }}
                </button>
                <Link
                    :href="route('admin.bookings.show', booking.id)"
                    class="px-6 py-2.5 border border-stone-300 rounded-lg text-stone-700 hover:bg-stone-50"
                >
                    Cancel
                </Link>
            </div>
        </form>
    </AdminLayout>
</template>