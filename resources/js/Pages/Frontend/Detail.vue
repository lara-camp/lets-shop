<template>
    <UserNavbar />
    <div class="col-11 m-auto my-2">
        <ul class="list-none p-0 m-0 flex align-items-center font-medium mb-3">
            <li>
                <Link :href="route('hot-slide.index')" class="text-500 no-underline line-height-3 cursor-pointer">
                Pages
                </Link>
            </li>
            <li class="px-2">
                <i class="pi pi-angle-right text-500 line-height-3"></i>
            </li>
            <li>
                <span class="text-900 line-height-3">Add Hot Slide</span>
            </li>
        </ul>
    </div>
    <div class="grid ">
        <div class="col-10  m-auto">
            <div class="grid">
                <div class="col-5">
                    <Galleria :value="images" :responsiveOptions="responsiveOptions" :numVisible="4"
                        :thumbnailsPosition="position" :circular="false" :showItemNavigatorsOnHover="false">
                        <template #item="slotProps">
                            <Image :src="asset(slotProps.item.image)" alt="Image" width="450" height="400" preview />
                            <!-- <img :src="asset(slotProps.item.image)" :alt="slotProps.item.alt"
                                style="width: 100%;height:400px;object-fit: cover; " /> -->
                        </template>
                        <template #thumbnail="slotProps">
                            <div class="">
                                <img :src="asset(slotProps.item.image)" :alt="slotProps.item.alt"
                                    style="width: 100px; height: 100px; display: block;object-fit: cover;" />
                            </div>
                        </template>
                    </Galleria>

                </div>
                <div class="col-6">
                    <div class="text-4xl font-semibold mb-3"
                        style="max-width: 500px; white-space: normal; word-wrap: break-word;">{{ product.name }} Violet
                        Evergarden With Chinese Art</div>
                    <div class="flex ">
                        <Rating v-model="product.stars" :cancel="false" />
                        <div class="flex align-items-center text-xl ">
                            <i class="pi pi-comment ml-4 mr-2"></i>
                            <div class="font-semibold"> 34 reviews</div>
                        </div>
                    </div>
                    <div class="text-2xl font-bold mt-3 text-primary ">
                        Ks {{ product.price }}
                    </div>
                    <p class="text-xl line-through m-0 p-0 text-gray-500">Ks 200</p>

                    <div class="flex mt-5">

                        <Button icon="pi pi-minus" rounded outlined aria-label="quantity" class="quantity-button"
                            severity="secondary" @click="quantityFunc('minus')" />
                        <!-- <InputText type="text" size="small" placeholder="1"
                            :style="{borderRadius: '50px'}" class="mx-2" prefix="quantity : "/> -->
                        <InputNumber v-model="quantity" inputId="percent" prefix="quantity : " size="small" class="mx-2" />
                        <Button icon="pi pi-plus" rounded outlined aria-label="quantity" class="quantity-button"
                            severity="secondary" @click="quantityFunc('plus')" />
                    </div>

                    <div class="flex mt-5 align-items-center ">
                        <Button rounded outlined aria-label="quantity" class="buy-now" label="Buy now" />
                        <Button rounded outlined aria-label="quantity" severity="secondary" class="mx-3"
                            label="Add to cart" />
                        <i class="pi pi-heart text-xl cursor-pointer"></i>
                    </div>
                    <Divider class="mt-5 mb-3" />
                    <p class="text-lg m-0 p-0 text-700">Delivery</p>
                    <div class="flex justify-content-between align-items-center mt-3">
                        <div class="">
                            <i class="pi pi-map-marker mr-4"></i>
                            Yangon, Hlaing
                        </div>
                        <div class="text-primary font-semibold cursor-pointer">
                            change
                        </div>
                    </div>
                    <Divider class="mt-5 mb-3" />
                    <div class="mb-3 flex justify-content-between align-items-center">
                        <div>
                            <i class="pi pi-car mr-4"></i>
                            Standard delivery
                        </div>
                        <div class="font-semibold">
                            Ks 3000
                        </div>
                    </div>
                    <div class="">
                        <i class="pi pi-money-bill mr-4"></i>
                        Cash on delivery avaliable
                    </div>
                </div>
            </div>
        </div>
        <div class="col-10 m-auto mt-2">
            <div>
                <div class="text-xl font-semibold text-600 border-left-3 px-3 my-3 border-primary ">{{ tab }} Product</div>
            </div>
            <div class="card">
                <TabView v-model:activeIndex="active">
                    <TabPanel @click="tabClick('Description')" header="Description">
                        <p>
                            {{ product.description }}
                        </p>
                    </TabPanel>
                    <TabPanel @click="tabClick('Details')" header="Details">
                        <div v-for="groupedDetail in groupedDetails" :key="groupedDetail.key">
                            <div class="flex justify-content-start mb-3">
                                <p style="width: 100px;" class="font-semibold p-0 m-0">{{ groupedDetail.key }}</p>
                                <p class="p-0 m-0">{{ groupedDetail.values.join(', ') }}</p>
                            </div>
                        </div>
                    </TabPanel>
                    <TabPanel @click="tabClick('Reviews')" header="Reviews">
                        <p>
                            Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                            laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto
                            beatae vitae dicta sunt explicabo. Nemo enim
                            ipsam voluptatem quia voluafsdfptas sit aspernatur aut odit aut fugit, sed quia consequuntur
                            magni
                            dolores eos qui ratione voluptatem sequi nesciunt. Consectetur, adipisci velit, sed quia non
                            numquam eius modi.
                        </p>
                    </TabPanel>
                </TabView>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import Galleria from 'primevue/galleria';
import { computed, ref, watch } from 'vue';
import UserNavbar from '../../Component/UserNavbar.vue';
import { asset } from '../../asset-helper';
import Rating from 'primevue/rating';
import Image from 'primevue/image';
import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
import Divider from 'primevue/divider';
import TabView from 'primevue/tabview';
import TabPanel from 'primevue/tabpanel';
import InputNumber from 'primevue/inputnumber';



const { product } = defineProps({ product: Array })

const images = ref(product.images);
const position = ref('bottom');
const responsiveOptions = ref([
    {
        breakpoint: '991px',
        numVisible: 4
    },
    {
        breakpoint: '767px',
        numVisible: 3
    },
    {
        breakpoint: '575px',
        numVisible: 1
    }
]);
// console.log(product)
const groupedDetails = computed(() => {
    const grouped = {};
    product.details.forEach((detail) => {
        if (!grouped[detail.key]) {
            grouped[detail.key] = { key: detail.key, values: [detail.pivot.value] };
        } else {
            grouped[detail.key].values.push(detail.pivot.value);
        }
    });
    return Object.values(grouped);
});


const quantity = ref(1)
const quantityFunc = (type) => {
    if (type == 'plus') {
        quantity.value++
    }
    if (type == 'minus') {
        if (quantity.value <= 0) {
            quantity.value = 0
        } else {
            quantity.value--
        }


    }
}

const tab = ref('Description');
const active = ref(0)
watch(active, () => {
    console.log(active);
    if (active.value == 0) {
        tab.value = 'Description'
    } else if (active.value == 1) {
        tab.value = 'Details'
    } else {
        tab.value = 'Reviews'
    }
})

</script>

<style>
.p-galleria .p-galleria-thumbnail-container {
    background: transparent !important;
    justify-content: space-between !important;
    overflow: hidden !important;
}

.quantity-button:hover {
    background: black;
    color: white;
}

.buy-now {
    background: #870EFF;
    color: white;
}

.buy-now:hover {
    background: transparent;
    color: #aaa;
    border-color: #870EFF;
}

.p-inputnumber-input {
    border-radius: 70px !important;
    width: 130px !important;
}
</style>
