<template>
  <h1>this is dashboard</h1>
    <form @submit.prevent="form.post('/dashboard/logout')">
        <button type="submit" >Logout</button>
    </form>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'

const form = useForm({});

</script>

<style>

</style>
