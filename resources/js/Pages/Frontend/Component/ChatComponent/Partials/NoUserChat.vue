<template>
  <ChatContainer>
    <div class="card-body bg-white flex justify-content-center align-items-center">
      <Link :href="route('login')">
        <Button>Login to message</Button>
      </Link>
    </div>
  </ChatContainer>
</template>

<script setup>
import ChatContainer from './ChatContainer.vue'
import { Link } from '@inertiajs/vue3'
import Button from 'primevue/button'
</script>
<style scoped>
.card-body {
  height: 420px;
  width: 420px;
}

</style>