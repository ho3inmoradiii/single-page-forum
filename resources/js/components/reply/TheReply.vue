<template>
    <v-container>
        <single-reply v-for="(reply,index) in dd" :key="reply.id" :index="index" :data="reply"></single-reply>
    </v-container>
</template>

<script>
    import SingleReply from './SingleReply';
    export default {
        components:{SingleReply},
        props: ['replies'],
        data(){
            return {
                dd: this.replies
            }
        },
        watch: {
            replies: function(){
                this.dd = this.replies;
                this.passEvent();
            }
        },
        computed:{
            repliesLength(){
                return Object.keys(this.dd).length;
            }
        },

        created() {
            this.listen();
        },
        methods:{
            listen(){
                EventBus.$on('newReply',(reply) => {
                    this.replies.unshift(reply.reply);
                })
                EventBus.$on('destroyReply',(idx) => {
                    axios.delete(`/api/question/${this.$route.params.questionSlug}/reply/${this.replies[idx].id}`)
                    .then(res => {
                        this.replies.splice(idx,1);
                    })
                    .catch(error => console.log(error.response.data))
                })

                Echo.private('App.Models.User.' + User.id())
                    .notification((notification) => {
                        this.replies.unshift(notification.reply)
                    })

                Echo.channel('deleteReplyChannel')
                    .listen('DeleteReplyEvent',(e) => {
                        for (let index=0;index<this.replies.length;index++){
                            if (this.replies[index].id === e.id){
                                this.replies.splice(index,1);
                            }
                        }
                    })
            },
            passEvent(){
                this.$emit('changeReplyCount',this.repliesLength)
            },




        }
    }
</script>
