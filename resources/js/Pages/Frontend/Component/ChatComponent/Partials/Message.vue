<template>
  <div v-if="type === 'admin'" class="flex align-items-start justify-content-start mt-2">
    <div class="border-circle bg-primary mt-1  mr-2 w-2rem h-2rem flex justify-content-center align-items-center flex-shrink-0">
      <i class="pi pi-user"></i>
    </div>
    <div class="bg-gray-100 p-2 border-round text-base">
      {{message}}
    </div>
  </div>

  <div v-if="type === 'user'" class="flex align-items-start justify-content-end mt-2">
    <div class="bg-gray-100 p-2 border-round text-base">
      {{message}}
    </div>
    <div class="border-circle bg-primary mt-1 ml-2 w-2rem h-2rem flex justify-content-center align-items-center flex-shrink-0">
      <i class="pi pi-user"></i>
    </div>
  </div>
</template>

<script setup>
const {type, message} = defineProps({type: String, message : String})
</script>

<style scoped></style>