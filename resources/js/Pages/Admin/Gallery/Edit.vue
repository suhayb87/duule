<script setup>
import { Head, useForm, Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

const props = defineProps({
    image: { type: Object, default: null },
});

const isEdit = !!props.image;

const form = useForm({
    title: props.image?.title || '',
    image_path: props.image?.image_path || '',
    alt_text: props.image?.alt_text || '',
    sort_order: props.image?.sort_order ?? 0,
    is_active: props.image?.is_active ?? true,
});

const submit = () => {
    if (isEdit) {
        form.put(route('admin.gallery.update', props.image.id));
    } else {
        form.post(route('admin.gallery.store'));
    }
};
</script>

<template>
    <AdminLayout>
        <Head :title="isEdit ? 'Edit Image' : 'Add Image'" />

        <div class="mb-8">
            <Link :href="route('admin.gallery.index')" class="text-sm text-stone-600 hover:text-stone-900">
                ← Back to Gallery
            </Link>
            <h1 class="text-2xl font-bold text-stone-900 mt-2">
                {{ isEdit ? 'Edit Image' : 'Add New Image' }}
            </h1>
        </div>

        <form @submit.prevent="submit" class="bg-white rounded-xl border border-stone-200 p-8 max-w-2xl space-y-6">
            <div>
                <label class="block text-sm font-medium text-stone-700 mb-1">Title</label>
                <input v-model="form.title" type="text" class="w-full rounded-lg border-stone-300 focus:border-stone-500 focus:ring-stone-500" />
            </div>

            <div>
                <label class="block text-sm font-medium text-stone-700 mb-1">Image URL</label>
                <input v-model="form.image_path" type="url" required class="w-full rounded-lg border-stone-300 focus:border-stone-500 focus:ring-stone-500" placeholder="https://images.unsplash.com/..." />
                <p class="text-xs text-stone-500 mt-1">Paste a direct image URL (Unsplash, etc.)</p>
            </div>

            <div v-if="form.image_path" class="rounded-lg overflow-hidden border border-stone-200">
                <img :src="form.image_path" alt="Preview" class="w-full h-48 object-cover" />
            </div>

            <div>
                <label class="block text-sm font-medium text-stone-700 mb-1">Alt Text</label>
                <input v-model="form.alt_text" type="text" class="w-full rounded-lg border-stone-300 focus:border-stone-500 focus:ring-stone-500" />
            </div>

            <div>
                <label class="block text-sm font-medium text-stone-700 mb-1">Sort Order</label>
                <input v-model="form.sort_order" type="number" min="0" class="w-full rounded-lg border-stone-300 focus:border-stone-500 focus:ring-stone-500" />
            </div>

            <div class="flex items-center gap-2">
                <input v-model="form.is_active" type="checkbox" id="is_active" class="rounded border-stone-300" />
                <label for="is_active" class="text-sm text-stone-700">Visible on website</label>
            </div>

            <div class="flex gap-4 pt-4">
                <button
                    type="submit"
                    :disabled="form.processing"
                    class="px-6 py-2.5 bg-stone-900 text-white rounded-lg hover:bg-stone-800 disabled:opacity-50"
                >
                    {{ form.processing ? 'Saving...' : (isEdit ? 'Update Image' : 'Add Image') }}
                </button>
                <Link :href="route('admin.gallery.index')" class="px-6 py-2.5 border border-stone-300 rounded-lg text-stone-700 hover:bg-stone-50">
                    Cancel
                </Link>
            </div>
        </form>
    </AdminLayout>
</template>