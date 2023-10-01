<template>

  <AdminAuthLayoutVue>
    <Head title="Login"/>
    <div class="surface-card p-4 shadow-2 border-round w-full lg:w-6">
      <div class="text-center mb-5">
        <img
            alt="Image"
            class="mb-3"
            height="126"
            src="../../../../images/logo.png"
        />
        <div class="text-900 text-3xl font-medium mb-3">
          Welcome Admin
        </div>
      </div>
      <form @submit.prevent="form.post('/dashboard/login')">

        <div>
          <label class="block text-900 font-medium mb-2" for="email1"
          >Email</label
          >
          <InputText
              id="email1"
              v-model="form.email"
              autofocus
              class="w-full mb-1"
              name="email"
              placeholder="Email address"
              type="text"
          />
          <div v-if="form.errors.email" class="text-red-600">{{ form.errors.email }}</div>

          <label class="block text-900 font-medium mb-2 mt-3" for="password1"
          >Password</label
          >
          <InputText
              id="password1"
              v-model="form.password"
              class="w-full mb-1"
              name="password"
              placeholder="Password"
              type="password"

          />
          <div v-if="form.errors.password" class="text-red-600">{{
              form.errors.password
            }}
          </div>
          <Toast/>
          <Button
              class="w-full mt-4"
              icon="pi pi-user"
              label="Sign In"
              type="submit"
          ></Button>
        </div>
      </form>
    </div>
  </AdminAuthLayoutVue>
</template>

<script setup>
import { ref, watch } from 'vue'
import Toast from 'primevue/toast'
import AdminAuthLayoutVue from '../../../Layout/AdminAuthLayout.vue'
import { useForm } from '@inertiajs/vue3'
import { useToast } from 'primevue/usetoast'
import InputText from 'primevue/inputtext'
import Button from 'primevue/button'

const props = defineProps({ error: String })
const error = ref(props.error || null)
const toast = useToast()

watch(() => props.error, (newError) => {
  error.value = newError
  if (newError) {
    form.reset()
    toast.add({
      severity: 'error',
      summary: 'Access Denied',
      detail: 'You are unauthorized to access this page',
      life: 3000
    })
    window.location.href = '/dashboard/login'
  }
})

const form = useForm({
  email: null,
  password: null,
})

</script>

<style>
body {
  overflow: hidden;
  margin: 0;
}
</style>
