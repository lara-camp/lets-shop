<template>
    <AdminLayout>
        <div class="px-4 py-5 md:px-6 lg:px-8">
            <ul class="list-none p-0 m-0 flex align-items-center font-medium mb-3">
                <li>
                    <span class="text-900 line-height-3">Categories</span>
                </li>
            </ul>
            <Divider />
            <div class="flex align-items-start flex-column lg:justify-content-between lg:flex-row">
                <div class="font-medium text-3xl text-900">Categories</div>
                <div class="mt-3 lg:mt-0">
                    <Button icon="pi pi-plus" label="Create" @click="visible = true"></Button>
                    <!-- Status Toast for category created -->
                    <Toast />
                    <Dialog v-model:visible="visible" :dismissableMask="true" :style="{ width: '50vw' }"
                        header="Create Category" modal>
                        <div class=" justify-content-center">
                            <div class=" p-3">
                                <div class="flex flex-column gap-2">
                                    <label class="text-xl font-medium" for="name">Category Name</label>
                                    <InputText id="name" v-model="title" aria-describedby="name-help" name="title" />
                                    <!-- Email Input Error Message -->
                                    <div v-if="emailError" class="text-red-600">{{ emailError }}</div>
                                </div>

                                <div class="flex flex-column gap-2">
                                    <div class="flex align-items-center my-3">
                                        <Checkbox v-model="checked" :binary="true" />
                                        <label class="text-xl font-medium ml-2">Have parent category</label>
                                    </div>
                                    <Dropdown v-model="parentCategory" :disabled="!checked" :options="categories"
                                        class="w-full " filter optionLabel="title" placeholder="Select a Category">
                                        <template #value="slotProps">
                                            <div v-if="slotProps.value" class="flex align-items-center">
                                                <div>{{ slotProps.value.title }}</div>
                                            </div>
                                            <span v-else>
                                                {{ slotProps.placeholder }}
                                            </span>
                                        </template>
                                        <template #option="slotProps">
                                            <div class="flex align-items-center">
                                                <div>{{ slotProps.option.title }}</div>
                                            </div>
                                        </template>
                                    </Dropdown>
                                    <!-- <div id="name-help" class="text-md">Error</div> -->
                                </div>
                                <div class="flex justify-content-end mt-2">
                                    <Button class="text-xl font-medium " label="Create" @click="createCategory"></Button>
                                </div>
                            </div>
                        </div>
                    </Dialog>
                    <Dialog v-model:visible="deleteProductDialog" :dismissableMask="true" :modal="true"
                        :style="{ width: '450px' }" header="Confirm">
                        <div class="confirmation-content">
                            <i class="pi pi-exclamation-triangle mr-3" style="font-size: 2rem" />
                            <span v-if="products">Are you sure you want to delete <b>{{
                                products.name
                            }}</b>?</span>
                        </div>
                        <template #footer>
                            <Button icon="pi pi-times" label="No" text @click="deleteProductDialog = false" />
                            <Button icon="pi pi-check" label="Yes" text @click="deleteProduct" />
                        </template>
                    </Dialog>
                </div>
            </div>
            <div class="card mt-5">
                <DataTable v-model:filters="filters" :globalFilterFields="['name']" :rows="10"
                    :rowsPerPageOptions="[5, 10, 20, 50]" :sortOrder="-1" :value="products" paginator
                    tableStyle="min-width: 50rem">
                    <template #header>
                        <div class="flex justify-content-end">
                            <span class="p-input-icon-left">
                                <i class="pi pi-search" />
                                <InputText v-model="filters['global'].value" placeholder="Keyword Search" />
                            </span>
                        </div>
                    </template>
                    <template #empty> No categories found.</template>
                    <template #loading> Loading categories data. Please wait.</template>
                    <Column field="id" header="ID" sortable style="width: 1%"></Column>
                    <Column field="name" header="Category Name" sortable style="width: 10%"></Column>
                    <Column field="product_qty" header="Product Qty" sortable style="width: 10%"></Column>
                    <Column field="action" header="Action" style="width: 10%">
                        <template #body="slotProps">
                            <Button class="mr-2" icon="pi pi-pencil" outlined rounded severity="warning"
                                style="height: 40px; width: 40px" @click="editProduct(slotProps.data)" />
                            <Button icon="pi pi-trash" outlined rounded severity="danger" style="height: 40px; width: 40px"
                                @click="confirmDeleteProduct(slotProps.data)" />
                        </template>
                    </Column>
                </DataTable>
            </div>

        </div>
    </AdminLayout>
</template>

<script setup>
import Button from 'primevue/button'
import AdminLayout from '../../../Layout/AdminLayout.vue'
import { FilterMatchMode } from 'primevue/api'
import { onMounted, ref } from 'vue'
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

const visible = ref(false) //for Dialog

const title = ref()
const emailError = ref(null)
const parentCategory = ref()
const newCategoryToast = useToast()
const createCategory = () => {
    axios.post(route('categories.store'), {
        title: title.value,
        parentCategory: parentCategory.value,
    })
        .then((response) => {
            if (response.data) {
                title.value = ''
                parentCategory.value = ''
                visible.value = false
                checked.value = false
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
const categories = ref([])
const getCategories = () => {
    axios.get(route('categories.index'))
        .then((response) => {
            if (response) {
                categories.value = response.data
            }
        })
        .catch((error) => {
            console.log(error)
        })
}
onMounted(() => {
    getCategories()
})

const checked = ref(false)  //for checkbox

const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
})

//data for table
const products = ref([
    {
        id: 1,
        name: 'Aen T-Shirt',
        product_qty: 3,

    }, {
        id: 2,
        name: 'Ben T-Shirt',
        product_qty: 2,
    }, {
        id: 3,
        name: 'Cen T-Shirt',
        product_qty: 4,

    }, {
        id: 4,
        name: 'Den T-Shirt',
        product_qty: 10,
    }, {
        id: 5,
        name: 'Men T-Shirt',
        product_qty: 7,
    },
])
</script>

<style scoped></style>
