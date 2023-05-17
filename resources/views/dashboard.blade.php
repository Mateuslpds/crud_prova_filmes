<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1>Meus filmes</h1>
                    @foreach (Auth::user()->filmes as $filme)
                        <div class="flex justify-between border-b mb-2 gap-4 hover:big-gray-300" x-data="{showDelete: false, showEdit: false}">
                            <div class="flex justify-between flex-grow">
                                <div>{{ $filme->titulo }}</div>
                                <div>{{ $filme->diretor }}</div>
                                <div>{{ $filme->genero }}</div>
                                <div>{{ $filme->ano }}</div>
                                <div>{{ $filme->classificacao }}</div>
                            </div>
                            <div class="flex gap-2">
                                <div>
                                    <button class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded" @click="showDelete = true">Deletar</button>
                                </div>
                                <div>
                                    <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-3 rounded" @click="showEdit = true">Editar</button>
                                </div>
                            </div>

                            <template x-if="showDelete">
                                <div class="absolute top-0 bottom-0 left-0 right-0 bg-gray-800 bg-opacity-20 z-0">
                                    <div class="w-96 bg-white p-4 absolute left-1/4 right-1/4 top-1/4 z-10">
                                        <h2 class="text-xl font-bold text-center">Você tem certeza?</h2>
                                        <div class="flex justify-between mt-4">
                                            <form action="{{ route('filme.destroy', $filme) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <x-danger-button>Sim</x-danger-button>
                                            </form>
                                            <x-primary-button @click="showDelete = false">Não</x-primary-button>
                                        </div>
                                    </div>
                                </div>
                            </template>

                            <template x-if="showEdit">
                                <div class="absolute top-0 bottom-0 left-0 right-0 bg-gray-800 bg-opacity-20 z-0">
                                    <div class="w-96 bg-white p-4 absolute left-1/4 right-1/4 top-1/4 z-10">
                                        <h2 class="text-xl font-bold text-center">{{ $filme->titulo }}</h2>
                                        <div class="flex justify-between mt-4">
                                            <form action="{{ route('filme.update', $filme) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <x-text-input type="text" name='titulo' placeholder="Título" value="{{ $filme->titulo }}" />
                                                <x-text-input type="text" name='diretor' placeholder="Diretor" value="{{ $filme->diretor }}" />
                                                <x-text-input type="text" name='genero' placeholder="Gênero" value="{{ $filme->genero }}" />
                                                <x-text-input type="number" name='ano' placeholder="Ano de Lançamento" value="{{ $filme->ano }}" />
                                                <select name="classificacao" id="classificacao">
                                                    <option value="Livre">Livre</option>
                                                    <option value="10 anos">10 anos</option>
                                                    <option value="12 anos">12 anos</option>
                                                    <option value="14 anos">14 anos</option>
                                                    <option value="16 anos">16 anos</option>
                                                    <option value="18 anos">18 anos</option>
                                                </select>
                                                <x-primary-button>Editar</x-primary-button>
                                            </form>
                                            <x-danger-button @click="showEdit = false">Cancelar</x-danger-button>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    @endforeach
                    <form action="{{ route('filme.store') }}" method="POST">
                        @csrf
                        <x-text-input type="text" name='titulo' placeholder="Título" />
                        <x-text-input type="text" name='diretor' placeholder="Diretor" />
                        <x-text-input type="text" name='genero' placeholder="Gênero" />
                        <x-text-input type="number" name='ano' placeholder="Ano de Lançamento" />
                        <select name="classificacao" id="classificacao">
                            <option value="Livre">Livre</option>
                            <option value="10 anos">10 anos</option>
                            <option value="12 anos">12 anos</option>
                            <option value="14 anos">14 anos</option>
                            <option value="16 anos">16 anos</option>
                            <option value="18 anos">18 anos</option>
                        </select>
                        <button class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-1 px-3 rounded">Registrar filme</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>