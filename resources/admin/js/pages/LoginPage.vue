<template>
    <v-content>
        <v-container
            class="fill-height"
            fluid
        >
            <v-row
                align="center"
                justify="center"
            >
                <v-col
                    cols="12"
                    sm="8"
                    md="4"
                >
                    <v-card class="elevation-12">
                        <v-toolbar
                            color="primary"
                            dark
                            flat
                        >
                            <v-toolbar-title>Вход в панель админа</v-toolbar-title>
                        </v-toolbar>
                        <v-card-text>
                            <v-form>
                                <v-text-field
                                    label="Login"
                                    name="login"
                                    prepend-icon="person"
                                    type="text"
                                    v-model="form.email"
                                />

                                <v-text-field
                                    id="password"
                                    label="Password"
                                    name="password"
                                    prepend-icon="lock"
                                    type="password"
                                    v-model="form.password"
                                />
                            </v-form>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer />
                            <v-btn color="primary" @click="signIn">Login</v-btn>
                        </v-card-actions>
                    </v-card>
                </v-col>
            </v-row>
        </v-container>
</v-content>
</template>

<script>
    export default {
        data() {
            return {
                form: {
                    email: '',
                    password: ''
                }
            }
        },
        methods: {
            signIn() {
                axios({
                    method: 'post',
                    url: '/admin/signin',
                    data: {
                        email: this.form.email,
                        password: this.form.password
                    }
                }).then(res => {
                    if(res.data.success) {
                        this.$router.push('dashboard');
                    }
                })
            }
        }
    }
</script>
