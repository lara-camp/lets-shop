<template>
    <div class="grid m-auto">
        <div class="col-11">
            <h2 class="font-semibold text-center text-primary">CATEGORIES</h2>
        </div>
            <!-- <img :src="asset('productP')" alt=""> -->
            <div class="col-6 md:col-4 lg:col-2 p-5 category-card flex justify-content-end align-items-center flex-column bg-white broder-round-sm h-15rem"
                v-for="product in products" :key="product.id" :style="{
                    backgroundImage: 'url(' + asset('product_img/' + product.image) + ')',
                    backgroundPosition: 'center',
                    backgroundSize: 'cover', // or 'contain' for object-fit
                }">
                <div class="category-overlay"></div>
                <h3 class="m-0 text-color-white bg-black py-3 font-bold py-2 px-1 text-white w-9rem text-center absolute bottom-0 " style="z-index: 1;">{{ product.name }}</h3>
            </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { asset } from '../../../asset-helper'
const products = ref([
    {
        id: 1,
        name: 'Men',
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

defineProps({ translations: Object })
</script>

<style  scoped>
.category-card {
    transition: all .3s;
    position: relative;
    color:#870EFF;
    z-index: 2;
}

.category-card:hover {
    transform: scale(1.2);
    z-index: 3;
    /* transform: scaleY(1.3); */
    box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
}
.category-container{
    position: relative;
}
.category-overlay{
    position:absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    transition: all .1s;
    background: rgba(79, 79, 79, 0.526);
}
.category-overlay:hover{
    background: transparent;
}
</style>
