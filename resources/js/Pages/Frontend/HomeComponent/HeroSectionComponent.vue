<template>
    <div class="grid w-full my-3">
        <div class="col surface-0">
            <div class="card">
                <Carousel :value="products" :numVisible="1" :numScroll="1" circular :autoplayInterval="3000">
                    <template #item="slotProps">
                        <div class="w-full surface-0 ">
                            <img :src="asset('product_img/'+slotProps.data.name)" alt="hello" class="w-full" style="object-fit: cover;">
                        </div>
                    </template>
                </Carousel>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import Carousel from 'primevue/carousel';
import {asset} from '../../../asset-helper'
const products = ref([
    {
        name: 'hero.jpg',
        price: 2000
    },
    {
        name: 'hero2.jpg',
        price: 2000
    }
]);

console.log(products.value)

defineProps({ translations: Object })
</script>

<style  scoped></style>
