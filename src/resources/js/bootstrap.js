import Echo from 'laravel-echo'
import Pusher from 'pusher-js'
import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import { Quasar } from 'quasar'
import 'quasar/dist/quasar.css'
import '@quasar/extras/material-icons/material-icons.css'
import '../css/app.css'

window.Pusher = Pusher

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT,
    wssPort: import.meta.env.VITE_REVERB_PORT,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
})

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        return pages[`./Pages/${name}.vue`]
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(Quasar, {
                plugins: {},
            })
            .mount(el)
    },
})
