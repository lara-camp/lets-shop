<template>
  <UserAuthLayout>
    <div class="surface-card p-4 shadow-2 border-round w-full xl:w-6 lg:w-9 md:w-10">
      <div class="text-center mb-5">
        <img class="w-5" src="../../../images/email_verify_logo-1.webp">
        <div class="text-900 text-3xl font-medium mb-3">Verify your email address</div>
      </div>

      <div>
        <div class="text-lg flex flex-column align-items-center mb-5">
          <div class="mb-2">We've sent email to your email address <b>{{ email }}</b></div>
          <div>Please verify your email address to continue</div>
        </div>
        <div class="flex justify-content-between align-items-center">
          <Link :href="route('page.home')">
            <Button label="Skip" outlined size="small" type="button"/>
          </Link>
          <Link :href="route('verification.send')" method="post">
            <Button label="Send Again" size="small" type="button"/>
          </Link>
        </div>
        <Toast/>
      </div>
    </div>
  </UserAuthLayout>
</template>

<script>
import UserAuthLayout from '../../Layout/UserAuthLayout.vue'
import { Link } from '@inertiajs/vue3'
import Button from 'primevue/button'
import { useToast } from 'primevue/usetoast'
import Toast from 'primevue/toast'
import { watch } from 'vue'

export default {
  name: 'VerifyEmail',
  components: {
    Link, Toast, Button, UserAuthLayout
  },
  props: {
    email: String,
    status: String,
  },
  setup (props) {
    const resentToast = useToast()

    function show () {
      resentToast.add({
        severity: 'info',
        summary: 'Email Resent',
        detail: 'Email verification has been resent'
      })
    }

    watch(() => props.status, (newStatus, oldStatus) => {
      show()
    })

  }
}


</script>

<style scoped></style>