<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import EditCompanyNameForm from './Partials/EditCompanyNameForm.vue';
import Line from './Partials/Line.vue';

import { ref } from 'vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    company: Object,
})
const editingCompanyName = ref(false);
</script>

<template>
    <Head title="Company" />

    <AuthenticatedLayout>
        <template #header>
            <div v-if="!editingCompanyName" class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ company.name }}</h2>
                <button @click="editingCompanyName = !editingCompanyName">Edit</button>
            </div>
            <div v-if="editingCompanyName" class="flex justify-between">
                <EditCompanyNameForm :company="company" v-model:open="editingCompanyName"/>
                <button class="pl-4" @click="editingCompanyName = !editingCompanyName">Cancel</button>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="w-full mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                    <Line :company="company" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
