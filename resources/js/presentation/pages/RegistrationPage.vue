<template>
    <div class="page">
        <Logo />
        <Form :data="formData" />
        <a href="login">Já tem uma conta? Entre agora!</a>
    </div>
</template>

<script setup>
import Logo from "../components/Logo.vue";
import Form from "../components/Form.vue";

const formData = {
    form: {
        onSubmit: async (formValues) => {
            try {
                const response = await axios.post("/register", formValues);
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
