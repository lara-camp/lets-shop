<template>
  <div class="card">
    <Toast/>
    <FileUpload :maxFileSize="1000000"
                :multiple="true"
                accept="image/*"
                name="demo[]"
                url="./upload.php"
                @upload="onAdvancedUpload($event)">
      <template #empty>
        <p>Drag and drop files to here to upload.</p>
      </template>
      <template #header="{files}">
        <p>Drag and drop files to here to upload.</p>
        {{ files }}
      </template>
    </FileUpload>
    {{ files }}
  </div>
</template>

<script setup>
import { useToast } from 'primevue/usetoast'
import FileUpload from 'primevue/fileupload'
import Toast from 'primevue/toast'
import { ref } from 'vue'

const toast = useToast()

const files = ref(null)
const onAdvancedUpload = () => {
  toast.add({ severity: 'info', summary: 'Success', detail: 'File Uploaded', life: 3000 })
}
</script>