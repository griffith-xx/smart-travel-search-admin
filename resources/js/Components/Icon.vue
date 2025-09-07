<script setup>
defineProps({
    name: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <i :class="name" class="pi"></i>
</template>
