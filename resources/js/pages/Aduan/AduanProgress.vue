<style src="vue-multiselect/dist/vue-multiselect.css"></style>
<script setup>
import AuthenticatedLayoutForm from "@/Layouts/AuthenticatedLayoutForm.vue";
import { Link } from "@inertiajs/vue3";
import { Head, useForm } from "@inertiajs/vue3";
import Swal from "sweetalert2";
import VueDatePicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";
import VueMultiselect from "vue-multiselect";
import { Inertia } from "@inertiajs/inertia";
import { ref } from "vue";

const props = defineProps({
    crew: {
        type: Array,
    },
    aduan: {
        type: Array,
    },
});
const form = useForm({
    complaint_name: "",
    complaint_code: props.aduan.complaint_code,
    nrp: "",
    phone_number: "",
    inventory_number: "",
    category_name: "",
    crew: "",
    date_of_complaint: "",
    location: "",
    complaint_note: "",
    location_detail: "",
});

const isDisabled = ref(true);
const file = ref(null);

const handleFileUpload = (event) => {
    file.value = event.target.files[0];
};
const save = () => {
    const formData = new FormData();
    formData.append("image", file.value);
    formData.append("complaint_name", form.complaint_name);
    formData.append("complaint_code", form.complaint_code);
    formData.append("nrp", form.nrp);
    formData.append("phone_number", form.phone_number);
    formData.append("inventory_number", form.inventory_number);
    formData.append("category_name", form.category_name);
    formData.append("crew", form.crew);
    formData.append("date_of_complaint", form.date_of_complaint);
    formData.append("location", form.location);
    formData.append("complaint_note", form.complaint_note);
    formData.append("location_detail", form.location_detail);
    Inertia.post(route("aduan.store"), formData, {
        forceFormData: true,
        onSuccess: () => {
            // Show SweetAlert2 success notification
            Swal.fire({
                title: "Success!",
                text: "Data has been successfully updated!",
                icon: "success",
                confirmButtonText: "OK",
                confirmButtonColor: "#3085d6",
            });
        },
        onError: () => {
            Swal.fire({
                title: "error!",
                text: "Data not updated!",
                icon: "waring",
                confirmButtonText: "OK",
                confirmButtonColor: "#3085d6",
            });
        },
    });
};

function handleCategoryChange(event) {
    form.category_name = event.target.value;
}
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayoutForm>
        <template #header>
            <nav>
                <!-- breadcrumb -->
                <ol
                    class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16"
                >
                    <li class="text-sm leading-normal">
                        <a class="text-white opacity-50">Pages</a>
                    </li>
                    <Link
                        :href="route('aduan.page')"
                        class="text-sm pl-2 capitalize leading-normal text-white before:float-left before:pr-2 before:text-white before:content-['/']"
                        aria-current="page"
                    >
                        Aduan
                    </Link>
                </ol>
                <h6 class="mb-0 font-bold text-white capitalize">
                    Aduan Progress Pages
                </h6>
            </nav>
        </template>

        <div class="w-full p-6 mx-auto">
            <div class="flex flex-wrap -mx-3 justify-center">
                <div
                    class="w-full max-w-full px-3 shrink-0 md:w-8/12 md:flex-0"
                >
                    <div
                        class="relative flex flex-col min-w-0 break-words justify-self: center bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border"
                    >
                        <div
                            class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0"
                        >
                            <div class="flex items-center">
                                <p class="mb-0 font-bold dark:text-white/80">
                                    Form Progress Aduan
                                </p>
                            </div>
                        </div>
                        <div class="flex-auto p-6">
                            <form @submit.prevent="save">
                                <hr
                                    class="h-px mx-0 my-4 bg-transparent border-0 opacity-25 bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent"
                                />
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
                                        Complaint Note
                                        <span class="ml-4.5">
                                            : {{ props.aduan.complaint_note }}
                                        </span>
                                    </div>
                                    <div class="basis-1/2">
                                        WhatsApp Number
                                        <span>
                                            : 0{{ props.aduan.phone_number }}
                                        </span>
                                    </div>
                                </div>
                                <div class="flex flex-row mb-3">
                                    <div class="basis-1/2">
                                        Complaint Date
                                        <span class="ml-4.5">
                                            :
                                            {{ props.aduan.date_of_complaint }}
                                        </span>
                                    </div>
                                    <!-- <div class="basis-1/2">WhatsApp Number</div> -->
                                </div>
                                <div class="flex flex-row mb-3">
                                    <div class="basis-1/2">
                                        Crew
                                        <span class="ml-24">
                                            :
                                            {{ props.aduan.crew }}
                                        </span>
                                    </div>
                                    <!-- <div class="basis-1/2">WhatsApp Number</div> -->
                                </div>
                                <hr
                                    class="h-px mx-0 my-4 bg-transparent border-0 opacity-25 bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent"
                                />
                                <div class="flex flex-wrap -mx-3 mt-3">
                                    <div
                                        :class="
                                            form.category_name === 'PC/LAPTOP'
                                                ? 'w-full max-w-full px-3 shrink-0 md:w-3/12 md:flex-0'
                                                : 'w-full max-w-full px-3 shrink-0 md:w-3/12 md:flex-0'
                                        "
                                    >
                                        <div class="mb-4">
                                            <label
                                                for="nvr-id"
                                                class="inline-block mb-2 ml-1 text-sm text-slate-700 dark:text-white/80"
                                            >
                                                Crew</label
                                            >
                                            <VueMultiselect
                                                v-model="form.crew"
                                                :options="props.crew"
                                                :multiple="true"
                                                :close-on-select="true"
                                                placeholder="Select Crew"
                                                label="name"
                                                track-by="name"
                                            />
                                        </div>
                                    </div>
                                    <div
                                        class="w-full max-w-full px-3 shrink-0 md:w-3/12 md:flex-0"
                                    >
                                        <div class="mb-4">
                                            <label
                                                for="location"
                                                class="inline-block mb-2 ml-1 text-sm text-slate-700 dark:text-white/80"
                                                >Location</label
                                            >
                                            <input
                                                required
                                                type="text"
                                                v-model="form.location"
                                                name="location"
                                                class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"
                                                placeholder="Lokasi Pelapor"
                                            />
                                        </div>
                                    </div>
                                    <div
                                        class="w-full max-w-full px-3 shrink-0 md:w-3/12 md:flex-0"
                                    >
                                        <div class="mb-4">
                                            <label
                                                for="date-of-complaint"
                                                class="inline-block mb-2 ml-1 text-sm text-slate-700 dark:text-white/80"
                                                >Date & Time Complaint</label
                                            >
                                            <!-- <input
                                                required
                                                type="date"
                                                v-model="form.date_of_complaint"
                                                name="date_of_complaint"
                                                class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"
                                            /> -->
                                            <VueDatePicker
                                                v-model="form.date_of_complaint"
                                            />
                                        </div>
                                    </div>
                                    <div
                                        class="w-full max-w-full px-3 shrink-0 md:w-3/12 md:flex-0"
                                    >
                                        <div class="mb-4">
                                            <label
                                                for="nvr-id"
                                                class="inline-block mb-2 ml-1 text-sm text-slate-700 dark:text-white/80"
                                            >
                                                Status</label
                                            >
                                            <select
                                                required
                                                id="status"
                                                v-model="form.status"
                                                name="status"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            >
                                                <option selected value="OPEN">
                                                    OPEN
                                                </option>
                                                <option value="PROGRESS">
                                                    PROGRESS
                                                </option>
                                                <option value="CANCEL">
                                                    CANCEL
                                                </option>
                                                <option value="CLOSED">
                                                    CLOSED
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div
                                        class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0"
                                    >
                                        <div class="mb-4">
                                            <label
                                                for="start-response"
                                                class="inline-block mb-2 ml-1 text-sm text-slate-700 dark:text-white/80"
                                                >Start Response</label
                                            >
                                            <!-- <input
                                                type="date"
                                                v-model="form.start_response"
                                                name="start_response"
                                                class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"
                                            /> -->
                                            <VueDatePicker
                                                v-model="form.start_response"
                                            />
                                        </div>
                                    </div>
                                    <div
                                        class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0"
                                    >
                                        <div class="mb-4">
                                            <label
                                                for="start-progress"
                                                class="inline-block mb-2 ml-1 text-sm text-slate-700 dark:text-white/80"
                                                >Start Progress</label
                                            >
                                            <!-- <input
                                                type="date"
                                                v-model="form.start_progress"
                                                name="start_progress"
                                                class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"
                                            /> -->
                                            <VueDatePicker
                                                v-model="form.start_progress"
                                            />
                                        </div>
                                    </div>
                                    <div
                                        class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0"
                                    >
                                        <div class="mb-4">
                                            <label
                                                for="end-progress"
                                                class="inline-block mb-2 ml-1 text-sm text-slate-700 dark:text-white/80"
                                                >End Progress</label
                                            >
                                            <!-- <input
                                                required
                                                type="date"
                                                v-model="form.end_progress"
                                                name="end_progress"
                                                class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"
                                            /> -->
                                            <VueDatePicker
                                                v-model="form.end_progress"
                                            />
                                        </div>
                                    </div>
                                    <div
                                        class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0"
                                    >
                                        <div class="mb-4">
                                            <label
                                                for="action"
                                                class="inline-block mb-2 ml-1 text-sm text-slate-700 dark:text-white/80"
                                                >Action Repair</label
                                            >
                                            <textarea
                                                required
                                                id="message"
                                                name="action_repair"
                                                v-model="form.action_repair"
                                                rows="4"
                                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="Aksi Perbaikan"
                                            ></textarea>
                                        </div>
                                    </div>
                                    <div
                                        class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0"
                                    >
                                        <div class="mb-4">
                                            <label
                                                for="repair-note"
                                                class="inline-block mb-2 ml-1 text-sm text-slate-700 dark:text-white/80"
                                                >Repair Note</label
                                            >
                                            <textarea
                                                id="message"
                                                name="repair_note"
                                                v-model="form.repair_note"
                                                rows="4"
                                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="Remark Perbaikan"
                                            ></textarea>
                                        </div>
                                    </div>
                                    <div
                                        class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0"
                                    >
                                        <div class="mb-4">
                                            <label
                                                for="issue"
                                                class="inline-block mb-2 ml-1 text-sm text-slate-700 dark:text-white/80"
                                                >Issue</label
                                            >
                                            <textarea
                                                required
                                                id="message"
                                                name="complaint_note"
                                                v-model="form.complaint_note"
                                                rows="4"
                                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="Complaint Issue"
                                            ></textarea>
                                        </div>
                                    </div>
                                    <div
                                        class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0"
                                    >
                                        <div class="mb-4">
                                            <label
                                                for="location-detail"
                                                class="inline-block mb-2 ml-1 text-sm text-slate-700 dark:text-white/80"
                                                >Detail Location</label
                                            >
                                            <textarea
                                                id="message"
                                                name="location_detail"
                                                v-model="form.location_detail"
                                                rows="4"
                                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="Detail Location"
                                            ></textarea>
                                        </div>
                                    </div>
                                </div>
                                <hr
                                    class="h-px mx-0 my-4 bg-transparent border-0 opacity-25 bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent"
                                />
                                <div class="flex flex-nowrap mt-6 justify-end">
                                    <button
                                        type="submit"
                                        class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800"
                                    >
                                        <span
                                            class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0"
                                        >
                                            Save
                                        </span>
                                    </button>
                                    <Link
                                        :href="route('aduan.page')"
                                        class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-red-200 via-red-300 to-yellow-200 group-hover:from-red-200 group-hover:via-red-300 group-hover:to-yellow-200 dark:text-white dark:hover:text-gray-900 focus:ring-4 focus:outline-none focus:ring-red-100 dark:focus:ring-red-400"
                                    >
                                        <span
                                            class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0"
                                        >
                                            Cancel
                                        </span>
                                    </Link>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayoutForm>
</template>
