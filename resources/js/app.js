
import "./bootstrap";
import { createApp } from "vue";
import router from "./router";

import App from "./components/AppComponent.vue";

const app = createApp(App).use(router).mount('#app');

