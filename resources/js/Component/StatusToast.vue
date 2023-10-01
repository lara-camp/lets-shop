<template>
  <Toast/>
</template>

<script>
import { useToast } from 'primevue/usetoast'
import Toast from 'primevue/toast'
import { onMounted, watch } from 'vue'

export default {
  name: 'VerifyEmail',
  components: {
    Toast
  },
  props: {
    status: String,
    summary: String,
    detail: String,
    severity: String
  },
  setup (props) {
    const resentToast = useToast()

    function show () {
      if (props.status) {
        resentToast.add({
          severity: props.severity ?? 'info',
          summary: props.summary,
          detail: props.detail
        })
      }
    }

    onMounted(() => {
      show()
    })

    watch(() => props.status, (newStatus, oldStatus) => {
      show()
    })
  }
}

</script>
