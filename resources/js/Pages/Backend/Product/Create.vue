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
      <form class="grid justify-content-center">
        <div class="col-6 pr-5">

          <!--Product Name Input-->
          <div class="flex flex-column mb-4">
            <label class="text-xl font-medium mb-2" for="name">Product Name</label>
            <InputText id="name" placeholder="Name"/>
            <div class="text-md text-red-600">Error</div>
          </div>

          <!--Product Price Input-->
          <div class="flex flex-column mb-4">
            <label class="text-xl font-medium mb-2" for="currency-mmk"> Price </label>
            <InputNumber currency="MMK"
                         inputId="currency-mmk"
                         locale="en-US"
                         mode="currency"
                         placeholder="MMK"/>
            <div class="text-md text-red-600">Error</div>
          </div>

          <!--Product Stock Input-->
          <div class="flex flex-column mb-4">
            <label class="text-xl font-medium mb-2" for="minmax-buttons"> Stocks </label>
            <InputNumber v-model="value1"
                         :max="1000"
                         :min="1"
                         inputId="minmax-buttons"
                         mode="decimal"
                         showButtons/>
            <div class="text-md text-red-600">Error</div>
          </div>

          <!--Product Category Input-->
          <div class="flex flex-column mb-4">
            <label class="text-xl font-medium mb-2" for="minmax-buttons"> Category </label>
            <CascadeSelect v-model="selectedCity"
                           :optionGroupChildren="['level2']"
                           :options="categories"
                           optionGroupLabel="name"
                           optionLabel="name"
                           placeholder="Select a Category"/>
            <div class="text-md text-red-600">Error</div>
          </div>

          <!--Product Description Input-->
          <div class="flex flex-column mb-5">
            <label class="text-xl font-medium mb-2" for="description">Description</label>
            <Textarea id="description" cols="30" rows="5"/>
            <div class="text-md text-red-600">Error</div>
          </div>


          <Button label="Create Product"/>
        </div>
        <div class="col-6 pl-5">

          <!--Product Pictures Input-->
          <div class="flex flex-column mb-4">
            <div class="font-medium text-xl mb-2">Pictures</div>
            <FileUpload></FileUpload>
          </div>
          <!--Product Detail Input-->
          <div class="flex flex-column mb-4">
            <div class="font-medium text-xl mb-2">Detail</div>
            <MultiSelect v-model="selectedCities"
                         :maxSelectedLabels="3"
                         :options="cities"
                         filter
                         optionLabel="name"
                         placeholder="Select Detail"/>
            <div class="text-md text-red-600">Error</div>
          </div>

          <!--Product Detail Create-->
          <div class="flex flex-column mb-4">
            <div class="flex  justify-content-between align-items-center mb-3">
              <div class="font-medium text-xl mb-2">New Detail</div>
              <Button icon="pi pi-plus" rounded severity="help" size="small"/>
            </div>
            <!--Product Detail Key-->
            <div class="flex mb-3">
              <div class="w-full">
                <InputText id="key" class="w-full" placeholder="Key" size="small"/>
                <div class="text-sm text-red-600"></div>
              </div>
              <Divider layout="vertical"/>
              <!--Product Detail Value-->
              <div class="w-full">
                <InputText id="value" class="w-full" placeholder="Value" size="small"/>
                <div class="text-sm text-red-600"></div>
              </div>
              <Button
                  class="ml-3 flex-shrink-0"
                  icon="pi pi-times"
                  outlined
                  severity="danger"
                  size="small"/>
            </div>
          </div>

        </div>
      </form>
    </div>
  </AdminLayout>
</template>

<script setup>
import FileUpload from '../Component/FileUpload.vue'
import AdminLayout from '../../../Layout/AdminLayout.vue'
import Divider from 'primevue/divider'
import Textarea from 'primevue/textarea'
import InputText from 'primevue/inputtext'
import InputNumber from 'primevue/inputnumber'
import CascadeSelect from 'primevue/cascadeselect'
import MultiSelect from 'primevue/multiselect'
import Button from 'primevue/button'
import { Link } from '@inertiajs/vue3'
import { ref } from 'vue'

const value1 = ref(1)

const selectedCities = ref()
const cities = ref([
  { name: 'Type - Leather', code: 'NY' },
  { name: 'Rome', code: 'RM' },
  { name: 'London', code: 'LDN' },
  { name: 'Istanbul', code: 'IST' },
  { name: 'Paris', code: 'PRS' }
])
const categories = ref([
  {
    name: 'Men',
    level2: [
      {
        name: 'Men Shirt',
      },
      {
        name: 'Men Pant',
      }
    ]
  },
  {
    name: 'Women',
    level2: [
      {
        name: 'Women Dress',
      },
      {
        name: 'Women Pant',
      }
    ]
  },
  {
    name: 'Child',
    level2: [
      {
        name: 'Child Shirt',
      },
      {
        name: 'Child Pant'
      },
      {
        name: 'Child Hat'
      }
    ]
  }
])
</script>

<style scoped></style>