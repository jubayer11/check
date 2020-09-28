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
                class="mb-5"
            >

                <v-tab

                    outlined
                    style="font-size:1em;background-color:#3b5998;color: white;"
                    tile


                >

                   Class Routine

                </v-tab>
            </v-tabs>

            <v-row>
                <v-col md="2" cols="12">


            <CreateClassRoutine :id="id" :data="AllSubject" v-if="permission=='Admin'"> </CreateClassRoutine>
                </v-col>
                <v-col class="text-md-right" md="8" cols="12">
                    <span class="font-weight-bold" style="margin:2%">
                    <v-avatar

                        class="profile"
                        color="indigo"
                        size="16"
                        tile
                    >

                            </v-avatar>
                       <template class="font-weight-bold">Class Routine </template>
                  </span>
                    <span class="font-weight-bold" style="margin:2%">
                    <v-avatar

                        class="profile"
                        color="red"
                        size="16"
                        tile
                    >

                            </v-avatar>
                       <template class="font-weight-bold">Holiday</template>
                  </span>
                    <span class="font-weight-bold" style="margin:2%">
                    <v-avatar

                        class="profile"
                        color="deep-orange"
                        size="16"
                        tile
                    >

                            </v-avatar>
                       <template class="font-weight-bold">Exam </template>
                  </span>
                    <span class="font-weight-bold" style="margin:2%">
                    <v-avatar

                        class="profile"
                        color="teal"
                        size="16"
                        tile
                    >

                            </v-avatar>
                       <template class="font-weight-bold">Class Break</template>
                  </span>
                    <span class="font-weight-bold" style="margin:2%">
                    <v-avatar

                        class="profile"
                        color="cyan"
                        size="16"
                        tile
                    >

                            </v-avatar>
                       <template class="font-weight-bold">Other</template>
                  </span>
                </v-col>
            </v-row>

            <v-row class="fill-height">
                <v-col>
                    <v-sheet height="64">
                        <v-toolbar flat color="white">
                            <v-spacer></v-spacer>
                            <v-menu bottom right>
                                <template v-slot:activator="{ on }">
                                    <v-btn
                                        outlined
                                        v-on="on"
                                    >
                                        <span>{{ typeToLabel[type] }}</span>
                                        <v-icon right>mdi-menu-down</v-icon>
                                    </v-btn>
                                </template>
                                <v-list>
                                    <v-list-item @click="type = 'day'">
                                        <v-list-item-title>Day</v-list-item-title>
                                    </v-list-item>
                                    <v-list-item @click="type = 'week'">
                                        <v-list-item-title>Week</v-list-item-title>
                                    </v-list-item>
                                </v-list>
                            </v-menu>
                        </v-toolbar>
                    </v-sheet>
                    <v-sheet height="600">
                        <v-calendar
                            ref="calendar"
                            v-model="focus"
                            :events="events"
                            :event-color="getEventColor"
                            :event-margin-bottom="10"
                            :now="today"
                            :type="type"
                            @click:event="showEvent"
                            @click:more="viewDay"
                            @click:date="viewDay"
                            @change="updateRange"
                        ></v-calendar>
                        <v-menu
                            v-model="selectedOpen"
                            :close-on-content-click="false"
                            :activator="selectedElement"
                            full-width
                            offset-x
                        >
                            <v-card
                                color="grey lighten-4"
                                min-width="350px"
                                flat
                            >
                                <v-toolbar
                                    :color="selectedEvent.color"
                                    dark
                                >

                                    <v-toolbar-title v-html="selectedEvent.name"></v-toolbar-title>
                                    <v-spacer></v-spacer>

                                    <v-btn v-if="permission=='Admin'" icon @click="deleteEvent(selectedEvent.delete_id)">
                                        <v-icon >delete_outline</v-icon>
                                    </v-btn>
                                </v-toolbar>
                                <v-card-text>
                                    <span style="color: darkred">{{selectedEvent.start_time}} - {{selectedEvent.end_time}}</span>
                                    <br>
                                    <span style="color: blue">{{selectedEvent.details}}</span>
                                </v-card-text>
                                <v-card-actions>
                                    <v-btn
                                        text
                                        color="secondary"
                                        @click="selectedOpen = false"
                                    >
                                        Cancel
                                    </v-btn>
                                </v-card-actions>
                            </v-card>
                        </v-menu>
                    </v-sheet>
                </v-col>
            </v-row>
        </v-card>
    </div>
</template>
<script>

    import CreateClassRoutine from "./CreateClassRoutine";

    export default {
        components:{CreateClassRoutine},
        data: () => ({
            today: '2019-12-1',
            focus: '2019-12-1',
            type: 'week',
            typeToLabel: {
                week: 'Week',
                day: 'Day',
            }, id:null,
            start: null,
            end: null,
            selectedEvent: {},
            selectedElement: null,
            selectedOpen: false,
            events: {},
            permission:null,
            AllSubject:null,
        }),
        beforeRouteEnter (to, from, next) {
            if (User.loggedIn()){
                next();
            }
            else
            {
                next('/')
            }
        },


        created(){
            this.id=this.$route.params.id;
            this.permission=User.role();
            axios.get(`/lms/api/class/routine/getroutine/${this.$route.params.id}`)
                .then(res=>this.events =res.data.data);
            axios.get(`/lms/api/getting/all/subject/${this.$route.params.id}`)
                .then(res=>this.AllSubject =res.data);
            this.listen();
        },

        computed: {
            title () {
                const { start, end } = this
                if (!start || !end) {
                    return ''
                }

                const startMonth = this.monthFormatter(start)
                const endMonth = this.monthFormatter(end)
                const suffixMonth = startMonth === endMonth ? '' : endMonth

                const startYear = start.year
                const endYear = end.year
                const suffixYear = startYear === endYear ? '' : endYear

                const startDay = start.day + this.nth(start.day)
                const endDay = end.day + this.nth(end.day)

                switch (this.type) {

                    case 'week':
                    case 'day':
                        return `${startMonth} ${startDay} ${startYear}`
                }
                return ''
            },
            monthFormatter () {
                return this.$refs.calendar.getFormatter({
                    timeZone: 'UTC', month: 'long',
                })
            },
        },
        mounted () {
            this.$refs.calendar.checkChange()
        },
        methods: {
            listen(){
                EventBus.$on('newEvent',(el) =>{
                    this.events.unshift(el)
                })
            },
            deleteEvent(x){
                axios.delete(`/lms/api/class/routine/delete/${x}`)
                    .then(res =>this.dialog=false,this.$toasted.show('Event Deleted',{type:'success'}),


                    )
                window.location.reload()

            },
            viewDay ({ date }) {
                this.focus = date
                this.type = 'day'
            },
            getEventColor (event) {
                return event.color
            },
            setToday () {
                this.focus = this.today
            },
            prev () {
                this.$refs.calendar.prev()
            },
            next () {
                this.$refs.calendar.next()
            },
            showEvent ({ nativeEvent, event }) {
                const open = () => {
                    this.selectedEvent = event
                    this.selectedElement = nativeEvent.target
                    setTimeout(() => this.selectedOpen = true, 10)
                }

                if (this.selectedOpen) {
                    this.selectedOpen = false
                    setTimeout(open, 10)
                } else {
                    open()
                }

                nativeEvent.stopPropagation()
            },
            updateRange ({ start, end }) {
                // You could load events from an outside source (like database) now that we have the start and end dates on the calendar
                this.start = start
                this.end = end
            },
            nth (d) {
                return d > 3 && d < 21
                    ? 'th'
                    : ['th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th'][d % 10]
            },
        },
    }
</script>
