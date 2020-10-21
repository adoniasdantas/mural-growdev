<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ env('APP_NAME') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">

        <style>
            body {
                font-family: 'Nunito';
            }

            /*Banner open/load animation*/
            .alert-banner {
                -webkit-animation: slide-in-top 0.5s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
                animation: slide-in-top 0.5s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
            }

            /*Banner close animation*/
            .alert-banner input:checked ~ * {
                -webkit-animation: slide-out-top 0.5s cubic-bezier(0.550, 0.085, 0.680, 0.530) both;
                animation: slide-out-top 0.5s cubic-bezier(0.550, 0.085, 0.680, 0.530) both;
            }


            @-webkit-keyframes slide-in-top{0%{-webkit-transform:translateY(-1000px);transform:translateY(-1000px);opacity:0}100%{-webkit-transform:translateY(0);transform:translateY(0);opacity:1}}@keyframes slide-in-top{0%{-webkit-transform:translateY(-1000px);transform:translateY(-1000px);opacity:0}100%{-webkit-transform:translateY(0);transform:translateY(0);opacity:1}}@-webkit-keyframes slide-out-top{0%{-webkit-transform:translateY(0);transform:translateY(0);opacity:1}100%{-webkit-transform:translateY(-1000px);transform:translateY(-1000px);opacity:0}}@keyframes slide-out-top{0%{-webkit-transform:translateY(0);transform:translateY(0);opacity:1}100%{-webkit-transform:translateY(-1000px);transform:translateY(-1000px);opacity:0}}@-webkit-keyframes slide-in-bottom{0%{-webkit-transform:translateY(1000px);transform:translateY(1000px);opacity:0}100%{-webkit-transform:translateY(0);transform:translateY(0);opacity:1}}@keyframes slide-in-bottom{0%{-webkit-transform:translateY(1000px);transform:translateY(1000px);opacity:0}100%{-webkit-transform:translateY(0);transform:translateY(0);opacity:1}}@-webkit-keyframes slide-out-bottom{0%{-webkit-transform:translateY(0);transform:translateY(0);opacity:1}100%{-webkit-transform:translateY(1000px);transform:translateY(1000px);opacity:0}}@keyframes slide-out-bottom{0%{-webkit-transform:translateY(0);transform:translateY(0);opacity:1}100%{-webkit-transform:translateY(1000px);transform:translateY(1000px);opacity:0}}@-webkit-keyframes slide-in-right{0%{-webkit-transform:translateX(1000px);transform:translateX(1000px);opacity:0}100%{-webkit-transform:translateX(0);transform:translateX(0);opacity:1}}@keyframes slide-in-right{0%{-webkit-transform:translateX(1000px);transform:translateX(1000px);opacity:0}100%{-webkit-transform:translateX(0);transform:translateX(0);opacity:1}}@-webkit-keyframes fade-out-right{0%{-webkit-transform:translateX(0);transform:translateX(0);opacity:1}100%{-webkit-transform:translateX(50px);transform:translateX(50px);opacity:0}}@keyframes fade-out-right{0%{-webkit-transform:translateX(0);transform:translateX(0);opacity:1}100%{-webkit-transform:translateX(50px);transform:translateX(50px);opacity:0}}

        </style>
    </head>
    <body>

    @if(\Illuminate\Support\Facades\Session::has('success'))

    <!--Header Alert-->
    <div class="alert-banner w-full fixed top-0">
        <input type="checkbox" class="hidden" id="banneralert">

        <label class="close cursor-pointer flex items-center justify-between w-full p-2 bg-green-500 shadow text-white" title="close" for="banneralert">
            {{ \Illuminate\Support\Facades\Session::get('success') }} (clique para fechar)

            <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
            </svg>
        </label>
    </div>

    @endif

    <div class="container mx-auto mt-12">

        <div class="w-full max-w-xs mx-auto">
            <form action="{{ route('store') }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="texto">
                        Recado
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="recado" type="text" name="texto" placeholder="Recado" value="{{ old('texto') }}">
                    @error('texto')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex items-center justify-center">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        Salvar
                    </button>
                </div>
            </form>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 justify-items-stretch">
            @forelse($recados as $recado)
                <div class="flex justify-center items-center p-6 bg-yellow-400 rounded-lg shadow-xl mx-auto">
                    <p class="text-base text-gray-900 leading-normal break-all">{{ $recado->texto }}</p>
                    <a href="javascript:void(0)" onclick="if(confirm('Deseja excluir o recado?'))document.getElementById('destroy-{{ $recado->id }}').submit()"
                        class="bg-yellow-400 text-gray-900 font-bold py-2 px-4 rounded inline-flex items-center flex-shrink-0"
                        title="Excluir">
                        <svg class="fill-current w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                            </path>
                        </svg>
                    </a>
                    <form action="{{ route('destroy', $recado->id) }}" method="post" class="hidden" id="destroy-{{ $recado->id }}">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    </form>
                </div>
            @empty
                <div class="flex justify-center p-6 bg-white rounded-lg shadow-xl col-span-3 mx-auto">
                    <p class="text-base text-gray-900 leading-normal">Não há recados cadastrados!</p>
                </div>
            @endforelse
        </div>
    </div>
    </body>
</html>
