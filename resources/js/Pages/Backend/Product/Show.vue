<template>
  <Head title="Product - Detail"/>
  <AdminLayout>
    <!-- Content container -->
    <div class="px-4 py-5 md:px-6 lg:px-8">

      <!-- Breadcrumb List -->
      <BreadList
          :primary-route="route('products.index')"
          :secondary="true"
          :secondary-name="`#ID - ${product.id}`"
          primary-name="Products"
      />
      <Divider/>

      <!-- Product Detail Title -->
      <div class="font-medium text-3xl text-900 mb-4">Product Detail</div>

    </div>
  </AdminLayout>
</template>

<script setup>
import AdminLayout from '../../../Layout/AdminLayout.vue'
import BreadList from '../Component/BreadList.vue'
import Divider from 'primevue/divider'
import Galleria from 'primevue/galleria'
import { asset } from '../../../asset-helper.js'
import { ref } from 'vue'
import Button from 'primevue/button'
import Dialog from 'primevue/dialog'

// Destructuring data from props
const { product } = defineProps({ product: Object })
const responsiveOptions = ref([
  {
    breakpoint: '991px',
    numVisible: 4
  },
  {
    breakpoint: '767px',
    numVisible: 3
  },
  {
    breakpoint: '575px',
    numVisible: 1
  }
])
</script>