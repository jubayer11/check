<template>
    <v-row justify="center">
        <v-dialog max-width="600px" persistent v-model="dialog">
            <template v-slot:activator="{ on }">
                <v-btn small depressed style="background-color: #3b5998;color: white;" v-on="on">Profile</v-btn>
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

                            User information

                        </v-tab>
                    </v-tabs>


                        <div>

                            <v-card-text>
                                <v-simple-table >
                                    <tbody  align="left">
                                    <tr>
                                        <td class="font-weight-black">Name:</td>
                                        <td class="black--text text-capitalize">{{data.first_name}}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-black">Role:</td>
                                        <td class="black--text text-capitalize">{{data.role}}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-black">Email:</td>
                                        <td class="black--text">{{data.email}}</td>
                                    </tr>
                                    </tbody>
                                </v-simple-table>

                            </v-card-text>
                        </div>

                </v-card>

                <v-card-actions>
                    <div class="flex-grow-1"></div>
                    <v-btn  style="background-color:#3b5998;color:white" text @click="dialog = false">Close</v-btn>
                    <v-btn style="background-color:#3b5998;color:white;text-transform: none"  text @click="dialog = false">Enter Profile</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-row>
</template>
<script>
    export default {
        props:['data'],
        data: () => ({
            dialog: false,

        }),
    }
</script>
