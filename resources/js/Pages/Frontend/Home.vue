<template>
  <Head>
  <title>Home</title>
  <link rel="shortcut icon" type="image/x-icon" :href="asset('favicon.ico')" />
</Head>
  <ChatComponent/>
  <UserNavbar/>
  <HeroSectionComponent :slides="slides"/>
  <BannerComponent image="banner.png"/>
  <CategoryCompnent/>
  <FlashDealComponent/>
  <BannerComponent image='banner.png'/>
  <MostPopularComponent/>
  <DynamicCategoryComponent/>
  <ProductsComponent/>
</template>


<script setup>
import ChatComponent from './Component/ChatComponent/ChatComponent.vue'
import CategoryCompnent from './HomeComponent/CategoryCompnent.vue'
import FlashDealComponent from './HomeComponent/FlashDealComponent.vue'
import HeroSectionComponent from './HomeComponent/HeroSectionComponent.vue'
import BannerComponent from './HomeComponent/BannerComponent.vue'
import MostPopularComponent from './HomeComponent/MostPopularComponent.vue'
import ProductsComponent from './HomeComponent/ProductsComponent.vue'
import DynamicCategoryComponent from './HomeComponent/DynamicCategoryComponent.vue'
import UserNavbar from '../../Component/UserNavbar.vue'
import { asset } from '../../asset-helper.js'

const { translations, slides } = defineProps({
  slides: Array
})
</script>

<style>
body {
  background: #fff;
}
</style>
