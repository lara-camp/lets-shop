<template>

    <AdminAuthLayoutVue>
        <Head title="Login"/>
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
                        autofocus
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

                    <Toast />
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
import { ref, watch } from 'vue'
import Toast from 'primevue/toast';
import AdminAuthLayoutVue from "../../../Layout/AdminAuthLayout.vue";
import { useForm } from '@inertiajs/vue3'
import { useToast } from 'primevue/usetoast';
const props=defineProps({error:String})
const error = ref(props.error || null);
const toast = useToast();

watch(()=>props.error, (newError) => {
  error.value = newError;
  if (newError) {
    form.reset()
    toast.add({ severity: 'error', summary: 'Access Denied', detail: 'You are unauthorized to access this page', life: 3000 });
    window.location.href='/dashboard/login';
    }
});

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
