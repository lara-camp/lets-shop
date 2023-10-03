<template>
    <div class="grid">
        <div class="col-11 mt-6 mb-3  pr-3 m-auto flex justify-content-between align-items-center">
            <h2 class="font-semibold text-center text-primary m-0 text-4xl home-header">Popular Categories</h2>
            <!-- <TabMenu v-model:activeIndex="active" :model="items" /> -->
            <div class="flex justify-content-around font-bold text-600 align-items-center w-4 cursor-pointer text-lg">
                <div :id="index" v-for="(item, index) in items" :key="index"
                    @click="menuClicked(index, $event)" :class="{'text-primary': selectedItemIndex == index }">
                    {{ item.label }}
                </div>
            </div>
        </div>
        <div class="col-11 grid m-auto">
            <div class="col-12 md:col-3 lg:col-2" v-for="product in products" :key="product.id">
                <div class="card w-14rem relative m-auto ">
                    <div class="card-img">
                        <img :src="asset('product_img/' + product.image)" alt=""
                            class="w-full h-20rem overflow-hidden border-round-md" style="object-fit: cover;">
                    </div>
                    <div class="card-text">
                        <h3 class="m-0 pt-1 w-14rem h-4rem text-gray-900 font-normal" style="white-space: wrap;">{{
                            truncateText(product.name)
                        }}</h3>
                        <Rating v-model="product.stars" readonly :cancel="false" />
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
import { computed, ref } from 'vue';
import { asset } from '../../../asset-helper';
import TabMenu from 'primevue/tabmenu';
import Rating from 'primevue/rating';
import { Link } from '@inertiajs/vue3';

const products = ref([
    {
        id: 1,
        name: 'Menafd hello hi i hello hwo lfasf lhfdklfa',
        image: 'men.jpg',
        stars: 5
    },
    {
        id: 2,
        name: 'Women',
        image: 'women.jpg',
        stars: 4
    },
    {
        id: 3,
        name: 'Electronics',
        image: 'laptop.jpg',
        stars: 4
    },
    {
        id: 4,
        name: 'Cosmetics',
        image: 'cosmetics.jpg',
        stars: 2
    },
    {
        id: 5,
        name: 'Baby',
        image: 'baby.jpg',
        stars: 4
    },
    {
        id: 6,
        name: 'Snacks',
        image: 'snacks.jpg',
        stars: 1
    },
    {
        id: 7,
        name: 'Furniture',
        image: 'furniture.jpg',
        stars: 4
    },
    {
        id: 8,
        name: 'Sports',
        image: 'sports.jpg',
        stars: 5
    },
    {
        id: 9,
        name: 'Books',
        image: 'books.jpg',
        stars: 4
    },
    {
        id: 10,
        name: 'Jewelry',
        image: 'jewelry.jpg',
        stars: 4
    },
    {
        id: 11,
        name: 'Toys',
        image: 'toys.jpg',
        stars: 4
    },
    {
        id: 12,
        name: 'Health',
        image: 'health.jpg',
        stars: 5
    }
]);
const active = ref(0);

console.log(active.value)
const items = ref([
    {
        label: 'Men',
    },
    {
        label: 'Women',
    },
    {
        label: 'Electornics',
    },
    {
        label: 'Cosmetics',
    },
]);
const truncateText = (text) => {
    if (text.length > 40) {
        return text.slice(0, 40) + ' ...';
    }
    return text;
};
let selectedItemIndex = ref(0);
const menuClicked = (index) => {
    selectedItemIndex.value = index;
}
// const isSelected = computed(() => {
//   return (index) => {
//     console.log(selectedItemIndex.value === index);
//     return selectedItemIndex.value === index;
//   };
// });


// console.log(products.value)

defineProps({ translations: Object })
</script>

<style  scoped>
.p-tabmenu {
    display: flex;
    justify-content: end;
}

.p-tabmenu .p-tabmenu-nav {
    margin-right: 12px;
}

.p-tabmenu-nav .p-menuitem-text {
    font-size: 11px !important;
}

@media screen and (max-width: 768px) {
    .p-tabmenu {
        display: flex;
        justify-content: center;
        margin-left: 20px;
    }



}
</style>
