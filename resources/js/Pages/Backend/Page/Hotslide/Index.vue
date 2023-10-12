<template>
    <AdminLayout>
        <div class="grid m-auto">
            <div class="col-11 m-auto mt-3">
                <ul class="list-none p-0 m-0 flex align-items-center font-medium mb-3">
                    <li>
                        <span class="text-900 line-height-3">Slides</span>
                    </li>
                </ul>
                <Divider />
            </div>
        </div>
        <div class="flex align-items-start flex-column lg:justify-content-between lg:flex-row col-11 m-auto">
            <div class="font-medium text-3xl text-900">Slides</div>
            <Dialog v-model:visible="previewVisible" header="Preview Slides" :style="{ width: '94vw' }" position="top"
                :modal="true" :draggable="false">
                <UserNavbar />
                <HeroSectionComponent :slides="slides.filter((slide) => {
                    return slide.is_show == '1'
                })" />
            </Dialog>
            <div class="mt-3 lg:mt-0 flex justify-content-end">
                <Button icon="pi pi-eye" @click="previewVisible = true" rounded outlined aria-label="Delete" class="mx-2" />
                <Link :href="route('hot-slide.create')">
                <Button icon="pi pi-plus" label="Create"></Button>
                </Link>
            </div>
        </div>
        <div v-if='slides' class="col-11 m-auto">
            <DataTable :value="slides" paginator :rows="10" :rowsPerPageOptions="[5, 10, 20, 50]"
                tableStyle="min-width: 50rem">
                <template #empty>
                    <div class="text-center">
                        No slides found.
                    </div>
                </template>
                <Column header="Image">
                    <template #body="slotProps">
                        <img :src="asset('hot-slide/' + slotProps.data.image)" :alt="slotProps.data.image" class="shadow-2"
                            width="300" style="object-fit: cover;" />
                    </template>
                </Column>
                <Column header="Created at">
                    <template #body="slotProps">
                        {{ formatDate(slotProps.data.created_at) }}
                    </template>
                </Column>

                <Column header="Actions">
                    <template #body="slotProps">
                        <Toast />
                        <ConfirmPopup></ConfirmPopup>
                        <Dialog v-model:visible="visible" modal header="Edit Slide"
                            :style="{ width: '70vw', height: '90vh' }">
                            <div class="col-12">

                                <p class="font-bold">Update Image</p>
                                <form @submit.prevent="submit" method="post">
                                    <div v-if="showError">
                                        <InlineMessage severity="error" class="w-full my-3">{{ form.errors.files }}
                                        </InlineMessage>
                                    </div>
                                    <div v-if="form.errors.file">{{ form.errors.file }}</div>
                                    <FileUpload name="files" :showUploadButton="false" @select="onSelect" :fileLimit="1"
                                        accept="image/*" :maxFileSize="1000000">
                                        <template #empty>
                                            <div class="flex flex-column justify-content-center align-items-center">
                                                <img :src="asset('product_img/upload.png')" alt="" style="width: 50px;">
                                                <p class="font-bold text-lg">Drag and Drop image for upload </p>
                                            </div>
                                        </template>
                                    </FileUpload>
                                    <div class="flex justify-content-end my-3">
                                        <button type="button"
                                            style="background-color: transparent; outline: none;border: none;">
                                            <Button type="submit" label="Upload" />
                                        </button>
                                    </div>
                                </form>
                                <p class="font-bold">Previous Image</p>
                                <img :src="asset('hot-slide/' + editData.image)" alt="editData.image" class="w-full">
                            </div>
                        </Dialog>
                        <Button icon="pi pi-pencil" @click="edit(slotProps.data)" severity="warning" rounded outlined
                            aria-label="Edit" />
                        <Button icon="pi pi-trash" @click="confirm2($event, slotProps.data.id)" severity="danger" rounded
                            outlined aria-label="Delete" class="mx-2" />
                        <Button icon="pi pi-check" rounded :outlined="slotProps.data.is_show == 0 ? true : false"
                            @click="ToShow(slotProps.data.id)" aria-label="Show" />
                    </template>
                </Column>
            </DataTable>
        </div>
        <div v-else>
            <CusSkeleton />
        </div>

    </AdminLayout>
</template>

<script setup>
import { computed, onMounted, reactive, ref } from 'vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import { asset } from '../../../../asset-helper.js';
import { Link, router } from '@inertiajs/vue3';
import AdminLayout from '../../../../Layout/AdminLayout.vue';
import CusSkeleton from './Partials/CusSkeleton.vue';
import Button from 'primevue/button';
import Divider from 'primevue/divider';
import ConfirmPopup from 'primevue/confirmpopup';
import { useConfirm } from "primevue/useconfirm";
import { useForm } from '@inertiajs/vue3';
import { useToast } from "primevue/usetoast";
import Toast from 'primevue/toast';
import Dialog from 'primevue/dialog';
import FileUpload from 'primevue/fileupload';
import InlineMessage from 'primevue/inlinemessage';
import HeroSectionComponent from '../../../Frontend/HomeComponent/HeroSectionComponent.vue';
import UserNavbar from '../../../../Component/UserNavbar.vue'
let { slides } = defineProps({
    slides: undefined,
})

const formatDate = (dateTime) => {
    const options = { year: 'numeric', month: 'short', day: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric', hour12: true };
    return new Date(dateTime).toLocaleDateString(undefined, options);
}

const confirm = useConfirm();
const toast = useToast();

const confirm2 = (event, id) => {
    confirm.require({
        target: event.currentTarget,
        message: 'Do you want to delete this record?',
        icon: 'pi pi-info-circle',
        acceptClass: 'p-button-danger',
        accept: () => {
            router.delete('/dashboard/hot-slide/' + id, {
                preserveScroll: true,
                preserveState: true
            })
            toast.add({ severity: 'success', summary: 'Delete', detail: 'Record deleted', life: 3500 });
        }
    });
};
const visible = ref(false);
const previewVisible = ref(false)
let editData = ref(null);
const edit = (slide) => {
    editData.value = { ...slide };
    visible.value = true;
    showError.value = false;

}
const form = useForm(reactive({
    files: null,
}));

const onSelect = (event) => {
    console.log(event.files);
    form.files = event.files;
};

const showError = ref(false)
const submit = () => {
    let id = editData.value.id;
    form.post(route('hotslide.update', id));
    if (!form.files) {
        visible.value = true;
        showError.value = true;
    } else {
        visible.value = false;
        showError.value = false;
        toast.add({ severity: 'success', summary: 'Upload slide', detail: 'Slides are uploaded successfully', life: 1000 });
    }

}

const ToShow = (id) => {
    router.post(route('hotSlide.isShow', id), { id }, {
        preserveScroll: true,
        preserveState: true
    })
}

onMounted(() => {
    router.reload({ only: ['slides'] })
})
</script>

<style  scoped></style>
