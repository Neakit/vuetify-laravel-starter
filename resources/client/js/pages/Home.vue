<template>
    <v-container>
        <div>
            <product-card
                v-for="product in products"
                :key="index"
                plain
                :product-data="product"
            />
        </div>
    </v-container>
</template>

<script>
    import ProductCard from "../components/ProductCard";

    export default {
        name: 'home',
        components: {
            'product-card': ProductCard
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
        created() {
            this.getProducts();
        },
        data() {
            return {
                products: []
            }
        }
    }
</script>

