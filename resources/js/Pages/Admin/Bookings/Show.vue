<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

defineProps({
    booking: Object,
});

const destroy = (id) => {
    if (confirm('Are you sure you want to delete this booking?')) {
        router.delete(route('admin.bookings.destroy', id));
    }
};
</script>

<template>
    <AdminLayout>
        <Head title="Booking Details" />

        <div class="mb-8">
            <Link :href="route('admin.bookings.index')" class="text-sm text-stone-600 hover:text-stone-900">
                ← Back to Bookings
            </Link>
            <div class="flex items-center justify-between mt-2">
                <h1 class="text-2xl font-bold text-stone-900">Booking #{{ booking.id }}</h1>
                <span
                    class="inline-flex px-3 py-1 rounded-full text-sm font-medium"
                    :class="{
                        'bg-amber-100 text-amber-800': booking.status === 'pending',
                        'bg-green-100 text-green-800': booking.status === 'confirmed',
                        'bg-red-100 text-red-800': booking.status === 'cancelled',
                        'bg-stone-100 text-stone-800': booking.status === 'completed',
                    }"
                >
                    {{ booking.status }}
                </span>
            </div>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Main Info -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-xl border border-stone-200 p-6">
                    <h2 class="text-lg font-semibold text-stone-900 mb-4">Guest Information</h2>
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-stone-500">Full Name</p>
                            <p class="font-medium text-stone-900">{{ booking.guest_name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-stone-500">Email</p>
                            <p class="font-medium text-stone-900">{{ booking.guest_email }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-stone-500">Phone</p>
                            <p class="font-medium text-stone-900">{{ booking.guest_phone || '—' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-stone-500">Number of Guests</p>
                            <p class="font-medium text-stone-900">{{ booking.guests }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl border border-stone-200 p-6">
                    <h2 class="text-lg font-semibold text-stone-900 mb-4">Stay Details</h2>
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-stone-500">Check-in</p>
                            <p class="font-medium text-stone-900">{{ booking.check_in }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-stone-500">Check-out</p>
                            <p class="font-medium text-stone-900">{{ booking.check_out }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-stone-500">Room</p>
                            <p class="font-medium text-stone-900">{{ booking.room?.name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-stone-500">Total Price</p>
                            <p class="font-medium text-stone-900 text-lg">${{ Number(booking.total_price).toFixed(2) }}</p>
                        </div>
                    </div>

                    <div v-if="booking.notes" class="mt-6 pt-6 border-t border-stone-200">
                        <p class="text-sm text-stone-500 mb-1">Special Requests / Notes</p>
                        <p class="text-stone-800 whitespace-pre-wrap">{{ booking.notes }}</p>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <div class="bg-white rounded-xl border border-stone-200 p-6">
                    <h3 class="font-semibold text-stone-900 mb-4">Actions</h3>
                    <div class="space-y-3">
                        <Link
                            :href="route('admin.bookings.edit', booking.id)"
                            class="block w-full text-center px-4 py-2.5 bg-stone-900 text-white rounded-lg hover:bg-stone-800 text-sm font-medium"
                        >
                            Edit Booking
                        </Link>
                        <button
                            @click="destroy(booking.id)"
                            class="block w-full text-center px-4 py-2.5 border border-red-200 text-red-600 rounded-lg hover:bg-red-50 text-sm font-medium"
                        >
                            Delete Booking
                        </button>
                    </div>
                </div>

                <div v-if="booking.room" class="bg-white rounded-xl border border-stone-200 overflow-hidden">
                    <img :src="booking.room.image" :alt="booking.room.name" class="w-full h-40 object-cover" />
                    <div class="p-4">
                        <p class="font-medium text-stone-900">{{ booking.room.name }}</p>
                        <p class="text-sm text-stone-500 mt-1">${{ Number(booking.room.price_per_night).toFixed(0) }} / night</p>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>