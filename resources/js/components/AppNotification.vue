<template>
    <div class="text-center" v-if="showNotif">
        <v-menu offset-y>
            <template v-slot:activator="{ on, attrs }">
                <v-btn icon v-bind="attrs" v-on="on">
                    <v-icon :color="color">add_alert</v-icon>{{ unReadCount }}
                </v-btn>
            </template>
            <v-list>
                <v-list-item v-for="item in unRead" :key="item.id">
                    <router-link :to="notifRoute(item)">
                        <v-list-item-title @click="readIt(item)">{{ item.question }}</v-list-item-title>
                    </router-link>
                </v-list-item>
                <v-list-item v-for="item in read" :key="item.id">
                    <v-list-item-title>{{ item.question }}</v-list-item-title>
                </v-list-item>
            </v-list>
        </v-menu>
    </div>

</template>

<script>
    export default {
        data(){
            return{
                read:{},
                unRead:{},
                unReadCount:0,
                showNotif:false,
                sound: "https://soundbible.com/mp3/Tornado%20Siren-SoundBible.com-897026957.mp3"
            }
        },
        created() {
            if (User.loggedIn()){
                this.getNotifications();
                this.showNotif = true
            }
            this.notifRoute();
            Echo.private('App.Models.User.' + User.id())
                .notification((notification) => {
                    this.playSound()
                    this.unRead.unshift(notification)
                    this.unReadCount++
                })
        },
        computed:{
            color(){
                return this.unReadCount > 0 ? 'red' : 'red lighten-4'
            }
        },
        methods:{
            playSound(){
                var alert = new Audio(this.sound);
                alert.play();
            },
            getNotifications(){
                axios.get("/api/notification")
                .then(res => {
                    this.read = res.data.read
                    this.unRead = res.data.unRead
                    this.unReadCount = res.data.unRead.length
                })
                .catch(error => {
                    // console.log(error)
                    Exception.handle(error)
                })
            },
            readIt(notification){
                axios.post("/api/markAsRead",{id:notification.id})
                .then(res => {
                    this.unRead.splice(notification,1)
                    this.read.push(notification)
                    this.unReadCount--
                })
            },
            notifRoute(item){
                return this.$route.params.questionSlug !== undefined ? this.$route.params.questionSlug : (item.path);
            }
        }
    }
</script>
