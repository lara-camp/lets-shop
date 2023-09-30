<template>
  <div class="container main-container min-h-screen bg-cover bg-center bg-no-repeat p-0 relative">
    <div class="back-cover absolute z-0 min-h-full min-w-full"></div>
    <div class="grid justify-content-center align-items-center min-h-screen px-2">
      <div class="lg:col-10 col-12 z-1 grid justify-content-center">
        <slot></slot>
      </div>
    </div>
  </div>
</template>

<script setup>
</script>

<style>
.main-container {
  background-image: url("../../images/user_login_bg.jpg");
}

.back-cover {
  background-color: rgba(255, 255, 255, 0.4);
  -webkit-backdrop-filter: blur(5px);
  backdrop-filter: blur(10px);
}

body {
  overflow: hidden;
  margin: 0;
}
</style>