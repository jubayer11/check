<template>
    <v-card class="grey lighten-4"
                 width="100%"
                 flat
                 style="padding: 1%;padding-bottom:115%"
    >

            <div class="d-inline-flex">
                <v-select
                    @change="checkingPoll"
                    :items="exams"
                    item-text="type"
                    item-value="type"
                    label="Select Exam Date"
                    v-model="date.selected"
                    filled
                    rounded
                ></v-select>

            </div>


        <div v-if="somex && examn!=''" >
            <div style="display: inline-flex">
            <v-select
                :items="examn"
                item-text="type"
                item-value="id"
                label="Start Exam"
                rounded
                filled
                type="text"
                v-model="examsatrtId"
            ></v-select>
            </div>
            <v-row>
            <v-col
                class="d-flex"
                cols="12"
                md="5"
            >
                <v-dialog
                    ref="dialog"
                    v-model="modal1"
                    :return-value.sync="date1"
                    persistent
                    width="290px"
                    color="red"
                >
                    <template v-slot:activator="{ on }">
                        <v-text-field
                            v-model="date1"
                            label="exam finish Date"
                            prepend-icon="event"
                            readonly
                            v-on="on"
                        ></v-text-field>
                    </template>
                    <v-date-picker color="#3b5998" v-model="date1" scrollable>
                        <div class="flex-grow-1"></div>
                        <v-btn text style="background-color: #3b5998;color: white" @click="modal1 = false">Cancel</v-btn>
                        <v-btn text style="background-color: #3b5998;color: white" @click="$refs.dialog.save(date1)">OK</v-btn>
                    </v-date-picker>
                </v-dialog>
            </v-col>

            <v-col
                class="d-flex"
                cols="12"
                md="5"
            >
                <v-menu
                    ref="menu"
                    v-model="menu2"
                    :close-on-content-click="false"
                    :nudge-right="40"
                    :return-value.sync="time"
                    transition="scale-transition"
                    offset-y
                    max-width="290px"
                    min-width="290px"
                >
                    <template v-slot:activator="{ on }">
                        <v-text-field
                            v-model="time"
                            label="Exam Finish Time"
                            prepend-icon="access_time"
                            readonly
                            v-on="on"
                        ></v-text-field>
                    </template>
                    <v-time-picker
                        color="#3b5998"
                        v-if="menu2"
                        v-model="time"
                        full-width
                        @click:minute="$refs.menu.save(time)"
                    ></v-time-picker>
                </v-menu>



            </v-col>
            <v-col
                class="d-flex"
                cols="12"
                md="2"
            >
                <v-btn depressed rounded  @click="createStartExam" style="float: right;color:white;background-color: #3b5998">
                    Start Exam

                </v-btn>

            </v-col>
        </v-row>
        </div>


            <div v-for="(examx,index) in examR" v-if="examx.status_s==1 && examx.exam_done==0">
                {{startingtime(examx.end_date_s,examx.end_time_s,examx.id)}}
            <v-row>
                <v-col
                    class="d-flex"
                    md="4"
                    cols="12"
                >
            <v-text-field
                filled
                label="exam on going"
                rounded
                type="text"
                readonly
                v-model="examx.type"
            ></v-text-field>
                </v-col>
                <v-col
                    class="d-flex"
                    cols="12"
                    md="2"
                >
                    <v-btn
                        rounded
                        depressed
                        @click="stopingRunningExam(examx.id)"
                        style="color: white;background-color: #3b5998"
                    >
                        Stop Exam
                    </v-btn>

                </v-col>
                <v-col cols="12" md="3" class="d-flex">
                </v-col>
                <v-col  cols="12" md="3" class="d-flex">
                    <div  class="text-right">
                        <div class="font-weight-bold text-right" style="color: #3b5998;" v-if="distance > 0"><h2>{{`${days}d ${hours}h ${minutes}m ${seconds}s`}}</h2></div>
                        <div class="font-weight-bold text-right" v-else style="color: darkred"><h2>OVER</h2></div>
                    </div>
                </v-col>
            </v-row>
            </div>



        <v-row align="center" >

                <v-col class="d-flex" cols="12" sm="3">
                    <dilog> </dilog>
                </v-col>
            <v-col class="d-flex"
                       sm="3">
                    <v-btn
                        depressed
                        :readonly="readonly"
                        @click="CreateExam"
                        style="color: white;background-color: #3b5998"
                        rounded
                    >Create Exam
                    </v-btn>

                </v-col>
            <v-col class="d-flex" cols="12" sm="3" v-if="show">
                <v-select
                    :items="items"
                    item-text="name"
                    item-value="id"
                    label="Select Exam type"
                    v-model="selectedExam"

                ></v-select>


            </v-col>
            <v-col class="d-flex" cols="12" sm="3"
                   v-if="show">
                <v-btn
                    depressed
                    rounded
                    :readonly="readonlyQuestion"
                    @click="createQuestions"
                    style="color: white;background-color: #3b5998"
                >Create Question

                </v-btn>
            </v-col>


        </v-row>
        <br>
        <br>
        <div v-if="show">
            <div v-for="(creative,index) in creatives">


                <v-toolbar class="grey lighten-4" flat>
                    <h4 style="color:#3b5998;margin-left: 1%;margin-right: 5%"> Creative Question No:{{index+1}}</h4>
                    <v-btn
                        @click="creativeRemove(index)"
                        class="error"
                        depressed
                        rounded
                        style="float: right;"

                    >Remove
                    </v-btn>
                </v-toolbar>


                <v-textarea
                    style="font-size:1.2em"
                    filled
                    label="Story"
                    rounded
                    v-model="creative.story"
                ></v-textarea>
                <v-row >
                    <v-col
                        class="d-flex"
                        cols="12"
                        md="3"
                    >
                               <div style="margin-left: 5%">
                                   <v-textarea
                                       class="ma-0"
                                       style="font-size:1.2em"
                                       label="Question no 1"
                                       outlined
                                       rounded

                                       v-model="creative.q1"
                                   ></v-textarea>

                                   <v-text-field

                                       filled
                                       label="Marks"
                                       rounded
                                       type="number"
                                       v-model="creative.q1m"
                                   ></v-text-field>
                               </div>
                    </v-col>
                    <v-col
                        class="d-flex"
                        cols="12"
                        md="3"
                    >
                        <div style="margin-left: 5%">

                            <v-textarea
                                style="font-size:1.2em"
                                label="Question no 2"
                                outlined
                                rounded
                                v-model="creative.q2"
                            ></v-textarea>
                            <v-text-field
                                filled
                                label="Marks"
                                rounded
                                type="number"
                                v-model="creative.q2m"
                            ></v-text-field>
                        </div>
                    </v-col>
                    <v-col
                        class="d-flex"
                        cols="12"
                        md="3"

                    >
                        <div style="margin-left: 7%">

                            <v-textarea
                                style="font-size:1.2em"
                                label="Question no 3"
                                outlined
                                rounded
                                v-model="creative.q3"
                            ></v-textarea>
                            <v-text-field
                                filled
                                label="Marks"
                                rounded
                                type="number"
                                v-model="creative.q3m"
                            ></v-text-field>
                        </div>
                    </v-col>
                    <v-col
                        class="d-flex"
                        cols="12"
                        md="3"
                    >
                        <div style="margin-left: 5%">

                            <v-textarea
                                style="font-size:1.2em"
                                label="Question no 4"
                                outlined
                                rounded
                                v-model="creative.q4"
                            ></v-textarea>
                            <v-text-field
                                filled
                                label="Marks"
                                rounded
                                type="number"
                                v-model="creative.q4m"
                            ></v-text-field>
                        </div>
                    </v-col>
                </v-row>
            </div>
            <div v-for="(multiple,index) in multiples">

                <v-toolbar class="grey lighten-4" flat>
                    <h4 style="color:#3b5998;margin-left: 1%;margin-right: 5%">  Multiple Question No:{{index+1}}</h4>
                    <v-btn
                        @click="multipleRemove(index)"
                        class="error"
                        depressed
                        rounded
                        style="float:
                    right;"
                    >Remove
                    </v-btn>
                </v-toolbar>
                <v-textarea
                    style="font-size:1.2em"
                    filled
                    label="Question"
                    rounded
                    v-model="multiple.qm"
                ></v-textarea>
                <v-row>
                    <v-col
                        class="d-flex"
                        cols="12"
                        md="3"
                    >
                        <v-textarea
                            style="font-size:1.2em"
                            label="Option 1"
                            outlined
                            rounded
                            v-model="multiple.op1"
                        ></v-textarea>
                    </v-col>
                    <v-col
                        class="d-flex"
                        cols="12"
                        md="3"
                    >
                        <v-textarea
                            style="font-size:1.2em"
                            label="Option 2"
                            outlined
                            rounded
                            v-model="multiple.op2"
                        ></v-textarea>
                    </v-col>
                    <v-col
                        class="d-flex"
                        cols="12"
                        md="3"
                    >
                        <v-textarea
                            style="font-size:1.2em"
                            label="Option 1"
                            outlined
                            rounded
                            v-model="multiple.op3"
                        ></v-textarea>
                    </v-col>
                    <v-col
                        class="d-flex"
                        cols="12"
                        md="3"
                    >
                        <v-textarea
                            style="font-size:1.2em"
                            label="Option 2"
                            outlined
                            rounded
                            v-model="multiple.op4"
                        ></v-textarea>
                    </v-col>
                    <v-text-field
                        filled
                        label="Marks"
                        rounded
                        type="number"
                        v-model="multiple.qmm"
                    ></v-text-field>
                </v-row>
            </div>
            <div v-for="(short,index) in shorts">
                <v-toolbar class="grey lighten-4" flat>
                    <h4 style="color:#3b5998;margin-left: 1%;margin-right: 5%">Short Question No:{{index+1}}</h4>
                    <v-btn
                        @click="shortRemove(index)"
                        class="error"
                        depressed
                        rounded
                        style="float: right;"
                    >
                        Remove
                    </v-btn>
                </v-toolbar>

                <v-textarea
                    style="font-size:1.2em"
                    filled
                    label="Question"
                    rounded
                    v-model="short.qs"
                ></v-textarea>
                <v-text-field
                    filled
                    label="Marks"
                    rounded
                    type="number"
                    v-model="short.qsm"
                ></v-text-field>
            </div>
            <div v-for="(pool,index) in pools">
                <v-toolbar class="grey lighten-4" flat>
                    <h4 style="color:#3b5998;margin-left: 1%;margin-right: 5%">Pool Question No:{{index+1}}</h4>

                    <v-btn
                        @click="poolRemove(index)"
                        rounded
                        class="error"
                        depressed
                        style="float: right;"
                    >Remove
                    </v-btn>
                </v-toolbar>
                <v-textarea
                    style="font-size:1.2em"
                    filled
                    label="Question"
                    rounded
                    v-model="pool.qp"
                ></v-textarea>
                <v-row>
                    <v-col
                        class="d-flex"
                        cols="12"
                        md="3"
                    >
                        <v-textarea
                            style="font-size:1.2em"
                            label="Option 1"
                            outlined
                            rounded
                            v-model="pool.op1"
                        ></v-textarea>
                    </v-col>
                    <v-col
                        class="d-flex"
                        cols="12"
                        md="3"
                    >
                        <v-textarea
                            style="font-size:1.2em"
                            label="Option 2"
                            outlined
                            rounded
                            v-model="pool.op2"
                        ></v-textarea>
                    </v-col>
                    <v-col
                        class="d-flex"
                        cols="12"
                        md="3"
                    >
                        <v-textarea
                            style="font-size:1.2em"
                            label="Option 3"
                            outlined
                            rounded
                            v-model="pool.op3"
                        ></v-textarea>
                    </v-col>
                    <v-col
                        class="d-flex"
                        cols="12"
                        md="3"
                    >
                        <v-textarea
                            style="font-size:1.2em"
                            label="Option 4"
                            outlined
                            rounded
                            v-model="pool.op4"
                        ></v-textarea>
                    </v-col>
                </v-row>

            </div>
        </div>
        <div style="display: inline-block">
            <v-btn
                @click="postQuestion"
                class="primary"
                rounded
                depressed
                v-if="x && show"
            >
                Submit
            </v-btn>
            <v-btn
                depressed
                @click="show=false"
                class="error"
                rounded
                v-if="x && show"
            >
                cancel
            </v-btn>
        </div>


        <div v-for="(questions_s,index) in dailyexam" v-if="show==false">
            <h1>{{checkingexamid(questions_s.id)}}</h1>
            <div v-for="(question_s_s,index) in questions_s.question_s">

        <div v-if="question_s_s.type=='Creative'" v-for="(creative_s,index) in question_s_s.creative_s_s">
            <div>
                <div style="display: inline-flex;margin:5%">
                    <h4 style="color:#3b5998"> Creative Question No:{{index+1}}</h4>

                </div>
                <v-textarea
                    style="font-size:1.2em"
                    filled
                    label="Story"
                    rounded
                    readonly
                    v-model="creative_s.story"
                ></v-textarea>
                <v-row>
                    <v-col
                        class="d-flex"
                        md="3"
                        cols="12"
                    >
                        <div style="margin-left: 5%">

                            <v-textarea
                                style="font-size:1.2em"
                                label="Question no 1"
                                outlined
                                rounded
                               readonly
                                v-model="creative_s.question_1"
                            ></v-textarea>
                            <v-text-field
                                filled
                                label="Marks"
                                rounded
                                type="number"
                                readonly
                                v-model="creative_s.q1_marks"
                            ></v-text-field>
                        </div>
                    </v-col>
                    <v-col
                        class="d-flex"
                        md="3"
                        cols="12"
                    >
                        <div style="margin-left: 5%">

                            <v-textarea
                                style="font-size:1.2em"
                                label="Question no 2"
                                outlined
                                rounded
                                readonly
                                v-model="creative_s.question_2"
                            ></v-textarea>
                            <v-text-field
                                filled
                                label="Marks"
                                rounded
                                type="number"
                                readonly
                                v-model="creative_s.q2_marks"
                            ></v-text-field>
                        </div>
                    </v-col>
                    <v-col
                        class="d-flex"
                        md="3"
                        cols="12"
                    >
                        <div style="margin-left: 5%">

                            <v-textarea
                                style="font-size:1.2em"
                                label="Question no 3"
                                outlined
                                rounded
                                readonly
                                v-model="creative_s.question_3"
                            ></v-textarea>
                            <v-text-field
                                filled
                                label="Marks"
                                rounded
                                type="number"
                                readonly
                                v-model="creative_s.q3_marks"
                            ></v-text-field>
                        </div>
                    </v-col>
                    <v-col
                        class="d-flex"
                        md="3"
                        cols="12"
                    >
                        <div style="margin-left: 5%">

                            <v-textarea
                                style="font-size:1.2em"
                                label="Question no 4"
                                outlined
                                rounded
                                readonly
                                v-model="creative_s.question_4"
                            ></v-textarea>
                            <v-text-field
                                filled
                                label="Marks"
                                rounded
                                type="number"
                                readonly
                                v-model="creative_s.q4_marks"
                            ></v-text-field>
                        </div>
                    </v-col>
                </v-row>
            </div>
        </div>


                <div v-for="(multiple_s,index) in question_s_s.multiple_s_s" v-if="question_s_s.type=='Multiple'">
                    <div style="display: inline-flex;margin:5%">
                        <h4 style="color:#3b5998"> Multiple Question No:{{index+1}}</h4>

                    </div>
                    <v-textarea
                        style="font-size:1.2em"
                        readonly
                        filled
                        label="Question"
                        rounded
                        v-model="multiple_s.question_s"
                    ></v-textarea>
                    <v-row class="d-flex">
                        <v-col
                            class="d-flex"
                            md="3"
                            cols="12"
                        >
                            <v-textarea
                                style="font-size:1.2em"
                                readonly
                                label="Option 1"
                                outlined
                                rounded
                                v-model="multiple_s.option_1"
                            ></v-textarea>
                        </v-col>
                        <v-col
                            class="d-flex"
                            md="3"
                            cols="12"
                        >
                            <v-textarea
                                style="font-size:1.2em"
                                readonly
                                label="Option 2"
                                outlined
                                rounded
                                v-model="multiple_s.option_2"
                            ></v-textarea>
                        </v-col>
                        <v-col
                            class="d-flex"
                            md="3"
                            cols="12"
                        >
                            <v-textarea
                                style="font-size:1.2em"
                                readonly
                                label="Option 3"
                                outlined
                                rounded
                                v-model="multiple_s.option_3"
                            ></v-textarea>
                        </v-col>
                        <v-col
                            class="d-flex"
                            md="3"
                            cols="12"
                        >
                            <v-textarea
                                style="font-size:1.2em"
                                readonly
                                label="Option 4"
                                outlined
                                rounded
                                v-model="multiple_s.option_4"
                            ></v-textarea>
                        </v-col>
                        <v-text-field
                            readonly
                            filled
                            label="Marks"
                            rounded
                            type="number"
                            v-model="multiple_s.marks"
                        ></v-text-field>
                    </v-row>
                </div>
                <div v-for="(short_s,index) in question_s_s.short_s_s" v-if="question_s_s.type=='Short'">
                    <div style="display: inline-flex;margin-bottom: 3%;margin-left: 2%">
                        <h4 style="color:#3b5998"> Short Question No:{{index+1}}</h4>

                    </div>
                    <v-textarea
                        style="font-size:1.2em"
                        readonly
                        outlined
                        label="Question"
                        rounded
                        v-model="short_s.question_s"
                    ></v-textarea>
                    <v-text-field
                        readonly
                        filled
                        label="Marks"
                        rounded
                        type="number"
                        v-model="short_s.marks"
                    ></v-text-field>
                </div>
                <div v-for="(poll_s,index) in question_s_s.poll_s_s" v-if="question_s_s.type=='Pool'">


                    <div style="display: inline-flex;margin:5%">
                        <h4 style="color:#3b5998"> Pool Question No:{{index+1}}</h4>

                    </div>
                    <v-textarea
                        style="font-size:1.2em"
                        readonly
                        filled
                        label="Question"
                        rounded
                        v-model="poll_s.question_s"
                    ></v-textarea>
                    <v-row class="d-flex">
                        <v-col

                            md="3"
                            cols="12"
                        >
                            <v-textarea
                                style="font-size:1.2em"
                                readonly
                                label="Option 1"
                                outlined
                                rounded
                                v-model="poll_s.option_1"
                            ></v-textarea>
                            <div v-for="(Apolls,index) in poll_s.Apoll" v-if="poll_s.option_1==Apolls.answer">
                            <h3  v-if="poll_s.Apoll.length && index+1==poll_s.Apoll.length" class="text-center" style="color: #3b5998" >Chosen By: {{poll_s.Apoll.length}} students</h3>
                            <h3 v-else class="text-center"  style="color: #3b5998">Chosen By: Not Chosen Yet</h3>
                            </div>
                        </v-col>
                        <v-col
                            md="3"
                            cols="12"
                        >
                            <v-textarea
                                style="font-size:1.2em"
                                readonly
                                label="Option 2"
                                outlined
                                rounded
                                v-model="poll_s.option_2"
                            ></v-textarea>

                            <div v-for="(Apolls,index) in poll_s.Apoll" v-if="poll_s.option_2==Apolls.answer">
                            <h3  v-if="index+1==poll_s.Apoll.length" class="text-center" style="color: #3b5998" >Chosen By: {{poll_s.Apoll.length}} students</h3>
                            <h3 v-if="poll_s.Apoll.length==0" class="text-center"  style="color: #3b5998">Chosen By: Not Chosen Yet</h3>
                            </div>
                        </v-col>
                        <v-col

                            md="3"
                            cols="12"
                        >
                            <v-textarea
                                style="font-size:1.2em"
                                readonly
                                label="Option 3"
                                outlined
                                rounded
                                v-model="poll_s.option_3"
                            ></v-textarea>
                            <div v-for="(Apolls,index) in poll_s.Apoll" v-if="poll_s.option_3==Apolls.answer">
                            <h3  v-if="index+1==poll_s.Apoll.length" class="text-center" style="color: #3b5998" >Chosen By: {{poll_s.Apoll.length}} students</h3>
                            <h3 v-if="poll_s.Apoll.length==0" class="text-center"  style="color: #3b5998">Chosen By: Not Chosen Yet</h3>
                            </div>
                        </v-col>

                        <v-col

                            md="3"
                            cols="12"
                        >
                            <v-textarea
                                style="font-size:1.2em"
                                readonly
                                label="Option 4"
                                outlined
                                rounded
                                v-model="poll_s.option_4"
                            ></v-textarea>
                            <div v-for="(Apolls,index) in poll_s.Apoll" v-if="poll_s.option_4==Apolls.answer">
                            <h3  v-if="index+1==poll_s.Apoll.length" class="text-center" style="color: #3b5998" >Chosen By: {{poll_s.Apoll.length}} students</h3>
                            <h3 v-if="poll_s.Apoll.length==0" class="text-center"  style="color: #3b5998">Chosen By: Not Chosen Yet</h3>
                            </div>
                        </v-col>
                    </v-row>





                </div>
            </div>

        </div>



        {{CreateQuestion}}
        {{userId}}
        {{checkingCreative}}
        {{checkingMultiple}}
        {{checkingPool}}
        {{checkingShort}}
        {{puttingExam}}
        {{filteredExams}}
        {{filteredExamRunning}}
        {{filteredExamstartRunning}}
        {{exactTime}}
        {{timeout}}

    </v-card>
</template>
<script>
    import dilog from "./CreateExamDateDilog";

    export default {

        props:['data','exam'],
        components: {dilog},

        data: () => ({

                time: null,
                menu2: false,
                modal2: false,
                date1: new Date().toISOString().substr(0, 10),
                modal1: false,
            dailyexam:{},
            date:{
              selected:null,
            },
            examShow:false,
            items: [
                {
                    name: 'Creative Question',
                    id: 1,

                },
                {
                    name: 'Multiple Question',
                    id: 2,

                },
                {
                    name: 'Short Question',
                    id: 4,
                },
                {

                    name: 'Poll Question',
                    id: 3,

                }],
            selectedExam: null,

            show: false,
            creative: false,
            multiple: false,
            pool: false,
            short:false,
            creatives:[],
            multiples:[],
            shorts:[],
            pools:[],
            form:{
                date: null,
                user_id:null,
                qcc:0,
                qcm:0,
                qcp:0,
                qcs:0,
            },

            qcc:0,
            qcm:0,
            qcp:0,
            qcs:0,
            modal: false,
            exams:{},

            x:false,

            examId:null,
            examR:null,
            end_date:null,
            end_time:null,
            exact_time:null,
            countDownDate:null,
            days: 0,
            hours: 0,
            minutes: 0,
            seconds: 0,
            distance: 0,
            examIDs:null,
            examsatrtId:null,
            examn:null,
            somex:true,
            count1:null,
            count2:null,
            count3:null,
            count4:null,
            checkTimeout:0,
        }),
        created(){
          this.listen();
        },
        mounted(){

            var vm = this
            var x = setInterval(function() {
                var now = new Date().getTime();
                vm.distance = vm.countDownDate - now;
                vm.days = Math.floor(vm.distance / (1000 * 60 * 60 * 24));
                vm.hours = Math.floor((vm.distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                vm.minutes = Math.floor((vm.distance % (1000 * 60 * 60)) / (1000 * 60));
                vm.seconds = Math.floor((vm.distance % (1000 * 60)) / 1000);
                // if (vm.distance < 0) {
                //     if(vm.distance < - 1000 * 60 * 60* 24){ // if its past the "game day"
                //         // reset timer to next year
                //         vm.countDownDate += (1000 * 60 * 60 * 24 * 1) * 365
                //
                //     }
                // }


            }, 1000);
        },



        methods: {
            checkingPoll(){
                this.count1=null;
                this.count2=null;
                this.count3=null;
                this.count4=null;
            },
            checkingCount4(x,y){
                this.count4=y+1;
            },
            checkingCount1(x,y){
                this.count1=y+1;
            },
            checkingCount3(x,y){
                this.count3=y+1;
            },
            checkingCount2(x,y){
                this.count2=y+1;
            },
            stopingRunningExam(id){
                axios.patch(`/lms/api/class/exam/stop/${id}`,{



                })
                    .then(res =>this.dialog=false,this.$toasted.show('Exam Stoped',{type:'success'}),
                        window.location.reload(true)
                    )
            },

            listen(){
                EventBus.$on('exam_date',(x) =>{
                    this.form.date=x;
                })
            },
            startingtime(end_date_s,end_time_s,Id){
                this.end_date=end_date_s;
                this.end_time=end_time_s;
                this.examIDs=Id;
                this.somex=false;
            },
            checkingexamid(id){
                this.examId=id;
            },
            createStartExam(){
                axios.patch(`/lms/api/class/exam/${this.examsatrtId}`,{
                    end_date:this.date1,
                    end_time:this.time,
                    status:1,
                    subject_id:this.data,
                    userId:User.id(),


                })
                    .then(res =>this.dialog=false,this.$toasted.show('Exam Started',{type:'success'}),
                      window.location.reload(true)
                    )
            },

            postQuestion(){
                axios.post(`/lms/api/class/exam/question/${this.data}`,{
                    form:this.form,
                    creatives:this.creatives,
                    multiples:this.multiples,
                    pools:this.pools,
                    shorts: this.shorts,

                })
                    .then(res =>this.dialog=false,this.$toasted.show('Exam Created',{type:'success'}),
                        window.location.reload(true)
                    )
            },
            CreateExam() {
                this.show = true;
            },
            createQuestions() {
                this.x=true;
                if (this.selectedExam == 1) {
                    this.createCreative();
                }
                if (this.selectedExam == 2) {
                    this.createMultiple();
                }
                if (this.selectedExam == 3) {
                    this.createPool();
                }
                if (this.selectedExam == 4) {
                    this.createShort();
                }

            },
            createCreative() {
                this.creatives.push({
                    story:'',
                    q1:'',
                    q1m:0,
                    q2:'',
                    q2m:0,
                    q3:'',
                    q3m:0,
                    q4:'',
                    q4m:0,

                });
                this.qcc++;

            },
            createMultiple() {
                this.multiples.push({
                    qm:'',
                    op1:'',
                    op2:'',
                    op3:'',
                    op4:'',
                    qmm:0,

                });
                this.qcm++;

            },
            createPool() {
                this.pools.push({
                    qp:'',
                    op1:'',
                    op2:'',
                    op3:'',
                    op4:'',
                });
                this.qcp++;

            },
            createShort() {
                this.shorts.push({
                    qs:'',
                    qsm:0,
                });
                this.qcs++;

            },
            creativeRemove(index){
                Vue.delete(this.creatives, index);
                this.qcc --;

            },
            multipleRemove(index){
                Vue.delete(this.multiples, index);
                this.qcm--;
            },
            poolRemove(index){
                Vue.delete(this.pools, index);
                this.qcp--;
            },
            shortRemove(index){
                Vue.delete(this.shorts, index);
                this.qcs--;

            },



        },
        watch:{

        },
        computed: {

            timeout(){
                if(this.distance<0 && this.checkTimeout== 0){
                    this.checkTimeout=1;
                    axios.patch(`/lms/api/class/end_exam/${this.examIDs}`,{
                        exam_done:1,


                    })
                        .then(res =>this.dialog=false,this.$toasted.show('Exam Started',{type:'success'}),
                           window.location.reload(true)
                        )

                }
            },

            exactTime(){
              this.exact_time=this.end_date+" "+this.end_time;
              this.countDownDate=new Date(this.exact_time).getTime();
            },

            filteredExamRunning: function(){
                this.examR=this.exams.filter((el) => {
                    return (el.exam_done==0);

                });

            },
            filteredExamstartRunning: function(){
                this.examn=this.examR.filter((el) => {
                    return (el.exam_done==0 && el.status_s==0);

                });

            },
            filteredExams: function(){
                 this.dailyexam=this.exams.filter((exam) => {
                     return exam.type.match(this.date.selected);

                });

            },

            Examreadonly(){
                if (this.date.selected!=null){
                    return false;
                }
                else{
                    return true;
                }
            },
            puttingExam(){
              this.exams=this.exam;
            },
            checkingCreative(){
                if (this.qcc >0){
                    this.form.qcc=1;
                }
                else
                    this.form.qcc=0;

            },
            checkingMultiple(){
                if (this.qcm >0){
                    this.form.qcm=1;
                }
                else
                    this.form.qcm=0;

            },

            checkingPool(){
                if (this.qcp >0){
                    this.form.qcp=1;
                }
                else
                    this.form.qcp=0;

            },
            checkingShort(){
                if (this.qcs >0){
                    this.form.qcs=1;
                }
                else
                    this.form.qcs=0;

            },
            userId(){
                this.form.user_id=User.id();
            },
            readonly() {
                if (this.form.exam != '') {
                    return false;
                } else {
                    return true;
                }
            },
            readonlyQuestion() {
                if (this.multiple == true || this.creative == true || this.pool == true || this.short ==true) {
                    return false;
                } else
                    return true;

            },
            CreateQuestion() {
                if (this.selectedExam == 1) {
                    this.creative = true;
                    this.multiple = false;
                    this.pool = false;
                    this.short =false;

                } else if (this.selectedExam == 2) {
                    this.multiple = true;
                    this.creative = false;
                    this.pool = false;
                    this.short =false;

                } else if (this.selectedExam == 3) {
                    this.pool = true;
                    this.creative = false;
                    this.multiple = false;
                    this.short =false;

                }
            else if (this.selectedExam == 4) {
                    this.short =true;
                    this.pool = false;
                    this.creative = false;
                    this.multiple = false;

                }
                },

            },
        }

</script>
<style>


    .v-input input {
        font-size: 1.2em;
    }
    .v-input .v-label {
        font-size: 1em;

    }

</style>
