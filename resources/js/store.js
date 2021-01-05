import Vue from "vue";
import Vuex from "vuex";
import axios from "axios";
Vue.use(Vuex);
export default new Vuex.Store({
    state: {
        filters: {
            data: {
                value: "",
                keys: [
                    "name",
                    "code",
                    "name_categorie",
                    "purchase_price",
                    "name_brands"
                ]
            }
        },
        categories: [],
        measures: [],
        brands: [],
        products: [],
        details_product: [],
        status: false,
        urlcategories: "api/categories",
        urlmeasures: "api/measures",
        urlbrands: "api/brands",
        urlproducts: "api/products",
        urlproducts_details: "api/product_details"
    },
    mutations: {
        Categoriemutations(state, response) {
            state.categories = response;
        },
        Measuremutations(state, response) {
            state.measures = response;
        },
        Productmutations(state, response) {
            state.products = response;
        },
        Brandmutations(state, response) {
            state.brands = response;
        },
        Detail_product_mutations(state, response) {
            state.details_product = response;
        }
    },
    actions: {
        async Categorieactions({ commit, state }) {
            try {
                let response = await axios.get(state.urlcategories);
                commit("Categoriemutations", response.data);
                state.status = true;
            } catch (error) {
                console.log(error);
            }
        },
        async Measureactions({ commit, state }) {
            try {
                let response = await axios.get(state.urlmeasures);
                commit("Measuremutations", response.data);
                state.status = true;
            } catch (error) {
                console.log(error);
            }
        },
        async Productactions({ commit, state }) {
            try {
                let response = await axios.get(`${state.urlproducts}`);
                commit("Productmutations", response.data);
                state.status = true;
            } catch (error) {
                console.log(error);
            }
        },
        async Brandactions({ commit, state }) {
            try {
                let response = await axios.get(`${state.urlbrands}`);
                commit("Brandmutations", response.data);
                state.status = true;
            } catch (error) {
                console.log(error);
            }
        },
        async Detail_product_actions({ commit, state }, id) {
            try {
                let response = await axios.get(
                    `${state.urlproducts_details}/${id}`
                );
                commit("Detail_product_mutations", response.data);
                state.status = true;
            } catch (error) {
                console.log(error);
            }
        }
    }
});
