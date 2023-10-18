// store/store.js
import { createStore } from "vuex";
import axios from "axios";
export default createStore({
    state: {
        test: "",
    },
    mutations: {
        setTest(state, data) {
            state.test = data;
        },
    },
    actions: {
        async fetchData({ commit }) {
            return await axios
                .get("http://hocococodingtest.test/api/data")
                .then((response) => {
                    commit("setTest", response.data);
                });
        },
    },
    getters: {
        getTest: (state) => state.test,
    },
});
