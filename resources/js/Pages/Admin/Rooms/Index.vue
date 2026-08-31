<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

defineProps({
    rooms: Object,
});

const destroy = (id) => {
    if (confirm('Are you sure you want to delete this room?')) {
        router.delete(route('admin.rooms.destroy', id));
    }
};
</script>

<template>
    <AdminLayout>
        <Head title="Rooms" />

        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold text-stone-900">Rooms</h1>
                <p class="text-stone-600 mt-1">Manage your hotel rooms</p>
            </div>
            <Link
                :href="route('admin.rooms.create')"
                class="inline-flex items-center px-4 py-2 bg-stone-900 text-white text-sm font-medium rounded-lg hover:bg-stone-800"
            >
                + Add Room
            </Link>
        </div>

        <div class="bg-white rounded-xl border border-stone-200 overflow-hidden">
            <table class="min-w-full divide-y divide-stone-200">
                <thead class="bg-stone-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-stone-500 uppercase">Room</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-stone-500 uppercase">Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-stone-500 uppercase">Capacity</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-stone-500 uppercase">Bookings</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-stone-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-stone-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100">
                    <tr v-for="room in rooms.data" :key="room.id" class="hover:bg-stone-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <img :src="room.image" class="w-12 h-12 rounded-lg object-cover" :alt="room.name" />
                                <div>
                                    <p class="font-medium text-stone-900">{{ room.name }}</p>
                                    <p class="text-sm text-stone-500">{{ room.slug }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-stone-900">${{ Number(room.price_per_night).toFixed(0) }}</td>
                        <td class="px-6 py-4 text-stone-600">{{ room.capacity }} guests</td>
                        <td class="px-6 py-4 text-stone-600">{{ room.bookings_count }}</td>
                        <td class="px-6 py-4">
                            <span
                                class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-medium"
                                :class="room.is_active ? 'bg-green-100 text-green-800' : 'bg-stone-100 text-stone-600'"
                            >
                                {{ room.is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right space-x-3">
                            <Link :href="route('admin.rooms.edit', room.id)" class="text-sm text-stone-600 hover:text-stone-900">Edit</Link>
                            <button @click="destroy(room.id)" class="text-sm text-red-600 hover:text-red-800">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AdminLayout>
</template>