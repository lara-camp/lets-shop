<template>

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

</style>
