<template>
  <AdminLayout>
    <div class="px-4 py-5 md:px-6 lg:px-8">
      <BreadList primary-name="Timeline" />
      <Divider />
      <div
        class="flex align-items-start flex-column lg:justify-content-between lg:flex-row"
      >
        <div class="font-medium text-3xl text-900">Timelines</div>
        <div class="mt-3 lg:mt-0">
          <Link :href="route('discount_timelines.create')">
            <Button icon="pi pi-plus" label="Create"></Button>
          </Link>
        </div>
      </div>
      <StatusToast
        :detail="status"
        :status="status"
        severity="success"
        :summary="getSummary()"
      />
      <!-- Coupon delete dialog -->
      <Dialog
        v-model:visible="deleteTimelineDialog"
        :dismissableMask="true"
        :modal="true"
        :style="{ width: '450px' }"
        header="Confirm"
      >
        <div class="confirmation-content">
          <i class="pi pi-exclamation-triangle mr-3" style="font-size: 2rem" />
          <span v-if="timeline"
            >Are you sure you want to delete <b>{{ timeline.start }}</b> to <b>{{timeline.end}}</b>?</span
          >
        </div>
        <template #footer>
          <Button
            icon="pi pi-times"
            label="No"
            text
            @click="deleteTimelineDialog = false"
          />
          <Button icon="pi pi-check" label="Yes" text @click="deleteTimeline"/>
        </template>
      </Dialog>

      <!-- timeline table -->
      <div v-if="timelines" class="card mt-5">
        <DataTable
          v-model:filters="filters"
          :globalFilterFields="['start', 'end']"
          :rows="5"
          :rowsPerPageOptions="[5, 10, 20, 50]"
          :sortOrder="-1"
          :value="timelines"
          paginator
          tableStyle="min-width: 50rem"
        >
          <template #header>
            <div class="flex justify-content-end">
              <span class="p-input-icon-left">
                <i class="pi pi-search" />
                <InputText
                  v-model="filters['global'].value"
                  placeholder="Keyword Search"
                />
              </span>
            </div>
          </template>
          <template #empty>
            <div class="text-lg font-medium text-center">
              There is no Timeline currently.
            </div>
          </template>
          <template #loading> Loading timelines data. Please wait.</template>
          <Column field="id" header="ID" sortable style="width: 1%"></Column>
          <Column
            field="start"
            header="Start Date"
            sortable
            style="width: 10%"
          ></Column>
          <Column
            field="end"
            header="End Date"
            sortable
            style="width: 10%"
          ></Column>

          <Column field="action" header="Action" style="width: 10%">
            <template #body="slotProps">
              <Link :href="route('discount_timelines.edit', slotProps.data.id)">
                <Button
                  class="mr-2"
                  icon="pi pi-pencil"
                  outlined
                  rounded
                  severity="warning"
                  style="height: 40px; width: 40px"
                />
              </Link>

              <Button
                icon="pi pi-trash"
                outlined
                rounded
                severity="danger"
                style="height: 40px; width: 40px"
                @click="confirmDeleteTimeline(slotProps.data)"
              />
            </template>
          </Column>
        </DataTable>
      </div>
      <div v-else>
        <TableSkeleton></TableSkeleton>
      </div>
    </div>
  </AdminLayout>
</template>

<script setup>
import AdminLayout from "../../../Layout/AdminLayout.vue";
import { Link, router } from "@inertiajs/vue3";
import { onMounted, ref } from "vue";
import { FilterMatchMode } from "primevue/api";
import BreadList from "../Component/BreadList.vue";
import Divider from "primevue/divider";
import Button from "primevue/button";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import InputText from "primevue/inputtext";
import StatusToast from "../../../Component/StatusToast.vue";
import TableSkeleton from "../Timeline/Partials/TableSkeleton.vue";
import Dialog from "primevue/dialog";
//filter for table
const filters = ref({
  global: { value: null, matchMode: FilterMatchMode.CONTAINS },
});

//customize summary for toast alert
const getSummary = () => {
  if (status == "created Timeline successfully") {
    return "Create Timeline";
  } else {
    return "Edit Timeline";
  }
};

//open delete dialog
const timeline = ref({});
const deleteTimelineDialog = ref(false);
const confirmDeleteTimeline = (prod) => {
  timeline.value = { ...prod };
  deleteTimelineDialog.value = true;
};
const deleteTimeline= () =>{
    router.delete(route('discount_timelines.destroy',timeline.value.id),{preserveState:true})
    deleteTimelineDialog.value=false;
}

//load the timeline
let { timelines, status } = defineProps({
  status: String,
  timelines: undefined,
});
onMounted(() => {
  router.reload({ only: ["timelines"] });
});
</script>

<style></style>
