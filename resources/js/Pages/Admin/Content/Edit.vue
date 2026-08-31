<script setup>
import { Head, useForm, Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

const props = defineProps({
    content: Object,
});

const form = useForm({
    title: props.content.title || '',
    content: props.content.content || '',
    image: props.content.image || '',
});

const submit = () => {
    form.put(route('admin.content.update', props.content.id));
};
</script>

<template>
    <AdminLayout>
        <Head title="Edit Content" />

        <div class="mb-8">
            <Link :href="route('admin.content.index')" class="text-sm text-stone-600 hover:text-stone-900">
                ← Back to Content
            </Link>
            <h1 class="text-2xl font-bold text-stone-900 mt-2">
                Edit: {{ content.page }} → {{ content.section.replace('_', ' ') }}
            </h1>
        </div>

        <form @submit.prevent="submit" class="bg-white rounded-xl border border-stone-200 p-8 max-w-3xl space-y-6">
            <div>
                <label class="block text-sm font-medium text-stone-700 mb-1">Title</label>
                <input
                    v-model="form.title"
                    type="text"
                    class="w-full rounded-lg border-stone-300 focus:border-stone-500 focus:ring-stone-500"
                />
            </div>

            <div>
                <label class="block text-sm font-medium text-stone-700 mb-1">Content</label>
                <textarea
                    v-model="form.content"
                    rows="8"
                    class="w-full rounded-lg border-stone-300 focus:border-stone-500 focus:ring-stone-500"
                ></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-stone-700 mb-1">Image URL (optional)</label>
                <input
                    v-model="form.image"
                    type="url"
                    class="w-full rounded-lg border-stone-300 focus:border-stone-500 focus:ring-stone-500"
                    placeholder="https://..."
                />
            </div>

            <div class="flex gap-4 pt-4">
                <button
                    type="submit"
                    :disabled="form.processing"
                    class="px-6 py-2.5 bg-stone-900 text-white rounded-lg hover:bg-stone-800 disabled:opacity-50"
                >
                    {{ form.processing ? 'Saving...' : 'Update Content' }}
                </button>
                <Link
                    :href="route('admin.content.index')"
                    class="px-6 py-2.5 border border-stone-300 rounded-lg text-stone-700 hover:bg-stone-50"
                >
                    Cancel
                </Link>
            </div>
        </form>
    </AdminLayout>
</template>