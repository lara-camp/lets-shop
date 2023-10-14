<template>
    <div class="grid">
        <div class="col-11 m-auto ">
            <h2 class="font-semibold text-center text-primary my-3 text-4xl home-header">Products</h2>
        </div>
        <div class="col-11 grid m-auto" >
            <div class="col" v-for="product in products" :key="product.id">
                <div class="card col w-10 relative m-auto ">
                    <div class="card-img">
                        <img :src="asset('product_img/' + product.image)" alt=""
                            class="w-full h-20rem overflow-hidden border-round-md" style="object-fit: cover;">
                    </div>
                    <div class="card-text">
                        <h3 class="m-0 pt-1 w-18rem h-4rem text-gray-900 font-normal" style="white-space: wrap;">{{ product.name
                        }}</h3>
                         <Rating v-model="product.stars" readonly :cancel="false"/>
                        <div class="flex">
                            <p class="m-0 py-2 text-xl font-bold text-primary">$23</p>
                            <p class="text-sm line-through text-gray-500 mx-2">$50</p>
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

console.log(products.value)

defineProps({ translations: Object })
</script>

<style  scoped></style>
