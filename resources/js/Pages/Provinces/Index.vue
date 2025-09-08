<script setup>
import { Link, router } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import Card from "primevue/card";
import Button from "primevue/button";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import Badge from "primevue/badge";
import InputText from "primevue/inputtext";
import { ref } from "vue";
import { FilterMatchMode } from "@primevue/core/api";
import Select from "primevue/select";
import { useConfirm } from "primevue/useconfirm";

defineProps({
    provinces: {
        type: Object,
        required: true,
    },
});

const confirm = useConfirm();

const getBadgeColor = (region) => {
    switch (region) {
        case "north":
            return "!bg-blue-500";
        case "northeast":
            return "!bg-yellow-500";
        case "central":
            return "!bg-green-500";
        case "east":
            return "!bg-purple-500";
        case "west":
            return "!bg-pink-500";
        case "south":
            return "!bg-red-500";
    }
};

const getBadgeText = (region) => {
    switch (region) {
        case "north":
            return "ภาคเหนือ";
        case "northeast":
            return "ภาคตะวันออกเฉียงเหนือ";
        case "central":
            return "ภาคกลาง";
        case "east":
            return "ภาคตะวันออก";
        case "west":
            return "ภาคตะวันตก";
        case "south":
            return "ภาคใต้";
    }
};

const filters = ref({
    name_th: { value: null, matchMode: FilterMatchMode.CONTAINS },
    name_en: { value: null, matchMode: FilterMatchMode.CONTAINS },
    region: { value: null, matchMode: FilterMatchMode.EQUALS },
});
const regions = [
    { label: "ภาคเหนือ", value: "north" },
    { label: "ภาคตะวันออกเฉียงเหนือ", value: "northeast" },
    { label: "ภาคกลาง", value: "central" },
    { label: "ภาคตะวันออก", value: "east" },
    { label: "ภาคตะวันตก", value: "west" },
    { label: "ภาคใต้", value: "south" },
];
const deleteprovinces = (id) => {
    confirm.require({
        message: "คุณแน่ใจหรือไม่ว่าต้องการลบจังหวัดนี้ ?",
        header: "ยืนยันการลบ",
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
            router.delete(route("provinces.destroy", { province: id }));
        },
    });
};
</script>

<template>
    <AppLayout title="จังหวัดทั้งหมด">
        <Card>
            <template #content>
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-3xl font-semibold">จังหวัดทั้งหมด</h1>
                    <Link :href="route('provinces.create')">
                        <Button>
                            <i class="pi pi-plus-circle"></i>
                            เพิ่มจังหวัด
                        </Button>
                    </Link>
                </div>
                <div>
                    <DataTable
                        v-model:filters="filters"
                        :value="provinces"
                        stripedRows
                        showGridlines
                        dataKey="id"
                        filterDisplay="row"
                        responsiveLayout="scroll"
                        sortField="id"
                        :sortOrder="1"
                    >
                        <Column field="id" header="#" sortable></Column>
                        <Column field="name_th" header="ชื่อไทย" sortable>
                            <template #body="{ data }">
                                {{ data.name_th }}
                            </template>
                            <template #filter="{ filterModel, filterCallback }">
                                <InputText
                                    v-model="filterModel.value"
                                    type="text"
                                    @input="filterCallback()"
                                    placeholder="ค้นหาชื่อไทย"
                                    class="w-full"
                                />
                            </template>
                        </Column>
                        <Column
                            field="name_en"
                            header="ชื่อภาษาอังกฤษ"
                            sortable
                        >
                            <template #filter="{ filterModel, filterCallback }">
                                <InputText
                                    v-model="filterModel.value"
                                    type="text"
                                    @input="filterCallback()"
                                    placeholder="ค้นหาชื่อภาษาอังกฤษ"
                                    class="w-full"
                                />
                            </template>
                        </Column>
                        <Column field="region" header="ภูมิภาค" sortable>
                            <template #body="{ data }">
                                <Badge
                                    :value="getBadgeText(data.region)"
                                    :class="getBadgeColor(data.region)"
                                />
                            </template>
                            <template #filter="{ filterModel, filterCallback }">
                                <Select
                                    v-model="filterModel.value"
                                    :options="regions"
                                    optionLabel="label"
                                    optionValue="value"
                                    placeholder="เลือกภูมิภาค"
                                    class="w-full"
                                    @change="filterCallback()"
                                />
                            </template>
                        </Column>
                        <Column header="จัดการ">
                            <template #body="{ data }">
                                <div class="flex gap-2">
                                    <Link
                                        v-tooltip.top="'แก้ไขจังหวัด'"
                                        :href="
                                            route('provinces.edit', {
                                                province: data.id,
                                            })
                                        "
                                    >
                                        <Button
                                            icon="pi pi-pencil"
                                            rounded
                                            severity="warn"
                                        />
                                    </Link>
                                    <Button
                                        @click="deleteprovinces(data.id)"
                                        v-tooltip.top="'ลบจังหวัด'"
                                        icon="pi pi-trash"
                                        rounded
                                        severity="danger"
                                    />
                                </div>
                            </template>
                        </Column>
                    </DataTable>
                </div>
            </template>
        </Card>
    </AppLayout>
</template>
