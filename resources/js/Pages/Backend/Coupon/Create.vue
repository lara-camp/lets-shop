<template>
    <AdminLayout>
        <div class="px-4 py-5 md:px-6 lg:px-8" >
            <BreadList :primary-route="route('coupons.index')"
                 :secondary="true"
                 primary-name="Coupons"
                 secondary-name="Create"/>
            <Divider/>
            <div class="font-medium text-3xl text-900 mb-4">Create Coupon</div>
            <!-- Coupon Form Section -->
            <form class="grid justify-content-center" @submit.prevent="couponForm.post(route('coupons.store'))">
                <div class="col-6 pr-5">
                     <!--Coupon code Input-->
                    <div class="flex flex-column mb-4">
                        <label class="text-xl font-medium mb-2" for="code">Coupon Code</label>
                        <InputText id="code" v-model="couponForm.code" placeholder="Enter Coupon Code"/>
                        <div v-if="couponForm.errors.code" class="text-md text-red-600">
                        {{ couponForm.errors.code }}
                        </div>
                    </div>

                     <!--Discount Input-->
                    <div class="flex flex-column mb-4">
                        <label class="text-xl font-medium mb-2" for="currency-mmk"> Discount Price</label>
                        <InputNumber v-model.number="couponForm.discount" currency="MMK"
                                    mode="currency"
                                    placeholder="MMK"/>
                        <div v-if="couponForm.errors.discount" class="text-md text-red-600">
                        {{ couponForm.errors.discount }}
                        </div>
                    </div>
                </div>
                <div class="col-6 pr-2">
                    <!--Min Purchase Input-->
                    <div class="flex flex-column mb-4">
                        <label class="text-xl font-medium mb-2" for="currency-mmk"> Minimum Purchase Price</label>
                        <InputNumber v-model.number="couponForm.min_purchase" currency="MMK"
                                    mode="currency"
                                    placeholder="MMK"/>
                        <div v-if="couponForm.errors.min_purchase" class="text-md text-red-600">
                        {{ couponForm.errors.min_purchase }}
                        </div>
                    </div>
                    <!-- Date time picker -->
                     <!-- <div class="flex flex-column mb-4">
                        <label for="dateTime" class="text-xl font-medium mb-2">Pick an Expired Time</label>
                        <Calendar id="dateTime" v-model="couponForm.datetime12h" showTime hourFormat="12" />
                    </div> -->
                    <div class="flex justify-content-end">
                        <Button type="submit" label="Create"></Button>
                    </div>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import Divider from "primevue/divider";
import InputNumber from "primevue/inputnumber";
import InputText from "primevue/inputtext";
import AdminLayout from "../../../Layout/AdminLayout.vue";
import BreadList from '../Component/BreadList.vue'
import Calendar from 'primevue/calendar';
import Button from "primevue/button";

const  couponForm=useForm({
    code:null,
    discount:null,
    min_purchase:null,
    // datetime12h:null
})
</script>

<style>

</style>
