<template>
  <UserAuthLayout>
    <div class="grid shadow-2">
      <div class="col-6 p-4 form-left-container">
        <div>Logo</div>
        <div>Welcome to Let's Shop</div>
        <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium libero nemo optio
          repellat
        </div>
      </div>
      <div class=" col-6 bg-white pt-5 pb-5 px-7">
        <div class="text-900 text-2xl font-medium my-5">{{ title }}</div>
        <slot></slot>
        <hr class="hr-text mb-4" data-content="OR">
        <a :href="route('oauth.google')">
          <Button class="w-full mb-5"
                  icon="pi pi-google"
                  label="Continue with Google"
                  severity="secondary"></Button>
        </a>
        <div v-if="type === 'login'" class="text-center">
          <span class="text-600 font-medium line-height-3">Don't have an account?</span>
          <a :href="route('register')"
                class="font-medium no-underline ml-2 text-blue-500 cursor-pointer">Register Now!
          </a>
        </div>
        <div v-else class="text-center">
          <span class="text-600 font-medium line-height-3">Already has an account?</span>
          <Link :href="route('login')"
                class="font-medium no-underline ml-2 text-blue-500 cursor-pointer">Login Now!
          </Link>
        </div>
      </div>
    </div>
  </UserAuthLayout>
</template>

<script setup>
import UserAuthLayout from '../../../Layout/UserAuthLayout.vue'
import Button from 'primevue/button'
import { Link } from '@inertiajs/vue3'

defineProps(['title', 'type'])
</script>

<style scoped>
.form-left-container {
  background: rgba(255, 255, 255, 0.47);
}

.hr-text {
  position: relative;
  outline: 0;
  border: 0;
  color: black;
  text-align: center;
  opacity: .5;

  &:before {
    content: '';
    background: #c4c4c4;
    position: absolute;
    left: 0;
    top: 50%;
    width: 100%;
    height: 1px;
  }

  &:after {
    content: attr(data-content);
    position: relative;
    display: inline-block;
    padding: 0 10px;
    color: #424242;
    background-color: #fcfcfa;
  }
}
</style>