@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">

                    <div x-data="pokemonSearch">
                        <input type="text" x-model="search" />

                        <button @click="searching" class="btn btn-danger" type="button">Buscar pokemon</button>

                        <template x-if="pokemon">
                            <div>
                                Pokemon: <span x-text="pokemon.name"></span>
                                <img :src="pokemon.sprites.front_shiny" />

                                <template x-for="ab in pokemon.abilities" :key="ab.ability.url">
                                    <li x-text="ab.ability.name"></li>
                                </template>
                            </div>
                        </template>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('pokemonSearch', () => ({
            search: '',
            pokemon: null,

            searching() {
                fetch(`https://pokeapi.co/api/v2/pokemon/${this.search}`)
                    .then(response => response.json())
                    .then(data => {
                        this.pokemon = data;
                    });
            }
        }))
    })
</script>
@endsection
