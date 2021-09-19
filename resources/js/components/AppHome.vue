<template>
    <v-app>
        <div>
            <toolbar></toolbar>
            <div class="content">
                <router-view></router-view>
<!--                <vue-progress-bar></vue-progress-bar>-->
                <app-footer></app-footer>
            </div>
        </div>
    </v-app>
</template>

<script>
    import Toolbar from './Toolbar';
    import AppFooter from './AppFooter';
    export default {
        components:{Toolbar,AppFooter}
    }
</script>

<style scoped>
    .content{
        margin-top: 50px;
    }
</style>
