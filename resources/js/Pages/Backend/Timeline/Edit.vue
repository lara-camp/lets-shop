<template>
 <AdminLayout>
        <div class="px-4 py-5 md:px-6 lg:px-8" >
            <BreadList :primary-route="route('discount_timelines.index')"
                 :secondary="true"
                 primary-name="Timelines"
                 :secondary-name="`#ID - ${timeline.id}`"/>
            <Divider/>
            <div class="font-medium text-3xl text-900 mb-4">Edit Timeline</div>
            <!-- Coupon Form Section -->
            <form class="grid justify-content-center" @submit.prevent="timelineForm.patch(route('discount_timelines.update',timeline.id))">
               <div class="col-6 ">
                    <div class="flex-auto">
                        <label for="calendar-12h" class="font-bold block mb-2">Start Time</label>
                        <Calendar id="calendar-12h" v-model="timelineForm.startTime" class="w-full" :dateFormat="'yy-mm-dd'" :showSeconds="true" :showIcon="true" showTime hourFormat="24" />
                    </div>
                    <div v-if="timelineForm.errors.startTime" class="text-md text-red-600">
                        {{ timelineForm.errors.startTime }}
                    </div>
                </div>
                <div class="col-6 ">
                    <div class="flex-auto">
                        <label for="calendar-12h" class="font-bold block mb-2">End Time</label>
                        <Calendar id="calendar-12h" v-model="timelineForm.endTime" class="w-full" :dateFormat="'yy-mm-dd'" :showSeconds="true" :showIcon="true" showTime hourFormat="24" />
                    </div>
                    <div v-if="timelineForm.errors.endTime" class="text-md text-red-600">
                        {{ timelineForm.errors.endTime }}
                    </div>
                    <div class="flex justify-content-end mt-4">
                        <Button type="submit" label="Save Edit"></Button>
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
import { ref,onMounted } from 'vue';

const {timeline} = defineProps({timeline:Object})

const  timelineForm=useForm({
    startTime:timeline.start,
    endTime: timeline.end
})
</script>

<style>

</style>
