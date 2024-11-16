<script setup>
import { ref } from "vue";
import { useRouter } from 'vue-router';
import Menubar from 'primevue/Menubar';
import Menu from 'primevue/menu';
import Avatar from 'primevue/Avatar';
import Logo from '@/assets/images/logo.png';

const router = useRouter();

const navbarMenuItems = ref([
    {
        label: 'Dashboard',
    },
    {
        label: 'Calculator',
    },
    {
        label: 'Appliances',
        items: [
            {
                label: 'Manage Appliances',
                command: () => {
                    router.push({ name: 'account.appliances' });
                }
            },
            {
                label: 'Appliance Categories',
                command: () => {
                    router.push({ name: 'account.categories' });
                }
            },
        ]
    },
    {
        label: 'Reports',
    },
]);

const profileMenu = ref();

const profileMenuItems = ref([
    {
        label: 'Account Settings',
    },
    {
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