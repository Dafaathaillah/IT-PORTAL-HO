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

/* Untuk VueDatePicker */
.dp__input {
    height: 3rem; /* sama dengan h-12 */
    line-height: 3rem;
}

.multiselect {
    min-height: 3rem; /* h-12 */
}

.multiselect__tags {
    min-height: 3rem !important;
    display: flex;
    align-items: center;
}
</style>
<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import NavLinkCustom from "@/Components/NavLinkCustom.vue";
import VueDatePicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";
import moment from "moment";
import Swal from "sweetalert2";
import axios from "axios";
import { ref, onMounted, watch, nextTick } from "vue";

const pages = ref("Pages");
const subMenu = ref("Inspeksi Laptop Pages");
const mainMenu = ref("Inspeksi Laptop");

function formattedDate(date) {
    return moment(date).format("MMMM Do, YYYY HH:mm");
}

const props = defineProps({
    inspeksiLaptopx: Array,
    crew: Array,
    site: Object,
});

const startDate = ref(null);
const endDate = ref(null);
const selectedOption = ref({ name: "Computer" });
const data = ref([]);
const tableRef = ref(null);
// const renderTable = ref(false);
let dataTableInstance = null;

const customFormat = (date) => {
    if (!date) return null;
    const d = new Date(date);
    return `${d.getFullYear()}-${String(d.getMonth() + 1).padStart(
        2,
        "0"
    )}-${String(d.getDate()).padStart(2, "0")}`;
};

const initDataTable = async (tableData) => {
    await nextTick();

    if (dataTableInstance) {
        dataTableInstance.destroy();
        dataTableInstance = null;
    }

    dataTableInstance = $(tableRef.value).DataTable({
        dom: "fBrtilp",
        scrollY: "40vh",
        scrollCollapse: true,
        data: tableData.map((item, index) => [
            index + 1,
            item.due_date ?? "-",
            item.computer?.computer_code ?? "-",
            item.findings_status ?? "-",
            item.findings ?? "-",
            item.findings_image
                ? `<img src="${item.findings_image}" class="h-10 mx-auto">`
                : "-",
            item.findings_action ?? "-",
            item.action_image
                ? `<img src="${item.action_image}" class="h-10 mx-auto">`
                : "-",
            item.remarks ?? "-",
            `<a href="#">Detail</a> | <a href="#">Edit</a>`,
        ]),
        columns: [
            { title: "#" },
            { title: "Due Date" },
            { title: "No Inventory" },
            { title: "Status Temuan" },
            { title: "Temuan" },
            { title: "Foto Temuan" },
            { title: "Tindakan" },
            { title: "Foto Tindakan" },
            { title: "Remark" },
            { title: "Action" },
        ],
        buttons: [
            { extend: "spacer", style: "bar", text: "Export files:" },
            "csvHtml5",
            "excelHtml5",
            "spacer",
        ],
        initComplete: function () {
            const btns = $(".dt-button");
            btns.addClass(
                "text-white bg-green-700 hover:bg-green-800 rounded-lg text-sm px-4 py-2"
            );
            btns.removeClass("dt-button");
        },
    });
};

const fetchData = async () => {
    if (!selectedOption.value || !selectedOption.value.name) {
        data.value = [];
        return;
    }

    const start = customFormat(startDate.value);
    const end = customFormat(endDate.value);

    const params = {
        device_type: selectedOption.value.name,
        site: props.site,
    };

    if (start && end) {
        params.startDate = start;
        params.endDate = end;
    }

    try {
        const response = await axios.get("/pica-inspeksi-by-device", {
            params,
        });
        data.value = response.data;
        await initDataTable(data.value); // inisialisasi DataTable setelah data tersedia
    } catch (error) {
        console.error("Gagal mengambil data:", error);
        data.value = [];
        await initDataTable([]); // tetap render tabel kosong
    }
};


onMounted(async () => {
    await nextTick();
    initDataTable();
    fetchData();
});

// watch([selectedOption, startDate, endDate], ([newType, newStart, newEnd]) => {
//     if (newType) {
//         fetchData();
//     }
//     if (newStart && newEnd) {
//         fetchData();
//     }
// });

watch([selectedOption, startDate, endDate], ([newOption, newStart, newEnd]) => {
    if (newOption?.name && newStart && newEnd) {
        fetchData();
    }
});
</script>


<template>
    <Head title="Inspeksi Laptop" />

    <AuthenticatedLayout
        v-model:pages="pages"
        v-model:subMenu="subMenu"
        v-model:mainMenu="mainMenu"
    >
        <div class="py-12">
            <div class="flex flex-wrap -mx-3">
                <div class="flex-none w-full max-w-full px-3">
                    <div class="min-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="flex flex-wrap md:flex-nowrap gap-4">
                            <div
                                class="relative flex flex-wrap items-stretch w-48 transition-all rounded-lg ease mb-4"
                            >
                                <VueMultiselect
                                    v-model="selectedOption"
                                    :options="[
                                        { name: 'Laptop' },
                                        { name: 'Computer' },
                                    ]"
                                    :multiple="false"
                                    :close-on-select="true"
                                    placeholder="Select Device"
                                    track-by="name"
                                    label="name"
                                    class="w-full"
                                />
                            </div>
                            <div
                                class="relative flex flex-wrap items-stretch w-48 transition-all rounded-lg ease mb-4"
                            >
                                <VueDatePicker
                                    required
                                    v-model="startDate"
                                    :format="customFormat"
                                    placeholder="Start Date"
                                    :enable-time-picker="false"
                                />
                            </div>
                            <div
                                class="relative flex flex-wrap items-stretch w-48 transition-all rounded-lg ease mb-4"
                            >
                                <VueDatePicker
                                    required
                                    v-model="endDate"
                                    :format="customFormat"
                                    placeholder="End Date"
                                    :enable-time-picker="false"
                                />
                            </div>
                            <button
                                @click="getEncryptedYear"
                                class="flex items-center text-sm justify-center gap-2 w-40 h-12 bg-gray-800 text-white font-semibold rounded-lg shadow-md transition-all duration-300 ease-in-out transform hover:bg-slate-850 hover:scale-105"
                            >
                                <i class="fas fa-download"></i>
                                Rekap Inspeksi
                            </button>
                        </div>
                        <div
                            class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border"
                        >
                            <div class="flex-auto px-0 pt-0 pb-2">
                                <div class="p-0">
                                    <div class="p-6 text-gray-900">
                                        <table
                                            ref="tableRef"
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
                                                        Due Date
                                                    </th>
                                                    <th
                                                        class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle mb-0 text-sm leading-tight dark:text-white dark:opacity-80"
                                                    >
                                                        No Inventory
                                                    </th>
                                                    <th
                                                        class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle mb-0 text-sm leading-tight dark:text-white dark:opacity-80"
                                                    >
                                                        Status Temuan
                                                    </th>

                                                    <th
                                                        class="px-6 py-3 font-bold text-center uppercase align-middle mb-0 text-sm leading-tight dark:text-white dark:opacity-80"
                                                    >
                                                        Temuan
                                                    </th>
                                                    <th
                                                        class="px-6 py-3 font-bold text-center uppercase align-middle mb-0 text-sm leading-tight dark:text-white dark:opacity-80"
                                                    >
                                                        Foto Temuan
                                                    </th>
                                                    <th
                                                        class="px-6 py-3 font-bold text-center uppercase align-middle mb-0 text-sm leading-tight dark:text-white dark:opacity-80"
                                                    >
                                                        Tindakan
                                                    </th>
                                                    <th
                                                        class="px-6 py-3 font-bold text-center uppercase align-middle mb-0 text-sm leading-tight dark:text-white dark:opacity-80"
                                                    >
                                                        Foto Tindakan
                                                    </th>
                                                    <th
                                                        class="px-6 py-3 font-bold text-center uppercase align-middle mb-0 text-sm leading-tight dark:text-white dark:opacity-80"
                                                    >
                                                        Remark
                                                    </th>
                                                    <th
                                                        class="px-6 py-3 font-bold text-center uppercase align-middle mb-0 text-sm leading-tight dark:text-white dark:opacity-80"
                                                    >
                                                        Action
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- <tr
                                                    v-for="(
                                                        item, index
                                                    ) in data"
                                                    :key="item.id"
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
                                                            {{ item.due_date }}
                                                        </p>
                                                    </td>

                                                    <td
                                                        class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent"
                                                    >
                                                        <span>
                                                            {{
                                                                item.no_inventory
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
                                                                item.status_temuan
                                                            }}
                                                        </span>
                                                    </td>
                                                    <td
                                                        class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent"
                                                    >
                                                        <span>
                                                            {{ item.temuan }}
                                                        </span>
                                                    </td>
                                                    <td
                                                        class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent"
                                                    >
                                                        <span>
                                                            {{
                                                                item.foto_temuan
                                                            }}
                                                        </span>
                                                    </td>
                                                    <td
                                                        class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent"
                                                    >
                                                        <span
                                                            class="mb-0 text-sm font-semibold leading-tight dark:text-white dark:opacity-80"
                                                        >
                                                            {{ item.tindakan }}
                                                        </span>
                                                    </td>
                                                    <td
                                                        class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent"
                                                    >
                                                        <span
                                                            class="mb-0 text-sm font-semibold leading-tight dark:text-white dark:opacity-80"
                                                        >
                                                            {{
                                                                item.foto_tindakan
                                                            }}
                                                        </span>
                                                    </td>

                                                    <td
                                                        class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent"
                                                    >
                                                        <span
                                                            class="mb-0 text-sm font-semibold leading-tight dark:text-white dark:opacity-80"
                                                        >
                                                            {{ item.remark }}
                                                        </span>
                                                    </td>

                                                    <td
                                                        class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent"
                                                    >
                                                        <NavLinkCustom
                                                            class="ml-3 mb-0 text-sm font-semibold leading-tight dark:text-white dark:opacity-80"
                                                        >
                                                            Detail
                                                        </NavLinkCustom>

                                                        <NavLinkCustom
                                                            class="ml-3 mr-3 mb-0 text-sm font-semibold leading-tight dark:text-white dark:opacity-80"
                                                        >
                                                            Edit
                                                        </NavLinkCustom>
                                                    </td>
                                                </tr> -->
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
