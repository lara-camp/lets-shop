<template>
  {{ user }}
  <div class="chat-popup-container ">
    <div v-if="!onChat"
         class="border-circle bg-primary flex justify-content-center align-items-center text-white cursor-pointer"
         style="width: 80px; height: 80px;"
         @click="onChat = !onChat">
      <i class="pi pi-comment" style="font-size: 2.5rem"></i>
    </div>
    <div v-else-if="!user">
      <NoUserChat @close="onChat = !onChat"></NoUserChat>
    </div>
    <div v-else>
      <UserChat @close="onChat = !onChat"></UserChat>
    </div>
  </div>
</template>

<script setup>
import { computed, onMounted, ref } from 'vue'
import { usePage } from '@inertiajs/vue3'
import NoUserChat from './Partials/NoUserChat.vue'
import UserChat from './Partials/UserChat.vue'

const page = usePage()
const user = computed(() => page.props.user)
const onChat = ref(false)

onMounted(() => {
  Pusher.logToConsole = true
})

</script>

<style scoped>
.chat-popup-container {
  position: fixed;
  bottom: 30px;
  right: 20px;
  z-index: 100;
}
</style>
