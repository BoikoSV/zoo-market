import { createApp } from 'vue'
import App from './App.vue'
import { VSkeletonLoader } from 'vuetify/labs/VSkeletonLoader'
import 'vue3-toastify/dist/index.css';

import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import {VTextField, VSelect, VBtn, VForm, VCard, VProgressCircular} from 'vuetify/components'
import * as directives from 'vuetify/directives'

const vuetify = createVuetify({
    components: {
        VSkeletonLoader,
        VTextField,
        VSelect,
        VBtn,
        VForm,
        VCard,
        VProgressCircular
    },
    directives,
})

createApp(App).use(vuetify).mount('#app')
