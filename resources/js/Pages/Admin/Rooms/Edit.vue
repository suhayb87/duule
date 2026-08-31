<script setup>
import { Head, useForm, Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

const props = defineProps({
    room: { type: Object, default: null },
});

const isEdit = !!props.room;

const form = useForm({
    name: props.room?.name || '',
    description: props.room?.description || '',
    price_per_night: props.room?.price_per_night || '',
    capacity: props.room?.capacity || 2,
    total_rooms: props.room?.total_rooms || 1,
    amenities: props.room?.amenities || [],
    image: props.room?.image || '',
    is_active: props.room?.is_active ?? true,
});

const amenitiesInput = ref(Array.isArray(form.amenities) ? form.amenities.join(', ') : '');

import { ref, watch } from 'vue';
watch(amenitiesInput, (val) => {
    form.amenities = val.split(',').map(s => s.trim()).filter(Boolean);
});

const submit = () => {
    if (isEdit) {
        form.put(route('admin.rooms.update', props.room.id));
    } else {
        form.post(route('admin.rooms.store'));
    }
};
</script>

<template>
    <AdminLayout>
        <Head :title="isEdit ? 'Edit Room' : 'Add Room'" />

        <div class="mb-8">
            <Link :href="route('admin.rooms.index')" class="text-sm text-stone-600 hover:text-stone-900">← Back to Rooms</Link>
            <h1 class="text-2xl font-bold text-stone-900 mt-2">{{ isEdit ? 'Edit Room' : 'Add New Room' }}</h1>
        </div>

        <form @submit.prevent="submit" class="bg-white rounded-xl border border-stone-200 p-8 max-w-3xl space-y-6">
            <div>
                <label class="block text-sm font-medium text-stone-700 mb-1">Name</label>
                <input v-model="form.name" type="text" required class="w-full rounded-lg border-stone-300 focus:border-stone-500 focus:ring-stone-500" />
            </div>

            <div>
                <label class="block text-sm font-medium text-stone-700 mb-1">Description</label>
                <textarea v-model="form.description" rows="3" class="w-full rounded-lg border-stone-300 focus:border-stone-500 focus:ring-stone-500"></textarea>
            </div>

            <div class="grid sm:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-medium text-stone-700 mb-1">Price / night</label>
                    <input v-model="form.price_per_night" type="number" step="0.01" required class="w-full rounded-lg border-stone-300" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-stone-700 mb-1">Capacity</label>
                    <input v-model="form.capacity" type="number" min="1" required class="w-full rounded-lg border-stone-300" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-stone-700 mb-1">Total Rooms</label>
                    <input v-model="form.total_rooms" type="number" min="1" required class="w-full rounded-lg border-stone-300" />
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-stone-700 mb-1">Amenities (comma separated)</label>
                <input v-model="amenitiesInput" type="text" class="w-full rounded-lg border-stone-300" placeholder="WiFi, Ocean View, Mini Bar" />
            </div>

            <div>
                <label class="block text-sm font-medium text-stone-700 mb-1">Image URL</label>
                <input v-model="form.image" type="url" class="w-full rounded-lg border-stone-300" placeholder="https://..." />
            </div>

            <div class="flex items-center gap-2">
                <input v-model="form.is_active" type="checkbox" id="is_active" class="rounded border-stone-300" />
                <label for="is_active" class="text-sm text-stone-700">Active</label>
            </div>

            <div class="flex gap-4 pt-4">
                <button type="submit" :disabled="form.processing" class="px-6 py-2.5 bg-stone-900 text-white rounded-lg hover:bg-stone-800 disabled:opacity-50">
                    {{ form.processing ? 'Saving...' : (isEdit ? 'Update Room' : 'Create Room') }}
                </button>
                <Link :href="route('admin.rooms.index')" class="px-6 py-2.5 border border-stone-300 rounded-lg text-stone-700 hover:bg-stone-50">
                    Cancel
                </Link>
            </div>
        </form>
    </AdminLayout>
</template>