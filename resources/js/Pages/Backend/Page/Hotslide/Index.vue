<template>
    <AdminLayout>
        <div class="grid m-auto">
            <div class="col-11 m-auto mt-3">
                <ul class="list-none p-0 m-0 flex align-items-center font-medium mb-3">
                    <li>
                        <span class="text-900 line-height-3">Slides</span>
                    </li>
                </ul>
                <Divider />
            </div>
        </div>
        <div class="flex align-items-start flex-column lg:justify-content-between lg:flex-row col-11 m-auto">
            <div class="font-medium text-3xl text-900">Products</div>
            <div class="mt-3 lg:mt-0">
                <Link :href="route('hot-slide.create')">
                <Button icon="pi pi-plus" label="Create"></Button>
                </Link>
            </div>
        </div>
        <div v-if='slides' class="col-11 m-auto">
            <DataTable :value="slides" paginator :rows="5" :rowsPerPageOptions="[5, 10, 20, 50]"
                tableStyle="min-width: 50rem">
                <Column header="Image">
                    <template #body="slotProps">
                        <img :src="asset('hot-slide/' + slotProps.data.image)" :alt="slotProps.data.image" class="shadow-2"
                            width="300" style="object-fit: cover;" />
                    </template>
                </Column>
                <Column header="Created at">
                    <template #body="slotProps">
                        {{ formatDate(slotProps.data.created_at) }}
                    </template>
                </Column>

                <Column header="Actions">
                    <template #body="slotProps">
                        <Toast />
                        <ConfirmPopup></ConfirmPopup>
                        <Button icon="pi pi-pencil" severity="warning" rounded outlined aria-label="Edit" />
                        <Button icon="pi pi-trash" @click="confirm2($event, slotProps.data.id)" severity="danger" rounded outlined
                            aria-label="Delete" class="mx-2" />
                        <Button icon="pi pi-check" rounded :outlined="slotProps.data.is_show == 0 ? true : false"
                            aria-label="Filter" />
                    </template>
                </Column>
            </DataTable>
        </div>
        <div v-else>
            <CusSkeleton />
        </div>

    </AdminLayout>
</template>

<script setup>
import { onMounted, ref, watch } from 'vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import { asset } from '../../../../asset-helper.js';
import { Link, router } from '@inertiajs/vue3';
import AdminLayout from '../../../../Layout/AdminLayout.vue';
import CusSkeleton from './Partials/CusSkeleton.vue';
import Button from 'primevue/button';
import Divider from 'primevue/divider';
import ConfirmPopup from 'primevue/confirmpopup';
import { useConfirm } from "primevue/useconfirm";
import { useToast } from "primevue/usetoast";
import Toast from 'primevue/toast';

let { slides } = defineProps({
    slides: undefined,
})

const formatDate = (dateTime) => {
    const options = { year: 'numeric', month: 'short', day: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric', hour12: true };
    return new Date(dateTime).toLocaleDateString(undefined, options);
}
const confirm = useConfirm();
const toast = useToast();

const confirm2 = (event, id) => {
    confirm.require({
        target: event.currentTarget,
        message: 'Do you want to delete this record?',
        icon: 'pi pi-info-circle',
        acceptClass: 'p-button-danger',
        accept: () => {
            router.delete('/dashboard/hot-slide/'+id)
            toast.add({ severity: 'info', summary: 'Confirmed', detail: 'Record deleted', life: 3000 });
        },
        reject: () => {
            toast.add({ severity: 'error', summary: 'Rejected', detail: 'You have rejected', life: 3000 });
        }
    });
};

onMounted(() => {
    router.reload({ only: ['slides'] })
})
</script>

<style  scoped></style>
