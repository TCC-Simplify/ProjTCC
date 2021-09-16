<template>
    <!--<app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Chat
            </h2>
        </template>-->

        <div>
            <div >
                <div class="bg-white overflow-hidden shadow-xl flex" style="min-height:100vh; max-height:100vh;">
                    <!--Listagem de users-->
                    <div class="w-3/12 bg-gray-200 bg-opacity-25 border-r border-gray-200 overflow-y-auto" 
                    style="
                        background-color: rgb(95, 185, 151);
                        color: white;
                    ">
                        <ul>
                            <li>
                                <a href="/atividades"><p style="width: 50%; font-size:50px; margin-top: 5%; margin-left: 5%; color: black;">&#8592;</p></a>
                            </li>
                            <li>
                                <a href="{{ url('/') }}"><img v-bind:src="'/imgs/logo_simplify.png'" alt="Logo Simplify" style="width: 50%; margin: auto; margin-bottom: 2%;"></a>
                            </li>
                            <li>
                               <p style="width: 50%; font-size:25px ; margin-top: 10%; font-weight: bold; margin-bottom: 2%; margin-left: 5%; color: black;">Individuais</p>
                            </li>
                            <li 
                                v-for = "user in users" :key="user.id"
                                @click="() => {loadMessages(user.id)}"
                                :class="(userActive && userActive.id == user.id) ? 'bg-gray-200 bg-opacity-50' : ''"
                                class="p-6 text-lg leading-7 font-semibold border-b border-gray-200 hover:bg-opacity-50 hover:cursor-pointer hover:bg-gray-200">
                                
                                <p class="flex item-center">
                                    {{ user.name }}
                                    <span v-if="user.notification" class="ml-2 mt-2.5 w-2 h-2 bg-white rounded-full"></span>
                                </p>
                            </li>
                            <li>
                               <p style="width: 50%; font-size:25px ; margin-top: 10%; font-weight: bold; margin-bottom: 2%; margin-left: 5%; color: black;">Equipes</p>
                            </li>

                            <li 
                                v-for = "equipe in equipes" :key="equipe.id"
                                @click="() => {loadMessages(equipe.id)}"
                                :class="(equipeActive && equipeActive.id == equipe.id) ? 'bg-gray-200 bg-opacity-50' : ''"
                                class="p-6 text-lg leading-7 font-semibold border-b border-gray-200 hover:bg-opacity-50 hover:cursor-pointer hover:bg-gray-200">
                                
                                <p class="flex item-center">
                                    {{ equipe.equipe }}
                                    <span v-if="equipe.notification" class="ml-2 mt-2.5 w-2 h-2 bg-white rounded-full"></span>
                                </p>
                            </li>
                        </ul>
                    </div>

                    <!--Caixa de mensagens-->
                    <div class="w-9/12 flex flex-col justify-between"
                    style="
                        background-color: rgb(37, 37, 44);
                        color: white;
                    ">

                        <!--Mensagens-->
                        <div class="w-full p-6 flex flex-col overflow-y-auto">
                            <div 
                                v-for="message in messages" :key="message.id"
                                :class="(message.from == auth.user.id) ? 'text-right' : ' ' "
                                class="w-full mb-3 message">
                                
                                <p 
                                    :class="(message.from == auth.user.id) ? 'bg-green-400' : 'bg-gray-500' "
                                    class="inline-block p-2 rounded-md bg-opacity-25 messageFromMe" style="max-width: 75%;">
                                    {{ message.content }}
                                </p>
                                <span class="block mt-1 text-xs text-gray-500"> {{ formatDate(message.created_at) }}</span>
                            </div>
                        </div>

                        <!--form-->
                        <div v-if="userActive" class=" teste w-full bg-gray-200 bg-opacity-25 p-6 border-t border-gray-200"
                        style="
                            color: black;
                        ">
                            <form v-on:submit.prevent="sendMessage">
                                <div class="flex rounded-md overflow-hidden border border-gray-300">
                                    <input v-model="message" type="text" class="flex-1 px-4 py-2 text-sm focus:outline-none">
                                    <button type="submit" class="bg-green-400 hover:bg-green-600 text-white px-4 py-2">Enviar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!--</app-layout>-->
</template>

<script>
    import Vue from 'vue'
    /*import AppLayout from '@/Layouts/AppLayout'*/
    import moment from "moment";

    export default {
        components: {
            //AppLayout,
            moment,
        },
        data(){
            return {
                users: [],
                equipes: [],
                messages: [],
                userActive: null,
                equipeActive: null,
                message: " ",
            }
        },
        methods: {
            scrollToBottom: function(){
                if(this.messages.length){
                    document.querySelectorAll('.message:last-child')[0].scrollIntoView()
                }
            },

            loadMessages: async function(userId) {


                axios.get(`api/users/${userId}`).then(response => {
                    this.userActive = response.data.user
                })

                await axios.get(`api/messages/${userId}`).then(response => {
                    this.messages = response.data.messages
                })

                const user = this.users.filter((user) => {
                    if (user.id === userId) {
                        return user
                    }
                })

                if (user) {
                    user[0].notification = false;
                }

                this.scrollToBottom()
            },

            sendMessage: async function(){
                await axios.post('api/messages/store', {
                    'content': this.message,
                    'to': this.userActive.id
                }).then(response => {
                    this.messages.push({
                        'from': this.auth.user.id,
                        'to': this.userActive.id,
                        'content': this.message,
                        'created_at': new Date().toISOString(),
                        'updated_at': new Date().toISOString()
                    })

                    this.message = ''
                })

                this.scrollToBottom()
            },

            formatDate: function (date) {
                return moment(date).format("DD/MM/YYYY HH:mm");
            },
        },
        mounted(){

            axios.get('api/users').then(response => {
                this.users = response.data.users
            })

            axios.get('api/equipes').then(response => {
                this.equipes = response.data.equipes
                console.log(response)
            })

            Echo.private(`user.${this.auth.user.id}`).listen('.SendMessage', async (e) => {
               
                if(this.userActive && this.userActive.id === e.message.from){
                    await this.messages.push(e.message)
                    this.scrollToBottom()
                } else {
                    const user = this.users.filter((user) =>{
                        if (user.id === e.message.from) {
                            return user
                        }
                    })

                    if (user) {
                        user[0].notification = true;
                    }
                }
                console.log(e)
            })
        },
        props: {
            auth: Object,
        } 
    }
</script>
