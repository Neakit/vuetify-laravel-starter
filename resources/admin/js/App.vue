<template>
  <v-app id="inspire">
    <v-navigation-drawer
      v-model="drawer"
      app
      clipped
    >
      <v-list dense>

        <v-list-item link v-for="(route, index) in routes" :key="index">
          <v-list-item-action>
            <v-icon>mdi-view-dashboard</v-icon>
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
      <v-toolbar-title>Application</v-toolbar-title>
    </v-app-bar>

    <v-content>
        <router-view></router-view>
    </v-content>

    <v-footer app>
      <span>&copy; 2019</span>
    </v-footer>
  </v-app>
</template>

<script>
    export default {
        name: 'app',
        props: {
            source: String,
        },
        data: () => ({
            drawer: null,
            // TODO: parse from router
            routes: [
                {
                    title: 'Продукты',
                    path: '/admin/products'
                },
                {
                    title: 'Модели',
                    path: '/admin/models'
                },
                {
                    title: 'Категории',
                    path: '/admin/categories'
                }
            ]
        }),
        created () {
            this.$vuetify.theme.dark = true
        },
  }
</script>