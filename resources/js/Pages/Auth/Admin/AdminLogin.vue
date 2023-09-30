<template>
    <AdminAuthLayoutVue>
        <div class="surface-card p-4 shadow-2 border-round w-full lg:w-6">
            <div class="text-center mb-5">
                <img
                    src="../../../../images/logo.png"
                    alt="Image"
                    height="150"
                    class="mb-3"
                />
                <div class="text-900 text-3xl font-medium mb-3">
                    Welcome Admin
                </div>
        </div>
        <form @submit.prevent="form.post('/dashboard/login')">
                <div>
                    <label for="email1" class="block text-900 font-medium mb-2"
                        >Email</label
                    >
                    <InputText
                        id="email1"
                        type="text"
                        placeholder="Email address"
                        class="w-full mb-3"
                        name="email"
                        v-model="form.email"
                    />
                    <div v-if="form.errors.email" class="text-red-500 mb-4">{{ form.errors.email }}</div>

                    <label for="password1" class="block text-900 font-medium mb-2"
                        >Password</label
                    >
                    <InputText
                        id="password1"
                        type="password"
                        placeholder="Password"
                        class="w-full mb-3"
                        name="password"
                        v-model="form.password"

                    />
                    <div v-if="form.errors.password"  class="text-red-500 mb-4">{{ form.errors.password }}</div>


                    <Button
                        label="Sign In"
                        icon="pi pi-user"
                        class="w-full"
                        type="submit"
                    ></Button>
                </div>
            </form>
        </div>
    </AdminAuthLayoutVue>
</template>

<script setup>

import AdminAuthLayoutVue from "../../../Layout/AdminAuthLayout.vue";
import { useForm } from '@inertiajs/vue3'

const form = useForm({
  email: null,
  password: null,
})

</script>

<style>
    body{
        overflow: hidden;
        margin: 0;
    }
</style>
