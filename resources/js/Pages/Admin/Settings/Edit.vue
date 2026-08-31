<script setup>
import { Head, useForm, Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

const props = defineProps({ settings: Object });

const form = useForm({
    hotel_address: props.settings.hotel_address || '',
    hotel_phone: props.settings.hotel_phone || '',
    hotel_email: props.settings.hotel_email || '',
    hotel_hours: props.settings.hotel_hours || '',
});

const submit = () => form.put(route('admin.settings.update'));
</script>

<template>
    <AdminLayout>
        <Head title="Hotel Settings" />

        <div class="mb-8">
            <h1 class="text-2xl font-bold text-stone-900">Hotel Contact Info</h1>
            <p class="text-stone-600 mt-1">This information appears on the website footer and contact page</p>
        </div>

        <form @submit.prevent="submit" class="bg-white rounded-xl border border-stone-200 p-8 max-w-2xl space-y-6">
            <div>
                <label class="block text-sm font-medium text-stone-700 mb-1">Address</label>
                <input v-model="form.hotel_address" type="text" class="w-full rounded-lg border-stone-300" />
            </div>
            <div>
                <label class="block text-sm font-medium text-stone-700 mb-1">Phone</label>
                <input v-model="form.hotel_phone" type="text" class="w-full rounded-lg border-stone-300" />
            </div>
            <div>
                <label class="block text-sm font-medium text-stone-700 mb-1">Email</label>
                <input v-model="form.hotel_email" type="email" class="w-full rounded-lg border-stone-300" />
            </div>
            <div>
                <label class="block text-sm font-medium text-stone-700 mb-1">Reception Hours</label>
                <input v-model="form.hotel_hours" type="text" class="w-full rounded-lg border-stone-300" />
            </div>

            <button type="submit" :disabled="form.processing" class="px-6 py-2.5 bg-stone-900 text-white rounded-lg">
                {{ form.processing ? 'Saving...' : 'Save Changes' }}
            </button>
        </form>
    </AdminLayout>
</template>