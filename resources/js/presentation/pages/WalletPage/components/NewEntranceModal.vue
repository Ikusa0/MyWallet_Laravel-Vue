<template>
    <Modal
        :title="`Nova ${type}`"
        :formData="formData"
        :closeFunction="closeFunction"
    />
</template>

<script setup>
import Modal from "../../../components/Modal.vue";
const { type, closeFunction } = defineProps(["type", "closeFunction"]);

const formData = {
    form: {
        onSubmit: async (formValues) => {
            formValues.type = type;
            formValues.date = new Date().toISOString().split('T')[0];
            try {
                const response = await axios.post("/wallet", formValues);
                if (response.data.redirect) {
                    window.location.href = response.data.redirect;
                } else {
                    console.error(response.data.error);
                }
            } catch (error) {
                console.error("An error occurred:", error);
            }
            closeFunction();
        },
    },
    inputs: [
        {
            placeholder: "Valor",
            name: "value",
            type: "text",
            inputMask(value) {
                let result = value
                    .replace(".", "")
                    .replace(",", "")
                    .replace(/\D/g, "");

                const options = {
                    minimumFractionDigits: 2,
                    useGrouping: false,
                };
                result = new Intl.NumberFormat("pt-BR", options)
                    .format(parseFloat(result.replace(/[^0-9.]/g, "")) / 100)
                    .replace(",", ".");

                return result;
            },
            required: true,
        },
        {
            placeholder: "Descrição",
            type: "text",
            name: "description",
            required: true,
        },
    ],
    button: {
        text: `Salvar ${type}`,
    },
};
</script>
