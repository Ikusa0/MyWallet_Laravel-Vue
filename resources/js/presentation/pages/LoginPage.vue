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

const formData = {
    form: {
        onSubmit: async (formValues) => {
            console.log(formValues);
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
