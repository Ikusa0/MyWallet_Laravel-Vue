<template>
    <div class="page">
        <Logo />
        <Form :data="formData" />
        <a href="register">Primeira vez? Cadastre-se!</a>
    </div>
</template>

<script setup>
import Logo from "../components/Logo.vue";
import Form from "../components/Form.vue";
import axios from "axios";

const formData = {
    form: {
        onSubmit: async (formValues) => {
            try {
                const response = await axios.post("/login", formValues);
                if (response.data.redirect) {
                    window.location.href = response.data.redirect;
                } else {
                    console.error(response.data.error);
                }
            } catch (error) {
                console.error("An error occurred:", error);
            }
        },
    },
    inputs: [
        {
            placeholder: "E-mail",
            name: "email",
            type: "email",
            required: true,
        },
        {
            placeholder: "Senha",
            type: "password",
            name: "password",
            required: true,
        },
    ],
    button: {
        text: "Entrar",
    },
};
</script>
