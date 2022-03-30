<template>
    <div>
        <parameter-dialog-form @parameterCreated="onParameterCreated"></parameter-dialog-form>
        <company-dialog-form @companyCreated="onCompanyCreated"></company-dialog-form>
        <v-data-table
            :headers="headers"
            :items="rows"
            :hide-default-footer="true"
            class="elevation-1">
            <template v-slot:item="{ item }">
                <tr v-if="'isFooter' in item">
                    <td @click="onTableCellClick(item, header.value)"
                        v-for="header in headers"
                        v-bind:class="{'light-green': maxMatchId === header.value}"
                    >
                        <div v-if="header.value === 'name'">{{ item.name }}</div>
                        <div v-else-if="header.value === 'coefficient'">{{ item.coefficient }}</div>
                        <div v-else>{{ item[header.value] }}</div>
                    </td>
                </tr>
                <tr v-else>
                    <td v-for="header in headers" @click="onTableCellClick(item, header.value)">
                        <div v-if="header.value === 'name'">{{ item.name }}</div>
                        <div v-else-if="header.value === 'coefficient'">{{ item.coefficient }}</div>
                        <div v-else-if="item.companies.includes(header.value)">
                            <v-icon>mdi-check</v-icon>
                        </div>
                        <div v-else></div>
                    </td>
                </tr>
            </template>
        </v-data-table>
    </div>
</template>

<script>
import {
    VDataTable,
    VBtn,
    VApp,
    VIcon
} from 'vuetify/lib'
import ParameterDialogForm from "../components/ParameterDialogForm";
import CompanyDialogForm from "../components/CompanyDialogForm";

export default {
    components: {
        CompanyDialogForm,
        ParameterDialogForm,
        VDataTable,
        VBtn,
        VApp,
        VIcon
    },
    data() {
        return {
            dialog: false,
            maxMatchId: -1,
            parameters: [
                {
                    id: 1,
                    name: 'parameter 1',
                    coefficient: 0.5,
                    companies: [1, 2],
                },
                {
                    id: 2,
                    name: 'parameter 2',
                    coefficient: 0.8,
                    companies: [2, 3],
                },
                {
                    id: 3,
                    name: 'parameter 3',
                    coefficient: 0.2,
                    companies: [1, 3],
                },
            ],
            staticHeader: [
                {
                    text: "Parameter",
                    value: "name",
                },
                {
                    text: "Coefficient",
                    value: "coefficient",
                }
            ],
            footer: {
                id: -1,
                name: 'Fit',
                coefficient: '',
                isFooter: true,
            },
            companies: [
                {
                    text: 'company 1',
                    value: 1,
                },
                {
                    text: 'company 2',
                    value: 2,
                },
                {
                    text: 'company 3',
                    value: 3,
                },
            ],
        }
    },
    methods: {
        onParameterCreated(parameter) {
            this.parameters.push(parameter)
            this.calculateMatch()
        },
        onCompanyCreated(company) {
            this.companies.push(company)
            this.calculateMatch()
        },
        onTableCellClick(row, col) {
            if (col === 'parameter' || col === 'coefficient' || 'isFooter' in row) {
                return
            }

            if (row.companies.includes(col)) {
                row.companies = row.companies.filter(item => item !== col)
            } else {
                row.companies.push(col)
            }

            this.calculateMatch()
        },
        calculateMatch() {
            let coefficientsSum = this.parameters.reduce((partialSum, param) => partialSum + parseFloat(param.coefficient), 0)
            this.maxMatchId = -1
            let maxScore = -1

            for (let company of this.companies) {
                let companyId = company.value
                let companyScore = 0
                for (let parameter of this.parameters) {
                    if (parameter.companies.includes(company.value)) {
                        companyScore += parameter.coefficient
                    }
                }
                let matchInPercent = (companyScore / coefficientsSum) * 100
                this.footer[companyId] = `${Math.round(matchInPercent * 100) / 100} %`

                if (matchInPercent > maxScore) {
                    maxScore = matchInPercent
                    this.maxMatchId = companyId
                }
            }
        }
    },
    computed: {
        headers: function () {
            return this.staticHeader.concat(this.companies)
        },
        rows: function () {
            return this.parameters.concat(this.footer)
        }
    }
}
</script>
