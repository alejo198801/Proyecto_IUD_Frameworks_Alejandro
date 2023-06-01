<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DangerButton from '@/Components/DangerButton.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';

const props = defineProps({
    cursos: { type: Object }
});
const form = useForm({
    id: ''
});
const deleteCursos = (id, name) => {
    const alerta = Swal.mixin({
        buttonsStyling: true
    });
    alerta.fire({
        title: 'Seguro desea eliminar ' + name + '?',
        icon: 'question', showCancelButton: true,        
        confirmButtonText: '<i class ="fa-solid fa-check"></i> Aceptar',
    }).then((result) => {
        if (result.isConfirmed) {
            form.delete(route('cursos.destroy', id));
        }
    })
}

</script>
<template>
    <Head title="Cursos" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Cursos</h2>
        </template>

        <div class="py-12">
            <div class=" bg-white grid v-screen place-items-center">
                <div class="mt-3 mb-3 flex">
                    <Link :href="route('cursos.create')"
                        class="px-4 py-2 bg-gray-800 text-white border rounded-md font-semibold text-xs ">
                    <i class="fa-solid fa-plus-circle"></i> Agregar
                    </Link>>
                </div>
            </div>

            <div class=" bg-white grid v-screen place-items-center">
                <table class="table-auto border border-gray-400">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-4">#</th>
                            <th class="px-4 py-4">Curso</th>
                            <th class="px-4 py-4">Descripción</th>
                            <th class="px-4 py-4">Duración</th>
                            <th class="px-4 py-4"></th>
                            <th class="px-4 py-4"></th>
                        </tr>

                    </thead>
                    <tbody>
                        <tr v-for="cur, i in cursos" :key="cur.id">
                            <td class="border border-gray-400 px-4 py-4">{{ (i + 1) }}</td>
                            <td class="border border-gray-400 px-4 py-4">{{ (cur.name) }}</td>
                            <td class="border border-gray-400 px-4 py-4">{{ (cur.description) }}</td>
                            <td class="border border-gray-400 px-4 py-4">{{ (cur.duration) }}</td>
                            <td class="border border-gray-400 px-4 py-4">
                                <Link :href="route('cursos.edit',cur.id)"
                                    class="px-4 py-2 bg-yellow-400 text-white border rounded-md font-semibold text-xs ">
                                <i class="fa-solid fa-edit"></i>
                                </Link>>
                            </td>
                            <td class="border border-gray-400 px-4 py-4">
                                <DangerButton @click="deleteCursos(cur.id,cur.name)">
                                    <i class="fa-solid fa-trash"></i>  
                                </DangerButton>
                            </td>

                        </tr>
                    </tbody>

                </table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>