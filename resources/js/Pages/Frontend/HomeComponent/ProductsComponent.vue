<template>
    <div class="grid">
        <div class="col-11 m-auto ">
            <h2 class="font-semibold text-center text-primary my-3 text-4xl home-header">Products</h2>
        </div>
        <div class="col-11 grid m-auto " >
            <div class="col-3" v-for="product in products" :key="product.id">
                <div class="card col w-10 relative m-auto cursor-pointer" @click="details(product.slug)">
                    <div class="card-img">
                        <img :src="asset(product.image)" alt=""
                            class="w-full h-20rem overflow-hidden border-round-md" style="object-fit: cover;">
                    </div>
                    <div class="card-text">
                        <h3 class="m-0 pt-1 w-18rem h-4rem text-gray-900 font-normal" style="white-space: wrap;">{{ product.name
                        }}</h3>
                         <Rating v-model="product.stars" readonly :cancel="false"/>
                        <div class="flex">
                            <p class="m-0 py-2 text-xl font-bold text-primary">Ks {{ product.price }}</p>
                            <p class="text-sm line-through text-gray-500 mx-2">Ks 200</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import {asset} from '../../../asset-helper';
import Rating from 'primevue/rating';
import { router } from '@inertiajs/vue3';
import InputNumber from 'primevue/inputnumber';


defineProps({ translations: Object, products:Array })
const details = (slug)=>{
    // alert(slug)
   router.get(route('page.detail',slug),{},{
            preserveState:true,
            preserveScroll:true,
   });
}
</script>

<style  scoped></style>
