<template>
    <v-row justify="center">
        <v-dialog max-width="600px" persistent v-model="dialog">
            <template v-slot:activator="{ on }">
                <v-btn depressed small style="background-color: #3b5998;color: white;" v-on="on" width="70">Profile
                </v-btn>
            </template>
            <v-card

            >

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

                            {{data.role}} Information

                        </v-tab>
                    </v-tabs>
                    <v-row>
                        <v-col
                            class="text-center d-flex"
                            cols="12"
                            md="5"


                        >

                            <v-img
                            >
                                <v-avatar
                                    color="grey"
                                    size="200"
                                    tile
                                    rounded
                                    style="margin-left:10%;border-radius:5%;"
                                >
                                    <v-img :src="'http://faisalsarker.com/lms/public/uploads/x/x/profile/blank-profile.png'"
                                           v-if="data.image==null"></v-img>
                                    <v-img :src="'http://faisalsarker.com/lms/public/uploads/x/x/profile/'+ data.image"
                                           v-else></v-img>
                                </v-avatar>

                            </v-img>
                        </v-col>
                        <v-col
                            class="text-center d-flex"
                            md="7"
                            cols="12"
                        >

                            <v-card-text>
                                <v-simple-table >
                                    <tbody align="left">
                                    <tr>
                                        <td class="font-weight-black">Name:</td>
                                        <td class="black--text text-capitalize">{{data.first_name}} {{data.last_name}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-black">Email:</td>
                                        <td class="black--text">{{data.email}}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-black">Phone:</td>
                                        <td class="black--text text-capitalize">{{data.phone}}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-black">NID:</td>
                                        <td class="black--text text-capitalize">{{data.nid}}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-black">Address:</td>
                                        <td class="black--text text-capitalize">{{data.address}}</td>
                                    </tr>
                                    </tbody>
                                </v-simple-table>

                            </v-card-text>
                        </v-col>
                    </v-row>
                </v-card>

                <v-card-actions>
                    <div class="flex-grow-1"></div>
                    <v-btn @click="dialog = false" class="mr-4" style="background-color:#3b5998;color:white;" text>
                        Close
                    </v-btn>
                    <a :href="'/lms/user_profile/'+data.first_name+'/'+data.id"
                       style="color:white;text-decoration: none;">
                        <v-btn style="background-color:#3b5998;color:white;text-transform: none" text>Enter Profile
                        </v-btn>
                    </a>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-row>
</template>
<script>
    export default {
        props: ['data'],
        data: () => ({
            dialog: false,

        }),
        methods: {}
    }
</script>
