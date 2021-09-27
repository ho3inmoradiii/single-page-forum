<template>
    <div>
        <v-card>
            <v-container>
                <v-card-title>
                    <div class="text-right">
                        <div class="headline text-right">
                            {{ data.title }}
                        </div>
                        <span class="grey--text">این سوال {{ data.created_at }} روز پیش توسط {{ data.user }} پرسیده شده است</span>
                    </div>
                    <v-spacer></v-spacer>
                    <v-btn color="teal">{{ rep }} ریپلای</v-btn>
                </v-card-title>
                <v-card-text>
                    <div class="text-right" v-html="body">

                    </div>
                </v-card-text>
                <v-card-actions v-if="showActionButtons">
                    <v-btn icon small @click="editQuestion">
                        <v-icon color="orange">
                            edit
                        </v-icon>
                    </v-btn>
                    <v-btn icon small @click="deletequestion">
                        <v-icon color="red">
                            delete
                        </v-icon>
                    </v-btn>
                </v-card-actions>
            </v-container>
        </v-card>

        <v-container>
            <the-reply v-if="replies" :replies="replies" @changeReplyCount="ChangeT($event)"></the-reply>
            <reply-new></reply-new>
        </v-container>

    </div>
</template>

<script>
    import ReplyNew from "../reply/ReplyNew";
    import TheReply from "../reply/TheReply";
    export default {
        components:{TheReply,ReplyNew},
        props:['data'],
        data(){
            return{
                showActionButtons:false,
                replies: {},
                rep:null
            }
        },
        computed:{
            body(){
                return marked.parse(this.data.body);
            },

        },
        created() {
            if (User.own(this.data.id)){
                this.showActionButtons = true;
            }
            axios.get(`/api/question/${this.$route.params.questionSlug}/reply`)
            .then(res => this.replies = res.data);
            this.ChangeT()
        },
        methods:{
            deletequestion(){
                axios.delete(`/api/question/${this.$route.params.questionSlug}`)
                .then(res => {
                    this.$router.push('/forum')
                })
                .catch(error => console.log(error.response.data))
            },
            editQuestion(){
                EventBus.$emit('startEditing')
            },
            ChangeT(replyCount)
            {
                this.rep=replyCount;
            },
        }
    }
</script>

<style scoped>
    span{
        width: 100%;
    }
</style>
