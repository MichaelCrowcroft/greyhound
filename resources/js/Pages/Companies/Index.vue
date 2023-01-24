<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import CreateCompanyForm from './Partials/CreateCompanyForm.vue';
import { Link } from '@inertiajs/vue3'
import { Head } from '@inertiajs/vue3';

defineProps({ companies: Object })
</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Profile</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div v-for="company in companies" :key="company.id"
                        class="w-full mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                    <Link :href="'/companies/' + company.id">
                        {{ company.name }}
                    </Link>
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <CreateCompanyForm />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
