<template>
    <v-card
        class="ma-2"
        outlined
    >
        <v-data-table
            :headers="headers"
            :items="items"
            :items-per-page="10"
            class="elevation-1"
        >
            <template v-slot:top>
                <v-toolbar flat color="white">
                    <v-toolbar-title>Категории запчастей</v-toolbar-title>
                    <v-spacer/>
                    <v-text-field
                        v-model="search"
                        append-icon="mdi-magnify"
                        label="Search"
                        single-line
                        hide-details
                    />
                    <v-spacer/>
                    <v-dialog v-model="dialog" max-width="500px">
                        <template v-slot:activator="{ on }">
                            <v-btn color="primary" dark class="mb-2" v-on="on">Создать</v-btn>
                        </template>
                        <v-card>
                            <v-card-title>
                                <span class="headline">Новая модель продукта</span>
                            </v-card-title>

                            <v-card-text>
                                <v-container>
                                    <v-row>
                                        <v-col cols="12">
                                            <v-text-field v-model="editedItem.title" label="Title"></v-text-field>
                                        </v-col>
                                    </v-row>
                                </v-container>
                            </v-card-text>

                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="blue darken-1" text @click="closeModal">Cancel</v-btn>
                                <v-btn color="blue darken-1" text @click="save">Save</v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                </v-toolbar>
            </template>

            <template v-slot:item.edit="{ item }">
                <v-btn variant="primary" @click="openModal(item)">edit</v-btn>
            </template>
            <template v-slot:item.delete="{ item }">
                <v-btn variant="primary" @click="deleteCategory(item)">delete</v-btn>
            </template>
        </v-data-table>
    </v-card>
</template>

<script>
    import { mapActions } from "vuex";

    export default {
        data () {
            return {
                dialog: false,
                search: '',
                editedItem: {
                    id: 0,
                    title: '',
                },
                headers: [
                    {
                        text: 'id',
                        align: 'start',
                        sortable: true,
                        value: 'id',
                    },
                    { text: 'Название', value: 'title' },
                    { text: 'Создан', value: 'created_at' },
                    { text: 'edit', value: 'edit'},
                    { text: 'delete', value: 'delete'},
                ],
                items: []
            }
        },
        watch: {
            dialog (val) {
                val || this.closeModal()
            },
        },

        created() {
            this.getProductModels();
        },

        methods: {
            ...mapActions({ getProductModelsVuex: 'getProductModels'}),
            getProductModels() {
                this.getProductModelsVuex().then(res => {
                    this.items = res.data.data.map(i => {
                        return {
                            id: i.id,
                            title: i.title,
                            created_at: i.created_at
                        }
                    })
                })
            },
            save() {
                switch (Boolean(this.editedItem.id)) {
                    case false:
                        this.createProductModel();
                        break;
                    case true:
                        this.editProductModel();
                        break;
                }
            },

            createProductModel() {
                axios({
                    url: '/admin/productModels/create',
                    method: 'post',
                    data: {
                        title: this.editedItem.title,
                    }
                }).then(res => {
                    this.getProductModels();
                    this.closeModal();
                });
            },

            editProductModel() {
                axios({
                    url: `/admin/productModels/edit/${this.editedItem.id}`,
                    method: 'post',
                    data: {
                        title: this.editedItem.title,
                        description: this.editedItem.description
                    }
                }).then(res => {
                    this.getProductModels();
                    this.closeModal();
                });
            },

            deleteCategory(item) {
                axios({
                    url: `/admin/productModels/delete/${item.id}`,
                    method: 'get',
                }).then(res => {
                    this.getProductModels();
                    this.closeModal();
                });
            },

            openModal(item) {
                this.editedItem = Object.assign({}, item);
                this.dialog = true
            },

            closeModal() {
                this.dialog = false;
                this.editedItem = Object.assign({}, {
                    id: 0,
                    title: '',
                })
            }
        }
    }
</script>
