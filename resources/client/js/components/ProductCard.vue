<template>
    <v-card raised>
        <v-container>
            <v-row no-gutters align="center">
                <v-col :cols="plain ? 4 : 12">
                    <v-carousel height="270">
                        <v-carousel-item v-for="(img, i) in productData.images" :key="i" v-ripple>
                            <v-dialog>
                                <template v-slot:activator="{ on }">
                                    <v-img :src="img.src" height="270" v-on="on" style="cursor: pointer"></v-img>
                                </template>

                                <v-card>
                                    <v-img :src="img.src"></v-img>
                                </v-card>
                            </v-dialog>
                        </v-carousel-item>
                    </v-carousel>
                </v-col>

                <v-col :cols="plain ? 5 : 12">
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
                    </v-list>
                </v-col>

                <v-col :cols="plain ? 3 : 12" align-self="end">
                    <v-list class="transparent" dense>
                        <v-list-item two-line>
                            <v-list-item-content>
                                {{ productData.description }}
                            </v-list-item-content>
                        </v-list-item>

                        <v-list-item class="pt-2">
                            <v-list-item-title>{{ productData.price }} Р</v-list-item-title>
                            <v-btn dark color="orange" @click="goToProduct(productData.id)">Купить</v-btn>
                        </v-list-item>
                    </v-list>

                </v-col>
            </v-row>
        </v-container>

    </v-card>
</template>

<script>
    export default {
        methods: {
            goToProduct(id) {
                this.$router.push(`/product/${id}`);
            }
        },
        props: {
            productData: {
                type: Object,
                required: true
            },
            plain: {
                type: Boolean,
                required: false,
                default: true
            }
        }
    }
</script>
