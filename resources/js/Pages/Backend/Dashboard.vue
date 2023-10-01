<template>
  <h1>this is dashboard</h1>
  <Link :href="route('logout')" method="post"><Button label="Logout" size="small"></Button></Link>
</template>

<script setup>
import {Link} from '@inertiajs/vue3'
import Button from 'primevue/button'


</script>

<style>

</style>
