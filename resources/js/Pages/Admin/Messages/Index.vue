<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

defineProps({
    messages: Object,
});

const destroy = (id) => {
    if (confirm('Delete this message permanently?')) {
        router.delete(route('admin.messages.destroy', id));
    }
};
</script>

<template>
    <AdminLayout>
        <Head title="Messages" />

        <div class="mb-8">
            <h1 class="text-2xl font-bold text-stone-900">Contact Messages</h1>
            <p class="text-stone-600 mt-1">Messages sent from the website contact form</p>
        </div>

        <div class="bg-white rounded-xl border border-stone-200 overflow-hidden">
            <table class="min-w-full divide-y divide-stone-200">
                <thead class="bg-stone-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-stone-500 uppercase">From</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-stone-500 uppercase">Subject</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-stone-500 uppercase">Received</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-stone-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-stone-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100">
                    <tr
                        v-for="message in messages.data"
                        :key="message.id"
                        class="hover:bg-stone-50"
                        :class="{ 'bg-blue-50/50': !message.is_read }"
                    >
                        <td class="px-6 py-4">
                            <p class="font-medium text-stone-900">{{ message.name }}</p>
                            <p class="text-sm text-stone-500">{{ message.email }}</p>
                        </td>
                        <td class="px-6 py-4 text-stone-700">
                            {{ message.subject || '—' }}
                        </td>
                        <td class="px-6 py-4 text-sm text-stone-500">
                            {{ new Date(message.created_at).toLocaleDateString() }}
                        </td>
                        <td class="px-6 py-4">
                            <span
                                class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-medium"
                                :class="message.is_read ? 'bg-stone-100 text-stone-600' : 'bg-blue-100 text-blue-800'"
                            >
                                {{ message.is_read ? 'Read' : 'Unread' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right space-x-3">
                            <Link
                                :href="route('admin.messages.show', message.id)"
                                class="text-sm text-stone-600 hover:text-stone-900"
                            >
                                View
                            </Link>
                            <button @click="destroy(message.id)" class="text-sm text-red-600 hover:text-red-800">
                                Delete
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div v-if="!messages.data.length" class="px-6 py-16 text-center text-stone-500">
                No messages yet.
            </div>
        </div>
    </AdminLayout>
</template>