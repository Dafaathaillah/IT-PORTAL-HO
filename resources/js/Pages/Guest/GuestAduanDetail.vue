p
<script setup>
import GuestLayoutCrud from "@/Layouts/GuestLayoutDashboard.vue";
import NavLinkCustom from "@/Components/NavLinkCustom.vue";
import { Head, Link } from "@inertiajs/vue3";
import moment from "moment";
import { onMounted, ref } from "vue";

const props = defineProps(["aduan"]);

// Fungsi untuk format tanggal
function formattedDate(date) {
    return moment(date).format("MMMM Do, YYYY"); // Sesuaikan format sesuai kebutuhan
}

const mount = onMounted(() => {
    $("#tableData").DataTable();
});

const userTimezone = Intl.DateTimeFormat().resolvedOptions().timeZone;

const formatTime = (utcTime) => {
    if (!utcTime) return "-";

    return new Date(utcTime + "Z")
        .toLocaleString("id-ID", {
            timeZone: userTimezone,
            year: "numeric",
            month: "2-digit",
            day: "2-digit",
            hour: "2-digit",
            minute: "2-digit",
            second: "2-digit",
            hour12: false, // Format 24 jam
        })
        .replace(/\//g, "-")
        .replace(",", "")
        .replace(/\./g, ":")
        .trim();
};

const isImage = (url) => {
    if (!url) return false;
    return url.match(/\.(jpeg|jpg|png|gif)$/i);
};
</script>

<template>
    <Head title="Complaint User" />

    <GuestLayoutCrud>
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
                        Complaint Pages
                    </li>
                </ol>
                <h6 class="mb-0 font-bold text-white capitalize">
                    Detail Complaint
                </h6>
            </nav>
        </template>
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
                                    :href="route('guestAduan.page')"
                                >
                                    Move to home page
                                </NavLinkCustom>
                            </div>
                            <div class="flex-auto p-12 pt-6 gap-4">
                                <div
                                    class="pb-4 grid grid-cols-1 md:grid-cols-2"
                                >
                                    <div class="grid grid-cols-2">
                                        <div>
                                            <p class="text-base">Nomor Tiket</p>
                                        </div>
                                        <div>
                                            <p>
                                                :
                                                {{ props.aduan.complaint_code }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div>
                                            <p class="text-base">NRP</p>
                                        </div>
                                        <div>
                                            <p>: {{ props.aduan.nrp }}</p>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div>
                                            <p class="text-base">
                                                Kategori Aduan
                                            </p>
                                        </div>
                                        <div>
                                            <p>
                                                :
                                                {{ props.aduan.category_name }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div>
                                            <p class="text-base">
                                                Nama Pengirim Aduan
                                            </p>
                                        </div>
                                        <div>
                                            <p>
                                                :
                                                {{ props.aduan.complaint_name }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div>
                                            <p class="text-base">
                                                Tanggal Aduan
                                            </p>
                                        </div>
                                        <div>
                                            <p>
                                                :
                                                {{
                                                    formatTime(
                                                        props.aduan
                                                            .date_of_complaint
                                                    )
                                                }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div>
                                            <p class="text-base">Nomor User</p>
                                        </div>
                                        <div>
                                            <p>
                                                : {{ props.aduan.phone_number }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div>
                                            <p class="text-base">Isu</p>
                                        </div>
                                        <div>
                                            <p>
                                                :
                                                {{ props.aduan.complaint_note }}
                                            </p>
                                        </div>
                                    </div>

                                    <div
                                        v-if="
                                            isImage(props.aduan.complaint_image)
                                        "
                                        class="grid grid-cols-2"
                                    >
                                        <div>
                                            <p class="text-base">
                                                Gambar Aduan User
                                            </p>
                                        </div>
                                        <div>
                                            <p
                                                v-if="
                                                    props.aduan
                                                        .complaint_image != null
                                                "
                                            >
                                                :
                                                <img
                                                    :src="
                                                        props.aduan
                                                            .complaint_image
                                                    "
                                                    alt="No Document"
                                                    class="ml-10 w-50 h-30 shadow-2xl rounded-xl"
                                                />
                                            </p>
                                            <p
                                                v-if="
                                                    props.aduan
                                                        .complaint_image == null
                                                "
                                            >
                                                : -
                                            </p>
                                        </div>
                                    </div>

                                    <div v-else class="grid grid-cols-4">
                                        <div>
                                            <p class="text-base">
                                                Gambar Aduan User
                                            </p>
                                        </div>
                                        <div>
                                            <p
                                                v-if="
                                                    props.aduan
                                                        .complaint_image != null
                                                "
                                            >
                                                <iframe
                                                    :src="
                                                        props.aduan
                                                            .complaint_image
                                                    "
                                                    width="300%"
                                                    height="300px"
                                                    class="shadow-2xl rounded-xl"
                                                ></iframe>
                                            </p>
                                            <p
                                                v-if="
                                                    props.aduan
                                                        .complaint_image == null
                                                "
                                            >
                                                : -
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <hr
                                    class="h-px mx-0 my-4 bg-transparent border-0 opacity-25 bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent"
                                />

                                <div class="grid grid-cols-2">
                                    <div>
                                        <p class="text-base">
                                            Teknisi / Petugas
                                        </p>
                                    </div>
                                    <div>
                                        <p>: {{ props.aduan.crew }}</p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2">
                                    <div>
                                        <p class="text-base">Status</p>
                                    </div>
                                    <div>
                                        <p>: {{ props.aduan.status }}</p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2">
                                    <div>
                                        <p class="text-base">Waktu Tanggapan</p>
                                    </div>
                                    <div>
                                        <p>: {{ props.aduan.response_time }}</p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2">
                                    <div>
                                        <p class="text-base">
                                            Waktu Awal Tanggapan
                                        </p>
                                    </div>
                                    <div>
                                        <p>
                                            :
                                            {{
                                                formatTime(
                                                    props.aduan.start_response
                                                )
                                            }}
                                        </p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2">
                                    <div>
                                        <p class="text-base">
                                            Waktu Awal Pengerjaan
                                        </p>
                                    </div>
                                    <div>
                                        <p>
                                            :
                                            {{
                                                formatTime(
                                                    props.aduan.start_progress
                                                )
                                            }}
                                        </p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2">
                                    <div>
                                        <p class="text-base">
                                            Waktu Selesai Pengerjaan
                                        </p>
                                    </div>
                                    <div>
                                        <p>
                                            :
                                            {{
                                                formatTime(
                                                    props.aduan.end_progress
                                                )
                                            }}
                                        </p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2">
                                    <div>
                                        <p class="text-base">
                                            Isu / Catatan Permohonan
                                        </p>
                                    </div>
                                    <div>
                                        <p>
                                            : {{ props.aduan.complaint_note }}
                                        </p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2">
                                    <div>Tindakan Perbaikan</div>
                                    <div>
                                        <p>: {{ props.aduan.action_repair }}</p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2">
                                    <div>
                                        <p class="text-base">
                                            Catatan Perbaikan
                                        </p>
                                    </div>
                                    <div>
                                        <p>: {{ props.aduan.repair_note }}</p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2">
                                    <div>
                                        <p class="text-base">
                                            Lokasi dan Detail lokasi
                                        </p>
                                    </div>
                                    <div>
                                        <p>
                                            : {{ props.aduan.location }} (
                                            {{ props.aduan.detail_location }})
                                        </p>
                                    </div>
                                </div>

                                <div
                                    v-if="props.aduan.status === 'CLOSED'"
                                    class="grid grid-cols-2 items-start"
                                >
                                    <div>
                                        <p class="text-base">
                                            Gambar Setelah Perbaikan
                                        </p>
                                    </div>

                                    <div class="flex items-start gap-2">
                                        <span>:</span>
                                        <img
                                            :src="props.aduan.repair_image"
                                            alt="Gambar Tidak Tersedia"
                                            class="w-50 h-30 shadow-2xl rounded-xl"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </GuestLayoutCrud>
</template>
