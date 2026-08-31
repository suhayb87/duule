<script setup>
import { Head } from '@inertiajs/vue3';
import PublicLayout from '@/Layouts/PublicLayout.vue';

defineProps({
    content: Object,
});
</script>

<template>
    <PublicLayout>
        <Head title="About Us" />

        <!-- Hero -->
        <section class="relative h-[50vh] flex items-center justify-center">
            <img
                src="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=1600&q=80"
                class="absolute inset-0 w-full h-full object-cover"
                alt="Hotel lobby"
            />
            <div class="absolute inset-0 bg-stone-900/50"></div>
            <h1 class="relative z-10 text-5xl md:text-6xl font-serif font-bold text-white">About Us</h1>
        </section>

        <section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
            <div class="prose prose-stone prose-lg mx-auto">
                <h2 class="text-3xl font-serif font-bold text-stone-900 mb-6">
                    {{ content?.story_title || 'Our Story' }}
                </h2>
                <p class="text-stone-600 leading-relaxed mb-12">
                    {{ content?.story || 'Founded in 2018...' }}
                </p>

                <h2 class="text-3xl font-serif font-bold text-stone-900 mb-6">
                    {{ content?.mission_title || 'Our Mission' }}
                </h2>
                <p class="text-stone-600 leading-relaxed mb-12">
                    {{ content?.mission || 'To provide every guest...' }}
                </p>

                <h2 class="text-3xl font-serif font-bold text-stone-900 mb-6">
                    {{ content?.values_title || 'Our Values' }}
                </h2>
                <p class="text-stone-600 leading-relaxed">
                    {{ content?.values || 'Excellence • Authenticity • Sustainability • Warmth • Attention to Detail' }}
                </p>
            </div>
        </section>

        <!-- Image strip -->
        <section class="grid grid-cols-2 md:grid-cols-4 gap-1">
            <img src="https://images.unsplash.com/photo-1571896349842-33c89424de2d?w=600&q=80" class="h-48 md:h-64 w-full object-cover" alt="" />
            <img src="https://images.unsplash.com/photo-1540555700478-4be289fbecef?w=600&q=80" class="h-48 md:h-64 w-full object-cover" alt="" />
            <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=600&q=80" class="h-48 md:h-64 w-full object-cover" alt="" />
            <img src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=600&q=80" class="h-48 md:h-64 w-full object-cover" alt="" />
        </section>
    </PublicLayout>
</template>