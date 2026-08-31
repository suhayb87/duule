<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

defineProps({
    images: Object,
});

const destroy = (id) => {
    if (confirm('Remove this image from the gallery?')) {
        router.delete(route('admin.gallery.destroy', id));
    }
};
</script>

<template>
    <AdminLayout>
        <Head title="Gallery" />

        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold text-stone-900">Gallery</h1>
                <p class="text-stone-600 mt-1">Manage website images</p>
            </div>
            <Link
                :href="route('admin.gallery.create')"
                class="inline-flex items-center px-4 py-2 bg-stone-900 text-white text-sm font-medium rounded-lg hover:bg-stone-800"
            >
                + Add Image
            </Link>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <div
                v-for="image in images.data"
                :key="image.id"
                class="bg-white rounded-xl border border-stone-200 overflow-hidden group"
            >
                <div class="aspect-[4/3] overflow-hidden">
                    <img
                        :src="image.image_path"
                        :alt="image.alt_text || image.title"
                        class="w-full h-full object-cover group-hover:scale-105 transition duration-300"
                    />
                </div>
                <div class="p-4">
                    <p class="font-medium text-stone-900 truncate">{{ image.title || 'Untitled' }}</p>
                    <p class="text-sm text-stone-500 mt-1">Order: {{ image.sort_order }}</p>
                    <div class="flex items-center justify-between mt-3">
                        <span
                            class="text-xs px-2 py-0.5 rounded-full"
                            :class="image.is_active ? 'bg-green-100 text-green-800' : 'bg-stone-100 text-stone-600'"
                        >
                            {{ image.is_active ? 'Active' : 'Hidden' }}
                        </span>
                        <div class="space-x-3">
                            <Link :href="route('admin.gallery.edit', image.id)" class="text-sm text-stone-600 hover:text-stone-900">
                                Edit
                            </Link>
                            <button @click="destroy(image.id)" class="text-sm text-red-600 hover:text-red-800">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="!images.data.length" class="text-center py-16 text-stone-500">
            No images yet. Add your first one!
        </div>
    </AdminLayout>
</template>