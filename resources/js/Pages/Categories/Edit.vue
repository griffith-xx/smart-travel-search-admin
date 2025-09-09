<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Card from "primevue/card";
import { Link, useForm } from "@inertiajs/vue3";
import Button from "primevue/button";
import ButtonGroup from "primevue/buttongroup";
import InputText from "primevue/inputtext";
import Message from "primevue/message";
import Textarea from "primevue/textarea";

const props = defineProps({
    category: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    name_th: props.category.name_th,
    name_en: props.category.name_en,
    icon: props.category.icon,
    description: props.category.description,
});

const submit = () => {
    form.patch(route("categories.update", props.category.id));
};
</script>

<template>
    <AppLayout :title="'แก้ไขหมวดหมู่' + props.category.name_th">
        <Card>
            <template #content>
                <div class="mb-6 flex items-center gap-3">
                    <Link :href="route('categories.index')">
                        <Button severity="secondary">
                            <i class="pi pi-arrow-left"></i>
                            ย้อนกลับ
                        </Button>
                    </Link>
                    <h1 class="text-3xl font-semibold">
                        {{ "แก้ไขหมวดหมู่" + props.category.name_th }}
                    </h1>
                </div>

                <form @submit.prevent="submit" class="grid grid-cols-2 gap-6">
                    <div class="flex flex-col gap-1.5">
                        <label for="name_th">
                            ชื่อหมวดหมู่ภาษาไทย
                            <span class="text-red-500">*</span>
                        </label>
                        <InputText
                            id="name_th"
                            v-model="form.name_th"
                            name="name_th"
                            fluid
                            placeholder="เช่น ธรรมชาติ"
                        />
                        <Message
                            v-if="form.errors.name_th"
                            severity="error"
                            size="small"
                            variant="simple"
                        >
                            {{ form.errors.name_th }}
                        </Message>
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label for="name_en">
                            ชื่อหมวดหมู่ภาษาอังกฤษ
                            <span class="text-red-500">*</span>
                        </label>
                        <InputText
                            id="name_en"
                            v-model="form.name_en"
                            name="name_en"
                            fluid
                            placeholder="เช่น Nature"
                        />
                        <Message
                            v-if="form.errors.name_en"
                            severity="error"
                            size="small"
                            variant="simple"
                        >
                            {{ form.errors.name_en }}
                        </Message>
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label for="icon">
                            อิโมจิ
                            <span class="text-red-500">*</span>
                        </label>
                        <InputText
                            id="icon"
                            v-model="form.icon"
                            name="icon"
                            fluid
                            placeholder="เช่น 😀"
                        />
                        <Message
                            v-if="form.errors.icon"
                            severity="error"
                            size="small"
                            variant="simple"
                        >
                            {{ form.errors.icon }}
                        </Message>
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label for="description">
                            รายละเอียด
                            <span class="text-red-500">*</span>
                        </label>
                        <Textarea
                            id="description"
                            v-model="form.description"
                            name="description"
                            autoResize
                            variant="filled"
                            placeholder="สถานที่ท่องเที่ยวธรรมชาติ"
                            rows="5"
                        />
                        <Message
                            v-if="form.errors.description"
                            severity="error"
                            size="small"
                            variant="simple"
                        >
                            {{ form.errors.description }}
                        </Message>
                    </div>

                    <div class="col-span-2 flex justify-end">
                        <ButtonGroup>
                            <Button
                                @click="
                                    () => {
                                        form.reset();
                                        form.clearErrors();
                                    }
                                "
                                type="button"
                                label="ล้าง"
                                icon="pi pi-trash"
                                severity="danger"
                            />
                            <Button
                                :disabled="form.processing"
                                :loading="form.processing"
                                type="submit"
                                label="บันถึก"
                                icon="pi pi-save"
                            />
                        </ButtonGroup>
                    </div>
                </form>
            </template>
        </Card>
    </AppLayout>
</template>
