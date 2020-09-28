<template>
    <v-dialog
        v-model="dialog"
        max-width="350"
    >
        <template v-slot:activator="{ on }">
            <v-btn  style="float: right" width="70" v-on="on"   class="error mr-3"  depressed >Delete</v-btn>
        </template>
        <v-card>
            <v-card-title style="font-size:1em;color:darkred" >Are you sure you want to delete?</v-card-title>

            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                    small
                    style="background-color:#3b5998;color:white"
                    text
                    @click="dialog = false"
                >
                    Cancel
                </v-btn>

                <v-btn
                    small
                    style="background-color:#3b5998;color:white"
                    text
                    @click="deletematerial"
                >
                    Delete
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>

</template>
<script>
    export default {
        props:['data'],
        data () {
            return {
                dialog: false,
            }
        },
        methods:{
            deletematerial(){
                axios.delete(`/lms/api/material/${this.data.id}`)
                    .then(res =>this.dialog=false,this.$toasted.show('Material Deleted',{type:'success'}),
                        EventBus.$emit('material-remove',this.data)
                    )

            },
        }
    }
</script>
