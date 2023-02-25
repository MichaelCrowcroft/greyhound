<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import CreateCompanyForm from './Partials/CreateCompanyForm.vue';
import { Link, Head } from '@inertiajs/vue3'

defineProps({
    companies: Object
})
</script>

<template>
    <Head title="Companies" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Companies</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 grid grid-cols-5 gap-4">
                <div v-for="company in companies" :key="company.id"
                    class="w-full mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg"
                    :class="{ 'bg-green-100': company.is_primary }"
                >
                    <Link :href="'/companies/' + company.id" class="font-semibold text-lg">
                        {{ company.name }}
                    </Link>
                    <p class="font-thin text-sm">{{ company.url }}</p>
                </div>
            </div>
            <div class="p-12" v-if="Object.keys(companies).length < 5">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <CreateCompanyForm />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
