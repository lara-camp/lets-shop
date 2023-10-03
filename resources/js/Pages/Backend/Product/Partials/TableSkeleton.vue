<template>
  <div class="card mt-5">
    <DataTable :rows="10"
               :value="skeletonData">
      <template #header>
        <div class="flex justify-content-end">
            <span class="p-input-icon-left">
                <i class="pi pi-search"/>
                <InputText placeholder="Keyword Search"/>
            </span>
        </div>
      </template>
      <Column field="id" header="#ID" style="width: 10%">
        <template #body>
          <Skeleton></Skeleton>
        </template>
      </Column>
      <Column field="name" header="Name">
        <template #body>
          <Skeleton></Skeleton>
        </template>
      </Column>
      <Column field="truncate" header="Description">
        <template #body>
          <Skeleton></Skeleton>
        </template>
      </Column>
      <Column field="price" header="Price">
        <template #body>
          <Skeleton></Skeleton>
        </template>
      </Column>
      <Column field="stock" header="Stocks">
        <template #body>
          <Skeleton></Skeleton>
        </template>
      </Column>
      <Column field="category" header="Category">
        <template #body>
          <Skeleton></Skeleton>
        </template>
      </Column>
      <Column field="discount" header="Discount">
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
  {},{},{}
])
</script>

<style scoped></style>
