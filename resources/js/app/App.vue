<template>
    <v-app>
        <div>

            <parameter-dialog-form @parameterCreated="onParameterCreated"></parameter-dialog-form>
            <v-simple-table>
                <template v-slot:default>
                    <thead>
                    <tr>
                        <th class="text-left">
                            Parameter
                        </th>
                        <th class="text-left">
                            Koeficient
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr
                        v-for="item in parameters"
                        :key="item.name">
                        <td>{{ item.name }}</td>
                        <td>{{ item.coefficient }}</td>
                    </tr>
                    </tbody>
                </template>
            </v-simple-table>
        </div>
    </v-app>
</template>

<script>
import {
    VSimpleTable,
    VBtn,
    VApp
} from 'vuetify/lib'
import ParameterDialogForm from "./components/ParameterDialogForm";

export default {
    components: {
        ParameterDialogForm,
        VSimpleTable,
        VBtn,
        VApp,
    },
    data() {
        return {
            dialog: false,
            name: '',
            coefficient: 0,
            parameters: [
                {
                    name: 'parameter 1',
                    coefficient: 0.5,
                },
                {
                    name: 'parameter 2',
                    coefficient: 0.8,
                },
                {
                    name: 'parameter 3',
                    coefficient: 0.2,
                },
            ],
        }
    },
    methods: {
        onParameterCreated(parameter) {
            this.parameters.push(parameter)
        }
    }
}
</script>
