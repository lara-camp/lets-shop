<template>
  <AdminAuthLayoutVue>
    <Head title="Dashboard Login"/>
    <!-- Card for Login Form -->
    <div class="surface-card p-5 pt-6  shadow-2 border-round w-full lg:w-6">
      <div class="text-center mb-5">
        <!-- Logo Image -->
        <img
            alt="Image"
            class="mb-3"
            height="80"
            src="../../../../images/logo.png"
        />
        <div class="text-900 text-3xl font-medium mb-3">
          Welcome Admin
        </div>
      </div>
      <!-- Login Form -->
      <form @submit.prevent="form.post(route('admin.login'))">

        <!-- Email Input -->
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
        <!-- Email Input Error Message -->
        <div v-if="form.errors.email" class="text-red-600">{{ form.errors.email }}</div>

        <!-- Password Input -->
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
        <!-- Password Input Error Message -->
        <div v-if="form.errors.password" class="text-red-600">{{
            form.errors.password
          }}
        </div>
        <!-- Unauthorized Access Status Toast -->
        <StatusToast :detail="status"
                     :status="status"
                     severity="error"
                     summary="Unauthorized Access"/>
        <!-- Submit Button -->
        <Button
            class="w-full mt-4"
            icon="pi pi-user"
            label="Sign In"
            type="submit"
        ></Button>
      </form>
    </div>
  </AdminAuthLayoutVue>
</template>

<script setup>
import AdminAuthLayoutVue from '../../../Layout/AdminAuthLayout.vue'
import { useForm } from '@inertiajs/vue3'
import InputText from 'primevue/inputtext'
import Button from 'primevue/button'
import StatusToast from '../../../Component/StatusToast.vue'
import {asset} from '../../../asset-helper'
defineProps({ status: String })

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
