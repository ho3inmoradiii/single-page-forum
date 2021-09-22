<template>
    <v-container fluid grid-list-md>
        <v-layout row wrap>
            <v-flex xs8>
                <the-question v-for="question in questions" :key="question.path" :question="question"></the-question>
            </v-flex>
            <v-flex xs4 class="position-relative">
                <the-sidebar></the-sidebar>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    import TheQuestion from './TheQuestion';
    import TheSidebar from './TheSidebar';
    export default {
        components:{TheQuestion,TheSidebar},
        data(){
            return{
                questions: {}
            }
        },
        created(){
            axios.get('/api/question')
            .then(res => this.questions = res.data)
            .catch(error => console.log(error.response.data))
        },
    }
</script>

<style scoped>

</style>
