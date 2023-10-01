<template>
    <HeroSectionComponent/>
    <BannerComponent image = "banner.png"/>
    <CategoryCompnent />
    <FlashDealComponent />
    <BannerComponent image = 'banner.png'/>
    <MostPopularComponent />

</template>

<script setup>
import CategoryCompnent from './HomeComponent/CategoryCompnent.vue';
import FlashDealComponent from './HomeComponent/FlashDealComponent.vue';
import HeroSectionComponent from './HomeComponent/HeroSectionComponent.vue';
import BannerComponent from './HomeComponent/BannerComponent.vue';
import MostPopularComponent from './HomeComponent/MostPopularComponent.vue';

import { asset } from '../../asset-helper.js';


defineProps({ translations: Object })
</script>

<style>
body {
    background: #fff;
}
</style>

