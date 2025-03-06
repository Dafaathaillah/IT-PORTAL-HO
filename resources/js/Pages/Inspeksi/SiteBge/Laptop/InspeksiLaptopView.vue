<style>
@import "datatables.net-dt";

.dt-search {
    margin-bottom: 1em;
    float: right !important;
    text-align: center !important;
}
.dt-paging {
    margin-top: 1em;
    float: right !important;
    text-align: right !important;
}
.dt-buttons {
    margin-top: 1em;
}
</style>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm, router } from "@inertiajs/vue3";
import NavLinkCustom from "@/Components/NavLinkCustom.vue";
import moment from "moment";
import Swal from "sweetalert2";
import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { onMounted } from "vue";
import { PerfectScrollbar } from "vue3-perfect-scrollbar";

const pages = ref("Pages");
const subMenu = ref("Inspeksi Laptop Pages");
const mainMenu = ref("Inspeksi Laptop");

// Fungsi untuk format tanggal
function formattedDate(date) {
    return moment(date).format("MMMM Do, YYYY HH:mm"); // Sesuaikan format sesuai kebutuhan
}

const mount = onMounted(() => {
    // Inisialisasi DataTable tanpa AJAX
    $("#tableData").DataTable({
        dom: "fBrtilp",
        buttons: [
            {
                extend: "spacer",
                style: "bar",
                text: "Export files:",
            },
            "csvHtml5",
            "excelHtml5",
            "spacer",
        ],
        initComplete: function () {
            var btns = $(".dt-button");
            btns.addClass(
                "text-white bg-gradient-to-r from-green-600 via-green-700 to-green-900 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2"
            );
            btns.removeClass("dt-button");
        },
    });
});

const props = defineProps({
    inspeksiLaptopx: {
        type: Array,
    },
});

const form = useForm({});
const year = ref(""); // State untuk input year

const validateYear = (event) => {
    const value = event.target.value;
    if (!/^\d*$/.test(value)) {
        year.value = value.replace(/\D/g, ""); // Hapus karakter selain angka
    }
};

const getEncryptedYear = () => {
    // Ambil tahun yang dimasukkan atau gunakan tahun saat ini
    const selectedYear = year.value
        ? parseInt(year.value)
        : new Date().getFullYear();

    // Validasi tahun (tidak boleh lebih dari 2500)
    if (selectedYear > 2500) {
        Swal.fire({
            icon: "error",
            title: "Tahun Tidak Valid!",
            text: "Tahun tidak terdeteksi, silakan masukkan tahun yang benar (<=2500).",
        });
        return; // Stop eksekusi jika tahun tidak valid
    }

    // Tampilkan loading popup
    Swal.fire({
        title: "Menyiapkan PDF...",
        text: "Harap tunggu sebentar.",
        allowOutsideClick: false,
        showConfirmButton: false, // Hapus tombol "Close" agar tidak bisa ditutup manual
        didOpen: () => {
            Swal.showLoading();
        },
    });

    // Kirim permintaan ke backend untuk enkripsi tahun
    router.post(
        route("encrypt.year"),
        { year: selectedYear },
        {
            onSuccess: ({ props }) => {
                const encryptedYear = props.encryptedYear;
                if (encryptedYear) {
                    Swal.close(); // Tutup popup loading setelah selesai
                    window.open(
                        route("export.inspectionLaptop", {
                            year: encryptedYear,
                        }),
                        "_blank"
                    );
                } else {
                    Swal.fire(
                        "Terjadi Kesalahan",
                        "Gagal mengenkripsi tahun.",
                        "error"
                    );
                }
            },
            onError: () => {
                Swal.close(); // Tutup popup loading jika ada error
                Swal.fire(
                    "Gagal!",
                    "Terjadi kesalahan dalam permintaan.",
                    "error"
                );
            },
        }
    );
};

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
            form.get(route("inspeksiLaptopBge.edit", { id: id }));
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
    } else if (status === "READY_STANDBY") {
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
    } else {
        return "bg-gradient-to-tl from-red-500 to-orange-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white"; // Default untuk status yang tidak dikenal
    }
};

const getBadgeTextStatusFindings = (temuan) => {
    if (temuan === "" || temuan === null) {
        return "Tidak ada temuan";
    } else {
        return temuan; // Default teks untuk status yang tidak dikenal
    }
};

const detailData = (id) => {
    form.get(route("inspeksiLaptopBge.detail", { id: id }));
};

const processData = (id) => {
    form.get(route("inspeksiLaptopBge.process", { id: id }));
};

function formatData(text) {
    const maxLength = 20; // Set your limit here
    return text.length > maxLength ? text.slice(0, maxLength) + "..." : text;
}
</script>

<template>
    <Head title="Inspeksi Laptop" />

    <AuthenticatedLayout
        v-model:pages="pages"
        v-model:subMenu="subMenu"
        v-model:mainMenu="mainMenu"
    >
        <div class="py-12">
            <div class="min-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex flex-wrap -mx-3">
                    <div class="flex-none w-full max-w-full px-3">
                        <div class="min-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div class="flex flex-wrap md:flex-nowrap gap-4">
                                <div
                                    class="relative flex flex-wrap items-stretch w-50 transition-all rounded-lg ease mb-4"
                                >
                                    <span
                                        class="text-sm ease leading-5.6 absolute z-50 -ml-px flex h-full items-center whitespace-nowrap rounded-lg rounded-tr-none rounded-br-none border border-r-0 border-transparent bg-transparent py-2 px-2.5 text-center font-normal text-slate-500 transition-all"
                                    >
                                        <i
                                            class="fas fa-search"
                                            aria-hidden="true"
                                        ></i>
                                    </span>
                                    <input
                                        v-model="year"
                                        type="number"
                                        min="2025"
                                        max="2500"
                                        step="1"
                                        class="pl-9 text-sm focus:shadow-primary-outline ease w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow"
                                        placeholder="Masukkan Tahun"
                                        @input="validateYear"
                                    />
                                </div>
                                <button
                                    @click="getEncryptedYear"
                                    class="flex items-center text-sm justify-center gap-2 w-40 h-10 bg-gray-800 text-white font-semibold rounded-lg shadow-md transition-all duration-300 ease-in-out transform hover:bg-slate-850 hover:scale-105"
                                >
                                    <i class="fas fa-download"></i>
                                    Rekap Inspeksi
                                </button>
                            </div>
                            <div
                                class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border"
                            >
                                <div class="flex-auto px-0 pt-0 pb-2">
                                    <PerfectScrollbar
                                        style="position: relative"
                                    >
                                        <div class="p-0">
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
                                                                class="px-6 py-3 font-bold text-center uppercase align-middle mb-0 text-sm leading-tight dark:text-white dark:opacity-80"
                                                            >
                                                                Inspection
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
                                                                Inspection
                                                                Status
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
                                                                inspeksiLaptops,
                                                                index
                                                            ) in inspeksiLaptopx"
                                                            :key="index"
                                                        >
                                                            <td
                                                                class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent"
                                                            >
                                                                <span
                                                                    class="mb-0 text-sm font-semibold leading-tight dark:text-white dark:opacity-80"
                                                                >
                                                                    {{
                                                                        index +
                                                                        1
                                                                    }}
                                                                </span>
                                                            </td> <td
                                                                class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent"
                                                            >
                                                                <NavLinkCustom
                                                                    @click="
                                                                        processData(
                                                                            inspeksiLaptops.id
                                                                        )
                                                                    "
                                                                    v-if="
                                                                        inspeksiLaptops.inspection_status ===
                                                                        'N'
                                                                    "
                                                                    class="mb-0 text-sm font-semibold leading-tight dark:text-white dark:opacity-80"
                                                                >
                                                                    Do
                                                                    Inspection
                                                                </NavLinkCustom>
                                                            </td>
                                                            <td
                                                                class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent"
                                                            >
                                                                <p
                                                                    class="mb-0 text-sm font-semibold leading-tight dark:text-white dark:opacity-80"
                                                                >
                                                                    {{
                                                                        inspeksiLaptops
                                                                            .inventory
                                                                            .laptop_code
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
                                                                        inspeksiLaptops
                                                                            .inventory
                                                                            .pengguna
                                                                            .username
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
                                                                        inspeksiLaptops
                                                                            .inventory
                                                                            .pengguna
                                                                            .department
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
                                                                        inspeksiLaptops.inspection_at ==
                                                                        null
                                                                            ? "-"
                                                                            : formattedDate(
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
                                                                    {{
                                                                        inspeksiLaptops.status_approval
                                                                    }}
                                                                </span>
                                                            </td>

                                                            <td
                                                                class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent"
                                                            >

                                                                <NavLinkCustom
                                                                    @click="
                                                                        detailData(
                                                                            inspeksiLaptops.id
                                                                        )
                                                                    "
                                                                    v-if="
                                                                        inspeksiLaptops.inspection_status ===
                                                                        'Y'
                                                                    "
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
                                                                    v-if="
                                                                        inspeksiLaptops.inspection_status ===
                                                                        'Y'
                                                                    "
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
                                    </PerfectScrollbar>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<style>
@import "/public/assets/css/perfect-scrollbar.css";
</style>
