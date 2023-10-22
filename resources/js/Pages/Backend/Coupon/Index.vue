<template>
  <AdminLayout>
    <div class="px-4 py-5 md:px-6 lg:px-8">
      <BreadList primary-name="Coupons" />
      <Divider />
      <div
        class="flex align-items-start flex-column lg:justify-content-between lg:flex-row"
      >
        <div class="font-medium text-3xl text-900">Coupons</div>
        <div class="mt-3 lg:mt-0">
          <Link :href="route('coupons.create')">
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
        v-model:visible="deleteCouponDialog"
        :dismissableMask="true"
        :modal="true"
        :style="{ width: '450px' }"
        header="Confirm"
      >
        <div class="confirmation-content">
          <i class="pi pi-exclamation-triangle mr-3" style="font-size: 2rem" />
          <span v-if="coupon"
            >Are you sure you want to delete <b>{{ coupon.coupon_code }}</b
            >?</span
          >
        </div>
        <template #footer>
          <Button
            icon="pi pi-times"
            label="No"
            text
            @click="deleteCouponDialog = false"
          />
          <Button icon="pi pi-check" label="Yes" text @click="deleteCoupon" />
        </template>
      </Dialog>

      <!-- Coupon Table -->
      <div v-if="coupons" class="card mt-5">
        <DataTable
          v-model:filters="filters"
          :globalFilterFields="['coupon_code']"
          :rows="10"
          :rowsPerPageOptions="[5, 10, 20, 50]"
          :sortOrder="-1"
          :value="coupons"
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
              There is no Coupon currently.
            </div>
          </template>
          <template #loading> Loading coupons data. Please wait.</template>
          <Column field="id" header="ID" sortable style="width: 1%"></Column>
          <Column
            field="coupon_code"
            header="Coupon Code"
            sortable
            style="width: 10%"
          ></Column>
          <Column
            field="discount"
            header="Discount Price"
            sortable
            style="width: 10%"
          >
            <template #body="slotProps">
              {{ formatCurrency(slotProps.data.discount) }}
            </template>
          </Column>
          <Column
            field="min_purchase"
            header="Min Purchase price"
            sortable
            style="width: 10%"
          >
            <template #body="slotProps">
              {{ formatCurrency(slotProps.data.min_purchase) }}
            </template>
          </Column>
          <Column
            field="discounttimeline.start"
            header="Start Date"
            style="width: 10%"
          >
          </Column>
          <Column
            field="discounttimeline.end"
            header="Expired Date"
            style="width: 10%"
          ></Column>
          <Column field="status" header="Status" style="width: 10%">
            <template #body="{ data }">
              <Tag
                :value="statusText(data.status)"
                :severity="getSeverity(data.status)"
                rounded
              />
            </template>
          </Column>
          <Column field="action" header="Action" style="width: 10%">
            <template #body="slotProps">
              <Link :href="route('coupons.edit', slotProps.data.id)">
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
                @click="confirmDeleteCoupon(slotProps.data)"
              />

              <Link :href="route('coupons.show', slotProps.data.coupon_code)">
                <Button
                  class="ml-2"
                  icon="pi pi-align-left"
                  outlined
                  rounded
                  severity="success"
                  style="height: 40px; width: 40px"
                />
              </Link>
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
import Button from "primevue/button";
import AdminLayout from "../../../Layout/AdminLayout.vue";
import { FilterMatchMode } from "primevue/api";
import { onMounted, ref, watch } from "vue";
import { Link, router } from "@inertiajs/vue3";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import InputText from "primevue/inputtext";
import Divider from "primevue/divider";
import Dialog from "primevue/dialog";
import axios from "axios";
import Toast from "primevue/toast";
import BreadList from "../Component/BreadList.vue";
import { useToast } from "primevue/usetoast";
import TableSkeleton from "../Coupon/Partials/TableSkeleton.vue";
import Tag from "primevue/tag";
import StatusToast from "../../../Component/StatusToast.vue";
import Echo from 'laravel-echo';


//format Currency
const formatCurrency = (value) => {
  return value.toLocaleString("my-MM", {
    style: "currency",
    currency: "MMK",
  });
};

const filters = ref({
  global: { value: null, matchMode: FilterMatchMode.CONTAINS },
});

const getSummary = () => {
  if (status == "Coupon code is created successfully") {
    return "Create Coupon";
  } else {
    return "Edit Coupon";
  }
};

//For status tag
const statusText = (status) => {
  if (status == "active") {
    return "Active";
  } else if (status == "pending") {
    return "Pending";
  } else {
    return "Expired";
  }
};

const getSeverity = (status) => {
  if (status == "active") {
    return "success";
  } else if (status == "pending") {
    return "warning";
  } else {
    return "danger";
  }
};

//delete coupon
const coupon = ref({});
const deleteCouponDialog = ref(false);
const confirmDeleteCoupon = (prod) => {
  coupon.value = { ...prod };
  deleteCouponDialog.value = true;
};
const deleteCoupon = () => {
  router.delete(route("coupons.destroy", coupon.value.id), {
    preserveState: true,
  });
  deleteCouponDialog.value = false;
};

// listening Events

let { coupons, status } = defineProps({ coupons: Array, status: String });

//Load Coupons
onMounted(() => {
    window.Echo.channel('CouponStatus')
        .listen('UpdateCouponStatus', (e) =>{
              const UpdateCouponStatus = coupons.find((coupon)=>coupon.id == e.coupon.id)
              if(UpdateCouponStatus){
                UpdateCouponStatus.status=e.coupon.status
              }
    });
//   router.reload({ only: ["coupons"] });
});
</script>

<style></style>
