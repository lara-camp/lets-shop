<template>
  <div class="card shadow-3 border-round  overflow-hidden">
    <div class="card-header bg-primary text-white px-4 py-3 flex justify-content-between align-items-center">
      <div class="text-lg font-medium">Send Message</div>
      <i class="pi pi-times cursor-pointer" @click="$emit('close')"></i>
    </div>
    <slot></slot>
  </div>
</template>

<script setup>

</script>