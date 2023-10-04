<template>
  <AdminLayout>
    <div class="px-4 py-5 md:px-6 lg:px-8">
      <ul class="list-none p-0 m-0 flex align-items-center font-medium mb-3">
        <li>
          <span class="text-900 line-height-3">Products</span>
        </li>
      </ul>
      <Divider/>
      <div class="flex align-items-start flex-column lg:justify-content-between lg:flex-row">
        <div class="font-medium text-3xl text-900">Products</div>
        <div class="mt-3 lg:mt-0">
          <Link :href="route('products.create')">
            <Button icon="pi pi-plus" label="Create"></Button>
          </Link>
        </div>
      </div>

      <!--Product Table-->
      <div v-if="products" class="card mt-5">
        <DataTable v-model:filters="filters"
                   :globalFilterFields="['discount']"
                   :rows="10"
                   :rowsPerPageOptions="[5, 10, 20, 50]"
                   :sortOrder="-1"
                   :value="products"
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
            <div class="text-lg font-medium text-center"> There is no product currently.</div>
          </template>
          <template #loading> Loading customers data. Please wait.</template>
          <Column field="id" header="#ID" sortable style="width: 5%"></Column>
          <Column field="name" header="Name" sortable style="width: 5%"></Column>
          <Column field="truncate" header="Description" sortable style="width: 10%"></Column>
          <Column field="price" header="Price" sortable style="width: 5%"></Column>
          <Column field="stock" header="Stocks" sortable style="width: 5%"></Column>
          <Column field="category.title" header="Category" sortable style="width: 5%"></Column>
          <Column :filterMenuStyle="{ width: '14rem' }"
                  :showFilterMenu="false"
                  field="discount"
                  header="Discount"
                  style="width: 5%">
            <template #body="{ data }">
              <Tag :severity="getSeverity(data.discount)" :value="data.discount"/>
            </template>
          </Column>
          <Column field="action" header="Action" style="width: 10%">
            <template #body="{slotProps, data}">
              <!--View Detail Button-->
              <Link :href="route('products.detail', data.slug)">
                <Button class="mr-2"
                        icon="pi pi-align-left"
                        outlined rounded style="height: 40px; width: 40px"/>
              </Link>
              <!--Give Discount Dialog Button-->
              <Button class="mr-2" icon="pi pi-tag"
                      outlined
                      rounded severity="info" style="height: 40px; width: 40px"/>
              <!--Edit Button-->
              <Button class="mr-2" icon="pi pi-pencil"
                      outlined
                      rounded severity="warning" style="height: 40px; width: 40px"/>
              <!--Delete Dialog Button-->
              <Button icon="pi pi-trash "
                      outlined
                      rounded
                      severity="danger"
                      style="height: 40px; width: 40px"
                      @click="deleteProductDialogView = true"/>
            </template>
          </Column>
        </DataTable>

        <!--Delete Product Dialog Box-->
        <DeleteProductDialog :dialog-view="deleteProductDialogView"/>
      </div>
      <TableSkeleton v-else></TableSkeleton>
    </div>

  </AdminLayout>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3'
import Button from 'primevue/button'
import AdminLayout from '../../../Layout/AdminLayout.vue'
import { FilterMatchMode } from 'primevue/api'
import { onMounted, ref } from 'vue'
import DataTable from 'primevue/datatable'
import Column from 'primevue/column'
import InputText from 'primevue/inputtext'
import Tag from 'primevue/tag'
import Divider from 'primevue/divider'
import TableSkeleton from './Partials/TableSkeleton.vue'
import DeleteProductDialog from './Partials/DeleteProductDialog.vue'

// Load Products
let { products } = defineProps({ products: undefined })
onMounted(() => {
  router.reload({ only: ['products'] })
})

// Filter Table
const filters = ref({
  global: { value: null, matchMode: FilterMatchMode.CONTAINS },
})

// Discount Status Badge Design
const getSeverity = (discount) => {
  switch (discount) {
    case 'no-discount':
      return 'danger'

    case 'discount':
      return 'success'
  }
}

// Delete Product
const deleteProductDialogView = ref(false)

</script>

<style scoped></style>
