import "./bootstrap";
import { createApp } from "vue";
import "./presentation/styles/global.css";

import LoginPage from "./presentation/pages/LoginPage.vue";
import RegistrationPage from "./presentation/pages/RegistrationPage.vue";
import WalletPage from "./presentation/pages/WalletPage/WalletPage.vue";

const app = createApp();

app.component("login", LoginPage);
app.component("registration", RegistrationPage);
app.component("wallet", WalletPage)

app.mount("#app");
