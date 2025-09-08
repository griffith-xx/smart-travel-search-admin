<script setup>
import { Head, Link, router } from "@inertiajs/vue3";
import { ref } from "vue";
import { useFlash } from "@/Composables/useFlash";
import Toast from "primevue/toast";
import ConfirmPopup from "primevue/confirmpopup";
import Menu from "primevue/menu";
import { useConfirm } from "primevue/useconfirm";

defineProps({
    title: {
        type: String,
        required: true,
    },
});

const confirm = useConfirm();

const items = ref([
    {
        label: "เมนู",
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
            {
                label: "หมวดหมู่",
                href: "categories.index",
                icon: "pi pi-folder-open",
            },
        ],
    },
    {
        label: "จัดการ",
        items: [
            {
                label: "โหมดกลางคืน",
                is_button: true,
                icon: "pi pi-moon",
                command: () => {
                    //
                },
            },
            {
                label: "ออกจากระบบ",
                is_button: true,
                icon: "pi pi-sign-out",
                command: () => {
                    logout();
                },
            },
        ],
    },
]);

const logout = () => {
    confirm.require({
        message: "คุณแน่ใจหรือไม่ว่าต้องการออกจากระบบ?",
        header: "ยืนยันการออกจากระบบ",
        rejectProps: {
            label: "ยกเลิก",
            severity: "secondary",
            outline: true,
        },
        acceptProps: {
            label: "ยืนยัน",
            severity: "danger",
        },
        icon: "pi pi-exclamation-triangle",
        accept: () => {
            router.post(route("logout"));
        },
    });
};
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
                        v-if="!item.is_button"
                        v-bind="props.action"
                        :class="{
                            '!text-primary': route().current(item.href),
                        }"
                        :href="route(item.href)"
                    >
                        <span :class="item.icon" />
                        <span class="ml-2">
                            {{ item.label }}
                        </span>
                    </Link>

                    <button v-if="item.is_button" v-bind="props.action">
                        <span :class="item.icon" />
                        <span class="ml-2">
                            {{ item.label }}
                        </span>
                    </button>
                </template>
            </Menu>
        </div>
        <div class="flex-1 max-h-screen overflow-y-auto p-6 pl-0">
            <slot />
        </div>
    </div>
</template>
