<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import NavLinkCustom from "@/Components/NavLinkCustom.vue";
import moment from "moment";
import Swal from "sweetalert2";
import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { onMounted } from "vue";
import { PerfectScrollbar } from 'vue3-perfect-scrollbar';

const pages = ref("Pages");
const subMenu = ref("Inspeksi Komputer Pages");
const mainMenu = ref("Inspeksi Komputer Data");

// Fungsi untuk format tanggal
function formattedDate(date) {
    return moment(date).format("MMMM Do, YYYY HH:mm"); // Sesuaikan format sesuai kebutuhan
}

const mount = onMounted(() => {
    // Inisialisasi DataTable tanpa AJAX
    $("#tableData").DataTable({
        buttons: ["copy", "csv", "excel", "pdf", "print"],
    });
});

const props = defineProps({
    computer: {
        type: Array,
    },
});

const form = useForm({});

const editData = (id) => {
    form.get(route("inspeksiKomputerBa.inspection", { id: id }));
};

const editDataInspeksi = (id) => {
    // Call SweetAlert for confirmation
    Swal.fire({
        title: "Are you sure?",
        text: "You want edit this data?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes!",
    }).then((result) => {
        if (result.isConfirmed) {
            form.get(route("inspeksiKomputerBa.edit", { id: id }));
        }
    });
};

const detailData = (id) => {
    form.get(route("inspeksiKomputerBa.detail", { id: id }));
};

const file = ref(null);

const handleFileUpload = (event) => {
    file.value = event.target.files[0];
};

const getBadgeClassStatusInspeksi = (status) => {
    return status === "Y"
        ? "bg-gradient-to-tl from-emerald-500 to-teal-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white"
        : "bg-gradient-to-tl from-red-500 to-orange-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white";
};

const getBadgeTextStatusInspeksi = (status) => {
    return status === "Y" ? "INSPECTED" : "NOT INSPECTED YET";
};

const getBadgeClassStatusFindings = (temuan) => {
    if (temuan === "" || temuan === null) {
        return "bg-gradient-to-tl from-cyan-500 to-sky-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white";
    }else {
        return "bg-gradient-to-tl from-red-500 to-orange-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white"; // Default untuk status yang tidak dikenal
    }
};

const getBadgeTextStatusFindings = (temuan) => {
    if (temuan === "" || temuan === null) {
        return "Tidak ada temuan";
    }else {
        return temuan; // Default teks untuk status yang tidak dikenal
    }
};

const getBadgeClassStatusInventory = (status) => {
    if (status === "READY_USED") {
        return "bg-gradient-to-tl from-emerald-500 to-teal-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white";
    } else if (status === "READY_STANBY") {
        return "bg-gradient-to-tl from-yellow-500 to-yellow-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white";
    } else if (status === "SCRAP") {
        return "bg-gradient-to-tl from-red-500 to-orange-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white";
    } else if (status === "BREAKDOWN") {
        return "bg-gradient-to-tl from-rose-500 to-rose-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white";
    }
};

const getBadgeTextStatusInventory = (status) => {
    if (status === "READY_USED") {
        return "READY_USED";
    } else if (status === "READY_STANBY") {
        return "READY_STANBY";
    } else if (status === "SCRAP") {
        return "SCRAP";
    } else if (status === "BREAKDOWN") {
        return "BREAKDOWN";
    }
};
</script>

<template>
    <Head title="Inspeksi Komputer" />

    <AuthenticatedLayout
            v-model:pages="pages"
        v-model:subMenu="subMenu"
        v-model:mainMenu="mainMenu"
        >

        <div class="py-12">
            <div class="min-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex flex-wrap -mx-3">
                    <div class="flex-none w-full max-w-full px-3">
                        <div
                            class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border"
                        >
                            <div class="flex-auto px-0 pt-0 pb-2">
                                <PerfectScrollbar style="position: relative;">
                                    <div class="p-0">
                                        <div class="p-6 text-gray-900">
                                            <div
                                                v-if="$page.props.flash.message"
                                                class="relative w-full p-4 mb-4 text-white border border-solid rounded-lg bg-gradient-to-tl from-emerald-500 to-teal-400 border-emerald-300"
                                            >
                                                {{ $page.props.flash.message }}
                                            </div>
                                            <table
                                                id="tableData"
                                                class="table table-striped"
                                            >
                                                <thead class="align-bottom">
                                                    <tr>
                                                        <th
                                                            class="px-6 py-3 font-bold text-center uppercase align-middle mb-0 text-sm leading-tight dark:text-white dark:opacity-80"
                                                        >
                                                            #
                                                        </th>
                                                        <th
                                                            class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle mb-0 text-sm leading-tight dark:text-white dark:opacity-80"
                                                        >
                                                            Inventory Number
                                                        </th>
                                                        
                                                        <th
                                                            class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle mb-0 text-sm leading-tight dark:text-white dark:opacity-80"
                                                        >
                                                            User
                                                        </th>
                                                        <th
                                                            class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle mb-0 text-sm leading-tight dark:text-white dark:opacity-80"
                                                        >
                                                            Department
                                                        </th>
                                                        
                                                        <th
                                                            class="px-6 py-3 font-bold text-center uppercase align-middle mb-0 text-sm leading-tight dark:text-white dark:opacity-80"
                                                        >
                                                            Temuan
                                                        </th>
                                                        <th
                                                            class="px-6 py-3 font-bold text-center uppercase align-middle mb-0 text-sm leading-tight dark:text-white dark:opacity-80"
                                                        >
                                                            Inspection date
                                                        </th>
                                                        <th
                                                            class="px-6 py-3 font-bold text-center uppercase align-middle mb-0 text-sm leading-tight dark:text-white dark:opacity-80"
                                                        >
                                                            Inspection Status
                                                        </th>
                                                        <th
                                                            class="px-6 py-3 font-bold text-center uppercase align-middle mb-0 text-sm leading-tight dark:text-white dark:opacity-80"
                                                        >
                                                            Komp Status
                                                        </th>
                                                        <th
                                                            class="px-6 py-3 font-bold text-center uppercase align-middle mb-0 text-sm leading-tight dark:text-white dark:opacity-80"
                                                        >
                                                            Komp Condition
                                                        </th>
                                                        <th
                                                            class="px-6 py-3 font-bold text-center uppercase align-middle mb-0 text-sm leading-tight dark:text-white dark:opacity-80"
                                                        >
                                                            Remark
                                                        </th>
                                                        <th
                                                            class="px-6 py-3 font-bold text-center uppercase align-middle mb-0 text-sm leading-tight dark:text-white dark:opacity-80"
                                                        >
                                                            Approval Status
                                                        </th>
                                                        <th
                                                            class="px-6 py-3 font-bold text-center uppercase align-middle mb-0 text-sm leading-tight dark:text-white dark:opacity-80"
                                                        >
                                                            Action
                                                        </th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr
                                                        v-for="(
                                                            computers, index
                                                        ) in computer"
                                                        :key="index"
                                                    >
                                                    <td
                                                            class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent"
                                                        >
                                                            <span
                                                                class="mb-0 text-sm font-semibold leading-tight dark:text-white dark:opacity-80"
                                                            >
                                                                {{ index + 1 }}
                                                            </span>
                                                        </td>
                                                        <td
                                                            class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent"
                                                        >
                                                            <p
                                                                class="mb-0 text-sm font-semibold leading-tight dark:text-white dark:opacity-80"
                                                            >
                                                                {{
                                                                    computers.computer.computer_code
                                                                }}
                                                            </p>
                                                        </td>
                                                        
                                                        <td
                                                            class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent"
                                                        >
                                                            <p
                                                                class="mb-0 text-sm font-semibold leading-tight dark:text-white dark:opacity-80"
                                                            >
                                                                {{
                                                                    computers.computer.pengguna.username
                                                                }}
                                                            </p>
                                                        </td>
                                                        <td
                                                            class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent"
                                                        >
                                                            <p
                                                                class="mb-0 text-sm font-semibold leading-tight dark:text-white dark:opacity-80"
                                                            >

                                                                {{
                                                                    computers.computer.pengguna.department
                                                                }}
                                                                
                                                            </p>
                                                        </td>
                                                        
                                                        
                                                        <td
                                                            class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent"
                                                        >
                                                            <span
                                                                :class="
                                                                    getBadgeClassStatusFindings(
                                                                        computers.findings
                                                                    )
                                                                "
                                                            >
                                                                {{
                                                                    getBadgeTextStatusFindings(
                                                                        computers.findings
                                                                    )
                                                                }}
                                                            </span>
                                                        </td>
                                                        <td
                                                            class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent"
                                                        >
                                                            <span
                                                                class="mb-0 text-sm font-semibold leading-tight dark:text-white dark:opacity-80"
                                                            >
                                                                {{ 
                                                                    computers.updated_at == null ? '-' : formattedDate(
                                                                        computers.updated_at
                                                                    )
                                                                }}
                                                            </span>
                                                        </td>
                                                        <td
                                                            class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent"
                                                        >
                                                            <span
                                                                :class="
                                                                    getBadgeClassStatusInspeksi(
                                                                        computers.inspection_status
                                                                    )
                                                                "
                                                            >
                                                                {{
                                                                    getBadgeTextStatusInspeksi(
                                                                        computers.inspection_status
                                                                    )
                                                                }}
                                                            </span>
                                                        </td>
                                                        <td
                                                            class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent"
                                                        >
                                                            <span
                                                                :class="
                                                                    getBadgeClassStatusInventory(
                                                                        computers.inventory_status
                                                                    )
                                                                "
                                                            >
                                                                {{
                                                                    getBadgeTextStatusInventory(
                                                                        computers.inventory_status
                                                                    )
                                                                }}
                                                            </span>
                                                        </td>
                                                        <td
                                                            class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent"
                                                        >
                                                            <span
                                                                class="mb-0 text-sm font-semibold leading-tight dark:text-white dark:opacity-80"
                                                            >
                                                                {{
                                                                    computers.conditions
                                                                }}
                                                            </span>
                                                        </td>
                                                        <td
                                                            class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent"
                                                        >
                                                            <span
                                                                class="mb-0 text-sm font-semibold leading-tight dark:text-white dark:opacity-80"
                                                            >
                                                                {{
                                                                    computers.remarks
                                                                }}
                                                            </span>
                                                        </td>
                                                        
                                                        <td
                                                            class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent"
                                                        >
                                                            <span
                                                                class="mb-0 text-sm font-semibold leading-tight dark:text-white dark:opacity-80"
                                                            >
                                                                {{ computers.status_approval }}
                                                            </span>
                                                        </td>
                                                        <td
                                                            class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent"
                                                        >
                                                            <NavLinkCustom
                                                            v-if="computers.inspection_status === 'N'"
                                                                @click="
                                                                    editData(
                                                                        computers.id
                                                                    )
                                                                "
                                                                class="mb-0 text-sm font-semibold leading-tight dark:text-white dark:opacity-80"
                                                            >
                                                                Do Inspection
                                                            </NavLinkCustom>

                                                            <NavLinkCustom
                                                                @click="
                                                                    editDataInspeksi(
                                                                        computers.id
                                                                    )
                                                                "
                                                                v-if="computers.inspection_status === 'Y'"
                                                                class="mb-0 text-sm font-semibold leading-tight dark:text-white dark:opacity-80"
                                                            >
                                                                Edit
                                                            </NavLinkCustom>
                                                            

                                                            <NavLinkCustom
                                                            v-if="computers.inspection_status === 'Y'"
                                                                @click="
                                                                    detailData(
                                                                        computers.id
                                                                    )
                                                                "
                                                                class="ml-3 mb-0 text-sm font-semibold leading-tight dark:text-white dark:opacity-80"
                                                            >
                                                                Detail
                                                            </NavLinkCustom>

                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </PerfectScrollbar>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<style>
@import '/public/assets/css/perfect-scrollbar.css';

</style>
