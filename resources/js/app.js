require("./bootstrap");
//require
window.Vue = require("vue");
window.Axios = require("axios");

//import
import store from "./store";
import SmartTable from "vuejs-smart-table";
import Swal from "sweetalert2";
window.Swal = Swal;
//start validate
import es from "vee-validate/dist/locale/es";
import VeeValidate, { Validator } from "vee-validate";
//end
import VueCurrencyInput from "vue-currency-input";
import VueCurrencyFilter from "vue-currency-filter";
//use
Vue.use(SmartTable);
Vue.use(VeeValidate);
Vue.use(VueCurrencyInput);
Vue.use(VueCurrencyFilter);
Validator.localize("es", es);
Vue.component("categorie", require("./components/categorie/index.vue").default);
Vue.component("measure", require("./components/measure/index.vue").default);
Vue.component("brand", require("./components/brand/index.vue").default);
Vue.component("product", require("./components/products/index.vue").default);
const app = new Vue({
    el: "#app",
    store
});
