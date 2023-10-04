<template>
  <ul class="list-none p-0 m-0 flex align-items-center font-medium mb-3">
    <li>
      <template v-if="secondary">
        <Link :href="primaryRoute"
              class="no-underline">
          <span class="text-500 line-height-3 hover:text-900 transition-color transition-duration-100">{{ primaryName }}</span>
        </Link>
      </template>
      <template v-else>
        <span class="text-900 line-height-3">{{ primaryName }}</span>
      </template>
    </li>
    <template v-if="secondary">
      <li class="px-2">
        <i class="pi pi-angle-right text-500 line-height-3"></i>
      </li>
      <li>
        <span class="text-900 line-height-3">{{ secondaryName }}</span>
      </li>
    </template>
  </ul>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'

const {
  primaryRoute,
  primaryName,
  secondary,
  secondaryName
} = defineProps({
  primaryRoute: String,
  primaryName: String,
  secondary: Boolean,
  secondaryName: String
})
</script>