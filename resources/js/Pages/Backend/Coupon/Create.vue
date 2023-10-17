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
                    <div class="flex flex-column mb-5">
                        <label class="text-xl font-medium mb-2" for="currency-mmk">Choose Expired Date</label>
                        <Dropdown v-model="couponForm.selectedTimeline"  :options="timelines"  optionLabel="['start','end']" placeholder="Select an expired date" class="w-full ">
                            <template #value="slotProps">
                                <div v-if="slotProps.value" class="flex flex-column">
                                    <div>Start - {{ slotProps.value.start }}</div>
                                    <div>End  -  {{ slotProps.value.end }}</div>
                                </div>
                                <span v-else>
                                    {{ slotProps.placeholder }}
                                </span>
                            </template>
                            <template #option="slotProps">
                                <div class="flex flex-column">
                                    <div class="py-1">Start - <b>{{ slotProps.option.start }}</b></div>
                                    <div class="py-1">End   - <b>{{ slotProps.option.end }}</b></div>
                                </div>
                            </template>
                        </Dropdown>
                        <div v-if="couponForm.errors.selectedTimeline" class="text-md text-red-600">
                        {{ couponForm.errors.selectedTimeline }}
                        </div>
                    </div>

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
import Dropdown from "primevue/dropdown";

const {timelines}=defineProps({timelines:Array})
const  couponForm=useForm({
    code:null,
    discount:null,
    min_purchase:null,
    selectedTimeline:null
})
</script>

<style>

</style>
