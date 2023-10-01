<template>
    <div class="m-auto" style="max-width: 1200px;" >
        <div class="grid">
            <div class="col surface-0">
                <div class="card">
                    <Carousel :value="products" :numVisible="1" :numScroll="1" circular :autoplayInterval="3000">
                        <template #item="slotProps">
                            <div class="w-full surface-0 ">
                                <img src="../../../images/slide.jpg" alt="hello" class="w-full h-13rem" style="object-fit: cover;">
                            </div>
                        </template>
                    </Carousel>
                </div>
            </div>
        </div>
        <div class="grid my-3">
            <div class="col-12">
                <img src="../../../images/banner.png" alt="" class="w-full">
            </div>
        </div>
        <CategoryCompnent />
        <FlashDealComponent/>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import Carousel from 'primevue/carousel';
import CategoryCompnent from './HomeComponent/CategoryCompnent.vue';
import FlashDealComponent from './HomeComponent/FlashDealComponent.vue';
const products = ref([
    {
        name: '../../../images/slide.jpg',
        price: 2000
    },
    {
        name: '../../../images/slide2.jpg',
        price: 2000
    }
]);


defineProps({ translations: Object })
</script>

<style>
    body{
        background: #eee;
    }
</style>
