import './bootstrap'
import 'primeflex/primeflex.css'
import { createApp, h } from 'vue'
import { createInertiaApp, Head } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import ToastService from 'primevue/toastservice'
import PrimeVue from 'primevue/config'
import Ripple from 'primevue/ripple'

createInertiaApp({
  resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
  setup ({ el, App, props, plugin }) {
    return createApp({ render: () => h(App, props) })
      .directive('ripple', Ripple)
      .use(plugin)
      .use(PrimeVue, { ripple: true })
      .use(ToastService)
      .component('Head', Head)
      .mixin({ methods: { route } })
      .mount(el)
  },
})
