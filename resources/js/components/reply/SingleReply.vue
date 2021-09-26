<template>
    <div class="mt-4">
        <v-card>
            <v-card-title>
                <div class="headline">{{ data.user }}</div>
                <div class="mr-2">نظر داده {{ data.created_at }}</div>
            </v-card-title>
            <v-divider></v-divider>
            <edit-reply v-if="editing" :reply="data" :index="index"></edit-reply>
            <v-card-text v-else>
                <div class="text-right" v-html="reply">

                </div>
            </v-card-text>
            <v-divider></v-divider>
            <v-card-actions v-if="showActions">
                <div v-if="!editing">
                    <v-btn icon small @click="editReply">
                        <v-icon color="orange">edit</v-icon>
                    </v-btn>

                    <v-btn icon small @click="deleteReply">
                        <v-icon color="red">delete</v-icon>
                    </v-btn>
                </div>
            </v-card-actions>
        </v-card>
    </div>
</template>

<script>
    import EditReply from "./EditReply";
    export default {
        components:{EditReply},
        data(){
            return{
                showActions:false,
                editing:false
            }
        },
        props:['data','index'],
        computed:{
            reply(){
                return marked.parse(this.data.reply);
            },
        },
        created() {
            if (this.data.user_id === User.id()){
                this.showActions = true
            }
            this.listen()
        },
        methods:{
            deleteReply(){
                EventBus.$emit('destroyReply',this.index)
            },
            editReply(){
                this.editing = true;
            },
            listen(){
                EventBus.$on('cancelEdit',()=>{
                    this.editing = false
                })
            }
        }
    }
</script>
