import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import VueChartkick from 'vue-chartkick'
import 'chartkick/highcharts'

createInertiaApp({
    resolve: name => require(`./pages/${name}`),
    setup({ el, App, props, plugin }) {
        createApp({render: () => h(App, props)})
            .use(plugin)
            .use(VueChartkick)
            .mount(el)
    },
})
