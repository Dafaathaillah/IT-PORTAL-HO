import './bootstrap';
import '../css/app.css';
import 'select2/dist/css/select2.min.css';
import 'select2';

import DataTable from 'datatables.net-vue3';
import DataTablesLib from 'datatables.net';
import 'datatables.net-buttons';
import 'datatables.net-buttons/js/buttons.html5';
import jszip from 'jszip';
 
DataTable.use(DataTablesLib);
DataTablesLib.Buttons.jszip(jszip);

import $ from 'jquery';
window.$ = window.jQuery = $;

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import VueDatePicker from '@vuepic/vue-datepicker';
import VueMultiselect from 'vue-multiselect';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .component('DataTable', DataTable) 
            .component('vueDatePicker', VueDatePicker) 
            .component('VueMultiselect', VueMultiselect)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
