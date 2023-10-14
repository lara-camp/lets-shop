<template>
    <div class="col-11 m-auto">
        <DataTable :rows="10" :value="skeletonData">
            <Column field="id" header="Image">
                <template #body>
                    <Skeleton width="20rem" height="6rem"></Skeleton>
                </template>
            </Column>
            <Column field="Created At" header="Created at">
                <template #body>
                    <Skeleton width="14rem"></Skeleton>
                </template>
            </Column>
            <Column field="Actions" header="Actions">
                <template #body>
                    <div class="flex">
                        <Skeleton shape="circle" size="3rem"></Skeleton>
                        <Skeleton shape="circle" size="3rem" class="mx-2"></Skeleton>
                        <Skeleton shape="circle" size="3rem"></Skeleton>
                    </div>
                </template>
            </Column>
        </DataTable>
    </div>
</template>

<script setup>
import DataTable from 'primevue/datatable'
import Column from 'primevue/column'
import Skeleton from 'primevue/skeleton'
import { ref } from 'vue'

const skeletonData = ref([
    {}, {}, {}, {}, {}
])
</script>

<style scoped></style>
