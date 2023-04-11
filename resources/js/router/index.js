import { createWebHistory, createRouter } from "vue-router";
import { userAuthStore } from "@/store/auth";


/* Layouts */
const AuthenticatedLayout = () => import("@/components/Layouts/AuthenticatedLayout.vue");
const GuestLayout = () => import("@/components/Layouts/GuestLayout.vue");
/* Layouts */

// GUEST PAGES
const Home = () => import("@/components/GuestPages/Home.vue");
const Login = () => import("@/components/GuestPages/Login.vue");


// AUTHETICATED PAGES
const Dashboard = () => import("@/components/AuthenticatedPages/Dashboard.vue");
const Users = () => import("@/components/AuthenticatedPages/Users.vue");
const Settings = () => import("@/components/AuthenticatedPages/Settings.vue");
const Buildings = () => import("@/components/AuthenticatedPages/Buildings.vue");
//const Visitors = () => import("@/components/AuthenticatedPages/Visitors.vue");

const routes = [
    {
        path: "/",
        component: GuestLayout,
        meta: {
            middleware: "guest",
        },
        children: [
            {
                name: "home",
                path: "/",
                component: Home,
                meta: {
                    title: `Home`,
                },
            },
            {
                name: "login",
                path: "/login",
                component: Login,
                meta: {
                    title: `VMS Login`,
                },
            }
        ],
    },

    {
        path: "/app",
        component: AuthenticatedLayout,
        meta: {
            middleware: "auth",
        },
        children: [
            {
                name: "dashboard",
                path: "/app/dashboard",
                component: Dashboard,
                meta: {
                    title: `VMS | Dashboard`,
                    ability: "",
                },
            },
            {
                name: "users",
                path: "/app/users",
                component: Users,
                meta: {
                    title: `VMS | User`,
                    ability: "",
                },
            },
            {
                name: "settings",
                path: "/app/settings",
                component: Settings,
                meta: {
                    title: `VMS | Settings`,
                    ability: "",
                },
            },
            {
                name: "buildings",
                path: "/app/buildings",
                component: Buildings,
                meta: {
                    title: `VMS | Buildings`,
                    ability: "",
                },
            },
            
        ],
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes, // short for `routes: routes`
    watch: {
        $route(to) {
            if (to.currentRoute.meta.reload == true) {
                window.location.reload();
            }
        },
    },
    scrollBehavior() {
        document.getElementById("app").scrollIntoView();
    },
});


router.beforeEach((to, from, next) => {
    document.title = to.meta.title;
    if (to.meta.middleware == "guest") {
        if (userAuthStore().authenticated) {
            next({ name: "dashboard" });
        }
        next();
    } else {
        next();
    }
});

export default router;