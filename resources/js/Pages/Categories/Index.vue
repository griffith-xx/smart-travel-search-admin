<script setup>
import { Link, router } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import Card from "primevue/card";
import Button from "primevue/button";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import { ref } from "vue";
import { FilterMatchMode } from "@primevue/core/api";
import InputText from "primevue/inputtext";
import { useConfirm } from "primevue/useconfirm";

defineProps({
    categories: {
        type: Object,
        required: true,
    },
});

const confirm = useConfirm();

const filters = ref({
    name_th: { value: null, matchMode: FilterMatchMode.CONTAINS },
    name_en: { value: null, matchMode: FilterMatchMode.CONTAINS },
});

const deleteCategory = (id) => {
    confirm.require({
        message: "คุณแน่ใจหรือไม่ว่าต้องการลบหมวดหมู่นี้?",
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
            router.delete(route("categories.destroy", { category: id }));
        },
    });
};
</script>

<template>
    <AppLayout title="หมวดหมู่">
        <Card>
            <template #content>
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-3xl font-semibold">หมวดหมู่ทั้งหมด</h1>
                    <Link :href="route('categories.create')">
                        <Button>
                            <i class="pi pi-plus-circle"></i>
                            เพิ่มหมวดหมู่
                        </Button>
                    </Link>
                </div>
                <div>
                    <DataTable
                        v-model:filters="filters"
                        :value="categories"
                        dataKey="id"
                        sortField="id"
                        :sortOrder="1"
                        stripedRows
                        showGridlines
                        responsiveLayout="scroll"
                        filterDisplay="row"
                    >
                        <Column field="id" header="#" sortable></Column>
                        <Column field="icon" header="อิโมจิ" sortable>
                            <template #body="{ data }">
                                <span class="text-3xl">
                                    {{ data.icon }}
                                </span>
                            </template>
                        </Column>
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
                            <template #body="{ data }">
                                {{ data.name_en }}
                            </template>
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
                        <Column
                            field="description"
                            header="รายละเอียด"
                            sortable
                        >
                        </Column>
                        <Column header="จัดการ">
                            <template #body="{ data }">
                                <div class="flex gap-2">
                                    <Link
                                        v-tooltip.top="'แก้ไขหมวดหมู่'"
                                        :href="
                                            route('categories.edit', {
                                                category: data.id,
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
                                        @click="deleteCategory(data.id)"
                                        v-tooltip.top="'ลบหมวดหมู่'"
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
