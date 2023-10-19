<!-- <template>

  <div class="card">
    <MegaMenu :model="items" orientation="vertical" />
  </div>

  <Link href="/lang/en"> English </Link>
  <Link href="/lang/my"> Myanmar</Link>
  <p>{{ translations.home }}</p>
  <h1>{{ translations.test }}</h1>

</template>

<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({ translations: Object })
</script>

<style  scoped>

</style> -->

<template>
    <div class="card flex justify-content-center">
        <Button icon="pi pi-ellipsis-v" text rounded aria-label="Filter" type="button" @click="toggle" aria-haspopup="true" aria-controls="overlay_menu"/>
        <Menu ref="drop" id="overlay_menu" :model="items" :popup="true" />
        <Toast />
    </div>
</template>

<script setup>
import { ref } from "vue";
import { useToast } from "primevue/usetoast";
import Menu from 'primevue/menu';
import Button from 'primevue/button';


const toast = useToast();
const drop = ref();
const items = ref([
    {
        label: 'Options',
        items: [
            {
                label: 'Update',
                icon: 'pi pi-refresh',
                command: () => {
                    toast.add({ severity: 'success', summary: 'Updated', detail: 'Data Updated', life: 3000 });
                }
            },
            {
                label: 'Delete',
                icon: 'pi pi-times',
                visible: false,
                command: () => {
                    toast.add({ severity: 'warn', summary: 'Delete', detail: 'Data Deleted', life: 3000 });
                }
            }
        ]
    }
]);

const toggle = (event) => {
    console.log(drop.value)
    drop.value.toggle(event);
};

const save = () => {
    toast.add({severity: 'success', summary: 'Success', detail: 'Data Saved', life: 3000});
};
</script>
