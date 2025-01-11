<script setup>
import { usePage } from "@inertiajs/vue3";
import NavLink from "@/Components/NavLink.vue";
import SideNavItems from "./SideNavItems.vue";
import { ref, onMounted, watch, computed } from "vue";
import { PerfectScrollbar } from "vue3-perfect-scrollbar";

const url = usePage().props.url;

const isMobileSidebar = defineModel("isMobileSidebar", {
    type: Boolean,
    default: false,
});

const handleSidebarClose = () => {
    isMobileSidebar.value = !isMobileSidebar.value;
};

const classes = computed(() =>
    isMobileSidebar.value
        ? "xl:ml-6 ps translate-x-0 ml-6"
        : "shadow-xl xl:ml-6"
);

// Toggle Site Ho
// State for controlling the visibility of submenus
const level1OpenHo = ref(false);
const level2OpenHo = ref(false);
const level2OpenAduanHo = ref(false);
const level2OpenSettingHo = ref(false);
const level2OpenInspeksiHo = ref(false);
const level3OpenHo = ref(false);
const level3KomputerOpenHo = ref(false);
const level3PrinterOpenHo = ref(false);
const level3ScannerOpenHo = ref(false);
const level3CctvOpenHo = ref(false);

// Load initial state from localStorage
onMounted(() => {
    level1OpenHo.value = localStorage.getItem("level1OpenHo") === "true";
    level2OpenHo.value = localStorage.getItem("level2OpenHo") === "true";
    level2OpenAduanHo.value =
        localStorage.getItem("level2OpenAduanHo") === "true";
    level2OpenSettingHo.value =
        localStorage.getItem("level2OpenSettingHo") === "true";
    level2OpenInspeksiHo.value =
        localStorage.getItem("level2OpenInspeksiHo") === "true";
    level3OpenHo.value = localStorage.getItem("level3OpenHo") === "true";
    level3PrinterOpenHo.value =
        localStorage.getItem("level3PrinterOpenHo") === "true";
    level3ScannerOpenHo.value =
        localStorage.getItem("level3ScannerOpenHo") === "true";
    level3KomputerOpenHo.value =
        localStorage.getItem("level3KomputerOpenHo") === "true";
    level3CctvOpenHo.value =
        localStorage.getItem("level3CctvOpenHo") === "true";
});

// Watch changes and save to localStorage
watch(
    [
        level1OpenHo,
        level2OpenHo,
        level2OpenSettingHo,
        level2OpenInspeksiHo,
        level2OpenAduanHo,
        level3OpenHo,
        level3PrinterOpenHo,
        level3ScannerOpenHo,
        level3KomputerOpenHo,
        level3CctvOpenHo,
    ],
    () => {
        localStorage.setItem("level1OpenHo", level1OpenHo.value);
        localStorage.setItem("level2OpenHo", level2OpenHo.value);
        localStorage.setItem("level2OpenAduanHo", level2OpenAduanHo.value);
        localStorage.setItem("level2OpenSettingHo", level2OpenSettingHo.value);
        localStorage.setItem(
            "level2OpenInspeksiHo",
            level2OpenInspeksiHo.value
        );
        localStorage.setItem("level3OpenHo", level3OpenHo.value);
        localStorage.setItem(
            "level3KomputerOpenHo",
            level3KomputerOpenHo.value
        );
        localStorage.setItem("level3PrinterOpenHo", level3PrinterOpenHo.value);
        localStorage.setItem("level3ScannerOpenHo", level3ScannerOpenHo.value);
        localStorage.setItem("level3CctvOpenHo", level3CctvOpenHo.value);
    }
);

// Toggle functions for each level
const toggleLevel1Ho = () => {
    level1OpenHo.value = !level1OpenHo.value;

    level1OpenBa.value = false;
    level2OpenBa.value = false;
    level2OpenSettingBa.value = false;
    level2OpenInspeksiBa.value = false;

    level1OpenBib.value = false;
    level2OpenBib.value = false;
    level2OpenSettingBib.value = false;
    level2OpenInspeksiBib.value = false;

    level1OpenMifa.value = false;
    level2OpenMifa.value = false;
    level2OpenSettingMifa.value = false;
    level2OpenInspeksiMifa.value = false;

    level1OpenAmi.value = false;
    level2OpenAmi.value = false;
    level2OpenSettingAmi.value = false;
    level2OpenInspeksiAmi.value = false;

    level1OpenMhu.value = false;
    level2OpenMhu.value = false;
    level2OpenSettingMhu.value = false;
    level2OpenInspeksiMhu.value = false;

    level1OpenWARA.value = false;
    level2OpenWARA.value = false;
    level2OpenSettingWARA.value = false;
    level2OpenInspeksiWARA.value = false;

    // Jika level1 ditutup, tutup juga level2
    if (!level1OpenHo.value) {
        level2OpenHo.value = false;
        level2OpenInspeksiHo.value = false;
        level3OpenHo.value = false;
        level3KomputerOpenHo.value = false;
        level3PrinterOpenHo.value = false;
        level3ScannerOpenHo.value = false;
        level3CctvOpenHo.value = false;
    }
};

const toggleLevel2Ho = () => {
    console.log(level1OpenHo.value);
    if (!level2OpenHo.value) {
        level1OpenHo.value = true; // pastikan level 1 terbuka jika level 2 dibuka
        level2OpenSettingHo.value = false;
        level2OpenInspeksiHo.value = false;
        level3OpenHo.value = false;
        level3KomputerOpenHo.value = false;
        level3PrinterOpenHo.value = false;
        level3ScannerOpenHo.value = false;
        level3CctvOpenHo.value = false;
    }
    level2OpenHo.value = !level2OpenHo.value;
};

const toggleLevel2AduanHo = () => {
    console.log(level1OpenHo.value);
    if (!level2OpenAduanHo.value) {
        level2OpenHo.value = false; // pastikan level 1 terbuka jika level 2 dibuka
        level2OpenSettingHo.value = false; // pastikan level 1 terbuka jika level 2 dibuka
        level2OpenInspeksiHo.value = false; // pastikan level 1 terbuka jika level 2 dibuka
        level3OpenHo.value = false;
        level3KomputerOpenHo.value = false;
        level3PrinterOpenHo.value = false;
        level3ScannerOpenHo.value = false;
        level3CctvOpenHo.value = false;
    }
    level2OpenAduanHo.value = !level2OpenAduanHo.value;
};

const toggleLevel2SettingHo = () => {
    console.log(level1OpenHo.value);
    if (!level2OpenSettingHo.value) {
        level1OpenHo.value = false;
        level1OpenBa.value = false;
        level1OpenMifa.value = false;
        level1OpenMhu.value = false;
        level1OpenWARA.value = false;
        level1OpenAmi.value = false;
        level1OpenBib.value = false;
    }
    level2OpenSettingHo.value = !level2OpenSettingHo.value;
};

const toggleLevel2InspeksiHo = () => {
    console.log(level1OpenHo.value);
    if (!level2OpenInspeksiHo.value) {
        level1OpenHo.value = true; // pastikan level 1 terbuka jika level 2 dibuka
        level2OpenHo.value = false;
        level2OpenSettingHo.value = false;
        level3OpenHo.value = false;
        level3KomputerOpenHo.value = false;
        level3PrinterOpenHo.value = false;
        level3ScannerOpenHo.value = false;
        level3CctvOpenHo.value = false;
    }
    level2OpenInspeksiHo.value = !level2OpenInspeksiHo.value;
};

const toggleLevel3LaptopHo = () => {
    if (!level3OpenHo.value) {
        level2OpenHo.value = true; // pastikan level 1 terbuka jika level 3 dibuka
        level3KomputerOpenHo.value = false;
        level3PrinterOpenHo.value = false;
        level3ScannerOpenHo.value = false;
        level3CctvOpenHo.value = false;
    }
    level3OpenHo.value = !level3OpenHo.value;
};

const toggleLevel3KomputerHo = () => {
    if (!level3KomputerOpenHo.value) {
        level2OpenHo.value = true; // pastikan level 1 terbuka jika level 3 dibuka
        level3OpenHo.value = false;
        level3PrinterOpenHo.value = false;
        level3ScannerOpenHo.value = false;
        level3CctvOpenHo.value = false;
    }
    level3KomputerOpenHo.value = !level3KomputerOpenHo.value;
};

const toggleLevel3CctvHo = () => {
    if (!level3CctvOpenHo.value) {
        level2OpenHo.value = true; // pastikan level 1 terbuka jika level 2 dibuka
        level3OpenHo.value = false;
        level3KomputerOpenHo.value = false;
        level3PrinterOpenHo.value = false;
        level3ScannerOpenHo.value = false;
    }
    level3CctvOpenHo.value = !level3CctvOpenHo.value;
};

const toggleLevel3PrinterHo = () => {
    if (!level3PrinterOpenHo.value) {
        level2OpenHo.value = true; // pastikan level 1 terbuka jika level 2 dibuka
        level3OpenHo.value = false;
        level3KomputerOpenHo.value = false;
        level3ScannerOpenHo.value = false;
        level3CctvOpenHo.value = false;
    }
    level3PrinterOpenHo.value = !level3PrinterOpenHo.value;
};

const toggleLevel3ScannerHo = () => {
    if (!level3ScannerOpenHo.value) {
        level2OpenHo.value = true; // pastikan level 1 terbuka jika level 2 dibuka
        level3OpenHo.value = false;
        level3KomputerOpenHo.value = false;
        level3PrinterOpenHo.value = false;
        level3CctvOpenHo.value = false;
    }
    level3ScannerOpenHo.value = !level3ScannerOpenHo.value;
};

// toggle BA
const level1OpenBa = ref(false);
const level2OpenBa = ref(false);
const level2OpenAduanBa = ref(false);
const level2OpenSettingBa = ref(false);
const level2OpenInspeksiBa = ref(false);
const level3OpenBa = ref(false);
const level3KomputerOpenBa = ref(false);
const level3PrinterOpenBa = ref(false);
const level3ScannerOpenBa = ref(false);
const level3CctvOpenBa = ref(false);

// Load initial state from localStorage
onMounted(() => {
    level1OpenBa.value = localStorage.getItem("level1OpenBa") === "true";
    level2OpenBa.value = localStorage.getItem("level2OpenBa") === "true";
    level2OpenAduanBa.value =
        localStorage.getItem("level2OpenAduanBa") === "true";
    level2OpenSettingBa.value =
        localStorage.getItem("level2OpenSettingBa") === "true";
    level2OpenInspeksiBa.value =
        localStorage.getItem("level2OpenInspeksiBa") === "true";
    level3OpenBa.value = localStorage.getItem("level3OpenBa") === "true";
    level3PrinterOpenBa.value =
        localStorage.getItem("level3PrinterOpenBa") === "true";
    level3ScannerOpenBa.value =
        localStorage.getItem("level3ScannerOpenBa") === "true";
    level3KomputerOpenBa.value =
        localStorage.getItem("level3KomputerOpenBa") === "true";
    level3CctvOpenBa.value =
        localStorage.getItem("level3CctvOpenBa") === "true";
});

// Watch changes and save to localStorage
watch(
    [
        level1OpenBa,
        level2OpenBa,
        level2OpenSettingBa,
        level2OpenInspeksiBa,
        level2OpenAduanBa,
        level3OpenBa,
        level3PrinterOpenBa,
        level3ScannerOpenBa,
        level3KomputerOpenBa,
        level3CctvOpenBa,
    ],
    () => {
        localStorage.setItem("level1OpenBa", level1OpenBa.value);
        localStorage.setItem("level2OpenBa", level2OpenBa.value);
        localStorage.setItem("level2OpenAduanBa", level2OpenAduanBa.value);
        localStorage.setItem("level2OpenSettingBa", level2OpenSettingBa.value);
        localStorage.setItem(
            "level2OpenInspeksiBa",
            level2OpenInspeksiBa.value
        );
        localStorage.setItem("level3OpenBa", level3OpenBa.value);
        localStorage.setItem(
            "level3KomputerOpenBa",
            level3KomputerOpenBa.value
        );
        localStorage.setItem("level3PrinterOpenBa", level3PrinterOpenBa.value);
        localStorage.setItem("level3ScannerOpenBa", level3ScannerOpenBa.value);
        localStorage.setItem("level3CctvOpenBa", level3CctvOpenBa.value);
    }
);

// Toggle functions for each level
const toggleLevel1Ba = () => {
    level1OpenBa.value = !level1OpenBa.value;

    level1OpenHo.value = false;
    level2OpenHo.value = false;
    level2OpenSettingHo.value = false;
    level2OpenInspeksiHo.value = false;

    level1OpenBib.value = false;
    level2OpenBib.value = false;
    level2OpenSettingBib.value = false;
    level2OpenInspeksiBib.value = false;

    level1OpenMifa.value = false;
    level2OpenMifa.value = false;
    level2OpenSettingMifa.value = false;
    level2OpenInspeksiMifa.value = false;

    level1OpenAmi.value = false;
    level2OpenAmi.value = false;
    level2OpenSettingAmi.value = false;
    level2OpenInspeksiAmi.value = false;

    level1OpenMhu.value = false;
    level2OpenMhu.value = false;
    level2OpenSettingMhu.value = false;
    level2OpenInspeksiMhu.value = false;

    level1OpenWARA.value = false;
    level2OpenWARA.value = false;
    level2OpenSettingWARA.value = false;
    level2OpenInspeksiWARA.value = false;

    // Jika level1 ditutup, tutup juga level2
    if (!level1OpenBa.value) {
        level2OpenBa.value = false;
        level3OpenBa.value = false;
        level3KomputerOpenBa.value = false;
        level3PrinterOpenBa.value = false;
        level3ScannerOpenBa.value = false;
        level3CctvOpenBa.value = false;
    }
};

const toggleLevel2Ba = () => {
    console.log(level1OpenBa.value);
    if (!level2OpenBa.value) {
        level1OpenBa.value = true; // pastikan level 1 terbuka jika level 2 dibuka
        level2OpenSettingBa.value = false;
        level2OpenInspeksiBa.value = false;
        level3OpenBa.value = false;
        level3KomputerOpenBa.value = false;
        level3PrinterOpenBa.value = false;
        level3ScannerOpenBa.value = false;
        level3CctvOpenBa.value = false;
    }
    level2OpenBa.value = !level2OpenBa.value;
};

const toggleLevel2AduanBa = () => {
    console.log(level1OpenBa.value);
    if (!level2OpenAduanBa.value) {
        level2OpenBa.value = false; // pastikan level 1 terbuka jika level 2 dibuka
        level2OpenSettingBa.value = false; // pastikan level 1 terbuka jika level 2 dibuka
        level2OpenInspeksiBa.value = false; // pastikan level 1 terbuka jika level 2 dibuka
        level3OpenBa.value = false;
        level3KomputerOpenBa.value = false;
        level3PrinterOpenBa.value = false;
        level3ScannerOpenBa.value = false;
        level3CctvOpenBa.value = false;
    }
    level2OpenAduanBa.value = !level2OpenAduanBa.value;
};

const toggleLevel2SettingBa = () => {
    console.log(level1OpenBa.value);
    if (!level2OpenSettingBa.value) {
        level1OpenBa.value = true; // pastikan level 1 terbuka jika level 2 dibuka
        level2OpenBa.value = false; // pastikan level 1 terbuka jika level 2 dibuka
        level2OpenInspeksiBa.value = false;
        level3OpenBa.value = false;
        level3KomputerOpenBa.value = false;
        level3PrinterOpenBa.value = false;
        level3ScannerOpenBa.value = false;
        level3CctvOpenBa.value = false;
    }
    level2OpenSettingBa.value = !level2OpenSettingBa.value;
};

const toggleLevel2InspeksiBa = () => {
    console.log(level1OpenBa.value);
    if (!level2OpenInspeksiBa.value) {
        level1OpenBa.value = true; // pastikan level 1 terbuka jika level 2 dibuka
        level2OpenBa.value = false; // pastikan level 1 terbuka jika level 2 dibuka
        level3OpenBa.value = false;
        level2OpenSettingBa.value = false;
        level3KomputerOpenBa.value = false;
        level3PrinterOpenBa.value = false;
        level3ScannerOpenBa.value = false;
        level3CctvOpenBa.value = false;
    }
    level2OpenInspeksiBa.value = !level2OpenInspeksiBa.value;
};

const toggleLevel3LaptopBa = () => {
    if (!level3OpenBa.value) {
        level2OpenBa.value = true; // pastikan level 1 terbuka jika level 3 dibuka
        level3KomputerOpenBa.value = false;
        level3PrinterOpenBa.value = false;
        level3ScannerOpenBa.value = false;
        level3CctvOpenBa.value = false;
    }
    level3OpenBa.value = !level3OpenBa.value;
};

const toggleLevel3KomputerBa = () => {
    if (!level3KomputerOpenBa.value) {
        level2OpenBa.value = true; // pastikan level 1 terbuka jika level 3 dibuka
        level3OpenBa.value = false;
        level3PrinterOpenBa.value = false;
        level3ScannerOpenBa.value = false;
        level3CctvOpenBa.value = false;
    }
    level3KomputerOpenBa.value = !level3KomputerOpenBa.value;
};

const toggleLevel3CctvBa = () => {
    if (!level3CctvOpenBa.value) {
        level2OpenBa.value = true; // pastikan level 1 terbuka jika level 2 dibuka
        level3OpenBa.value = false;
        level3KomputerOpenBa.value = false;
        level3PrinterOpenBa.value = false;
        level3ScannerOpenBa.value = false;
    }
    level3CctvOpenBa.value = !level3CctvOpenBa.value;
};

const toggleLevel3PrinterBa = () => {
    if (!level3PrinterOpenBa.value) {
        level2OpenBa.value = true; // pastikan level 1 terbuka jika level 2 dibuka
        level3OpenBa.value = false;
        level3KomputerOpenBa.value = false;
        level3ScannerOpenBa.value = false;
        level3CctvOpenBa.value = false;
    }
    level3PrinterOpenBa.value = !level3PrinterOpenBa.value;
};

const toggleLevel3ScannerBa = () => {
    if (!level3ScannerOpenBa.value) {
        level2OpenBa.value = true; // pastikan level 1 terbuka jika level 2 dibuka
        level3OpenBa.value = false;
        level3KomputerOpenBa.value = false;
        level3PrinterOpenBa.value = false;
        level3CctvOpenBa.value = false;
    }
    level3ScannerOpenBa.value = !level3ScannerOpenBa.value;
};

// toggle MIFA
const level1OpenMifa = ref(false);
const level2OpenMifa = ref(false);
const level2OpenAduanMifa = ref(false);
const level2OpenSettingMifa = ref(false);
const level2OpenInspeksiMifa = ref(false);
const level3OpenMifa = ref(false);
const level3KomputerOpenMifa = ref(false);
const level3PrinterOpenMifa = ref(false);
const level3ScannerOpenMifa = ref(false);
const level3CctvOpenMifa = ref(false);

// Load initial state from localStorage
onMounted(() => {
    level1OpenMifa.value = localStorage.getItem("level1OpenMifa") === "true";
    level2OpenMifa.value = localStorage.getItem("level2OpenMifa") === "true";
    level2OpenAduanMifa.value =
        localStorage.getItem("level2OpenAduanMifa") === "true";
    level2OpenSettingMifa.value =
        localStorage.getItem("level2OpenSettingMifa") === "true";
    level2OpenInspeksiMifa.value =
        localStorage.getItem("level2OpenInspeksiMifa") === "true";
    level3OpenMifa.value = localStorage.getItem("level3OpenMifa") === "true";
    level3PrinterOpenMifa.value =
        localStorage.getItem("level3PrinterOpenMifa") === "true";
    level3ScannerOpenMifa.value =
        localStorage.getItem("level3ScannerOpenMifa") === "true";
    level3KomputerOpenMifa.value =
        localStorage.getItem("level3KomputerOpenMifa") === "true";
    level3CctvOpenMifa.value =
        localStorage.getItem("level3CctvOpenMifa") === "true";
});

// Watch changes and save to localStorage
watch(
    [
        level1OpenMifa,
        level2OpenMifa,
        level2OpenSettingMifa,
        level2OpenInspeksiMifa,
        level2OpenAduanMifa,
        level3OpenMifa,
        level3PrinterOpenMifa,
        level3ScannerOpenMifa,
        level3KomputerOpenMifa,
        level3CctvOpenMifa,
    ],
    () => {
        localStorage.setItem("level1OpenMifa", level1OpenMifa.value);
        localStorage.setItem("level2OpenMifa", level2OpenMifa.value);
        localStorage.setItem("level2OpenAduanMifa", level2OpenAduanMifa.value);
        localStorage.setItem(
            "level2OpenSettingMifa",
            level2OpenSettingMifa.value
        );
        localStorage.setItem(
            "level2OpenInspeksiMifa",
            level2OpenInspeksiMifa.value
        );
        localStorage.setItem("level3OpenMifa", level3OpenMifa.value);
        localStorage.setItem(
            "level3KomputerOpenMifa",
            level3KomputerOpenMifa.value
        );
        localStorage.setItem(
            "level3PrinterOpenMifa",
            level3PrinterOpenMifa.value
        );
        localStorage.setItem(
            "level3ScannerOpenMifa",
            level3ScannerOpenMifa.value
        );
        localStorage.setItem("level3CctvOpenMifa", level3CctvOpenMifa.value);
    }
);

// Toggle functions for each level
const toggleLevel1Mifa = () => {
    level1OpenMifa.value = !level1OpenMifa.value;

    level1OpenHo.value = false;
    level2OpenHo.value = false;
    level2OpenSettingHo.value = false;
    level2OpenInspeksiHo.value = false;

    level1OpenBa.value = false;
    level2OpenBa.value = false;
    level2OpenSettingBa.value = false;
    level2OpenInspeksiBa.value = false;

    level1OpenBib.value = false;
    level2OpenBib.value = false;
    level2OpenSettingBib.value = false;
    level2OpenInspeksiBib.value = false;

    level1OpenMhu.value = false;
    level2OpenMhu.value = false;
    level2OpenSettingMhu.value = false;
    level2OpenInspeksiMhu.value = false;

    level1OpenAmi.value = false;
    level2OpenAmi.value = false;
    level2OpenSettingAmi.value = false;
    level2OpenInspeksiAmi.value = false;

    level1OpenWARA.value = false;
    level2OpenWARA.value = false;
    level2OpenSettingWARA.value = false;
    level2OpenInspeksiWARA.value = false;

    // Jika level1 ditutup, tutup juga level2
    if (!level1OpenMifa.value) {
        level2OpenMifa.value = false;
        level3OpenMifa.value = false;
        level3KomputerOpenMifa.value = false;
        level3PrinterOpenMifa.value = false;
        level3ScannerOpenMifa.value = false;
        level3CctvOpenMifa.value = false;
    }
};

const toggleLevel2Mifa = () => {
    console.log(level1OpenMifa.value);
    if (!level2OpenMifa.value) {
        level1OpenMifa.value = true; // pastikan level 1 terbuka jika level 2 dibuka
        level2OpenSettingMifa.value = false;
        level2OpenInspeksiMifa.value = false;
        level3OpenMifa.value = false;
        level3KomputerOpenMifa.value = false;
        level3PrinterOpenMifa.value = false;
        level3ScannerOpenMifa.value = false;
        level3CctvOpenMifa.value = false;
    }
    level2OpenMifa.value = !level2OpenMifa.value;
};

const toggleLevel2AduanMifa = () => {
    console.log(level1OpenMifa.value);
    if (!level2OpenAduanMifa.value) {
        level2OpenMifa.value = false; // pastikan level 1 terbuka jika level 2 dibuka
        level2OpenSettingMifa.value = false; // pastikan level 1 terbuka jika level 2 dibuka
        level2OpenInspeksiMifa.value = false; // pastikan level 1 terbuka jika level 2 dibuka
        level3OpenMifa.value = false;
        level3KomputerOpenMifa.value = false;
        level3PrinterOpenMifa.value = false;
        level3ScannerOpenMifa.value = false;
        level3CctvOpenMifa.value = false;
    }
    level2OpenAduanMifa.value = !level2OpenAduanMifa.value;
};

const toggleLevel2SettingMifa = () => {
    console.log(level1OpenMifa.value);
    if (!level2OpenSettingMifa.value) {
        level1OpenMifa.value = true; // pastikan level 1 terbuka jika level 2 dibuka
        level2OpenMifa.value = false; // pastikan level 1 terbuka jika level 2 dibuka
        level2OpenInspeksiMifa.value = false;
        level3OpenMifa.value = false;
        level3KomputerOpenMifa.value = false;
        level3PrinterOpenMifa.value = false;
        level3ScannerOpenMifa.value = false;
        level3CctvOpenMifa.value = false;
    }
    level2OpenSettingMifa.value = !level2OpenSettingMifa.value;
};

const toggleLevel2InspeksiMifa = () => {
    console.log(level1OpenMifa.value);
    if (!level2OpenInspeksiMifa.value) {
        level1OpenMifa.value = true; // pastikan level 1 terbuka jika level 2 dibuka
        level2OpenMifa.value = false; // pastikan level 1 terbuka jika level 2 dibuka
        level2OpenSettingMifa.value = false;
        level3OpenMifa.value = false;
        level3KomputerOpenMifa.value = false;
        level3PrinterOpenMifa.value = false;
        level3ScannerOpenMifa.value = false;
        level3CctvOpenMifa.value = false;
    }
    level2OpenInspeksiMifa.value = !level2OpenInspeksiMifa.value;
};

const toggleLevel3LaptopMifa = () => {
    if (!level3OpenMifa.value) {
        level2OpenMifa.value = true; // pastikan level 1 terbuka jika level 3 dibuka
        level3KomputerOpenMifa.value = false;
        level3PrinterOpenMifa.value = false;
        level3ScannerOpenMifa.value = false;
        level3CctvOpenMifa.value = false;
    }
    level3OpenMifa.value = !level3OpenMifa.value;
};

const toggleLevel3KomputerMifa = () => {
    if (!level3KomputerOpenMifa.value) {
        level2OpenMifa.value = true; // pastikan level 1 terbuka jika level 3 dibuka
        level3OpenMifa.value = false;
        level3PrinterOpenMifa.value = false;
        level3ScannerOpenMifa.value = false;
        level3CctvOpenMifa.value = false;
    }
    level3KomputerOpenMifa.value = !level3KomputerOpenMifa.value;
};

const toggleLevel3CctvMifa = () => {
    if (!level3CctvOpenMifa.value) {
        level2OpenMifa.value = true; // pastikan level 1 terbuka jika level 2 dibuka
        level3OpenMifa.value = false;
        level3KomputerOpenMifa.value = false;
        level3PrinterOpenMifa.value = false;
        level3ScannerOpenMifa.value = false;
    }
    level3CctvOpenMifa.value = !level3CctvOpenMifa.value;
};

const toggleLevel3PrinterMifa = () => {
    if (!level3PrinterOpenMifa.value) {
        level2OpenMifa.value = true; // pastikan level 1 terbuka jika level 2 dibuka
        level3OpenMifa.value = false;
        level3KomputerOpenMifa.value = false;
        level3ScannerOpenMifa.value = false;
        level3CctvOpenMifa.value = false;
    }
    level3PrinterOpenMifa.value = !level3PrinterOpenMifa.value;
};

const toggleLevel3ScannerMifa = () => {
    if (!level3ScannerOpenMifa.value) {
        level2OpenMifa.value = true; // pastikan level 1 terbuka jika level 2 dibuka
        level3OpenMifa.value = false;
        level3KomputerOpenMifa.value = false;
        level3PrinterOpenMifa.value = false;
        level3CctvOpenMifa.value = false;
    }
    level3ScannerOpenMifa.value = !level3ScannerOpenMifa.value;
};

// toggle Mhu
const level1OpenMhu = ref(false);
const level2OpenMhu = ref(false);
const level2OpenAduanMhu = ref(false);
const level2OpenSettingMhu = ref(false);
const level2OpenInspeksiMhu = ref(false);
const level3OpenMhu = ref(false);
const level3KomputerOpenMhu = ref(false);
const level3PrinterOpenMhu = ref(false);
const level3ScannerOpenMhu = ref(false);
const level3CctvOpenMhu = ref(false);

// Load initial state from localStorage
onMounted(() => {
    level1OpenMhu.value = localStorage.getItem("level1OpenMhu") === "true";
    level2OpenMhu.value = localStorage.getItem("level2OpenMhu") === "true";
    level2OpenAduanMhu.value =
        localStorage.getItem("level2OpenAduanMhu") === "true";
    level2OpenSettingMhu.value =
        localStorage.getItem("level2OpenSettingMhu") === "true";
    level2OpenInspeksiMhu.value =
        localStorage.getItem("level2OpenInspeksiMhu") === "true";
    level3OpenMhu.value = localStorage.getItem("level3OpenMhu") === "true";
    level3PrinterOpenMhu.value =
        localStorage.getItem("level3PrinterOpenMhu") === "true";
    level3ScannerOpenMhu.value =
        localStorage.getItem("level3ScannerOpenMhu") === "true";
    level3KomputerOpenMhu.value =
        localStorage.getItem("level3KomputerOpenMhu") === "true";
    level3CctvOpenMhu.value =
        localStorage.getItem("level3CctvOpenMhu") === "true";
});

// Watch changes and save to localStorage
watch(
    [
        level1OpenMhu,
        level2OpenMhu,
        level2OpenSettingMhu,
        level2OpenInspeksiMhu,
        level2OpenAduanMhu,
        level3OpenMhu,
        level3PrinterOpenMhu,
        level3ScannerOpenMhu,
        level3KomputerOpenMhu,
        level3CctvOpenMhu,
    ],
    () => {
        localStorage.setItem("level1OpenMhu", level1OpenMhu.value);
        localStorage.setItem("level2OpenMhu", level2OpenMhu.value);
        localStorage.setItem("level2OpenAduanMhu", level2OpenAduanMhu.value);
        localStorage.setItem(
            "level2OpenSettingMhu",
            level2OpenSettingMhu.value
        );
        localStorage.setItem(
            "level2OpenInspeksiMhu",
            level2OpenInspeksiMhu.value
        );
        localStorage.setItem("level3OpenMhu", level3OpenMhu.value);
        localStorage.setItem(
            "level3KomputerOpenMhu",
            level3KomputerOpenMhu.value
        );
        localStorage.setItem(
            "level3PrinterOpenMhu",
            level3PrinterOpenMhu.value
        );
        localStorage.setItem(
            "level3ScannerOpenMhu",
            level3ScannerOpenMhu.value
        );
        localStorage.setItem("level3CctvOpenMhu", level3CctvOpenMhu.value);
    }
);

// Toggle functions for each level
const toggleLevel1Mhu = () => {
    level1OpenMhu.value = !level1OpenMhu.value;

    level1OpenHo.value = false;
    level2OpenHo.value = false;
    level2OpenSettingHo.value = false;
    level2OpenInspeksiHo.value = false;

    level1OpenBa.value = false;
    level2OpenBa.value = false;
    level2OpenSettingBa.value = false;
    level2OpenInspeksiBa.value = false;

    level1OpenBib.value = false;
    level2OpenBib.value = false;
    level2OpenSettingBib.value = false;
    level2OpenInspeksiBib.value = false;

    level1OpenMifa.value = false;
    level2OpenMifa.value = false;
    level2OpenSettingMifa.value = false;
    level2OpenInspeksiMifa.value = false;

    level1OpenAmi.value = false;
    level2OpenAmi.value = false;
    level2OpenSettingAmi.value = false;
    level2OpenInspeksiAmi.value = false;

    level1OpenWARA.value = false;
    level2OpenWARA.value = false;
    level2OpenSettingWARA.value = false;
    level2OpenInspeksiWARA.value = false;

    // Jika level1 ditutup, tutup juga level2
    if (!level1OpenMhu.value) {
        level2OpenMhu.value = false;
        level3OpenMhu.value = false;
        level3KomputerOpenMhu.value = false;
        level3PrinterOpenMhu.value = false;
        level3ScannerOpenMhu.value = false;
        level3CctvOpenMhu.value = false;
    }
};

const toggleLevel2Mhu = () => {
    console.log(level1OpenMhu.value);
    if (!level2OpenMhu.value) {
        level1OpenMhu.value = true; // pastikan level 1 terbuka jika level 2 dibuka
        level2OpenSettingMhu.value = false;
        level2OpenInspeksiMhu.value = false;
        level3OpenMhu.value = false;
        level3KomputerOpenMhu.value = false;
        level3PrinterOpenMhu.value = false;
        level3ScannerOpenMhu.value = false;
        level3CctvOpenMhu.value = false;
    }
    level2OpenMhu.value = !level2OpenMhu.value;
};

const toggleLevel2AduanMhu = () => {
    console.log(level1OpenMhu.value);
    if (!level2OpenAduanMhu.value) {
        level2OpenMhu.value = false; // pastikan level 1 terbuka jika level 2 dibuka
        level2OpenSettingMhu.value = false; // pastikan level 1 terbuka jika level 2 dibuka
        level2OpenInspeksiMhu.value = false; // pastikan level 1 terbuka jika level 2 dibuka
        level3OpenMhu.value = false;
        level3KomputerOpenMhu.value = false;
        level3PrinterOpenMhu.value = false;
        level3ScannerOpenMhu.value = false;
        level3CctvOpenMhu.value = false;
    }
    level2OpenAduanMhu.value = !level2OpenAduanMhu.value;
};

const toggleLevel2SettingMhu = () => {
    console.log(level1OpenMhu.value);
    if (!level2OpenSettingMhu.value) {
        level1OpenMhu.value = true; // pastikan level 1 terbuka jika level 2 dibuka
        level2OpenMhu.value = false; // pastikan level 1 terbuka jika level 2 dibuka
        level2OpenInspeksiMhu.value = false;
        level3OpenMhu.value = false;
        level3KomputerOpenMhu.value = false;
        level3PrinterOpenMhu.value = false;
        level3ScannerOpenMhu.value = false;
        level3CctvOpenMhu.value = false;
    }
    level2OpenSettingMhu.value = !level2OpenSettingMhu.value;
};

const toggleLevel2InspeksiMhu = () => {
    console.log(level1OpenMhu.value);
    if (!level2OpenInspeksiMhu.value) {
        level1OpenMhu.value = true; // pastikan level 1 terbuka jika level 2 dibuka
        level2OpenMhu.value = false; // pastikan level 1 terbuka jika level 2 dibuka
        level2OpenSettingMhu.value = false;
        level3OpenMhu.value = false;
        level3KomputerOpenMhu.value = false;
        level3PrinterOpenMhu.value = false;
        level3ScannerOpenMhu.value = false;
        level3CctvOpenMhu.value = false;
    }
    level2OpenInspeksiMhu.value = !level2OpenInspeksiMhu.value;
};

const toggleLevel3LaptopMhu = () => {
    if (!level3OpenMhu.value) {
        level2OpenMhu.value = true; // pastikan level 1 terbuka jika level 3 dibuka
        level3KomputerOpenMhu.value = false;
        level3PrinterOpenMhu.value = false;
        level3ScannerOpenMhu.value = false;
        level3CctvOpenMhu.value = false;
    }
    level3OpenMhu.value = !level3OpenMhu.value;
};

const toggleLevel3KomputerMhu = () => {
    if (!level3KomputerOpenMhu.value) {
        level2OpenMhu.value = true; // pastikan level 1 terbuka jika level 3 dibuka
        level3OpenMhu.value = false;
        level3PrinterOpenMhu.value = false;
        level3ScannerOpenMhu.value = false;
        level3CctvOpenMhu.value = false;
    }
    level3KomputerOpenMhu.value = !level3KomputerOpenMhu.value;
};

const toggleLevel3CctvMhu = () => {
    if (!level3CctvOpenMhu.value) {
        level2OpenMhu.value = true; // pastikan level 1 terbuka jika level 2 dibuka
        level3OpenMhu.value = false;
        level3KomputerOpenMhu.value = false;
        level3PrinterOpenMhu.value = false;
        level3ScannerOpenMhu.value = false;
    }
    level3CctvOpenMhu.value = !level3CctvOpenMhu.value;
};

const toggleLevel3PrinterMhu = () => {
    if (!level3PrinterOpenMhu.value) {
        level2OpenMhu.value = true; // pastikan level 1 terbuka jika level 2 dibuka
        level3OpenMhu.value = false;
        level3KomputerOpenMhu.value = false;
        level3ScannerOpenMhu.value = false;
        level3CctvOpenMhu.value = false;
    }
    level3PrinterOpenMhu.value = !level3PrinterOpenMhu.value;
};

const toggleLevel3ScannerMhu = () => {
    if (!level3ScannerOpenMhu.value) {
        level2OpenMhu.value = true; // pastikan level 1 terbuka jika level 2 dibuka
        level3OpenMhu.value = false;
        level3KomputerOpenMhu.value = false;
        level3PrinterOpenMhu.value = false;
        level3CctvOpenMhu.value = false;
    }
    level3ScannerOpenMhu.value = !level3ScannerOpenMhu.value;
};

// toggle WARA
const level1OpenWARA = ref(false);
const level2OpenWARA = ref(false);
const level2OpenAduanWARA = ref(false);
const level2OpenSettingWARA = ref(false);
const level2OpenInspeksiWARA = ref(false);
const level3OpenWARA = ref(false);
const level3KomputerOpenWARA = ref(false);
const level3PrinterOpenWARA = ref(false);
const level3ScannerOpenWARA = ref(false);
const level3CctvOpenWARA = ref(false);

// Load initial state from localStorage
onMounted(() => {
    level1OpenWARA.value = localStorage.getItem("level1OpenWARA") === "true";
    level2OpenWARA.value = localStorage.getItem("level2OpenWARA") === "true";
    level2OpenAduanWARA.value =
        localStorage.getItem("level2OpenAduanWARA") === "true";
    level2OpenSettingWARA.value =
        localStorage.getItem("level2OpenSettingWARA") === "true";
    level2OpenInspeksiWARA.value =
        localStorage.getItem("level2OpenInspeksiWARA") === "true";
    level3OpenWARA.value = localStorage.getItem("level3OpenWARA") === "true";
    level3PrinterOpenWARA.value =
        localStorage.getItem("level3PrinterOpenWARA") === "true";
    level3ScannerOpenWARA.value =
        localStorage.getItem("level3ScannerOpenWARA") === "true";
    level3KomputerOpenWARA.value =
        localStorage.getItem("level3KomputerOpenWARA") === "true";
    level3CctvOpenWARA.value =
        localStorage.getItem("level3CctvOpenWARA") === "true";
});

// Watch changes and save to localStorage
watch(
    [
        level1OpenWARA,
        level2OpenWARA,
        level2OpenSettingWARA,
        level2OpenInspeksiWARA,
        level2OpenAduanWARA,
        level3OpenWARA,
        level3PrinterOpenWARA,
        level3ScannerOpenWARA,
        level3KomputerOpenWARA,
        level3CctvOpenWARA,
    ],
    () => {
        localStorage.setItem("level1OpenWARA", level1OpenWARA.value);
        localStorage.setItem("level2OpenWARA", level2OpenWARA.value);
        localStorage.setItem("level2OpenAduanWARA", level2OpenAduanWARA.value);
        localStorage.setItem(
            "level2OpenSettingWARA",
            level2OpenSettingWARA.value
        );
        localStorage.setItem(
            "level2OpenInspeksiWARA",
            level2OpenInspeksiWARA.value
        );
        localStorage.setItem("level3OpenWARA", level3OpenWARA.value);
        localStorage.setItem(
            "level3KomputerOpenWARA",
            level3KomputerOpenWARA.value
        );
        localStorage.setItem(
            "level3PrinterOpenWARA",
            level3PrinterOpenWARA.value
        );
        localStorage.setItem(
            "level3ScannerOpenWARA",
            level3ScannerOpenWARA.value
        );
        localStorage.setItem("level3CctvOpenWARA", level3CctvOpenWARA.value);
    }
);

// Toggle functions for each level
const toggleLevel1WARA = () => {
    level1OpenWARA.value = !level1OpenWARA.value;

    level1OpenHo.value = false;
    level2OpenHo.value = false;
    level2OpenSettingHo.value = false;
    level2OpenInspeksiHo.value = false;

    level1OpenBa.value = false;
    level2OpenBa.value = false;
    level2OpenSettingBa.value = false;
    level2OpenInspeksiBa.value = false;

    level1OpenBib.value = false;
    level2OpenBib.value = false;
    level2OpenSettingBib.value = false;
    level2OpenInspeksiBib.value = false;

    level1OpenMifa.value = false;
    level2OpenMifa.value = false;
    level2OpenSettingMifa.value = false;
    level2OpenInspeksiMifa.value = false;

    level1OpenAmi.value = false;
    level2OpenAmi.value = false;
    level2OpenSettingAmi.value = false;
    level2OpenInspeksiAmi.value = false;

    level1OpenMhu.value = false;
    level2OpenMhu.value = false;
    level2OpenSettingMhu.value = false;
    level2OpenInspeksiMhu.value = false;

    // Jika level1 ditutup, tutup juga level2
    if (!level1OpenWARA.value) {
        level2OpenWARA.value = false;
        level3OpenWARA.value = false;
        level3KomputerOpenWARA.value = false;
        level3PrinterOpenWARA.value = false;
        level3ScannerOpenWARA.value = false;
        level3CctvOpenWARA.value = false;
    }
};

const toggleLevel2WARA = () => {
    console.log(level1OpenWARA.value);
    if (!level2OpenWARA.value) {
        level1OpenWARA.value = true; // pastikan level 1 terbuka jika level 2 dibuka
        level2OpenSettingWARA.value = false;
        level2OpenInspeksiWARA.value = false;
        level3OpenWARA.value = false;
        level3KomputerOpenWARA.value = false;
        level3PrinterOpenWARA.value = false;
        level3ScannerOpenWARA.value = false;
        level3CctvOpenWARA.value = false;
    }
    level2OpenWARA.value = !level2OpenWARA.value;
};

const toggleLevel2AduanWARA = () => {
    console.log(level1OpenWARA.value);
    if (!level2OpenAduanWARA.value) {
        level2OpenWARA.value = false; // pastikan level 1 terbuka jika level 2 dibuka
        level2OpenSettingWARA.value = false; // pastikan level 1 terbuka jika level 2 dibuka
        level2OpenInspeksiWARA.value = false; // pastikan level 1 terbuka jika level 2 dibuka
        level3OpenWARA.value = false;
        level3KomputerOpenWARA.value = false;
        level3PrinterOpenWARA.value = false;
        level3ScannerOpenWARA.value = false;
        level3CctvOpenWARA.value = false;
    }
    level2OpenAduanWARA.value = !level2OpenAduanWARA.value;
};

const toggleLevel2SettingWARA = () => {
    console.log(level1OpenWARA.value);
    if (!level2OpenSettingWARA.value) {
        level1OpenWARA.value = true; // pastikan level 1 terbuka jika level 2 dibuka
        level2OpenWARA.value = false; // pastikan level 1 terbuka jika level 2 dibuka
        level2OpenInspeksiWARA.value = false;
        level3OpenWARA.value = false;
        level3KomputerOpenWARA.value = false;
        level3PrinterOpenWARA.value = false;
        level3ScannerOpenWARA.value = false;
        level3CctvOpenWARA.value = false;
    }
    level2OpenSettingWARA.value = !level2OpenSettingWARA.value;
};

const toggleLevel2InspeksiWARA = () => {
    console.log(level1OpenWARA.value);
    if (!level2OpenInspeksiWARA.value) {
        level1OpenWARA.value = true; // pastikan level 1 terbuka jika level 2 dibuka
        level2OpenWARA.value = false; // pastikan level 1 terbuka jika level 2 dibuka
        level2OpenSettingWARA.value = false;
        level3OpenWARA.value = false;
        level3KomputerOpenWARA.value = false;
        level3PrinterOpenWARA.value = false;
        level3ScannerOpenWARA.value = false;
        level3CctvOpenWARA.value = false;
    }
    level2OpenInspeksiWARA.value = !level2OpenInspeksiWARA.value;
};

const toggleLevel3LaptopWARA = () => {
    if (!level3OpenWARA.value) {
        level2OpenWARA.value = true; // pastikan level 1 terbuka jika level 3 dibuka
        level3KomputerOpenWARA.value = false;
        level3PrinterOpenWARA.value = false;
        level3ScannerOpenWARA.value = false;
        level3CctvOpenWARA.value = false;
    }
    level3OpenWARA.value = !level3OpenWARA.value;
};

const toggleLevel3KomputerWARA = () => {
    if (!level3KomputerOpenWARA.value) {
        level2OpenWARA.value = true; // pastikan level 1 terbuka jika level 3 dibuka
        level3OpenWARA.value = false;
        level3PrinterOpenWARA.value = false;
        level3ScannerOpenWARA.value = false;
        level3CctvOpenWARA.value = false;
    }
    level3KomputerOpenWARA.value = !level3KomputerOpenWARA.value;
};

const toggleLevel3CctvWARA = () => {
    if (!level3CctvOpenWARA.value) {
        level2OpenWARA.value = true; // pastikan level 1 terbuka jika level 2 dibuka
        level3OpenWARA.value = false;
        level3KomputerOpenWARA.value = false;
        level3PrinterOpenWARA.value = false;
        level3ScannerOpenWARA.value = false;
    }
    level3CctvOpenWARA.value = !level3CctvOpenWARA.value;
};

const toggleLevel3PrinterWARA = () => {
    if (!level3PrinterOpenWARA.value) {
        level2OpenWARA.value = true; // pastikan level 1 terbuka jika level 2 dibuka
        level3OpenWARA.value = false;
        level3KomputerOpenWARA.value = false;
        level3ScannerOpenWARA.value = false;
        level3CctvOpenWARA.value = false;
    }
    level3PrinterOpenWARA.value = !level3PrinterOpenWARA.value;
};

const toggleLevel3ScannerWARA = () => {
    if (!level3ScannerOpenWARA.value) {
        level2OpenWARA.value = true; // pastikan level 1 terbuka jika level 2 dibuka
        level3OpenWARA.value = false;
        level3KomputerOpenWARA.value = false;
        level3PrinterOpenWARA.value = false;
        level3CctvOpenWARA.value = false;
    }
    level3ScannerOpenWARA.value = !level3ScannerOpenWARA.value;
};

// toggle BIB
const level1OpenBib = ref(false);
const level2OpenBib = ref(false);
const level2OpenAduanBib = ref(false);
const level2OpenSettingBib = ref(false);
const level2OpenInspeksiBib = ref(false);
const level3OpenBib = ref(false);
const level3KomputerOpenBib = ref(false);
const level3PrinterOpenBib = ref(false);
const level3ScannerOpenBib = ref(false);
const level3CctvOpenBib = ref(false);

// Load initial state from localStorage
onMounted(() => {
    level1OpenBib.value = localStorage.getItem("level1OpenBib") === "true";
    level2OpenBib.value = localStorage.getItem("level2OpenBib") === "true";
    level2OpenAduanBib.value =
        localStorage.getItem("level2OpenAduanBib") === "true";
    level2OpenSettingBib.value =
        localStorage.getItem("level2OpenSettingBib") === "true";
    level2OpenInspeksiBib.value =
        localStorage.getItem("level2OpenInspeksiBib") === "true";
    level3OpenBib.value = localStorage.getItem("level3OpenBib") === "true";
    level3PrinterOpenBib.value =
        localStorage.getItem("level3PrinterOpenBib") === "true";
    level3ScannerOpenBib.value =
        localStorage.getItem("level3ScannerOpenBib") === "true";
    level3KomputerOpenBib.value =
        localStorage.getItem("level3KomputerOpenBib") === "true";
    level3CctvOpenBib.value =
        localStorage.getItem("level3CctvOpenBib") === "true";
});

// Watch changes and save to localStorage
watch(
    [
        level1OpenBib,
        level2OpenBib,
        level2OpenSettingBib,
        level2OpenInspeksiBib,
        level2OpenAduanBib,
        level3OpenBib,
        level3PrinterOpenBib,
        level3ScannerOpenBib,
        level3KomputerOpenBib,
        level3CctvOpenBib,
    ],
    () => {
        localStorage.setItem("level1OpenBib", level1OpenBib.value);
        localStorage.setItem("level2OpenBib", level2OpenBib.value);
        localStorage.setItem("level2OpenAduanBib", level2OpenAduanBib.value);
        localStorage.setItem(
            "level2OpenSettingBib",
            level2OpenSettingBib.value
        );
        localStorage.setItem(
            "level2OpenInspeksiBib",
            level2OpenInspeksiBib.value
        );
        localStorage.setItem("level3OpenBib", level3OpenBib.value);
        localStorage.setItem(
            "level3KomputerOpenBib",
            level3KomputerOpenBib.value
        );
        localStorage.setItem(
            "level3PrinterOpenBib",
            level3PrinterOpenBib.value
        );
        localStorage.setItem(
            "level3ScannerOpenBib",
            level3ScannerOpenBib.value
        );
        localStorage.setItem("level3CctvOpenBib", level3CctvOpenBib.value);
    }
);

// Toggle functions for each level
const toggleLevel1Bib = () => {
    level1OpenBib.value = !level1OpenBib.value;

    level1OpenHo.value = false;
    level2OpenHo.value = false;
    level2OpenSettingHo.value = false;
    level2OpenInspeksiHo.value = false;

    level1OpenBa.value = false;
    level2OpenBa.value = false;
    level2OpenSettingBa.value = false;
    level2OpenInspeksiBa.value = false;

    level1OpenMifa.value = false;
    level2OpenMifa.value = false;
    level2OpenSettingMifa.value = false;
    level2OpenInspeksiMifa.value = false;

    level1OpenMhu.value = false;
    level2OpenMhu.value = false;
    level2OpenSettingMhu.value = false;
    level2OpenInspeksiMhu.value = false;

    level1OpenWARA.value = false;
    level2OpenWARA.value = false;
    level2OpenSettingWARA.value = false;
    level2OpenInspeksiWARA.value = false;

    level1OpenAmi.value = false;
    level2OpenAmi.value = false;
    level2OpenSettingAmi.value = false;
    level2OpenInspeksiAmi.value = false;

    // Jika level1 ditutup, tutup juga level2
    if (!level1OpenBib.value) {
        level2OpenBib.value = false;
        level3OpenBib.value = false;
        level3KomputerOpenBib.value = false;
        level3PrinterOpenBib.value = false;
        level3ScannerOpenBib.value = false;
        level3CctvOpenBib.value = false;
    }
};

const toggleLevel2Bib = () => {
    console.log(level1OpenBib.value);
    if (!level2OpenBib.value) {
        level1OpenBib.value = true; // pastikan level 1 terbuka jika level 2 dibuka
        level2OpenSettingBib.value = false;
        level2OpenInspeksiBib.value = false;
        level3OpenBib.value = false;
        level3KomputerOpenBib.value = false;
        level3PrinterOpenBib.value = false;
        level3ScannerOpenBib.value = false;
        level3CctvOpenBib.value = false;
    }
    level2OpenBib.value = !level2OpenBib.value;
};

const toggleLevel2AduanBib = () => {
    console.log(level1OpenBib.value);
    if (!level2OpenAduanBib.value) {
        level2OpenBib.value = false; // pastikan level 1 terbuka jika level 2 dibuka
        level2OpenSettingBib.value = false; // pastikan level 1 terbuka jika level 2 dibuka
        level2OpenInspeksiBib.value = false; // pastikan level 1 terbuka jika level 2 dibuka
        level3OpenBib.value = false;
        level3KomputerOpenBib.value = false;
        level3PrinterOpenBib.value = false;
        level3ScannerOpenBib.value = false;
        level3CctvOpenBib.value = false;
    }
    level2OpenAduanBib.value = !level2OpenAduanBib.value;
};

const toggleLevel2SettingBib = () => {
    console.log(level1OpenBib.value);
    if (!level2OpenSettingBib.value) {
        level1OpenBib.value = true; // pastikan level 1 terbuka jika level 2 dibuka
        level2OpenBib.value = false; // pastikan level 1 terbuka jika level 2 dibuka
        level2OpenInspeksiBib.value = false;
        level3OpenBib.value = false;
        level3KomputerOpenBib.value = false;
        level3PrinterOpenBib.value = false;
        level3ScannerOpenBib.value = false;
        level3CctvOpenBib.value = false;
    }
    level2OpenSettingBib.value = !level2OpenSettingBib.value;
};

const toggleLevel2InspeksiBib = () => {
    console.log(level1OpenBib.value);
    if (!level2OpenInspeksiBib.value) {
        level1OpenBib.value = true; // pastikan level 1 terbuka jika level 2 dibuka
        level2OpenBib.value = false; // pastikan level 1 terbuka jika level 2 dibuka
        level2OpenSettingBib.value = false;
        level3OpenBib.value = false;
        level3KomputerOpenBib.value = false;
        level3PrinterOpenBib.value = false;
        level3ScannerOpenBib.value = false;
        level3CctvOpenBib.value = false;
    }
    level2OpenInspeksiBib.value = !level2OpenInspeksiBib.value;
};

const toggleLevel3LaptopBib = () => {
    if (!level3OpenBib.value) {
        level2OpenBib.value = true; // pastikan level 1 terbuka jika level 3 dibuka
        level3KomputerOpenBib.value = false;
        level3PrinterOpenBib.value = false;
        level3ScannerOpenBib.value = false;
        level3CctvOpenBib.value = false;
    }
    level3OpenBib.value = !level3OpenBib.value;
};

const toggleLevel3KomputerBib = () => {
    if (!level3KomputerOpenBib.value) {
        level2OpenBib.value = true; // pastikan level 1 terbuka jika level 3 dibuka
        level3OpenBib.value = false;
        level3PrinterOpenBib.value = false;
        level3ScannerOpenBib.value = false;
        level3CctvOpenBib.value = false;
    }
    level3KomputerOpenBib.value = !level3KomputerOpenBib.value;
};

const toggleLevel3CctvBib = () => {
    if (!level3CctvOpenBib.value) {
        level2OpenBib.value = true; // pastikan level 1 terbuka jika level 2 dibuka
        level3OpenBib.value = false;
        level3KomputerOpenBib.value = false;
        level3PrinterOpenBib.value = false;
        level3ScannerOpenBib.value = false;
    }
    level3CctvOpenBib.value = !level3CctvOpenBib.value;
};

const toggleLevel3PrinterBib = () => {
    if (!level3PrinterOpenBib.value) {
        level2OpenBib.value = true; // pastikan level 1 terbuka jika level 2 dibuka
        level3OpenBib.value = false;
        level3KomputerOpenBib.value = false;
        level3ScannerOpenBib.value = false;
        level3CctvOpenBib.value = false;
    }
    level3PrinterOpenBib.value = !level3PrinterOpenBib.value;
};

const toggleLevel3ScannerBib = () => {
    if (!level3ScannerOpenBib.value) {
        level2OpenBib.value = true; // pastikan level 1 terbuka jika level 2 dibuka
        level3OpenBib.value = false;
        level3KomputerOpenBib.value = false;
        level3PrinterOpenBib.value = false;
        level3CctvOpenBib.value = false;
    }
    level3ScannerOpenBib.value = !level3ScannerOpenBib.value;
};

// toggle Ami
const level1OpenAmi = ref(false);
const level2OpenAmi = ref(false);
const level2OpenAduanAmi = ref(false);
const level2OpenSettingAmi = ref(false);
const level2OpenInspeksiAmi = ref(false);
const level3OpenAmi = ref(false);
const level3KomputerOpenAmi = ref(false);
const level3PrinterOpenAmi = ref(false);
const level3ScannerOpenAmi = ref(false);
const level3CctvOpenAmi = ref(false);

// Load initial state from localStorage
onMounted(() => {
    level1OpenAmi.value = localStorage.getItem("level1OpenAmi") === "true";
    level2OpenAmi.value = localStorage.getItem("level2OpenAmi") === "true";
    level2OpenAduanAmi.value =
        localStorage.getItem("level2OpenAduanAmi") === "true";
    level2OpenSettingAmi.value =
        localStorage.getItem("level2OpenSettingAmi") === "true";
    level2OpenInspeksiAmi.value =
        localStorage.getItem("level2OpenInspeksiAmi") === "true";
    level3OpenAmi.value = localStorage.getItem("level3OpenAmi") === "true";
    level3PrinterOpenAmi.value =
        localStorage.getItem("level3PrinterOpenAmi") === "true";
    level3ScannerOpenAmi.value =
        localStorage.getItem("level3ScannerOpenAmi") === "true";
    level3KomputerOpenAmi.value =
        localStorage.getItem("level3KomputerOpenAmi") === "true";
    level3CctvOpenAmi.value =
        localStorage.getItem("level3CctvOpenAmi") === "true";
});

// Watch changes and save to localStorage
watch(
    [
        level1OpenAmi,
        level2OpenAmi,
        level2OpenSettingAmi,
        level2OpenInspeksiAmi,
        level2OpenAduanAmi,
        level3OpenAmi,
        level3PrinterOpenAmi,
        level3ScannerOpenAmi,
        level3KomputerOpenAmi,
        level3CctvOpenAmi,
    ],
    () => {
        localStorage.setItem("level1OpenAmi", level1OpenAmi.value);
        localStorage.setItem("level2OpenAmi", level2OpenAmi.value);
        localStorage.setItem("level2OpenAduanAmi", level2OpenAduanAmi.value);
        localStorage.setItem(
            "level2OpenSettingAmi",
            level2OpenSettingAmi.value
        );
        localStorage.setItem(
            "level2OpenInspeksiAmi",
            level2OpenInspeksiAmi.value
        );
        localStorage.setItem("level3OpenAmi", level3OpenAmi.value);
        localStorage.setItem(
            "level3KomputerOpenAmi",
            level3KomputerOpenAmi.value
        );
        localStorage.setItem(
            "level3PrinterOpenAmi",
            level3PrinterOpenAmi.value
        );
        localStorage.setItem(
            "level3ScannerOpenAmi",
            level3ScannerOpenAmi.value
        );
        localStorage.setItem("level3CctvOpenAmi", level3CctvOpenAmi.value);
    }
);

// Toggle functions for each level
const toggleLevel1Ami = () => {
    level1OpenAmi.value = !level1OpenAmi.value;

    level1OpenHo.value = false;
    level2OpenHo.value = false;
    level2OpenSettingHo.value = false;
    level2OpenInspeksiHo.value = false;

    level1OpenBa.value = false;
    level2OpenBa.value = false;
    level2OpenSettingBa.value = false;
    level2OpenInspeksiBa.value = false;

    level1OpenBib.value = false;
    level2OpenBib.value = false;
    level2OpenSettingBib.value = false;
    level2OpenInspeksiBib.value = false;

    level1OpenMifa.value = false;
    level2OpenMifa.value = false;
    level2OpenSettingMifa.value = false;
    level2OpenInspeksiMifa.value = false;

    level1OpenMhu.value = false;
    level2OpenMhu.value = false;
    level2OpenSettingMhu.value = false;
    level2OpenInspeksiMhu.value = false;

    level1OpenWARA.value = false;
    level2OpenWARA.value = false;
    level2OpenSettingWARA.value = false;
    level2OpenInspeksiWARA.value = false;

    // Jika level1 ditutup, tutup juga level2
    if (!level1OpenAmi.value) {
        level2OpenAmi.value = false;
        level3OpenAmi.value = false;
        level3KomputerOpenAmi.value = false;
        level3PrinterOpenAmi.value = false;
        level3ScannerOpenAmi.value = false;
        level3CctvOpenAmi.value = false;
    }
};

const toggleLevel2Ami = () => {
    console.log(level1OpenAmi.value);
    if (!level2OpenAmi.value) {
        level1OpenAmi.value = true; // pastikan level 1 terbuka jika level 2 dibuka
        level2OpenSettingAmi.value = false;
        level2OpenInspeksiAmi.value = false;
        level3OpenAmi.value = false;
        level3KomputerOpenAmi.value = false;
        level3PrinterOpenAmi.value = false;
        level3ScannerOpenAmi.value = false;
        level3CctvOpenAmi.value = false;
    }
    level2OpenAmi.value = !level2OpenAmi.value;
};

const toggleLevel2AduanAmi = () => {
    console.log(level1OpenAmi.value);
    if (!level2OpenAduanAmi.value) {
        level2OpenAmi.value = false; // pastikan level 1 terbuka jika level 2 dibuka
        level2OpenSettingAmi.value = false; // pastikan level 1 terbuka jika level 2 dibuka
        level2OpenInspeksiAmi.value = false; // pastikan level 1 terbuka jika level 2 dibuka
        level3OpenAmi.value = false;
        level3KomputerOpenAmi.value = false;
        level3PrinterOpenAmi.value = false;
        level3ScannerOpenAmi.value = false;
        level3CctvOpenAmi.value = false;
    }
    level2OpenAduanAmi.value = !level2OpenAduanAmi.value;
};

const toggleLevel2SettingAmi = () => {
    console.log(level1OpenAmi.value);
    if (!level2OpenSettingAmi.value) {
        level1OpenAmi.value = true; // pastikan level 1 terbuka jika level 2 dibuka
        level2OpenAmi.value = false; // pastikan level 1 terbuka jika level 2 dibuka
        level2OpenInspeksiAmi.value = false;
        level3OpenAmi.value = false;
        level3KomputerOpenAmi.value = false;
        level3PrinterOpenAmi.value = false;
        level3ScannerOpenAmi.value = false;
        level3CctvOpenAmi.value = false;
    }
    level2OpenSettingAmi.value = !level2OpenSettingAmi.value;
};

const toggleLevel2InspeksiAmi = () => {
    console.log(level1OpenAmi.value);
    if (!level2OpenInspeksiAmi.value) {
        level1OpenAmi.value = true; // pastikan level 1 terbuka jika level 2 dibuka
        level2OpenAmi.value = false; // pastikan level 1 terbuka jika level 2 dibuka
        level2OpenSettingAmi.value = false;
        level3OpenAmi.value = false;
        level3KomputerOpenAmi.value = false;
        level3PrinterOpenAmi.value = false;
        level3ScannerOpenAmi.value = false;
        level3CctvOpenAmi.value = false;
    }
    level2OpenInspeksiAmi.value = !level2OpenInspeksiAmi.value;
};

const toggleLevel3LaptopAmi = () => {
    if (!level3OpenAmi.value) {
        level2OpenAmi.value = true; // pastikan level 1 terbuka jika level 3 dibuka
        level3KomputerOpenAmi.value = false;
        level3PrinterOpenAmi.value = false;
        level3ScannerOpenAmi.value = false;
        level3CctvOpenAmi.value = false;
    }
    level3OpenAmi.value = !level3OpenAmi.value;
};

const toggleLevel3KomputerAmi = () => {
    if (!level3KomputerOpenAmi.value) {
        level2OpenAmi.value = true; // pastikan level 1 terbuka jika level 3 dibuka
        level3OpenAmi.value = false;
        level3PrinterOpenAmi.value = false;
        level3ScannerOpenAmi.value = false;
        level3CctvOpenAmi.value = false;
    }
    level3KomputerOpenAmi.value = !level3KomputerOpenAmi.value;
};

const toggleLevel3CctvAmi = () => {
    if (!level3CctvOpenAmi.value) {
        level2OpenAmi.value = true; // pastikan level 1 terbuka jika level 2 dibuka
        level3OpenAmi.value = false;
        level3KomputerOpenAmi.value = false;
        level3PrinterOpenAmi.value = false;
        level3ScannerOpenAmi.value = false;
    }
    level3CctvOpenAmi.value = !level3CctvOpenAmi.value;
};

const toggleLevel3PrinterAmi = () => {
    if (!level3PrinterOpenAmi.value) {
        level2OpenAmi.value = true; // pastikan level 1 terbuka jika level 2 dibuka
        level3OpenAmi.value = false;
        level3KomputerOpenAmi.value = false;
        level3ScannerOpenAmi.value = false;
        level3CctvOpenAmi.value = false;
    }
    level3PrinterOpenAmi.value = !level3PrinterOpenAmi.value;
};

const toggleLevel3ScannerAmi = () => {
    if (!level3ScannerOpenAmi.value) {
        level2OpenAmi.value = true; // pastikan level 1 terbuka jika level 2 dibuka
        level3OpenAmi.value = false;
        level3KomputerOpenAmi.value = false;
        level3PrinterOpenAmi.value = false;
        level3CctvOpenAmi.value = false;
    }
    level3ScannerOpenAmi.value = !level3ScannerOpenAmi.value;
};
</script>

<template>
    <!-- sidenav  -->
    <aside
        class="fixed inset-y-0 flex-wrap items-center justify-between block w-full p-0 my-8 antialiased transition-transform duration-200 -translate-x-full bg-white border-0 shadow-xl dark:shadow-none dark:bg-slate-850 max-w-64 ease-nav-brand z-990 xl:ml-6 rounded-2xl xl:left-0 xl:translate-x-0"
        aria-expanded="false"
        :class="classes"
    >
        <PerfectScrollbar>
            <div class="h-19">
                <i
                    class="absolute top-0 right-0 p-4 opacity-50 cursor-pointer fas fa-times dark:text-white text-slate-400 xl:hidden"
                    @click="handleSidebarClose"
                ></i>
                <div
                    class="block px-8 py-6 m-0 text-sm whitespace-nowrap dark:text-white text-slate-700"
                >
                    <img
                        src="/assets/img/logoppa.png"
                        class="inline transition-all duration-200 ease-nav-brand max-h-8 mr-2"
                        alt="main_logo"
                    />
                    <span
                        class="ml-1 font-semibold transition-all duration-200 ease-nav-brand"
                        >ICT - PPA INVENTORY</span
                    >
                </div>
            </div>

            <hr
                class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent"
            />

            <div class="items-center block w-auto max-h-screen grow basis-full">
                <ul class="flex flex-col pl-0 mb-0 pb-10">
                    <li
                        v-if="
                            $page.props.auth.user.role === 'ict_developer' ||
                            $page.props.auth.user.role === 'ict_bod' ||
                            $page.props.auth.user.role === 'ict_ho' ||
                            $page.props.auth.user.role === 'ict_section_head'
                        "
                        class="mt-0.5 w-full"
                    >
                        <NavLink
                            :href="route('developerDashboard')"
                            :active="route().current('developerDashboard')"
                        >
                            <div
                                class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                            >
                                <i
                                    class="relative top-0 text-sm leading-normal text-gray-600 ni ni-tv-2"
                                ></i>
                            </div>
                            <span
                                class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                >Dashboard</span
                            >
                        </NavLink>
                    </li>
                    <li
                        v-if="$page.props.auth.user.role === 'ict_group_leader'"
                        class="mt-0.5 w-full"
                    >
                        <NavLink
                            :href="route('groupLeaderDashboard')"
                            :active="route().current('groupLeaderDashboard')"
                        >
                            <div
                                class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                            >
                                <i
                                    class="relative top-0 text-sm leading-normal text-gray-600 ni ni-tv-2"
                                ></i>
                            </div>
                            <span
                                class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                >Dashboard</span
                            >
                        </NavLink>
                    </li>
                    <li
                        v-if="$page.props.auth.user.role === 'ict_section'"
                        class="mt-0.5 w-full"
                    >
                        <NavLink :href="route('sectionDashboard')">
                            <div
                                class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                            >
                                <i
                                    class="relative top-0 text-sm leading-normal text-gray-600 ni ni-tv-2"
                                ></i>
                            </div>
                            <span
                                class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                >Dashboard</span
                            >
                        </NavLink>
                    </li>
                    <li
                        v-if="$page.props.auth.user.role === 'ict_technician'"
                        class="mt-0.5 w-full"
                    >
                        <NavLink :href="route('technicianDashboard')">
                            <div
                                class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                            >
                                <i
                                    class="relative top-0 text-sm leading-normal text-gray-600 ni ni-tv-2"
                                ></i>
                            </div>
                            <span
                                class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                >Dashboard</span
                            >
                        </NavLink>
                    </li>
                    <li
                        v-if="$page.props.auth.user.role === 'ict_admin'"
                        class="mt-0.5 w-full"
                    >
                        <NavLink :href="route('adminDashboard')">
                            <div
                                class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                            >
                                <i
                                    class="relative top-0 text-sm leading-normal text-gray-600 ni ni-tv-2"
                                ></i>
                            </div>
                            <span
                                class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                >Dashboard</span
                            >
                        </NavLink>
                    </li>

                    <li class="mt-0.5 w-full">
                        <div
                            v-if="
                                $page.props.auth.user.role === 'ict_developer'
                            "
                            @click="toggleLevel2SettingHo"
                            style="cursor: pointer"
                            class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                        >
                            <div
                                class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                            >
                                <i
                                    class="relative top-0 text-sm leading-normal text-red-700 fas fa-cogs"
                                ></i>
                            </div>
                            <span
                                class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                >Setting</span
                            >
                            <i
                                v-if="!level2OpenSettingHo"
                                class="ms-3 fas fa-angle-right"
                            ></i>
                            <i v-else class="ms-3 fas fa-angle-down"></i>
                        </div>
                        <ul v-if="level2OpenSettingHo">
                            <NavLink
                                v-if="
                                    $page.props.auth.user.role ===
                                    'ict_developer'
                                "
                                :href="route('pengguna.page')"
                                :active="route().current('pengguna.page')"
                            >
                                <div
                                    class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                >
                                    <i
                                        class="relative top-0 text-sm leading-normal text-red-800 fas fa-users"
                                    ></i>
                                </div>
                                <span
                                    class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                    >Setting Pengguna</span
                                >
                            </NavLink>

                            <NavLink
                                v-if="
                                    $page.props.auth.user.role ===
                                    'ict_developer'
                                "
                                :href="route('department.page')"
                                :active="route().current('department.page')"
                            >
                                <div
                                    class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                >
                                    <i
                                        class="relative top-0 text-sm leading-normal text-red-800 fas fa-cog"
                                    ></i>
                                </div>
                                <span
                                    class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                    >Setting Department</span
                                >
                            </NavLink>

                            <NavLink
                                v-if="
                                    $page.props.auth.user.role ===
                                    'ict_developer'
                                "
                                :href="route('akses.page')"
                                :active="route().current('akses.page')"
                            >
                                <div
                                    class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                >
                                    <i
                                        class="relative top-0 text-sm leading-normal text-red-800 fas fa-user-tag"
                                    ></i>
                                </div>
                                <span
                                    class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                    >Pengajuan Akses Role</span
                                >
                            </NavLink>
                        </ul>
                    </li>

                    <hr
                        v-if="
                            $page.props.auth.user.role == 'ict_developer' ||
                            $page.props.auth.user.site == 'HO'
                        "
                        class="h-px mt-3 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent"
                    />
                    <!-- start HO -->
                    <li
                        v-if="
                            $page.props.auth.user.role == 'ict_developer' ||
                            $page.props.auth.user.site == 'HO'
                        "
                    >
                        <div
                            @click="toggleLevel1Ho"
                            style="cursor: pointer"
                            class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                        >
                            <div
                                class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                            >
                                <i
                                    class="relative top-0 text-sm leading-normal text-red-700 fas fa-gem"
                                ></i>
                            </div>
                            <span
                                v-if="$page.props.auth.user.site == 'HO'"
                                class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                >Head Office PPA</span
                            >
                            <span
                                v-if="$page.props.auth.user.site != 'HO'"
                                class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                >ICT - PPA HO</span
                            >
                            <i
                                v-if="!level1OpenHo"
                                class="ms-3 fas fa-angle-right"
                            ></i>
                            <i v-else class="ms-3 fas fa-angle-down"></i>
                        </div>
                        <ul v-if="level1OpenHo">
                            <li>
                                <NavLink
                                    @click="toggleLevel2AduanHo"
                                    :href="route('aduan.page')"
                                    :active="route().current('aduan.page')"
                                >
                                    <div
                                        class="ml-4 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                    >
                                        <i
                                            class="relative top-0 text-sm leading-normal text-red-800 fas fa-comments"
                                        ></i>
                                    </div>
                                    <span
                                        class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                        >Aduan</span
                                    >
                                </NavLink>

                                <div
                                    v-if="
                                        $page.props.auth.user.role != 'soc_ho'
                                    "
                                    @click="toggleLevel2Ho"
                                    style="cursor: pointer"
                                    class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                >
                                    <div
                                        class="ml-4 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                    >
                                        <i
                                            class="relative top-0 text-sm leading-normal text-red-700 fas fa-dolly-flatbed"
                                        ></i>
                                    </div>
                                    <span
                                        class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                        >Inventory</span
                                    >
                                    <i
                                        v-if="!level2OpenHo"
                                        class="ms-3 fas fa-angle-right"
                                    ></i>
                                    <i
                                        v-else
                                        class="ms-3 fas fa-angle-down"
                                    ></i>
                                </div>
                                <ul v-if="level2OpenHo">
                                    <NavLink
                                        :href="route('accessPoint.page')"
                                        :active="
                                            route().current('accessPoint.page')
                                        "
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-800 fas fa-ethernet"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Access Point</span
                                        >
                                    </NavLink>
                                    <NavLink
                                        :href="route('switch.page')"
                                        :active="route().current('switch.page')"
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-800 fas fa-project-diagram"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Switch</span
                                        >
                                    </NavLink>
                                    <NavLink
                                        :href="route('wirelless.page')"
                                        :active="
                                            route().current('wirelless.page')
                                        "
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-800 fas fa-wifi"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Wirelless</span
                                        >
                                    </NavLink>
                                    <div
                                        @click="toggleLevel3LaptopHo"
                                        style="cursor: pointer"
                                        class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-700 fas fa-laptop"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Laptop</span
                                        >
                                        <i
                                            v-if="!level3OpenHo"
                                            class="ms-3 fas fa-angle-right"
                                        ></i>
                                        <i
                                            v-else
                                            class="ms-3 fas fa-angle-down"
                                        ></i>
                                    </div>
                                    <li v-if="level3OpenHo">
                                        <NavLink
                                            :href="route('laptop.page')"
                                            :active="
                                                route().current('laptop.page')
                                            "
                                        >
                                            <div
                                                class="ml-12 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                            >
                                                <i
                                                    class="relative top-0 text-sm leading-normal text-red-800 fas fa-laptop-code"
                                                ></i>
                                            </div>
                                            <span
                                                class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                                >Laptop Fixed</span
                                            >
                                        </NavLink>
                                    </li>

                                    <div
                                        @click="toggleLevel3KomputerHo"
                                        style="cursor: pointer"
                                        class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-700 fas fa-tv"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Komputer</span
                                        >
                                        <i
                                            v-if="!level3KomputerOpenHo"
                                            class="ms-3 fas fa-angle-right"
                                        ></i>
                                        <i
                                            v-else
                                            class="ms-3 fas fa-angle-down"
                                        ></i>
                                    </div>
                                    <li v-if="level3KomputerOpenHo">
                                        <NavLink
                                            :href="route('komputer.page')"
                                            :active="
                                                route().current('komputer.page')
                                            "
                                        >
                                            <div
                                                class="ml-12 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                            >
                                                <i
                                                    class="relative top-0 text-sm leading-normal text-red-800 fas fa-desktop"
                                                ></i>
                                            </div>
                                            <span
                                                class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                                >Komputer Fixed</span
                                            >
                                        </NavLink>
                                    </li>

                                    <div
                                        @click="toggleLevel3PrinterHo"
                                        style="cursor: pointer"
                                        class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-700 fas fa-print"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Printer</span
                                        >
                                        <i
                                            v-if="!level3PrinterOpenHo"
                                            class="ms-3 fas fa-angle-right"
                                        ></i>
                                        <i
                                            v-else
                                            class="ms-3 fas fa-angle-down"
                                        ></i>
                                    </div>
                                    <li v-if="level3PrinterOpenHo">
                                        <NavLink
                                            :href="route('printer.page')"
                                            :active="
                                                route().current('printer.page')
                                            "
                                        >
                                            <div
                                                class="ml-12 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                            >
                                                <i
                                                    class="relative top-0 text-sm leading-normal text-red-800 fas fa-print"
                                                ></i>
                                            </div>
                                            <span
                                                class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                                >Printer Fixed</span
                                            >
                                        </NavLink>
                                    </li>

                                    <div
                                        @click="toggleLevel3ScannerHo"
                                        style="cursor: pointer"
                                        class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-700 fas fa-print"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Scanner</span
                                        >
                                        <i
                                            v-if="!level3ScannerOpenHo"
                                            class="ms-3 fas fa-angle-right"
                                        ></i>
                                        <i
                                            v-else
                                            class="ms-3 fas fa-angle-down"
                                        ></i>
                                    </div>
                                    <li v-if="level3ScannerOpenHo">
                                        <NavLink
                                            :href="route('scanner.page')"
                                            :active="
                                                route().current('scanner.page')
                                            "
                                        >
                                            <div
                                                class="ml-12 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                            >
                                                <i
                                                    class="relative top-0 text-sm leading-normal text-red-800 fas fa-print"
                                                ></i>
                                            </div>
                                            <span
                                                class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                                >Data Scanner</span
                                            >
                                        </NavLink>
                                    </li>

                                    <div
                                        @click="toggleLevel3CctvHo"
                                        style="cursor: pointer"
                                        class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-700 fas fa-camera-retro"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Cctv</span
                                        >
                                        <i
                                            v-if="!level3CctvOpenHo"
                                            class="ms-3 fas fa-angle-right"
                                        ></i>
                                        <i
                                            v-else
                                            class="ms-3 fas fa-angle-down"
                                        ></i>
                                    </div>
                                    <li v-if="level3CctvOpenHo">
                                        <NavLink
                                            :href="route('cctv.page')"
                                            :active="
                                                route().current('cctv.page')
                                            "
                                        >
                                            <div
                                                class="ml-12 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                            >
                                                <i
                                                    class="relative top-0 text-sm leading-normal text-red-800 fas fa-video"
                                                ></i>
                                            </div>
                                            <span
                                                class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                                >Data Cctv</span
                                            >
                                        </NavLink>
                                    </li>
                                </ul>

                                <div
                                    v-if="
                                        $page.props.auth.user.role != 'soc_ho'
                                    "
                                    @click="toggleLevel2InspeksiHo"
                                    style="cursor: pointer"
                                    class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                >
                                    <div
                                        class="ml-4 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                    >
                                        <i
                                            class="relative top-0 text-sm leading-normal text-red-700 fas fa-clipboard-list"
                                        ></i>
                                    </div>
                                    <span
                                        class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                        >Inspeksi</span
                                    >
                                    <i
                                        v-if="!level2OpenInspeksiHo"
                                        class="ms-3 fas fa-angle-right"
                                    ></i>
                                    <i
                                        v-else
                                        class="ms-3 fas fa-angle-down"
                                    ></i>
                                </div>
                                <ul v-if="level2OpenInspeksiHo">
                                    <NavLink
                                        :href="route('inspeksiLaptop.page')"
                                        :active="
                                            route().current(
                                                'inspeksiLaptop.page'
                                            )
                                        "
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-800 fas fa-laptop-medical"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Inspeksi Laptop</span
                                        >
                                    </NavLink>

                                    <NavLink
                                        :href="route('inspeksiKomputer.page')"
                                        :active="
                                            route().current(
                                                'inspeksiKomputer.page'
                                            )
                                        "
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-800 fas fa-desktop"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Inspeksi Komputer</span
                                        >
                                    </NavLink>
                                </ul>

                                <!-- <div
                                    v-if="
                                        $page.props.auth.user.role ===
                                        'ict_developer'
                                    "
                                    @click="toggleLevel2SettingHo"
                                    style="cursor: pointer"
                                    class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                >
                                    <div
                                        class="ml-4 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                    >
                                        <i
                                            class="relative top-0 text-sm leading-normal text-red-700 fas fa-cogs"
                                        ></i>
                                    </div>
                                    <span
                                        class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                        >Setting</span
                                    >
                                    <i
                                        v-if="!level2OpenSettingHo"
                                        class="ms-3 fas fa-angle-right"
                                    ></i>
                                    <i
                                        v-else
                                        class="ms-3 fas fa-angle-down"
                                    ></i>
                                </div> -->
                                <!-- <ul v-if="level2OpenSettingHo">
                                    <NavLink
                                        v-if="
                                            $page.props.auth.user.role ===
                                            'ict_developer'
                                        "
                                        :href="route('pengguna.page')"
                                        :active="
                                            route().current('pengguna.page')
                                        "
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-800 fas fa-users"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Setting Pengguna</span
                                        >
                                    </NavLink>

                                    <NavLink
                                        v-if="
                                            $page.props.auth.user.role ===
                                            'ict_developer'
                                        "
                                        :href="route('department.page')"
                                        :active="
                                            route().current('department.page')
                                        "
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-800 fas fa-cog"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Setting Department</span
                                        >
                                    </NavLink>

                                    <NavLink
                                        v-if="
                                            $page.props.auth.user.role ===
                                            'ict_developer'
                                        "
                                        :href="route('akses.page')"
                                        :active="route().current('akses.page')"
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-800 fas fa-user-tag"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Pengajuan Akses Role</span
                                        >
                                    </NavLink>
                                </ul> -->

                                <NavLink
                                    v-if="
                                        $page.props.auth.user.role ===
                                        'ict_group_leader'
                                    "
                                    :href="route('aduan-ho.page')"
                                    :active="route().current('aduan-ho.page')"
                                >
                                    <div
                                        class="ml-4 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                    >
                                        <i
                                            class="relative top-0 text-sm leading-normal text-red-800 fa-brands fa-buffer"
                                        ></i>
                                    </div>
                                    <span
                                        class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                    >
                                        Pengaduan HO</span
                                    >
                                </NavLink>
                            </li>
                        </ul>
                    </li>
                    <!-- end HO -->
                    <hr
                        v-if="
                            $page.props.auth.user.role == 'ict_developer' ||
                            $page.props.auth.user.site == 'BA' ||
                            $page.props.auth.user.site == 'HO'
                        "
                        class="h-px mt-3 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent"
                    />
                    <!-- start BA -->
                    <li
                        v-if="
                            $page.props.auth.user.role == 'ict_developer' ||
                            $page.props.auth.user.site == 'BA' ||
                            $page.props.auth.user.site == 'HO'
                        "
                    >
                        <div
                            @click="toggleLevel1Ba"
                            style="cursor: pointer"
                            class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                        >
                            <div
                                class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                            >
                                <i
                                    class="relative top-0 text-sm leading-normal text-red-700 fas fa-gem"
                                ></i>
                            </div>
                            <span
                                v-if="$page.props.auth.user.site == 'HO'"
                                class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                >Bukit Asam</span
                            >
                            <span
                                v-if="
                                    $page.props.auth.user.site == 'BA' ||
                                    $page.props.auth.user.role ==
                                        'ict_developer'
                                "
                                class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                >ICT - PPA BA</span
                            >
                            <i
                                v-if="!level1OpenBa"
                                class="ms-3 fas fa-angle-right"
                            ></i>
                            <i v-else class="ms-3 fas fa-angle-down"></i>
                        </div>
                        <ul v-if="level1OpenBa">
                            <li>
                                <NavLink
                                    :href="route('dashboardBa.page')"
                                    :active="
                                        route().current('dashboardBa.page')
                                    "
                                >
                                    <div
                                        class="ml-4 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                    >
                                        <i
                                            class="relative top-0 text-sm leading-normal text-red-800 fas fa-comments"
                                        ></i>
                                    </div>
                                    <span
                                        class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                        >Dashboard</span
                                    >
                                </NavLink>

                                <NavLink
                                    @click="toggleLevel2AduanBa"
                                    :href="route('aduanBa.page')"
                                    :active="route().current('aduanBa.page')"
                                >
                                    <div
                                        class="ml-4 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                    >
                                        <i
                                            class="relative top-0 text-sm leading-normal text-red-800 fas fa-comments"
                                        ></i>
                                    </div>
                                    <span
                                        class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                        >Aduan</span
                                    >
                                </NavLink>

                                <div
                                    v-if="
                                        $page.props.auth.user.role != 'soc_ho'
                                    "
                                    @click="toggleLevel2Ba"
                                    style="cursor: pointer"
                                    class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                >
                                    <div
                                        class="ml-4 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                    >
                                        <i
                                            class="relative top-0 text-sm leading-normal text-red-700 fas fa-dolly-flatbed"
                                        ></i>
                                    </div>
                                    <span
                                        class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                        >Inventory</span
                                    >
                                    <i
                                        v-if="!level2OpenBa"
                                        class="ms-3 fas fa-angle-right"
                                    ></i>
                                    <i
                                        v-else
                                        class="ms-3 fas fa-angle-down"
                                    ></i>
                                </div>
                                <ul v-if="level2OpenBa">
                                    <NavLink
                                        :href="route('accessPointBa.page')"
                                        :active="
                                            route().current(
                                                'accessPointBa.page'
                                            )
                                        "
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-800 fas fa-ethernet"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Access Point</span
                                        >
                                    </NavLink>
                                    <NavLink
                                        :href="route('switchBa.page')"
                                        :active="
                                            route().current('switchBa.page')
                                        "
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-800 fas fa-project-diagram"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Switch</span
                                        >
                                    </NavLink>
                                    <NavLink
                                        :href="route('wirellessBa.page')"
                                        :active="
                                            route().current('wirellessBa.page')
                                        "
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-800 fas fa-wifi"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Wirelless</span
                                        >
                                    </NavLink>
                                    <div
                                        @click="toggleLevel3LaptopBa"
                                        style="cursor: pointer"
                                        class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-700 fas fa-laptop"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Laptop</span
                                        >
                                        <i
                                            v-if="!level3OpenBa"
                                            class="ms-3 fas fa-angle-right"
                                        ></i>
                                        <i
                                            v-else
                                            class="ms-3 fas fa-angle-down"
                                        ></i>
                                    </div>
                                    <li v-if="level3OpenBa">
                                        <NavLink
                                            :href="route('laptopBa.page')"
                                            :active="
                                                route().current('laptopBa.page')
                                            "
                                        >
                                            <div
                                                class="ml-12 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                            >
                                                <i
                                                    class="relative top-0 text-sm leading-normal text-red-800 fas fa-laptop-code"
                                                ></i>
                                            </div>
                                            <span
                                                class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                                >Laptop Fixed</span
                                            >
                                        </NavLink>
                                    </li>

                                    <div
                                        @click="toggleLevel3KomputerBa"
                                        style="cursor: pointer"
                                        class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-700 fas fa-tv"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Komputer</span
                                        >
                                        <i
                                            v-if="!level3KomputerOpenBa"
                                            class="ms-3 fas fa-angle-right"
                                        ></i>
                                        <i
                                            v-else
                                            class="ms-3 fas fa-angle-down"
                                        ></i>
                                    </div>
                                    <li v-if="level3KomputerOpenBa">
                                        <NavLink
                                            :href="route('komputerBa.page')"
                                            :active="
                                                route().current(
                                                    'komputerBa.page'
                                                )
                                            "
                                        >
                                            <div
                                                class="ml-12 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                            >
                                                <i
                                                    class="relative top-0 text-sm leading-normal text-red-800 fas fa-desktop"
                                                ></i>
                                            </div>
                                            <span
                                                class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                                >Komputer Fixed</span
                                            >
                                        </NavLink>
                                    </li>

                                    <div
                                        @click="toggleLevel3PrinterBa"
                                        style="cursor: pointer"
                                        class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-700 fas fa-print"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Printer</span
                                        >
                                        <i
                                            v-if="!level3PrinterOpenBa"
                                            class="ms-3 fas fa-angle-right"
                                        ></i>
                                        <i
                                            v-else
                                            class="ms-3 fas fa-angle-down"
                                        ></i>
                                    </div>
                                    <li v-if="level3PrinterOpenBa">
                                        <NavLink
                                            :href="route('printerBa.page')"
                                            :active="
                                                route().current(
                                                    'printerBa.page'
                                                )
                                            "
                                        >
                                            <div
                                                class="ml-12 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                            >
                                                <i
                                                    class="relative top-0 text-sm leading-normal text-red-800 fas fa-print"
                                                ></i>
                                            </div>
                                            <span
                                                class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                                >Printer Fixed</span
                                            >
                                        </NavLink>
                                    </li>

                                    <div
                                        @click="toggleLevel3ScannerBa"
                                        style="cursor: pointer"
                                        class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-700 fas fa-print"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Scanner</span
                                        >
                                        <i
                                            v-if="!level3ScannerOpenBa"
                                            class="ms-3 fas fa-angle-right"
                                        ></i>
                                        <i
                                            v-else
                                            class="ms-3 fas fa-angle-down"
                                        ></i>
                                    </div>
                                    <li v-if="level3ScannerOpenBa">
                                        <NavLink
                                            :href="route('scannerBa.page')"
                                            :active="
                                                route().current(
                                                    'scannerBa.page'
                                                )
                                            "
                                        >
                                            <div
                                                class="ml-12 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                            >
                                                <i
                                                    class="relative top-0 text-sm leading-normal text-red-800 fas fa-print"
                                                ></i>
                                            </div>
                                            <span
                                                class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                                >Data Scanner</span
                                            >
                                        </NavLink>
                                    </li>

                                    <div
                                        @click="toggleLevel3CctvBa"
                                        style="cursor: pointer"
                                        class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-700 fas fa-camera-retro"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Cctv</span
                                        >
                                        <i
                                            v-if="!level3CctvOpenBa"
                                            class="ms-3 fas fa-angle-right"
                                        ></i>
                                        <i
                                            v-else
                                            class="ms-3 fas fa-angle-down"
                                        ></i>
                                    </div>
                                    <li v-if="level3CctvOpenBa">
                                        <NavLink
                                            :href="route('cctvBa.page')"
                                            :active="
                                                route().current('cctvBa.page')
                                            "
                                        >
                                            <div
                                                class="ml-12 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                            >
                                                <i
                                                    class="relative top-0 text-sm leading-normal text-red-800 fas fa-video"
                                                ></i>
                                            </div>
                                            <span
                                                class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                                >Data Cctv</span
                                            >
                                        </NavLink>
                                    </li>
                                </ul>

                                <div
                                    v-if="
                                        $page.props.auth.user.role != 'soc_ho'
                                    "
                                    @click="toggleLevel2InspeksiBa"
                                    style="cursor: pointer"
                                    class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                >
                                    <div
                                        class="ml-4 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                    >
                                        <i
                                            class="relative top-0 text-sm leading-normal text-red-700 fas fa-clipboard-list"
                                        ></i>
                                    </div>
                                    <span
                                        class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                        >Inspeksi</span
                                    >
                                    <i
                                        v-if="!level2OpenInspeksiBa"
                                        class="ms-3 fas fa-angle-right"
                                    ></i>
                                    <i
                                        v-else
                                        class="ms-3 fas fa-angle-down"
                                    ></i>
                                </div>
                                <ul v-if="level2OpenInspeksiBa">
                                    <NavLink
                                        :href="route('inspeksiLaptopBa.page')"
                                        :active="
                                            route().current(
                                                'inspeksiLaptopBa.page'
                                            )
                                        "
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-800 fas fa-laptop-medical"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Inspeksi Laptop</span
                                        >
                                    </NavLink>

                                    <NavLink
                                        :href="route('inspeksiKomputerBa.page')"
                                        :active="
                                            route().current(
                                                'inspeksiKomputerBa.page'
                                            )
                                        "
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-800 fas fa-desktop"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Inspeksi Komputer</span
                                        >
                                    </NavLink>
                                </ul>

                                <!-- <div
                                    v-if="
                                        $page.props.auth.user.role ===
                                        'ict_developer'
                                    "
                                    @click="toggleLevel2SettingBa"
                                    style="cursor: pointer"
                                    class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                >
                                    <div
                                        class="ml-4 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                    >
                                        <i
                                            class="relative top-0 text-sm leading-normal text-red-700 fas fa-cogs"
                                        ></i>
                                    </div>
                                    <span
                                        class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                        >Setting</span
                                    >
                                    <i
                                        v-if="!level2OpenSettingBa"
                                        class="ms-3 fas fa-angle-right"
                                    ></i>
                                    <i
                                        v-else
                                        class="ms-3 fas fa-angle-down"
                                    ></i>
                                </div>
                                <ul v-if="level2OpenSettingBa">
                                    <NavLink
                                        v-if="
                                            $page.props.auth.user.role ===
                                            'ict_developer'
                                        "
                                        :href="route('penggunaBa.page')"
                                        :active="
                                            route().current('penggunaBa.page')
                                        "
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-800 fas fa-users"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Setting Pengguna</span
                                        >
                                    </NavLink>

                                    <NavLink
                                        v-if="
                                            $page.props.auth.user.role ===
                                            'ict_developer'
                                        "
                                        :href="route('departmentBa.page')"
                                        :active="
                                            route().current('departmentBa.page')
                                        "
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-800 fas fa-cog"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Setting Department</span
                                        >
                                    </NavLink>

                                    <NavLink
                                        v-if="
                                            $page.props.auth.user.role ===
                                            'ict_developer'
                                        "
                                        :href="route('aksesBa.page')"
                                        :active="
                                            route().current('aksesBa.page')
                                        "
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-800 fas fa-user-tag"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Pengajuan Akses Role</span
                                        >
                                    </NavLink>
                                </ul> -->

                                <NavLink
                                    v-if="
                                        $page.props.auth.user.role ===
                                        'ict_group_leader'
                                    "
                                    :href="route('aduan-ho.page')"
                                    :active="route().current('aduan-ho.page')"
                                >
                                    <div
                                        class="ml-4 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                    >
                                        <i
                                            class="relative top-0 text-sm leading-normal text-red-800 fa-brands fa-buffer"
                                        ></i>
                                    </div>
                                    <span
                                        class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                    >
                                        Pengaduan HO</span
                                    >
                                </NavLink>
                            </li>
                        </ul>
                    </li>
                    <!-- end BA -->
                    <hr
                        v-if="
                            $page.props.auth.user.site == 'MIFA' ||
                            $page.props.auth.user.role == 'ict_developer' ||
                            $page.props.auth.user.site == 'HO'
                        "
                        class="h-px mt-3 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent"
                    />

                    <!-- start MIFA -->
                    <li
                        v-if="
                            $page.props.auth.user.site == 'MIFA' ||
                            $page.props.auth.user.role == 'ict_developer' ||
                            $page.props.auth.user.site == 'HO'
                        "
                    >
                        <div
                            @click="toggleLevel1Mifa"
                            style="cursor: pointer"
                            class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                        >
                            <div
                                class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                            >
                                <i
                                    class="relative top-0 text-sm leading-normal text-red-700 fas fa-gem"
                                ></i>
                            </div>
                            <span
                                v-if="$page.props.auth.user.site == 'HO'"
                                class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                >Mifa Bersaudara</span
                            >
                            <span
                                v-if="
                                    $page.props.auth.user.site == 'MIFA' ||
                                    $page.props.auth.user.role ==
                                        'ict_developer'
                                "
                                class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                >ICT - PPA MIFA</span
                            >
                            <i
                                v-if="!level1OpenMifa"
                                class="ms-3 fas fa-angle-right"
                            ></i>
                            <i v-else class="ms-3 fas fa-angle-down"></i>
                        </div>
                        <ul v-if="level1OpenMifa">
                            <li>
                                <NavLink
                                    :href="route('dashboardMifa.page')"
                                    :active="
                                        route().current('dashboardMifa.page')
                                    "
                                >
                                    <div
                                        class="ml-4 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                    >
                                        <i
                                            class="relative top-0 text-sm leading-normal text-red-800 fas fa-comments"
                                        ></i>
                                    </div>
                                    <span
                                        class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                        >Dashboard</span
                                    >
                                </NavLink>

                                <NavLink
                                    @click="toggleLevel2AduanMifa"
                                    :href="route('aduanMifa.page')"
                                    :active="route().current('aduanMifa.page')"
                                >
                                    <div
                                        class="ml-4 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                    >
                                        <i
                                            class="relative top-0 text-sm leading-normal text-red-800 fas fa-comments"
                                        ></i>
                                    </div>
                                    <span
                                        class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                        >Aduan</span
                                    >
                                </NavLink>

                                <div
                                    v-if="
                                        $page.props.auth.user.role != 'soc_ho'
                                    "
                                    @click="toggleLevel2Mifa"
                                    style="cursor: pointer"
                                    class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                >
                                    <div
                                        class="ml-4 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                    >
                                        <i
                                            class="relative top-0 text-sm leading-normal text-red-700 fas fa-dolly-flatbed"
                                        ></i>
                                    </div>
                                    <span
                                        class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                        >Inventory</span
                                    >
                                    <i
                                        v-if="!level2OpenMifa"
                                        class="ms-3 fas fa-angle-right"
                                    ></i>
                                    <i
                                        v-else
                                        class="ms-3 fas fa-angle-down"
                                    ></i>
                                </div>
                                <ul v-if="level2OpenMifa">
                                    <NavLink
                                        :href="route('accessPointMifa.page')"
                                        :active="
                                            route().current(
                                                'accessPointMifa.page'
                                            )
                                        "
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-800 fas fa-ethernet"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Access Point</span
                                        >
                                    </NavLink>
                                    <NavLink
                                        :href="route('switchMifa.page')"
                                        :active="
                                            route().current('switchMifa.page')
                                        "
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-800 fas fa-project-diagram"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Switch</span
                                        >
                                    </NavLink>
                                    <NavLink
                                        :href="route('wirellessMifa.page')"
                                        :active="
                                            route().current(
                                                'wirellessMifa.page'
                                            )
                                        "
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-800 fas fa-wifi"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Wirelless</span
                                        >
                                    </NavLink>
                                    <div
                                        @click="toggleLevel3LaptopMifa"
                                        style="cursor: pointer"
                                        class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-700 fas fa-laptop"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Laptop</span
                                        >
                                        <i
                                            v-if="!level3OpenMifa"
                                            class="ms-3 fas fa-angle-right"
                                        ></i>
                                        <i
                                            v-else
                                            class="ms-3 fas fa-angle-down"
                                        ></i>
                                    </div>
                                    <li v-if="level3OpenMifa">
                                        <NavLink
                                            :href="route('laptopMifa.page')"
                                            :active="
                                                route().current(
                                                    'laptopMifa.page'
                                                )
                                            "
                                        >
                                            <div
                                                class="ml-12 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                            >
                                                <i
                                                    class="relative top-0 text-sm leading-normal text-red-800 fas fa-laptop-code"
                                                ></i>
                                            </div>
                                            <span
                                                class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                                >Laptop Fixed</span
                                            >
                                        </NavLink>
                                    </li>

                                    <div
                                        @click="toggleLevel3KomputerMifa"
                                        style="cursor: pointer"
                                        class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-700 fas fa-tv"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Komputer</span
                                        >
                                        <i
                                            v-if="!level3KomputerOpenMifa"
                                            class="ms-3 fas fa-angle-right"
                                        ></i>
                                        <i
                                            v-else
                                            class="ms-3 fas fa-angle-down"
                                        ></i>
                                    </div>
                                    <li v-if="level3KomputerOpenMifa">
                                        <NavLink
                                            :href="route('komputerMifa.page')"
                                            :active="
                                                route().current(
                                                    'komputerMifa.page'
                                                )
                                            "
                                        >
                                            <div
                                                class="ml-12 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                            >
                                                <i
                                                    class="relative top-0 text-sm leading-normal text-red-800 fas fa-desktop"
                                                ></i>
                                            </div>
                                            <span
                                                class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                                >Komputer Fixed</span
                                            >
                                        </NavLink>
                                    </li>

                                    <div
                                        @click="toggleLevel3PrinterMifa"
                                        style="cursor: pointer"
                                        class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-700 fas fa-print"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Printer</span
                                        >
                                        <i
                                            v-if="!level3PrinterOpenMifa"
                                            class="ms-3 fas fa-angle-right"
                                        ></i>
                                        <i
                                            v-else
                                            class="ms-3 fas fa-angle-down"
                                        ></i>
                                    </div>
                                    <li v-if="level3PrinterOpenMifa">
                                        <NavLink
                                            :href="route('printerMifa.page')"
                                            :active="
                                                route().current(
                                                    'printerMifa.page'
                                                )
                                            "
                                        >
                                            <div
                                                class="ml-12 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                            >
                                                <i
                                                    class="relative top-0 text-sm leading-normal text-red-800 fas fa-print"
                                                ></i>
                                            </div>
                                            <span
                                                class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                                >Printer Fixed</span
                                            >
                                        </NavLink>
                                    </li>

                                    <div
                                        @click="toggleLevel3ScannerMifa"
                                        style="cursor: pointer"
                                        class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-700 fas fa-print"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Scanner</span
                                        >
                                        <i
                                            v-if="!level3ScannerOpenMifa"
                                            class="ms-3 fas fa-angle-right"
                                        ></i>
                                        <i
                                            v-else
                                            class="ms-3 fas fa-angle-down"
                                        ></i>
                                    </div>
                                    <li v-if="level3ScannerOpenMifa">
                                        <NavLink
                                            :href="route('scannerMifa.page')"
                                            :active="
                                                route().current(
                                                    'scannerMifa.page'
                                                )
                                            "
                                        >
                                            <div
                                                class="ml-12 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                            >
                                                <i
                                                    class="relative top-0 text-sm leading-normal text-red-800 fas fa-print"
                                                ></i>
                                            </div>
                                            <span
                                                class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                                >Data Scanner</span
                                            >
                                        </NavLink>
                                    </li>

                                    <div
                                        @click="toggleLevel3CctvMifa"
                                        style="cursor: pointer"
                                        class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-700 fas fa-camera-retro"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Cctv</span
                                        >
                                        <i
                                            v-if="!level3CctvOpenMifa"
                                            class="ms-3 fas fa-angle-right"
                                        ></i>
                                        <i
                                            v-else
                                            class="ms-3 fas fa-angle-down"
                                        ></i>
                                    </div>
                                    <li v-if="level3CctvOpenMifa">
                                        <NavLink
                                            :href="route('cctvMifa.page')"
                                            :active="
                                                route().current('cctvMifa.page')
                                            "
                                        >
                                            <div
                                                class="ml-12 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                            >
                                                <i
                                                    class="relative top-0 text-sm leading-normal text-red-800 fas fa-video"
                                                ></i>
                                            </div>
                                            <span
                                                class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                                >Data Cctv</span
                                            >
                                        </NavLink>
                                    </li>
                                </ul>

                                <div
                                    v-if="
                                        $page.props.auth.user.role != 'soc_ho'
                                    "
                                    @click="toggleLevel2InspeksiMifa"
                                    style="cursor: pointer"
                                    class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                >
                                    <div
                                        class="ml-4 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                    >
                                        <i
                                            class="relative top-0 text-sm leading-normal text-red-700 fas fa-clipboard-list"
                                        ></i>
                                    </div>
                                    <span
                                        class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                        >Inspeksi</span
                                    >
                                    <i
                                        v-if="!level2OpenInspeksiMifa"
                                        class="ms-3 fas fa-angle-right"
                                    ></i>
                                    <i
                                        v-else
                                        class="ms-3 fas fa-angle-down"
                                    ></i>
                                </div>
                                <ul v-if="level2OpenInspeksiMifa">
                                    <NavLink
                                        :href="route('inspeksiLaptopMifa.page')"
                                        :active="
                                            route().current(
                                                'inspeksiLaptopMifa.page'
                                            )
                                        "
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-800 fas fa-laptop-medical"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Inspeksi Laptop</span
                                        >
                                    </NavLink>

                                    <NavLink
                                        :href="
                                            route('inspeksiKomputerMifa.page')
                                        "
                                        :active="
                                            route().current(
                                                'inspeksiKomputerMifa.page'
                                            )
                                        "
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-800 fas fa-desktop"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Inspeksi Komputer</span
                                        >
                                    </NavLink>
                                </ul>

                                <!-- <div
                                    v-if="
                                        $page.props.auth.user.role ===
                                        'ict_developer'
                                    "
                                    @click="toggleLevel2SettingMifa"
                                    style="cursor: pointer"
                                    class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                >
                                    <div
                                        class="ml-4 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                    >
                                        <i
                                            class="relative top-0 text-sm leading-normal text-red-700 fas fa-cogs"
                                        ></i>
                                    </div>
                                    <span
                                        class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                        >Setting</span
                                    >
                                    <i
                                        v-if="!level2OpenSettingMifa"
                                        class="ms-3 fas fa-angle-right"
                                    ></i>
                                    <i
                                        v-else
                                        class="ms-3 fas fa-angle-down"
                                    ></i>
                                </div> -->
                                <!-- <ul v-if="level2OpenSettingMifa">
                                    <NavLink
                                        v-if="
                                            $page.props.auth.user.role ===
                                            'ict_developer'
                                        "
                                        :href="route('penggunaMifa.page')"
                                        :active="
                                            route().current('penggunaMifa.page')
                                        "
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-800 fas fa-users"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Setting Pengguna</span
                                        >
                                    </NavLink>

                                    <NavLink
                                        v-if="
                                            $page.props.auth.user.role ===
                                            'ict_developer'
                                        "
                                        :href="route('departmentMifa.page')"
                                        :active="
                                            route().current(
                                                'departmentMifa.page'
                                            )
                                        "
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-800 fas fa-cog"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Setting Department</span
                                        >
                                    </NavLink>

                                    <NavLink
                                        v-if="
                                            $page.props.auth.user.role ===
                                            'ict_developer'
                                        "
                                        :href="route('aksesMifa.page')"
                                        :active="
                                            route().current('aksesMifa.page')
                                        "
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-800 fas fa-user-tag"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Pengajuan Akses Role</span
                                        >
                                    </NavLink>
                                </ul> -->

                                <NavLink
                                    v-if="
                                        $page.props.auth.user.role ===
                                        'ict_group_leader'
                                    "
                                    :href="route('aduan-ho.page')"
                                    :active="route().current('aduan-ho.page')"
                                >
                                    <div
                                        class="ml-4 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                    >
                                        <i
                                            class="relative top-0 text-sm leading-normal text-red-800 fa-brands fa-buffer"
                                        ></i>
                                    </div>
                                    <span
                                        class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                    >
                                        Pengaduan HO</span
                                    >
                                </NavLink>
                            </li>
                        </ul>
                    </li>
                    <!-- end MIFA -->

                    <hr
                        v-if="
                            $page.props.auth.user.site == 'MHU' ||
                            $page.props.auth.user.role == 'ict_developer' ||
                            $page.props.auth.user.site == 'HO'
                        "
                        class="h-px mt-3 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent"
                    />

                    <!-- start MHU -->
                    <li
                        v-if="
                            $page.props.auth.user.site == 'MHU' ||
                            $page.props.auth.user.role == 'ict_developer' ||
                            $page.props.auth.user.site == 'HO'
                        "
                    >
                        <div
                            @click="toggleLevel1Mhu"
                            style="cursor: pointer"
                            class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                        >
                            <div
                                class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                            >
                                <i
                                    class="relative top-0 text-sm leading-normal text-red-700 fas fa-gem"
                                ></i>
                            </div>
                            <span
                                v-if="$page.props.auth.user.site == 'HO'"
                                class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                >Multi Harapan Utama</span
                            >
                            <span
                                v-if="
                                    $page.props.auth.user.site == 'MHU' ||
                                    $page.props.auth.user.role ==
                                        'ict_developer'
                                "
                                class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                >ICT - PPA MHU</span
                            >
                            <i
                                v-if="!level1OpenMhu"
                                class="ms-3 fas fa-angle-right"
                            ></i>
                            <i v-else class="ms-3 fas fa-angle-down"></i>
                        </div>
                        <ul v-if="level1OpenMhu">
                            <li>
                                <NavLink
                                    :href="route('dashboardMhu.page')"
                                    :active="
                                        route().current('dashboardMhu.page')
                                    "
                                >
                                    <div
                                        class="ml-4 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                    >
                                        <i
                                            class="relative top-0 text-sm leading-normal text-red-800 fas fa-comments"
                                        ></i>
                                    </div>
                                    <span
                                        class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                        >Dashboard</span
                                    >
                                </NavLink>

                                <NavLink
                                    @click="toggleLevel2AduanMhu"
                                    :href="route('aduanMhu.page')"
                                    :active="route().current('aduanMhu.page')"
                                >
                                    <div
                                        class="ml-4 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                    >
                                        <i
                                            class="relative top-0 text-sm leading-normal text-red-800 fas fa-comments"
                                        ></i>
                                    </div>
                                    <span
                                        class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                        >Aduan</span
                                    >
                                </NavLink>

                                <div
                                    v-if="
                                        $page.props.auth.user.role != 'soc_ho'
                                    "
                                    @click="toggleLevel2Mhu"
                                    style="cursor: pointer"
                                    class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                >
                                    <div
                                        class="ml-4 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                    >
                                        <i
                                            class="relative top-0 text-sm leading-normal text-red-700 fas fa-dolly-flatbed"
                                        ></i>
                                    </div>
                                    <span
                                        class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                        >Inventory</span
                                    >
                                    <i
                                        v-if="!level2OpenMhu"
                                        class="ms-3 fas fa-angle-right"
                                    ></i>
                                    <i
                                        v-else
                                        class="ms-3 fas fa-angle-down"
                                    ></i>
                                </div>
                                <ul v-if="level2OpenMhu">
                                    <NavLink
                                        :href="route('accessPointMhu.page')"
                                        :active="
                                            route().current(
                                                'accessPointMhu.page'
                                            )
                                        "
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-800 fas fa-ethernet"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Access Point</span
                                        >
                                    </NavLink>
                                    <NavLink
                                        :href="route('switchMhu.page')"
                                        :active="
                                            route().current('switchMhu.page')
                                        "
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-800 fas fa-project-diagram"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Switch</span
                                        >
                                    </NavLink>
                                    <NavLink
                                        :href="route('wirellessMhu.page')"
                                        :active="
                                            route().current('wirellessMhu.page')
                                        "
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-800 fas fa-wifi"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Wirelless</span
                                        >
                                    </NavLink>
                                    <div
                                        @click="toggleLevel3LaptopMhu"
                                        style="cursor: pointer"
                                        class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-700 fas fa-laptop"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Laptop</span
                                        >
                                        <i
                                            v-if="!level3OpenMhu"
                                            class="ms-3 fas fa-angle-right"
                                        ></i>
                                        <i
                                            v-else
                                            class="ms-3 fas fa-angle-down"
                                        ></i>
                                    </div>
                                    <li v-if="level3OpenMhu">
                                        <NavLink
                                            :href="route('laptopMhu.page')"
                                            :active="
                                                route().current(
                                                    'laptopMhu.page'
                                                )
                                            "
                                        >
                                            <div
                                                class="ml-12 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                            >
                                                <i
                                                    class="relative top-0 text-sm leading-normal text-red-800 fas fa-laptop-code"
                                                ></i>
                                            </div>
                                            <span
                                                class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                                >Laptop Fixed</span
                                            >
                                        </NavLink>
                                    </li>

                                    <div
                                        @click="toggleLevel3KomputerMhu"
                                        style="cursor: pointer"
                                        class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-700 fas fa-tv"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Komputer</span
                                        >
                                        <i
                                            v-if="!level3KomputerOpenMhu"
                                            class="ms-3 fas fa-angle-right"
                                        ></i>
                                        <i
                                            v-else
                                            class="ms-3 fas fa-angle-down"
                                        ></i>
                                    </div>
                                    <li v-if="level3KomputerOpenMhu">
                                        <NavLink
                                            :href="route('komputerMhu.page')"
                                            :active="
                                                route().current(
                                                    'komputerMhu.page'
                                                )
                                            "
                                        >
                                            <div
                                                class="ml-12 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                            >
                                                <i
                                                    class="relative top-0 text-sm leading-normal text-red-800 fas fa-desktop"
                                                ></i>
                                            </div>
                                            <span
                                                class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                                >Komputer Fixed</span
                                            >
                                        </NavLink>
                                    </li>

                                    <div
                                        @click="toggleLevel3PrinterMhu"
                                        style="cursor: pointer"
                                        class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-700 fas fa-print"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Printer</span
                                        >
                                        <i
                                            v-if="!level3PrinterOpenMhu"
                                            class="ms-3 fas fa-angle-right"
                                        ></i>
                                        <i
                                            v-else
                                            class="ms-3 fas fa-angle-down"
                                        ></i>
                                    </div>
                                    <li v-if="level3PrinterOpenMhu">
                                        <NavLink
                                            :href="route('printerMhu.page')"
                                            :active="
                                                route().current(
                                                    'printerMhu.page'
                                                )
                                            "
                                        >
                                            <div
                                                class="ml-12 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                            >
                                                <i
                                                    class="relative top-0 text-sm leading-normal text-red-800 fas fa-print"
                                                ></i>
                                            </div>
                                            <span
                                                class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                                >Printer Fixed</span
                                            >
                                        </NavLink>
                                    </li>

                                    <div
                                        @click="toggleLevel3ScannerMhu"
                                        style="cursor: pointer"
                                        class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-700 fas fa-print"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Scanner</span
                                        >
                                        <i
                                            v-if="!level3ScannerOpenMhu"
                                            class="ms-3 fas fa-angle-right"
                                        ></i>
                                        <i
                                            v-else
                                            class="ms-3 fas fa-angle-down"
                                        ></i>
                                    </div>
                                    <li v-if="level3ScannerOpenMhu">
                                        <NavLink
                                            :href="route('scannerMhu.page')"
                                            :active="
                                                route().current(
                                                    'scannerMhu.page'
                                                )
                                            "
                                        >
                                            <div
                                                class="ml-12 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                            >
                                                <i
                                                    class="relative top-0 text-sm leading-normal text-red-800 fas fa-print"
                                                ></i>
                                            </div>
                                            <span
                                                class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                                >Data Scanner</span
                                            >
                                        </NavLink>
                                    </li>

                                    <div
                                        @click="toggleLevel3CctvMhu"
                                        style="cursor: pointer"
                                        class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-700 fas fa-camera-retro"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Cctv</span
                                        >
                                        <i
                                            v-if="!level3CctvOpenMhu"
                                            class="ms-3 fas fa-angle-right"
                                        ></i>
                                        <i
                                            v-else
                                            class="ms-3 fas fa-angle-down"
                                        ></i>
                                    </div>
                                    <li v-if="level3CctvOpenMhu">
                                        <NavLink
                                            :href="route('cctvMhu.page')"
                                            :active="
                                                route().current('cctvMhu.page')
                                            "
                                        >
                                            <div
                                                class="ml-12 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                            >
                                                <i
                                                    class="relative top-0 text-sm leading-normal text-red-800 fas fa-video"
                                                ></i>
                                            </div>
                                            <span
                                                class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                                >Data Cctv</span
                                            >
                                        </NavLink>
                                    </li>
                                </ul>

                                <div
                                    v-if="
                                        $page.props.auth.user.role != 'soc_ho'
                                    "
                                    @click="toggleLevel2InspeksiMhu"
                                    style="cursor: pointer"
                                    class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                >
                                    <div
                                        class="ml-4 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                    >
                                        <i
                                            class="relative top-0 text-sm leading-normal text-red-700 fas fa-clipboard-list"
                                        ></i>
                                    </div>
                                    <span
                                        class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                        >Inspeksi</span
                                    >
                                    <i
                                        v-if="!level2OpenInspeksiMhu"
                                        class="ms-3 fas fa-angle-right"
                                    ></i>
                                    <i
                                        v-else
                                        class="ms-3 fas fa-angle-down"
                                    ></i>
                                </div>
                                <ul v-if="level2OpenInspeksiMhu">
                                    <NavLink
                                        :href="route('inspeksiLaptopMhu.page')"
                                        :active="
                                            route().current(
                                                'inspeksiLaptopMhu.page'
                                            )
                                        "
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-800 fas fa-laptop-medical"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Inspeksi Laptop</span
                                        >
                                    </NavLink>

                                    <NavLink
                                        :href="
                                            route('inspeksiKomputerMhu.page')
                                        "
                                        :active="
                                            route().current(
                                                'inspeksiKomputerMhu.page'
                                            )
                                        "
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-800 fas fa-desktop"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Inspeksi Komputer</span
                                        >
                                    </NavLink>
                                </ul>

                                <!-- <div
                                    v-if="
                                        $page.props.auth.user.role ===
                                        'ict_developer'
                                    "
                                    @click="toggleLevel2SettingMhu"
                                    style="cursor: pointer"
                                    class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                >
                                    <div
                                        class="ml-4 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                    >
                                        <i
                                            class="relative top-0 text-sm leading-normal text-red-700 fas fa-cogs"
                                        ></i>
                                    </div>
                                    <span
                                        class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                        >Setting</span
                                    >
                                    <i
                                        v-if="!level2OpenSettingMhu"
                                        class="ms-3 fas fa-angle-right"
                                    ></i>
                                    <i
                                        v-else
                                        class="ms-3 fas fa-angle-down"
                                    ></i>
                                </div>
                                <ul v-if="level2OpenSettingMhu">
                                    <NavLink
                                        v-if="
                                            $page.props.auth.user.role ===
                                            'ict_developer'
                                        "
                                        :href="route('penggunaMhu.page')"
                                        :active="
                                            route().current('penggunaMhu.page')
                                        "
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-800 fas fa-users"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Setting Pengguna</span
                                        >
                                    </NavLink>

                                    <NavLink
                                        v-if="
                                            $page.props.auth.user.role ===
                                            'ict_developer'
                                        "
                                        :href="route('departmentMifa.page')"
                                        :active="
                                            route().current(
                                                'departmentMifa.page'
                                            )
                                        "
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-800 fas fa-cog"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Setting Department</span
                                        >
                                    </NavLink>

                                    <NavLink
                                        v-if="
                                            $page.props.auth.user.role ===
                                            'ict_developer'
                                        "
                                        :href="route('aksesMifa.page')"
                                        :active="
                                            route().current('aksesMifa.page')
                                        "
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-800 fas fa-user-tag"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Pengajuan Akses Role</span
                                        >
                                    </NavLink>
                                </ul> -->

                                <NavLink
                                    v-if="
                                        $page.props.auth.user.role ===
                                        'ict_group_leader'
                                    "
                                    :href="route('aduan-ho.page')"
                                    :active="route().current('aduan-ho.page')"
                                >
                                    <div
                                        class="ml-4 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                    >
                                        <i
                                            class="relative top-0 text-sm leading-normal text-red-800 fa-brands fa-buffer"
                                        ></i>
                                    </div>
                                    <span
                                        class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                    >
                                        Pengaduan HO</span
                                    >
                                </NavLink>
                            </li>
                        </ul>
                    </li>
                    <!-- end MHU -->

                    <hr
                        v-if="
                            $page.props.auth.user.site == 'WARA' ||
                            $page.props.auth.user.role == 'ict_developer' ||
                            $page.props.auth.user.site == 'HO'
                        "
                        class="h-px mt-3 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent"
                    />

                    <!-- start WARA -->
                    <li
                        v-if="
                            $page.props.auth.user.site == 'WARA' ||
                            $page.props.auth.user.role == 'ict_developer' ||
                            $page.props.auth.user.site == 'HO'
                        "
                    >
                        <div
                            @click="toggleLevel1WARA"
                            style="cursor: pointer"
                            class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                        >
                            <div
                                class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                            >
                                <i
                                    class="relative top-0 text-sm leading-normal text-red-700 fas fa-gem"
                                ></i>
                            </div>
                            <span
                                v-if="$page.props.auth.user.site == 'HO'"
                                class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                >ADARO WARA</span
                            >
                            <span
                                v-if="
                                    $page.props.auth.user.site == 'WARA' ||
                                    $page.props.auth.user.role ==
                                        'ict_developer'
                                "
                                class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                >ICT - PPA WARA</span
                            >
                            <i
                                v-if="!level1OpenWARA"
                                class="ms-3 fas fa-angle-right"
                            ></i>
                            <i v-else class="ms-3 fas fa-angle-down"></i>
                        </div>
                        <ul v-if="level1OpenWARA">
                            <li>
                                <NavLink
                                    :href="route('dashboardWara.page')"
                                    :active="
                                        route().current('dashboardWara.page')
                                    "
                                >
                                    <div
                                        class="ml-4 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                    >
                                        <i
                                            class="relative top-0 text-sm leading-normal text-red-800 fas fa-comments"
                                        ></i>
                                    </div>
                                    <span
                                        class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                        >Dashboard</span
                                    >
                                </NavLink>

                                <NavLink
                                    @click="toggleLevel2AduanWARA"
                                    :href="route('aduanWARA.page')"
                                    :active="route().current('aduanWARA.page')"
                                >
                                    <div
                                        class="ml-4 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                    >
                                        <i
                                            class="relative top-0 text-sm leading-normal text-red-800 fas fa-comments"
                                        ></i>
                                    </div>
                                    <span
                                        class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                        >Aduan</span
                                    >
                                </NavLink>

                                <div
                                    v-if="
                                        $page.props.auth.user.role != 'soc_ho'
                                    "
                                    @click="toggleLevel2WARA"
                                    style="cursor: pointer"
                                    class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                >
                                    <div
                                        class="ml-4 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                    >
                                        <i
                                            class="relative top-0 text-sm leading-normal text-red-700 fas fa-dolly-flatbed"
                                        ></i>
                                    </div>
                                    <span
                                        class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                        >Inventory</span
                                    >
                                    <i
                                        v-if="!level2OpenWARA"
                                        class="ms-3 fas fa-angle-right"
                                    ></i>
                                    <i
                                        v-else
                                        class="ms-3 fas fa-angle-down"
                                    ></i>
                                </div>
                                <ul v-if="level2OpenWARA">
                                    <NavLink
                                        :href="route('accessPointWARA.page')"
                                        :active="
                                            route().current(
                                                'accessPointWARA.page'
                                            )
                                        "
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-800 fas fa-ethernet"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Access Point</span
                                        >
                                    </NavLink>
                                    <NavLink
                                        :href="route('switchWARA.page')"
                                        :active="
                                            route().current('switchWARA.page')
                                        "
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-800 fas fa-project-diagram"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Switch</span
                                        >
                                    </NavLink>
                                    <NavLink
                                        :href="route('wirellessWARA.page')"
                                        :active="
                                            route().current(
                                                'wirellessWARA.page'
                                            )
                                        "
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-800 fas fa-wifi"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Wirelless</span
                                        >
                                    </NavLink>
                                    <div
                                        @click="toggleLevel3LaptopWARA"
                                        style="cursor: pointer"
                                        class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-700 fas fa-laptop"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Laptop</span
                                        >
                                        <i
                                            v-if="!level3OpenWARA"
                                            class="ms-3 fas fa-angle-right"
                                        ></i>
                                        <i
                                            v-else
                                            class="ms-3 fas fa-angle-down"
                                        ></i>
                                    </div>
                                    <li v-if="level3OpenWARA">
                                        <NavLink
                                            :href="route('laptopWARA.page')"
                                            :active="
                                                route().current(
                                                    'laptopWARA.page'
                                                )
                                            "
                                        >
                                            <div
                                                class="ml-12 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                            >
                                                <i
                                                    class="relative top-0 text-sm leading-normal text-red-800 fas fa-laptop-code"
                                                ></i>
                                            </div>
                                            <span
                                                class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                                >Laptop Fixed</span
                                            >
                                        </NavLink>
                                    </li>

                                    <div
                                        @click="toggleLevel3KomputerWARA"
                                        style="cursor: pointer"
                                        class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-700 fas fa-tv"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Komputer</span
                                        >
                                        <i
                                            v-if="!level3KomputerOpenWARA"
                                            class="ms-3 fas fa-angle-right"
                                        ></i>
                                        <i
                                            v-else
                                            class="ms-3 fas fa-angle-down"
                                        ></i>
                                    </div>
                                    <li v-if="level3KomputerOpenWARA">
                                        <NavLink
                                            :href="route('komputerWARA.page')"
                                            :active="
                                                route().current(
                                                    'komputerWARA.page'
                                                )
                                            "
                                        >
                                            <div
                                                class="ml-12 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                            >
                                                <i
                                                    class="relative top-0 text-sm leading-normal text-red-800 fas fa-desktop"
                                                ></i>
                                            </div>
                                            <span
                                                class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                                >Komputer Fixed</span
                                            >
                                        </NavLink>
                                    </li>

                                    <div
                                        @click="toggleLevel3PrinterWARA"
                                        style="cursor: pointer"
                                        class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-700 fas fa-print"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Printer</span
                                        >
                                        <i
                                            v-if="!level3PrinterOpenWARA"
                                            class="ms-3 fas fa-angle-right"
                                        ></i>
                                        <i
                                            v-else
                                            class="ms-3 fas fa-angle-down"
                                        ></i>
                                    </div>
                                    <li v-if="level3PrinterOpenWARA">
                                        <NavLink
                                            :href="route('printerWARA.page')"
                                            :active="
                                                route().current(
                                                    'printerWARA.page'
                                                )
                                            "
                                        >
                                            <div
                                                class="ml-12 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                            >
                                                <i
                                                    class="relative top-0 text-sm leading-normal text-red-800 fas fa-print"
                                                ></i>
                                            </div>
                                            <span
                                                class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                                >Printer Fixed</span
                                            >
                                        </NavLink>
                                    </li>

                                    <div
                                        @click="toggleLevel3ScannerWARA"
                                        style="cursor: pointer"
                                        class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-700 fas fa-print"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Scanner</span
                                        >
                                        <i
                                            v-if="!level3ScannerOpenWARA"
                                            class="ms-3 fas fa-angle-right"
                                        ></i>
                                        <i
                                            v-else
                                            class="ms-3 fas fa-angle-down"
                                        ></i>
                                    </div>
                                    <li v-if="level3ScannerOpenWARA">
                                        <NavLink
                                            :href="route('scannerWARA.page')"
                                            :active="
                                                route().current(
                                                    'scannerWARA.page'
                                                )
                                            "
                                        >
                                            <div
                                                class="ml-12 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                            >
                                                <i
                                                    class="relative top-0 text-sm leading-normal text-red-800 fas fa-print"
                                                ></i>
                                            </div>
                                            <span
                                                class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                                >Data Scanner</span
                                            >
                                        </NavLink>
                                    </li>

                                    <div
                                        @click="toggleLevel3CctvWARA"
                                        style="cursor: pointer"
                                        class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-700 fas fa-camera-retro"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Cctv</span
                                        >
                                        <i
                                            v-if="!level3CctvOpenWARA"
                                            class="ms-3 fas fa-angle-right"
                                        ></i>
                                        <i
                                            v-else
                                            class="ms-3 fas fa-angle-down"
                                        ></i>
                                    </div>
                                    <li v-if="level3CctvOpenWARA">
                                        <NavLink
                                            :href="route('cctvWARA.page')"
                                            :active="
                                                route().current('cctvWARA.page')
                                            "
                                        >
                                            <div
                                                class="ml-12 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                            >
                                                <i
                                                    class="relative top-0 text-sm leading-normal text-red-800 fas fa-video"
                                                ></i>
                                            </div>
                                            <span
                                                class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                                >Data Cctv</span
                                            >
                                        </NavLink>
                                    </li>
                                </ul>

                                <div
                                    v-if="
                                        $page.props.auth.user.role != 'soc_ho'
                                    "
                                    @click="toggleLevel2InspeksiWARA"
                                    style="cursor: pointer"
                                    class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                >
                                    <div
                                        class="ml-4 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                    >
                                        <i
                                            class="relative top-0 text-sm leading-normal text-red-700 fas fa-clipboard-list"
                                        ></i>
                                    </div>
                                    <span
                                        class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                        >Inspeksi</span
                                    >
                                    <i
                                        v-if="!level2OpenInspeksiWARA"
                                        class="ms-3 fas fa-angle-right"
                                    ></i>
                                    <i
                                        v-else
                                        class="ms-3 fas fa-angle-down"
                                    ></i>
                                </div>
                                <ul v-if="level2OpenInspeksiWARA">
                                    <NavLink
                                        :href="route('inspeksiLaptopWARA.page')"
                                        :active="
                                            route().current(
                                                'inspeksiLaptopWARA.page'
                                            )
                                        "
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-800 fas fa-laptop-medical"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Inspeksi Laptop</span
                                        >
                                    </NavLink>

                                    <NavLink
                                        :href="
                                            route('inspeksiKomputerWARA.page')
                                        "
                                        :active="
                                            route().current(
                                                'inspeksiKomputerWARA.page'
                                            )
                                        "
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-800 fas fa-desktop"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Inspeksi Komputer</span
                                        >
                                    </NavLink>
                                </ul>

                                <NavLink
                                    v-if="
                                        $page.props.auth.user.role ===
                                        'ict_group_leader'
                                    "
                                    :href="route('aduan-ho.page')"
                                    :active="route().current('aduan-ho.page')"
                                >
                                    <div
                                        class="ml-4 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                    >
                                        <i
                                            class="relative top-0 text-sm leading-normal text-red-800 fa-brands fa-buffer"
                                        ></i>
                                    </div>
                                    <span
                                        class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                    >
                                        Pengaduan HO</span
                                    >
                                </NavLink>
                            </li>
                        </ul>
                    </li>
                    <!-- end WARA -->

                    <hr
                        v-if="
                            $page.props.auth.user.site == 'AMI' ||
                            $page.props.auth.user.role == 'ict_developer' ||
                            $page.props.auth.user.site == 'HO'
                        "
                        class="h-px mt-3 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent"
                    />

                    <!-- start AMI -->
                    <li
                        v-if="
                            $page.props.auth.user.site == 'AMI' ||
                            $page.props.auth.user.role == 'ict_developer' ||
                            $page.props.auth.user.site == 'HO'
                        "
                    >
                        <div
                            @click="toggleLevel1Ami"
                            style="cursor: pointer"
                            class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                        >
                            <div
                                class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                            >
                                <i
                                    class="relative top-0 text-sm leading-normal text-red-700 fas fa-gem"
                                ></i>
                            </div>
                            <span
                                v-if="$page.props.auth.user.site == 'HO'"
                                class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                >Multi Harapan Utama</span
                            >
                            <span
                                v-if="
                                    $page.props.auth.user.site == 'Ami' ||
                                    $page.props.auth.user.role ==
                                        'ict_developer'
                                "
                                class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                >ICT - PPA AMI</span
                            >
                            <i
                                v-if="!level1OpenAmi"
                                class="ms-3 fas fa-angle-right"
                            ></i>
                            <i v-else class="ms-3 fas fa-angle-down"></i>
                        </div>
                        <ul v-if="level1OpenAmi">
                            <li>
                             <NavLink
                                    :href="route('dashboardAmi.page')"
                                    :active="
                                        route().current('dashboardAmi.page')
                                    "
                                >
                                    <div
                                        class="ml-4 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                    >
                                        <i
                                            class="relative top-0 text-sm leading-normal text-red-800 fas fa-comments"
                                        ></i>
                                    </div>
                                    <span
                                        class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                        >Dashboard</span
                                    >
                                </NavLink>

                                <NavLink
                                    @click="toggleLevel2AduanAmi"
                                    :href="route('aduanAmi.page')"
                                    :active="route().current('aduanAmi.page')"
                                >
                                    <div
                                        class="ml-4 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                    >
                                        <i
                                            class="relative top-0 text-sm leading-normal text-red-800 fas fa-comments"
                                        ></i>
                                    </div>
                                    <span
                                        class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                        >Aduan</span
                                    >
                                </NavLink>

                                <div
                                    v-if="
                                        $page.props.auth.user.role != 'soc_ho'
                                    "
                                    @click="toggleLevel2Ami"
                                    style="cursor: pointer"
                                    class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                >
                                    <div
                                        class="ml-4 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                    >
                                        <i
                                            class="relative top-0 text-sm leading-normal text-red-700 fas fa-dolly-flatbed"
                                        ></i>
                                    </div>
                                    <span
                                        class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                        >Inventory</span
                                    >
                                    <i
                                        v-if="!level2OpenAmi"
                                        class="ms-3 fas fa-angle-right"
                                    ></i>
                                    <i
                                        v-else
                                        class="ms-3 fas fa-angle-down"
                                    ></i>
                                </div>
                                <ul v-if="level2OpenAmi">
                                    <NavLink
                                        :href="route('accessPointAmi.page')"
                                        :active="
                                            route().current(
                                                'accessPointAmi.page'
                                            )
                                        "
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-800 fas fa-ethernet"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Access Point</span
                                        >
                                    </NavLink>
                                    <NavLink
                                        :href="route('switchAmi.page')"
                                        :active="
                                            route().current('switchAmi.page')
                                        "
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-800 fas fa-project-diagram"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Switch</span
                                        >
                                    </NavLink>
                                    <NavLink
                                        :href="route('wirellessAmi.page')"
                                        :active="
                                            route().current('wirellessAmi.page')
                                        "
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-800 fas fa-wifi"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Wirelless</span
                                        >
                                    </NavLink>
                                    <div
                                        @click="toggleLevel3LaptopAmi"
                                        style="cursor: pointer"
                                        class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-700 fas fa-laptop"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Laptop</span
                                        >
                                        <i
                                            v-if="!level3OpenAmi"
                                            class="ms-3 fas fa-angle-right"
                                        ></i>
                                        <i
                                            v-else
                                            class="ms-3 fas fa-angle-down"
                                        ></i>
                                    </div>
                                    <li v-if="level3OpenAmi">
                                        <NavLink
                                            :href="route('laptopAmi.page')"
                                            :active="
                                                route().current(
                                                    'laptopAmi.page'
                                                )
                                            "
                                        >
                                            <div
                                                class="ml-12 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                            >
                                                <i
                                                    class="relative top-0 text-sm leading-normal text-red-800 fas fa-laptop-code"
                                                ></i>
                                            </div>
                                            <span
                                                class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                                >Laptop Fixed</span
                                            >
                                        </NavLink>
                                    </li>

                                    <div
                                        @click="toggleLevel3KomputerAmi"
                                        style="cursor: pointer"
                                        class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-700 fas fa-tv"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Komputer</span
                                        >
                                        <i
                                            v-if="!level3KomputerOpenAmi"
                                            class="ms-3 fas fa-angle-right"
                                        ></i>
                                        <i
                                            v-else
                                            class="ms-3 fas fa-angle-down"
                                        ></i>
                                    </div>
                                    <li v-if="level3KomputerOpenAmi">
                                        <NavLink
                                            :href="route('komputerAmi.page')"
                                            :active="
                                                route().current(
                                                    'komputerAmi.page'
                                                )
                                            "
                                        >
                                            <div
                                                class="ml-12 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                            >
                                                <i
                                                    class="relative top-0 text-sm leading-normal text-red-800 fas fa-desktop"
                                                ></i>
                                            </div>
                                            <span
                                                class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                                >Komputer Fixed</span
                                            >
                                        </NavLink>
                                    </li>

                                    <div
                                        @click="toggleLevel3PrinterAmi"
                                        style="cursor: pointer"
                                        class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-700 fas fa-print"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Printer</span
                                        >
                                        <i
                                            v-if="!level3PrinterOpenAmi"
                                            class="ms-3 fas fa-angle-right"
                                        ></i>
                                        <i
                                            v-else
                                            class="ms-3 fas fa-angle-down"
                                        ></i>
                                    </div>
                                    <li v-if="level3PrinterOpenAmi">
                                        <NavLink
                                            :href="route('printerAmi.page')"
                                            :active="
                                                route().current(
                                                    'printerAmi.page'
                                                )
                                            "
                                        >
                                            <div
                                                class="ml-12 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                            >
                                                <i
                                                    class="relative top-0 text-sm leading-normal text-red-800 fas fa-print"
                                                ></i>
                                            </div>
                                            <span
                                                class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                                >Printer Fixed</span
                                            >
                                        </NavLink>
                                    </li>

                                    <div
                                        @click="toggleLevel3ScannerAmi"
                                        style="cursor: pointer"
                                        class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-700 fas fa-print"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Scanner</span
                                        >
                                        <i
                                            v-if="!level3ScannerOpenAmi"
                                            class="ms-3 fas fa-angle-right"
                                        ></i>
                                        <i
                                            v-else
                                            class="ms-3 fas fa-angle-down"
                                        ></i>
                                    </div>
                                    <li v-if="level3ScannerOpenAmi">
                                        <NavLink
                                            :href="route('scannerAmi.page')"
                                            :active="
                                                route().current(
                                                    'scannerAmi.page'
                                                )
                                            "
                                        >
                                            <div
                                                class="ml-12 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                            >
                                                <i
                                                    class="relative top-0 text-sm leading-normal text-red-800 fas fa-print"
                                                ></i>
                                            </div>
                                            <span
                                                class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                                >Data Scanner</span
                                            >
                                        </NavLink>
                                    </li>

                                    <div
                                        @click="toggleLevel3CctvAmi"
                                        style="cursor: pointer"
                                        class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-700 fas fa-camera-retro"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Cctv</span
                                        >
                                        <i
                                            v-if="!level3CctvOpenAmi"
                                            class="ms-3 fas fa-angle-right"
                                        ></i>
                                        <i
                                            v-else
                                            class="ms-3 fas fa-angle-down"
                                        ></i>
                                    </div>
                                    <li v-if="level3CctvOpenAmi">
                                        <NavLink
                                            :href="route('cctvAmi.page')"
                                            :active="
                                                route().current('cctvAmi.page')
                                            "
                                        >
                                            <div
                                                class="ml-12 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                            >
                                                <i
                                                    class="relative top-0 text-sm leading-normal text-red-800 fas fa-video"
                                                ></i>
                                            </div>
                                            <span
                                                class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                                >Data Cctv</span
                                            >
                                        </NavLink>
                                    </li>
                                </ul>

                                <div
                                    v-if="
                                        $page.props.auth.user.role != 'soc_ho'
                                    "
                                    @click="toggleLevel2InspeksiAmi"
                                    style="cursor: pointer"
                                    class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                >
                                    <div
                                        class="ml-4 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                    >
                                        <i
                                            class="relative top-0 text-sm leading-normal text-red-700 fas fa-clipboard-list"
                                        ></i>
                                    </div>
                                    <span
                                        class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                        >Inspeksi</span
                                    >
                                    <i
                                        v-if="!level2OpenInspeksiAmi"
                                        class="ms-3 fas fa-angle-right"
                                    ></i>
                                    <i
                                        v-else
                                        class="ms-3 fas fa-angle-down"
                                    ></i>
                                </div>
                                <ul v-if="level2OpenInspeksiAmi">
                                    <NavLink
                                        :href="route('inspeksiLaptopAmi.page')"
                                        :active="
                                            route().current(
                                                'inspeksiLaptopAmi.page'
                                            )
                                        "
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-800 fas fa-laptop-medical"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Inspeksi Laptop</span
                                        >
                                    </NavLink>

                                    <NavLink
                                        :href="
                                            route('inspeksiKomputerAmi.page')
                                        "
                                        :active="
                                            route().current(
                                                'inspeksiKomputerAmi.page'
                                            )
                                        "
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-800 fas fa-desktop"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Inspeksi Komputer</span
                                        >
                                    </NavLink>
                                </ul>

                                <!-- <div
                                    v-if="
                                        $page.props.auth.user.role ===
                                        'ict_developer'
                                    "
                                    @click="toggleLevel2SettingMhu"
                                    style="cursor: pointer"
                                    class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                >
                                    <div
                                        class="ml-4 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                    >
                                        <i
                                            class="relative top-0 text-sm leading-normal text-red-700 fas fa-cogs"
                                        ></i>
                                    </div>
                                    <span
                                        class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                        >Setting</span
                                    >
                                    <i
                                        v-if="!level2OpenSettingMhu"
                                        class="ms-3 fas fa-angle-right"
                                    ></i>
                                    <i
                                        v-else
                                        class="ms-3 fas fa-angle-down"
                                    ></i>
                                </div>
                                <ul v-if="level2OpenSettingMhu">
                                    <NavLink
                                        v-if="
                                            $page.props.auth.user.role ===
                                            'ict_developer'
                                        "
                                        :href="route('penggunaMhu.page')"
                                        :active="
                                            route().current('penggunaMhu.page')
                                        "
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-800 fas fa-users"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Setting Pengguna</span
                                        >
                                    </NavLink>

                                    <NavLink
                                        v-if="
                                            $page.props.auth.user.role ===
                                            'ict_developer'
                                        "
                                        :href="route('departmentMifa.page')"
                                        :active="
                                            route().current(
                                                'departmentMifa.page'
                                            )
                                        "
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-800 fas fa-cog"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Setting Department</span
                                        >
                                    </NavLink>

                                    <NavLink
                                        v-if="
                                            $page.props.auth.user.role ===
                                            'ict_developer'
                                        "
                                        :href="route('aksesMifa.page')"
                                        :active="
                                            route().current('aksesMifa.page')
                                        "
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-800 fas fa-user-tag"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Pengajuan Akses Role</span
                                        >
                                    </NavLink>
                                </ul> -->

                                <NavLink
                                    v-if="
                                        $page.props.auth.user.role ===
                                        'ict_group_leader'
                                    "
                                    :href="route('aduan-ho.page')"
                                    :active="route().current('aduan-ho.page')"
                                >
                                    <div
                                        class="ml-4 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                    >
                                        <i
                                            class="relative top-0 text-sm leading-normal text-red-800 fa-brands fa-buffer"
                                        ></i>
                                    </div>
                                    <span
                                        class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                    >
                                        Pengaduan HO</span
                                    >
                                </NavLink>
                            </li>
                        </ul>
                    </li>
                    <!-- end AMI -->

                    <hr
                        v-if="
                            $page.props.auth.user.site == 'BIB' ||
                            $page.props.auth.user.role == 'ict_developer' ||
                            $page.props.auth.user.site == 'HO'
                        "
                        class="h-px mt-3 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent"
                    />

                    <!-- start BIB -->
                    <li
                        v-if="
                            $page.props.auth.user.site == 'BIB' ||
                            $page.props.auth.user.role == 'ict_developer' ||
                            $page.props.auth.user.site == 'HO'
                        "
                    >
                        <div
                            @click="toggleLevel1Bib"
                            style="cursor: pointer"
                            class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                        >
                            <div
                                class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                            >
                                <i
                                    class="relative top-0 text-sm leading-normal text-red-700 fas fa-gem"
                                ></i>
                            </div>
                            <span
                                v-if="$page.props.auth.user.site == 'HO'"
                                class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                >Borneo Indobara</span
                            >
                            <span
                                v-if="
                                    $page.props.auth.user.site == 'BIB' ||
                                    $page.props.auth.user.role ==
                                        'ict_developer'
                                "
                                class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                >ICT - PPA BIB</span
                            >
                            <i
                                v-if="!level1OpenBib"
                                class="ms-3 fas fa-angle-right"
                            ></i>
                            <i v-else class="ms-3 fas fa-angle-down"></i>
                        </div>
                        <ul v-if="level1OpenBib">
                            <li>
                                <NavLink
                                    @click="toggleLevel2AduanBib"
                                    :href="route('aduan.page')"
                                    :active="route().current('aduan.page')"
                                >
                                    <div
                                        class="ml-4 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                    >
                                        <i
                                            class="relative top-0 text-sm leading-normal text-red-800 fas fa-comments"
                                        ></i>
                                    </div>
                                    <span
                                        class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                        >Aduan</span
                                    >
                                </NavLink>

                                <div
                                    v-if="
                                        $page.props.auth.user.role != 'soc_ho'
                                    "
                                    @click="toggleLevel2Bib"
                                    style="cursor: pointer"
                                    class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                >
                                    <div
                                        class="ml-4 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                    >
                                        <i
                                            class="relative top-0 text-sm leading-normal text-red-700 fas fa-dolly-flatbed"
                                        ></i>
                                    </div>
                                    <span
                                        class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                        >Inventory</span
                                    >
                                    <i
                                        v-if="!level2OpenBib"
                                        class="ms-3 fas fa-angle-right"
                                    ></i>
                                    <i
                                        v-else
                                        class="ms-3 fas fa-angle-down"
                                    ></i>
                                </div>
                                <ul v-if="level2OpenBib">
                                    <NavLink
                                        :href="route('accessPoint.page')"
                                        :active="
                                            route().current('accessPoint.page')
                                        "
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-800 fas fa-ethernet"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Access Point</span
                                        >
                                    </NavLink>
                                    <NavLink
                                        :href="route('switch.page')"
                                        :active="route().current('switch.page')"
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-800 fas fa-project-diagram"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Switch</span
                                        >
                                    </NavLink>
                                    <NavLink
                                        :href="route('wirelless.page')"
                                        :active="
                                            route().current('wirelless.page')
                                        "
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-800 fas fa-wifi"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Wirelless</span
                                        >
                                    </NavLink>
                                    <div
                                        @click="toggleLevel3LaptopBib"
                                        style="cursor: pointer"
                                        class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-700 fas fa-laptop"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Laptop</span
                                        >
                                        <i
                                            v-if="!level3OpenBib"
                                            class="ms-3 fas fa-angle-right"
                                        ></i>
                                        <i
                                            v-else
                                            class="ms-3 fas fa-angle-down"
                                        ></i>
                                    </div>
                                    <li v-if="level3OpenBib">
                                        <NavLink
                                            :href="route('laptop.page')"
                                            :active="
                                                route().current('laptop.page')
                                            "
                                        >
                                            <div
                                                class="ml-12 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                            >
                                                <i
                                                    class="relative top-0 text-sm leading-normal text-red-800 fas fa-laptop-code"
                                                ></i>
                                            </div>
                                            <span
                                                class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                                >Laptop Fixed</span
                                            >
                                        </NavLink>
                                    </li>

                                    <div
                                        @click="toggleLevel3KomputerBib"
                                        style="cursor: pointer"
                                        class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-700 fas fa-tv"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Komputer</span
                                        >
                                        <i
                                            v-if="!level3KomputerOpenBib"
                                            class="ms-3 fas fa-angle-right"
                                        ></i>
                                        <i
                                            v-else
                                            class="ms-3 fas fa-angle-down"
                                        ></i>
                                    </div>
                                    <li v-if="level3KomputerOpenBib">
                                        <NavLink
                                            :href="route('komputer.page')"
                                            :active="
                                                route().current('komputer.page')
                                            "
                                        >
                                            <div
                                                class="ml-12 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                            >
                                                <i
                                                    class="relative top-0 text-sm leading-normal text-red-800 fas fa-desktop"
                                                ></i>
                                            </div>
                                            <span
                                                class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                                >Komputer Fixed</span
                                            >
                                        </NavLink>
                                    </li>

                                    <div
                                        @click="toggleLevel3PrinterBib"
                                        style="cursor: pointer"
                                        class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-700 fas fa-print"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Printer</span
                                        >
                                        <i
                                            v-if="!level3PrinterOpenBib"
                                            class="ms-3 fas fa-angle-right"
                                        ></i>
                                        <i
                                            v-else
                                            class="ms-3 fas fa-angle-down"
                                        ></i>
                                    </div>
                                    <li v-if="level3PrinterOpenBib">
                                        <NavLink
                                            :href="route('printer.page')"
                                            :active="
                                                route().current('printer.page')
                                            "
                                        >
                                            <div
                                                class="ml-12 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                            >
                                                <i
                                                    class="relative top-0 text-sm leading-normal text-red-800 fas fa-print"
                                                ></i>
                                            </div>
                                            <span
                                                class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                                >Printer Fixed</span
                                            >
                                        </NavLink>
                                    </li>

                                    <div
                                        @click="toggleLevel3ScannerBib"
                                        style="cursor: pointer"
                                        class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-700 fas fa-print"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Scanner</span
                                        >
                                        <i
                                            v-if="!level3ScannerOpenBib"
                                            class="ms-3 fas fa-angle-right"
                                        ></i>
                                        <i
                                            v-else
                                            class="ms-3 fas fa-angle-down"
                                        ></i>
                                    </div>
                                    <li v-if="level3ScannerOpenBib">
                                        <NavLink
                                            :href="route('scanner.page')"
                                            :active="
                                                route().current('scanner.page')
                                            "
                                        >
                                            <div
                                                class="ml-12 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                            >
                                                <i
                                                    class="relative top-0 text-sm leading-normal text-red-800 fas fa-print"
                                                ></i>
                                            </div>
                                            <span
                                                class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                                >Data Scanner</span
                                            >
                                        </NavLink>
                                    </li>

                                    <div
                                        @click="toggleLevel3CctvBib"
                                        style="cursor: pointer"
                                        class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-700 fas fa-camera-retro"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Cctv</span
                                        >
                                        <i
                                            v-if="!level3CctvOpenBib"
                                            class="ms-3 fas fa-angle-right"
                                        ></i>
                                        <i
                                            v-else
                                            class="ms-3 fas fa-angle-down"
                                        ></i>
                                    </div>
                                    <li v-if="level3CctvOpenBib">
                                        <NavLink
                                            :href="route('cctv.page')"
                                            :active="
                                                route().current('cctv.page')
                                            "
                                        >
                                            <div
                                                class="ml-12 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                            >
                                                <i
                                                    class="relative top-0 text-sm leading-normal text-red-800 fas fa-video"
                                                ></i>
                                            </div>
                                            <span
                                                class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                                >Data Cctv</span
                                            >
                                        </NavLink>
                                    </li>
                                </ul>

                                <div
                                    v-if="
                                        $page.props.auth.user.role != 'soc_ho'
                                    "
                                    @click="toggleLevel2InspeksiBib"
                                    style="cursor: pointer"
                                    class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                >
                                    <div
                                        class="ml-4 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                    >
                                        <i
                                            class="relative top-0 text-sm leading-normal text-red-700 fas fa-clipboard-list"
                                        ></i>
                                    </div>
                                    <span
                                        class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                        >Inspeksi</span
                                    >
                                    <i
                                        v-if="!level2OpenInspeksiBib"
                                        class="ms-3 fas fa-angle-right"
                                    ></i>
                                    <i
                                        v-else
                                        class="ms-3 fas fa-angle-down"
                                    ></i>
                                </div>
                                <ul v-if="level2OpenInspeksiBib">
                                    <NavLink
                                        :href="route('inspeksiLaptop.page')"
                                        :active="
                                            route().current(
                                                'inspeksiLaptop.page'
                                            )
                                        "
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-800 fas fa-laptop-medical"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Inspeksi Laptop</span
                                        >
                                    </NavLink>

                                    <NavLink
                                        :href="route('inspeksiKomputer.page')"
                                        :active="
                                            route().current(
                                                'inspeksiKomputer.page'
                                            )
                                        "
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-800 fas fa-desktop"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Inspeksi Komputer</span
                                        >
                                    </NavLink>
                                </ul>

                                <!-- <div
                                    v-if="
                                        $page.props.auth.user.role ===
                                        'ict_developer'
                                    "
                                    @click="toggleLevel2SettingBib"
                                    style="cursor: pointer"
                                    class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                >
                                    <div
                                        class="ml-4 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                    >
                                        <i
                                            class="relative top-0 text-sm leading-normal text-red-700 fas fa-cogs"
                                        ></i>
                                    </div>
                                    <span
                                        class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                        >Setting</span
                                    >
                                    <i
                                        v-if="!level2OpenSettingBib"
                                        class="ms-3 fas fa-angle-right"
                                    ></i>
                                    <i
                                        v-else
                                        class="ms-3 fas fa-angle-down"
                                    ></i>
                                </div>
                                <ul v-if="level2OpenSettingBib">
                                    <NavLink
                                        v-if="
                                            $page.props.auth.user.role ===
                                            'ict_developer'
                                        "
                                        :href="route('pengguna.page')"
                                        :active="
                                            route().current('pengguna.page')
                                        "
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-800 fas fa-users"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Setting Pengguna</span
                                        >
                                    </NavLink>

                                    <NavLink
                                        v-if="
                                            $page.props.auth.user.role ===
                                            'ict_developer'
                                        "
                                        :href="route('department.page')"
                                        :active="
                                            route().current('department.page')
                                        "
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-800 fas fa-cog"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Setting Department</span
                                        >
                                    </NavLink>

                                    <NavLink
                                        v-if="
                                            $page.props.auth.user.role ===
                                            'ict_developer'
                                        "
                                        :href="route('akses.page')"
                                        :active="route().current('akses.page')"
                                    >
                                        <div
                                            class="ml-8 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                        >
                                            <i
                                                class="relative top-0 text-sm leading-normal text-red-800 fas fa-user-tag"
                                            ></i>
                                        </div>
                                        <span
                                            class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                            >Pengajuan Akses Role</span
                                        >
                                    </NavLink>
                                </ul> -->

                                <NavLink
                                    v-if="
                                        $page.props.auth.user.role ===
                                        'ict_group_leader'
                                    "
                                    :href="route('aduan-ho.page')"
                                    :active="route().current('aduan-ho.page')"
                                >
                                    <div
                                        class="ml-4 mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5"
                                    >
                                        <i
                                            class="relative top-0 text-sm leading-normal text-red-800 fa-brands fa-buffer"
                                        ></i>
                                    </div>
                                    <span
                                        class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                    >
                                        Pengaduan HO</span
                                    >
                                </NavLink>
                            </li>
                        </ul>
                    </li>
                    <!-- end BIB -->
                </ul>
            </div>
        </PerfectScrollbar>
    </aside>

    <!-- end sidenav -->
</template>
<style>
@import "/public/assets/css/perfect-scrollbar.css";
</style>
