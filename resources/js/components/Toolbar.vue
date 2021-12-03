<template>
    <v-app-bar
        color="indigo"
        dense
        dark
        app
    >
        <v-toolbar-title>
            <router-link to="/" class="white--text">H.Forum</router-link>
        </v-toolbar-title>
        <v-spacer></v-spacer>
        <app-notification/>
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
    import AppNotification from './AppNotification';
    export default {
        components:{AppNotification},
        data(){
            return{
                items:[
                    {title:'صفحه اصلی',to:'/forum',show:true},
                    {title:'سوالتو بپرس',to:'/ask',show:User.loggedIn()},
                    {title:'دسته بندی ها',to:'/category',show:User.admin()},
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
