<script setup>
import { Head, Link } from "@inertiajs/vue3";
import { ref } from "vue";
import { useFlash } from "@/Composables/useFlash";
import Toast from "primevue/toast";
import Menu from "primevue/menu";

defineProps({
    title: {
        type: String,
        required: true,
    },
});
const items = ref([
    {
        label: "Menu",
        items: [
            {
                label: "Dashboard",
                href: "dashboard",
                icon: "pi pi-home",
            },
            {
                label: "Provinces",
                href: "provinces.index",
                icon: "pi pi-map",
            },
        ],
    },
]);
useFlash();
</script>

<template>
    <Head :title="title" />
    <Toast />
    <div class="min-h-screen flex p-5 gap-5">
        <Menu class="!border-transparent" :model="items">
            <template #item="{ item, props }">
                <Link
                    :class="{'!text-primary': route().current(item.href) }"
                    :href="route(item.href)"
                    v-bind="props.action"
                >
                    <span :class="item.icon" />
                    <span class="ml-2">
                        {{ item.label }}
                    </span>
                </Link>
            </template>
        </Menu>
        <div>
            <slot />
        </div>
    </div>
</template>
