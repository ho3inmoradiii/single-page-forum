<template>
    <div class="mt-4">
        <v-card>
            <v-card-title>
                <div class="headline">{{ data.user }}</div>
                <div class="mr-2">نظر داده {{ data.created_at }}</div>
            </v-card-title>
            <v-divider></v-divider>
            <v-card-text v-text="data.reply" class="text-right"></v-card-text>
            <v-divider></v-divider>
            <v-card-actions v-if="showActions">
                <v-btn icon small>
                    <v-icon color="orange">edit</v-icon>
                </v-btn>

                <v-btn icon small>
                    <v-icon color="red">delete</v-icon>
                </v-btn>
            </v-card-actions>
        </v-card>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                showActions:false,
            }
        },
        props:['data'],
        created() {
            if (this.data.user_id === User.id()){
                this.showActions = true
            }
        }
    }
</script>
