<template>
    <div>
        <v-container>
            <v-form @submit.prevent="sendReply">
                <vue-simplemde v-model="body" />
                <v-btn dark color="green" type="submit">
                    ثبت
                </v-btn>
            </v-form>
        </v-container>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                body:''
            }
        },
        created() {

        },
        methods:{
            sendReply(){
                axios.post(`/api/question/${this.$route.params.questionSlug}/reply`,{body:this.body})
                .then(res => {
                    this.body=''
                    EventBus.$emit('newReply',res.data)
                    window.scrollTo(0,0);
                    // console.log(res.data)
                })
                .catch(error => console.log(error.response.data))
            }
        }
    }
</script>
