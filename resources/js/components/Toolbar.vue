<template>
    <v-app-bar
        color="primary accent-4"
        dense
        dark
        app
    >
        <v-toolbar-title>
            H.Forum
        </v-toolbar-title>
        <v-spacer></v-spacer>
        <div style="direction: rtl">
            <v-btn
                text
                rounded
            >صفحه اصلی</v-btn>
            <v-btn
                text
                rounded
            >سوالت بپرس</v-btn>
            <v-btn
                text
                rounded
            >دسته بندی ها</v-btn>
            <v-btn
                text
                rounded
            >ورود</v-btn>
        </div>
    </v-app-bar>
</template>

<script>
    export default {
        methods: {
            changeRTL () {
                this.$vuetify.rtl = true
            },
        },
    }
</script>

<style>

</style>
