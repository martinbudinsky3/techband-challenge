<template>
    <v-app>
        <main>
            <router-view />
        </main>
    </v-app>
</template>

<script>
import {VApp} from 'vuetify/lib'

export default {
    components: {VApp}
}
</script>
