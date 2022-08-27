import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";
import LoginView from "../views/LoginView.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      redirect: {
        name: "login",
      },
    },
    {
      path: "/admin",
      name: "admin",
      component: () => import("../views/AdminView.vue"),
      // beforeEnter: checkLogin,
      beforeEnter() {
        if (localStorage.getItem("access_token") == null) {
          return { path: "/login" };
        }
      },
    },
    {
      path: "/login",
      name: "login",
      component: LoginView,
    },
    {
      path: "/admin/currencies",
      name: "currencies",
      component: () => import("../views/CurrenciesView.vue"),
      beforeEnter() {
        if (localStorage.getItem("access_token") == null) {
          return { path: "/login" };
        }
      },
    },
    {
      path: "/admin/pairs",
      name: "pairs",
      component: () => import("../views/PairsView.vue"),
      beforeEnter() {
        if (localStorage.getItem("access_token") == null) {
          return { path: "/login" };
        }
      },
    },
  ],
});

export default router;
