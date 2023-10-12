<template>
  <div class="chat-popup">
    <div v-if="!onChat"
         class="rounded-circle bg-secondary d-flex justify-content-center align-items-center"
         style="width: 100px; height: 100px;"
         @click="showChat">
      {{user}}
    </div>
    <div v-else>
      <div>Chat Box</div>
      <div class="card">
        <div class="card-body">
         Chat
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { onMounted, ref } from 'vue'

const onChat = ref(false)
const {user} = defineProps({user : Object})
const showChat = () => {
  onChat.value = true
}

onMounted(() => {
  Pusher.logToConsole = true
})

</script>

<style scoped>
.card-body {
  height: 400px;
  width: 400px;
  display: flex;
  flex-direction: column;
  justify-content: end;
}


.chat-popup {
  position: fixed;
  bottom: 20px;
  right: 20px;
}

</style>