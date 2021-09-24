<template>
    <v-container>
        <single-reply v-for="reply in replies" :key="reply.id" :data="reply"></single-reply>
    </v-container>
</template>

<script>
    import SingleReply from './SingleReply';
    export default {
        components:{SingleReply},
        props:['replies'],
        data(){
            return {
                // content:this.replies
                updatedReply:false,
                content:null
            }
        },
        watch: {
            // replies: function(){
            //     this.content = this.replies;
            // }
        },

        computed:{
            rep(){
                return this.updatedReply ? this.content : this.replies
            }
        },

        created() {
            this.listen();
        },
        methods:{
            listen(){
                EventBus.$on('newReply',(reply) => {
                    console.log(reply);
                    this.replies.unshift(reply);
                })
            }
        }
    }
</script>
