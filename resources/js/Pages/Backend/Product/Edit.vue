<template>
  <!-- Main layout -->
  <AdminLayout>
    <!-- Content container -->
    <div class="px-4 py-5 md:px-6 lg:px-8">

      <!-- Breadcrumb List -->
      <BreadList
          :primary-route="route('products.index')"
          :secondary="true"
          :secondary-name="`#ID - ${data.product.id}`"
          primary-name="Products"
      />
      <Divider/>

      <!-- Edit Product Title -->
      <div class="font-medium text-3xl text-900 mb-4">Edit Product</div>

      <!-- Image Gallery Component -->
      <GalleryComponent :galleries="currentImages" @delete-image="removeImage"/>

      <!-- Product Form Section -->
      <form
          id="productForm"
          class="grid justify-content-center"
          @submit.prevent="productForm.post(route('products.update', data.product.id))"
      >
        <!-- Left Column -->
        <div class="col-6 pr-5">

          <!-- Product Name Input -->
          <div class="flex flex-column mb-4">
            <label class="text-xl font-medium mb-2" for="name">Product Name</label>
            <InputText id="name" v-model="productForm.name" placeholder="Name"/>
            <div v-if="productForm.errors.name" class="text-md text-red-600">
              {{ productForm.errors.name }}
            </div>
          </div>

          <!-- Product Price Input -->
          <div class="flex flex-column mb-4">
            <label class="text-xl font-medium mb-2" for="currency-mmk"> Price </label>
            <InputNumber v-model="productForm.price" currency="MMK"
                         mode="currency"
                         placeholder="MMK"/>
            <div v-if="productForm.errors.price" class="text-md text-red-600">
              {{ productForm.errors.price }}
            </div>
          </div>

          <!-- Product Stock Input -->
          <div class="flex flex-column mb-4">
            <label class="text-xl font-medium mb-2" for="minmax-buttons"> Stocks </label>
            <InputNumber
                v-model="productForm.stock"
                :max="10000"
                :min="1"
                mode="decimal"
                showButtons/>
            <div v-if="productForm.errors.stock" class="text-md text-red-600">
              {{ productForm.errors.stock }}
            </div>
          </div>

          <!-- Product Category Input -->
          <div class="flex flex-column mb-4">
            <label class="text-xl font-medium mb-2" for="minmax-buttons"> Category </label>
            <Dropdown
                v-model="productForm.category"
                :options="data.categories"
                filter
                option-value="id"
                optionLabel="title"
                placeholder="Select a Category">
            </Dropdown>

            <div v-if="productForm.errors.category" class="text-md text-red-600">
              {{ productForm.errors.category }}
            </div>
          </div>

          <!-- Product Description Input -->
          <div class="flex flex-column mb-5">
            <label class="text-xl font-medium mb-2" for="description">Description</label>
            <Textarea id="description" v-model="productForm.description" cols="30" rows="5"/>
            <div v-if="productForm.errors.description" class="text-md text-red-600">
              {{ productForm.errors.description }}
            </div>
          </div>

          <!-- Save and Cancel Buttons -->
          <div class="flex justify-content-between align-items-center">
            <Link :href="route('products.index')">
              <Button label="Cancel" outlined/>
            </Link>
            <Button form="productForm" label="Save Edit" type="submit"/>
          </div>
        </div>

        <!-- Right Column -->
        <div class="col-6 pl-5">

          <!-- Add Image Section -->
          <div class="flex flex-column mb-4">
            <div class="font-medium text-xl mb-2">Add Image</div>
            <div class="card">
              <Toast/>
              <FileUpload
                  :maxFileSize="1000000"
                  :multiple="true"
                  :show-upload-button="false"
                  accept="image/*"
                  @clear="removeAllUploadImages"
                  @input="addUploadImage($event.target.files)"
              >
                <!-- Drag and drop files message -->
                <template #empty>
                  <p>Drag and drop files here to upload.</p>
                </template>

                <!-- Uploaded files display -->
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
                               height="70"
                               role="presentation"
                               width="100"/>
                          <span class="font-semibold ml-3">{{ file.name }}</span>
                        </div>
                        <Button icon="pi pi-times"
                                outlined
                                rounded
                                severity="danger"
                                @click="removeUploadImage(file, removeFileCallback, index)"/>
                      </div>
                    </div>
                  </div>
                </template>
              </FileUpload>
            </div>
          </div>

          <!-- Product Detail Input -->
          <DetailKeyDialog @get-detail="getDetails"></DetailKeyDialog>

          <!-- Product Details List -->
          <div class="flex flex-column mb-4">
            <div class="flex  justify-content-between align-items-center mb-3">
              <div class="font-medium text-xl mb-2">Details</div>
              <Button icon="pi pi-plus" rounded severity="help" size="small" @click="createDetail"/>
            </div>

            <!-- Product Detail Key-Value Pairs -->
            <div v-for="(detail,index) in productForm.details" :key="detail.id" class="flex mb-3">
              <!-- Detail Key Dropdown -->
              <div class="w-full">
                <Dropdown v-model="detail.detail_id"
                          :options="details"
                          class="w-full"
                          filter
                          option-value="id"
                          optionLabel="key"
                          placeholder="Select a Detail">
                  <template #option="slotProps">
                    <div class="flex align-items-center">
                      <div>{{ slotProps.option.key }}</div>
                    </div>
                  </template>
                </Dropdown>
                <div class="text-sm text-red-600"></div>
                <Toast/>
              </div>
              <Divider layout="vertical"/>
              <!-- Detail Value Input -->
              <div class="w-full">
                <InputText id="value" v-model="detail.value" class="w-full" placeholder="Value"/>
                <div class="text-sm text-red-600"></div>
              </div>
              <!-- Remove Detail Button -->
              <Button
                  class="ml-3 flex-shrink-0"
                  icon="pi pi-times"
                  outlined
                  severity="danger"
                  @click="showDialogDelete(detail, index)"
              />
            </div>

            <!-- Delete Detail Dialog -->
            <DeleteProductDetailDialog
                :dialog-view="deleteProductDetailDialog"
                :product-detail="productDetail"
                @close-delete="closeDialogDelete"
                @delete-product-detail="deleteProductDetail">
            </DeleteProductDetailDialog>
          </div>
        </div>
      </form>
    </div>
  </AdminLayout>
</template>

<!-- Script Section -->
<script setup>
// Importing necessary components and libraries
import AdminLayout from '../../../Layout/AdminLayout.vue'
import Button from 'primevue/button'
import Divider from 'primevue/divider'
import InputText from 'primevue/inputtext'
import Toast from 'primevue/toast'
import FileUpload from 'primevue/fileupload'
import InputNumber from 'primevue/inputnumber'
import Dropdown from 'primevue/dropdown'
import Textarea from 'primevue/textarea'
import DetailKeyDialog from './Partials/DetailKeyDialog.vue'
import { ref } from 'vue'
import { Link, useForm } from '@inertiajs/vue3'
import axios from 'axios'
import BreadList from '../Component/BreadList.vue'
import GalleryComponent from './Partials/GalleryComponent.vue'
import DeleteProductDetailDialog from './Partials/DeleteProductDetailDialog.vue'

// Destructuring data from props
const { data } = defineProps({ data: Object })

// Creating a form using Inertia's useForm
const productForm = useForm({
  name: data.product.name,
  description: data.product.description,
  price: data.product.price,
  stock: data.product.stock,
  category: data.product.category_id,
  details: [...data.product.product_details],
  images: []
})

// Add Upload Images
const addUploadImage = (image) => {
  productForm.images.push(...image)
}

// Remove Upload Images
const removeUploadImage = (file, removeFileCallback, index) => {
  const imageIndex = productForm.images.indexOf(file)
  if (imageIndex !== -1) {
    productForm.images.splice(imageIndex, 1)
  }
  removeFileCallback(index)
}

// Remove All Upload Image
const removeAllUploadImages = () => {
  productForm.images = []
}

// Remove Uploaded Image
const currentImages = ref(data.product.product_images)
const removeImage = (id) => {
  currentImages.value = currentImages.value.filter((image) => image.id !== id)
}

// Get Details Lists
const getDetails = async () => {
  try {
    const response = await axios.get(route('details.index'))
    details.value = response.data
  } catch (error) {
    console.error(error)
  }
}

// Detail Options
const details = ref(data.details)

// Add detail creation input
const createDetail = () => {
  productForm.details.push({ detail_id: null, value: null })
}

// Remove detail creation input
const productDetail = ref(null)
const deleteProductDetailDialog = ref(false)

const closeDialogDelete = () => {
  deleteProductDetailDialog.value = false
  productDetail.value = null
}
const showDialogDelete = (detail, index) => {
  if (productForm.details[index].hasOwnProperty('product_id')) {
    productDetail.value = detail
    deleteProductDetailDialog.value = true
  } else {
    productForm.details.splice(index, 1)
  }
}
const deleteProductDetail = (id) => {
  closeDialogDelete()
  productForm.details = productForm.details.filter(detail => detail.id !== id)
}
</script>
