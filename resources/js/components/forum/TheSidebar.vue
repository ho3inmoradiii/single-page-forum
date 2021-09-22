<template>
    <v-slide-y-transition>
        <v-card class="mr-2 sticky-card" v-if="delayShow && items" transition="fab-transition">
            <v-toolbar
                color="light-blue"
                dark
            >
                <v-toolbar-title>دسته بندی ها</v-toolbar-title>

            </v-toolbar>
            <v-list rounded>
                <v-list-item
                    v-for="item in items"
                    :key="item.id"
                >
                    <v-list-item-content>
                        <v-list-item-title v-text="item.name" class="text-right"></v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>
        </v-card>
    </v-slide-y-transition>
</template>

<script>

    export default {
        data(){
            return{
                items: {},
                delayShow:false
            }
        },
        created() {
            axios.get('/api/category')
                .then(res => this.items = res.data)
                .catch(error => console.log(error.response.data))

        },
        mounted() {
            setTimeout(()=>{
                this.delayShow=true;
            },1000)
        }
    }

</script>

<style scoped>
    .sticky-card {
        position: fixed;
        z-index: 1;
    }

    .sidebar-enter-from{
        opacity: 0;
        transform: scale(0);
    }

    .sidebar-enter-active{
        transition: all 1s ease-out;
    }

    .sidebar-enter-to{
        opacity: 1;
        transform: scale(1);
    }
</style>
