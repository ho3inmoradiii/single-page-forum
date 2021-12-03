<template>
    <v-container>
        <v-form
            ref="form"
            @submit.prevent="submit"
        >
            <v-text-field
                v-model="form.name"
                label="نام دسته مورد نظر"
                required
            ></v-text-field>
            <v-btn
                depressed
                color="pink"
                type="submit"
                v-if="editSlug"
                :disabled="disabled"
            >ثبت تغییرات</v-btn>
            <v-btn
                depressed
                color="teal"
                type="submit"
                v-else
                :disabled="disabled"
            >ثبت</v-btn>
        </v-form>

        <v-card class="mt-4">
            <v-toolbar
                color="light-blue"
                dark
            >
                <v-toolbar-title>دسته بندی ها</v-toolbar-title>

            </v-toolbar>
            <div v-for="(item,index) in items" :key="item.id">
                <v-list rounded  class="d-flex">
                    <v-list-item-action>
                        <v-btn small icon @click="edit(index)">
                            <v-icon color="orange">edit</v-icon>
                        </v-btn>
                    </v-list-item-action>
                    <v-list-item>
                        <v-list-item-content>
                            <v-list-item-title v-text="item.name" class="text-right">category</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                    <v-list-item-action>
                        <v-btn small icon @click="deleteCategory(item.slug,index)">
                            <v-icon color="red">delete</v-icon>
                        </v-btn>
                    </v-list-item-action>
                </v-list>
                <v-divider></v-divider>
            </div>
        </v-card>
    </v-container>
</template>

<script>
    export default {
        data(){
            return{
                form:{
                    name:null
                },
                items: [],
                errors:null,
                editSlug:null
            }
        },
        created() {
            if (!User.admin()){
                this.$router.push('/forum');
            }
            axios.get('/api/category')
                .then(res => this.items = res.data)
                .catch(error => console.log(error.response.data))
        },
        methods:{
            submit(){
                this.editSlug ? this.editCategory() : this.createCategory();

            },
            createCategory(){
                axios.post('/api/category',this.form)
                    .then(res => {
                        this.items.unshift(res.data)
                        this.form.name = null
                    })
                    .catch(error => console.log(error.response.data))
            },
            editCategory(){
                axios.patch(`/api/category/${this.editSlug}`,this.form)
                    .then(res => {
                        this.items.unshift(res.data)
                        this.form.name = null
                    })
                    .catch(error => console.log(error.response.data))
            },
            deleteCategory(slug,index){
                axios.delete(`/api/category/${slug}`)
                .then(res => this.items.splice(index,1))
                .catch(error => console.log(error.response.data))
            },
            edit(index){
                this.form.name = this.items[index].name;
                this.editSlug = this.items[index].slug;
                this.items.splice(index,1);
            }
        },
        computed:{
            disabled(){
                return !(this.form.name)
            }
        }
    }
</script>
