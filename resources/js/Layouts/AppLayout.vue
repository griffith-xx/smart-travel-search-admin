<script setup>
import { Head, Link } from "@inertiajs/vue3";
import { ref } from "vue";
import { useFlash } from "@/Composables/useFlash";
import Toast from "primevue/toast";
import ConfirmPopup from "primevue/confirmpopup";
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
                label: "หน้าแรก",
                href: "dashboard",
                icon: "pi pi-home",
            },
            {
                label: "จังหวัด",
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
    <ConfirmPopup />
    <div class="min-h-screen max-h-screen overflow-hidden flex gap-6">
        <div class="p-6 pr-0">
            <Menu
                class="!border-transparent !h-full !overflow-y-auto"
                :model="items"
            >
                <template #item="{ item, props }">
                    <Link
                        :class="{
                            '!text-primary': route().current(item.href),
                        }"
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
        </div>
        <div class="flex-1 max-h-screen overflow-y-auto p-6 pl-0">
            <slot />
        </div>
    </div>
</template>
