<template>
  <ChatContainer>
    <div class="card-body px-3 py-2 overflow-y-scroll">
      <Message type="user" message="Hi"></Message>
      <Message type="admin" message="Hello"></Message>
    </div>

    <div class="chat-footer p-2">
      <div class="p-inputgroup flex-1 border-0">
        <InputText size="small" class="font-medium" />
        <Button size="small" icon="pi-link pi" outlined/>
        <Button size="small" icon="pi-send pi"/>
      </div>
    </div>
  </ChatContainer>
</template>

<script setup>
import ChatContainer from './ChatContainer.vue'
import { usePage } from '@inertiajs/vue3'
import Button from 'primevue/button'
import { computed } from 'vue'
import InputText from 'primevue/inputtext'
import Message from './Message.vue'

const page = usePage()
const user = computed(() => page.props.user)
</script>
<style scoped>
.card-body {
  width: 420px;
  height: 420px;
  -ms-overflow-style: none;
  scrollbar-width: none;
}

.card-body::-webkit-scrollbar {
  display: none;
}

</style>