<script setup>
import { Head } from '@inertiajs/vue3';
import PublicLayout from '@/Layouts/PublicLayout.vue';
import { ref } from 'vue';

defineProps({
    images: Array,
});

const selectedImage = ref(null);
</script>

<template>
    <PublicLayout>
        <Head title="Gallery" />

        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center mb-16">
                <h1 class="text-4xl md:text-5xl font-serif font-bold text-stone-900 mb-4">Gallery</h1>
                <p class="text-stone-600 text-lg">A glimpse into life at Duule Luxury Hotel</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div
                    v-for="image in images"
                    :key="image.id"
                    class="group relative aspect-[4/3] overflow-hidden rounded-2xl cursor-pointer"
                    @click="selectedImage = image"
                >
                    <img
                        :src="image.image_path"
                        :alt="image.alt_text || image.title"
                        class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                    />
                    <div class="absolute inset-0 bg-gradient-to-t from-stone-900/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition">
                        <div class="absolute bottom-4 left-4 right-4">
                            <p class="text-white font-medium">{{ image.title }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Lightbox -->
        <div
            v-if="selectedImage"
            class="fixed inset-0 z-50 bg-black/90 flex items-center justify-center p-4"
            @click.self="selectedImage = null"
        >
            <button
                @click="selectedImage = null"
                class="absolute top-6 right-6 text-white text-3xl hover:text-stone-300"
            >
                ×
            </button>
            <img
                :src="selectedImage.image_path"
                :alt="selectedImage.alt_text"
                class="max-h-[85vh] max-w-full rounded-lg object-contain"
            />
        </div>
    </PublicLayout>
</template>