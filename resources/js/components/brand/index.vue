<template>
    <div>
        <Add ref="form"></Add>
        <List-Brand v-on:show="show" class="mt-3"></List-Brand>
    </div>
</template>
<script>
import Add from "./add";
import ListBrand from "./list";
export default {
    name: "brand",
    components: {
        ListBrand,
        Add
    },
    methods: {
        show(row) {
            this.$refs.form.show(row);
        }
    }
};
</script>
