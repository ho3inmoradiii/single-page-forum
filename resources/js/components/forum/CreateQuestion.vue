<template>
    <v-container>
        <v-form
            ref="form"
            v-model="valid"
            lazy-validation
            @submit.prevent="createQuestion"
        >
            <v-text-field
                v-model="form.title"
                label="عنوان سوال"
                required
            ></v-text-field>
            <v-autocomplete
                v-model="form.category_id"
                :items="categories"
                item-text="name"
                item-value="id"
                auto-select-first
                solo
                solo-inverted
                autocomplete
                label="Filled"
            ></v-autocomplete>

            <vue-simplemde v-model="form.body" />

            <v-btn
                depressed
                color="primary"
                type="submit">ثبت پرسش</v-btn>
        </v-form>
    </v-container>
</template>

<script>
    export default {
        data(){
            return{
                valid:'',
                categories:{},
                form:{
                    title:null,
                    body:null,
                    category_id:null
                },
                errors:{}
            }
        },
        created() {
            if(!User.loggedIn()){
                this.$router.push({name:'Forum'})
            }
            axios.get('/api/category')
                .then(res => this.categories = res.data)
                .catch(error => console.log(error.response.data))
        },
        methods:{
            createQuestion(){
                axios.post('/api/question',this.form)
                .then(res => {
                    console.log(res.data)
                    this.$router.push(res.data.path)
                })
                .catch(error => this.errors = error.response.data.error)
            }
        }
    }
</script>
