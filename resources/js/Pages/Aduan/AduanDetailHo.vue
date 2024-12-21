<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import NavLinkCustom from "@/Components/NavLinkCustom.vue";
import { Link } from "@inertiajs/vue3";
import moment from "moment";
import { onMounted, ref } from "vue";

const pages = ref("Pages");
const subMenu = ref("Aduan Pages");
const mainMenu = ref("Detail Aduan");

const props = defineProps(["aduan"]);

// Fungsi untuk format tanggal
function formattedDate(date) {
    return moment(date).format("MMMM Do, YYYY"); // Sesuaikan format sesuai kebutuhan
}

const mount = onMounted(() => {
    $("#tableData").DataTable();
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout
        v-model:pages="pages"
        v-model:subMenu="subMenu"
        v-model:mainMenu="mainMenu"
    >

        <div class="py-12">
            <div class="min-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex flex-wrap -mx-3">
                    <div
                        class="w-full max-w-full px-3 mt-6 md:w-12/12 md:flex-none"
                    >
                        <div
                            class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border"
                        >
                            <div
                                class="flex flex-row p-6 px-4 pb-0 mb-0 border-b-0 rounded-t-2xl"
                            >
                                <h6 class="mb-0 mr-3 dark:text-white">
                                    Detail Aduan
                                </h6>
                                <NavLinkCustom
                                    class="text-red-700"
                                    :href="route('aduan-ho.page')"
                                >
                                    Move to home page
                                </NavLinkCustom>
                            </div>
                            <div class="flex-auto p-12 pt-6">
                                <div class="flex flex-row mb-3">
                                    <div class="basis-1/2">
                                        Ticket Code
                                        <span class="ml-12">
                                            : {{ props.aduan.complaint_code }}
                                        </span>
                                    </div>
                                    <div class="basis-1/2">
                                        NRP
                                        <span class="ml-28">
                                            :
                                            {{ props.aduan.nrp }}
                                        </span>
                                    </div>
                                </div>
                                <div class="flex flex-row mb-3">
                                    <div class="basis-1/2">
                                        Category Aduan
                                        <span class="ml-4">
                                            : {{ props.aduan.category_name }}
                                        </span>
                                    </div>
                                    <div class="basis-1/2">
                                        Complaint Name
                                        <span class="ml-4.5">
                                            : {{ props.aduan.complaint_name }}
                                        </span>
                                    </div>
                                </div>
                                <div class="flex flex-row mb-3">
                                    <div class="basis-1/2">
                                        <div class="basis-1/2">
                                            Complaint Date
                                            <span class="ml-4.5">
                                                :
                                                {{
                                                    props.aduan
                                                        .date_of_complaint
                                                }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="basis-1/2">
                                        WhatsApp Number
                                        <span>
                                            : {{ props.aduan.phone_number }}
                                        </span>
                                    </div>
                                </div>
                                <div class="flex flex-row mb-3">
                                    <div class="basis-1/2">
                                        Crew
                                        <span class="ml-24">
                                            :
                                            {{ props.aduan.crew }}
                                        </span>
                                    </div>
                                    <div class="basis-1/2">
                                        Complaint Image
                                        <span class="ml-4.5">
                                            :
                                            <img
                                                :src="
                                                    props.aduan.complaint_image
                                                "
                                                alt="documentation image"
                                                class="ml-40 w-50 h-30 shadow-2xl rounded-xl"
                                            />
                                        </span>
                                    </div>
                                </div>
                                <hr
                                    class="h-px mx-0 my-4 bg-transparent border-0 opacity-25 bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent"
                                />
                                <div class="grid grid-cols-2">
                                    <div>
                                        <p class="text-base">
                                            Coplaint Position
                                        </p>
                                    </div>
                                    <div>
                                        <p>
                                            :
                                            {{ props.aduan.complaint_position }}
                                        </p>
                                    </div>
                                </div>
                                <hr
                                    class="h-px mx-0 my-4 bg-transparent border-0 opacity-25 bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent"
                                />
                                <div class="grid grid-cols-2">
                                    <div>
                                        <p class="text-base">Status</p>
                                    </div>
                                    <div>
                                        <p>: {{ props.aduan.status }}</p>
                                    </div>
                                </div>
                                <hr
                                    class="h-px mx-0 my-4 bg-transparent border-0 opacity-25 bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent"
                                />
                                <div class="grid grid-cols-2">
                                    <div>
                                        <p class="text-base">Response Time</p>
                                    </div>
                                    <div>
                                        <p>: {{ props.aduan.response_time }}</p>
                                    </div>
                                </div>
                                <hr
                                    class="h-px mx-0 my-4 bg-transparent border-0 opacity-25 bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent"
                                />
                                <div class="grid grid-cols-2">
                                    <div>
                                        <p class="text-base">Start Response</p>
                                    </div>
                                    <div>
                                        <p>
                                            : {{ props.aduan.start_response }}
                                        </p>
                                    </div>
                                </div>
                                <hr
                                    class="h-px mx-0 my-4 bg-transparent border-0 opacity-25 bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent"
                                />
                                <div class="grid grid-cols-2">
                                    <div>
                                        <p class="text-base">Start Progress</p>
                                    </div>
                                    <div>
                                        <p>
                                            : {{ props.aduan.start_progress }}
                                        </p>
                                    </div>
                                </div>
                                <hr
                                    class="h-px mx-0 my-4 bg-transparent border-0 opacity-25 bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent"
                                />
                                <div class="grid grid-cols-2">
                                    <div>
                                        <p class="text-base">End Progress</p>
                                    </div>
                                    <div>
                                        <p>: {{ props.aduan.end_progress }}</p>
                                    </div>
                                </div>
                                <hr
                                    class="h-px mx-0 my-4 bg-transparent border-0 opacity-25 bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent"
                                />
                                <div class="grid grid-cols-2">
                                    <div>
                                        <p class="text-base">
                                            Issue/Complaint Note
                                        </p>
                                    </div>
                                    <div>
                                        <p>
                                            : {{ props.aduan.complaint_note }}
                                        </p>
                                    </div>
                                </div>
                                <hr
                                    class="h-px mx-0 my-4 bg-transparent border-0 opacity-25 bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent"
                                />
                                <div class="grid grid-cols-2">
                                    <div>Action Repair</div>
                                    <div>
                                        <p>: {{ props.aduan.action_repair }}</p>
                                    </div>
                                </div>
                                <hr
                                    class="h-px mx-0 my-4 bg-transparent border-0 opacity-25 bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent"
                                />
                                <div class="grid grid-cols-2">
                                    <div>
                                        <p class="text-base">Repair Note</p>
                                    </div>
                                    <div>
                                        <p>: {{ props.aduan.repair_note }}</p>
                                    </div>
                                </div>
                                <hr
                                    class="h-px mx-0 my-4 bg-transparent border-0 opacity-25 bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
