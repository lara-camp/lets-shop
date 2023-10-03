<template>
  <AdminLayout>
    <div class="px-4 py-5 md:px-6 lg:px-8">
      <ul class="list-none p-0 m-0 flex align-items-center font-medium mb-3">
        <li>
          <Link :href="route('products.index')"
                class="text-500 no-underline line-height-3 cursor-pointer">Categories
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
      <div class="font-medium text-3xl text-900 mb-4">Create Categories</div>
      <form class=" justify-content-center">
        <div class=" pr-3">

          <div class="flex flex-column gap-2">
            <label class="text-xl font-medium" for="name">Category Name</label>
            <InputText id="name" v-model="title" aria-describedby="name-help"/>
            <div id="name-help" class="text-md">Error</div>
          </div>

          <div class="flex flex-column gap-2">
            <label class="text-xl font-medium" for="name">Description</label>
            <Textarea rows="5" cols="30" />
            <div id="name-help" class="text-md">Error</div>
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
import { Link } from '@inertiajs/vue3'
</script>

<style scoped></style>
