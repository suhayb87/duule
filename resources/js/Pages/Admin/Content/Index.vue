<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

defineProps({
    contents: Object, // grouped by page
});
</script>

<template>
    <AdminLayout>
        <Head title="Page Content" />

        <div class="mb-8">
            <h1 class="text-2xl font-bold text-stone-900">Page Content</h1>
            <p class="text-stone-600 mt-1">Edit text content shown on the public website</p>
        </div>

        <div class="space-y-10">
            <div v-for="(sections, page) in contents" :key="page">
                <h2 class="text-lg font-semibold text-stone-900 capitalize mb-4">{{ page }} Page</h2>

                <div class="bg-white rounded-xl border border-stone-200 overflow-hidden">
                    <table class="min-w-full divide-y divide-stone-200">
                        <thead class="bg-stone-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-stone-500 uppercase">Section</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-stone-500 uppercase">Title</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-stone-500 uppercase">Content Preview</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-stone-500 uppercase">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-stone-100">
                            <tr v-for="item in sections" :key="item.id" class="hover:bg-stone-50">
                                <td class="px-6 py-4 font-medium text-stone-900 capitalize">
                                    {{ item.section.replace('_', ' ') }}
                                </td>
                                <td class="px-6 py-4 text-stone-700">
                                    {{ item.title || '—' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-stone-500 max-w-md truncate">
                                    {{ item.content || '—' }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <Link
                                        :href="route('admin.content.edit', item.id)"
                                        class="text-sm text-stone-600 hover:text-stone-900 font-medium"
                                    >
                                        Edit
                                    </Link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div v-if="Object.keys(contents).length === 0" class="text-center py-16 text-stone-500">
                No content found. Run the seeder first.
            </div>
        </div>
    </AdminLayout>
</template>