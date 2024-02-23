<template>
    <form autocomplete="on" @submit.prevent="onSubmit">
        <input
            v-for="(input, index) in data.inputs"
            :key="index"
            :type="input.type || 'text'"
            :placeholder="input.placeholder"
            :required="input.required"
            :disabled="disabled || input.disabled"
            @input="
                updateFormValue(
                    input.name,
                    $event.target,
                    input.inputMask
                )
            "
        />
        <button :disabled="disabled">{{ data.button.text }}</button>
    </form>
</template>

<script setup>
import { ref } from "vue";
const { data } = defineProps(["data"]);

const formValues = {};
let disabled = ref(false);

const updateFormValue = (name, target, inputMask) => {
    let value = target.value;
    if (inputMask) {
        value = inputMask(value);
    }
    target.value = value;
    formValues[name] = value;
};

const onSubmit = async () => {
    disabled.value = true;
    await data.form.onSubmit(formValues);
    disabled.value = false;
};
</script>

<style>
form {
    width: 100%;
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

form > input::placeholder,
form > input {
    font-weight: 400;
    font-size: 1.15rem;
    color: var(--black);
}

form > input {
    padding: 1rem;
    border-radius: 0.5rem;
}

form > button {
    background-color: var(--light-purple);
    padding: 0.75rem;
    font-size: 1.15rem;
    border-radius: 0.25rem;
}
</style>
