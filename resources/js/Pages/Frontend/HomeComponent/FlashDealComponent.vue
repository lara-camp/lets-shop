<template>
    <div class="grid m-auto" style="max-width: 1100px;" >
        <div class="col-12">
            <h2 class="font-semibold text-center text-primary">Flash Deal</h2>
        </div>
    </div>
    <Carousel :showIndicators="false" :value="products" :numVisible="6" :numScroll="1"
        :responsiveOptions="responsiveOptions" circular :autoplayInterval="3000">
        <template #item="slotProps">
            <div class="grid-nogutter flex justify-content-center align-items-center">
                <div class="grid-nogutter ">
                    <div class="card col-2 w-13rem relative m-atuo">
                        <div class="card-img w-full">
                            <img :src="asset('product_img/' + slotProps.data.image)" alt=""
                                class="w-full h-10rem overflow-hidden border-round-md" style="object-fit: cover;">
                        </div>
                        <div class="card-text">
                            <h3 class="m-0 pt-1 w-full h-3rem text-gray-900 font-normal" style="white-space: wrap;">{{
                                truncateText(slotProps.data.name)
                            }}</h3>
                            <div class="flex">
                                <p class="m-0 py-2 text-xl font-bold text-primary">$23</p>
                                <p class="text-sm line-through text-gray-500 mx-2">$50</p>
                            </div>
                        </div>
                        <div class="off-sale bg-primary w-3rem h-4rem text-center p-2 absolute top-0 right-0">
                            <p class="m-0">23% </p>
                            <p class="m-0">OFF</p>
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
import { asset } from '../../../asset-helper'
const products = ref([
    {
        id: 1,
        name: 'Menafd hello hi i hello hwo lfasf lhfdklfa',
        image: 'men.jpg'
    },
    {
        id: 2,
        name: 'Women',
        image: 'women.jpg'
    },
    {
        id: 3,
        name: 'Electronics',
        image: 'laptop.jpg'
    },
    {
        id: 4,
        name: 'Cosmetics',
        image: 'cosmetics.jpg'
    },
    {
        id: 5,
        name: 'Baby',
        image: 'baby.jpg'
    },
    {
        id: 6,
        name: 'Snacks',
        image: 'snacks.jpg'
    },
    {
        id: 7,
        name: 'Furniture',
        image: 'furniture.jpg'
    },
    {
        id: 8,
        name: 'Sports',
        image: 'sports.jpg'
    },
    {
        id: 9,
        name: 'Books',
        image: 'books.jpg'
    },
    {
        id: 10,
        name: 'Jewelry',
        image: 'jewelry.jpg'
    },
    {
        id: 11,
        name: 'Toys',
        image: 'toys.jpg'
    },
    {
        id: 12,
        name: 'Health',
        image: 'health.jpg'
    }
]);
const responsiveOptions = ref([
    {
        breakpoint: '1289px',
        numVisible: 4,
        numScroll: 1
    },
    {
        breakpoint: '991px',
        numVisible: 3,
        numScroll: 1
    },
    {
        breakpoint: '767px',
        numVisible: 2,
        numScroll: 1
    },
    {
        breakpoint: '566px',
        numVisible: 1,
        numScroll: 1
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
