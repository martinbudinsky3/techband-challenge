<template>
    <div>
        <v-app-bar
            v-if="!['/login', '/register'].includes($router.currentRoute.path)"
            color="primary"
            dark
        >
            <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>

            <v-toolbar-title>Perfect job app</v-toolbar-title>
        </v-app-bar>
        <v-navigation-drawer
            v-model="drawer"
            absolute
            bottom
            temporary>
            <v-list
                dense
                nav
            >
                <v-list-item
                    @click="logout">
                    <v-list-item-icon>
                        <v-icon>mdi-logout</v-icon>
                    </v-list-item-icon>

                    <v-list-item-content>
                        <v-list-item-title>Log Out</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>
        </v-navigation-drawer>
        <main class="container p-3 p-xs-0 ">
            <router-view />
        </main>
    </div>
</template>

<script>
import {
    VApp,
    VNavigationDrawer,
    VListItem,
    VList,
    VListItemContent,
    VListItemTitle,
    VListItemIcon,
    VIcon,
    VAppBar,
    VAppBarNavIcon,
    VToolbarTitle
} from 'vuetify/lib'

export default {
    components: {
        VApp,
        VNavigationDrawer,
        VListItem,
        VList,
        VListItemContent,
        VListItemTitle,
        VListItemIcon,
        VIcon,
        VAppBar,
        VAppBarNavIcon,
        VToolbarTitle
    },
    data() {
        return {
            drawer: false,
        }
    },
    methods: {
        logout() {
            axios.post('/api/logout')
                .then(response => this.$router.push('/login'))
                .catch(error => console.log(error))
        }
    }
}
</script>
