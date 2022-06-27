<template>
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
</template>

<script>
import {
    VDataTable,
    VIcon
} from 'vuetify/lib'

export default {
    components: {
        VDataTable,
        VIcon
    },
    props: ["editable", "userId"],
    data() {
        return {
            dialog: false,
            maxMatchId: -1,
            parameters: [],
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
            companies: [],
        }
    },
    mounted() {
        axios.get(`/api/admin/users/${this.userId}`)
            .then(response => {
                let companiesFromApi = response.data.companies
                for (let company of companiesFromApi) {
                    this.companies.push({'text': company.name, 'value': company.id})
                }
                this.parameters = response.data.parameters
                this.calculateMatch()
            })
            .catch(error => console.log(error))
    },
    methods: {
        onParameterCreated(parameter) {
            axios.post('/api/parameters', parameter)
                .then(response => {
                    parameter['id'] = response.data.id
                    parameter['companies'] = []
                    this.parameters.push(parameter)
                    this.calculateMatch()
                })
                .catch(error => {
                    console.log(error)
                })
        },
        onCompanyCreated(company) {
            axios.post('/api/companies', {'name': company.text})
                .then(response => {
                    company['value'] = response.data.id
                    this.companies.push(company) // TODO fix - new company is rendered twice
                    this.calculateMatch()
                })
                .catch(error => {
                    console.log(error)
                })
            this.companies.push(company)
            this.calculateMatch()
        },
        onTableCellClick(row, col) {
            if (!this.editable || col === 'parameter' || col === 'coefficient' || 'isFooter' in row) {
                return
            }

            if (row.companies.includes(col)) {
                axios.delete(`/api/parameters/${row.id}/companies/${col}`)
                    .then(response => {})
                    .catch(error => console.log(error))

                row.companies = row.companies.filter(item => item !== col)
                this.calculateMatch()
            } else {
                axios.post(`/api/parameters/${row.id}/companies/${col}`, {})
                    .then(response => {})
                    .catch(error => console.log(error))

                row.companies.push(col)
                this.calculateMatch()
            }
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
                        companyScore += parseFloat(parameter.coefficient)
                    }
                }
                console.log(companyScore)
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

<style scoped>

</style>
