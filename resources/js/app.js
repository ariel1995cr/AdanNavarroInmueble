require('./bootstrap');

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'
import VueGoogleMaps from '@fawmi/vue-google-maps'

createInertiaApp({
    resolve: name => require(`./Pages/${name}`),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(VueGoogleMaps,{
                load: {
                    key: 'AIzaSyD62MSPtoCBTPdiiI91RRJl0o0qdEsBdII',
                    libraries: 'places'
                },
            })
            .mount(el)
    },
})

InertiaProgress.init({
    // The delay after which the progress bar will
    // appear during navigation, in milliseconds.
    delay: 0,

    // The color of the progress bar.
    color: '#000',

    // Whether to include the default NProgress styles.
    includeCSS: true,

    // Whether the NProgress spinner will be shown.
    showSpinner: true,
})