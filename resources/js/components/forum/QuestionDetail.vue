<template>
    <show-question :data="question" v-if="question"></show-question>
</template>

<script>
    import ShowQuestion from "./ShowQuestion";
    export default {
        components:{ShowQuestion},
        props:['questionSlug'],
        data(){
            return{
                question: null
            }
        },
        created() {
            axios.get(`/api/question/${this.questionSlug}`)
            .then(res => this.question = res.data)
            .catch(error => console.log(error.response.data.error))
        },
    }
</script>
