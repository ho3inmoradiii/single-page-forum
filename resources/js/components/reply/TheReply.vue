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

                })
            },
            passEvent(){
                this.$emit('changeReplyCount',this.repliesLength)
            }
        }
    }
</script>
