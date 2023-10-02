<template>
  <AdminLayout>
    <div class=" px-4 py-5 md:px-6 lg:px-8">
      <ul class="list-none p-0 m-0 flex align-items-center font-medium mb-3">
        <li>
          <span class="text-900 line-height-3">Products</span>
        </li>
      </ul>
      <div class="flex align-items-start flex-column lg:justify-content-between lg:flex-row">
        <div>
          <div class="font-medium text-3xl text-900">Products</div>

        </div>
        <div class="mt-3 lg:mt-0">
          <Link :href="route('products.create')"><Button label="Create" icon="pi pi-plus"></Button></Link>
        </div>
      </div>


    </div>
  </AdminLayout>
</template>

<script setup>
import {Link} from '@inertiajs/vue3'
import Button from 'primevue/button'
import AdminLayout from '../../../Layout/AdminLayout.vue'
</script>

<style scoped></style>
