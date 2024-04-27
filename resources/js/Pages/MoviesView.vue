<script setup>
import {ref, onMounted} from 'vue';

let movies = ref([]);

onMounted(async () => {
    await fetch('/api/v1/movies', {
        method: 'GET',
        headers: {'Accept': 'application/json', 'Authorization': 'Bearer ' + localStorage.getItem('token') }
    })
        .then((response) => response.json())
        .then((data) => {
            console.log(data);
            movies.value = data.movies;
        })
        .catch((error) => console.error(error));
});

</script>

<template>
<div class="container"></div>
    <h1>Movies</h1>
    <div class="crow row-cols-1 row-cols-md-3 g-4">
        <div class="col d-flex" v-for="movie in movies" :key="movie.id">
            <img :src="'/storage/' + movie.poster" alt="Movie Poster" class="movie-poster" />
            <div class="movie-card" id="custom-card">
                <div class="card-body">
                <h2>{{ movie.title }}</h2>
                <p>{{ movie.description }}</p>
            </div>
            </div>
        </div>   
    </div>
</template>


  