import { createRouter, createWebHistory } from "vue-router";
import Home from "../components/Home.vue";
import Login from "../components/auth/Login.vue";
import Register from "../components/auth/Register.vue";
import Create from "../components/Create.vue";
import Edit from "../components/Edit.vue";
import Customer from "../components/customer/Index.vue";
import CustomerCreate from "../components/customer/Create.vue";
import CustomerEdit from "../components/customer/Edit.vue";
import Product from "../components/product/Index.vue";
import ProductCreate from "../components/product/Create.vue";
import ProductEdit from "../components/product/Edit.vue";
import Pos from "../components/pos/Index.vue";
import Dashboard from "../components/auth/Dashboard.vue";
import { customRef } from "vue";

const routes = [
    {
        path: "/",
        name: "home",
        component: Home,
    },
    {
        path: "/dashboard",
        name: "dashboard",
        component: Dashboard,
    },

    {
        path: "/pos",
        name: "pos",
        component: Pos,
    },
    {
        path: "/edit/:id",
        name: "post.edit",
        component: Edit,
    },
    {
        path: "/index",
        name: "post.index",
        component: Register,
    },
    {
        path: "/c/index",
        name: "customer",
        component: Customer,
    },
    {
        path: "/c/create",
        name: "customer.create",
        component: CustomerCreate,
    },
    {
        path: "/c/edit/:id",
        name: "customer.edit",
        component: CustomerEdit,
    },
    {
        path: "/p/index",
        name: "product",
        component: Product,
    },
    {
        path: "/p/create",
        name: "product.create",
        component: ProductCreate,
    },
    {
        path: "/p/edit/:id",
        name: "product.edit",
        component: ProductEdit,
    },
    {
        path: "/create",
        name: "post.create",
        component: Create,
    },
    {
        path: "/login",
        name: "login",
        component: Login,
    },
    {
        path: "/register",
        name: "register",
        component: Register,
    },
];
//create router
const router = createRouter({
    history: createWebHistory(),
    routes, // config routes
});
export default router;
