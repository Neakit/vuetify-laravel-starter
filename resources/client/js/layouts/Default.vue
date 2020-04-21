<template>
    <!--    <div class="default-layout-wrapper">-->
    <v-app>

        <Header />
        <Menu />
<!--        <main>-->
            <router-view></router-view>
<!--        </main>-->

        <!-- <modal
            name="chat"
            draggable
            :pivotX="0.9"
            :pivotY="0.9"
            :width="280"
            :height="420"
        >
            <CallbackChat />
        </modal>

        <div class="feedback-chat-button">
            <img
                @click="openChat"
                src="/images/icons/phone-icon.svg"
                class="phone-logo"
            />
        </div> -->

<!--        <orderModal v-show="orderModal"/>-->
<!--        <mapModal v-if="mapModal"/>-->
<!--        <OrderSuccess v-show="orderSuccess"/>-->
<!--        <ProductImageModal v-show="productImageModal"/>-->
        <!--        <Footer />-->

    </v-app>
</template>

<script>
    import Menu from '../components/Menu';
    import Header from '../components/Header';
    // import orderModal from '../components/OrderModal';
    // import mapModal from '../components/mapModal';
    // import OrderSuccess from '../components/OrderSuccess';
    // import ProductImageModal from '../components/ProductImageModal';
    // import Footer from '../components/Footer';
    // import CallbackChat from '../components/CallbackChat'
    // import { mapActions, mapGetters } from 'vuex';

    export default {
        components: {
            Menu,
            Header,
            // orderModal,
            // mapModal,
            // Footer,
            // OrderSuccess,
            // ProductImageModal,
            // CallbackChat
        },
        mounted() {
            // this.getModels();
            // this.getCategories();
            // this.getProducts();
        },
        computed: {
            // ...mapGetters('modals', [
            //     'orderModal',
            //     'orderSuccess',
            //     'productImageModal',
            //     'mapModal'
            // ])
        },
        methods : {
            // ...mapActions('category', ['getCategories']),
            // ...mapActions('model', ['getModels']),
            // ...mapActions('product', ['getProducts']),
            // openChat() {
            //     this.$modal.show('chat');
            // }
        }
    }
</script>

<style scoped>
    /*.default-layout-wrapper {*/
    /*    min-height: 100vh;*/
    /*}*/
    /*.phone-logo {*/
    /*    width: 100%;*/
    /*    height: 100%;*/
    /*}*/
    /*.feedback-chat-button {*/
    /*    padding: 12px;*/
    /*    position: fixed;*/
    /*    right: 5%;*/
    /*    bottom: 10%;*/
    /*    border-radius: 50%;*/
    /*    background-color: #cf6100;*/
    /*    cursor: pointer;*/
    /*}*/
</style>

