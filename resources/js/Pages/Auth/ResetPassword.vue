<template>
  <UserAuthLayout>
    <div class="surface-card p-4 shadow-2 border-round w-full xl:w-6 lg:w-9 md:w-10">
      <div class="text-center mb-3">
        <img class="w-5" src="../../../images/forgot_password.jpg">
        <div class="text-900 text-3xl font-medium">Reset Password</div>
      </div>

      <div class="flex flex-column mx-5">
        <div class="text-center mb-4 text-700">Enter your new password.
        </div>
        <form class="mx-6 mb-4" method="post" @submit.prevent="form.post(route('password.update'))">
          <div class="mb-4">
            <InputText v-model="form.password"
                       :class="[form.errors.password ? 'p-invalid' : '']"
                       class="mb-1 w-full"
                       placeholder="Password"
                       type="password"></InputText>
            <div class="text-red-600">{{ form.errors.password }}</div>
          </div>
          <div class="mb-4">
            <InputText v-model="form.password_confirmation"
                       :class="[form.errors.password_confirmation ? 'p-invalid' : '']"
                       class="mb-1 w-full"
                       placeholder="Confirm Password"
                       type="password"></InputText>
            <div class="text-red-600">{{ form.errors.password_confirmation }}</div>
          </div>
          <Button class="w-full" label="Submit" size="small" type="submit"/>
        </form>
        <Link :href="route('login')"
              class="font-medium text-600 no-underline text-center cursor-pointer flex align-items-center justify-content-center">
          <i class="pi pi-angle-left mr-1"></i>
          <div>Back to Login</div>
        </Link>
      </div>
    </div>
  </UserAuthLayout>
</template>

<script>
import UserAuthLayout from '../../Layout/UserAuthLayout.vue'
import { Link, useForm } from '@inertiajs/vue3'
import Button from 'primevue/button'
import InputText from 'primevue/inputtext'

export default {
  name: 'VerifyEmail',
  components: {
    Link, Button, UserAuthLayout, InputText
  },
  props: {
    email: String,
    status: String,
    reset_token: String,
  },
  setup (props) {
    const form = useForm({
      email: props.email,
      password: null,
      password_confirmation: null,
      token: props.reset_token,
    })
    return { form }
  }
}
</script>