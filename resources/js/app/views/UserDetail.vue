<template>
    <matrix v-bind:editable="false" v-bind:user-id="this.$router.id"></matrix>
</template>

<script>
import Matrix from "../components/Matrix";

export default {
    components: {
        Matrix,
    },
}
</script>

<style scoped>

</style>
