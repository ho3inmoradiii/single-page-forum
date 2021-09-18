<template>
    <v-container>
        <v-form
            ref="form"
            v-model="valid"
            lazy-validation
            @submit.prevent="login"
        >
            <v-text-field
                v-model="form.email"
                :rules="emailRules"
                label="ایمیل"
                required
            ></v-text-field>

            <v-text-field
                v-model="form.password"
                :rules="nameRules"
                label="رمز عبور"
                required
            ></v-text-field>
            <router-link to="/signUp">
                <v-btn
                    color="primary"
                    elevation="4"
                    outlined
                >ثبت نام</v-btn>
            </router-link>
            <v-btn
                depressed
                color="primary"
                type="submit">ورود</v-btn>
        </v-form>


    </v-container>
</template>

<script>
    export default {
        data(){
            return{
                valid: false,
                form:{
                    email:'',
                    password:''
                },
                nameRules: [
                    v => !!v || 'Name is required',
                    v => v.length <= 10 || 'Name must be less than 10 characters',
                ],
                emailRules: [
                    v => !!v || 'E-mail is required',
                    v => /.+@.+/.test(v) || 'E-mail must be valid',
                ],
            }
        },
        created() {
            if(User.loggedIn()){
                this.$router.push({name:'Forum'})
            }
        },
        methods:{
            login(){
                User.login(this.form);
            }
        }
    }
</script>

<style>

</style>
