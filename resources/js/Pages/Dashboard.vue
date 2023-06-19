<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">Bienvenido a Este sistema
                        <h2> </h2>
                        <h2>Navege por los menus superiores ....Gracias.</h2>                        
                    </div>
                </div>
            </div>
        </div>
        <div>
            <img src="C:\laragon\www\Proyecto-iud\storage\imagenes\pexels-markus-spiske-965345.jpg"/>
        </div>
    </AuthenticatedLayout>
</template>
