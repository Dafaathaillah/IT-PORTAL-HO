<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import NavLinkCustom from "@/Components/NavLinkCustom.vue";
import { Head, Link } from "@inertiajs/vue3";
import moment from "moment";
import { onMounted } from "vue";

const props = defineProps({
    switchs: {
        type: Array,
    },
});

// Fungsi untuk format tanggal
function formattedDate(date) {
    return moment(date).format("MMMM Do, YYYY"); // Sesuaikan format sesuai kebutuhan
}

</script>

<template>

    <Head title="Inv Switch" />

    <AuthenticatedLayout>
        <template #header>
            <nav>
                <!-- breadcrumb -->
                <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
                    <li class="text-sm leading-normal">
                        <a class="text-white opacity-50" href="javascript:;">Pages</a>
                    </li>
                    <li class="text-sm pl-2 capitalize leading-normal text-white before:float-left before:pr-2 before:text-white before:content-['/']"
                        aria-current="page">
                        Switch Pages
                    </li>
                </ol>
                <h6 class="mb-0 font-bold text-white capitalize">
                    Detail Switch
                </h6>
            </nav>
        </template>

        <div class="py-12">
            <div class="min-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex flex-wrap -mx-3">
                    <div class="w-full max-w-full px-3 mt-6">
                        <div class="w-full max-w-full px-3 mt-6 md:w-12/12 md:flex-none">
                            <div
                                class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                                
                                <div class="flex flex-row p-6 px-4 pb-0 mb-0 border-b-0 rounded-t-2xl">
                                    <h6 class="mb-4 mr-3 dark:text-white">
                                        Detail Switch
                                    </h6>
                                    <NavLinkCustom class="text-red-700" :href="route('switch.page')">
                                        Move to home page
                                    </NavLinkCustom>

                                </div>
                                <div class="p-6 px-4 pb-0 grid grid-cols-2 gap-4">
                                    <div class="grid grid-cols-2">
                                        <div>
                                            <p class="text-base">Asset Ho Number</p>
                                        </div>
                                        <div>
                                            <p>: {{ switchs.asset_ho_number }}</p>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div>
                                            <p class="text-base">Iventory Number</p>
                                        </div>
                                        <div>
                                            <p>: {{ switchs.inventory_number }}</p>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div>
                                            <p class="text-base">Mac Address</p>
                                        </div>
                                        <div>
                                            <p>: {{ switchs.mac_address }}</p>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div>
                                            <p class="text-base">Device Brand</p>
                                        </div>
                                        <div>
                                            <p>: {{ switchs.device_brand }}</p>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div>
                                            <p class="text-base">Device Location</p>
                                        </div>
                                        <div>
                                            <p>: {{ switchs.location }}</p>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div>
                                            <p class="text-base">Ip Address</p>
                                        </div>
                                        <div>
                                            <p>: {{ switchs.ip_address }}</p>
                                        </div>
                                    </div>
                                    
                                    <div class="grid grid-cols-2">
                                        <div>
                                            <p class="text-base">Device Model</p>
                                        </div>
                                        <div>
                                            <p>: {{ switchs.device_model }}</p>
                                        </div>
                                    </div>
                                    
                                    <div class="grid grid-cols-2">
                                        <div>
                                            <p class="text-base">Serial Number</p>
                                        </div>
                                        <div>
                                            <p>: {{ switchs.serial_number }}</p>
                                        </div>
                                    </div>
                                    
                                    <div class="grid grid-cols-2">
                                        <div>
                                            <p class="text-base">Device Type</p>
                                        </div>
                                        <div>
                                            <p>: {{ switchs.device_type }}</p>
                                        </div>
                                    </div>
                                    
                                    <div class="grid grid-cols-2">
                                        <div>
                                            <p class="text-base">Status</p>
                                        </div>
                                        <div>
                                            <p>: {{ switchs.status }}</p>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2">
                                        <div>
                                            <p class="text-base">Last Edit At</p>
                                        </div>
                                        <div>
                                            <p>
                                                :
                                                {{
                                                    formattedDate(switchs.updated_at)
                                                }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div>
                                            <p class="text-base">Note</p>
                                        </div>
                                        <div>
                                            <p>: {{ switchs.note }}</p>
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
