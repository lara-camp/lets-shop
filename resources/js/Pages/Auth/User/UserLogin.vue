<template>
  <!-- FormLayout component for title and register redirect -->
  <FormLayout title="Login" type="login">
    <!-- Login Form -->
    <form method="post" @submit.prevent="form.post(route('login'))">
      <!-- Email Input -->
      <div class="mb-4">
        <label class="block text-900 font-medium mb-2" for="email">Email</label>
        <InputText id="email"
                   v-model="form.email"
                   :class="[form.errors.email ? 'p-invalid' : '']"
                   class="w-full"
                   name="email"
                   placeholder="Email address"
                   type="text"/>
        <div class="text-red-600 mt-1">{{ form.errors.email }}</div>
      </div>
      <!-- Password Input -->
      <div class="mb-1">
        <label class="block text-900 font-medium mb-3" for="password">Password</label>
        <InputText id="password"
                   v-model="form.password"
                   :class="[form.errors.password ? 'p-invalid' : '']"
                   class="w-full"
                   name="password"
                   placeholder="Password"
                   type="password"/>
        <div class="text-red-600 mt-1">{{ form.errors.password }}</div>
      </div>
      <!-- Forgot Password Link -->
      <div class="flex align-items-center justify-content-end mb-5">
        <Link :href="route('password.request')"
              class="font-medium no-underline text-blue-500 text-right cursor-pointer">Forgot
          password?
        </Link>
      </div>
      <!-- Submit Button -->
      <Button class="w-full mb-4" icon="pi pi-user" label="Sign In" type="submit"></Button>
      <!-- StatusToast for displaying status message -->
      <StatusToast :status="status" :detail="status" summary="Password Reset" />
    </form>
  </FormLayout>
</template>

<script setup>
import FormLayout from '../Partials/FormLayout.vue'
import InputText from 'primevue/inputtext'
import Button from 'primevue/button'
import { Link, useForm } from '@inertiajs/vue3'
import StatusToast from '../../../Component/StatusToast.vue'

defineProps({ status: String })

const form = useForm({
  email: null,
  password: null
})
</script>

<style scoped>
</style>