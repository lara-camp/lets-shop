<template>
  <FormLayout title="Register" type="register">
    <form method="post" @submit.prevent="form.post(route('register'))">
      <div class="mb-4">
        <label class="block text-900 font-medium mb-2" for="name">Username</label>
        <InputText id="name"
                   v-model="form.name"
                   :class="[form.errors.name ? 'p-invalid' : '']"
                   class="w-full"
                   placeholder="Username"
                   type="text"/>
        <div class="text-red-600 mt-1">{{ form.errors.name }}</div>
      </div>
      <div class="mb-4">
        <label class="block text-900 font-medium mb-2" for="email">Email</label>
        <InputText id="email"
                   v-model="form.email"
                   :class="[form.errors.email ? 'p-invalid' : '']"
                   class="w-full"
                   placeholder="Email address"
                   type="text"/>
        <div class="text-red-600 mt-1">{{ form.errors.email }}</div>
      </div>
      <div class="mb-4">
        <label class="block text-900 font-medium mb-3" for="password">Password</label>
        <InputText id="password"
                   v-model="form.password"
                   :class="[form.errors.password ? 'p-invalid' : '']"
                   class="w-full"
                   placeholder="Password"
                   type="password"/>
        <div class="text-red-600 mt-1">{{ form.errors.password }}</div>
      </div>
      <div class="mb-5">
        <label class="block text-900 font-medium mb-2" for="password_confirmation">Confirm
          Password</label>
        <InputText id="password_confirmation"
                   v-model="form.password_confirmation"
                   :class="[form.errors.password_confirmation ? 'p-invalid' : '']"
                   class="w-full"
                   placeholder="Confirm Password"
                   type="password"/>
        <div class="text-red-600 mt-1">{{ form.errors.password_confirmation }}</div>
      </div>
      <Button class="w-full mb-4" icon="pi pi-user" label="Register" type="submit"></Button>
    </form>
  </FormLayout>
</template>

<script setup>
import FormLayout from '../Partials/FormLayout.vue'
import InputText from 'primevue/inputtext'
import Button from 'primevue/button'
import { useForm } from '@inertiajs/vue3'

const form = useForm({
  name: null,
  email: null,
  password: null,
  password_confirmation: null
})
</script>

<style scoped>
</style>