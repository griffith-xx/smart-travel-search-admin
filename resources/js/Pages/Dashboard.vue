<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Card from "primevue/card";
</script>

<template>
    <AppLayout title="Dashboard">
        <Card>
            <template #title>Simple Card</template>
            <template #content>
                <p class="m-0">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                    Inventore sed consequuntur error repudiandae numquam
                    deserunt quisquam repellat libero asperiores earum nam
                    nobis, culpa ratione quam perferendis esse, cupiditate neque
                    quas!
                </p>
            </template>
        </Card>
    </AppLayout>
</template>
