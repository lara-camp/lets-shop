<template>
  <div class="flex">
    <!--Sidebar Section-->
    <div class="sidebar-container h-screen overflow-y-scroll border-right-1 border-gray-300">
        <Sidebar></Sidebar>
    </div>
    <!--Content Section-->
    <div class="content-container">
        <AdminNavbar />
        <slot></slot>
    </div>
  </div>
</template>

<script setup>
import Sidebar from '../Component/Sidebar.vue'
import AdminNavbar from '../Component/AdminNavbar.vue'
</script>

<style scoped>
.sidebar-container {
  width: 15%;
}

.content-container {
  width: 85%;
}

/* Custom scrollbar for Sidebar */
.sidebar-container::-webkit-scrollbar {
  width: 7px;
}

.sidebar-container::-webkit-scrollbar-track {
  background: #f1f1f1;
}

.sidebar-container::-webkit-scrollbar-thumb {
  background: #cccccc;
  border-radius: 20px;
}

.sidebar-container::-webkit-scrollbar-thumb:hover {
  background: #b4b4b4;
}

</style>
