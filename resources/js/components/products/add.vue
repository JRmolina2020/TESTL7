<template>
    <div>
        <Modal-Resource v-on:clear="clear" title="Registro de productos">
            <section v-if="!form.id" slot="title">
                Registro de productos
            </section>
            <section v-else slot="title">Editar producto</section>
            <section slot="closebtn">
                <button
                    type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-label="Close"
                >
                    <span aria-hidden="true">&times;</span>
                </button>
            </section>
            <section slot="titlebutton">Registrar producto</section>
            <section slot="body">
                <form
                    method="POST"
                    @submit.prevent="add(form.id, action)"
                    autocomplete="off"
                >
                    <div class="row">
                        <div class="col-lg-6 col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for>Codigo</label>
                                <input
                                    type="text"
                                    v-validate="'required|max:7|min:3'"
                                    class="form-control form-control-sm"
                                    :class="{
                                        'is-invalid':
                                            submitted && errors.has('codigo')
                                    }"
                                    placeholder="Codigo del producto"
                                    v-model="form.code"
                                    name="codigo"
                                />
                                <div
                                    v-if="submitted && errors.has('codigo')"
                                    class="invalid-feedback"
                                >
                                    {{ errors.first("codigo") }}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for>Nombre</label>
                                <input
                                    type="text"
                                    v-validate="'required|max:30|min:3'"
                                    class="form-control form-control-sm"
                                    :class="{
                                        'is-invalid':
                                            submitted && errors.has('nombre')
                                    }"
                                    placeholder="Nombre del producto a registrar"
                                    v-model="form.name"
                                    name="nombre"
                                    @keyup="formatKey"
                                />
                                <div
                                    v-if="submitted && errors.has('nombre')"
                                    class="invalid-feedback"
                                >
                                    {{ errors.first("nombre") }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for>Categoria</label>
                                <select
                                    class="form-control form-control-sm"
                                    :class="{
                                        'is-invalid':
                                            submitted && errors.has('categoria')
                                    }"
                                    name="categoria"
                                    id="categoria"
                                    v-model="form.categorie_id"
                                    v-validate="'required'"
                                >
                                    <option
                                        v-for="(item, index) in categories"
                                        :value="item.id"
                                        :key="index"
                                        >{{ item.name }}</option
                                    >
                                </select>
                                <div
                                    v-if="submitted && errors.has('categoria')"
                                    class="invalid-feedback"
                                >
                                    {{ errors.first("categoria") }}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for>Precio de compra</label>
                                <currency-input
                                    v-validate="'|required'"
                                    class="form-control form-control-sm"
                                    v-currency="{
                                        currency: 'USD',
                                        precision: 0,
                                        locale: 'en'
                                    }"
                                    :class="{
                                        'is-invalid':
                                            submitted &&
                                            errors.has('precio de compra')
                                    }"
                                    v-model.number="form.purchase_price"
                                    name="precio de compra"
                                    @change="price_calculation()"
                                />
                                <div
                                    v-if="
                                        submitted &&
                                            errors.has('precio de compra')
                                    "
                                    class="invalid-feedback"
                                >
                                    {{ errors.first("precio de compra") }}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for>Utilidad</label>
                                <currency-input
                                    v-validate="'|required'"
                                    class="form-control form-control-sm"
                                    v-currency="{
                                        currency: 'USD',
                                        precision: 0,
                                        locale: 'en'
                                    }"
                                    :class="{
                                        'is-invalid':
                                            submitted && errors.has('utilidad')
                                    }"
                                    v-model.number="form.utility"
                                    name="utilidad"
                                    @change="price_calculation()"
                                />
                                <div
                                    v-if="submitted && errors.has('utilidad')"
                                    class="invalid-feedback"
                                >
                                    {{ errors.first("utilidad") }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for>Iva%</label>
                                <select
                                    @change="price_calculation()"
                                    class="form-control form-control-sm"
                                    v-model.number="form.tax_type"
                                >
                                    <option value="0">Exento</option>
                                    <option value="0.05"
                                        >Bienes / Servicios al 5</option
                                    >
                                    <option value="0.19">Tarifa general</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Monto iva</label>
                                <currency-input
                                    v-validate="'|required'"
                                    class="form-control form-control-sm"
                                    v-currency="{
                                        currency: 'USD',
                                        precision: 0,
                                        locale: 'en'
                                    }"
                                    v-model.number="form.tax"
                                    name="iva"
                                    disabled
                                />
                            </div>
                        </div>
                        <div class="col-lg-4 col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for>Precio de venta</label>
                                <currency-input
                                    v-validate="'|required'"
                                    class="form-control form-control-sm"
                                    v-currency="{
                                        currency: 'USD',
                                        precision: 0,
                                        locale: 'en'
                                    }"
                                    :class="{
                                        'is-invalid':
                                            submitted && errors.has('precio')
                                    }"
                                    v-model.number="form.sale_price"
                                    name="precio"
                                    disabled
                                />
                                <div
                                    v-if="submitted && errors.has('precio')"
                                    class="invalid-feedback"
                                >
                                    {{ errors.first("precio") }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for>Unidad de medida</label>
                                <select
                                    class="form-control form-control-sm"
                                    :class="{
                                        'is-invalid':
                                            submitted && errors.has('medida')
                                    }"
                                    name="medida"
                                    id="medida"
                                    v-model="form.unit"
                                    v-validate="'required'"
                                >
                                    <option
                                        v-for="(item, index) in measures"
                                        :value="item.name"
                                        :key="index"
                                        >{{ item.name }}</option
                                    >
                                </select>
                                <div
                                    v-if="submitted && errors.has('medida')"
                                    class="invalid-feedback"
                                >
                                    {{ errors.first("medida") }}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for>Marca</label>
                                <select
                                    class="form-control form-control-sm"
                                    :class="{
                                        'is-invalid':
                                            submitted && errors.has('marca')
                                    }"
                                    name="marca"
                                    id="marca"
                                    v-model="form.brand_id"
                                    v-validate="'required'"
                                >
                                    <option
                                        v-for="(item, index) in brands"
                                        :value="item.id"
                                        :key="index"
                                        >{{ item.name }}</option
                                    >
                                </select>
                                <div
                                    v-if="submitted && errors.has('marca')"
                                    class="invalid-feedback"
                                >
                                    {{ errors.first("marca") }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <button
                                type="button"
                                @click="add_items()"
                                class="btn btn-primary"
                            >
                                Añadir restricciones
                            </button>
                        </div>
                    </div>

                    <div
                        class="row"
                        v-for="(items, index) in form.details_products"
                        :key="index"
                    >
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="">Item</label>
                                <input
                                    type="text"
                                    v-model="form.details_products[index].item"
                                    class="form-control"
                                />
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label for="">Valor</label>
                                <input
                                    type="text"
                                    v-model="
                                        form.details_products[index].value_item
                                    "
                                    class="form-control"
                                />
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <button
                                type="button"
                                @click="remove_items(index)"
                                class="btn btn-danger"
                            >
                                x
                            </button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for>Descripción</label>
                        <textarea
                            rows="3"
                            v-validate="'required|max:100|min:5'"
                            class="form-control form-control-sm"
                            :class="{
                                'is-invalid':
                                    submitted && errors.has('descripción')
                            }"
                            v-model="form.description"
                            name="descripción"
                        />
                        <div
                            v-if="submitted && errors.has('descripción')"
                            class="invalid-feedback"
                        >
                            {{ errors.first("descripción") }}
                        </div>
                    </div>

                    <button
                        :hidden="errors.any()"
                        type="submit"
                        v-bind:class="{
                            'btn btn-outline-primary ': !this.form.id,
                            'btn btn-outline-danger ': this.form.id
                        }"
                    >
                        <i
                            v-bind:class="{
                                'fi fi-wink': !this.form.id,
                                'fi fi-like': this.form.id
                            }"
                            aria-hidden="true"
                        ></i>
                    </button>
                </form>
            </section>
        </Modal-Resource>
    </div>
</template>
<script>
import ModalResource from "../utilities/modal.vue";
import { mapState } from "vuex";
import add from "../../mixins/add";
export default {
    $_veeValidate: {
        validator: "new"
    },
    name: "add",
    mixins: [add],
    components: {
        ModalResource
    },
    data() {
        return {
            status: false,
            action: "Productactions",
            submitted: true,
            form: {
                id: null,
                categorie_id: null,
                brand_id: null,
                code: null,
                name: null,
                purchase_price: null,
                utility: null,
                tax_type: 0,
                tax: 0,
                sale_price: 0,
                description: null,
                details_products: [{ item: "", value_item: "" }]
            },
            form_details: {
                item: "",
                value_item: ""
            }
        };
    },
    computed: {
        ...mapState([
            "categories",
            "measures",
            "brands",
            "urlproducts",
            "urlproducts_details"
        ])
    },
    created() {
        this.getlistData();
        this.url = this.urlproducts;
    },

    methods: {
        price_calculation() {
            this.form.tax = this.form.purchase_price * this.form.tax_type;
            this.form.sale_price =
                this.form.purchase_price + this.form.utility + this.form.tax;
        },
        getlistData() {
            this.$store.dispatch("Categorieactions");
            this.$store.dispatch("Measureactions");
            this.$store.dispatch("Brandactions");
        },
        show(row) {
            this.form.id = row.id;
            this.form.categorie_id = row.idc;
            this.form.brand_id = row.idb;
            this.form.code = row.code;
            this.form.name = row.name;
            this.form.purchase_price = parseFloat(row.purchase_price);
            this.form.utility = parseFloat(row.utility);
            this.form.tax_type = row.tax_type;
            this.form.tax = parseFloat(row.tax);
            this.form.sale_price = parseFloat(row.sale_price);
            this.form.description = row.description;
            this.form.unit = row.unit;
            this.status = false;
            $("#model").modal("show");
            this.getDatadetails(row.id);
        },
        async getDatadetails(id) {
            let response = await axios.get(this.urlproducts_details + "/" + id);
            this.form.details_products = response.data;
            console.log(this.form.details_products);
        },
        clear() {
            this.form.id = null;
            this.form.categorie_id = null;
            this.form.code = null;
            this.form.name = null;
            this.form.purchase_price = null;
            this.form.utility = null;
            this.form.tax_type = 0;
            this.form.tax = 0;
            this.form.sale_price = 0;
            this.form.description = null;
            this.status = false;
            this.$validator.reset();
        },
        add_items() {
            this.form.details_products.push({
                item: this.form_details.item,
                value_item: this.form_details.value_item
            });
        },
        remove_items(index) {
            this.form.details_products.splice(index, 1);
            this.form.details_products = Array.from(this.form.details_products);
            console.log(this.form);
        }
    }
};
</script>
