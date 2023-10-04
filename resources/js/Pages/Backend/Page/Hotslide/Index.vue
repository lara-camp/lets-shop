<template>
    <AdminLayout>
        <div v-if='slides'>
            <DataTable :value="slides" paginator :rows="5" :rowsPerPageOptions="[5, 10, 20, 50]"
                tableStyle="min-width: 50rem">
                <Column header="Image">
                    <template #body="slotProps">
                        <Skeleton></Skeleton>
                        <img :src="asset('hot-slide/' + slotProps.data.image)" :alt="slotProps.data.image" class="shadow-2"
                            width="300" style="object-fit: cover;" />
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
import AdminLayout from '../../../../Layout/AdminLayout.vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import { asset } from '../../../../asset-helper.js';
import { router } from '@inertiajs/vue3';
import CusSkeleton from './Partials/CusSkeleton.vue';
let { slides } = defineProps({
    slides: undefined,
})
onMounted(() => {
    router.reload({ only: ['slides'] })
})
</script>

<style  scoped></style>
