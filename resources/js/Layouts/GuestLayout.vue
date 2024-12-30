<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";

const yearxyz = new Date().getFullYear();
</script>

<template>
    <div class="container sticky top-0 z-sticky">
        <div class="flex flex-wrap -mx-3">
            <div class="w-full max-w-full px-3 flex-0">
                <!-- Navbar -->
                <nav
                    class="absolute top-0 left-0 right-0 z-30 flex flex-wrap items-center px-4 py-2 m-6 mb-0 shadow-sm rounded-xl bg-white/80 backdrop-blur-2xl backdrop-saturate-200 lg:flex-nowrap lg:justify-start"
                >
                    <div
                        class="flex items-center justify-between w-full p-0 px-0 md:px-6 lg:px-6 mx-auto flex-wrap-inherit"
                    >
                        <img
                            src="/images/logoppa.png"
                            alt="message placeholder image"
                            class="size-8 md:size-16 lg:size-16"
                        />
                        <span
                            class="py-1.75 mr-4 ml-4 whitespace-nowrap font-bold text-slate-700 lg:ml-0 text-base lg:text-2xl"
                            >PORTAL ICT CENTER</span
                        >
                        <img
                            src="/images/POLICE_LOGO2.png"
                            alt="message placeholder image"
                            class="size-12 md:size-24 lg:size-24"
                        />
                        
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <main class="mt-0 transition-all duration-200 ease-in-out">
        <!-- <div
            class="pb-0 pt-0 h-full min-h-screen items-start p-0 relative overflow-hidden flex bg-cover bg-center bg-[url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signin-basic.jpg')]"
        > -->
        <div
            class="pb-4 pt-0 h-full min-h-screen items-start p-0 relative overflow-hidden flex bg-cover bg-center bg-[url('/IJZ_2751.jpg')]"
        >
            <span
                class="absolute top-0 left-0 w-full h-full bg-center bg-cover opacity-60 bg-gradient-to-tl from-zinc-800 to-zinc-700"
            ></span>
            <div class="container">
                <div class="container mt-36">
                    <h4
                        class="flex justify-center z-20 mt-12 font-bold drop-shadow-[0_1.2px_1.2px_rgba(0,0,0.8)] text-red-600"
                    >
                        PPA
                        <i
                            class="font-black drop-shadow-[0_1.2px_1.2px_rgba(0,0,0.8)] text-white"
                            >values</i
                        >
                    </h4>
                    <div class="flex flex-wrap -mx-3">
                        <div
                            class="w-full max-w-full px-3 mx-auto mb-6 text-center flex justify-center items-center flex-wrap lg:w-12/12"
                        >
                            <a
                                href="javascript:;"
                                class="mb-2 mr-4 p-1 font-black drop-shadow-[0_1.2px_1.2px_rgba(0,0,0.8)] uppercase text-white sm:mb-0 xl:mr-12"
                                >Devotion</a
                            >
                            <a
                                href="javascript:;"
                                class="mb-2 mr-4 p-1 font-black drop-shadow-[0_1.2px_1.2px_rgba(0,0,0.8)] uppercase text-white sm:mb-0 xl:mr-12"
                                >Integrity</a
                            >
                            <a
                                href="javascript:;"
                                class="mb-2 mr-4 p-1 font-black drop-shadow-[0_1.2px_1.2px_rgba(0,0,0.8)] uppercase text-white sm:mb-0 xl:mr-12"
                                >Teamwork</a
                            >
                            <a
                                href="javascript:;"
                                class="mb-2 mr-4 p-1 font-black drop-shadow-[0_1.2px_1.2px_rgba(0,0,0.8)] uppercase text-white sm:mb-0 xl:mr-12"
                                >Creativity</a
                            >
                            <a
                                href="javascript:;"
                                class="mb-2 mr-4 p-1 font-black drop-shadow-[0_1.2px_1.2px_rgba(0,0,0.8)] uppercase text-white sm:mb-0 xl:mr-12"
                                >Winner</a
                            >
                            <a
                                href="javascript:;"
                                class="mb-2 mr-4 p-1 font-black drop-shadow-[0_1.2px_1.2px_rgba(0,0,0.8)] uppercase text-white sm:mb-0 xl:mr-12"
                                >Perfection</a
                            >
                        </div>
                    </div>
                </div>
                <div
                    class="flex flex-wrap justify-center mt-10 -mx-3"
                >
                    <div
                        class="w-full max-w-full px-6 mx-auto shrink-0 md:flex-0 md:w-7/12 lg:w-5/12 xl:w-4/12"
                    >
                        <div
                            class="relative z-0 flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border"
                        >
                            <div
                                class="text-center border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6"
                            >
                                <h5 class="mt-2 mb-4">Sign in</h5>
                                <div class="text-center">
                                    <!-- <a
                                        href="javascript:;"
                                        class="inline-block px-8 py-2 text-xs font-bold leading-normal text-center align-middle transition-all ease-in bg-transparent rounded-lg shadow-md cursor-pointer select-none active:-translate-y-px hover:-translate-y-px hover:shadow-xs text-slate-500 tracking-tight-rem"
                                    >
                                        <img
                                            src="assets/img/logos/github.svg"
                                            alt="social icon"
                                            class="w-3/10"
                                        />
                                        Github
                                    </a>
                                    <a
                                        href="javascript:;"
                                        class="inline-block px-8 py-2 text-xs font-bold leading-normal text-center align-middle transition-all ease-in bg-transparent rounded-lg shadow-md cursor-pointer select-none active:-translate-y-px hover:-translate-y-px hover:shadow-xs text-slate-500 tracking-tight-rem"
                                    >
                                        <img
                                            src="assets/img/logos/google.svg"
                                            alt="social icon"
                                            class="w-3/10"
                                        />
                                        Google
                                    </a> -->
                                </div>
                            </div>
                            <slot />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer class="py-12">
        <div class="container">
            <div class="flex flex-wrap -mx-3"></div>
            <div class="flex flex-wrap -mx-3">
                <div
                    class="w-8/12 max-w-full px-3 mx-auto mt-1 text-center flex-0"
                >
                    <p class="mb-0 text-slate-400">
                        Copyright ©
                        {{ yearxyz }}
                        by ICT PPA BIB.
                    </p>
                </div>
            </div>
        </div>
    </footer>
</template>
