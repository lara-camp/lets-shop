<template>

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
