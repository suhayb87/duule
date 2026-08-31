<script setup>
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const mobileMenuOpen = ref(false);

const navigation = [
    { name: 'Home', href: route('home') },
    { name: 'About', href: route('about') },
    { name: 'Gallery', href: route('gallery') },
    { name: 'Booking', href: route('booking') },
    { name: 'Contact', href: route('contact') },
];
</script>

<template>
    <div class="min-h-screen bg-stone-50 text-stone-800">
        <!-- Navigation -->
        <header class="fixed top-0 inset-x-0 z-50 bg-white/90 backdrop-blur-md border-b border-stone-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <!-- Logo -->
                    <Link :href="route('home')" class="flex items-center gap-2">
                        <span class="text-2xl font-serif font-bold tracking-tight text-stone-900">Duule Luxury Hotel</span>
                    </Link>

                    <!-- Desktop Nav -->
                    <nav class="hidden md:flex items-center gap-8">
                        <Link
                            v-for="item in navigation"
                            :key="item.name"
                            :href="item.href"
                            class="text-sm font-medium text-stone-600 hover:text-stone-900 transition"
                            :class="{ 'text-stone-900 font-semibold': $page.url === item.href || ($page.url.startsWith(item.href) && item.href !== '/') }"
                        >
                            {{ item.name }}
                        </Link>
                    </nav>

                    <!-- CTA -->
                    <div class="hidden md:block">
                        <Link
                            :href="route('booking')"
                            class="inline-flex items-center px-5 py-2.5 bg-stone-900 text-white text-sm font-medium rounded-full hover:bg-stone-800 transition"
                        >
                            Book Now
                        </Link>
                    </div>

                    <!-- Mobile menu button -->
                    <button
                        @click="mobileMenuOpen = !mobileMenuOpen"
                        class="md:hidden p-2 rounded-md text-stone-600"
                    >
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path v-if="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile menu -->
            <div v-show="mobileMenuOpen" class="md:hidden border-t border-stone-200 bg-white">
                <div class="px-4 py-3 space-y-1">
                    <Link
                        v-for="item in navigation"
                        :key="item.name"
                        :href="item.href"
                        class="block px-3 py-2 rounded-md text-base font-medium text-stone-700 hover:bg-stone-100"
                        @click="mobileMenuOpen = false"
                    >
                        {{ item.name }}
                    </Link>
                    <Link
                        :href="route('booking')"
                        class="block mt-3 text-center px-4 py-2.5 bg-stone-900 text-white rounded-full"
                        @click="mobileMenuOpen = false"
                    >
                        Book Now
                    </Link>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="pt-16">
            <slot />
        </main>

        <!-- Footer -->
        <footer class="bg-stone-900 text-stone-300 mt-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                    <div class="md:col-span-2">
                        <h3 class="text-2xl font-serif font-bold text-white mb-4">Duule Luxury Hotel</h3>
                        <p class="text-stone-400 max-w-md">
                            A boutique beachfront hotel offering refined comfort, exceptional service, and unforgettable ocean views.
                        </p>
                    </div>
                    <div>
                        <h4 class="text-white font-semibold mb-4">Explore</h4>
                        <ul class="space-y-2">
                            <li v-for="item in navigation" :key="item.name">
                                <Link :href="item.href" class="hover:text-white transition">{{ item.name }}</Link>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-white font-semibold mb-4">Contact</h4>
                        <ul class="space-y-2 text-stone-400">
                            <li>Coastal Road 42</li>
                            <li>Seaside Bay</li>
                            <li>+1 (555) 123-4567</li>
                            <li>hello@duulehotel.com</li>
                        </ul>
                    </div>
                </div>
                <div class="border-t border-stone-800 mt-12 pt-8 text-center text-sm text-stone-500">
                    © {{ new Date().getFullYear() }} Duule Luxury Hotel. All rights reserved.
                </div>
            </div>
        </footer>
    </div>
</template>