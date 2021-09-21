<template>
    <div v-if="question">
        <edit-question v-if="editing" :data="question"></edit-question>
        <show-question :data="question" v-else></show-question>
    </div>

</template>

<script>
    import ShowQuestion from "./ShowQuestion";
    import EditQuestion from "./EditQuestion";
    export default {
        components:{ShowQuestion,EditQuestion},
        props:['questionSlug'],
        data(){
            return{
                question: null,
                editing:false
            }
        },
        created() {
            this.listen()
            this.getQuestion()
        },
        methods:{
            listen(){
                EventBus.$on('startEditing',()=>{
                    this.editing = true;
                })
                EventBus.$on('cancelEdit',()=>{
                    this.editing = false;
                })
            },
            getQuestion(){
                axios.get(`/api/question/${this.questionSlug}`)
                    .then(res => this.question = res.data)
                    .catch(error => console.log(error.response.data.error))
            }
        }
    }
</script>
