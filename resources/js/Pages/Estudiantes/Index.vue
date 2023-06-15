<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DangerButton from '@/Components/DangerButton.vue';
import { Head,useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import SelectInput from '@/Components/SelectInput.vue';
import WarningButton from '@/Components/WarningButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import Modal from '@/Components/Modal.vue';
import { nextTick,ref } from 'vue';
import VueTailwindpagination from '@ocrv/vue-tailwind-pagination';


const nameInput= ref(null);
const modal=ref(false);
const title=ref('');
const operation=ref(1);
const id=ref('');

const props = defineProps({
    cursos: { type: Object },
    estudiantes: { type: Object },
});
const form = useForm({
    name:'',
    email:'',
    phone:'',
    curso_id:''
});
const formPage= useForm({});
const onPageClick = (event)=>{
    formPage.get(route('estudiantes.index',{page:event}))
}
const OpenModal = (op,name,email,phone,curso,estudiante)=>{
    modal.value=true;
    nextTick( ()=>nameInput.value.focus())
    operation.value=op;
    id.value=estudiante;
    if (op==1) {
        title.value='Crear estudiante';        
    }
    else{
        title.value='Editar estudiante';
        form.name=name;
        form.email=email;
        form.phone=phone;
        form.curso_id=curso;
    }
}
const CloseModal=()=>{
    modal.value=false;
    form.reset();
}
const save=()=>{
    if (operation.value==1) {
        form.post(route('estudiantes.store'),{onSuccess:()=>{ok('Estudiante Creado')}});        
    }
    else{
        form.put(route('estudiantes.update', id.value),{onSuccess: ()=>{ok('Estudiante Actualizado')}});
    }
}
const ok=(msj)=>{

    form.reset();
    CloseModal();
    Swal.fire({title:msj,icon:'success'})
}
    
const deleteEstudiante = (id, name) => {
    const alerta = Swal.mixin({
        buttonsStyling: true
    });
    alerta.fire({
        title: 'Seguro desea eliminar ' + name + '?',
        icon: 'question', showCancelButton: true,        
        confirmButtonText: '<i class ="fa-solid fa-check"></i> Aceptar',
    }).then((result) => {
        if (result.isConfirmed) {
            form.delete(route('estudiantes.destroy', id),{onSuccess:()=>{ok('Estudiante Eliminado')}});
        }
    })
}

</script>
<template>
    <Head title="Cursos" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Estudiantes</h2>
        </template>

        <div class="py-12">
            <div class=" bg-white grid v-screen place-items-center">
                <div class="mt-3 mb-3 flex">
                   <PrimaryButton @click="OpenModal(1)">
                    <i class="fa-solid fa-plus-circle"></i>
                   </PrimaryButton>
                </div>
            </div>

            <div class=" bg-white grid v-screen place-items-center overflow-x-auto">
                <table class="table-auto border border-gray-400">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-2 py-2">#</th>
                            <th class="px-2 py-2">Nombre</th>
                            <th class="px-2 py-2">Email</th>
                            <th class="px-2 py-2">Teléfono</th>
                            <th class="px-2 py-2">Departamento</th>                            
                            <th class="px-2 py-2"></th>
                            <th class="px-2 py-2"></th>
                        </tr>

                    </thead>
                    <tbody>
                        <tr v-for="est, i in estudiantes.data" :key="est.id">
                            <td class="border border-gray-400 px-2 py-2">{{ (i + 1) }}</td>
                            <td class="border border-gray-400 px-2 py-2">{{ (est.name) }}</td>
                            <td class="border border-gray-400 px-2 py-2">{{ (est.email) }}</td>
                            <td class="border border-gray-400 px-2 py-2">{{ (est.phone) }}</td>                            
                            <td class="border border-gray-400 px-2 py-2">{{ (est.curso) }}</td>                            
                            <td class="border border-gray-400 px-2 py-2">
                                <WarningButton @click="OpenModal(2,est.name,est.email,est.phone,est.curso_id,est.id)">
                                    <i class="fa-solid fa-edit"></i>
                                </WarningButton>
                               
                            </td>
                            <td class="border border-gray-400 px-2 py-2">
                                <DangerButton @click="deleteEstudiante(est.id,est.name)">
                                    <i class="fa-solid fa-trash"></i>  
                                </DangerButton>
                            </td>

                        </tr>
                    </tbody>

                </table>
            </div>
             <div class=" bg-white grid v-screen place-items-center">
                <VueTailwindpagination
                :current="estudiantes.currentPage" :total="estudiantes.total"                
                :per-page="estudiantes.perPage"
                @page-changed="onPageClick($event)">
                </VueTailwindpagination>
             </div>
        </div>
        <Modal :show="modal" @close="CloseModal">
            <h2 class="p-3 text-lg font.medium text-hray-900">{{ title }}</h2>
            <div class="p-3">
                <InputLabel for="name" value="name"></InputLabel>
                <TextInput id="name" ref="nameInput"
                v-model="form.name" type="text" class="mt-1 block w-3/4"
                placeholder="Name"></TextInput>
                <InputError :message="form.errors.name" class="mt-2"></InputError>
            </div>
            <div class="p-3">
                <InputLabel for="email" value="email"></InputLabel>
                <TextInput id="email"
                v-model="form.email" type="text" class="mt-1 block w-3/4"
                placeholder="Email"></TextInput>
                <InputError :message="form.errors.name" class="mt-2"></InputError>
            </div>
            <div class="p-3">
                <InputLabel for="phone" value="phone"></InputLabel>
                <TextInput id="phone"
                v-model="form.phone" type="text" class="mt-1 block w-3/4"
                placeholder="Phone"></TextInput>
                <InputError :message="form.errors.name" class="mt-2"></InputError>
            </div>
            <div class="p-3">
                <InputLabel for="curso_id" value="Curso"></InputLabel>
                <SelectInput id="curso_id" :options="cursos"
                 v-model="form.curso_id" type="text" class="mt-1 block w-3/4"
                ></SelectInput>
                <InputError :message="form.errors.curso_id" class="mt-2"></InputError>
            </div>
            <div class="p-3 mt-6">
                <PrimaryButton :disable="form.processing" @click="save">
                    <i class="fa-solid fa-save"></i> Guardar
                </PrimaryButton>
            </div>
            <div class="p-3 mt-6 flex justify-end">
                <SecondaryButton class="ml-3" :disable="form.processing" @click="CloseModal">
                    Cancelar
                </SecondaryButton>

            </div>            
        </Modal>
    </AuthenticatedLayout>
</template>