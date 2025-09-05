import { createApp } from "vue";
import router from "./router";
import App from "./App.vue";
import "./assets/css/global.css"; // Import the global CSS file
import "@fortawesome/fontawesome-free/css/all.css"; // Ensure you are using css-loader
import "bootstrap/dist/css/bootstrap.min.css";
import "jquery/src/jquery.js";
import { VueClipboard } from "@soerenmartius/vue3-clipboard";
import Toast from "vue-toastification";
// Import the CSS or use your own!
import "vue-toastification/dist/index.css";

const options = {
    // You can set your default options here
};

createApp(App).use(VueClipboard).use(router).use(Toast, options).mount("#app");
