<script setup>
import { Head } from "@inertiajs/vue3";
import { useFlash } from "@/Composables/useFlash";
import Toast from "primevue/toast";
import ConfirmPopup from "primevue/confirmpopup";
import Sidebar from "@/Components/Sidebar.vue";

defineProps({
    title: {
        type: String,
        required: true,
    },
});

useFlash();
</script>

<template>
    <Head :title="title" />
    <Toast />
    <ConfirmPopup />
    <div class="min-h-screen max-h-screen overflow-hidden flex gap-6">
        <Sidebar />
        <div class="flex-1 max-h-screen overflow-y-auto p-6 pl-0">
            <slot />
        </div>
    </div>
</template>
