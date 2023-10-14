<template>
    <div class="m-auto" style="max-width: 1400px;">
        <div class="grid my-3">
            <div class="col-12">
                <img :src="asset('product_img/'+image)" alt="" class="w-full">
            </div>
        </div>
    </div>
</template>

<script setup>
import { asset } from '../../../asset-helper.js';


defineProps({ translations: Object, image:String })
</script>

<style>
</style>

