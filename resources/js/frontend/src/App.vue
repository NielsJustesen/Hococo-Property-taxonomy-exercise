<template>
    <div>{{ test }}</div>
</template>

<script>
import { computed } from "vue";
import { useStore } from "vuex";
export default {
    name: "App",
    setup() {
        const store = useStore();
        store.dispatch("fetchData");
        const test = computed(() => {
            return store.getters.getTest;
        });
        return { test };
    },
};
</script>

<style></style>
