import { createWebHistory, createRouter } from "vue-router";
import { userAuthStore } from "@/store/auth";


/* Layouts */
const AuthenticatedLayout = () => import("@/components/Layouts/AuthenticatedLayout.vue");
const GuestLayout = () => import("@/components/Layouts/GuestLayout.vue");
const VisitorQRLayout = () => import("@/components/Layouts/VisitorQRLayout.vue");
/* Layouts */

// GUEST PAGES
const Home = () => import("@/components/GuestPages/Home.vue");
const Login = () => import("@/components/GuestPages/Login.vue");


// AUTHETICATED PAGES
const Dashboard = () => import("@/components/AuthenticatedPages/Dashboard.vue");
const Users = () => import("@/components/AuthenticatedPages/Users.vue");
const Settings = () => import("@/components/AuthenticatedPages/Settings.vue");
const Buildings = () => import("@/components/AuthenticatedPages/Buildings.vue");
const Visitors = () => import("@/components/AuthenticatedPages/Visitors.vue");

// VISITOR REGISTRATION PAGE
const VisitorPrompt = () => import("@/components/VisitorRegistration/VisitorPrompt.vue");
const VisitorHomepage = () => import("@/components/VisitorRegistration/VisitorHomepage.vue");
const NewRegistration = () => import("@/components/VisitorRegistration/VisitorCards/NewRegistration/NewRegistration.vue");
const RegPrompt = () => import("@/components/VisitorRegistration/VisitorCards/NewRegistration/RegPrompt.vue");

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
            title: "VMS | App",
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
            {
                name: "visitors",
                path: "/app/visitors",
                component: Visitors,
                meta: {
                    title: `VMS | Visitors`,
                    ability: "",
                },
            },
            {
                name: "deliveries",
                path: "/app/deliveries",
                component: Visitors,
                meta: {
                    title: `VMS | Deliveries`,
                    ability: "",
                },
            },
            {
                name: "profile",
                path: "/app/profile",
                component: Visitors,
                meta: {
                    title: `VMS | Profile`,
                    ability: "",
                },
            },
            
        ],
    },

    {
        path: "/visitor-registration",
        component: VisitorQRLayout,
        meta: {
            middleware: "vqr",
            title: `VMS | Visitor Registration`,    
        },
        children: [
            {
                name: "visitor",
                path: "/visitor-registration/:id",
                component: VisitorPrompt,
                meta: {
                    title: `VMS | Visitor Registration`,
                },
            },
            {
                name: "index",
                path: "/visitor-registration/index/:id",
                component: VisitorHomepage,
                meta: {
                    title: `VMS | Visitor Registration`,
                },
            },
            {
                name: "create",
                path: "/visitor-registration/create/:id",
                component: NewRegistration,
                meta: {
                    title: `VMS | Visitor Registration`,
                },
            },            {
                name: "regprompt",
                path: "/visitor-registration/details/:id",
                component: RegPrompt,
                meta: {
                    title: `VMS | Visitor Registration`,
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