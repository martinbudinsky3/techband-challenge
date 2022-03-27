<template>
    <v-app>
        <div>
            <v-btn
                v-on:click="addParameter"
                color="primary"
                elevation="2">
                Pridať parameter
            </v-btn>
            <v-simple-table>
                <template v-slot:default>
                    <thead>
                    <tr>
                        <th class="text-left">
                            Name
                        </th>
                        <th class="text-left">
                            Calories
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
import {VSimpleTable, VBtn, VApp} from 'vuetify/lib'
export default {
    components: {
        VSimpleTable, VBtn, VApp
    },
    data() {
        return {
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
        addParameter(event) {
            this.parameters.push({name: 'Test', coefficient: 1})
        }
    }
}
</script>
