<template>
    <v-container>
        <v-row>
            <v-col cols="6">
                <v-carousel height="280">
                <v-carousel-item v-for="(img, i) in productData.images" :key="i" v-ripple>
                    <v-card>
                        <v-img :src="img.src" height="280"></v-img>
                    </v-card>
                </v-carousel-item>
            </v-carousel>

                <v-slide-group multiple show-arrows center-active>
                    <v-slide-item
                        v-for="(img, index) in productData.images"
                        :key="index"
                        v-slot:default="{ active, toggle }"
                    >
                        <v-card
                            width="150px"
                            class="ma-2"
                        >
                            <v-img
                                class="white--text align-end"
                                height="150"
                                :src="img.src"
                            >
                            </v-img>
                        </v-card>
                    </v-slide-item>
                </v-slide-group>

            </v-col>
            <v-col cols="6">
                <v-list class="transparent px-3" dense>
                    <v-list-item two-line>
                        <v-list-item-content>
                            <v-list-item-title class="headline mb-1">{{ productData.title }}</v-list-item-title>
                            <v-list-item-subtitle>{{ productData.product_number }}</v-list-item-subtitle>
                        </v-list-item-content>
                    </v-list-item>
                    <v-divider></v-divider>
                    <v-list-item>
                        <v-list-item-title>Номер замены</v-list-item-title>
                        <v-list-item-subtitle class="text-right">{{ productData.product_number_replacements }}</v-list-item-subtitle>
                    </v-list-item>
                    <v-list-item>
                        <v-list-item-title>Номер детали</v-list-item-title>
                        <v-list-item-subtitle class="text-right">{{ productData.product_number }}</v-list-item-subtitle>
                    </v-list-item>
                    <v-list-item>
                        <v-list-item-title>Внутренний код детали</v-list-item-title>
                        <v-list-item-subtitle class="text-right">{{ productData.product_number_inner }}</v-list-item-subtitle>
                    </v-list-item>
                    <v-list-item>
                        <v-list-item-title>Марка</v-list-item-title>
                        <v-list-item-subtitle class="text-right">{{ productData.product_model }}</v-list-item-subtitle>
                    </v-list-item>
                    <v-list-item>
                        <v-list-item-content>
                            {{ productData.description }}
                        </v-list-item-content>
                    </v-list-item>
                    <v-list-item>
                        <v-list-item-content>
                            <v-btn dark color="orange">Оформить заказ</v-btn>
                        </v-list-item-content>
                    </v-list-item>
                </v-list>
            </v-col>
        </v-row>
        <v-row>
            <v-col>
                <recommended />
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
    import Recommended from "../components/Recommended";

    export default {
        components: {
            'recommended': Recommended
        },
        created() {
            this.getProductData();
        },
        methods: {
            formatProductData(p) {
                p.images = p.images !== null && p.images.length > 0 && JSON.parse(p.images);
                p.images = Object.values(p.images).map(i =>  ({ src: `/images/products/${i}` }) ) || [];
                return {
                    title: p.title,
                    product_number: p.product_number,
                    product_number_replacements: p.product_number_replacements,
                    product_number_inner: p.product_number_inner,
                    description: p.description,
                    price: p.price,
                    category: p.category.title,
                    product_model: p.product_model.title,
                    images: p.images,
                }
            },
            getProductData() {
                axios({
                    method: 'get',
                    url: `/get-record/${this.$route.params.id}`
                }).then(res => {
                    this.productData = this.formatProductData(res.data)
                })
            }
        },
        data () {
            return {
                productData: {}
            }
        },
    }
</script>

