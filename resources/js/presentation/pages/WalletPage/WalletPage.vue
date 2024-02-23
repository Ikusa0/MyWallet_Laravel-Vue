<template>
    <div class="page">
        <NewEntranceModal
            v-if="newEntranceModal.isVisible.value"
            :type="newEntranceModal.type.value"
            :closeFunction="toggleNewEntranceModal"
        />
        <header>
            <h1>Olá, {{ user }}</h1>
            <button @click="logout">Sair</button>
        </header>
        <section class="wallet">
            <ul>
                <li v-for="entry in walletData?.walletEntries" :key="entry.id">
                    <div class="left">
                        <span class="date">{{ formatDate(entry.date) }}</span>
                        <span class="item">{{ entry.description }}</span>
                    </div>
                    <div class="right">
                        <span
                            :class="`price ${
                                entry.type === 'saída' ? 'negative' : 'positive'
                            }`"
                            >{{ entry.value }}</span
                        >
                        <span class="delete" @click="deleteEntry(entry.id)"
                            >X</span
                        >
                    </div>
                </li>
            </ul>
            <footer>
                <h3>SALDO</h3>
                <p
                    :class="`price ${
                        walletData?.totalBalance < 0 ? 'negative' : 'positive'
                    }`"
                >
                    {{ walletData?.totalBalance }}
                </p>
            </footer>
        </section>
        <section class="menu">
            <button
                @click="() => toggleNewEntranceModal('entrada')"
                class="income"
            >
                <div>+</div>
                <p>Nova entrada</p>
            </button>
            <button
                @click="() => toggleNewEntranceModal('saída')"
                class="outcome"
            >
                <div>-</div>
                <p>Nova saída</p>
            </button>
        </section>
    </div>
</template>

<script setup>
import NewEntranceModal from "./components/NewEntranceModal.vue";
import { formatDate } from "../../utils/format-date.js";
import axios from "axios";
import { onMounted, ref } from "vue";

let { user } = defineProps(["user"]);

const walletData = ref(null);
const loadWalletData = async () => {
    try {
        const response = await axios.get("/wallet");
        walletData.value = response.data;
    } catch (error) {
        console.error("Error loading wallet data:", error);
    }
};

const deleteEntry = async (id) => {
    try {
        const response = await axios.delete("/wallet", { data: { id } });
        if (response.data.redirect) {
            window.location.href = response.data.redirect;
        } else {
            console.error(response.data.error);
        }
    } catch (error) {
        console.error("An error occurred:", error);
    }
};

const newEntranceModal = { isVisible: ref(false), type: ref("") };

const toggleNewEntranceModal = (type = "") => {
    newEntranceModal.type.value = type;
    newEntranceModal.isVisible.value = !newEntranceModal.isVisible.value;
};

const logout = async () => {
    try {
        const response = await axios.get("/logout");
        if (response.data.redirect) {
            window.location.href = response.data.redirect;
        } else {
            console.error(response.data.error);
        }
    } catch (error) {
        console.error("An error occurred:", error);
    }
};

onMounted(loadWalletData);
</script>

<style scoped>
.page {
    gap: 1rem;
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

.wallet {
    background-color: var(--white);
    width: 100%;
    height: 100%;
    border-radius: 0.5rem;
    padding: 0.75rem;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.wallet > ul {
    width: 100%;
}

.wallet li {
    display: flex;
    justify-content: space-between;
    padding: 0.5rem 0;
}

.wallet div {
    display: flex;
    gap: 0.5rem;
}

.wallet div > span {
    font-size: 0.85rem;
    font-weight: 400;
}

.wallet .left > .date,
.wallet .right > .delete {
    color: var(--light-gray);
}

.wallet .right > .delete:hover {
    cursor: pointer;
    color: var(--red);
}

.wallet .left > .item {
    color: var(--black);
}

.wallet footer {
    display: flex;
    justify-content: space-between;
}

.wallet footer > h3 {
    color: var(--black);
}

.menu {
    width: 100%;
    gap: 1rem;
    display: flex;
}

.menu > button {
    text-align: start;
    flex-basis: 50%;
    background-color: var(--light-purple);
    border-radius: 0.5rem;
    padding: 1rem;
}

.menu > button > p {
    width: 50%;
}

.menu > button > div {
    border-radius: 50%;
    border: 1px var(--white) solid;
    width: 1.25rem;
    height: 1.25rem;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1rem;
}
</style>
