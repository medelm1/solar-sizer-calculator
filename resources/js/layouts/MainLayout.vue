<script setup>
import Card from 'primevue/card';
import Navbar from '@/components/Navbar.vue';

</script>
<template>
    <Navbar></Navbar>
    <Card class="max-w-[800px] mx-auto my-4">
        <template #content>
            <router-view></router-view>
        </template>
    </Card>
</template>