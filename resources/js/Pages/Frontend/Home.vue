<template>
    <UserNavbar/>
    <HeroSectionComponent/>
    <BannerComponent image = "banner.png"/>
    <CategoryCompnent />
    <FlashDealComponent />
    <BannerComponent image = 'banner.png'/>
    <MostPopularComponent />
    <DynamicCategoryComponent/>
    <ProductsComponent />
</template>

<script setup>
import CategoryCompnent from './HomeComponent/CategoryCompnent.vue';
import FlashDealComponent from './HomeComponent/FlashDealComponent.vue';
import HeroSectionComponent from './HomeComponent/HeroSectionComponent.vue';
import BannerComponent from './HomeComponent/BannerComponent.vue';
import MostPopularComponent from './HomeComponent/MostPopularComponent.vue';
import ProductsComponent from './HomeComponent/ProductsComponent.vue';
import DynamicCategoryComponent from './HomeComponent/DynamicCategoryComponent.vue';
import UserNavbar from '../../Component/UserNavbar.vue'
import { asset } from '../../asset-helper.js';


defineProps({ translations: Object })
</script>

<style>
body {
    background: #fff;
}
</style>

