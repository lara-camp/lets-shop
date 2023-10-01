<template>
    <div class="grid">
        <div class="col-12"><h2 class="font-semibold text-center text-primary">Flash Deal</h2></div>
    </div>
    <Carousel :showIndicators="false" :value="products" :numVisible="6" :numScroll="1" :responsiveOptions="responsiveOptions" circular
        :autoplayInterval="3000">
        <template #item="slotProps">
                <Card class="m-2">
                    <h4 class="mb-1">{{ slotProps.data.name }}</h4>
                </Card>
        </template>
    </Carousel>
</template>

<script setup>
import { ref } from 'vue';
import Carousel from 'primevue/carousel';
import Card from 'primevue/card';

const products = ref([]);

for (let i = 1; i <= 12; i++) {
    products.value.push({
        id: i,
        name: 'electronics' + i,
    })
}

console.log(products.value)

defineProps({ translations: Object })
</script>

<style  scoped></style>
