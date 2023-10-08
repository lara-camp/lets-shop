<template>
  <Dialog
      :closable="false"
      :style="{width: '450px'}"
      :visible="dialogView" header="Confirm">
    <div class="confirmation-content">
      <i class="pi pi-exclamation-triangle mr-3" style="font-size: 2rem"/>
      <span>Are you sure you want to delete this detail?</span>
    </div>
    <template #footer>
      <Button icon="pi pi-times" label="No" text @click="close"/>
      <Button icon="pi pi-check" label="Yes" text @click="deleteProduct(productDetail)"/>
    </template>
  </Dialog>
  <Toast></Toast>
</template>

<script setup>
import Button from 'primevue/button'
import Dialog from 'primevue/dialog'
import axios from 'axios'
import Toast from 'primevue/toast'
import { useToast } from 'primevue/usetoast'

const { productDetail, dialogView } = defineProps({ productDetail: Object, dialogView: Boolean })

const deleteEmit = defineEmits(['closeDelete', 'deleteProductDetail'])
const close = () => {
  deleteEmit('closeDelete')
}

// Delete Product Detail
const statusToast = useToast()
const deleteProduct = (productDetail) => {
  deleteEmit('deleteProductDetail', productDetail.id)
  axios.delete(route('product-detail.destroy', productDetail.id)).then((reponse) => {
    console.log(reponse)
    statusToast.add({
      severity: 'success',
      summary: 'Delete Product Detail',
      detail: 'Product Detail is deleted successfully',
      life: 5000
    })
  }).then((error) => {
    console.log(error)
  })
}
</script>