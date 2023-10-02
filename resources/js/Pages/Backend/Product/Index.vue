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

      <div class="card mt-5">
        <DataTable v-model:filters="filters"
                   :globalFilterFields="['discount']"
                   :rows="3"
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
          <template #empty> No customers found.</template>
          <template #loading> Loading customers data. Please wait.</template>
          <Column field="name" header="Name" sortable style="width: 10%"></Column>
          <Column field="truncate" header="Description" sortable style="width: 10%"></Column>
          <Column field="price" header="Price" sortable style="width: 10%"></Column>
          <Column field="quantity" header="Quantity" sortable style="width: 10%"></Column>
          <Column field="category" header="Category" sortable style="width: 10%"></Column>
          <Column :filterMenuStyle="{ width: '14rem' }"
                  :showFilterMenu="false"
                  field="discount"
                  header="Discount"
                  style="width: 10%">
            <template #body="{ data }">
              <Tag :severity="getSeverity(data.discount)" :value="data.discount"/>
            </template>
          </Column>
        </DataTable>
      </div>

    </div>
  </AdminLayout>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import Button from 'primevue/button'
import AdminLayout from '../../../Layout/AdminLayout.vue'
import { FilterMatchMode } from 'primevue/api'
import { ref } from 'vue'
import DataTable from 'primevue/datatable'
import Column from 'primevue/column'
import InputText from 'primevue/inputtext'
import Tag from 'primevue/tag'
import Divider from 'primevue/divider'

const filters = ref({
  global: { value: null, matchMode: FilterMatchMode.CONTAINS },
})

const getSeverity = (discount) => {
  switch (discount) {
    case 'no-discount':
      return 'danger'

    case 'discount':
      return 'success'

  }
}

const products = ref([
  {
    name: 'Aen T-Shirt',
    truncate: 'lorem lorem lorem....',
    price: 50,
    quantity: 50,
    category: 'Men',
    discount: 'no-discount',
  }, {
    name: 'Ben T-Shirt',
    truncate: 'torem lorem lorem....',
    price: 12,
    quantity: 50,
    category: 'Men',
    discount: 'discount',
  }, {
    name: 'Cen T-Shirt',
    truncate: 'dlorem lorem lorem....',
    price: 53,
    quantity: 50,
    category: 'Men',
    discount: 'no-discount',
  }, {
    name: 'Den T-Shirt',
    truncate: 'gorem lorem lorem....',
    price: 63,
    quantity: 50,
    category: 'Men',
    discount: 'discount',
  }, {
    name: 'Men T-Shirt',
    truncate: 'horem lorem lorem....',
    price: 46,
    quantity: 50,
    category: 'Men',
    discount: 'discount',
  },
])
</script>

<style scoped></style>