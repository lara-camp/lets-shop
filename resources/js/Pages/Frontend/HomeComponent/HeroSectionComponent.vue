<template>
    <div class="grid w-full my-3">
        <div class="col surface-0">
            <div class="card">
                <Carousel :value="slides" :numVisible="1" :numScroll="1" circular :autoplayInterval="3000">
                    <template #item="slotProps">

                        <div class="w-full surface-0  " >
                            <img :src="asset('hot-slide/'+slotProps.data.image)" :alt="slotProps.data.image" class="w-full h-100" style="object-fit: cover;height: 434.91px;">
                        </div>
                    </template>
                </Carousel>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import Carousel from 'primevue/carousel';
import {asset} from '../../../asset-helper'

const {translations, slides} = defineProps({ translations: Object,slides:Array })
</script>

<style  scoped></style>
