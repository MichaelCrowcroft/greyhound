<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    company: Object
})

const form = useForm({
    url: null,
});

let submit = () => {
    form.post('/companies/' + props.company.id + '/lighthouse-report', {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        })
}
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Lighthouse Reports</h2>

            <p class="mt-1 text-sm text-gray-600">
                Create a Lighthouse repot
            </p>
        </header>

        <form @submit.prevent="submit" class="mt-6 space-y-6">
            <div>
                <InputLabel for="url" value="Url" />

                <TextInput
                    id="url"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.url"
                    required
                    autofocus
                    autocomplete="url"
                />

                <InputError class="mt-2" :message="form.errors.url" />
            </div>
            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
