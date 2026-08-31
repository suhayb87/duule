<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

defineProps({
    message: Object,
});

const destroy = (id) => {
    if (confirm('Delete this message permanently?')) {
        router.delete(route('admin.messages.destroy', id));
    }
};
</script>

<template>
    <AdminLayout>
        <Head title="View Message" />

        <div class="mb-8">
            <Link :href="route('admin.messages.index')" class="text-sm text-stone-600 hover:text-stone-900">
                ← Back to Messages
            </Link>
            <h1 class="text-2xl font-bold text-stone-900 mt-2">Message from {{ message.name }}</h1>
        </div>

        <div class="bg-white rounded-xl border border-stone-200 p-8 max-w-3xl">
            <div class="grid sm:grid-cols-2 gap-6 mb-8">
                <div>
                    <p class="text-sm text-stone-500">From</p>
                    <p class="font-medium text-stone-900">{{ message.name }}</p>
                    <p class="text-stone-600">{{ message.email }}</p>
                </div>

                <div>
                    <p class="text-sm text-stone-500">Phone</p>
                    <p class="font-medium text-stone-900">
                        <a v-if="message.phone" :href="`tel:${message.phone}`" class="hover:underline">
                            {{ message.phone }}
                        </a>
                        <span v-else class="text-stone-400">—</span>
                    </p>
                </div>

                <div>
                    <p class="text-sm text-stone-500">Received</p>
                    <p class="font-medium text-stone-900">
                        {{ new Date(message.created_at).toLocaleString() }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-stone-500">Status</p>
                    <p class="font-medium">
                        <span
                            class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-medium"
                            :class="message.is_read ? 'bg-stone-100 text-stone-600' : 'bg-blue-100 text-blue-800'"
                        >
                            {{ message.is_read ? 'Read' : 'Unread' }}
                        </span>
                    </p>
                </div>

                <div class="sm:col-span-2">
                    <p class="text-sm text-stone-500">Subject</p>
                    <p class="font-medium text-stone-900">{{ message.subject || 'No subject' }}</p>
                </div>
            </div>

            <div class="border-t border-stone-200 pt-6">
                <p class="text-sm text-stone-500 mb-2">Message</p>
                <div class="prose prose-stone max-w-none text-stone-800 whitespace-pre-wrap">
                    {{ message.message }}
                </div>
            </div>

            <div class="mt-10 flex flex-wrap gap-3">
                <a
                    :href="`mailto:${message.email}?subject=Re: ${message.subject || 'Your message'}`"
                    class="px-5 py-2.5 bg-stone-900 text-white rounded-lg hover:bg-stone-800 text-sm font-medium"
                >
                    Reply by Email
                </a>

                <a
                    v-if="message.phone"
                    :href="`tel:${message.phone}`"
                    class="px-5 py-2.5 bg-green-600 text-white rounded-lg hover:bg-green-700 text-sm font-medium"
                >
                    Call Guest
                </a>

                <button
                    @click="destroy(message.id)"
                    class="px-5 py-2.5 border border-red-200 text-red-600 rounded-lg hover:bg-red-50 text-sm font-medium"
                >
                    Delete Message
                </button>
            </div>
        </div>
    </AdminLayout>
</template>