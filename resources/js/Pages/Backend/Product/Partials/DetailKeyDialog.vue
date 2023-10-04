<template>
  <!--Product Detail Input-->
  <div class="flex flex-column mb-4">
    <div class="flex justify-content-between align-items-center">
      <div class="font-medium text-xl mb-2">New Detail Key</div>
      <Button label="Create"
              rounded
              severity="help"
              size="small"
              @click="newDetailKeyDialog = true"/>
    </div>
    <Dialog v-model:visible="newDetailKeyDialog"
            :style="{ width: '30vw' }"
            header="Create Detail Key">
      <div class="flex flex-column mb-2">
        <label class="text-xl font-medium mb-2" for="minmax-buttons"> New Key </label>
        <InputText v-model="newDetailKey"/>
        <div v-if="newDetailKeyError" class="text-md text-red-600 mt-1">
          {{ newDetailKeyError }}
        </div>
        <Button class="mt-4" label="Create" @click="createNewDetailKey"/>
      </div>
    </Dialog>
  </div>
</template>
<script>
import InputText from 'primevue/inputtext'
import Button from 'primevue/button'
import Dialog from 'primevue/dialog'
import { ref } from 'vue'
import { useToast } from 'primevue/usetoast'
import axios from 'axios'

export default {
  name: 'DetailKeyDialog',
  components: {
    InputText, Button, Dialog
  },
  setup (props, context) {

    // Create New Detail Key
    const newDetailKeyDialog = ref(false)
    const newDetailKey = ref(null)
    const newDetailKeyError = ref(null)
    const newDetailKeyToast = useToast()

    const createNewDetailKey = () => {
      axios.post(route('details.store'), {
        key: newDetailKey.value
      }).then((response) => {
        newDetailKeyError.value = null
        newDetailKeyToast.add({
          severity: 'success',
          summary: 'New Detail Key',
          detail: `New Detail Key (${response.data.key}) is created successfully`,
          life: 5000
        })
        context.emit('getDetail')
        newDetailKeyDialog.value = false
      }).catch((error) => {
        newDetailKeyError.value = error.response.data.message
      })
    }

    return { createNewDetailKey, newDetailKeyDialog, newDetailKeyError, newDetailKey }
  }
}


</script>