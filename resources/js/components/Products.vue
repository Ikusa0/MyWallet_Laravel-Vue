<template>
    <div>
        {{ name }}
        <input type="text" name="name" v-model="name" />
    </div>
</template>

<script setup>
import { ref } from "vue";

const name = ref("");
</script>
