<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import PublicLayout from '@/Layouts/PublicLayout.vue';

const form = useForm({
    name: '',
    email: '',
    phone: '',
    subject: '',
    message: '',
});

const submit = () => {
    form.post(route('contact.store'), {
        onSuccess: () => form.reset(),
    });
};
</script>

<template>
    <PublicLayout>
        <Head title="Contact Us" />

        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center mb-16">
                <h1 class="text-4xl md:text-5xl font-serif font-bold text-stone-900 mb-4">Contact Us</h1>
                <p class="text-stone-600 text-lg">We’d love to hear from you</p>
            </div>

            <div class="grid lg:grid-cols-2 gap-16">
                <!-- Contact Info -->
                <div>
                    <h2 class="text-2xl font-serif font-bold text-stone-900 mb-8">Get in Touch</h2>
                    <div class="space-y-6 text-stone-600">
                        <div>
                            <p class="font-semibold text-stone-900">Address</p>
                            <p>Coastal Road 42, Seaside Bay</p>
                        </div>
                        <div>
                            <p class="font-semibold text-stone-900">Phone</p>
                            <p>+1 (555) 123-4567</p>
                        </div>
                        <div>
                            <p class="font-semibold text-stone-900">Email</p>
                            <p>hello@duulehotel.com</p>
                        </div>
                        <div>
                            <p class="font-semibold text-stone-900">Reception Hours</p>
                            <p>24/7</p>
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <div class="bg-white rounded-2xl shadow-sm border border-stone-200 p-8">
                    <form @submit.prevent="submit" class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-stone-700 mb-1">Name</label>
                            <input
                                v-model="form.name"
                                type="text"
                                required
                                class="w-full rounded-lg border-stone-300 focus:border-stone-500 focus:ring-stone-500"
                            />
                            <div v-if="form.errors.name" class="text-red-600 text-sm mt-1">{{ form.errors.name }}</div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-stone-700 mb-1">Email</label>
                            <input
                                v-model="form.email"
                                type="email"
                                required
                                class="w-full rounded-lg border-stone-300 focus:border-stone-500 focus:ring-stone-500"
                            />
                            <div v-if="form.errors.email" class="text-red-600 text-sm mt-1">{{ form.errors.email }}</div>
                        </div>

                        <!-- Phone field (correct place) -->
                        <div>
                            <label class="block text-sm font-medium text-stone-700 mb-1">Phone</label>
                            <input
                                v-model="form.phone"
                                type="tel"
                                class="w-full rounded-lg border-stone-300 focus:border-stone-500 focus:ring-stone-500"
                                placeholder="+1 555 123 4567"
                            />
                            <div v-if="form.errors.phone" class="text-red-600 text-sm mt-1">{{ form.errors.phone }}</div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-stone-700 mb-1">Subject</label>
                            <input
                                v-model="form.subject"
                                type="text"
                                class="w-full rounded-lg border-stone-300 focus:border-stone-500 focus:ring-stone-500"
                            />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-stone-700 mb-1">Message</label>
                            <textarea
                                v-model="form.message"
                                rows="5"
                                required
                                class="w-full rounded-lg border-stone-300 focus:border-stone-500 focus:ring-stone-500"
                            ></textarea>
                            <div v-if="form.errors.message" class="text-red-600 text-sm mt-1">{{ form.errors.message }}</div>
                        </div>

                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="w-full py-3 bg-stone-900 text-white font-semibold rounded-full hover:bg-stone-800 transition disabled:opacity-50"
                        >
                            {{ form.processing ? 'Sending...' : 'Send Message' }}
                        </button>

                        <div v-if="form.recentlySuccessful" class="text-green-600 text-center text-sm">
                            Message sent successfully. We’ll get back to you soon!
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </PublicLayout>
</template>