<template>
  <AdminLayout>
    <div class="px-4 py-5 md:px-6 lg:px-8">
      <ul class="list-none p-0 m-0 flex align-items-center font-medium mb-3">
        <li>
          <span class="text-900 line-height-3">Products</span>
        </li>
        <li class="px-2">
          <i class="pi pi-angle-right text-500 line-height-3"></i>
        </li>
        <li>
          <span class="text-900 line-height-3">#ID - </span>
        </li>
      </ul>
      <Divider/>
      <Divider/>
      <div class="font-medium text-3xl text-900 mb-4">Create Product</div>
      <!--Product Form Section-->
      <form id="productForm"
            class="grid justify-content-center"
      >
        <div class="col-6 pr-5">

          <!--Product Name Input-->
          <div class="flex flex-column mb-4">
            <label class="text-xl font-medium mb-2" for="name">Product Name</label>
            <InputText id="name" placeholder="Name"/>
            <div class="text-md text-red-600">
              Error
            </div>
          </div>

          <!--Product Price Input-->
          <div class="flex flex-column mb-4">
            <label class="text-xl font-medium mb-2" for="currency-mmk"> Price </label>
            <InputNumber currency="MMK"
                         mode="currency"
                         placeholder="MMK"/>
            <div class="text-md text-red-600">
              Error
            </div>
          </div>

          <!--Product Stock Input-->
          <div class="flex flex-column mb-4">
            <label class="text-xl font-medium mb-2" for="minmax-buttons"> Stocks </label>
            <InputNumber
                :max="10000"
                :min="1"
                mode="decimal"
                showButtons/>
            <div class="text-md text-red-600">Error
            </div>
          </div>

          <!--Product Category Input-->
          <div class="flex flex-column mb-4">
            <label class="text-xl font-medium mb-2" for="minmax-buttons"> Category </label>
            <Dropdown
                :options="data.categories"
                filter
                optionLabel="title"
                placeholder="Select a Category"></Dropdown>

            <div class="text-md text-red-600">
              Error
            </div>
          </div>

          <!--Product Description Input-->
          <div class="flex flex-column mb-5">
            <label class="text-xl font-medium mb-2" for="description">Description</label>
            <Textarea id="description" cols="30" rows="5"/>
            <div class="text-md text-red-600">
              Error
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
              >

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
                                severity="danger"/>
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
            <div v-for="detail in productForm.details" :key="detail.id" class="flex mb-3">
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
                  @click="deleteDetail(detail.id)"
              />
            </div>
          </div>

        </div>
      </form>
    </div>
  </AdminLayout>
</template>

<script setup>
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
import { useForm } from '@inertiajs/vue3'
import axios from 'axios'

const { user, data } = defineProps({ user: Object, data: Object })

const productForm = useForm({
  name: null,
  description: null,
  price: null,
  stock: null,
  category: null,
  details: [...data.productDetails],
  images: []
})

// Get Details Lists
const getDetails = () => {
  console.log('Emit Work')
  axios.get(route('details.index')).then((response) => {
    details.value = response.data
  }).catch((error) => {
    console.log(error)
  })
}

// Detail Options
const details = ref(data.details)

// Add Detail
const createDetail = () => {

}

// Delete Detail
const deleteDetail = (id) => {
  productForm.details = productForm.details.filter((detail) => detail.id !== id)
  console.log(id)
}

</script>