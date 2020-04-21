<template>
    <v-container>
        <div class="row header align-items-center">
            <!-- logo -->
            <div class="col-sm-3 col-md-3 col-lg-4 my-2">
                <div class="row justify-content-center justify-content-sm-start d-flex align-items-center">
                    <img src="/images/cardan.svg" alt="cardan" style="height: 80px">
                    <div class="logo-wrap">
                        <p class="logo-title">АВТО-КОСМОС</p>
                        <p class="logo-sub">Карданные валы <br> для европейских грузовиков</p>
                    </div>
                </div>
            </div>
            <!-- social-icons -->
            <div class="col-1 d-flex justify-content-center align-items-center">
                <a href="https://wa.me/79255065236">
                    <img src="/images/icons/whatsapp.png" alt="social-icon" />
                </a>
            </div>
            <!-- phone -->
            <div class="my-2 col-sm-6 col-md-4 col-lg-3">
                <div class="d-flex align-items-center justify-content-start">
                    <img
                        src="/images/icons/phone-icon.svg"
                        class="phone-logo"
                    />
                    <div class="d-flex flex-column justify-content-around h-100">
                        <a class="phone-title" href="tel:+74955065236">+7-495-506-52-36</a >
                        <a class="phone-title" href="tel:+74955065236">+7-925-506-52-36</a >
                        <a class="phone-subtitle btn btn-link p-0 text-left" href="info@auto-cosmos.ru">info@auto-cosmos.ru</a>
                    </div>
                </div>
            </div>
            <!-- address -->
            <div class="col-sm-4 col-md-4 col-lg-4">
                <div class="map d-flex align-items-center">
                    <img
                        src="/images/icons/map-icon.svg"
                        class="map-logo"
                    />
                    <div class="d-flex flex-column justify-content-around h-100">
                        <p class="address-title">Мос обл. Химки Ленинградское шоссе, д. 238</p>
                        <button
                            @click="toggleModal({ name: 'mapModal', bool: true })"
                            class="map-link btn btn-link p-0 text-left"
                        >Показать на карте</button>
                    </div>
                </div>
            </div>

        </div>
    </v-container>
</template>

<script>
    import { mapMutations } from 'vuex';

    export default {
        methods: {
            ...mapMutations('modals', ['toggleModal'])
        }
    }

</script>

<style scoped lang="scss">
    .logo-wrap {
        p {
            font-size: 22px;
            text-transform: uppercase;
            color: #212121;
            margin-bottom: 0;
        }
        .logo-title {
            font-family: 'Gilroy Light', sans-serif;
            letter-spacing: 4px;
        }
        .logo-sub {
            font-family: 'Gilroy Bold', sans-serif;
            /*letter-spacing: 4px;*/
            text-transform: lowercase;
            font-size: 16px;
        }
    }
    .phone-wrap {
        flex-wrap: nowrap;
    }
    .map-link {
        color: #cf6100
    }
    .map-logo {
        margin: 0 7px;
    }
    .phone-logo {
        margin: 0 7px;
    }
    .address-title {
        font-family: 'PT Sans', sans-serif;
        font-size: 14px;
        line-height: 1;
    }
    .address-subtitle {
        font-size: 14px;
        color: #ee6056;
        cursor: pointer;
    }
    .phone-title {
        cursor: pointer;
        font-family: 'PT Sans', sans-serif;
        font-size: 16px;
        line-height: 1;
        font-weight: 600;
        color: #000;
        margin-bottom: 1rem;
    }
    .phone-subtitle {
        color: #000;
        font-size: 14px;
    }
</style>
