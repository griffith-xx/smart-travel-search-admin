<script setup>
import { Link, router } from "@inertiajs/vue3";
import Menu from "primevue/menu";
import { computed } from "vue";
import { useConfirm } from "primevue/useconfirm";
import { toggleDarkMode, isDarkMode } from "@/Composables/useTheme";

const confirm = useConfirm();

const staticMenuItems = [
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
];

const themeToggleItem = computed(() => ({
    label: isDarkMode.value ? "โหมดกลางวัน" : "โหมดกลางคืน",
    is_button: true,
    icon: isDarkMode.value ? "pi pi-sun" : "pi pi-moon",
    command: () => toggleDarkMode(),
}));

const logoutItem = {
    label: "ออกจากระบบ",
    is_button: true,
    icon: "pi pi-sign-out",
    command: () => logout(),
};

const pages = computed(() => [
    {
        label: "เมนู",
        items: staticMenuItems,
    },
    {
        label: "จัดการ",
        items: [themeToggleItem.value, logoutItem],
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
</script>

<template>
    <div class="p-6 pr-0">
        <Menu
            class="!border-transparent !h-full !overflow-y-auto"
            :model="pages"
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

                <button v-else v-bind="props.action">
                    <span :class="item.icon" />
                    <span class="ml-2">
                        {{ item.label }}
                    </span>
                </button>
            </template>
        </Menu>
    </div>
</template>
