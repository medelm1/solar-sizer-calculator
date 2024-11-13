<script setup>
import { ref } from "vue";
import Menubar from 'primevue/Menubar';
import Menu from 'primevue/menu';
import Avatar from 'primevue/Avatar';
import Logo from '@/assets/images/logo.png';

const navbarMenuItems = ref([
    {
        // The main landing page or overview of the user's activity, 
        // providing quick access to recent calculations, saved settings, 
        // and any ongoing projects.
        label: 'Dashboard',
    },
    {
        // Direct access to the core tool for calculating solar panel requirements, 
        // where users can input energy data.
        label: 'Calculator',
    },
    {
        label: 'Appliances',
        items: [
            {
                // View, add, edit, or remove appliances from the list.
                label: 'Manage Appliances'
            },
            {
                // Organize appliances by category (e.g., heating, lighting, cooling).
                label: 'Appliance Categories'
            }
        ]
    },
    {
        // Access to detailed reports or results from past calculations, 
        // including system size, panel count, energy savings, etc.
        label: 'Reports',
    },
]);

const profileMenu = ref();

const profileMenuItems = ref([
    {
        // Change user profile details, password, and account settings.
        // A menu to configure personal preferences such as energy cost rate, 
        // currency, location settings, and dark mode toggle.
        label: 'Account Settings',
    },
    {
        // Option to confirm the logout action before being signed out of the dashboard.
        label: 'Logout',
    }
]);

const toggleProfileMenu = (event) => {
    profileMenu.value.toggle(event);
}

</script>
<template>
    <div class="card">
        <Menubar :model="navbarMenuItems">
            <template #start>
                <img :src="Logo" alt="Solar Sizer Caluclator Logo" class="h-[42px]">
            </template>
            <template #item="{ item, props, hasSubmenu, root }">
                <a class="flex items-center" v-bind="props.action">
                    <span>{{ item.label }}</span>
                    <span v-if="item.shortcut" class="ml-auto border border-surface rounded bg-emphasis text-muted-color text-xs p-1">{{ item.shortcut }}</span>
                    <i v-if="hasSubmenu" :class="['pi pi-angle-down ml-auto', { 'pi-angle-down': root, 'pi-angle-right': !root }]"></i>
                </a>
            </template>
            <template #end>
                <div class="flex items-center gap-2">
                    <Avatar image="https://primefaces.org/cdn/primevue/images/avatar/amyelsner.png" shape="circle" @click="toggleProfileMenu" aria-haspopup="true" aria-controls="profileMenu" />
                    <Menu ref="profileMenu" id="profileMenu" :model="profileMenuItems" :popup="true" />
                </div>
            </template>
        </Menubar>
    </div>
</template>