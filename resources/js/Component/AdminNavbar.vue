<template>
    <nav>
         <div class="py-1 px-6  flex flex-row justify-content-end align-items-center flex-wrap " style="background-color:white;box-shadow:0px 0px 10px lightgrey">

                <div class="flex align-items-center justify-content-center w-4rem h-4rem  "><i class="pi pi-bell " style="font-size:22px"></i></div>
                <div class="flex align-items-center justify-content-center  ">
                    <Button type="button" @click="toggle" aria-haspopup="true" aria-controls="overlay_tmenu" class="border-circle w-3rem h-3rem surface-500 border-0"></Button>

                    <TieredMenu  ref="menu" id="overlay_tmenu" :model="items" popup >
                        <template #item="{ item }">
                                <Link v-if="item.route" method="post" :href="item.route" class=" no-underline text-black-alpha-90 ">
                                   <div class="p-3 text-lg">
                                        <i :class="item.icon"></i><span >{{item.label}}</span>
                                   </div>
                                </Link>
                        </template>
                    </TieredMenu>
                </div>
        </div>
    </nav>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import Button from 'primevue/button'
import TieredMenu from 'primevue/tieredmenu';
import { computed, ref } from "vue";

const menu = ref();
const items = ref([
    {
        label: 'Logout',
        icon: 'pi pi-sign-out',
        route: route('logout')
    }
]);
const toggle = (event) => {
    menu.value.toggle(event);
};
</script>

<style>

</style>
