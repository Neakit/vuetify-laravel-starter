<template>
    <div>
        <v-navigation-drawer
            v-model="drawer"
            app
            clipped
        >
            <v-list dense>
                <v-list-item link v-for="(route, index) in routes" :key="index" :to="route.path">
                    <v-list-item-action>
                        <v-icon>{{ route.icon }}</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>{{ route.title }}</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>
        </v-navigation-drawer>
        <v-app-bar
            app
            clipped-left
        >
            <v-app-bar-nav-icon @click.stop="drawer = !drawer" />
            <v-toolbar-title>Admin Panel</v-toolbar-title>
            <v-spacer></v-spacer>

            <v-btn
                class="ma-2"
                tile
                outlined
                color="primary"
                @click="signout"
            >
                Exit <v-icon right>mdi-exit-to-app</v-icon>
            </v-btn>
        </v-app-bar>
        <v-content>
            <router-view></router-view>
        </v-content>
    </div>
</template>

<script>
    export default {
        name: 'app',
        props: {
            source: String,
        },
        data: () => ({
            drawer: null,
        }),
        computed: {
            routes() {
                const route = this.$router.options.routes.find(r => r.name === 'admin');
                return route.children.map( child => {
                    return {
                        title: child.meta.name,
                        path: `/admin/${child.path}`,
                        icon: child.meta.icon
                    }
                });
            }
        },
        methods: {
            signout() {
                axios({
                    method: 'get',
                    url: '/admin/signout'
                }).then(res => {
                    if(res.data.success) {
                        this.$router.push('/admin/login')
                    }
                })
            }
        },
        created () {
            //
        }
    }
</script>
