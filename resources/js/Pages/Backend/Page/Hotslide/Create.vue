<template>
    <AdminLayout>
        <div class="grid m-auto">
            <div class="col-11 m-auto">
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
        </div>
        <div class="grid m-auto">
            <!-- <div v-if="form.errors.files">{{ form.errors.files }}</div> -->
            <div class="col-11 m-auto">
                <form @submit.prevent="submit" method="post">
                    <div class="card">
                        <Toast />
                        <FileUpload name="files[]" :showUploadButton="false" @select="onSelect" :multiple="true"
                            accept="image/*" :maxFileSize="1000000">
                            <template #empty>
                                <div class="flex flex-column justify-content-center align-items-center">
                                    <img :src="asset('product_img/upload.png')" alt="" style="width: 200px;">
                                    <p class="font-bold text-xl">Drag and Drop image for upload </p>
                                </div>
                            </template>
                        </FileUpload>
                    </div>
                    <div class="flex justify-content-end my-3">
                        <button type="button" style="background-color: transparent; outline: none;border: none;">
                            <Button type="submit" label="Submit" />
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { ref } from 'vue';

import FileUpload from 'primevue/fileupload';
import AdminLayout from '../../../../Layout/AdminLayout.vue'
import Button from 'primevue/button';
import { asset } from '../../../../asset-helper'
import { useForm } from '@inertiajs/vue3'
import { Link } from '@inertiajs/vue3'
const form = useForm({
    files: [],
});


const onSelect = (event) => {
    form.files = [...event.files];
};

const submit = () => {
    form.post('/dashboard/hot-slide')
}
defineProps({ translations: Object })
</script>

<style  scoped></style>
