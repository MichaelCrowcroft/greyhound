<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';

const emit = defineEmits(['update:open']);

const props = defineProps({
    company: Object
})

const form = useForm({
    name: props.company.name,
});

let submit = () => {
    form.patch('/companies/' + props.company.id, {
        preserveScroll: true,
        onSuccess: () => emit('update:open', false),
    })
}
</script>

<template>
    <form @submit.prevent="submit" class="space-x-4 flex">
        <div>
            <TextInput
                id="name"
                type="text"
                class="block w-full"
                v-model="form.name"
                required
                autofocus
                autocomplete="name"
            />
        </div>
        <div class="flex items-center gap-4">
            <PrimaryButton :disabled="form.processing">Save</PrimaryButton>
        </div>
    </form>
</template>
