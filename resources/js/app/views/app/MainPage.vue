<template>
    <div>
        <parameter-dialog-form ref="parameter-form" @parameterCreated="onParameterCreated"></parameter-dialog-form>
        <company-dialog-form ref="company-form" @companyCreated="onCompanyCreated"></company-dialog-form>
        <matrix class="mt-5" ref="matrix" v-bind:editable="true" v-bind:user-id="'me'"></matrix>
    </div>
</template>

<script>
import ParameterDialogForm from "../../components/ParameterDialogForm";
import CompanyDialogForm from "../../components/CompanyDialogForm";
import Matrix from "../../components/Matrix";

export default {
    components: {
        Matrix,
        CompanyDialogForm,
        ParameterDialogForm
    },

    methods: {
        onParameterCreated(parameter) {
            axios.post('/api/parameters', parameter)
                .then(response => {
                    parameter['id'] = response.data.id
                    this.$refs.matrix.onParameterCreated(parameter)
                    this.$refs["parameter-form"].onParameterSuccessfullyCreated()
                })
                .catch(error => {
                    this.$refs["parameter-form"].onParameterCreatedError(error)
                })
        },
        onCompanyCreated(company) {
            axios.post('/api/companies', {'name': company.text})
                .then(response => {
                    this.$refs.matrix.onCompanyCreated(company, response.data.id)
                    this.$refs["company-form"].onCompanySuccessfullyCreated()
                })
                .catch(error => {
                    this.$refs["company-form"].onCompanyCreatedError(error)
                })
        },
    }
}
</script>
