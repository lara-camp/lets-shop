import './bootstrap'
import  "primeflex/primeflex.css";
import { createApp, h } from 'vue'
import { createInertiaApp, Head } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import PrimeVue from 'primevue/config'
import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
import Checkbox from 'primevue/checkbox';

createInertiaApp({
  resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
  setup ({ el, App, props, plugin }) {
    return createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(PrimeVue,{ ripple: true })
      .component("Button",Button)
      .component("InputText",InputText)
      .component("Checkbox",Checkbox)
      .component("Head",Head)
      .mixin({ methods: { route } })
      .mount(el)
  },
})
