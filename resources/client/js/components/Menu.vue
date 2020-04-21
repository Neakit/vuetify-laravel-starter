<template>
    <v-container class="px-2">
        <v-row no-gutters>
            <v-col v-for="i in 5" :key="i">
                <v-btn block color="secondary" dark>Block Button</v-btn>
            </v-col>
        </v-row>
    </v-container>
</template>
