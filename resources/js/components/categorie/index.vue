<template>
    <div>
        <Add ref="form"></Add>
        <List-Categorie v-on:show="show" class="mt-3"></List-Categorie>
    </div>
</template>
<script>
import Add from "./add";
import ListCategorie from "./list";
export default {
    name: "categorie",
    components: {
        ListCategorie,
        Add
    },
    methods: {
        show(row) {
            this.$refs.form.show(row);
        }
    }
};
</script>
