<template>
    <AdminLayout>
        <div class="px-4 py-5 md:px-6 lg:px-8" >
            <BreadList :primary-route="route('discount_timelines.index')"
                 :secondary="true"
                 primary-name="Timelines"
                 secondary-name="Create"/>
            <Divider/>
            <div class="font-medium text-3xl text-900 mb-4">Create Timeline</div>
            <form class="grid justify-content-center" @submit.prevent="timelineForm.post(route('discount_timelines.store'))">
                <div class="col-6 ">
                    <div class="flex-auto">
                        <label for="calendar-12h" class="font-bold block mb-2">Start Time</label>
                        <Calendar id="calendar-12h" v-model="timelineForm.startTime" class="w-full" :dateFormat="'dd-MM-yy'" :showIcon="true" showTime hourFormat="12" />
                    </div>
                    <div v-if="timelineForm.errors.startTime" class="text-md text-red-600">
                        {{ timelineForm.errors.startTime }}
                    </div>
                </div>
                <div class="col-6 ">
                    <div class="flex-auto">
                        <label for="calendar-12h" class="font-bold block mb-2">End Time</label>
                        <Calendar id="calendar-12h" v-model="timelineForm.endTime" class="w-full" :dateFormat="'dd-MM-yy'" :showIcon="true" showTime hourFormat="12" />
                    </div>
                    <div v-if="timelineForm.errors.endTime" class="text-md text-red-600">
                        {{ timelineForm.errors.endTime }}
                    </div>
                    <div class="flex justify-content-end mt-4">
                        <Button type="submit" label="Create"></Button>
                    </div>
                </div>

            </form>
        </div>
    </AdminLayout>

</template>

<script setup>
import Divider from "primevue/divider";
import AdminLayout from "../../../Layout/AdminLayout.vue";
import BreadList from '../Component/BreadList.vue'
import Calendar from 'primevue/calendar';
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import Button from "primevue/button";




const timelineForm=useForm({
    startTime:null,
    endTime:null
})
</script>

<style>

</style>
