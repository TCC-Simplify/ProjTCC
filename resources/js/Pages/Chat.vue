<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Chat
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg flex" style="min-height:700px; max-height:700px;">
                    <!--Listagem de users-->
                    <div class="w-3/12 bg-gray-200 bg-opacity-25 border-r border-gray-200 overflow-y-scroll">
                        <ul>
                            <li class="p-6 text-lg text-gray-600 leading-7 font-semibold border-b border-gray-200 hover:bg-opacity-50 hover:cursor-pointer hover:bg-gray-200">
                                <p class="flex item-center">
                                    Pietra Karoline
                                    <span class="ml-2 mt-2.5 w-2 h-2 bg-blue-400 rounded-full"></span>
                                </p>
                            </li>

                            <li class="p-6 text-lg text-gray-600 leading-7 font-semibold border-b border-gray-200 hover:bg-opacity-50 hover:cursor-pointer hover:bg-gray-200">
                                <p class="flex item-center">
                                    Melissa Cristiny
                                    <span class="ml-2 mt-2.5 w-2 h-2 bg-blue-400 rounded-full"></span>
                                </p>
                            </li>

                            <li class="p-6 text-lg text-gray-600 leading-7 font-semibold border-b border-gray-200 hover:bg-opacity-50 hover:cursor-pointer hover:bg-gray-200">
                                <p class="flex item-center">
                                    Melissa Cristiny
                                    <span class="ml-2 mt-2.5 w-2 h-2 bg-blue-400 rounded-full"></span>
                                </p>
                            </li>

                            <li class="p-6 text-lg text-gray-600 leading-7 font-semibold border-b border-gray-200 hover:bg-opacity-50 hover:cursor-pointer hover:bg-gray-200">
                                <p class="flex item-center">
                                    Melissa Cristiny
                                    <span class="ml-2 mt-2.5 w-2 h-2 bg-blue-400 rounded-full"></span>
                                </p>
                            </li>

                            <li class="p-6 text-lg text-gray-600 leading-7 font-semibold border-b border-gray-200 hover:bg-opacity-50 hover:cursor-pointer hover:bg-gray-200">
                                <p class="flex item-center">
                                    Melissa Cristiny
                                    <span class="ml-2 mt-2.5 w-2 h-2 bg-blue-400 rounded-full"></span>
                                </p>
                            </li>

                            <li class="p-6 text-lg text-gray-600 leading-7 font-semibold border-b border-gray-200 hover:bg-opacity-50 hover:cursor-pointer hover:bg-gray-200">
                                <p class="flex item-center">
                                    Melissa Cristiny
                                    <span class="ml-2 mt-2.5 w-2 h-2 bg-blue-400 rounded-full"></span>
                                </p>
                            </li>
                        </ul>
                    </div>

                    <!--Caixa de mensagens-->
                    <div class="w-9/12 flex flex-col justify-between">

                        <!--Mensagens-->
                        <div class="w-full p-6 flex flex-col overflow-y-scroll">
                            <div class="w-full mb-3 text-right">
                                <p class="inline-block p-2 rounded-md bg-green-400 bg-opacity-25 messageFromMe" style="max-width: 75%;">
                                    Oi!!
                                </p>
                                <span class="block mt-1 text-xs text-gray-500">19/07/2021 21:15</span>
                            </div>

                            <div class="w-full mb-3">
                                <p class="inline-block p-2 rounded-md bg-gray-500 bg-opacity-25 messageToMe" style="max-width: 75%;">
                                    Olá!!
                                </p>
                                <span class="block mt-1 text-xs text-gray-500">19/07/2021 21:15</span>
                            </div>

                            <div class="w-full mb-3">
                                <p class="inline-block p-2 rounded-md bg-gray-500 bg-opacity-25 messageToMe" style="max-width: 75%;">
                                    Olá!!
                                </p>
                                <span class="block mt-1 text-xs text-gray-500">19/07/2021 21:15</span>
                            </div>

                            <div class="w-full mb-3">
                                <p class="inline-block p-2 rounded-md bg-gray-500 bg-opacity-25 messageToMe" style="max-width: 75%;">
                                    Olá!!
                                </p>
                                <span class="block mt-1 text-xs text-gray-500">19/07/2021 21:15</span>
                            </div>

                            <div class="w-full mb-3">
                                <p class="inline-block p-2 rounded-md bg-gray-500 bg-opacity-25 messageToMe" style="max-width: 75%;">
                                    Olá!!
                                </p>
                                <span class="block mt-1 text-xs text-gray-500">19/07/2021 21:15</span>
                            </div>

                            <div class="w-full mb-3">
                                <p class="inline-block p-2 rounded-md bg-gray-500 bg-opacity-25 messageToMe" style="max-width: 75%;">
                                    Olá!!
                                </p>
                                <span class="block mt-1 text-xs text-gray-500">19/07/2021 21:15</span>
                            </div>

                            <div class="w-full mb-3">
                                <p class="inline-block p-2 rounded-md bg-gray-500 bg-opacity-25 messageToMe" style="max-width: 75%;">
                                    Olá!!
                                </p>
                                <span class="block mt-1 text-xs text-gray-500">19/07/2021 21:15</span>
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
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'

    export default {
        components: {
            AppLayout,
        },
        data(){
            return {
                users: []
            }
        },
        mounted(){
            axios.get('api/users').then(response => {
                console.log(response);
            })
        }
    }
</script>