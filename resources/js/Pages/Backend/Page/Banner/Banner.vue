<template>
    <AdminLayout>
        <div class="grid m-auto">
            <div class="col-11 m-auto mt-3">
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
                        <span class="text-900 line-height-3">Banners</span>
                    </li>
                </ul>
                <Divider />
            </div>
        </div>
        <div class="flex align-items-start flex-column lg:justify-content-between lg:flex-row col-11 m-auto">
            <div class="font-medium text-3xl text-900">Banners</div>
            <Dialog v-model:visible="previewVisible" header="Preview Slides" :style="{ width: '94vw' }" position="top"
                :modal="true" :draggable="false">
                <div v-for="banner in banners" :key="banner.id">
                    <img :src="asset('banner_img/' + banner.image)" alt="">
                </div>
            </Dialog>
            <div class="mt-3 lg:mt-0 flex justify-content-end">

                <Button icon="pi pi-eye" @click="previewVisible = true" rounded outlined aria-label="Delete" class="mx-2" />
            </div>
        </div>

        <div class="col-11 m-auto ">
            <div v-if="showError">
                <InlineMessage severity="error" class="w-full my-3">files field is required
                </InlineMessage>
            </div>
            <Toast />
            <form @submit.prevent="submit" method="post">
                <FileUpload name="files" :showUploadButton="false" @select="onSelect($event)" :fileLimit="1"
                    accept="image/*" :maxFileSize="1000000">
                    <template #empty>
                        <div class="flex flex-column justify-content-center align-items-center">
                            <img :src="asset('product_img/upload.png')" alt="" style="width: 50px;">
                            <p class="font-bold text-lg">Drag and Drop image for upload </p>
                        </div>
                    </template>
                </FileUpload>
                <p>Select a page</p>
                <Dropdown v-model="selectedPage" :options="pages" optionLabel="name" placeholder="Select a page"
                    class="w-full" />
                <p>Select a section</p>
                <Dropdown v-model="selectedSection" :options="sections" optionLabel="name" placeholder="Select a section"
                    class="w-full" />
                <div class="flex justify-content-end my-3">
                    <button type="button" style="background-color: transparent; outline: none;border: none;">
                        <Button type="submit" label="Upload" />
                    </button>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>

<script setup>
import { reactive, ref } from 'vue';
import { asset } from '../../../../asset-helper.js';
import { router, Link } from '@inertiajs/vue3';
import AdminLayout from '../../../../Layout/AdminLayout.vue';
import Button from 'primevue/button';
import Divider from 'primevue/divider';
import { useForm } from '@inertiajs/vue3';
import { useToast } from "primevue/usetoast";
import Toast from 'primevue/toast';
import Dialog from 'primevue/dialog';
import FileUpload from 'primevue/fileupload';
import InlineMessage from 'primevue/inlinemessage';
import Dropdown from 'primevue/dropdown';
let { banners } = defineProps({
    banners: Array,
})

console.log(banners)
const toast = useToast();
const previewVisible = ref(false)

let form = useForm(reactive({
    files: null,
    id: null,
    page:null
}));

const onSelect = (event) => {
    console.log(event)
    form.files = event.files;
};

const showError = ref(false)

const selectedSection = ref('');
const sections = ref([
    { name: 'Section one', id: '1' },
    { name: 'Section two', id: '2' }
]);

const selectedPage = ref('');
const pages = ref([
    { name: 'Home', id: 'home' },
    { name: 'Coupon', id: 'coupon' }
]);

const submit = () => {
    form.id = selectedSection.value.id;
    form.page = selectedPage.value.id;
    console.log(form.files)
    if (form.files && form.id && form.page) {
        form.post(route('banner.index'))
        showError.value = false;
        toast.add({ severity: 'success', summary: 'Upload slide', detail: 'Slides are created', life: 3500 })
    }
    else {
        showError.value = true;
    }
}

</script>

<style  scoped></style>
