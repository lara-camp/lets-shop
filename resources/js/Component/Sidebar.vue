<template>
  <div class="px-2 py-3 text-4xl flex justify-content-center align-items-center">
    Logo
  </div>
  <!--  Main Menu Section  -->
  <div class="text-lg mb-4">
    <!--  Loop through main menus -->
    <template v-for="menu in menus" :key="menu.name">
      <!-- Main Menu Item (With Link) -->
      <Link v-if="menu.route" :href="menu.route" class="no-underline">
        <div :class="menu.active ? 'active' : ''"
             class="side-link-container"
             @click="showNestMenu(menu.name)">
          <i :class="['pi', 'mr-3', menu.icon]" style="font-size:18px"></i>
          <span>{{ menu.name }}</span>
          <i v-if="menu.nested_menus && menu.isOpen"
             class="pi pi-angle-up"
             style="font-size:18px"></i>
          <i v-else-if="menu.nested_menus"
             class="pi pi-angle-down inline-block ml-auto"
             style="font-size:20px"></i>
        </div>
      </Link>
      <!--  Main Menu Item (No Link) -->
      <div v-else :class="menu.active ? 'active' : ''"
           class="side-link-container"
           @click="showNestMenu(menu.name)">
        <i :class="['pi', 'mr-3', menu.icon]" style="font-size:18px"></i>
        <span>{{ menu.name }}</span>
        <i v-if="menu.nested_menus && menu.isOpen"
           class="pi pi-angle-up"
           style="font-size:18px"></i>
        <i v-else-if="menu.nested_menus"
           class="pi pi-angle-down inline-block ml-auto"
           style="font-size:20px"></i>
      </div>
      <!-- Nested Menu Section (with transition) -->
      <transition name="slide">
        <div v-if="menu.nested_menus && menu.isOpen" class="dropdown-menu">
          <!-- Loop through nested menus -->
          <template v-for="nested_menu in menu.nested_menus">
            <!-- Nested Menu Item (With Link) -->
            <Link :href="nested_menu.route" class="no-underline">
              <div :class="nested_menu.active ? 'active' : ''" class="nest-side-link">
                <i :class="['pi', 'mr-3', nested_menu.icon]" style="font-size:16px"></i>
                <span>{{ nested_menu.name }}</span>
              </div>
            </Link>
          </template>
        </div>
      </transition>
    </template>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { Link, router } from '@inertiajs/vue3'

const menus = ref({
  // ... (Menu Items)
  dashboard: {
    name: 'Dashboard',
    icon: 'pi-home',
    active: router.page.url === '/dashboard' ?? false,
    route: route('admin.dashboard')
  },
  product: {
    name: 'Products',
    icon: 'pi-box',
    active: false,
    isOpen: false,
    nested_menus: [
      {
        name: 'All', active: false, icon: 'pi-list',
        route: route('products.index')
      },
      {
        name: 'Create', active: false, icon: 'pi-plus-circle',
        route: route('products.create')
      }
    ]
  },
  category: {
    name: 'Categories',
    icon: 'pi-th-large',
    active: false,
    isOpen: false,
    nested_menus: [
      { name: 'All', active: false, icon: 'pi-list' },
      { name: 'Create', active: false, icon: 'pi-plus-circle' }
    ]
  },
  timeline: {
    name: 'Timelines',
    icon: 'pi-calendar',
    active: false,
    isOpen: false,
    nested_menus: [
      { name: 'All', active: false, icon: 'pi-list' },
      { name: 'Create', active: false, icon: 'pi-plus-circle' }
    ]
  },
  coupon: {
    name: 'Coupons',
    icon: 'pi-ticket',
    active: false,
    isOpen: false,
    nested_menus: [
      { name: 'All', active: false, icon: 'pi-list' },
      { name: 'Create', active: false, icon: 'pi-plus-circle' }
    ]
  },
  orders: {
    name: 'Orders',
    icon: 'pi-truck',
    active: false,
  },
  payments: {
    name: 'Payments',
    icon: 'pi-wallet',
    active: false,
  },
  mail: {
    name: 'Mails',
    icon: 'pi-inbox',
    active: false,
  },
  chat: {
    name: 'Chat',
    icon: 'pi-comment',
    active: false,
  },
  reviews: {
    name: 'Reviews',
    icon: 'pi-box',
    active: false,
  },
  pages: {
    name: 'Pages',
    icon: 'pi-file',
    active: false,
  },
  accounts: {
    name: 'Accounts',
    icon: 'pi-user',
    active: false,
  },
  logout: {
    name: 'Logout',
    icon: 'pi-sign-out',
    active: false,
  }
})

// Function to toggle nested menu visibility
const showNestMenu = (menuName) => {
  for (let menu in menus.value) {
    if (menus.value[menu].name === menuName) {
      menus.value[menu].isOpen = !menus.value[menu].isOpen
    }
  }
}

</script>

<style scoped>
.side-link-container {
  margin: 8px 20px;
  padding: 10px 20px;
  color: #424242;
  font-weight: 600;
  transition: background 0.1s;
  cursor: pointer;
  border-radius: 20px;
}

.side-link-container:hover {
  background: #eeeeee;
}

.side-link-container.active {
  background: var(--primary-color);
  padding: 10px 20px;
  color: white;
}

.nest-side-link {
  margin: 0 20px 3px 30px;
  padding: 8px 25px;
  color: #424242;
  font-weight: 500;
  transition: background 0.1s;
  cursor: pointer;
  border-radius: 20px;

}

.nest-side-link:hover {
  background: #eeeeee;
}

.nest-side-link.active {
  background: var(--primary-color);
  color: white;
}

.dropdown-menu {
  max-height: 200px;
  overflow: hidden;
  transition: max-height 0.3s ease-in-out;
}

.slide-enter-active, .slide-leave-active {
  transition: max-height 0.3s ease-in-out;
}

.slide-enter-from, .slide-leave-to {
  max-height: 0; /* Adjust this value to suit your content */
}
</style>
