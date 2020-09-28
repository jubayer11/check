<template>
    <v-card
        class="mx-auto d-flex flex-wrap grey lighten-4"
        max-width="95%"
        flat

    >
        <v-img
            class="white--text align-end "
            height="300px"
            :src="'http://faisalsarker.com/lms/public/uploads/x/x/profile/book.jpg'"
        >


                <h3 class="ml-3">{{classes.name}}</h3>

            <div class="ml-3" v-for="(teacher,index) in dat" v-if="teacher.role =='Teacher'">
                <h4 class="white--text text-capitalize" >{{teacher.first_name}} {{teacher.last_name}}</h4>
            </div>
        </v-img>

        <v-card-text>
                <v-tabs
                    flat
                    grow
                    v-model="tab"
                    center-active
                    mobile-break-point="700"
                    show-arrows
                    slider-color="white"
                    slider-size="4"
                >
                    <v-tab>
                        <v-icon left>info</v-icon>
                        Class Information
                    </v-tab>
                    <v-tab>
                        <v-icon left>menu_book</v-icon>
                        Class Material
                    </v-tab>
                </v-tabs>
                    <v-tabs-items v-model="tab">
                        <v-tab-item>
                            <v-card class="mx-auto"
                                    flat
                                    max-width="100%"
                            >
                                <v-card-text>
                                    <v-simple-table>
                                        <tbody>
                                        <tr>
                                            <td class="font-weight-black"> Class Name:</td>
                                            <td class="black--text text-capitalize"> {{classes.name}}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-black">Section:</td>
                                            <td class="black--text text-capitalize">{{classes.section}}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-black">Description:</td>
                                            <td class="black--text text-capitalize">{{classes.description}}</td>
                                        </tr>
                                        <tr v-for="(teacher,index) in dat" v-if="teacher.role =='Teacher'">
                                            <td class="font-weight-black"> Teacher's Name:</td>
                                            <td class="black--text text-capitalize" >{{teacher.first_name}} {{teacher.last_name}}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-black">Created At:</td>
                                            <td class="black--text">{{classes.created_at}}</td>
                                        </tr>
                                        </tbody>
                                    </v-simple-table>
                                </v-card-text>
                            </v-card>
                        </v-tab-item>
                        <v-tab-item>
                            <v-card

                                class="mx-auto grey lighten-4"
                                flat
                                max-width="100%">
                                <v-card-text v-if="permission=='Admin'|| permission=='Teacher'" style="float: right">
                                    <dilog :data="classes.id"></dilog>
                                </v-card-text>

                                <v-card-text>

                                    <v-row >
                                        <v-col
                                            cols="12"
                                            md="4"
                                            v-for="material in materials"
                                            :key="material.user_id"
                                        >
                                            <v-card flat>
                                                <v-card
                                                    flat
                                                    class="mx-auto"
                                                    max-width="100%"
                                                    height="320"
                                                    style="overflow-y: auto;"


                                                >

                                                    <v-toolbar flat>
                                                        <span>{{material.option}}</span>
                                                        <v-spacer></v-spacer>
                                                        <span>Lecture No : {{material.lecture}}</span>
                                                    </v-toolbar>
                                                    <v-card-title >{{material.title}}
                                                    </v-card-title>
                                                    <v-card-text style="color: #000000">{{material.body}}</v-card-text>
                                                    <v-list-item-action style="padding-left:5%;">
                                                        <a :href="'http://faisalsarker.com/lms/public/uploads/x/x/material/'+material.file" target="_blank"><button type="button" class="btn btn-sm">Read File</button></a>
                                                    </v-list-item-action>
                                                    <v-card-actions>{{material.created_at}}</v-card-actions>

                                                </v-card>
                                                <v-card flat>
                                                    <v-row class="d-flex">
                                                        <v-col
                                                            sm="4"
                                                            md="4"
                                                            cols="4"
                                                        >
                                                            <a style="text-decoration: none;"  :href="'/lms/class/material/'+material.id"><v-btn class="ml-3" width="70" style="color: white;background-color:#3b5998;" depressed>Click</v-btn></a>
                                                        </v-col>
                                                        <v-col
                                                            sm="4"
                                                            md="4"
                                                            cols="4"
                                                            v-if="permission=='Admin'|| permission=='Teacher'"
                                                        >
                                                            <EditMaterialdilog   class="text-center" :data="material"></EditMaterialdilog>

                                                        </v-col>
                                                        <v-col
                                                            sm="4"
                                                            md="4"
                                                            cols="4"
                                                            v-if="permission=='Admin'|| permission=='Teacher'"
                                                        >
                                                            <deleteClassMaterialDialog  :data="material"></deleteClassMaterialDialog>
                                                        </v-col>
                                                    </v-row>
                                                </v-card>
                                            </v-card>
                                            <br>
                                        </v-col>
                                    </v-row>


                                </v-card-text>
                            </v-card>
                        </v-tab-item>
                    </v-tabs-items>
        </v-card-text>
          {{createdM}}
          {{getMaterial}}
        {{getuser}}
    </v-card>
</template>
<script>
    import invite_dilog from "./invite_dilog";
    import dilog from './Material_dilog.vue'
    import EditMaterialdilog from "./EditMaterialdilog.vue";
    import deleteClassMaterialDialog from "./deleteClassMaterialDialog.vue"

    export default {
        props:['data','datas','dat'],
        components: {dilog, invite_dilog,EditMaterialdilog,deleteClassMaterialDialog},
        data() {
            return {
                tab: null,
                classes:{},
                materials:{},
                x:null,
                users:{},
                permission:null,



            }
        },
        created(){
                this.permission=User.role();
          this.listen();

        },

        computed:{
            createdM() {
                this.classes=this.data;
            },
            getMaterial(){
                this.materials=this.datas;
            },
            getuser(){
                this.users=this.dat;
            },
        },
        methods:{
            listen(){
                EventBus.$on('newMaterial',(ann) =>{
                    this.materials.unshift(ann)
                })
                EventBus.$on('material-remove',(mat_r) =>{
                    this.materials.splice(this.materials.indexOf(mat_r), 1);
                })

            },
            deletematerial(index,id){
                axios.delete(`/lms/api/material/${id}`)
                    .then(res =>this.materials.splice(index, 1))
            }


        },

    }
</script>
<style>
    /* Helper classes */
    .basil {
        background-color: #b380ff !important;
    }

    .basil--text {
        color: white !important;
    }
</style>
