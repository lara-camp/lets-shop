<template>
  <div>
    FUCK
  </div>
</template>

<script setup>
import {onMounted} from 'vue'

onMounted(() => {
  Pusher.logToConsole = true;
  Echo.channel("test-broadcast").listen('.App\\Events\\TestBroadcast', (payload) => {
    console.log(payload)
  })
})
</script>



