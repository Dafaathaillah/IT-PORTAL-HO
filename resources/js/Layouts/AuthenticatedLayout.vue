<script setup>
import { ref, watchEffect, onMounted, computed } from "vue";
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
import { PerfectScrollbar } from "vue3-perfect-scrollbar";

const scrollOptions = ref({
    suppressScrollX: true,
});

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

const page = usePage();
const aduanBaru = computed(() => page.props.flash.aduan_baru);
const lastAduanMax_id = ref(0); // Simpan ID Aduan Terakhir
const userSite = computed(() => page.props.auth.user.site.toLowerCase());

let intervalId = null;
const notifAktif = ref(false); // State untuk mendeteksi notifikasi muncul
let audio = null;

// Simpan daftar notifikasi terbaru
const notifikasiList = ref([]); 

const checkAduan = async () => {
    try {
        const userSiteUpper = computed(() =>
            page.props.auth.user.site
        );
        const apiUrl = `/itportal/admin/check-aduan/${userSite.value}`; // Tambahkan site ke URL
        const response = await fetch(apiUrl);

        const data = await response.json();
        if (data.site === userSiteUpper.value) {
            if (data && data.id) {
                let lastAduanMax_id = localStorage.getItem("lastAduanMax_id");

                if (!lastAduanMax_id || data.id != lastAduanMax_id) {
                    localStorage.setItem("lastAduanMax_id", data.id);
                    console.log(data.id);

                    // 🔥 Tampilkan popup (browser menganggap ini sebagai interaksi)
                    Swal.fire({
                        title: "Aduan Baru!",
                        text: data.message,
                        icon: "info",
                        // timer: 5000,
                        // timerProgressBar: true,
                        position: "top-end",
                        showConfirmButton: false,
                        toast: true,
                        showCloseButton: true,
                        didOpen: () => {
                            // ✅ Mainkan audio di dalam event SweetAlert
                            const audio = document.getElementById("notifSound");
                            if (audio) {
                                audio.muted = false;
                                audio.currentTime = 0;
                                audio
                                    .play()
                                    .then(() => {
                                        console.log(
                                            "🔊 Audio berhasil diputar."
                                        );
                                    })
                                    .catch((error) => {
                                        console.warn(
                                            "⚠️ Gagal memutar audio:",
                                            error
                                        );
                                    });
                            }
                        },
                    });
                }
            }
        }
    } catch (error) {
        console.error("Error fetching aduan:", error);
    }
};

// const checkAduan = async () => {
//     try {
//         const apiUrl = `/itportal/admin/check-aduan/${userSite.value}`;
//         const response = await fetch(apiUrl);
//         const data = await response.json();

//         if (data.site.toLowerCase() === userSite.value) {
//             if (data && data.id) {
//                 let lastAduanMax_id = localStorage.getItem(`lastAduanMax_id_${userSite.value}`);

//                 if (!lastAduanMax_id || data.id != lastAduanMax_id) {
//                     localStorage.setItem(`lastAduanMax_id_${userSite.value}`, data.id);
                    
//                     // Simpan ke dalam array notifikasi
//                     notifikasiList.value.push({
//                         id: data.id,
//                         message: data.message,
//                     });

//                     // Urutkan dari ID terbesar ke terkecil agar notifikasi terbaru di atas
//                     notifikasiList.value.sort((a, b) => b.id - a.id);

//                     console.log("Aduan baru diterima:", notifikasiList.value);

//                     // 🔥 Loop untuk menampilkan banyak notifikasi bertumpuk ke bawah
//                     notifikasiList.value.forEach((aduan, index) => {
//                         setTimeout(() => {
//                             Swal.fire({
//                                 title: "📢 Aduan Baru!",
//                                 text: aduan.message,
//                                 icon: "info",
//                                 position: "top-end", // Tetap di atas, tapi bertumpuk ke bawah
//                                 grow: "row", // Agar notifikasi muncul bertingkat ke bawah
//                                 showConfirmButton: false,
//                                 toast: true, // Notifikasi kecil (SweetAlert toast)
//                                 showCloseButton: true,
//                                 // timer: 8000,
//                                 // timerProgressBar: true,
//                                 customClass: {
//                                     popup: `swal-custom-${index}`, // Tambahkan kelas unik untuk posisi bertingkat
//                                 },
//                                 didOpen: () => {
//                                     const audio = document.getElementById("notifSound");
//                                     if (audio) {
//                                         audio.muted = false;
//                                         audio.currentTime = 0;
//                                         audio.play().then(() => {
//                                             console.log("🔊 Audio berhasil diputar untuk:", aduan.message);
//                                         }).catch((error) => {
//                                             console.warn("⚠️ Gagal memutar audio:", error);
//                                         });
//                                     }
//                                 },
//                             });

//                             // Tambahkan sedikit margin agar bertumpuk ke bawah
//                             setTimeout(() => {
//                                 document.querySelector(`.swal-custom-${index}`)?.style.setProperty("margin-top", `${index * 80}px`);
//                             }, 100);
//                         }, index * 1000); // Muncul setiap 1 detik
//                     });
//                 }
//             }
//         }
//     } catch (error) {
//         console.error("❌ Error fetching aduan:", error);
//     }
// };

onMounted(() => {
    console.log("👀 Memeriksa localStorage di Admin...");

    const lastAduan = localStorage.getItem("lastAduan");

    if (lastAduan) {
        console.log("✅ Data ditemukan:", JSON.parse(lastAduan));
    } else {
        console.log("❌ Tidak ada data aduan di localStorage");
    }

    // Tambahkan event listener untuk mendeteksi perubahan localStorage
    window.addEventListener("storage", (event) => {
        if (event.key === "lastAduan") {
            console.log(
                "🔔 Data aduan baru masuk:",
                JSON.parse(event.newValue)
            );
        }
    });

    const audio = document.getElementById("notifSound");
    if (audio) {
        audio.muted = true; // Mulai dalam mode mute
    }

    // Jalankan polling untuk mengecek aduan baru
    intervalId = setInterval(checkAduan, 2000);
});

const pages = defineModel("pages", {
    type: String,
});

const subMenu = defineModel("subMenu", {
    type: String,
});

const mainMenu = defineModel("mainMenu", {
    type: String,
});
</script>

<template>
    <div
        class="absolute w-full dark:hidden min-h-75"
        style="
            background: linear-gradient(
                180deg,
                #ff2c2c 0%,
                rgba(255, 80, 80, 1) 100%
            );
        "
    ></div>
    <div class="hidden absolute w-full bg-slate-900 dark:block min-h-75"></div>

    <DashboardAside v-model:isMobileSidebar="isActive" />

    <!-- Page Content -->
    <main
        class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl overflow-hidden"
    >
        <audio
            id="notifSound"
            src="/sounds/aduan.mp3"
            muted
            autoplay
            preload="auto"
        ></audio>
        <PerfectScrollbar :options="scrollOptions">
            <DashboardNavbar
                @toggleMobileSidebar="handleMobileSidebar"
                @toggleConfig="handleConfigurator"
                v-model:isCollapseIconActive="isActive"
                v-model:pages="pages"
                v-model:subMenu="subMenu"
                v-model:mainMenu="mainMenu"
            />
            <div class="w-full px-6 py-6 mx-auto">
                <slot />
            </div>
            <DashboardFooter />
        </PerfectScrollbar>
    </main>
    <DashboardConfig
        ref="configurator"
        v-model:isConfiguratorActive="isConfiguratorActive"
    />
</template>
<style>
@import "/public/assets/css/perfect-scrollbar.css";

@media only screen and (min-width: 150px) {
    /* For mobile: */
    .ps {
        max-height: 38em !important;
        /* or height: 100px; */
    }
}

@media only screen and (min-width: 415px) {
    /* For mobile: */
    .ps {
        max-height: 48em !important;
        /* or height: 100px; */
    }
}

@media only screen and (min-width: 600px) {
    /* For laptop: */
    .ps {
        max-height: 42em !important;
        /* or height: 100px; */
    }
}

@media only screen and (min-width: 1024) {
    /* For laptop: */
    .ps {
        max-height: 40em !important;
        /* or height: 100px; */
    }
}

@media only screen and (min-width: 1180) {
    /* For laptop: */
    .ps {
        max-height: 40em !important;
        /* or height: 100px; */
    }
}

@media only screen and (min-width: 1366px) {
    /* For laptop: */
    .ps {
        max-height: 42em !important;
        /* or height: 100px; */
    }
}

@media (min-width: 1800px) {
    /* For big monitor */
    .ps {
        max-height: 52em !important;
        /* or height: 100px; */
    }
}
</style>
