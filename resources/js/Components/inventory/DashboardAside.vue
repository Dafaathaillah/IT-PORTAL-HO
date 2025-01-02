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

    // Jika level1 ditutup, tutup juga level2
    if (!level1OpenHo.value) {
        level2OpenHo.value = false;
        level2OpenSettingHo.value = false;
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
        level1OpenHo.value = true; // pastikan level 1 terbuka jika level 2 dibuka
        level2OpenHo.value = false;
        level2OpenInspeksiHo.value = false;
        level3OpenHo.value = false;
        level3KomputerOpenHo.value = false;
        level3PrinterOpenHo.value = false;
        level3ScannerOpenHo.value = false;
        level3CctvOpenHo.value = false;
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
                                v-if="
                                    $page.props.auth.user.site == 'HO'
                                "
                                class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                                >Head Office PPA</span
                            >
                            <span
                                v-if="
                                    $page.props.auth.user.site != 'HO'
                                "
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

                                <div
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
                                </div>
                                <ul v-if="level2OpenSettingHo">
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
                                    @click="toggleLevel2AduanBa"
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
                                        :active="route().current('switchBa.page')"
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
                                                route().current('printerBa.page')
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
                                                route().current('scannerBa.page')
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

                                <div
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
                    <!-- end BA -->
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

                                <div
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
