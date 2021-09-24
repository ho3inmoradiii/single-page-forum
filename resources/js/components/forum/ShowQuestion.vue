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
                    <v-btn color="teal">{{ data.replies_count }} ریپلای</v-btn>
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
            <reply-new></reply-new>
            <the-reply :replies="replies" v-if="replies"></the-reply>
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
                replies: {}
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
            .then(res => this.replies = res.data)
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
            }
        }
    }
</script>

<style scoped>
    span{
        width: 100%;
    }
</style>
