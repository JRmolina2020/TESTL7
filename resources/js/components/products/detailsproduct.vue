<template>
    <div>
        <!-- Button trigger modal -->
        <button
            type="button"
            class="btn bg-secondary btn-sm"
            data-toggle="modal"
            :data-target="'#model' + row.id"
        >
            Detalle
        </button>
        <div
            class="modal fade"
            :id="'model' + row.id"
            tabindex="-1"
            role="dialog"
            aria-labelledby="modelTitleId"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <p>
                            <strong>Ficha de precio</strong>
                        </p>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr class="table-warning">
                                        <td>Compra</td>
                                        <td>%</td>
                                        <td>Iva</td>
                                        <td>Utilidad</td>
                                        <td>Venta</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            ${{ row.purchase_price | currency }}
                                        </td>
                                        <td>{{ row.tax_type }}%</td>
                                        <td>${{ row.tax | currency }}</td>
                                        <td>${{ row.utility | currency }}</td>
                                        <td>
                                            ${{ row.sale_price | currency }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <p>
                            <strong>Ficha técnica</strong>
                        </p>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr class="table-danger">
                                        <td>Und.medida</td>
                                        <td>Marca</td>
                                    </tr>
                                    <tr>
                                        <td>{{ row.unit }}</td>

                                        <td>{{ row.name_brands }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <p>
                            <strong>Descripción detallada del producto</strong>
                        </p>
                        <p>{{ row.description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapState } from "vuex";
export default {
    name: "DetailProduct",
    props: {
        row: {
            type: Object,
            required: true
        }
    }
};
</script>
