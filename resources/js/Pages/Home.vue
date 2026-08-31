<script setup>
import { Head, Link } from '@inertiajs/vue3';
import PublicLayout from '@/Layouts/PublicLayout.vue';

defineProps({
    rooms: Array,
    content: Object,
});
</script>

<template>
    <PublicLayout>
        <Head title="Home" />

        <!-- Hero -->
        <section class="relative h-[85vh] flex items-center justify-center overflow-hidden">
            <img
                src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/31/cf/94/98/caption.jpg?w=900&h=500&s=1"
                alt="Hotel infinity pool"
                class="absolute inset-0 w-full h-full object-cover"
            />
            <div class="absolute inset-0 bg-stone-900/50"></div>
            <div class="relative z-10 text-center text-white px-4 max-w-4xl">
                <h1 class="text-5xl md:text-7xl font-serif font-bold mb-6 leading-tight">
                    {{ content?.hero_title || 'Experience Luxury by the Sea' }}
                </h1>
                <p class="text-xl md:text-2xl text-stone-200 mb-10 max-w-2xl mx-auto">
                    {{ content?.hero_subtitle || 'Discover unparalleled comfort and breathtaking views.' }}
                </p>
                <Link
                    :href="route('booking')"
                    class="inline-flex items-center px-8 py-4 bg-white text-stone-900 font-semibold rounded-full hover:bg-stone-100 transition text-lg"
                >
                    Check Availability
                </Link>
            </div>
        </section>

        <!-- Welcome -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
            <div class="grid md:grid-cols-2 gap-16 items-center">
                <div>
                    <h2 class="text-4xl font-serif font-bold text-stone-900 mb-6">
                        {{ content?.welcome_title || 'Welcome to Duule Luxury Hotel' }}
                    </h2>
                    <p class="text-lg text-stone-600 leading-relaxed mb-8">
                        {{ content?.welcome || 'Nestled on a pristine stretch of coastline...' }}
                    </p>
                    <Link :href="route('about')" class="text-stone-900 font-semibold underline underline-offset-4 hover:text-stone-600">
                        Learn more about us →
                    </Link>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSm8hsVSg_8TfsOBVhBOmqTYE4K9dQpE07mn112E6vLIQ&s=10" alt="Lobby" />
                    <img src="https://images.unsplash.com/photo-1540555700478-4be289fbecef?w=600&q=80" class="rounded-2xl object-cover h-64 w-full mt-8" alt="Spa" />
                </div>
            </div>
        </section>

        <!-- Featured Rooms -->
        <section class="bg-white py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-serif font-bold text-stone-900 mb-4">Our Rooms & Suites</h2>
                    <p class="text-stone-600 text-lg">Carefully designed spaces for every kind of stay</p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div
                        v-for="room in rooms"
                        :key="room.id"
                        class="group bg-stone-50 rounded-2xl overflow-hidden hover:shadow-xl transition duration-300"
                    >
                        <div class="aspect-[4/3] overflow-hidden">
                            <img
                                :src="room.image"
                                :alt="room.name"
                                class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                            />
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-stone-900 mb-2">{{ room.name }}</h3>
                            <p class="text-stone-600 text-sm mb-4 line-clamp-2">{{ room.description }}</p>
                            <div class="flex items-center justify-between">
                                <span class="text-lg font-bold text-stone-900">${{ Number(room.price_per_night).toFixed(0) }}<span class="text-sm font-normal text-stone-500"> / night</span></span>
                                <Link :href="route('booking')" class="text-sm font-medium text-stone-900 underline">Book</Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA -->
        <section class="py-24">
            <div class="max-w-4xl mx-auto px-4 text-center">
                <h2 class="text-4xl font-serif font-bold text-stone-900 mb-6">Ready for your escape?</h2>
                <p class="text-lg text-stone-600 mb-10">Reserve your preferred room and start counting down the days.</p>
                <Link
                    :href="route('booking')"
                    class="inline-flex px-8 py-4 bg-stone-900 text-white font-semibold rounded-full hover:bg-stone-800 transition"
                >
                    Book Your Stay
                </Link>
            </div>
        </section>
    </PublicLayout>
</template>