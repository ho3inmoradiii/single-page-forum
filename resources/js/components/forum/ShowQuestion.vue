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
                <div class="text-right">
                    {{ data.body }}
                </div>
            </v-card-text>
        </v-container>
    </v-card>
</template>

<script>
    export default {
        props:['data']
    }
</script>

<style scoped>
    span{
        width: 100%;
    }
</style>
