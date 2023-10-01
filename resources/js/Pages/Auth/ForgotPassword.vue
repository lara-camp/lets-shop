<template>
  <UserAuthLayout>
    <div class="surface-card p-4 shadow-2 border-round w-full xl:w-6 lg:w-9 md:w-10">
      <div class="text-center mb-3">
        <img class="w-5" src="../../../images/forgot_password.jpg">
        <div class="text-900 text-3xl font-medium">Forgot Password</div>
      </div>
      <div class="flex flex-column mx-5">
        <div class="text-center mb-4 text-700">Enter the email associated with your account and
          we'll
          send you a link to reset your password.
        </div>
        <form class="mx-6 mb-4" method="post" @submit.prevent="form.post(route('password.email'))">
          <InputText v-model="form.email"
                     :class="[form.errors.email ? 'p-invalid' : '']"
                     class="mb-1 w-full"
                     placeholder="Email"
                     type="email"></InputText>
          <div class="text-red-600 mb-4">{{ form.errors.email }}</div>
          <Button class="w-full" label="Reset" size="small" type="submit"/>
        </form>
        <Link :href="route('login')"
              class="font-medium text-600 no-underline text-center cursor-pointer flex align-items-center justify-content-center">
          <i class="pi pi-angle-left mr-1"></i>
          <div>Back to Login</div>
        </Link>
        <StatusToast :status="status"
                     detail="Password reset link has been sent"
                     summary="Reset Password"/>
      </div>
    </div>
  </UserAuthLayout>
</template>

<script>
import UserAuthLayout from '../../Layout/UserAuthLayout.vue'
import { Link, useForm } from '@inertiajs/vue3'
import Button from 'primevue/button'
import InputText from 'primevue/inputtext'
import StatusToast from '../../Component/StatusToast.vue'

export default {
  name: 'VerifyEmail',
  components: {
    Link, StatusToast, Button, UserAuthLayout, InputText
  },
  props: {
    email: String,
    status: String,
  },
  setup () {
    const form = useForm({
      email: null
    })

    return { form }
  }
}

</script>
