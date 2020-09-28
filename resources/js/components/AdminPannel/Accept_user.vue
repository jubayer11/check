<template>
    <v-badge
        v-model="show"
        overlap
        class="primary mx-lg-6 my-3"
        depressed
    >
        <template v-slot:badge>
            <span>done</span>
        </template>

        <v-icon
            dark  width="70"
            large
            @mouseover="show= true"
            @mouseout="show=false"
            @click="accepting_user(user)"
        >done</v-icon>

    </v-badge>
</template>
<script>
    export default {
        props:['user'],
        data(){
            return {
                show:false,
            }
        },
        methods:{
            accepting_user(user)
            {
                axios.patch(`/lms/api/user/accept_user/${user.id}`)
                    .then(res =>this.$toasted.show('User Accepted',{type:'success'}),
                        EventBus.$emit('newUser',user)
                    )
            },
        }
    }
</script>
