<template>

    <div class="grey lighten-4" style="padding-bottom:15%;">
        <!-- Stack the columns on mobile by making one full-width and the other half-width -->


        <v-card

            max-width="100%"
            tile
            width="100%"
            flat

        >
            <v-tabs
                center-active color="grey lighten-2"
                flat
                grow
            >

                <v-tab

                    outlined
                    style="font-size:1em;background-color:#3b5998;color: white;"
                    tile


                >

                    profile information

                </v-tab>
            </v-tabs>
            <v-row class="d-flex" style="margin-bottom: 5%">
                <v-col
                    class="pt-10 text-center d-flex"
                    md="3"
                >

                    <v-img
                    >
                        <v-row
                            height="10"
                        >
                            <v-col
                                align-self="start"
                                class="pa-0"
                                cols="12"
                            >
                                <v-avatar
                                    color="grey"
                                    size="200"
                                    tile
                                    rounded
                                    style="border-radius:5%;"
                                >
                                    <v-img
                                        :src="'http://faisalsarker.com/lms/public/uploads/x/x/profile/'+ form.image"></v-img>
                                </v-avatar>
                            </v-col>
                            <v-col
                                cols="12"
                                class="py-0"
                            >
                                <v-list-item
                                    style="color: #0d47a1"
                                >
                                    <v-list-item-content class="title">
                                        <dilog :data="form"></dilog>
                                    </v-list-item-content>
                                </v-list-item>
                            </v-col>
                        </v-row>
                    </v-img>


                </v-col>
                <v-col
                    class="d-flex"
                    md="8"
                >

                    <v-card-text>
                        <v-simple-table >
                            <tbody>
                            <tr>
                                <td class="font-weight-black">Name:</td>
                                <td class="black--text text-capitalize">{{form.first_name}} {{form.last_name}}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-black">Role:</td>
                                <td class="black--text text-capitalize">{{form.role}}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-black">Phone:</td>
                                <td class="black--text text-capitalize">{{form.phone}}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-black">Email:</td>
                                <td class="black--text">{{form.email}}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-black">NID:</td>
                                <td class="black--text text-capitalize">{{form.nid}}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-black ">Father’s Name:</td>
                                <td class="black--text text-capitalize">{{form.father_name}}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-black">Mother’s Name:</td>
                                <td class="black--text text-capitalize">{{form.mother_name}}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-black">Parent’s Contact:</td>
                                <td class="black--text text-capitalize">{{form.parents_contact}}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-black">Address:</td>
                                <td class="black--text  text-capitalize">{{form.address}}</td>
                            </tr>



                            </tbody>
                        </v-simple-table>

                    </v-card-text>
                </v-col>
            </v-row>
        </v-card>


        <v-row class="d-flex">
            <v-col
                cols="12"
                md="3"
                v-for="classe_s in classes"
                :key="classe_s.id"
            >
                <v-card
                    class="mx-auto"
                    max-width="344"
                    outlined
                >
                    <v-list-item three-line>
                        <v-list-item-content>
                            <div class="overline mb-4">{{classe_s.class_name}}</div>
                            <v-list-item-title class="headline mb-1">
                                {{classe_s.name}}
                            </v-list-item-title>
                            <v-list-item-subtitle>Section: {{classe_s.section}}</v-list-item-subtitle>
                        </v-list-item-content>
                    </v-list-item>
                    <v-card-actions>
                        <v-btn :href="'/lms/class/'+classe_s.name" style="color: white;background-color:#3b5998">
                            go to the class

                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-col>
        </v-row>

    </div>
</template>
<script>
    import dilog from "./updateprofile_dilog";
    import Class from "./Class.vue";
    import User from "../Helpers/User";

    export default {
        components: {dilog, Class},
        data() {
            return {
                form:{},
                user_id:0,
                classes:{},
                userclass:{},

            }
        },
        beforeRouteEnter (to, from, next) {
            if (User.loggedIn()){
                next();
            }
            else
            {
                next('/')
            }
        },
        created() {
            this.userclass=User.name();
            this.user_id = User.id();
            axios.get(`/lms/api/information/${this.user_id}`)
                .then(res=>this.form =res.data.data)
            axios.get(`/lms/api/auth_class/${this.user_id}`)
                .then(res=>this.classes =res.data.data)
        },

    }
</script>
<style>
    td {
        padding: 0;
    }

    thead {
        text-decoration: none;
        font-size: 10000px;
    }
</style>
