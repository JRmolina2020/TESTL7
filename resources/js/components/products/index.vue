<template>
    <div>
        <Add ref="form"></Add>
        <List-Product v-on:show="show" class="mt-3"></List-Product>
    </div>
</template>
<script>
import Add from "./add";
import ListProduct from "./list";
export default {
    name: "products",
    components: {
        ListProduct,
        Add
    },
    methods: {
        show(row) {
            this.$refs.form.show(row);
        }
    }
};
</script>
