import "./bootstrap";
import { createApp } from "vue";
import './presentation/styles/global.css'

import LoginPage from "./presentation/pages/LoginPage.vue";

const app = createApp();

app.component("login", LoginPage);

app.mount("#app");
