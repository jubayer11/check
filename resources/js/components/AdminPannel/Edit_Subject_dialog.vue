<template>

    <v-dialog v-model="dialog" persistent max-width="600px">
        <template v-slot:activator="{ on }">
            <v-badge
                v-model="show"
                color="primary"
                overlap
            >
                <template v-slot:badge>
                    <span>Edit</span>
                </template>
                <v-icon
                    v-on="on" class="mx-lg-6 my-3"  dark  color="primary" width="70"
                    large
                    @mouseover="show = true"
                    @mouseout="show = false"
                >edit</v-icon>
            </v-badge>
        </template>
        <v-card>
            <v-card-title>
                <span style="color: #3b5998" class="headline">Edit Subject</span>
            </v-card-title>
            <v-card-text>
                <v-container>
                    <v-row>
                        <v-col cols="12" sm="12" md="6">

                            <v-text-field outlined rounded label="Subject Name*" v-model="subject.name" required></v-text-field>
                            <span class="red--text" v-if="errors.name">{{errors.name[0]}}</span>

                        </v-col>
                        <v-col cols="12" sm="12" md="6">
                            <v-text-field  label="Section*" outlined rounded  required v-model="subject.section" ></v-text-field>
                            <span class="red--text" v-if="errors.section">{{errors.section[0]}}</span>

                        </v-col>
                        <v-col cols="12" sm="12" md="6">
                            <v-select
                                outlined
                                rounded
                                :items="item"
                                label="Select Status"
                                item-text="name"
                                item-value="id"
                                v-model="subject.status"
                            >

                            </v-select>
                            <span class="red--text" v-if="errors.status">{{errors.status[0]}}</span>

                        </v-col>
                        <v-col cols="12" sm="12" md="6">
                            <v-select
                                outlined
                                rounded
                                :items="datah"
                                label="Select Class"
                                item-text="name"
                                item-value="id"
                                v-model="subject.class_id"
                            >

                            </v-select>
                            <span class="red--text" v-if="errors.class_head">you have to select a class</span>

                        </v-col>
                        <v-col cols="12" sm="12" md="12">
                            <v-textarea
                                outlined
                                rounded
                                label="Description"
                                v-model="subject.description"
                            ></v-textarea>
                        </v-col>
                    </v-row>

                </v-container>

            </v-card-text>
            <v-card-actions>
                <div class="flex-grow-1"></div>
                <v-btn style="background-color:#3b5998;color:white" text @click="dialog = false">Close</v-btn>
                <v-btn style="background-color:#3b5998;color:white"  text @click="EditSubject">Save</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>


</template>

<script>
    export default {
        props:['datah','subject'],
        data: () => ({
            dialog: false,
            modal: false,
            menu2: false,
            item:[
                {'id':1,'name':'Active'},
                {'id':0,'name':'In-Active'}
            ],
            show:false,
            errors:'',
        }),
        computed:{


        },
        methods:{
            EditSubject(){
                axios.patch(`/lms/api/class/${this.subject.id}`,this.subject)
                    .then(res =>this.dialog=false,
                        this.$toasted.show('Subject Edited',{type:'success'}),
                        this.errors='',

                    )
                    .catch(error =>this.errors = error.response.data.errors)
            },

        },
    }
</script>
