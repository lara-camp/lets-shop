<template>
  <div v-if="galleries.length > 0" class="card flex justify-content-center mb-6">
    <Galleria :numVisible="3"
              :responsiveOptions="responsiveOptions"
              :value="galleries">
      <template #item="slotProps">
        <div class="bg-black-alpha-90 p-3 relative">
          <img :src="asset(slotProps.item.image)" :alt="slotProps.item.image"  class="h-30rem"/>
          <Button class="absolute"
                  icon="pi pi-trash"
                  rounded
                  severity="danger"
                  style="top: 20px;right: 20px"
                  @click="deleteDialog = true"></Button>
        </div>

        <Dialog v-model:visible="deleteDialog" :style="{ width: '20vw' }" header="Are you sure?">
          <div class="text-lg font-medium">You are going to delete this image.</div>
          <template #footer>
            <Button icon="pi pi-times" label="No" text @click="deleteDialog = false"/>
            <Button autofocus
                    icon="pi pi-check"
                    label="Yes"
                    @click="deleteImage(slotProps.item.id)"/>
          </template>
        </Dialog>
      </template>
      <template #thumbnail="slotProps">
        <img :src="asset(slotProps.item.image)"  :alt="slotProps.item.image" class="h-5rem mx-1"/>
      </template>
    </Galleria>

  </div>
  <div v-else
       class="card py-7 text-2xl font-bold text-center border-1 border-400 border-round-2xl text-black-alpha-50 my-4">
    No Image
  </div>
</template>

<script setup>
import { ref } from 'vue'
import Galleria from 'primevue/galleria'
import Button from 'primevue/button'
import Dialog from 'primevue/dialog'
import { asset } from '../../../../asset-helper.js'
import { useToast } from 'primevue/usetoast'
import axios from 'axios'

const { galleries } = defineProps({ galleries: Array })

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

// Delete Product Image Confirm Dialog
const deleteDialog = ref(false)
const deleteEmit = defineEmits(['deleteImage'])

// Delete Product Image Function
const deleteToast = useToast()
const deleteImage = (imageId) => {
  deleteDialog.value = false
  deleteEmit('deleteImage', imageId)
  axios.delete(route('product-images.destroy', imageId)).then((response) => {
    deleteToast.add({
      severity: 'success',
      summary: 'Image Delete',
      detail: 'Product Image is deleted successfully',
      life: 3000
    })
  }).catch((error) => {
    console.log(error)
  })
}
</script>