<script setup>
import { Head } from "@inertiajs/vue3";
import { useFlash } from "@/Composables/useFlash";
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
    <slot></slot>
</template>
