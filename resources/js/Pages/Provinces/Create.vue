<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Card from "primevue/card";
import { Link, useForm } from "@inertiajs/vue3";
import Button from "primevue/button";
import ButtonGroup from "primevue/buttongroup";
import InputText from "primevue/inputtext";
import InputNumber from "primevue/inputnumber";
import Message from "primevue/message";
import { Select } from "primevue";
import { ref } from "vue";

const form = useForm({
    name_th: "",
    name_en: "",
    region: "",
    latitude: "",
    longitude: "",
});

const regions = ref([
    { label: "ภาคเหนือ", value: "north" },
    { label: "ภาคตะวันออกเฉียงเหนือ", value: "northeast" },
    { label: "ภาคกลาง", value: "central" },
    { label: "ภาคตะวันออก", value: "east" },
    { label: "ภาคตะวันตก", value: "west" },
    { label: "ภาคใต้", value: "south" },
]);

const submit = () => {
    form.post(route("provinces.store"));
};
</script>

<template>
    <AppLayout title="เพิ่มจังหวัด">
        <Card>
            <template #content>
                <div class="mb-6 flex items-center gap-3">
                    <Link :href="route('provinces.index')">
                        <Button severity="secondary">
                            <i class="pi pi-arrow-left"></i>
                            ย้อนกลับ
                        </Button>
                    </Link>
                    <h1 class="text-3xl font-semibold">เพิ่มจังหวัด</h1>
                </div>

                <form @submit.prevent="submit" class="grid grid-cols-2 gap-6">
                    <div class="flex flex-col gap-1.5">
                        <label for="name_th">
                            ชื่อจังหวัดภาษาไทย
                            <span class="text-red-500">*</span>
                        </label>
                        <InputText
                            id="name_th"
                            v-model="form.name_th"
                            name="name_th"
                            fluid
                            placeholder="เช่น กรุงเทพมหานคร"
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
                            ชื่อจังหวัดภาษาอังกฤษ
                            <span class="text-red-500">*</span>
                        </label>
                        <InputText
                            id="name_en"
                            v-model="form.name_en"
                            name="name_en"
                            fluid
                            placeholder="เช่น Bangkok"
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
                        <label for="region">
                            เลือกภูมิภาค
                            <span class="text-red-500">*</span>
                        </label>
                        <Select
                            id="region"
                            v-model="form.region"
                            name="region"
                            :options="regions"
                            optionLabel="label"
                            optionValue="value"
                        />
                        <Message
                            v-if="form.errors.region"
                            severity="error"
                            size="small"
                            variant="simple"
                        >
                            {{ form.errors.region }}
                        </Message>
                    </div>

                    <div class="col-span-2 grid grid-cols-2 gap-6">
                        <div class="flex flex-col gap-1.5">
                            <label for="latitude">ละติจูด</label>
                            <InputNumber
                                id="latitude"
                                v-model="form.latitude"
                                name="latitude"
                                fluid
                                placeholder="8.0858"
                            />
                            <Message
                                v-if="form.errors.latitude"
                                severity="error"
                                size="small"
                                variant="simple"
                            >
                                {{ form.errors.latitude }}
                            </Message>
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <label for="longitude">ลองติจูด</label>
                            <InputNumber
                                id="longitude"
                                v-model="form.longitude"
                                name="longitude"
                                fluid
                                placeholder="98.9174"
                            />
                            <Message
                                v-if="form.errors.longitude"
                                severity="error"
                                size="small"
                                variant="simple"
                            >
                                {{ form.errors.longitude }}
                            </Message>
                        </div>
                    </div>

                    <div class="col-span-2 flex justify-end">
                        <ButtonGroup>
                            <Button
                                @click="form.reset()"
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
