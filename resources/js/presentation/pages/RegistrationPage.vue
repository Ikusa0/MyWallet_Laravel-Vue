<template>
    <div class="page">
        <Logo />
        <Form :data="formData" />
        <a href="#">Já tem uma conta? Entre agora!</a>
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
            placeholder: "Nome",
            name: "name",
            required: true,
        },
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
        {
            placeholder: "Confirme a senha",
            type: "password",
            name: "passwordConfirmation",
            required: true,
        },
    ],
    button: {
        text: "Cadastrar",
    },
};
</script>
