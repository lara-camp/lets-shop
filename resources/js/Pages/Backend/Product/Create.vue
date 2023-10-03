<template>
  <AdminLayout>
    <div class="px-4 py-5 md:px-6 lg:px-8">
      <ul class="list-none p-0 m-0 flex align-items-center font-medium mb-3">
        <li>
          <Link :href="route('products.index')"
                class="text-500 no-underline line-height-3 cursor-pointer">Products
          </Link>
        </li>
        <li class="px-2">
          <i class="pi pi-angle-right text-500 line-height-3"></i>
        </li>
        <li>
          <span class="text-900 line-height-3">Create</span>
        </li>
      </ul>
      <Divider/>
      <div class="font-medium text-3xl text-900 mb-4">Create Product</div>
      <!--Product Form Section-->
      <form id="productForm"
            class="grid justify-content-center"
            @submit.prevent="productForm.post(route('products.store'))">
        <div class="col-6 pr-5">

          <!--Product Name Input-->
          <div class="flex flex-column mb-4">
            <label class="text-xl font-medium mb-2" for="name">Product Name</label>
            <InputText id="name" v-model="productForm.name" placeholder="Name"/>
            <div v-if="productForm.errors.name" class="text-md text-red-600">
              {{ productForm.errors.name }}
            </div>
          </div>

          <!--Product Price Input-->
          <div class="flex flex-column mb-4">
            <label class="text-xl font-medium mb-2" for="currency-mmk"> Price </label>
            <InputNumber v-model.number="productForm.price" currency="MMK"
                         mode="currency"
                         placeholder="MMK"/>
            <div v-if="productForm.errors.price" class="text-md text-red-600">
              {{ productForm.errors.price }}
            </div>
          </div>

          <!--Product Stock Input-->
          <div class="flex flex-column mb-4">
            <label class="text-xl font-medium mb-2" for="minmax-buttons"> Stocks </label>
            <InputNumber v-model="productForm.stock"
                         :max="10000"
                         :min="1"
                         mode="decimal"
                         showButtons/>
            <div v-if="productForm.errors.stock" class="text-md text-red-600">
              {{ productForm.errors.stock }}
            </div>
          </div>

          <!--Product Category Input-->
          <div class="flex flex-column mb-4">
            <label class="text-xl font-medium mb-2" for="minmax-buttons"> Category </label>
            <Dropdown v-model="selectedCategory"
                      :options="categories"
                      filter
                      optionLabel="title"
                      placeholder="Select a Category"></Dropdown>

            <div v-if="productForm.errors.category" class="text-md text-red-600">
              {{ productForm.errors.category }}
            </div>
          </div>

          <!--Product Description Input-->
          <div class="flex flex-column mb-5">
            <label class="text-xl font-medium mb-2" for="description">Description</label>
            <Textarea id="description" v-model="productForm.description" cols="30" rows="5"/>
            <div v-if="productForm.errors.description" class="text-md text-red-600">
              {{ productForm.errors.description }}
            </div>
          </div>


          <Button form="productForm" label="Create Product" type="submit"/>
        </div>
        <div class="col-6 pl-5">

          <!--Product Pictures Input-->
          <div class="flex flex-column mb-4">
            <div class="font-medium text-xl mb-2">Pictures</div>
            <div class="card">
              <Toast/>
              <FileUpload :maxFileSize="1000000" :multiple="true"
                          :show-upload-button="false"
                          accept="image/*"
                          @clear="removeAllImages" @input="addImage($event.target.files)">

                <template #empty>
                  <p>Drag and drop files to here to upload.</p>
                </template>
                <template #content="{ files, removeFileCallback }">
                  <div v-if="files.length > 0">
                    <div class="flex flex-column">
                      <div v-for="(file, index) of files"
                           :key="file.name + file.type + file.size"
                           class="card mb-3 flex p-2 w-full justify-content-between border-1 surface-border align-items-center">
                        <div class="flex align-items-center">
                          <img :alt="file.name"
                               :src="file.objectURL"
                               class="shadow-2"
                               height="50"
                               role="presentation"
                               width="100"/>
                          <span class="font-semibold ml-3">{{ file.name }}</span>
                        </div>
                        <Button icon="pi pi-times"
                                outlined
                                rounded
                                severity="danger"
                                @click="removeImage(file, removeFileCallback, index)"/>
                      </div>
                    </div>
                  </div>
                </template>
              </FileUpload>
            </div>
          </div>

          <!--Product Detail Input-->
          <div class="flex flex-column mb-4">
            <div class="flex justify-content-between align-items-center">
              <div class="font-medium text-xl mb-2">New Detail Key</div>
              <Button label="Create"
                      rounded
                      severity="help"
                      size="small"
                      @click="newDetailKeyDialog = true"/>
            </div>
            <Dialog v-model:visible="newDetailKeyDialog"
                    :style="{ width: '30vw' }"
                    header="Create Detail Key">
              <div class="flex flex-column mb-2">
                <label class="text-xl font-medium mb-2" for="minmax-buttons"> New Key </label>
                <InputText v-model="newDetailKey"/>
                <div v-if="newDetailKeyError" class="text-md text-red-600 mt-1">
                  {{ newDetailKeyError }}
                </div>
                <Button class="mt-4" label="Create" @click="createNewDetailKey"/>
              </div>
            </Dialog>

          </div>

          <!--Product Detail Input-->
          <div class="flex flex-column mb-4">
            <div class="flex  justify-content-between align-items-center mb-3">
              <div class="font-medium text-xl mb-2">Details</div>
              <Button icon="pi pi-plus" rounded severity="help" size="small" @click="createDetail"/>
            </div>
            <!--Product Detail Key-->
            <div v-for="detail in productForm.details" :key="detail.id" class="flex mb-3">
              <div class="w-full">
                <Dropdown v-model="detail.key"
                          :options="details"
                          class="w-full"
                          filter
                          optionLabel="key"
                          placeholder="Select a Detail"></Dropdown>
                <div class="text-sm text-red-600"></div>
                <Toast/>
              </div>
              <Divider layout="vertical"/>
              <!--Product Detail Value-->
              <div class="w-full">
                <InputText id="value" v-model="detail.value" class="w-full" placeholder="Value"/>
                <div class="text-sm text-red-600"></div>
              </div>
              <Button
                  class="ml-3 flex-shrink-0"
                  icon="pi pi-times"
                  outlined
                  severity="danger"
                  @click="deleteDetail(detail.id)"/>
            </div>
          </div>

        </div>
      </form>
    </div>
  </AdminLayout>
</template>

<script setup>
import FileUpload from 'primevue/fileupload'
import AdminLayout from '../../../Layout/AdminLayout.vue'
import Divider from 'primevue/divider'
import Textarea from 'primevue/textarea'
import InputText from 'primevue/inputtext'
import InputNumber from 'primevue/inputnumber'
import Dropdown from 'primevue/dropdown'
import Button from 'primevue/button'
import Dialog from 'primevue/dialog'
import Toast from 'primevue/toast'
import { useToast } from 'primevue/usetoast'
import { Link, useForm } from '@inertiajs/vue3'
import { onMounted, ref, watch } from 'vue'
import axios from 'axios'

const { status } = defineProps({ status: String })

// Create New Detail Key
const newDetailKeyDialog = ref(false)
const newDetailKey = ref(null)
const newDetailKeyError = ref(null)
const newDetailKeyToast = useToast()
const createNewDetailKey = () => {
  axios.post(route('details.store'), {
    key: newDetailKey.value
  }).then((response) => {
    newDetailKeyError.value = null
    newDetailKeyToast.add({
      severity: 'success',
      summary: 'New Detail Key',
      detail: `New Detail Key (${response.data.key}) is created successfully`,
      life: 5000
    })
    getDetails()
    newDetailKeyDialog.value = false
  }).catch((error) => {
    newDetailKeyError.value = error.response.data.message
  })
}

// Get Details Lists
const getDetails = () => {
  axios.get(route('details.index')).then((response) => {
    details.value = response.data
  }).catch((error) => {
    console.log(error)
  })
}

const details = ref([])

// Categories Lists
const getCategories = () => {
  axios.get(route('categories.index')).then((response) => {
    categories.value = response.data
  }).catch((error) => {
    console.log(error)
  })
}
const categories = ref([])

onMounted(() => {
  getDetails()
  getCategories()
})

// Get Selected Category
const selectedCategory = ref({ name: null, id: null })

// Apply Category value to productForm category
watch(selectedCategory, () => {
  productForm.category = selectedCategory.value.id ?? null
})

// Create New Product
const productForm = useForm({
  name: null,
  description: null,
  price: null,
  stock: null,
  category: selectedCategory.value.id ?? null,
  details: [],
  images: [],
})

// Product Images
const addImage = (image) => {
  for (let i = 0; i < image.length; i++) {
    productForm.images.push(image[i])
  }
}
const removeImage = (file, removeFileCallback, index) => {
  for (let i = 0; i < productForm.images.length; i++) {
    if (productForm.images[i] === file) {
      productForm.images.splice(i, 1)
    }
  }
  removeFileCallback(index)
}
const removeAllImages = () => {
  productForm.images = []
}

// Product Detail Count
const detail = ref(0)

// Add detail creation input
const createDetail = () => {
  productForm.details.push({ key: null, value: null, id: detail.value })
  detail.value++
}

// Remove detail creation input
const deleteDetail = (id) => {
  productForm.details = productForm.details.filter((detail) => detail.id !== id)
}


</script>

<style scoped></style>