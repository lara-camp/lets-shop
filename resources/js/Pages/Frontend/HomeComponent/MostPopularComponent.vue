<template>
    <div class="grid">
        <div class="col-12 flex justify-content-between align-items-center m-auto" style="max-width: 1400px;">
            <h2 class="font-semibold text-center text-primary">Most Popular</h2>
            <Button label="See more" />
        </div>
    </div>
    <Carousel :showIndicators="false" :value="products" :numVisible="4" :numScroll="1"
        :responsiveOptions="responsiveOptions" circular :autoplayInterval="3500">
        <template #item="slotProps">
            <div class="grid-nogutter">
                <div class="card col-3 w-11 relative m-auto ">
                    <div class="card-img">
                        <img :src="asset('product_img/' + slotProps.data.image)" alt=""
                            class="w-full h-20rem overflow-hidden border-round-md" style="object-fit: cover;">
                    </div>
                    <div class="card-text">
                        <h3 class="m-0 pt-1 w-full h-3rem text-gray-900 font-normal" style="white-space: wrap;">{{ truncateText(slotProps.data.name)
                        }}</h3>
                         <Rating v-model="slotProps.data.stars" readonly :cancel="false"/>
                        <div class="flex">
                            <p class="m-0 py-2 text-xl font-bold text-primary">$23</p>
                            <p class="text-sm line-through text-gray-500 mx-2">$50</p>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </Carousel>
</template>

<script setup>
import { computed, ref } from 'vue';
import Carousel from 'primevue/carousel';
import Rating from 'primevue/rating';
import Button from 'primevue/button';


import { asset } from '../../../asset-helper'
const products = ref([
    {
        id: 1,
        name: 'Menafd hello hi i hello hwo lfasf lhfdklfa',
        image: 'men.jpg',
        stars:5
    },
    {
        id: 2,
        name: 'Women',
        image: 'women.jpg',
        stars:4
    },
    {
        id: 3,
        name: 'Electronics',
        image: 'laptop.jpg',
        stars:4
    },
    {
        id: 4,
        name: 'Cosmetics',
        image: 'cosmetics.jpg',
        stars:2
    },
    {
        id: 5,
        name: 'Baby',
        image: 'baby.jpg',
        stars:4
    },
    {
        id: 6,
        name: 'Snacks',
        image: 'snacks.jpg',
        stars:1
    },
    {
        id: 7,
        name: 'Furniture',
        image: 'furniture.jpg',
        stars:4
    },
    {
        id: 8,
        name: 'Sports',
        image: 'sports.jpg',
        stars:5
    },
    {
        id: 9,
        name: 'Books',
        image: 'books.jpg',
        stars:4
    },
    {
        id: 10,
        name: 'Jewelry',
        image: 'jewelry.jpg',
        stars:4
    },
    {
        id: 11,
        name: 'Toys',
        image: 'toys.jpg',
        stars:4
    },
    {
        id: 12,
        name: 'Health',
        image: 'health.jpg',
        stars:5
    }
]);
const truncateText = (text) => {
    if (text.length > 40) {
        return text.slice(0, 40) + ' ...';
    }
    return text;
};
defineProps({ translations: Object })
</script>

<style  scoped></style>
