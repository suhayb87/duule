<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

defineProps({
    stats: Object,
    recentBookings: Array,
    recentMessages: Array,
});
</script>

<template>
    <AdminLayout>
        <Head title="Admin Dashboard" />

        <div class="mb-8">
            <h1 class="text-2xl font-bold text-stone-900">Dashboard</h1>
            <p class="text-stone-600 mt-1">Overview of your hotel</p>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <div class="bg-white rounded-xl border border-stone-200 p-6">
                <p class="text-sm text-stone-500">Total Rooms</p>
                <p class="text-3xl font-bold text-stone-900 mt-1">{{ stats.total_rooms }}</p>
                <p class="text-xs text-stone-400 mt-1">{{ stats.active_rooms }} active</p>
            </div>
            <div class="bg-white rounded-xl border border-stone-200 p-6">
                <p class="text-sm text-stone-500">Bookings</p>
                <p class="text-3xl font-bold text-stone-900 mt-1">{{ stats.total_bookings }}</p>
                <p class="text-xs text-amber-600 mt-1">{{ stats.pending_bookings }} pending</p>
            </div>
            <div class="bg-white rounded-xl border border-stone-200 p-6">
                <p class="text-sm text-stone-500">Confirmed</p>
                <p class="text-3xl font-bold text-stone-900 mt-1">{{ stats.confirmed_bookings }}</p>
            </div>
            <div class="bg-white rounded-xl border border-stone-200 p-6">
                <p class="text-sm text-stone-500">Unread Messages</p>
                <p class="text-3xl font-bold text-stone-900 mt-1">{{ stats.unread_messages }}</p>
            </div>
        </div>

        <div class="grid lg:grid-cols-2 gap-8">
            <!-- Recent Bookings -->
            <div class="bg-white rounded-xl border border-stone-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-stone-200 flex justify-between items-center">
                    <h2 class="font-semibold text-stone-900">Recent Bookings</h2>
                    <Link :href="route('admin.bookings.index')" class="text-sm text-stone-600 hover:text-stone-900">View all</Link>
                </div>
                <div class="divide-y divide-stone-100">
                    <div v-for="booking in recentBookings" :key="booking.id" class="px-6 py-4 flex justify-between items-center">
                        <div>
                            <p class="font-medium text-stone-900">{{ booking.guest_name }}</p>
                            <p class="text-sm text-stone-500">{{ booking.room?.name }} · {{ booking.check_in }} → {{ booking.check_out }}</p>
                        </div>
                        <span
                            class="text-xs font-medium px-2.5 py-1 rounded-full"
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
                    <div v-if="!recentBookings.length" class="px-6 py-8 text-center text-stone-500 text-sm">
                        No bookings yet
                    </div>
                </div>
            </div>

            <!-- Recent Messages -->
            <div class="bg-white rounded-xl border border-stone-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-stone-200 flex justify-between items-center">
                    <h2 class="font-semibold text-stone-900">Recent Messages</h2>
                    <Link :href="route('admin.messages.index')" class="text-sm text-stone-600 hover:text-stone-900">View all</Link>
                </div>
                <div class="divide-y divide-stone-100">
                    <div v-for="msg in recentMessages" :key="msg.id" class="px-6 py-4">
                        <div class="flex justify-between">
                            <p class="font-medium text-stone-900">{{ msg.name }}</p>
                            <span v-if="!msg.is_read" class="w-2 h-2 rounded-full bg-blue-500"></span>
                        </div>
                        <p class="text-sm text-stone-500 truncate">{{ msg.subject || msg.message }}</p>
                    </div>
                    <div v-if="!recentMessages.length" class="px-6 py-8 text-center text-stone-500 text-sm">
                        No messages yet
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>