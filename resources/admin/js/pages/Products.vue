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
                    <v-toolbar-title>Товары запчастей</v-toolbar-title>
                    <v-spacer/>
                    <v-text-field
                        v-model="search"
                        append-icon="mdi-magnify"
                        label="Search"
                        single-line
                        hide-details
                    />
                    <v-spacer/>
                    <v-dialog v-model="dialog" max-width="700px">
                        <template v-slot:activator="{ on }">
                            <v-btn color="primary" dark class="mb-2" v-on="on">Создать</v-btn>
                        </template>
                        <v-card>
                            <v-card-title>
                                <span class="headline">Новый продукт</span>
                            </v-card-title>

                            <v-card-text>
                                <v-container>
                                    <v-row>
                                        <v-col cols="12">
                                            <v-file-input
                                                chips
                                                multiple
                                                @change="addFiles($event)"
                                                accept="image/png, image/jpeg, image/bmp"
                                                placeholder="Добавьте фото"
                                                prepend-icon="mdi-camera"
                                                label="Avatar"
                                            />
                                        </v-col>

                                        <v-col>
                                            <v-slide-group multiple show-arrows>
                                            <v-slide-item
                                                v-for="(img, index) in preview"
                                                :key="index"
                                                v-slot:default="{ active, toggle }"
                                            >
                                                <v-card
                                                    width="150px"
                                                    class="ma-2"
                                                >
                                                    <v-card-actions>
                                                        <v-spacer></v-spacer>
                                                        <v-icon @click="removeImage(img)">close</v-icon>
                                                    </v-card-actions>
                                                    <v-img
                                                        class="white--text align-end"
                                                        height="150px"
                                                        :src="img.url"
                                                    >
                                                    </v-img>
                                                    <v-card-subtitle class="pb-0">{{ img.name }}</v-card-subtitle>
                                                </v-card>
                                            </v-slide-item>
                                        </v-slide-group>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-text-field v-model="editedItem.title" label="Title"></v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-text-field v-model="editedItem.product_number" label="Номер продукта"></v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-text-field v-model="editedItem.product_number_replacements" label="Номера замены"></v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-text-field v-model="editedItem.product_number_inner" label="Внутренний номер"></v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-text-field v-model="editedItem.description" label="Описание"></v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-text-field type="number" v-model="editedItem.price" label="Цена"></v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-select
                                                v-model="editedItem.category_id"
                                                :items="selectItems"
                                                item-text="title"
                                                item-value="value"
                                                label="Категория"
                                            />
                                        </v-col>
                                        <v-col cols="12">
                                            <v-select
                                                v-model="editedItem.product_model_id"
                                                :items="selectItems"
                                                item-text="title"
                                                item-value="value"
                                                label="Модель"
                                            />
                                        </v-col>
                                        <v-col cols="12">
                                            <v-checkbox v-model="editedItem.product_recommend" label="Рекомендовать" />
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
    import uniqBy from 'lodash/uniqBy';

    export default {
        data () {
            return {
                rules: [
                    value => !value || value.size < 8000000 || 'Avatar size should be less than 2 MB!',
                ],
                dialog: false,
                search: '',

                selectItems: [
                    { title: 'Florida', value: 1 },
                    { title: 'Georgia', value: 2 },
                    { title: 'Nebraska', value: 3 },
                    { title: 'California', value: 4 },
                    { title: 'New York', value: 5 },
                ],

                editedItem: {
                    id: 0,
                    files: [],
                    title: '',
                    product_number: '',
                    product_number_replacements: '',
                    product_number_inner: '',
                    description: '',
                    price: 0,
                    category_id: null,
                    product_model_id: null,
                    product_recommend: '1',
                    images: []
                },
                headers: [
                    { text: 'id', align: 'start', sortable: true, value: 'id' },
                    { text: 'Название', value: 'title' },
                    { text: 'Номер детали', value: 'product_number' },
                    { text: 'Номер замены', value: 'product_number_replacements' },
                    { text: 'Внутрений номер', value: 'product_number_inner' },
                    { text: 'Описание', value: 'description' },
                    { text: 'Цена', value: 'price' },
                    { text: 'Категория', value: 'category_id'},
                    { text: 'Модель', value: 'product_model_id'},
                    // { text: 'Фото', value: 'images'},
                    { text: 'Рекомендация', value: 'product_recommend'},
                    { text: 'Создан', value: 'created_at' },
                    { text: 'edit', value: 'edit'},
                    { text: 'delete', value: 'delete'},
                ],
                items: [],
                preview: []
            }
        },
        watch: {
            dialog (val) {
                val || this.closeModal()
            },
        },

        created() {
            this.getProducts();
        },
        methods: {

            /**
             *  preload images
             */
            addFiles(files) {
                if(files.length !== 0) {
                    this.editedItem.files = [ ...this.editedItem.files, ...files];

                    this.editedItem.files = this.editedItem.files.map((f, index) => {
                        f.id = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
                        f.url = URL.createObjectURL(f);
                        f.itemType ='objectUrl';

                        return f;
                    });
                    this.renderPreview();
                }
            },

            /**
            * Render images
            */
            renderPreview() {
                this.preview = [...this.editedItem.files, ...this.editedItem.images];
                // console.log(this.preview, this.editedItem.images)
            },

            removeImage(item) {
                switch (item.itemType) {
                    case 'objectUrl':
                        this.editedItem.files = this.editedItem.files.filter(f => f.id !== item.id);
                        break;
                    case 'pathUrl':
                        this.editedItem.images = this.editedItem.images.filter(f => f.id !== item.id);
                        break;
                }
                this.renderPreview();
            },

            save() {
                switch (Boolean(this.editedItem.id)) {
                    case false:
                        this.createProduct();
                        break;
                    case true:
                        this.editProduct();
                        break;
                }
            },

            createProduct() {
                let formData = new FormData()

                for(const key in this.editedItem) {
                    if(key === 'files') {
                        for(const index in this.editedItem[key]) {
                            formData.append(`files[${index}]`, this.editedItem[key][index]);
                        }
                    } else {
                        formData.append(key, this.editedItem[key])
                    }
                }

                axios({
                    data: formData,
                    config: { headers: {'Content-Type': 'multipart/form-data' }},
                    url: '/admin/products/create',
                    method: 'post',

                }).then(res => {
                    this.getProducts();
                    this.closeModal();
                });
            },

            editProduct() {
                let formData = new FormData()

                for(const key in this.editedItem) {
                    if(key === 'files') {
                        for(const index in this.editedItem[key]) {
                            formData.append(`files[${index}]`, this.editedItem[key][index]);
                        }
                    } else if(key === 'images') {
                        const images = this.editedItem[key].map(i => i.name);
                        images.forEach((name, index)  => {
                            formData.append(`images[${index}]`, name)
                        })
                    } else {
                        formData.append(key, this.editedItem[key])
                    }
                }

                axios({
                    url: `/admin/products/edit/${this.editedItem.id}`,
                    method: 'post',
                    config: { headers: {'Content-Type': 'multipart/form-data' }},
                    data: formData
                }).then(res => {
                    this.getProducts();
                    this.closeModal();
                });
            },

            deleteCategory(item) {
                axios({
                    url: `/admin/categories/delete/${item.id}`,
                    method: 'post',
                    data: {
                        title: this.editedItem.title,
                        description: this.editedItem.description
                    }
                }).then(res => {
                    this.getCategories();
                    this.closeModal();
                });
            },

            openModal(item) {
                this.editedItem = Object.assign({}, item);
                this.renderPreview();
                this.dialog = true
            },

            closeModal() {
                this.dialog = false;
                this.editedItem = Object.assign({}, {
                    id: 0,
                    title: '',
                    description: ''
                })
            },

            getProducts() {
                return axios.get('/admin/get-records/products', {
                    params: {
                        start: 0,
                        length: 10,
                        currentPage: 1,
                        filter: "",
                        sortRow: "id",
                        sort: 'desc'
                    }
                }).then(res => {
                    this.items = res.data.data.map(p => {

                        p.images = p.images && p.images.map(i => {
                            return {
                                name: i,
                                url: `/images/products/${i}`,
                                id: Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15),
                                itemType: 'pathUrl'
                            }
                        });

                        return {
                            id: p.id ,
                            title: p.title,
                            files: [],
                            product_number: p.product_number,
                            product_number_replacements: p.product_number_replacements,
                            product_number_inner: p.product_number_inner,
                            description: p.description,
                            price: p.price,
                            category_id: p.category_id,
                            product_model_id: p.product_model_id,
                            images: p.images,
                            product_recommend: p.product_recommend,
                            created_at: p.created_at
                        }
                    })
                })
            }
        }
    }
</script>
