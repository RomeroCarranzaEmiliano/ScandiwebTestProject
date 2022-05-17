import {createWebHistory, createRouter} from "vue-router";

import ProductListView from "@/views/ProductListView";
import FooterComponent from "@/components/FooterComponent";
import AddProductView from "@/views/AddProductView";

const routes = [
    {
        path: "/",
        components: {
            default: ProductListView,
            FooterComponent,
        },
        props: {
            NavbarComponent: true, default: false, FooterComponent: false,
        },
    },
    {
        path: "/add-product",
        components: {
            default: AddProductView,
            FooterComponent,
        },
        props: {},
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;