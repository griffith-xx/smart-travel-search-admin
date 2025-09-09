<script setup>
import { Head, useForm } from "@inertiajs/vue3";

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: "",
    password: "",
    remember: true,
});

const submit = () => {
    form.transform((data) => ({
        ...data,
        remember: form.remember ? "on" : "",
    })).post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};
</script>

<template>
    <Head title="เข้าสู่ระบบ" />

    <div class="min-h-screen flex justify-center items-center">
        <form class="max-w-lg w-full" @submit.prevent="submit">
            <div class="flex flex-col gap-1 mb-3">
                <label for="email">อีเมล:</label>
                <input type="email" id="email" v-model="form.email" required />
                <span v-if="form.errors.email" class="text-red-500">
                    {{ form.errors.email }}
                </span>
            </div>

            <div class="flex flex-col gap-1 mb-1.5">
                <label for="password">รหัสผ่าน:</label>
                <input
                    type="password"
                    id="password"
                    v-model="form.password"
                    required
                />
            </div>

            <div class="mb-5">
                <input
                    class="mr-1"
                    type="checkbox"
                    id="remember"
                    v-model="form.remember"
                />
                <label for="remember">จดจำฉัน</label>
            </div>

            <div>
                <button
                    class="bg-gray-200 px-3 py-1.5 border border-gray-400 w-full"
                    type="submit"
                >
                    เข้าสู่ระบบ
                </button>
            </div>
        </form>
    </div>
</template>
