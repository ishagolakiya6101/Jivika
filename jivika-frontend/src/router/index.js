import Home from "@/components/pages/HomePage";
import Component from "@/components/pages/MyComponent";
import Services from "@/components/pages/ServicePage";
import Register from "@/components/pages/Register";
import Login from "@/components/pages/Login";
import Profile from "@/components/pages/Profile";
import { createRouter, createWebHashHistory } from "vue-router";

const routes = [
  {
    path: "/",
    name: "home",
    component: Home,
  },
  {
    path: "/component",
    name: "component",
    component: Component,
  },
  {
    path: "/services",
    name: "services",
    component: Services,
  },
  {
    path: "/login",
    name: "login",
    component: Login,
  },
  {
    path: "/profile",
    name: "profile",
    component: Profile,
  },
  {
    path: "/register",
    name: "register",
    component: Register,
  },
];

const router = createRouter({
  history: createWebHashHistory(),
  routes,
});

export default router;
