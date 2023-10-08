<template>
  <Dialog :closable="false"
          :dismissableMask="true"
          :style="{width: '650px'}"
          :visible="dialogView"
          header="Flash Discount">
    <div>
      <div class="flex flex-column mb-3">
        <label class="font-bold block mb-2" for="percent"> Percentage </label>
        <InputNumber v-model="percent" :max="100" :min="1" inputId="percent" prefix="% "/>
      </div>
      <div class="flex flex-column mb-3">
        <label class="font-bold block mb-2" for="percent"> Timeline </label>
        <Dropdown v-model="selectedTimeline"
                  :options="timelines"
                  class="w-full"
                  filter
                  optionLabel="name"
                  placeholder="Select the timeline">
        </Dropdown>
      </div>
    </div>
    <template #footer>
      <Button icon="pi pi-times" label="Cancel" text @click="close"/>
      <Button icon="pi pi-check" label="Create" text @click="flashProduct(product)"/>
    </template>
  </Dialog>
</template>

<script setup>
import Button from 'primevue/button'
import Dialog from 'primevue/dialog'
import InputNumber from 'primevue/inputnumber'
import Dropdown from 'primevue/dropdown'
import { ref } from 'vue'

const { product, dialogView } = defineProps({ product: Object, dialogView: Boolean })

const percent = ref(null)
const selectedTimeline = ref()
const timelines = ref([
  { name: 'Australia', code: 'AU' },
  { name: 'Brazil', code: 'BR' },
  { name: 'China', code: 'CN' },
  { name: 'Egypt', code: 'EG' },
  { name: 'France', code: 'FR' },
  { name: 'Germany', code: 'DE' },
  { name: 'India', code: 'IN' },
  { name: 'Japan', code: 'JP' },
  { name: 'Spain', code: 'ES' },
  { name: 'United States', code: 'US' }
])

const noDeleteEmit = defineEmits(['closeFlash', 'flashProduct'])
const close = () => {
  noDeleteEmit('closeFlash')
}
const flashProduct = (product) => {
  noDeleteEmit('flashProduct', product)

}
</script>