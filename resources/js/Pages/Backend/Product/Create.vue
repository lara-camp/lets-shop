<template>
  <Head title="Product - Create"/>
  <AdminLayout>
    <div class="px-4 py-5 md:px-6 lg:px-8">
      <BreadList :primary-route="route('products.index')"
                 :secondary="true"
                 primary-name="Products"
                 secondary-name="Create"/>
      <Divider/>
      <div class="font-medium text-3xl text-900 mb-4">Create Product</div>
      <!--Product Form Section-->
      <form id="productForm"
            class="grid justify-content-center"
            @submit.prevent="productForm.post(route('products.store'), {preserveScroll : true})">
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
                      <div v-for="(file, index) of files" :key="file.name + file.type + file.size"
                           class="mb-3">
                        <div class="card  flex p-2 w-full justify-content-between border-1 surface-border align-items-center">
                          <div class="flex align-items-center">
                            <img :alt="file.name"
                                 :src="file.objectURL"
                                 class="shadow-2"
                                 height="70"
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
                        <div v-if="imageErrors[index]"
                             class="text-sm text-red-600">{{ imageErrors[index] }}
                        </div>
                      </div>
                    </div>
                  </div>
                </template>
              </FileUpload>
            </div>
          </div>

          <!--Product Detail Input-->
          <DetailKeyDialog @get-detail="getDetails"></DetailKeyDialog>

          <!--Product Detail Input-->
          <div class="flex flex-column mb-4">
            <div class="flex  justify-content-between align-items-center mb-3">
              <div class="font-medium text-xl mb-2">Details</div>
              <Button icon="pi pi-plus" rounded severity="help" size="small" @click="createDetail"/>
            </div>
            <!--Product Detail Key-->
            <div v-for="(detail,index) in productForm.details" :key="detail.id" class="flex mb-3">
              <div class="w-full">
                <Dropdown v-model="detail.key"
                          :options="details"
                          class="w-full"
                          filter
                          optionLabel="key"
                          placeholder="Select a Detail"></Dropdown>
                <div v-if="productDetailErrors[index].key"
                     class="text-sm text-red-600">{{ productDetailErrors[index].key }}
                </div>
                <Toast/>
              </div>
              <Divider class="h-3rem" layout="vertical"/>
              <!--Product Detail Value-->
              <div class="w-full">
                <InputText id="value" v-model="detail.value" class="w-full" placeholder="Value"/>
                <div v-if="productDetailErrors[index].value"
                     class="text-sm text-red-600">{{ productDetailErrors[index].value }}
                </div>
              </div>
              <Button
                  class="ml-3 flex-shrink-0 h-3rem"
                  icon="pi pi-times"
                  outlined
                  severity="danger"
                  @click="deleteDetail(index)"/>

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
import Toast from 'primevue/toast'
import { useForm } from '@inertiajs/vue3'
import { onMounted, ref, watch } from 'vue'
import axios from 'axios'
import DetailKeyDialog from './Partials/DetailKeyDialog.vue'
import BreadList from '../Component/BreadList.vue'

const { status } = defineProps({ status: String })

// Get Details Lists
const getDetails = async () => {
  try {
    const response = await axios.get(route('details.index'))
    details.value = response.data
  } catch (error) {
    console.error(error)
  }
}

const details = ref([])

// Categories Lists
const getCategories = async () => {
  try {
    const response = await axios.get(route('categories.index'))
    categories.value = response.data
  } catch (error) {
    console.error(error)
  }
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
  productForm.images.push(...image)
}

const removeImage = (file, removeFileCallback, index) => {
  const imageIndex = productForm.images.indexOf(file)
  if (imageIndex !== -1) {
    productForm.images.splice(imageIndex, 1)
  }
  removeFileCallback(index)
}
const removeAllImages = () => {
  productForm.images = []
}

// Add detail creation input
const createDetail = () => {
  productForm.details.push({ key: null, value: null })
  productDetailErrors.value.push({ key: null, value: null })
}

// Remove detail creation input
const deleteDetail = (index) => {
  productForm.details.splice(index, 1)
}

// Initialize Product Detail Errors and Image Errors
const productDetailErrors = ref([])
const imageErrors = ref([])

// Function to set error placeholders for product details
const detailErrorPlaceholder = () => {
  for (let i = 0; i < productForm.details.length; i++) {
    productDetailErrors.value.push({ key: null, value: null })
  }
}

// Watch for changes in productForm.errors
watch(() => productForm.errors, () => {
  // Clear old errors
  productDetailErrors.value = []
  imageErrors.value = []

  // Set error placeholders for product details
  detailErrorPlaceholder()

  // Populate errors
  if (productForm.errors) {
    for (let key in productForm.errors) {
      const parts = key.split('.')
      const index = parseInt(parts[1])
      if (parts.length > 2) {
        // parts[2] is error key such as (key error, value error)
        productDetailErrors.value[index][parts[2]] = productForm.errors[key]
      } else if (parts.length > 1) {
        imageErrors.value[index] = productForm.errors[key]
      }
    }
  }
})


</script>

<style scoped></style>
