<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import NavLinkCustom from "@/Components/NavLinkCustom.vue";
import { Head, Link } from "@inertiajs/vue3";
import moment from "moment";
import { onMounted } from "vue";

const props = defineProps({
    printers: {
        type: Array,
    },
});

// Fungsi untuk format tanggal
function formattedDate(date) {
    return moment(date).format("MMMM Do, YYYY"); // Sesuaikan format sesuai kebutuhan
}

</script>

<template>

    <Head title="Inv Printer" />

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
                        Printer Pages
                    </li>
                </ol>
                <h6 class="mb-0 font-bold text-white capitalize">
                    Detail Printer
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
                                        Detail Printer
                                    </h6>
                                    <NavLinkCustom class="text-red-700" :href="route('printer.page')">
                                        Move to home page
                                    </NavLinkCustom>

                                </div>
                                <div class="p-6 px-4 pb-0 grid grid-cols-2 gap-4">
                                    <div class="grid grid-cols-2">
                                        <div>
                                            <p class="text-base">Asset Ho Number</p>
                                        </div>
                                        <div>
                                            <p>: {{ printers.asset_ho_number }}</p>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div>
                                            <p class="text-base">Iventory Number</p>
                                        </div>
                                        <div>
                                            <p>: {{ printers.printer_code }}</p>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div>
                                            <p class="text-base">Mac Address</p>
                                        </div>
                                        <div>
                                            <p>: {{ printers.mac_address }}</p>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div>
                                            <p class="text-base">Printer Brand</p>
                                        </div>
                                        <div>
                                            <p>: {{ printers.printer_brand }}</p>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div>
                                            <p class="text-base">Printer Location</p>
                                        </div>
                                        <div>
                                            <p>: {{ printers.location }}</p>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div>
                                            <p class="text-base">Printer Type</p>
                                        </div>
                                        <div>
                                            <p>: {{ printers.printer_type }}</p>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div>
                                            <p class="text-base">Divisi</p>
                                        </div>
                                        <div>
                                            <p>: {{ printers.division }}</p>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div>
                                            <p class="text-base">Dept</p>
                                        </div>
                                        <div>
                                            <p>: {{ printers.department }}</p>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div>
                                            <p class="text-base">Ip Address</p>
                                        </div>
                                        <div>
                                            <p>: {{ printers.ip_address }}</p>
                                        </div>
                                    </div>
                                    
                                    <div class="grid grid-cols-2">
                                        <div>
                                            <p class="text-base">Serial Number</p>
                                        </div>
                                        <div>
                                            <p>: {{ printers.serial_number }}</p>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="grid grid-cols-2">
                                        <div>
                                            <p class="text-base">Status</p>
                                        </div>
                                        <div>
                                            <p>: {{ printers.status }}</p>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2">
                                        <div>
                                            <p class="text-base">Note</p>
                                        </div>
                                        <div>
                                            <p>: {{ printers.note }}</p>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2">
                                        <div>
                                            <p class="text-base">Date Of Inventory</p>
                                        </div>
                                        <div>
                                            <p>
                                                :
                                                {{
                                                    formattedDate(printers.date_of_inventory)
                                                }}
                                            </p>
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
                                                    formattedDate(printers.updated_at)
                                                }}
                                            </p>
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
