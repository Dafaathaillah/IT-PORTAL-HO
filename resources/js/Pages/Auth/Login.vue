<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";
import axios from "axios";
import Cookies from "js-cookie";

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = ref({
    nrp: "23002073",
    password: "23002073",
    // remember: false,
});

// const submit = () => {
//     form.post(route('login'), {
//         onFinish: () => form.reset('password'),
//     });
// };

const message = ref("");
const messageClass = ref("");

function getCookieValue(name) {
    const cookies = document.cookie.split(";");
    for (let cookie of cookies) {
        const [key, value] = cookie.split("=").map((c) => c.trim());
        if (key === name) {
            return decodeURIComponent(value);
        }
    }
    return null;
}

const accessToken = ref(null);

// Fungsi untuk mendapatkan token dari cookie
const fetchAccessToken = () => {
    accessToken.value = getCookieValue("access_token"); // Ganti 'access_token' dengan nama cookie Anda
};

// Panggil fungsi saat komponen di-mount
fetchAccessToken();

const submit = async () => {
    try {
        message.value = "";
        messageClass.value = "";

        const response = await axios.post(
            "https://apikong.transformore.net/ict/auth/v1/auth",
            form.value
        );

        if (response.status === 200) {
            message.value = "Login successful!";
            messageClass.value = "text-green-500";
            // form.get(route('jwt.page'));
            // if (token) {
            //     const payload = token.split(".")[1]; // Ambil bagian payload
            //     const decodedPayload = JSON.parse(atob(payload)); // Decode base64 dan parse JSON
            //     console.log(decodedPayload);
            // }
            console.log(accessToken.value);
            console.log(response);
        }
    } catch (error) {
        if (error.response) {
            if (response.status === 400) {
                message.value = "Incorrect password.";
                messageClass.value = "text-red-500";
            } else if (response.status === 500) {
                message.value = "User not found.";
                messageClass.value = "text-red-500";
            }
        } else {
            // Handle network errors
            console.error("Error:", error);
            message.value = "Failed to connect to the server.";
            messageClass.value = "text-red-500";
        }
    }
};

// const submit = async () => {
//     try {
//         message.value = "";
//         messageClass.value = "";
//         const response = await fetch(
//             "https://apikong.transformore.net/ict/auth/v1/api",
//             {
//                 method: "POST",
//                 headers: {
//                     "Content-Type": "application/json",
//                 },
//                 body: JSON.stringify(form.value),
//             }
//         );

//         if (response.status === 200) {
//             message.value = "Login successful!";
//             messageClass.value = "text-green-500";
//             // Redirect or handle successful login
//         } else if (response.status === 400) {
//             message.value = "Incorrect password.";
//             messageClass.value = "text-red-500";
//         } else if (response.status === 500) {
//             message.value = "User not found.";
//             messageClass.value = "text-red-500";
//         }
//     } catch (error) {
//         console.error("Error:", error);
//         message.value = "Failed to connect to the server.";
//         messageClass.value = "text-red-500";
//     }
// };
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />

        <div v-if="status" class="font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <div
            class="flex flex-col w-full max-w-full px-3 mx-auto lg:mx-0 shrink-0 md:flex-0 md:w-7/12 lg:w-5/12 xl:w-4/12"
        >
            <div
                class="relative flex flex-col min-w-0 break-words bg-transparent border-0 shadow-none lg:py4 dark:bg-gray-950 rounded-2xl bg-clip-border"
            >
                <div class="p-6 pb-0 mb-0">
                    <h4 class="font-bold">Sign In</h4>
                    <p class="mb-0">
                        Enter your username and password to sign in
                    </p>
                </div>
                <div class="flex-auto p-6">
                    <form @submit.prevent="submit">
                        <div class="mb-4">
                            <InputLabel for="nrp" value="NRP" />

                            <TextInput
                                id="nrp"
                                type="nrp"
                                class="mt-1 block w-full"
                                v-model="form.nrp"
                                required
                                autofocus
                                autocomplete="username"
                                placeholder="nrp"
                            />

                            <!-- <InputError
                                class="mt-2"
                                :message="form.errors.nrp"
                            /> -->
                        </div>

                        <div class="mb-4">
                            <InputLabel for="password" value="Password" />

                            <TextInput
                                id="password"
                                type="password"
                                class="mt-1 block w-full"
                                v-model="form.password"
                                required
                                autocomplete="current-password"
                                placeholder="password"
                            />

                            <!-- <InputError
                                class="mt-2"
                                :message="form.errors.password"
                            /> -->

                            <p
                                v-if="message"
                                :class="messageClass"
                                class="mt-4 text-center"
                            >
                                {{ message }}
                            </p>
                        </div>

                        <div
                            class="flex justify-between items-center pl-12 mb-0.5 text-left min-h-6"
                        >
                            <label class="flex items-center">
                                <Checkbox
                                    name="remember"
                                    class="mt-0.5 rounded-10 duration-250 ease-in-out after:rounded-circle after:shadow-2xl after:duration-250 checked:after:translate-x-5.3 h-5 relative float-left -ml-12 w-10 cursor-pointer appearance-none border border-solid border-gray-200 bg-zinc-700/10 bg-none bg-contain bg-left bg-no-repeat align-top transition-all after:absolute after:top-px after:h-4 after:w-4 after:translate-x-px after:bg-white after:content-[''] checked:border-blue-500/95 checked:bg-blue-500/95 checked:bg-none checked:bg-right"
                                    v-model:checked="form.remember"
                                />
                                <span class="ms-2 text-sm text-gray-600"
                                    >Remember me</span
                                >
                            </label>

                            <div>
                                <Link
                                    v-if="canResetPassword"
                                    :href="route('password.request')"
                                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                >
                                    Forgot your password?
                                </Link>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <PrimaryButton
                                class="mt-4"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                            >
                                Log in
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
