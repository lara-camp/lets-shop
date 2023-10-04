<template>
  <AdminLayout>
    <div class="px-4 py-5 md:px-6 lg:px-8">
      <ul class="list-none p-0 m-0 flex align-items-center font-medium mb-3">
        <li>
          <span class="text-900 line-height-3">Categories</span>
        </li>
      </ul>
      <Divider/>
      <div class="flex align-items-start flex-column lg:justify-content-between lg:flex-row">
        <div class="font-medium text-3xl text-900">Categories</div>
        <div class="mt-3 lg:mt-0">
          <Button icon="pi pi-plus" label="Create" @click="visible = true"></Button>
          <!-- Status Toast for category created -->
          <Toast/>
          <Dialog v-model:visible="visible"
                  :dismissableMask="true"
                  :style="{ width: '50vw'}"
                  header="Create Category"
                  modal>
            <div class=" justify-content-center">
              <div class=" p-3">
                <div class="flex flex-column gap-2">
                  <label class="text-xl font-medium" for="name">Category Name</label>
                  <InputText id="name"
                             v-model="title"
                             aria-describedby="name-help"
                             name="title"/>
                  <!-- Email Input Error Message -->
                  <div v-if="emailError" class="text-red-600">{{ emailError }}</div>
                </div>

                <div class="flex flex-column gap-2">
                  <div class="flex align-items-center my-3">
                    <Checkbox v-model="checked" :binary="true"/>
                    <label class="text-xl font-medium ml-2">Have parent category</label>
                  </div>
                  <Dropdown v-model="parentCategory"
                            :disabled="!checked"
                            :options="SelectCategories"
                            class="w-full "
                            filter
                            optionLabel="title"
                            placeholder="Select a Category">
                  </Dropdown>
                </div>
                <div class="flex justify-content-end mt-2">
                  <Button class="text-xl font-medium "
                          label="Create"
                          @click="createCategory"></Button>
                </div>
              </div>
            </div>
          </Dialog>
          <Dialog v-model:visible="deleteProductDialog"
                  :dismissableMask="true"
                  :modal="true"
                  :style="{width: '450px'}"
                  header="Confirm">
            <div class="confirmation-content">
              <i class="pi pi-exclamation-triangle mr-3" style="font-size: 2rem"/>
              <span v-if="products">Are you sure you want to delete <b>{{
                  products.name
                }}</b>?</span>
            </div>
            <template #footer>
              <Button icon="pi pi-times"
                      label="No"
                      text
                      @click="deleteProductDialog = false"/>
              <Button icon="pi pi-check" label="Yes" text @click="deleteProduct"/>
            </template>
          </Dialog>
        </div>
      </div>
      <div v-if="categories" class="card mt-5">
        <DataTable v-model:filters="filters"
                   :globalFilterFields="['title']"
                   :rows="10"
                   :rowsPerPageOptions="[5, 10, 20, 50]"
                   :sortOrder="-1"
                   :value="categories"
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
            <div class="text-lg font-medium text-center"> There is no category currently.</div>
          </template>
          <template #loading> Loading categories data. Please wait.</template>
          <Column field="id" header="ID" sortable style="width: 1%"></Column>
          <Column field="title"
                  header="Category Name"
                  sortable
                  style="width: 10%"></Column>
          <Column field="products_count"
                  header="Product Qty"
                  sortable
                  style="width: 10%"></Column>
          <Column field="action" header="Action" style="width: 10%">
            <template #body="slotProps">
              <Button class="mr-2"
                      icon="pi pi-pencil"
                      outlined
                      rounded
                      severity="warning"
                      style="height: 40px; width: 40px"
                      @click="editProduct(slotProps.data)"/>
              <Button icon="pi pi-trash"
                      outlined
                      rounded
                      severity="danger"
                      style="height: 40px; width: 40px"
                      @click="confirmDeleteProduct(slotProps.data)"/>
            </template>
          </Column>
        </DataTable>
      </div>
    <div v-else>
        <TableSkeleton ></TableSkeleton>
    </div>
    </div>
  </AdminLayout>

</template>

<script setup>
import Button from 'primevue/button'
import AdminLayout from '../../../Layout/AdminLayout.vue'
import { FilterMatchMode } from 'primevue/api'
import { onMounted, onUpdated, ref, watch } from 'vue'
import {router} from '@inertiajs/vue3'
import DataTable from 'primevue/datatable'
import Column from 'primevue/column'
import InputText from 'primevue/inputtext'
import Divider from 'primevue/divider'
import Dialog from 'primevue/dialog'
import Checkbox from 'primevue/checkbox'
import Dropdown from 'primevue/dropdown'
import axios from 'axios'
import Toast from 'primevue/toast'
import { useToast } from 'primevue/usetoast'
import TableSkeleton from '../Category/Partials/TableSkeleton.vue'

const deleteProductDialog = ref(false)
const toast = useToast()
const confirmDeleteProduct = (prod) => {
  products.value = prod
  deleteProductDialog.value = true
}
const deleteProduct = () => {
  products.value = products.value.filter(val => val.id !== products.value.id)
  deleteProductDialog.value = false
  products.value = {}
  toast.add({ severity: 'success', summary: 'Successful', detail: 'Product Deleted', life: 3000 })
}

const visible = ref(false) //for Dialog close and open
const title = ref()
const emailError = ref()
const parentCategory = ref()
const newCategoryToast = useToast()
const createCategory = () => {
  axios.post(route('categories.store'), {
    title: title.value,
    parentCategory: parentCategory.value,
  })
      .then((response) => {
        if (response.data) {
            emailError.value=''
            title.value = ''
            parentCategory.value = ''
            visible.value = false
            checked.value = false
            getCategories()    //calling getCategories function
            newCategoryToast.add({
                severity: 'success',
                summary: 'New Category',
                detail: `New Category (${response.data.title}) is created successfully`,
                life: 5000
          })
        }
      })
      .catch((error) => {
        if (error) {
          emailError.value = error.response.data.errors.title[0]
        }
      })
}

//Getting categories from database
const categories=ref(undefined);
const SelectCategories = ref(undefined)
const getCategories = () => {
  axios.get(route('categories.index'))
      .then((response) => {
        if (response) {
          SelectCategories.value = response.data
          categories.value=response.data
          console.log(categories.value)
        }
      })
      .catch((error) => {
        console.log(error)
      })
}

const checked = ref(false)  //for have parent checkbox true or false

const filters = ref({
  global: { value: null, matchMode: FilterMatchMode.CONTAINS },
})

onMounted(() => {
  getCategories();
  router.reload({ only: ['categories'] })
})

</script>

<style scoped></style>
