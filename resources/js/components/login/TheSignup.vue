<template>
    <v-container>
        <v-form
            ref="form"
            v-model="valid"
            lazy-validation
            @submit.prevent="signup"
        >
            <v-text-field
                v-model="form.name"
                label="نام"
                required
            ></v-text-field>
<!--            <span class="red&#45;&#45;text errors" v-if="errors.name">{{ errors.name[0] }}</span>-->

            <v-text-field
                v-model="form.email"
                label="ایمیل"
                required
            ></v-text-field>
<!--            <span class="red&#45;&#45;text errors" v-if="errors.email">{{ errors.email[0] }}</span>-->

            <v-text-field
                v-model="form.password"
                label="رمز عبور"
                required
            ></v-text-field>
<!--            <span class="red&#45;&#45;text errors" v-if="errors.password">{{ errors.password[0] }}</span>-->
            <router-link to="/login">
                <v-btn
                    color="primary"
                    elevation="4"
                    outlined
                >ورود</v-btn>
            </router-link>
            <v-btn
                depressed
                color="primary"
                type="submit">ثبت نام</v-btn>
        </v-form>
    </v-container>
</template>

<script>
    export default {
        data(){
            return{
                valid: false,
                form:{
                    name:null,
                    email:null,
                    password:null
                },
                errors:{}
                // nameRules: [
                //     v => !!v || 'وارد کردن نام الزامی است',
                //     v => v.length <= 10 || 'نام بایستی کمتر از 10 کاراکتر باشد',
                // ],
                // emailRules: [
                //     v => !!v || 'وارد کردن ایمیل الزامی است',
                //     v => /.+@.+/.test(v) || 'ایمیل معتبر وارد کنید',
                // ],
                // passwordRules:[
                //     v => !!v || 'وارد کردن پسورد الزامی است',
                // ]
            }
        },
        created() {
            if(User.loggedIn()){
                this.$router.push({name:'Forum'})
            }
        },
        methods:{
            signup(){
                axios.post('/api/auth/signUp',this.form)
                    .then(res => {
                        User.responseAfterLogin(res)
                        this.$router.push({name:'Forum'})
                    })
                    .catch(error => console.log(error.response.data))
            }
        }
    }
</script>

<style scoped>
    .errors{
        text-align: right !important;
        width: 100%;
        display: inline-block;
    }
</style>
