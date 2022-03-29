<template>
    <v-app>
        <div>
            <parameter-dialog-form @parameterCreated="onParameterCreated"></parameter-dialog-form>

            <v-data-table
                :headers="headers"
                :items="parameters"
                :hide-default-footer="true"
                class="elevation-1"
            >
                <template v-slot:item="{ item }">
                    <tr>
                        <td v-for="header in headers" @click="onTableCellClick(item, header.value)">
                            <div v-if="header.value === 'parameter'">{{item.parameter}}</div>
                            <div v-else-if="header.value === 'coefficient'">{{item.coefficient}}</div>
                            <div v-else-if="item.companies.includes(header.value)" ><v-icon>mdi-check</v-icon></div>
                            <div v-else></div>
                        </td>
                    </tr>
                </template>
            </v-data-table>
        </div>
    </v-app>
</template>

<script>
import {
    VDataTable,
    VBtn,
    VApp,
    VIcon
} from 'vuetify/lib'
import ParameterDialogForm from "./components/ParameterDialogForm";

export default {
    components: {
        ParameterDialogForm,
        VDataTable,
        VBtn,
        VApp,
        VIcon
    },
    data() {
        return {
            dialog: false,

            parameters: [
                {
                    id: 1,
                    parameter: 'parameter 1',
                    coefficient: 0.5,
                    companies: ['1', '2'],
                },
                {
                    id: 2,
                    parameter: 'parameter 2',
                    coefficient: 0.8,
                    companies: ['2', '3'],
                },
                {
                    id: 3,
                    parameter: 'parameter 3',
                    coefficient: 0.2,
                    companies: ['1', '3'],
                },
            ],
            staticHeaders: [
                {
                    text: "Parameter",
                    value: "parameter",
                },
                {
                    text: "Coefficient",
                    value: "coefficient",
                }
            ],
            companies: [
                {
                    text: 'company 1',
                    value: '1',
                },
                {
                    text: 'company 2',
                    value: '2',
                },
                {
                    text: 'company 3',
                    value: '3',
                },
            ],
        }
    },
    methods: {
        onParameterCreated(parameter) {
            this.parameters.push(parameter)
        },

        onTableCellClick(row, col) {
            if(col === 'parameter' || col === 'coefficient') {
                return
            }

            if(row.companies.includes(col)) {
                row.companies = row.companies.filter(item => item !== col)
            } else {
                row.companies.push(col)
            }
        }
    },
    computed: {
        headers: function () {
            return this.staticHeaders.concat(this.companies)
        }
    }
}
</script>
