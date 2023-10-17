<template>
<AdminLayout>
    <div class="px-4 py-5 md:px-6 lg:px-8" >
            <BreadList :primary-route="route('coupons.index')"
                 :secondary="true"
                 primary-name="Coupons"
                 :secondary-name="`#ID - ${coupon.id}`"/>
            <Divider/>
            <div class="font-medium text-3xl text-900 mb-4">Detail Coupon</div>
                <dsiv class="justify-cotent-center grid ">
                    <div class="col-6 pr-5">
                        <!--Coupon code Input-->
                        <div class="flex flex-column mb-4">
                            <label class="text-xl font-medium mb-2" for="code">Coupon Code</label>
                            <InputText id="code" v-model="coupon.coupon_code" placeholder="Enter Coupon Code" readonly/>
                        </div>

                        <!--Discount Input-->
                        <div class="flex flex-column mb-4">
                            <label class="text-xl font-medium mb-2" for="currency-mmk"> Discount Price</label>
                            <InputNumber v-model.number="coupon.discount" currency="MMK"
                                        mode="currency"
                                        placeholder="MMK" readonly="true"/>
                        </div>
                    </div>
                <div class="col-6 pr-2">
                        <!--Min Purchase Input-->
                        <div class="flex flex-column mb-4">
                            <label class="text-xl font-medium mb-2" for="currency-mmk"> Minimum Purchase Price</label>
                            <InputNumber v-model.number="coupon.min_purchase" currency="MMK"
                                        mode="currency"
                                        placeholder="MMK" readonly="true"/>
                        </div>
                        <div class="flex flex-column mb-4">
                            <div class="my-3"><span class="text-xl font-medium ">Start Date</span> - {{coupon.discounttimeline.start}}</div>
                            <div><span class="text-xl font-medium ">End Date</span> - {{coupon.discounttimeline.end}}</div>
                        </div>
                        <div class="flex justify-content-end">
                            <Link :href="route('coupons.index')">
                                <Button label="Back"></Button>
                            </Link>
                        </div>

                </div>

            </dsiv>

    </div>
</AdminLayout>


</template>

<script setup>
import AdminLayout from "../../../Layout/AdminLayout.vue";
import BreadList from '../Component/BreadList.vue'
import InputText from "primevue/inputtext";
import InputNumber from "primevue/inputtext";
import Divider from "primevue/divider";
import Button from "primevue/button";
import {Link} from '@inertiajs/vue3'

const {coupon} = defineProps({coupon:Object})
</script>

<style>

</style>
