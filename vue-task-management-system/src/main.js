import "./assets/main.css";

import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";
import axios from "axios";
import { useStore } from "vuex";
import Vuex from "vuex";
import ToastPlugin from "vue-toast-notification";
import "vue-toast-notification/dist/theme-bootstrap.css";
import store from "./store";

axios.defaults.baseURL = "http://localhost:8000";
axios.defaults.headers.post["Content-Type"] = "multipart/form-data";
axios.defaults.headers.post["Accept"] = "application/json";
axios.defaults.withCredentials = true;
axios.interceptors.request.use(function (config) {
  const token = localStorage.getItem("auth_t");
  config.headers.Authorization = token ? `Bearer ${token}` : "";
  return config;
});

const app = createApp(App);
// const store = useStore();
app.use(router);
app.use(store);
app.use(Vuex);
app.use(ToastPlugin);
app.mount("#app");
