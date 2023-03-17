<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

import { Head, Link } from '@inertiajs/vue3';

defineProps({
    landing_page: Object,
    company: Object
})
</script>

<template>
    <Head title="Landing Page" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <Link :href="'/companies'">Companies</Link> /
                <Link :href="'/companies/' + company.id">{{ company.name }}</link> /
                {{ landing_page.name }}
            </h2>
        </template>

        <div class="py-12">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            </div>
        </div>
    </AuthenticatedLayout>
</template>
