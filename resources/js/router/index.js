import { createWebHistory, createRouter } from "vue-router";
import { userAuthStore } from "@/store/auth";


/* Layouts */
const AuthenticatedLayout = () => import("@/components/Layouts/AuthenticatedLayout.vue");
const HomeownerLayout = () => import("@/components/Layouts/HomeownerLayout.vue");
const GuestLayout = () => import("@/components/Layouts/GuestLayout.vue");
const VisitorQRLayout = () => import("@/components/Layouts/VisitorQRLayout.vue");
const HostQRLayout = () => import("@/components/Layouts/HostQRLayout.vue");
/* Layouts */

// PAGE NOT FOUND
const PageNotFound = () => import("@/components/PageNotFound/PageNotFound.vue");

// GUEST PAGES
const Home = () => import("@/components/GuestPages/Home.vue");
const Login = () => import("@/components/GuestPages/Login.vue");

// AUTHETICATED PAGES
const Dashboard = () => import("@/components/AuthenticatedPages/Dashboard.vue");
const Users = () => import("@/components/AuthenticatedPages/Users.vue");
const Settings = () => import("@/components/AuthenticatedPages/Settings.vue");
const Buildings = () => import("@/components/AuthenticatedPages/Buildings.vue");
const Visitors = () => import("@/components/AuthenticatedPages/Visitors.vue");
const Testing = () => import("@/components/AuthenticatedPages/testing.vue");
const Deliveries = () => import("@/components/AuthenticatedPages/Deliveries.vue");

// HOST REGISTRATION PAGE
const HostRegistration = () => import("@/components/HostRegistration/HostRegistration.vue");
const HostSuccess = () => import("@/components/HostRegistration/HostSuccess.vue");

// VISITOR REGISTRATION PAGE
const VisitorPrompt = () => import("@/components/VisitorRegistration/VisitorPrompt.vue");
const VisitorHomepage = () => import("@/components/VisitorRegistration/VisitorHomepage.vue");
const NewRegistration = () => import("@/components/VisitorRegistration/VisitorCards/NewRegistration/NewRegistration.vue");
const RegPrompt = () => import("@/components/VisitorRegistration/VisitorCards/NewRegistration/RegPrompt.vue");
const RegSuccess = () => import("@/components/VisitorRegistration/VisitorCards/NewRegistration/RegSuccess.vue");

// VISITOR CHECK IN
const CheckInPrompt = () => import("@/components/VisitorRegistration/VisitorCards/Check-In/CheckInPrompt.vue");
const CheckInForm = () => import("@/components/VisitorRegistration/VisitorCards/Check-In/CheckInForm.vue");
const CheckInSuccess = () => import("@/components/VisitorRegistration/VisitorCards/Check-In/CheckInSuccess.vue");

// VISITOR CHECK OUT
const CheckOutPrompt = () => import("@/components/VisitorRegistration/VisitorCards/Check-Out/CheckOutPrompt.vue");
const CheckOutForm = () => import("@/components/VisitorRegistration/VisitorCards/Check-Out/CheckOutForm.vue");
const CheckOutSuccess = () => import("@/components/VisitorRegistration/VisitorCards/Check-Out/CheckOutSuccess.vue");

//INVITED GUEST
const InvitePrompt = () => import("@/components/VisitorRegistration/VisitorCards/InvitedGuest/InvitePrompt.vue");
const InviteForm = () => import("@/components/VisitorRegistration/VisitorCards/InvitedGuest/InviteForm.vue");
const InviteSuccess = () => import("@/components/VisitorRegistration/VisitorCards/InvitedGuest/InviteSuccess.vue");

// DELIVERY SERVICES

const DeliveryPrompt = () => import("@/components/VisitorRegistration/VisitorCards/DeliveryServices/DeliveryPrompt.vue");
const DeliveryForm = () => import("@/components/VisitorRegistration/VisitorCards/DeliveryServices/DeliveryForm.vue");
const DeliverySuccess = () => import("@/components/VisitorRegistration/VisitorCards/DeliveryServices/DeliverySuccess.vue");

// HOMEOWNER PAGES
const hDashboard = () => import("@/components/HomeownerPages/hDashboard.vue");

//TERMS AND CONDITION x PRIVACY POLICY
const Terms = () => import("@/components/VisitorRegistration/TermsPrivacy.vue");

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
        redirect: "/app/dashboard",
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
                component: Deliveries,
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
                name: "regcreate",
                path: "/visitor-registration/create/:id",
                component: NewRegistration,
                meta: {
                    title: `VMS | Visitor Registration`,
                },
            },            
            {
                name: "regprompt",
                path: "/visitor-registration/signIn/reg/:id",
                component: RegPrompt,
                meta: {
                    title: `VMS | Visitor Registration`,
                },
            },
            {
                name: "regsuccess",
                path: "/visitor-registration/success/:id",
                component: RegSuccess,
                meta: {
                    title: `VMS | Visitor Registration`,
                },
            },
            {
                name: "checkinprompt",
                path: "/visitor-registration/signIn/checkin/:id",
                component: CheckInPrompt,
                meta: {
                    title: `VMS | Visitor Registration`,
                },
            },
            {
                name: "checkinform",
                path: "/visitor-registration/checkin/:id",
                component: CheckInForm,
                meta: {
                    title: `VMS | Visitor Registration`,
                },
            },
            {
                name: "checkinsuccess",
                path: "/visitor-registration/success/checkin/:id",
                component: CheckInSuccess,
                meta: {
                    title: `VMS | Visitor Registration`,
                },
            },
            {
                name: "checkoutprompt",
                path: "/visitor-registration/signIn/checkout/:id",
                component: CheckOutPrompt,
                meta: {
                    title: `VMS | Visitor Registration`,
                },
            },
            {
                name: "checkoutform",
                path: "/visitor-registration/checkout/:id",
                component: CheckOutForm,
                meta: {
                    title: `VMS | Visitor Registration`,
                },
            },
            {
                name: "checkoutsuccess",
                path: "/visitor-registration/success/checkout/:id",
                component: CheckOutSuccess,
                meta: {
                    title: `VMS | Visitor Registration`,
                },
            },
            {
                name: "deliveryprompt",
                path: "/visitor-registration/signIn/delivery/:id",
                component: DeliveryPrompt,
                meta: {
                    title: `VMS | Visitor Registration`,
                },
            },
            {
                name: "deliveryform",
                path: "/visitor-registration/delivery/:id",
                component: DeliveryForm,
                meta: {
                    title: `VMS | Visitor Registration`,
                },
            },
            {
                name: "deliverysuccess",
                path: "/visitor-registration/success/delivery/:id",
                component: DeliverySuccess,
                meta: {
                    title: `VMS | Visitor Registration`,
                },
            },
            {
                name: "inviteprompt",
                path: "/visitor-registration/signIn/invite/:id",
                component: InvitePrompt,
                meta: {
                    title: `VMS | Visitor Registration`,
                },
            },
            {
                name: "inviteform",
                path: "/visitor-registration/invite/:id",
                component: InviteForm,
                meta: {
                    title: `VMS | Visitor Registration`,
                },
            },
            {
                name: "invitesuccess",
                path: "/visitor-registration/success/invite/:id",
                component: InviteSuccess,
                meta: {
                    title: `VMS | Visitor Registration`,
                },
            },
        ],
    },
    {
        path: "/homeowner-registration",
        component: HostQRLayout,
        meta: {
            middleware: "hqr",
            title: `VMS | Homeowner Registration`,
        },
        children: [
            {
                name: "hostreg",
                path: "/homeowner-registration/:id",
                component: HostRegistration,
                meta: {
                    title: `VMS | Homeowner Registration`,
                },
            },
            {
                name: "hostsuccess",
                path: "/homeowner-registration/success/:id",
                component: HostSuccess,
                meta: {
                    title: `VMS | Homeowner Registration`,
                },
            },
        ],
    },
    {
        path: "/Terms-and-Condition",
        component: Terms,
        meta: {
            middleware: "terms",
            title: `VMS | Terms and Conditions`,
        },
    },
    {
        path: "/testing",
        component: Testing,
        meta: {
            middleware: "test",
            title: `Test`,
        },
    },
    {
        name: 'userpage',
        path: "/homeowner",
        component: HomeownerLayout,
        redirect: "/homeowner/dashboard",
        meta: {
            middleware: "user",
            title: `VMS | Homeowner`,
        },
        children:[
            {
                name: "hDashboard",
                path: "/homeowner/dashboard",
                component: hDashboard,
                meta: {
                    title: `VMS | Dashboard`,
                },
            }
        ],
    },

    {
        name: '404',
        path: "/404",
        component: PageNotFound,
        meta: {
            middleware: "notfound",
            title: `Page Not Found`,
        },
    },
    {
        path: "/:pathMatch(.*)*",
        redirect: '404'
    },
    {
        path: "/:catchAll(.*)",
        redirect: '404'
    }
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
    } else if (to.meta.middleware == 'vqr') {
        // if(to.params.id != this.id){
        //     next({name: "404"});
        // }
        next();
    } else {
        next();
    }
});

export default router;