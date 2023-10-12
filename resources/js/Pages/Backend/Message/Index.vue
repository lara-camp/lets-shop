<template>
  <AdminLayout>
    <div>Chat</div>
    {{ user }}
  </AdminLayout>
</template>

<script setup>
import AdminLayout from '../../../Layout/AdminLayout.vue'
import { onMounted } from 'vue'

const { user } = defineProps({ user: Object })

onMounted(() => {
  Pusher.logToConsole = true
})

</script>
