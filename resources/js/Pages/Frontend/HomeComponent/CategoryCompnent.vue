<template>
    <div class="grid ">
        <div class="col-12"><h2 class="font-semibold text-center text-primary">CATEGORIES</h2></div>
        <div class="col-2 p-5 category-card transition-all surface-border border-1 flex justify-content-center align-items-center flex-column bg-white broder-round-sm" v-for="product in products" :key="product.id">
            <img src="../../../../images/slide.jpg" alt="" class="w-full border-circle w-5rem h-5rem">
            <p class="m-0 text-color-secondary py-3">{{ product.name }}</p>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
const products = ref([]);

for (let i = 1; i <= 12; i++) {
    products.value.push({
        id:i,
        name:'electronics'+i,
    })
}

console.log(products.value)

defineProps({ translations: Object })
</script>

<style  scoped>
    .category-card{
        transition: all .3s;
    }
    .category-card:hover{
        transform: scale(1.1);
        /* transform: scaleY(1.3); */
        box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
    }
</style>
