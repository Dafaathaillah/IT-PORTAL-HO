<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import NavLinkCustom from "@/Components/NavLinkCustom.vue";
import moment from "moment";
import Swal from "sweetalert2";
import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { onMounted } from "vue";

// Fungsi untuk format tanggal
function formattedDate(date) {
    return moment(date).format("MMMM Do, YYYY HH:mm"); // Sesuaikan format sesuai kebutuhan
}

const mount = onMounted(() => {
    // Inisialisasi DataTable tanpa AJAX
    $("#tableData").DataTable();
});

const props = defineProps({
    inspeksiLaptopx: {
        type: Array,
    },
});

const form = useForm({});

const editData = (id) => {
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
            form.get(route("inspeksiLaptop.edit", { id: id }));
        }
    });
};

const getBadgeClassStatusInspeksi = (status) => {
    return status === "Y"
        ? "bg-gradient-to-tl from-emerald-500 to-teal-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white"
        : "bg-gradient-to-tl from-red-500 to-orange-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white";
};

const getBadgeTextStatusInspeksi = (status) => {
    return status === "Y" ? "INSPECTED" : "NOT INSPECTED YET";
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
    } else if (status === "READY_STANDBY") {
        return "READY_STANDBY";
    } else if (status === "SCRAP") {
        return "SCRAP";
    } else if (status === "BREAKDOWN") {
        return "BREAKDOWN";
    }
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

const detailData = (id) => {
    form.get(route("inspeksiLaptop.detail", { id: id }));
};

const processData = (id) => {
    form.get(route("inspeksiLaptop.process", { id: id }));
};


function formatData(text) {
    const maxLength = 20; // Set your limit here
    return text.length > maxLength ? text.slice(0, maxLength) + "..." : text;
}
</script>

<template>
    <Head title="Inspeksi Laptop" />

    <AuthenticatedLayout>
        <template #header>
            <nav>
                <!-- breadcrumb -->
                <ol
                    class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16"
                >
                    <li class="text-sm leading-normal">
                        <a class="text-white opacity-50" href="javascript:;"
                            >Pages</a
                        >
                    </li>
                    <li
                        class="text-sm pl-2 capitalize leading-normal text-white before:float-left before:pr-2 before:text-white before:content-['/']"
                        aria-current="page"
                    >
                        Inspeksi Laptop Pages
                    </li>
                </ol>
                <h6 class="mb-0 font-bold text-white capitalize">
                    Inspeksi Laptop Data
                </h6>
            </nav>
        </template>

        <div class="py-12">
            <div class="min-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex flex-wrap -mx-3">

                    <div class="flex-none w-full max-w-full px-3">
                        <div
                            class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border"
                        >
                            
                            <div class="flex-auto px-0 pt-0 pb-2">
                                <div class="p-0 overflow-x-auto">
                                    <div class="p-6 text-gray-900">
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
                                                        Laptop Status
                                                    </th>
                                                    <th
                                                        class="px-6 py-3 font-bold text-center uppercase align-middle mb-0 text-sm leading-tight dark:text-white dark:opacity-80"
                                                    >
                                                        Laptop Condition
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
                                                        inspeksiLaptops, index
                                                    ) in inspeksiLaptopx"
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
                                                                inspeksiLaptops.inventory.laptop_code
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
                                                                inspeksiLaptops.inventory.pengguna.username
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
                                                                inspeksiLaptops.inventory.pengguna.department
                                                            }}
                                                            
                                                        </p>
                                                    </td>
                                                    
                                                    
                                                    <td
                                                        class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent"
                                                    >
                                                        <span
                                                            :class="
                                                                getBadgeClassStatusFindings(
                                                                    inspeksiLaptops.findings
                                                                )
                                                            "
                                                        >
                                                            {{
                                                                getBadgeTextStatusFindings(
                                                                    inspeksiLaptops.findings
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
                                                                inspeksiLaptops.inspection_at == null ? '-' : formattedDate(
                                                                    inspeksiLaptops.inspection_at
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
                                                                    inspeksiLaptops.inspection_status
                                                                )
                                                            "
                                                        >
                                                            {{
                                                                getBadgeTextStatusInspeksi(
                                                                    inspeksiLaptops.inspection_status
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
                                                                    inspeksiLaptops.inventory_status
                                                                )
                                                            "
                                                        >
                                                            {{
                                                                getBadgeTextStatusInventory(
                                                                    inspeksiLaptops.inventory_status
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
                                                                inspeksiLaptops.condition
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
                                                                inspeksiLaptops.remarks
                                                            }}
                                                        </span>
                                                    </td>
                                                    
                                                    <td
                                                        class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent"
                                                    >
                                                        <span
                                                            class="mb-0 text-sm font-semibold leading-tight dark:text-white dark:opacity-80"
                                                        >
                                                            {{ inspeksiLaptops.status_approval }}
                                                        </span>
                                                    </td>
                                                    
                                                    <td
                                                        class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent"
                                                    >

                                                        <NavLinkCustom
                                                            @click="
                                                                processData(
                                                                    inspeksiLaptops.id
                                                                )
                                                            "
                                                            v-if="inspeksiLaptops.inspection_status === 'N'"
                                                            class="mb-0 text-sm font-semibold leading-tight dark:text-white dark:opacity-80"
                                                        >
                                                        Do Inspection
                                                        </NavLinkCustom>

                                                        <NavLinkCustom
                                                            @click="
                                                                detailData(
                                                                    inspeksiLaptops.id
                                                                )
                                                            "
                                                            v-if="inspeksiLaptops.inspection_status === 'Y'"
                                                            class="ml-3 mb-0 text-sm font-semibold leading-tight dark:text-white dark:opacity-80"
                                                        >
                                                            Detail
                                                        </NavLinkCustom>

                                                        <NavLinkCustom
                                                            @click="
                                                                editData(
                                                                    inspeksiLaptops.id
                                                                )
                                                            "
                                                            v-if="inspeksiLaptops.inspection_status === 'Y'"
                                                            class="ml-3 mr-3 mb-0 text-sm font-semibold leading-tight dark:text-white dark:opacity-80"
                                                        >
                                                            Edit
                                                        </NavLinkCustom>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
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
