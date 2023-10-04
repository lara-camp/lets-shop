<template>
    <div class="card mt-5">
        <DataTable :rows="10" :value="skeletonData">
            <Column field="id" header="Image" style="width: 10%">
                <template #body>
                    <Skeleton width="20rem" height="6rem"></Skeleton>
                </template>
            </Column>
            <Column field="title" header="Category Name">
                <template #body>
                    <Skeleton></Skeleton>
                </template>
            </Column>
            <Column field="slug" header="Slug">
                <template #body>
                    <Skeleton></Skeleton>
                </template>
            </Column>
        </DataTable>
    </div>
</template>

<script setup>
import DataTable from 'primevue/datatable'
import InputText from 'primevue/inputtext'
import Column from 'primevue/column'
import Skeleton from 'primevue/skeleton'
import { ref } from 'vue'

const skeletonData = ref([
    {}, {}, {},{},{}
])
</script>

<style scoped></style>
