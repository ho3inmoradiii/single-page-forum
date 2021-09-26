<template>
    <div>
            <vue-simplemde v-model="reply.reply" />
            <v-card-actions>
                    <v-btn icon small @click="saveEditReply">
                        <v-icon color="orange">save</v-icon>
                    </v-btn>

                    <v-btn icon small @click="cancelEditReply">
                        <v-icon color="red">cancel</v-icon>
                    </v-btn>
            </v-card-actions>
    </div>
</template>

<script>
    export default {
        props:['reply','index'],
        data(){
            return{
                body:null
            }
        },
        methods:{
            saveEditReply(){
                axios.patch(`/api/question/${this.$route.params.questionSlug}/reply/${this.reply.id}`,{body:this.reply.reply})
                .then(res => {
                    this.cancelEditReply()
                })
            },
            cancelEditReply(){
                EventBus.$emit('cancelEdit');
            }
        }
    }
</script>
