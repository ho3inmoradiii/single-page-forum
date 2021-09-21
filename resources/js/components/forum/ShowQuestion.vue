<template>
    <v-card>
        <v-container fluid>
            <v-card-title>
                <div class="text-right">
                    <div class="headline text-right">
                        {{ data.title }}
                    </div>
                    <span class="grey--text">این سوال {{ data.created_at }} روز پیش توسط {{ data.user }} پرسیده شده است</span>
                </div>
                <v-spacer></v-spacer>
                <v-btn color="teal">5 ریپلای</v-btn>
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
</template>

<script>
    export default {
        props:['data'],
        data(){
            return{
                showActionButtons:false,
            }
        },
        computed:{
            body(){
                return marked.parse(this.data.body);
            }
        },
        created() {
            if (User.own(this.data.id)){
                this.showActionButtons = true;
            }
            console.log(this.$route.params)
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
