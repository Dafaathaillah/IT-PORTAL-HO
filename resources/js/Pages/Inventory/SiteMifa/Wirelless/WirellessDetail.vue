<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import NavLinkCustom from "@/Components/NavLinkCustom.vue";
import { Head, Link } from "@inertiajs/vue3";
import moment from "moment";
import { onMounted, ref } from "vue";

const pages = ref("Pages");
const subMenu = ref("Wirelless Pages");
const mainMenu = ref("Detail Wirelless");

const props = defineProps({
    wirelless: {
        type: Array,
    },
});

// Fungsi untuk format tanggal
function formattedDate(date) {
    return moment(date).format("MMMM Do, YYYY"); // Sesuaikan format sesuai kebutuhan
}
</script>

<template>
    <Head title="Inv Wirelless" />

    <AuthenticatedLayout
        v-model:pages="pages"
        v-model:subMenu="subMenu"
        v-model:mainMenu="mainMenu"
    >
        <div class="py-12">
            <div class="min-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex flex-wrap -mx-3">
                    <div class="w-full max-w-full px-3 mt-6">
                        <div
                            class="w-full max-w-full px-3 mt-6 md:w-12/12 md:flex-none"
                        >
                            <div
                                class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border"
                            >
                                <div
                                    class="flex flex-row p-6 px-4 pb-0 mb-0 border-b-0 rounded-t-2xl"
                                >
                                    <h6 class="mb-4 mr-3 dark:text-white">
                                        Detail Wirelless
                                    </h6>
                                    <NavLinkCustom
                                        class="text-red-700"
                                        :href="route('wirellessMifa.page')"
                                    >
                                        Move to home page
                                    </NavLinkCustom>
                                </div>
                                <div
                                    class="p-6 px-4 pb-0 grid grid-cols-1 gap-4 md:grid-cols-2"
                                >
                                    <div class="grid grid-cols-2">
                                        <div>
                                            <p class="text-base">
                                                Asset Ho Number
                                            </p>
                                        </div>
                                        <div>
                                            <p>
                                                :
                                                {{ wirelless.asset_ho_number }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div>
                                            <p class="text-base">
                                                Iventory Number
                                            </p>
                                        </div>
                                        <div>
                                            <p>
                                                :
                                                {{ wirelless.inventory_number }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div>
                                            <p class="text-base">Mac Address</p>
                                        </div>
                                        <div>
                                            <p>: {{ wirelless.mac_address }}</p>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div>
                                            <p class="text-base">
                                                Device Brand
                                            </p>
                                        </div>
                                        <div>
                                            <p>
                                                : {{ wirelless.device_brand }}
                                            </p>
                                        </div>
                                    </div>
                                      <div class="grid grid-cols-2">
                                        <div>
                                            <p class="text-base">
                                                Inventory Date
                                            </p>
                                        </div>
                                        <div>
                                            <p>
                                                :
                                                {{
                                                    formattedDate(
                                                        wirelless.date_of_inventory
                                                    )
                                                }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div>
                                            <p class="text-base">
                                                Device Location
                                            </p>
                                        </div>
                                        <div>
                                            <p>: {{ wirelless.location }}</p>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div>
                                            <p class="text-base">Ip Address</p>
                                        </div>
                                        <div>
                                            <p>: {{ wirelless.ip_address }}</p>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2">
                                        <div>
                                            <p class="text-base">
                                                Device Model
                                            </p>
                                        </div>
                                        <div>
                                            <p>
                                                : {{ wirelless.device_model }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2">
                                        <div>
                                            <p class="text-base">
                                                Serial Number
                                            </p>
                                        </div>
                                        <div>
                                            <p>
                                                : {{ wirelless.serial_number }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2">
                                        <div>
                                            <p class="text-base">Device Type</p>
                                        </div>
                                        <div>
                                            <p>: {{ wirelless.device_type }}</p>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2">
                                        <div>
                                            <p class="text-base">Status</p>
                                        </div>
                                        <div>
                                            <p>: {{ wirelless.status }}</p>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2">
                                        <div>
                                            <p class="text-base">
                                                Last Edit At
                                            </p>
                                        </div>
                                        <div>
                                            <p>
                                                :
                                                {{
                                                    formattedDate(
                                                        wirelless.updated_at
                                                    )
                                                }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div>
                                            <p class="text-base">Note</p>
                                        </div>
                                        <div>
                                            <p>: {{ wirelless.note }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
