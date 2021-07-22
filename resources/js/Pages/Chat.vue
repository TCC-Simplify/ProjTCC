<template>
    <!--<app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Chat
            </h2>
        </template>-->

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg flex" style="min-height:700px; max-height:700px;">
                    <!--Listagem de users-->
                    <div class="w-3/12 bg-gray-200 bg-opacity-25 border-r border-gray-200 overflow-y-scroll">
                        <ul>
                            <li 
                                v-for = "user in users" :key="user.id"
                                @click="() => {loadMessages(user.id)}"
                                class="p-6 text-lg text-gray-600 leading-7 font-semibold border-b border-gray-200 hover:bg-opacity-50 hover:cursor-pointer hover:bg-gray-200">
                                
                                <p class="flex item-center">
                                    {{ user.name }}
                                    <span class="ml-2 mt-2.5 w-2 h-2 bg-blue-400 rounded-full"></span>
                                </p>
                            </li>
                        </ul>
                    </div>

                    <!--Caixa de mensagens-->
                    <div class="w-9/12 flex flex-col justify-between">

                        <!--Mensagens-->
                        <div class="w-full p-6 flex flex-col overflow-y-scroll">
                            <div 
                                v-for="message in messages" :key="message.id"
                                :class="(message.from == auth.user.id) ? 'text-right' : ' ' "
                                class="w-full mb-3">
                                
                                <p 
                                    :class="(message.from == auth.user.id) ? 'bg-green-400' : 'bg-gray-500' "
                                    class="inline-block p-2 rounded-md bg-opacity-25 messageFromMe" style="max-width: 75%;">
                                    {{ message.content }}
                                </p>
                                <span class="block mt-1 text-xs text-gray-500"> {{ formatDate(message.created_at) }}</span>
                            </div>
                        </div>
                        <div class="w-full bg-gray-200 bg-opacity-25 p-6 border-t border-gray-200">
                            <form>
                                <div class="flex rounded-md overflow-hidden border border-gray-300">
                                    <input type="text" class="flex-1 px-4 py-2 text-sm focus:outline-none">
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
    /*import AppLayout from '@/Layouts/AppLayout'*/
    import moment from "moment";

    export default {
        components: {
            //AppLayout,
            moment
        },
        data(){
            return {
                users: [],
                messages: [],
            }
        },
        methods: {
            loadMessages: function(userId){
                axios.get(`api/messages/${userId}`).then(response => {
                    this.messages = response.data.messages
                    console.log(response)
                })
            },
            formatDate: function (date) {
                return moment(date).format("DD/MM/YYYY HH:mm");
            },
        },
        mounted(){
            axios.get('api/users').then(response => {
                this.users = response.data.users
            })
        },
        props: {
            auth: Object,
        }
    }
</script>
