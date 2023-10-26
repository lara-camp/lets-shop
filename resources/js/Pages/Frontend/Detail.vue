<template>
    <UserNavbar />
    <div class="col-11 m-auto my-2">
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
    <div class="grid ">
        <div class="col-10  m-auto">
            <div class="grid">
                <div class="col-5">
                    <Galleria :value="images" :responsiveOptions="responsiveOptions" :numVisible="4"
                        :thumbnailsPosition="position" :circular="false" :showItemNavigatorsOnHover="false">
                        <template #item="slotProps">
                            <Image :src="asset(slotProps.item.image)" alt="Image" width="450" height="400" preview />
                        </template>
                        <template #thumbnail="slotProps">
                            <div class="">
                                <img :src="asset(slotProps.item.image)" :alt="slotProps.item.alt"
                                    style="width: 100px; height: 100px; display: block;object-fit: cover;" />
                            </div>
                        </template>
                    </Galleria>

                </div>
                <div class="col-6">
                    <div class="text-4xl font-semibold mb-3"
                        style="max-width: 500px; white-space: normal; word-wrap: break-word;">{{ product.name }} Violet
                        Evergarden With Chinese Art</div>
                    <div class="flex ">
                        <Rating v-model="product.stars" :cancel="false" />
                        <div class="flex align-items-center text-xl ">
                            <i class="pi pi-comment ml-4 mr-2"></i>
                            <div class="font-semibold"> {{ product.reviews.length }} reviews</div>
                        </div>
                    </div>
                    <div class="text-2xl font-bold mt-3 text-primary ">
                        Ks {{ product.price }}
                    </div>
                    <p class="text-xl line-through m-0 p-0 text-gray-500">Ks 200</p>

                    <div class="flex mt-5">

                        <Button icon="pi pi-minus" rounded outlined aria-label="quantity" class="quantity-button"
                            severity="secondary" @click="quantityFunc('minus')" />
                        <InputNumber v-model="quantity" inputId="percent" prefix="quantity : " size="small" class="mx-2" />
                        <Button icon="pi pi-plus" rounded outlined aria-label="quantity" class="quantity-button"
                            severity="secondary" @click="quantityFunc('plus')" />
                    </div>

                    <div class="flex mt-5 align-items-center ">
                        <Button rounded outlined aria-label="quantity" class="buy-now" label="Buy now" />
                        <Button rounded outlined aria-label="quantity" severity="secondary" class="mx-3"
                            label="Add to cart" />
                        <i class="pi pi-heart text-xl cursor-pointer"></i>
                    </div>
                    <Divider class="mt-5 mb-3" />
                    <p class="text-lg m-0 p-0 text-700">Delivery</p>
                    <div class="flex justify-content-between align-items-center mt-3">
                        <div class="">
                            <i class="pi pi-map-marker mr-4"></i>
                            Yangon, Hlaing
                        </div>
                        <div class="text-primary font-semibold cursor-pointer">
                            change
                        </div>
                    </div>
                    <Divider class="mt-5 mb-3" />
                    <div class="mb-3 flex justify-content-between align-items-center">
                        <div>
                            <i class="pi pi-car mr-4"></i>
                            Standard delivery
                        </div>
                        <div class="font-semibold">
                            Ks 3000
                        </div>
                    </div>
                    <div class="">
                        <i class="pi pi-money-bill mr-4"></i>
                        Cash on delivery avaliable
                    </div>
                </div>
            </div>
        </div>
        <div class="col-10 m-auto mt-2">
            <div>
                <div class="text-xl font-semibold text-600 border-left-3 px-3 my-3 border-primary ">Product {{ tab }} of {{
                    product.name }}</div>
            </div>
            <div class="card">
                <TabView v-model:activeIndex="active">
                    <TabPanel @click="tabClick('Description')" header="Description">
                        <p>
                            {{ product.description }}
                        </p>
                    </TabPanel>
                    <TabPanel @click="tabClick('Details')" header="Details">
                        <div class="flex">
                            <div class="mr-8">
                                <div v-for="groupedDetail in groupedDetails" :key="groupedDetail.key">
                                    <div class="flex justify-content-start mb-3">
                                        <p style="width: 100px;" class="font-semibold p-0 m-0">{{ groupedDetail.key }}</p>
                                        <p class="p-0 m-0">{{ groupedDetail.values.join(', ') }}</p>
                                    </div>
                                </div>
                            </div>
                            <Divider layout="vertical" />
                            <div class="ml-5 flex">
                                <div>
                                    <div class="text-3xl mb-2 font-semibold">
                                        Ratings
                                    </div>
                                    <div class="">
                                        <Rating v-model="stars" :cancel="false" readonly />
                                        <div class="my-1 p-0">{{ stars }} out of 5 stars ({{ stars }}/5)</div>
                                    </div>
                                </div>
                                <div class="ml-5 mt-2">
                                    <div class="flex">
                                        <Rating v-model="stars5" readonly class="mb-1 mr-3" :cancel="false" />
                                        <span>30</span>
                                    </div>
                                    <div class="flex">
                                        <Rating v-model="stars4" readonly class="mb-1 mr-3" :cancel="false" />
                                        <span>10</span>
                                    </div>
                                    <div class="flex">
                                        <Rating v-model="stars3" readonly class="mb-1 mr-3" :cancel="false" /><span>4</span>
                                    </div>
                                    <div class="flex">
                                        <Rating v-model="stars2" readonly class="mb-1 mr-3" :cancel="false" /><span>0</span>
                                    </div>
                                    <div class="flex">
                                        <Rating v-model="stars1" readonly class="mb-1 mr-3" :cancel="false" /><span>0</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </TabPanel>
                    <TabPanel @click="tabClick('Reviews')" header="Reviews">
                        <div class="grid m-auto flex">
                            <div class="col-7 px-3">
                                <div class="text-xl mb-3">
                                    Reviews lists
                                </div>
                                <div v-if="product.reviews.length > 0" id="reviewsList"
                                    style="height: 443.6px; overflow-y: scroll; overflow-x: hidden;">
                                    <div class="mb-1 pr-3" v-for="review in product.reviews" :key="review.id">
                                        <pre>
                                            {{review}}
                                        </pre>
                                        <div class="flex justify-content-between align-items-center pt-2 pb-1 ">
                                            <div class="text-lg font-bold">
                                                {{ review.user.name }}
                                            </div>
                                            <div class="text-sm text-500">
                                                {{ formatRelativeTime(review.created_at) }}
                                            </div>
                                        </div>
                                        <div
                                            class="py-3 pl-2 pr-1 border-left-3 border-primary surface-50 flex justify-content-between align-items-center">
                                            <div v-if="review.isEditOpen" class="w-9">
                                                <form @submit.prevent="updateReview(review)" class="flex align-items-center ">
                                                    <input type="text" v-model="review.content"
                                                        class="border-primary border-round outline-none px-3 py-3 w-full ">
                                                    <button type="submit"
                                                        style="outline: none; background: transparent; border: none;">
                                                        <Button label="Edit" icon="pi pi-pencil" outlined class="py-3"/>
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="" v-else>
                                                {{ review.content }}
                                            </div>
                                            <Toast />
                                            <div style="position: relative;">
                                                <i class="pi pi-ellipsis-v cursor-pointer" @click="toggleMenu(review)"
                                                    v-if="user"></i>
                                                <div class="py-2 px-3 bg-white rounded shadow-1"
                                                    style="position: absolute;right: 16px;" v-if="review.isMenuOpen">

                                                    <div v-if="review.user_id == user.id"
                                                        class="flex align-items-center cursor-pointer"
                                                        @click="deleteReview(review.id)"><i
                                                            class="pi pi-trash mr-2 mb-2 p-1"></i><span>Delete</span></div>
                                                    <div v-if="review.user_id == user.id"
                                                        class="flex align-items-center cursor-pointer"
                                                        @click="editReview(review)"><i
                                                            class="pi pi-pencil mr-2 mb-2 p-1"></i><span>Edit</span></div>
                                                    <div class="flex align-items-center cursor-pointer" @click="replyReview(review)"><i
                                                            class="pi pi-reply mr-2 mb-2 p-1"></i><span>Reply</span></div>

                                                </div>

                                            </div>
                                        </div>
                                        <div v-if="review.isReplyOpen">
                                            <form  @submit.prevent="replyReviewServer(review)" class="flex align-items-center mt-3">
                                                    <input type="text" v-model="replyForm.replyContent" autofocus
                                                        class="border-primary border-round outline-none px-3 py-3 w-full ">
                                                    <button type="submit"
                                                        style="outline: none; background: transparent; border: none;">
                                                        <Button label="Reply" icon="pi pi-reply" outlined class="py-3"/>
                                                    </button>
                                                </form>
                                        </div>
                                    </div>
                                </div>
                                <div v-else
                                    class="surface-50 flex flex-column justify-content-center align-items-center h-full">
                                    <div class="text-xl font-semibold">No reviews yet, Let's give it</div>
                                </div>
                            </div>
                            <Divider layout="vertical" class="p-0 m-0" />
                            <div class="col-5 px-3" v-if="user">
                                <div class="text-xl mb-3">
                                    Give reviews
                                </div>
                                <div class="">
                                    <div class="flex justify-content-between align-items-center pt-2 pb-1 ">
                                        <div class="text-lg font-bold">
                                            {{ user.name }}
                                        </div>
                                        <div class="text-sm text-500">xxx.. ago</div>
                                    </div>
                                    <div class="py-3 pl-4 border-left-3 border-primary surface-50"
                                        style="white-space: normal; word-wrap: break-word;">
                                        {{ CommentPreviewText }}
                                    </div>

                                </div>

                                <div class="mt-4">
                                    <form action="post" @submit.prevent="giveReviews">
                                        <span class="p-float-label">
                                            <Textarea v-model="form.content" rows="5" style="width:477px; max-width: 100%;"
                                                :class="form.errors.content ? 'p-invalid' : ''" />
                                            <div v-if="form.errors.content" class="text-red-500"> {{ form.errors.content }}
                                            </div>
                                            <label>Reviews</label>
                                            <div class="flex justify-content-end my-2">
                                                <button type="submit"
                                                    style="outline: none; background: transparent; border: none;">
                                                    <Button label="Submit" />
                                                </button>
                                            </div>
                                        </span>
                                    </form>

                                </div>
                            </div>
                            <div class="col-5 surface-50 flex flex-column justify-content-center align-items-center" v-else>
                                <div class="text-xl mb-3">
                                    Give reviews
                                </div>
                                <div class="font-semibold text-xl">
                                    Please Login first to give reviews
                                </div>
                                <Link :href="route('login')"
                                    class="bg-primary py-2 px-6 text-white border-round-2xl mt-3 no-underline">Login</Link>
                            </div>
                        </div>
                    </TabPanel>
                </TabView>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link, useForm, router } from '@inertiajs/vue3';
import Galleria from 'primevue/galleria';
import { computed, onBeforeUnmount, onMounted, ref, watch } from 'vue';
import UserNavbar from '../../Component/UserNavbar.vue';
import { asset } from '../../asset-helper';
import Rating from 'primevue/rating';
import Image from 'primevue/image';
import Button from 'primevue/button';
import Divider from 'primevue/divider';
import TabView from 'primevue/tabview';
import TabPanel from 'primevue/tabpanel';
import InputNumber from 'primevue/inputnumber';
import Textarea from 'primevue/textarea';
import Menu from 'primevue/menu';
import { useToast } from "primevue/usetoast";
import Toast from 'primevue/toast';
import { formatDistanceToNow } from 'date-fns';

const toast = useToast();
const CommentPreviewText = computed(() => {
    return form.content.length > 0 ? form.content : "your review's preview will appear here..."
})
const formatRelativeTime = (dateTime) => {
    const formattedTime = formatDistanceToNow(new Date(dateTime), { addSuffix: true });
    return formattedTime;
}
const { product, user } = defineProps({ product: Array, user: Object })

const images = ref(product.images);

const isMenuOpenToFalse = () => {
    product.reviews.map((review) => {
        review.isMenuOpen = false;
        review.isEditOpen = false;
        review.isReplyOpen = false;
    })
}

const toggleMenu = (review) => {
    product.reviews.map((r) => {
        if (r.id != review.id && r.isMenuOpen) {
            r.isMenuOpen = false;
        }else if(r.id != review.id && r.isEditOpen){
            r.isEditOpen = false;
        }else if(r.id != review.id && r.isReplyOpen){
            r.isReplyOpen = false;
        }
    })
    review.isMenuOpen = !review.isMenuOpen;
    review.isEditOpen = false;
    review.isReplyOpen = false;
};

onMounted(() => {
    isMenuOpenToFalse();
})
const stars = ref(4);

const stars5 = ref(5);
const stars4 = ref(4);
const stars3 = ref(3);
const stars2 = ref(2);
const stars1 = ref(1);

const form = useForm({
    content: '',
    productId: product.id,
})

const replyForm = useForm({
    productId: product.id,
    parent_id:null,
    replyContent:'',
})
console.log(route('reviews.store'))

const position = ref('bottom');
const responsiveOptions = ref([
    {
        breakpoint: '991px',
        numVisible: 4
    },
    {
        breakpoint: '767px',
        numVisible: 3
    },
    {
        breakpoint: '575px',
        numVisible: 1
    }
]);
// console.log(product)
const groupedDetails = computed(() => {
    const grouped = {};
    product.details.forEach((detail) => {
        if (!grouped[detail.key]) {
            grouped[detail.key] = { key: detail.key, values: [detail.pivot.value] };
        } else {
            grouped[detail.key].values.push(detail.pivot.value);
        }
    });
    return Object.values(grouped);
});


const quantity = ref(1)
const quantityFunc = (type) => {
    if (type == 'plus') {
        quantity.value++
    }
    if (type == 'minus') {
        if (quantity.value <= 0) {
            quantity.value = 0
        } else {
            quantity.value--
        }


    }
}

const tab = ref('Description');
const active = ref(0)
watch(active, () => {
    console.log(active);
    if (active.value == 0) {
        tab.value = 'Description'
    } else if (active.value == 1) {
        tab.value = 'Details'
    } else {
        tab.value = 'Reviews'
    }
})

const giveReviews = (review) => {
    form.post(route('reviews.store'), {
        preserveScroll: true,
        preserveState: true
    });
    form.content = '';
    if (!form.errors) {
        toast.add({ severity: 'success', summary: 'Give review', detail: 'Your review is submitted,', life: 3000 });
    }
}
const deleteReview = (reviewId) => {
    router.delete(route('reviews.destroy', reviewId), {
        preserveScroll: true,
        preserveState: true,
    });
    toast.add({ severity: 'success', summary: 'Delete review', detail: 'Your review is successfully deleted', life: 3000 });
}
const editReview = (review) => {
    // alert(review.isEditOpen);
    review.isEditOpen = !review.isEditOpen;
    review.isMenuOpen = false;
    review.isReplyOpen = false;
}
const updateReview = (review)=>{
    router.patch(route('reviews.update',review.id),{content:review.content},{
        preserveScroll:true,
        preserveState:true,
    })
}

const replyReview  = (review)=>{
    review.isReplyOpen = !review.isReplyOpen;
    review.isMenuOpen = false;
    review.isEditOpen = false;
}

const replyReviewServer = (review)=>{
    console.log(replyForm)
    replyForm.parent_id = review.id;
    replyForm.post(route('reviews.reply'),{
        preserveScroll:true,
        preserveState:true,
    });
}
</script>

<style>
.p-galleria .p-galleria-thumbnail-container {
    background: transparent !important;
    justify-content: space-between !important;
    overflow: hidden !important;
}

.quantity-button:hover {
    background: black;
    color: white;
}

.buy-now {
    background: #870EFF;
    color: white;
}

.buy-now:hover {
    background: transparent;
    color: #870EFF;
    border-color: #870EFF;
}

.p-inputnumber-input {
    border-radius: 70px !important;
    width: 130px !important;
}

#reviewsList::-webkit-scrollbar {
    width: 5px;
}

#reviewsList::-webkit-scrollbar-track {
    border-radius: 8px;
    background-color: #e7e7e7;
}

#reviewsList::-webkit-scrollbar-thumb {
    border-radius: 8px;
    background-color: #d2d0d0e0;
}</style>
