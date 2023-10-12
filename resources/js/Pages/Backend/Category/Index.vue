<template>
  <Head title="Categories"/>
  <AdminLayout>
    <div class="px-4 py-5 md:px-6 lg:px-8">
      <ul class="list-none p-0 m-0 flex align-items-center font-medium mb-3">
        <li>
          <span class="text-900 line-height-3">Categories</span>
        </li>
      </ul>
      <Divider/>
      <div class="flex align-items-start flex-column lg:justify-content-between lg:flex-row">
        <div class="font-medium text-3xl text-900">Categories</div>
        <div class="mt-3 lg:mt-0">
          <Button icon="pi pi-plus" label="Create" @click="visible = true"></Button>
          <!-- Status Toast for category created -->
          <Toast/>

          <!-- Dialog for detail category -->
          <Dialog v-model:visible="detailDialog"
                  :dismissableMask="true"
                  :modal="true"
                  :style="{width: '50vw'}"
                  class="p-fluid"
                  header="Detail Category">
            <div class="flex">
              <div v-if="category.image" class="col-5">
                <Image :src="asset(category.image)" preview width="300"/>
              </div>
              <div v-else class="col-5">
                <img alt=""
                     src="https://st2.depositphotos.com/38069286/47731/v/450/depositphotos_477315358-stock-illustration-picture-isolated-background-gallery-symbol.jpg"
                     width="300">
              </div>
              <div class="col-6">
                <p class="text-xl font-medium">Category Name - <b>{{ category.title }}</b></p>
                <p class="text-xl font-medium">Product Count - <b>{{ category.products_count }}</b>
                </p>
              </div>
            </div>
          </Dialog>

          <!-- Dialog for edit category -->
          <Dialog v-model:visible="categoryDialog"
                  :dismissableMask="true"
                  :modal="true"
                  :style="{width: '50vw'}"
                  class="p-fluid"
                  header="Category Edit">
            <div class=" justify-content-center">
              <div class=" p-3">
                <div v-if="category.image"
                     class="flex justify-content-center bg-black-alpha-90 p-3 relative">
                  <Image :src="asset(category.image)" width="250"/>
                  <Button class="absolute"
                          icon="pi pi-trash"
                          rounded
                          severity="danger"
                          style="top: 20px;right: 20px"
                          @click="deleteImage(category.id)"></Button>
                </div>
                <div class="flex flex-column gap-2 mt-3">
                  <label class="text-xl font-medium" for="name">Category Name</label>
                  <InputText id="name"
                             v-model="category.title"
                             aria-describedby="name-help"
                             name="title"/>
                  <!-- title Input Error Message -->
                  <div v-if="titleError" class="text-red-600">{{ titleError }}</div>
                </div>

                <div class="flex flex-column gap-2">
                  <div class="flex align-items-center my-3">
                    <Checkbox v-model="editChecked" :binary="true"/>
                    <label class="text-xl font-medium ml-2">Have parent category</label>
                  </div>
                  <Dropdown v-model="category.parent_id"
                            :disabled="!editChecked"
                            :options="SelectCategories"
                            class="w-full "
                            filter
                            optionLabel="title"
                            optionValue="id"
                            placeholder="Select a Category">
                  </Dropdown>
                </div>
                <!-- File upload -->
                <div class="flex flex-column gap-2">
                  <div class="font-medium text-xl my-2">Image <span v-if="category.image"
                                                                    class="text-red-500">(You need to delete an old image first)</span>
                  </div>
                  <div class="card">
                    <FileUpload :maxFileSize="1000000"
                                :multiple="true"
                                :showUploadButton="false"
                                accept="image/jpeg, image/png"
                                @input="addImage($event.target.files)">
                      <template #empty>
                        <p>Drag and drop files to here to upload.</p>
                      </template>
                      <template #header="{ chooseCallback, clearCallback, files }">
                        <div class="flex flex-wrap justify-content-between align-items-center flex-1 gap-2">
                          <div class="flex gap-2">
                            <Button :disabled="category.image"
                                    class="p-3"
                                    icon="pi pi-images"
                                    outlined
                                    rounded
                                    @click="chooseFile(chooseCallback, files)"></Button>

                            <Button :disabled="!files || files.length === 0"
                                    class="p-3"
                                    icon="pi pi-times"
                                    outlined
                                    rounded
                                    severity="danger"
                                    @click="clearCallback()"></Button>
                          </div>
                        </div>
                      </template>
                      <template #content="{ files, removeFileCallback }">
                        <div v-if="files.length > 0">
                          <div class="flex flex-column">
                            <div v-for="(file, index) of files"
                                 :key="file.name + file.type + file.size"
                                 class="card mb-3 flex p-2 w-full justify-content-between border-1 surface-border align-items-center">
                              <div class="flex align-items-center">
                                <img :alt="file.name"
                                     :src="file.objectURL"
                                     class="shadow-2"
                                     height="70"
                                     role="presentation"
                                     width="100"/>
                                <span class="font-semibold ml-3">{{ file.name }}</span>
                              </div>
                              <Button class="p-3"
                                      icon="pi pi-times"
                                      outlined
                                      rounded
                                      severity="danger"
                                      @click="removeImage( removeFileCallback, index)"/>
                            </div>
                          </div>
                        </div>
                      </template>
                    </FileUpload>

                  </div>
                </div>
                <div class="flex justify-content-end mt-2">
                  <Button class="text-xl font-medium "
                          label="Edit"
                          @click="updateCategory"></Button>
                </div>
              </div>
            </div>
          </Dialog>

          <!-- For category create dialog -->
          <Dialog v-model:visible="visible"
                  :dismissableMask="true"
                  :style="{ width: '50vw'}"
                  header="Create Category"
                  modal>
            <div class=" justify-content-center">
              <div class=" p-3">
                <div class="flex flex-column gap-2">
                  <label class="text-xl font-medium" for="name">Category Name</label>
                  <InputText id="name"
                             v-model="title"
                             aria-describedby="name-help"
                             name="title"/>
                  <!-- title Input Error Message -->
                  <div v-if="titleError" class="text-red-600">{{ titleError }}</div>
                </div>

                <div class="flex flex-column gap-2">
                  <div class="flex align-items-center my-3">
                    <Checkbox v-model="checked" :binary="true"/>
                    <label class="text-xl font-medium ml-2">Have parent category</label>
                  </div>
                  <Dropdown v-model="parentCategory"
                            :disabled="!checked"
                            :options="SelectCategories"
                            class="w-full "
                            filter
                            optionLabel="title"
                            placeholder="Select a Category">
                  </Dropdown>
                </div>
                <!-- Category image input -->
                <div class="flex flex-column my-4">
                  <div class="font-medium text-xl mb-2">Image (Optional)</div>
                  <div class="card">
                    <FileUpload :maxFileSize="1000000"
                                :multiple="true"
                                :showUploadButton="false"
                                accept="image/jpeg, image/png"
                                url="./upload.php"
                                @input="addImage($event.target.files)">
                      <template #empty>
                        <p>Drag and drop files to here to upload.</p>
                      </template>
                      <template #header="{ chooseCallback, clearCallback, files }">
                        <div class="flex flex-wrap justify-content-between align-items-center flex-1 gap-2">
                          <div class="flex gap-2">
                            <Button icon="pi pi-images"
                                    outlined
                                    rounded
                                    @click="chooseFile(chooseCallback, files)"></Button>

                            <Button :disabled="!files || files.length === 0"
                                    icon="pi pi-times"
                                    outlined
                                    rounded
                                    severity="danger"
                                    @click="clearCallback()"></Button>
                          </div>
                        </div>
                      </template>
                      <template #content="{ files, removeFileCallback }">
                        <div v-if="files.length > 0">
                          <div class="flex flex-column">
                            <div v-for="(file, index) of files"
                                 :key="file.name + file.type + file.size"
                                 class="card mb-3 flex p-2 w-full justify-content-between border-1 surface-border align-items-center">
                              <div class="flex align-items-center">
                                <img :alt="file.name"
                                     :src="file.objectURL"
                                     class="shadow-2"
                                     height="70"
                                     role="presentation"
                                     width="100"/>
                                <span class="font-semibold ml-3">{{ file.name }}</span>
                              </div>
                              <Button icon="pi pi-times"
                                      outlined
                                      rounded
                                      severity="danger"
                                      @click="removeImage( removeFileCallback, index)"/>
                            </div>
                          </div>
                        </div>
                      </template>
                    </FileUpload>

                  </div>
                </div>
                <div class="flex justify-content-end mt-2">
                  <Button class="text-xl font-medium "
                          label="Create"
                          @click="createCategory"></Button>
                </div>
              </div>
            </div>
          </Dialog>

          <!-- For Category Delete Dialog -->
          <Dialog v-model:visible="deleteProductDialog"
                  :dismissableMask="true"
                  :modal="true"
                  :style="{width: '450px'}"
                  header="Confirm">
            <div class="confirmation-content">
              <i class="pi pi-exclamation-triangle mr-3" style="font-size: 2rem"/>
              <span v-if="category">Are you sure you want to delete <b>{{
                  category.title
                }}</b>?</span>
            </div>
            <template #footer>
              <Button icon="pi pi-times"
                      label="No"
                      text
                      @click="deleteProductDialog = false"/>
              <Button icon="pi pi-check" label="Yes" text @click="deleteProduct"/>
            </template>
          </Dialog>
        </div>
      </div>
      <div v-if="categories" class="card mt-5">
        <DataTable v-model:filters="filters"
                   :globalFilterFields="['title']"
                   :rows="10"
                   :rowsPerPageOptions="[5, 10, 20, 50]"
                   :sortOrder="-1"
                   :value="categories"
                   paginator
                   tableStyle="min-width: 50rem">
          <template #header>
            <div class="flex justify-content-end">
            <span class="p-input-icon-left">
                <i class="pi pi-search"/>
                <InputText v-model="filters['global'].value" placeholder="Keyword Search"/>
            </span>
            </div>
          </template>
          <template #empty>
            <div class="text-lg font-medium text-center"> There is no category currently.</div>
          </template>
          <template #loading> Loading categories data. Please wait.</template>
          <Column field="id" header="ID" sortable style="width: 1%"></Column>
          <Column field="title"
                  header="Category Name"
                  sortable
                  style="width: 10%"></Column>
          <Column field="products_count"
                  header="Product Qty"
                  sortable
                  style="width: 10%"></Column>
          <Column field="action" header="Action" style="width: 10%">
            <template #body="slotProps">
              <Button class="mr-2"
                      icon="pi pi-pencil"
                      outlined
                      rounded
                      severity="warning"
                      style="height: 40px; width: 40px"
                      @click="editCategory(slotProps.data)"/>
              <Button icon="pi pi-trash"
                      outlined
                      rounded
                      severity="danger"
                      style="height: 40px; width: 40px"
                      @click="confirmDeleteProduct(slotProps.data)"/>
              <Button class="ml-2"
                      icon="pi pi-align-left"
                      outlined
                      rounded
                      severity="success"
                      style="height: 40px; width: 40px"
                      @click="detailCategory(slotProps.data)"/>
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
import Button from 'primevue/button'
import AdminLayout from '../../../Layout/AdminLayout.vue'
import { FilterMatchMode } from 'primevue/api'
import { onMounted, onUpdated, ref, watch } from 'vue'
import { router } from '@inertiajs/vue3'
import DataTable from 'primevue/datatable'
import Column from 'primevue/column'
import InputText from 'primevue/inputtext'
import Divider from 'primevue/divider'
import Dialog from 'primevue/dialog'
import Checkbox from 'primevue/checkbox'
import Dropdown from 'primevue/dropdown'
import axios from 'axios'
import Toast from 'primevue/toast'
import { useToast } from 'primevue/usetoast'
import TableSkeleton from '../Category/Partials/TableSkeleton.vue'
import FileUpload from 'primevue/fileupload'
import Image from 'primevue/image'
import { asset } from '../../../asset-helper.js'

//edit category dialog
const editChecked = ref(false)
const categoryDialog = ref(false)
const category = ref({})
const editCategory = (prod) => {
  category.value = { ...prod }
  editChecked.value = !!category.value.parent_id
  categoryDialog.value = true
}

//delete category dialog
const deleteProductDialog = ref(false)
const confirmDeleteProduct = (prod) => {
  category.value = { ...prod }
  deleteProductDialog.value = true
}
const deleteProduct = () => {
  deleteProductDialog.value = false
  axios.delete(route('categories.destroy', category.value.slug))
      .then((response) => {
        console.log(response.data)
        getCategories()
        CategoryToast.add({
          severity: 'success',
          summary: 'Delete Category',
          detail: `${response.data.title} is deleted successfully`,
          life: 5000
        })
      })
}

const visible = ref(false) //for Dialog close and open
const title = ref(null)
const titleError = ref(null)
const parentCategory = ref(null)
const image = ref([])
const CategoryToast = useToast()

const createCategory = () => {
  const formdata = new FormData()
  formdata.set('title', title.value)
  parentCategory.value ? formdata.set('parentCategory', parseInt(parentCategory.value.id)) : ''
  formdata.set('image', image.value)

  axios.post(route('categories.store'), formdata, { headers: { 'Content-Type': 'multipart/form-data' } })
      .then((response) => {
        if (response.data) {
          console.log(response.data)
          image.value = []
          titleError.value = ''
          title.value = ''
          parentCategory.value = ''
          visible.value = false
          checked.value = false
          getCategories()    //calling getCategories function
          CategoryToast.add({
            severity: 'success',
            summary: 'New Category',
            detail: `New Category (${response.data.title}) is created successfully`,
            life: 5000
          })
        }
      })
      .catch((error) => {
        if (error) {
          console.log(error.response.data)
          titleError.value = error.response.data.errors.title[0]
        }
      })
}

const detailDialog = ref(false)
const detailCategory = (prod) => {
  category.value = { ...prod }
  detailDialog.value = true
}

//choosing file for file upload
const chooseFile = (chooseCallback, files) => {
  if (files.length > 0) {
    CategoryToast.add({
      severity: 'error',
      summary: 'File Upload Error',
      detail: `Cannot upload more than one image`,
      life: 5000
    })
  } else {
    chooseCallback()
  }
}
//add category image
const addImage = (i) => {
  image.value = i[0]
}
//remove image
const removeImage = (removeFileCallback, index) => {
  removeFileCallback(index)
}
const deleteImage = (id) => {
  axios.delete(route('categoryImage.destroy', id))
      .then((response) => {
        category.value.image = null
        getCategories()
      })
}

//Update category
const updateCategory = () => {
  const formdata = new FormData()
  formdata.append('_method', 'put')
  formdata.append('title', category.value.title)
  // formdata.append('parentCategory',category.value.parent_id)
  category.value.parent_id ? formdata.append('parentCategory', parseInt(category.value.parent_id)) : ''
  formdata.append('id', category.value.id)
  formdata.append('image', image.value)
  axios.post(route('categories.update', category.value.slug), formdata, { headers: { 'Content-Type': 'multipart/form-data' } })
      .then((response) => {
        if (response.data) {
          console.log(response.data)
          getCategories()
          if (response.data.error) {
            CategoryToast.add({
              severity: 'error',
              summary: 'Error',
              detail: `${response.data.error}`,
              life: 5000
            })
          } else {
            categoryDialog.value = false
            CategoryToast.add({
              severity: 'success',
              summary: 'Edit Category',
              detail: `${response.data.title} is updated successfully`,
              life: 5000
            })
          }
        }
      })

      .catch((error) => console.log(error))
}

//Getting categories from database
const categories = ref(undefined)
const SelectCategories = ref(undefined)
const getCategories = () => {
  axios.get(route('categories.index'))
      .then((response) => {
        if (response) {
          SelectCategories.value = response.data
          categories.value = response.data
        }
      })
      .catch((error) => {
        console.log(error)
      })
}

const checked = ref(false)  //for have parent checkbox true or false
const filters = ref({
  global: { value: null, matchMode: FilterMatchMode.CONTAINS },
})

onMounted(() => {
  getCategories()
  router.reload({ only: ['categories'] })
})

</script>

<style scoped></style>
