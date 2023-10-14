<template>
  <Head title="Messages"/>
  <AdminLayout>
    <div class="px-4 py-5 md:px-6 lg:px-8">
      <ul class="list-none p-0 m-0 flex align-items-center font-medium mb-3">
        <li>
          <span class="text-900 line-height-3">Messages</span>
        </li>
      </ul>
      <Divider/>
      <div class="font-medium text-3xl text-900">Messages</div>

      <div>Chat</div>
      {{ user }}

    </div>
  </AdminLayout>
</template>

<script setup>
import AdminLayout from '../../../Layout/AdminLayout.vue'
import { onMounted ,computed} from 'vue'
import Divider from 'primevue/divider'
import {usePage} from '@inertiajs/vue3'

const page = usePage()
const user = computed(() => page.props.user)

onMounted(() => {
  Pusher.logToConsole = true
})

</script>
