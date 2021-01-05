<template>
    <div>
        <div v-if="!status">
            <Loader></Loader>
        </div>
        <div v-else>
            <Search-Item titleinput="Buscar Categorias"></Search-Item>
            <div class="table-responsive mt-3">
                <v-table
                    :data="categories"
                    :currentPage.sync="currentPage"
                    :filters="filters"
                    :pageSize="4"
                    @totalPagesChanged="totalPages = $event"
                    class="table table-striped"
                >
                    <thead slot="head">
                        <tr>
                            <th>Nombre</th>
                            <th>Opciones</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody slot="body" slot-scope="{ displayData }">
                        <tr v-for="(row, index) in displayData" :key="index">
                            <td>{{ row.name }}</td>
                            <td>
                                <button
                                    type="button"
                                    @click="$emit('show', row)"
                                    class="btn btn-warning btn-sm"
                                >
                                    <i class="fi fi-eye"></i>
                                </button>
                            </td>
                            <td>
                                <button
                                    type="button"
                                    @click="
                                        thestatus(row, urlcategories, prefijo)
                                    "
                                    v-bind:class="{
                                        'btn btn-sm': true,
                                        'btn-success': row.status,
                                        'btn-danger': row.status == 0
                                    }"
                                >
                                    <i
                                        :class="
                                            row.status
                                                ? 'fi fi-toggle-on'
                                                : 'fi fi-toggle-off'
                                        "
                                        aria-hidden="true"
                                    ></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </v-table>
            </div>
            <div class="box-footer clearfix">
                <smart-pagination
                    :currentPage.sync="currentPage"
                    :maxPageLinks="6"
                    :totalPages="totalPages"
                />
            </div>
        </div>
    </div>
</template>
<script>
import SearchItem from "../utilities/search.vue";
import Loader from "../utilities/loader.vue";
import { mapState } from "vuex";
import status from "../../mixins/status";
export default {
    name: "list",
    components: {
        SearchItem,
        Loader
    },
    mixins: [status],
    data() {
        return {
            prefijo: "La categoria",
            currentPage: 1,
            totalPages: 0
        };
    },
    computed: {
        ...mapState(["filters", "categories", "status", "urlcategories"])
    },
    created() {
        this.getlist();
    },
    methods: {
        getlist() {
            this.$store.dispatch("Categorieactions");
        }
    }
};
</script>
