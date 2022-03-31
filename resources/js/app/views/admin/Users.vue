<template>
    <v-simple-table>
        <template v-slot:default>
            <thead>
            <tr>
                <th class="text-left">
                    Meno
                </th>
                <th class="text-left">
                    Akcie
                </th>
            </tr>
            </thead>
            <tbody>
            <tr
                v-for="item in users"
                :key="item.name"
            >
                <td>{{ item.name }}</td>
                <td>
                    <v-btn color="primary"
                           dark
                           @click="onDetailButtonClick(item)">
                        Detail
                    </v-btn>
                </td>
            </tr>
            </tbody>
        </template>
    </v-simple-table>
</template>

<script>
import {
    VSimpleTable,
    VBtn
} from 'vuetify/lib'

export default {
    components: {
        VSimpleTable,
        VBtn
    },

    data() {
        return {
            users: [],
        }
    },
    mounted() {
        axios.get('/api/admin/users')
            .then(response => {
                console.log(response)
                this.users = response.data.users
            })
            .catch(error => console.log(error))
    },
    methods: {
        onDetailButtonClick(user) {
            this.$router.push(`/admin/users/${user.id}`)
        },
    },
}
</script>
