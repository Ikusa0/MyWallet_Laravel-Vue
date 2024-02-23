<template>
    <div :class="`modal ${state}`">
        <div class="page">
            <header>
                <h1>{{ title }}</h1>
                <button @click="closeFunction">Voltar</button>
            </header>
            <Form :data="formData" />
        </div>
    </div>
</template>

<script setup>
import Form from "../components/Form.vue";
const { title, formData, closeFunction } = defineProps(["title", "formData", "closeFunction"]);
</script>

<style scoped>
.modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: var(--purple);
    z-index: 1;
}

.modal.closed {
    display: none;
}

.page {
    justify-content: start;
}

header {
    width: 100%;
    display: flex;
    justify-content: space-between;
}

header > h1 {
    font-size: 1.5rem;
}

header > button {
    color: var(--light-gray);
}
</style>
