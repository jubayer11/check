<template>
    <v-card
        class="mx-auto"
        max-width="100%"
        max-height="100%"
        style="margin-top:5%"
        flat
    >
        <v-card-title style="font-size: 180%">{{material.title}}</v-card-title>
        <v-card-text style="color: #3e2723">{{material.body}}</v-card-text>
        <v-card-actions>
            <v-btn> <a :href="'http://faisalsarker.com/lms/public/uploads/x/x/material/'+material.file" target="_blank"><button type="button" class="btn btn-sm">Read File</button></a></v-btn>
        </v-card-actions>
    </v-card>
</template>


<script>
export default {
    data(){
        return{
            material:{},
        }

    },
    created() {
        this.getmaterial();

    },
    methods:{
        getmaterial() {
            axios.get(`/lms/api/material/single/${this.$route.params.material}`)
                .then(res => this.material = res.data.data)

        },
    },
    computed:{

    }
}

</script>
