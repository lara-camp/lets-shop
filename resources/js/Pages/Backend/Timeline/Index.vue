<template>
    <AdminLayout>
        <div class="px-4 py-5 md:px-6 lg:px-8">
            <BreadList primary-name="Timeline" />
            <Divider/>
            <div class="flex align-items-start flex-column lg:justify-content-between lg:flex-row">
                <div class="font-medium text-3xl text-900">Timelines</div>
                <div class="mt-3 lg:mt-0">
                    <Link :href="route('discount_timelines.create')">
                        <Button icon="pi pi-plus" label="Create"></Button>
                    </Link>
                </div>
            </div>
            <StatusToast :detail="status"
                     :status="status"
                     severity="success"
                     :summary="getSummary()" />

                <!-- timeline table -->
            <DataTable v-model:filters="filters"
                   :globalFilterFields="['start','end']"
                   :rows="3"
                   :rowsPerPageOptions="[5  , 10, 20, 50]"
                   :sortOrder="-1"
                   :value="coupons"
                   paginator
                   tableStyle="min-width: 50rem">
                    <template #header>
                        <div class="flex justify-content-end">
                        <span class="p-input-icon-left">
                            <i class="pi pi-search"/>
                            <InputText v-model="filters['global'].value" placeholder="Keyword Search"/>
                        </span>
                        </div>
                    </template>
                    <template #empty>
                        <div class="text-lg font-medium text-center"> There is no Coupon currently.</div>
                    </template>
                    <template #loading> Loading timelines data. Please wait.</template>
                    <Column field="id" header="ID" sortable style="width: 1%"></Column>
                    <Column field="start"
                            header="Start Date"
                            sortable
                            style="width: 10%"></Column>
                    <Column field="end"
                            header="End Date"
                            sortable
                            style="width: 10%"></Column>

                    <Column field="action" header="Action" style="width: 10%">
                        <template #body="slotProps">
                        <Link :href="route('discount_timelines.edit',slotProps.data.id)">
                            <Button class="mr-2"
                                icon="pi pi-pencil"
                                outlined
                                rounded
                                severity="warning"
                                style="height: 40px; width: 40px"/>
                        </Link>

                        <Button icon="pi pi-trash"
                                outlined
                                rounded
                                severity="danger"
                                style="height: 40px; width: 40px"
                                @click="confirmDeleteCoupon(slotProps.data)"/>
                        </template>
                    </Column>
            </DataTable>

        </div>
    </AdminLayout>
</template>

<script setup>
import AdminLayout from '../../../Layout/AdminLayout.vue'
import {Link} from '@inertiajs/vue3'
import BreadList from '../Component/BreadList.vue'
import Divider from 'primevue/divider'
import Button from 'primevue/button'
import DataTable from 'primevue/datatable'
import Column from 'primevue/column'
import InputText from 'primevue/inputtext'


const getSummary= () =>{
    if(status == "created Timeline successfully"){
        return 'Create Coupon'
    }else{
        return 'Edit Coupon'
    }
}

let {status}=defineProps({status:String})
</script>

<style>

</style>
