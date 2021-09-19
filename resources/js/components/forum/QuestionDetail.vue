<template>
    <show-question :data="question"></show-question>
</template>

<script>
    import ShowQuestion from "./ShowQuestion";
    export default {
        components:{ShowQuestion},
        props:['questionSlug'],
        data(){
            return{
                question: {}
            }
        },
        created() {
            axios.get(`/api/question/${this.questionSlug}`)
            .then(res => this.question = res.data)
            .catch(error => console.log(error.response.data.error))
            console.log(this.question)
        },
    }
</script>
