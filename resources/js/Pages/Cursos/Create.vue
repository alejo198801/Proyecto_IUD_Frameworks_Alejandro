<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head,useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const form = useForm({
    name:'',
    description:'',
    duration:'',
});
</script>

<template>
    <Head title="Crear Cursos"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-4 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form @submit.prevent="form.post(route('cursos.store'))" class="mt-6 space-y-6 max-w-xl">
                    <InputLabel for="name" value="Curso"></InputLabel>
                    <TextInput id='name' v-model="form.name" autofocus required type="text" class="mt-1 block w-full"></TextInput>
                    <InputError :message="form.errors.name" class="mt-2"></InputError>
                    <InputLabel for="description" value="Descripción"></InputLabel>
                    <TextInput id="description" v-model="form.description" autofocus required type="text" class="mt-1 block w-full"></TextInput>
                    <InputError :message="form.errors.description" class="mt-2"></InputError>
                    <InputLabel for="duration" value="duración"></InputLabel>
                    <TextInput id="duration" v-model="form.duration" autofocus required type="text" class="mt-1 block w-full"></TextInput>
                    <InputError :message="form.errors.duration" class="mt-2"></InputError>
                    <PrimaryButton :disabled="form.processing"> 
                        <i class="fa-solid fa-save"> Guardar </i>
                    </PrimaryButton>
                </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
