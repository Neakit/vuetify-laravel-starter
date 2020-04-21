<template>
    <swiper class="swiper" :options="swiperOption">
        <swiper-slide
            v-for="product in products"
            :key="index"
        >
            <v-card
                class="mx-auto"
                max-width="250"
            >
                <v-img
                    class="white--text align-end"
                    height="200px"
                    :src="product.images[1].src"
                >
                    <v-card-title>{{ product.title }} {{ product.product_model }}</v-card-title>
                </v-img>

                <v-card-subtitle class="pb-0">{{ product.number }}</v-card-subtitle>

                <v-card-text class="text--primary">
                    <div>{{ product.product_number_replacements }}</div>
                </v-card-text>

                <v-card-actions>
                    <v-btn
                        color="orange"
                        text
                    >
                        Share
                    </v-btn>
                </v-card-actions>
            </v-card>
        </swiper-slide>
        <div class="swiper-pagination" slot="pagination"></div>
        <div class="swiper-button-prev" slot="button-prev"></div>
        <div class="swiper-button-next" slot="button-next"></div>
    </swiper>
</template>

<script>
    import ProductCard from "./ProductCard";
    export default {
        name: 'swiper-example-loop-group',
        components: { ProductCard },
        title: 'Loop mode with multiple slides per group',
        mounted() {
            this.getProducts();
        },
        methods: {
            getProducts() {
                axios({
                    method: 'get',
                    url: '/get-records/products'
                }).then(res => {
                    this.products = this.formatProductData(res.data.data);
                }).catch(e => {
                    console.error(e)
                });
            },
            formatProductData(data) {
                return data.map(p => {
                    p.images = p.images !== null && p.images.length > 0 && JSON.parse(p.images);
                    p.images = Object.values(p.images).map(i =>  ({ src: `/images/products/${i}` }) ) || [];
                    return {
                        id: p.id,
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
                })
            }
        },
        data() {
            return {
                products: [],
                swiperOption: {
                    slidesPerView: 6,
                    spaceBetween: 30,
                    slidesPerGroup: 6,
                    loop: true,
                    loopFillGroupWithBlank: true,
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev'
                    }
                }
            }
        }
    }
</script>
