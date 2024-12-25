<script setup>
import { ref, watchEffect } from "vue";
import { usePage } from "@inertiajs/vue3";
import { onClickOutside } from "@vueuse/core";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import { Link } from "@inertiajs/vue3";
import DashboardAside from "@/Components/inventory/DashboardAside.vue";
import DashboardNavbar from "@/Components/inventory/DashboardNavbar.vue";
import DashboardFooter from "@/Components/inventory/DashboardFooter.vue";
import DashboardConfig from "@/Components/inventory/DashboardConfig.vue";
import Swal from "sweetalert2";
import { PerfectScrollbar } from 'vue3-perfect-scrollbar';

const showingNavigationDropdown = ref(false);

//Mobile Sidebar
const isActive = ref(false);
const handleMobileSidebar = () => {
    // alert(isActive.value);
    isActive.value = !isActive.value;
};

//Argon Configurator
const configurator = ref(null);
const isConfiguratorActive = ref(false);
const handleConfigurator = () => {
    isConfiguratorActive.value = !isConfiguratorActive.value;
};

onClickOutside(configurator, (event) => (isConfiguratorActive.value = false));

// Flash Messages
// watchEffect(() => {
//     let flashMessage = usePage().props.flashMessage;

//     if (flashMessage.success) {
//         Swal.fire({
//             html: flashMessage.success,
//             icon: "success",
//             buttonsStyling: false,
//             confirmButtonText: "Ok, got it!",
//             customClass: {
//                 confirmButton:
//                     "inline-flex px-7 py-2.5 font-bold leading-normal text-center text-white align-middle transition-all bg-blue-500 border-0 rounded-lg cursor-pointer hover:-translate-y-px active:opacity-85 hover:shadow-xs text-sm ease-in tracking-tight-rem shadow-md bg-150 bg-x-25",
//             },
//         });
//     }

//     if (flashMessage.error || Object.keys(usePage().props.errors).length > 0) {
//         if (flashMessage.error) {
//             Swal.fire({
//                 title: "Server Error",
//                 html: flashMessage.error,
//                 icon: "error",
//                 buttonsStyling: false,
//                 confirmButtonText: "Ok, got it!",
//                 customClass: {
//                     confirmButton:
//                         "inline-flex mt-5 mb-10 items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150",
//                 },
//             });
//         } else {
//             Swal.fire({
//                 title: "Validation Error",
//                 html: Object.keys(usePage().props.errors),
//                 icon: "error",
//                 buttonsStyling: false,
//                 confirmButtonText: "Ok, got it!",
//                 customClass: {
//                     confirmButton:
//                         "inline-flex my-5 items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150",
//                 },
//             });
//         }
//     }
// });

const pages = defineModel('pages', {
    type: String,
});

const subMenu = defineModel('subMenu', {
    type: String,
});

const mainMenu = defineModel('mainMenu', {
    type: String,
});

</script>

<template>
    <div class="absolute w-full bg-red-700 dark:hidden min-h-75"></div>

    <DashboardAside v-model:isMobileSidebar="isActive" />

    <!-- Page Content -->
    <main
        class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl overflow-hidden">
        <PerfectScrollbar>
            <DashboardNavbar @toggleMobileSidebar="handleMobileSidebar" @toggleConfig="handleConfigurator"
                v-model:isCollapseIconActive="isActive" v-model:pages="pages" v-model:subMenu="subMenu"
                v-model:mainMenu="mainMenu" />
            <div class="w-full px-6 py-6 mx-auto">

                <slot />

            </div>
            <DashboardFooter />
        </PerfectScrollbar>
    </main>
    <DashboardConfig ref="configurator" v-model:isConfiguratorActive="isConfiguratorActive" />
</template>
<style>
@import 'vue3-perfect-scrollbar/style.css';

@media only screen and (max-width: 600px) {
  /* For mobile: */
  .ps {
        max-height: 50em !important;
        /* or height: 100px; */
    }
  
}


@media (max-width: 1800px) {
  
  /* CSS */
  .ps {
        max-height: 42em !important;
        /* or height: 100px; */
    }
  
}


</style>