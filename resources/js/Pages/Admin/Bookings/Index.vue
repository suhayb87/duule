<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

defineProps({
    bookings: Object,
    filters: Object,
});

const setStatus = (status) => {
    router.get(route('admin.bookings.index'), { status }, { preserveState: true });
};

const updateStatus = (id, status) => {
    router.patch(route('admin.bookings.update-status', id), {
        status: status,
    }, {
        preserveScroll: true,
    });
};
</script>

<template>
    <AdminLayout>
        <Head title="Bookings" />

        <div class="mb-8">
            <h1 class="text-2xl font-bold text-stone-900">Bookings</h1>
            <p class="text-stone-600 mt-1">Manage all reservations</p>
        </div>

        <!-- Filters -->
        <div class="flex flex-wrap gap-2 mb-6">
            <button
                v-for="status in [null, 'pending', 'confirmed', 'cancelled', 'completed']"
                :key="status"
                @click="setStatus(status)"
                class="px-4 py-1.5 rounded-full text-sm font-medium transition"
                :class="filters.status === status || (!filters.status && !status)
                    ? 'bg-stone-900 text-white'
                    : 'bg-white border border-stone-200 text-stone-600 hover:bg-stone-50'"
            >
                {{ status ? status.charAt(0).toUpperCase() + status.slice(1) : 'All' }}
            </button>
        </div>

        <div class="bg-white rounded-xl border border-stone-200 overflow-hidden">
            <table class="min-w-full divide-y divide-stone-200">
                <thead class="bg-stone-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-stone-500 uppercase">Guest</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-stone-500 uppercase">Room</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-stone-500 uppercase">Dates</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-stone-500 uppercase">Total</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-stone-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-stone-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100">
                    <tr v-for="booking in bookings.data" :key="booking.id" class="hover:bg-stone-50">
                        <td class="px-6 py-4">
                            <p class="font-medium text-stone-900">{{ booking.guest_name }}</p>
                            <p class="text-sm text-stone-500">{{ booking.guest_email }}</p>
                        </td>
                        <td class="px-6 py-4 text-stone-600">{{ booking.room?.name }}</td>
                        <td class="px-6 py-4 text-sm text-stone-600">
                            {{ booking.check_in }} → {{ booking.check_out }}
                        </td>
                        <td class="px-6 py-4 font-medium">${{ Number(booking.total_price).toFixed(0) }}</td>
                        <td class="px-6 py-4">
                            <span
                                class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-medium"
                                :class="{
                                    'bg-amber-100 text-amber-800': booking.status === 'pending',
                                    'bg-green-100 text-green-800': booking.status === 'confirmed',
                                    'bg-red-100 text-red-800': booking.status === 'cancelled',
                                    'bg-stone-100 text-stone-800': booking.status === 'completed',
                                }"
                            >
                                {{ booking.status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right space-x-3">
                            <Link
                                :href="route('admin.bookings.show', booking.id)"
                                class="text-sm text-stone-600 hover:text-stone-900"
                            >
                                View
                            </Link>
                            <Link
                                :href="route('admin.bookings.edit', booking.id)"
                                class="text-sm text-stone-600 hover:text-stone-900"
                            >
                                Edit
                            </Link>

                            <!-- Confirm button -->
                            <button
                                v-if="booking.status === 'pending'"
                                @click="updateStatus(booking.id, 'confirmed')"
                                class="text-sm text-green-600 hover:text-green-800 font-medium"
                            >
                                Confirm
                            </button>

                            <!-- Optional: Cancel button -->
                            <button
                                v-if="['pending', 'confirmed'].includes(booking.status)"
                                @click="updateStatus(booking.id, 'cancelled')"
                                class="text-sm text-red-600 hover:text-red-800 font-medium"
                            >
                                Cancel
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div v-if="!bookings.data.length" class="px-6 py-12 text-center text-stone-500">
                No bookings found.
            </div>
        </div>
    </AdminLayout>
</template>