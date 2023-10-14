<template>
    <AdminLayout>
        <div class="col-11 m-auto">
            <ul class="list-none p-0 m-0 flex align-items-center font-medium mb-3">
                <li>
                    <span class="text-900 line-height-3">Mails</span>
                </li>
            </ul>
        </div>
        <Toast />
        <div class="col-11 m-auto">
            <Dialog v-model:visible="visible" modal header="Send to users" :style="{ width: '50vw' }" position="top">
                <form @submit.prevent="send">
                    <div>
                        <p>Title</p>
                        <InputText type="text" v-model="form.title" class="w-full my-2"
                            :class="form.errors.title ? 'p-invalid' : ''" />
                        <div v-if="form.errors.title" class="text-red-500">{{ form.errors.title }}</div>
                    </div>
                    <div>
                        <p>Content</p>
                        <Textarea v-model="form.content" autoResize rows="5" cols="30" class="w-full my-2"
                            :class="form.errors.title ? 'p-invalid' : ''" />
                        <div v-if="form.errors.content" class="text-red-500">{{ form.errors.content }}</div>
                    </div>
                    <div class="flex justify-content-end my-3" >
                        <button type="button" style="background-color: transparent; outline: none;border: none;">
                            <Button type="submit" label="Send" />
                        </button>
                    </div>
                </form>
            </Dialog>

            <Dialog v-model:visible="isSubvisible" modal header="Send to subscriber" :style="{ width: '50vw' }" position="top">
                <form @submit.prevent="sendSub">
                    <div>
                        <p>Title</p>
                        <InputText type="text" v-model="SubForm.title" class="w-full my-2"
                            :class="SubForm.errors.title ? 'p-invalid' : ''" />
                        <div v-if="SubForm.errors.title" class="text-red-500">{{ SubForm.errors.title }}</div>
                    </div>
                    <div>
                        <p>Content</p>
                        <Textarea v-model="SubForm.content" autoResize rows="5" cols="30" class="w-full my-2"
                            :class="SubForm.errors.title ? 'p-invalid' : ''" />
                        <div v-if="SubForm.errors.content" class="text-red-500">{{ SubForm.errors.content }}</div>
                    </div>
                    <div class="flex justify-content-end my-3" >
                        <button type="button" style="background-color: transparent; outline: none;border: none;">
                            <Button type="submit" label="Send Sub" />
                        </button>
                    </div>
                </form>
            </Dialog>
            <div class="flex justify-content-end my-2">
                <span class="p-buttonset">
                    <Button label="Send" icon="pi pi-send" @click="sendUserBtn"
                        :disabled="selectedUser.length < 1" />
                    <Button label="Subscriber" icon="pi pi-users" @click="sendSubBtn" />
                </span>
            </div>
            <DataTable v-model:filters="filters" :globalFilterFields="['name', 'email', 'phone']" paginator :rows="5"
                :rowsPerPageOptions="[5, 10, 20, 50]" v-model:selection="selectedUser" :value="users" dataKey="id"
                tableStyle="min-width: 50rem">
                <template #header>
                    <div class="flex justify-content-end">
                        <span class="p-input-icon-left">
                            <i class="pi pi-search" />
                            <InputText v-model="filters['global'].value" placeholder="Keyword Search" />
                        </span>
                    </div>
                </template>
                <template #empty>
                    <div class="text-center">
                        No users found.
                    </div>
                </template>
                <Column selectionMode="multiple" headerStyle="width: 3rem"></Column>
                <Column field="name" header="Name"></Column>
                <Column field="email" header="Email"></Column>
                <Column field="phone" header="Phone"></Column>
            </DataTable>
        </div>
        <!-- {{ selectedUser }} -->
    </AdminLayout>
</template>

<script setup>
import AdminLayout from '../../../Layout/AdminLayout.vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import { FilterMatchMode } from 'primevue/api';
import { ref, watch } from 'vue';
import InputText from 'primevue/inputtext';
import Textarea from 'primevue/textarea';
import { useToast } from "primevue/usetoast";
import Toast from 'primevue/toast';
import Button from 'primevue/button';
import Dialog from 'primevue/dialog';
import { useForm } from '@inertiajs/vue3'


let { users } = defineProps({ users: Object})

const form = useForm({
    title: null,
    content: null,
    users: Array,
})


const SubForm = useForm({
    title: null,
    content: null,
})
const toast = useToast();

const selectedUser = ref([]);
watch(selectedUser, ()=>{
    form.users = [];
    selectedUser.value.map( (user) => {
        form.users.push(user.email);
    })
})

const visible = ref(false);
const isSubvisible = ref(false)
const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
})

const send = () => {
    form.post(route('mail.store'),{
        onSuccess: () => {
             toast.add({ severity: 'success', summary: 'Send mail', detail: 'your mail has successfully sent', life: 3000 });
             visible.value = false;
             selectedUser.value = [];
        },
        onError : () =>{
            toast.add({ severity: 'error', summary: 'Send mail', detail: 'Email send failure', life: 3000 });
        }
    })
}

const sendSub = ()=>{
    SubForm.post(route('mail.sendSub'),{
        onSuccess: () => {
             toast.add({ severity: 'success', summary: 'Send mail', detail: 'your mail has successfully sent to subscriber', life: 3000 });
             isSubvisible.value = false;
        },
        onError : () =>{
            toast.add({ severity: 'error', summary: 'Send mail', detail: 'Email send failure to subscriber', life: 3000 });
        }
    })
}
const sendUserBtn = () => {
    visible.value = true;
}

const sendSubBtn = () =>{
    isSubvisible.value = true;
}
const metaKey = ref(false);
</script>

<style  scoped></style>
