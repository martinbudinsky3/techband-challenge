<template>
    <div>
        <parameter-dialog-form @parameterCreated="onParameterCreated"></parameter-dialog-form>
        <company-dialog-form @companyCreated="onCompanyCreated"></company-dialog-form>
        <matrix ref="matrix" v-bind:editable="true" v-bind:user-id="1"></matrix>
    </div>
</template>

<script>
import ParameterDialogForm from "../components/ParameterDialogForm";
import CompanyDialogForm from "../components/CompanyDialogForm";
import Matrix from "../components/Matrix";

export default {
    components: {
        Matrix,
        CompanyDialogForm,
        ParameterDialogForm
    },

    methods: {
        onParameterCreated(parameter) {
            this.$refs.matrix.onParameterCreated(parameter)
        },
        onCompanyCreated(company) {
            this.$refs.matrix.onCompanyCreated(company)
        },
    }
}
</script>
