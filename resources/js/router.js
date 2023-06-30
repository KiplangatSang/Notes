

import { createRouter, createWebHistory } from "vue-router";
import Index from "./components/Index.vue";
import Create from "./components/CreateComponent.vue";

const routes = [
    {
        path: "/",
        name: "notes",
        component: Home,
    },
    {
        path: "/notes",
        name: "notes",
        component: Index,
    },
    {
        path: "/create",
        name: "create",
        component: Create,
    },
];
const router = createRouter({
    history: createWebHistory(),
    routes,
});
export default router;
