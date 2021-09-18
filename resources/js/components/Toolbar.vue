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
            <router-link v-for="item in items" :key="item.title" :to="item.to" v-if="item.show">
                <v-btn
                    text
                    rounded
                >{{ item.title }}</v-btn>
            </router-link>
        </div>
    </v-app-bar>
</template>

<script>
    export default {
        data(){
            return{
                items:[
                    {title:'صفحه اصلی',to:'/forum',show:true},
                    {title:'سوالتو بپرس',to:'/ask',show:User.loggedIn()},
                    {title:'دسته بندی ها',to:'/category',show:User.loggedIn()},
                    {title:'ورود',to:'/login',show:!User.loggedIn()},
                    {title:'خروج',to:'/logout',show:User.loggedIn()},
                ]
            }
        },
        methods: {
            changeRTL () {
                this.$vuetify.rtl = true
            },
        },
        created() {
            EventBus.$on('logout', () => {
                User.logout();
            })
        }
    }
</script>

<style>

</style>
