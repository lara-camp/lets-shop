<template>
  <Dialog  :visible="dialogView"
          :dismissableMask="true"
           :closable="false"
          :style="{width: '650px'}"
          header="Confirm">
    <div class="confirmation-content">
      <i class="pi pi-exclamation-triangle mr-3" style="font-size: 2rem"/>
      <span>Are you sure you want to delete <b>{{
          product.name
        }}</b>?</span>
    </div>
    <template #footer>
      <Button icon="pi pi-times" label="No" text @click="close"/>
      <Button icon="pi pi-check" label="Yes" @click="deleteProduct(product)" text />
    </template>
  </Dialog>
</template>

<script setup>
import Button from 'primevue/button'
import Dialog from 'primevue/dialog'

const { product, dialogView } = defineProps({ product: Object, dialogView: Boolean })

const noDeleteEmit = defineEmits(['closeFlash','flashProduct'])
const close = () => {
  noDeleteEmit('closeFlash')
}

const deleteProduct = (product) => {
  noDeleteEmit('flashProduct', product)

}
</script>