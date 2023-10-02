<template>
    <nav class="m-0 p-0">
       <div class="">
            <div class="px-5 py-3 flex flex-row justify-content-between flex-wrap " style="background-color:whitesmoke;box-shadow:0px 0px 10px lightgrey">
                <!-- //left div -->
                <div class="  flex flex-row align-items-center">
                    <div class="mr-3 text-5xl">Logo</div>
                    <div class="ml-6 text-1xl">
                        <Link href="" class="no-underline text-black-alpha-50 ">Shop</Link>
                    </div>
                    <div class="ml-6 text-1xl">
                        <Link href="" class="no-underline text-black-alpha-50">Category</Link>
                    </div>
                    <div class="ml-6 text-1xl">
                        <Link href="" class="no-underline text-black-alpha-50">Hot Slide</Link>
                    </div>

                </div>

                <!-- right div -->
                <div class="right-div  flex flex-row align-items-center justify-content-center">
                    <span class="p-input-icon-left">
                        <i class="pi pi-search" />
                        <InputText v-model="search" placeholder="Search"  class="border-round-3xl"/>
                    </span>
                    <i class="pi-shopping-cart pi mx-3" style="font-size:22px"></i>
                    <i class="pi pi-bell mx-3" style="font-size:22px"></i>
                    <Button type="button" @click="toggle" aria-haspopup="true" aria-controls="overlay_tmenu" class="border-circle w-3rem h-3rem mx-3 bg-white border-0"></Button>
                    <TieredMenu  ref="menu" id="overlay_tmenu" :model="items" popup >

                    </TieredMenu>
                </div>
            </div>
        </div>
    </nav>
</template>

<script setup>
import {Link} from '@inertiajs/vue3'
import Button from 'primevue/button'
import TieredMenu from 'primevue/tieredmenu';
import InputText from 'primevue/inputtext';


import { computed, ref } from "vue";

const menu = ref();
const items = ref([
    {
        label: 'Logout',
        icon: 'pi pi-sign-out',
    }
]);
const toggle = (event) => {
    menu.value.toggle(event);
};

</script>





<style >

</style>
