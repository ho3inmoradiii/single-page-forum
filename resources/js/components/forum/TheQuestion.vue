<template>
    <v-card class="mb-4">
        <v-card-title primary-title>
            <div>
                <router-link :to="question.path" class="headline mb-0">
                    <div class="text-right">
                        {{ question.title }}
                    </div>
                </router-link>
                <div class="grey--text text-right" style="direction: rtl">این سوال در تاریخ {{ question.created_at }} توسط {{ question.user }} پرسیده شده است</div>
            </div>
        </v-card-title>
        <v-card-text>
            <div class="text-right">
                {{ question.body }}
            </div>
        </v-card-text>
    </v-card>
</template>

<script>
    export default {
        props:['question']
    }
</script>
