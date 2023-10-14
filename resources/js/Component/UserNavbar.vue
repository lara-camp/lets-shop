<template>
  <nav class="m-0 p-0">
    <div class="">
      <div class="px-5 py-3 flex flex-row justify-content-between flex-wrap "
           style="background-color:whitesmoke;box-shadow:0 0 10px lightgrey">
        <!-- //left div -->
        <div class="  flex flex-row align-items-center">
          <div class="mr-3 flex justify-content-center align-items-center">
            <img src="../../images/logo.png" width="40" alt="">
          </div>
          <div v-for="tag in tags" :key="tag.label" class="ml-6 text-xl">
            <Link :class="tag.active ? 'active' : 'text-black-alpha-90'"
                  :href="tag.route"
                  class="no-underline ">{{ tag.label }}
            </Link>
          </div>
        </div>

        <!-- right div -->
        <div class="right-div  flex flex-row align-items-center justify-content-center">
                    <span class="p-input-icon-left">
                        <i class="pi pi-search"/>
                        <InputText v-model="search" class="border-round-3xl" placeholder="Search"/>
                    </span>
          <i class="pi-shopping-cart pi mx-3" style="font-size:22px"></i>
          <i class="pi pi-bell mx-3" style="font-size:22px"></i>
          <Button aria-controls="overlay_tmenu"
                  aria-haspopup="true"
                  class="border-circle w-3rem h-3rem mx-3 bg-white border-0"
                  type="button"
                  @click="toggle"></Button>
          <TieredMenu id="overlay_tmenu" ref="menu" :model="items" popup>
            <template #item="{ item }">
              <Link v-if="item.route"
                    :href="item.route"
                    as="text"
                    class=" no-underline text-black-alpha-90 " method="post">
                <div class="p-3 text-lg">
                  <i :class="item.icon"></i><span>{{ item.label }}</span>
                </div>
              </Link>
            </template>
          </TieredMenu>
        </div>
      </div>
    </div>
  </nav>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3'
import Button from 'primevue/button'
import TieredMenu from 'primevue/tieredmenu'
import InputText from 'primevue/inputtext'

import { ref } from 'vue'
import { asset } from '../asset-helper.js'

const search = ref('')
const menu = ref()
const items = ref([
  {
    label: 'Logout',
    icon: 'pi pi-sign-out',
    route: route('logout')
  }
])

const tags = ref([
  {
    label: 'Home',
    active: router.page.url === '/' ?? false,
    route: route('page.home')
  },
  {
    label: 'Shop',
    active: router.page.url === '/shop' ?? false,
    route: route('page.shop')
  }
])

const toggle = (event) => {
  menu.value.toggle(event)
}

</script>

<style>
.active {
  color: var(--primary-color);
}
</style>
