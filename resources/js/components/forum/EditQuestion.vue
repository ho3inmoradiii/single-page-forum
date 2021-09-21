<template>
    <v-container>
        <v-card class="pa-6">
            <v-form @submit.prevent="editQuestion">
                <v-text-field
                    v-model="form.title"
                    label="عنوان سوال"
                    required
                ></v-text-field>

                <vue-simplemde v-model="form.body" />

                <v-card-actions>
                    <v-btn icon small type="submit">
                        <v-icon color="teal">save</v-icon>
                    </v-btn>

                    <v-btn icon small @click="cancelEdit">
                        <v-icon>cancel</v-icon>
                    </v-btn>
                </v-card-actions>
            </v-form>
        </v-card>
    </v-container>
</template>

<script>
    export default {
        props:['data'],
        data(){
            return{
                form:{
                    title:'',
                    body:''
                },
                errors:{}
            }
        },
        mounted() {
            this.form =this.data;
        },
        methods:{
            cancelEdit(){
                EventBus.$emit('cancelEdit')
            },
            editQuestion(){
                axios.patch(`/api/question/${this.$route.params.questionSlug}`,this.form)
                .then(res => this.cancelEdit())
                .catch(error => this.errors = error.response.data)
            }
        }
    }
</script>
