<template>
    <div>
        <Add ref="form"></Add>
        <List-Measure v-on:show="show" class="mt-3"></List-Measure>
    </div>
</template>
<script>
import Add from "./add";
import ListMeasure from "./list";
export default {
    name: "measure",
    components: {
        ListMeasure,
        Add
    },
    methods: {
        show(row) {
            this.$refs.form.show(row);
        }
    }
};
</script>
