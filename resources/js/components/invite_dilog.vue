<template>
    <div>
        <v-dialog v-model="dialog" persistent max-width="600px">
            <template v-slot:activator="{ on }">
                <v-btn v-on="on"  style="background-color: #3b5998;color:white;">Invite Faculty</v-btn>
            </template>
            <v-card>
                <v-card-title>
                    <span class="headline">Create Class</span>
                </v-card-title>
                <v-card-text>
                    <v-container>
                        <v-text-field label="Email:*"  required ></v-text-field>
                        <v-textarea
                            label="Description"
                        ></v-textarea>
                        <v-text-field label="Class Code:*"  required ></v-text-field>
                        <v-menu
                            v-model="menu2"
                            :close-on-content-click="false"
                            :nudge-right="40"
                            transition="scale-transition"
                            offset-y
                            full-width
                            min-width="240px"

                        >

                        </v-menu>


                    </v-container>

                </v-card-text>
                <v-card-actions>
                    <div class="flex-grow-1"></div>
                    <v-btn style="background-color:#3b5998;color:white" text @click="dialog = false">Close</v-btn>
                    <v-btn style="background-color:#3b5998;color:white"  text @click="dialog = false">Send</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>
    export default {
        data: () => ({
            dialog: false,
            date: new Date().toISOString().substr(0, 10),
            menu: false,
            modal: false,
            menu2: false,
            items: ['Lesson', 'Document', 'Image', 'Audio','Video','Youtube','link'],
        }),
    }
</script>
