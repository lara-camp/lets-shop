<template>
    <nav class="m-0 p-0">
       <div class="">
            <div class="px-5 py-3 flex flex-row justify-content-between flex-wrap " style="background-color:whitesmoke;box-shadow:0px 0px 10px lightgrey">
                <!-- //left div -->
                <div class="  flex flex-row align-items-center">
                    <div class="mr-3 text-5xl">Logo</div>
                    <div v-for="tag in tags" :key="tag.label" class="ml-6 text-xl">
                        <Link :class="tag.active ? 'active' : 'text-black-alpha-90'" :href="tag.route" class="no-underline " >{{tag.label}}</Link>
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
                        <template #item="{ item  }">
                                <Link v-if="item.route" method="post" :href="item.route" class=" no-underline text-black-alpha-90 ">
                                   <div class="p-3 text-lg">
                                        <i :class="item.icon"></i><span >{{item.label}}</span>
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
import {Link, router} from '@inertiajs/vue3'
import Button from 'primevue/button'
import TieredMenu from 'primevue/tieredmenu';
import InputText from 'primevue/inputtext';


import { computed, ref } from "vue";

const menu = ref();
const items = ref([
    {
        label: 'Logout',
        icon: 'pi pi-sign-out',
        route: route('logout')
    }
]);
const tags =ref([
    {
        label:'Home',
        active:router.page.url === '/dashboard' ?? false,
        route: route('page.home')
    },
    {
        label:'Shop',
        active:router.page.url === '/shop' ?? false,
        route: route('page.shop')
    }
])


const toggle = (event) => {
    menu.value.toggle(event);
};

</script>

<style >
.active{
    color: var(--primary-color);
}

</style>
