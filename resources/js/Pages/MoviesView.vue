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
    <div class="container">
      <h1>Movies</h1>
      <div class="row">
        <div class="col-md-6" v-for="movie in movies" :key="movie.id">
          <div class="movie-card" id="custom-card">
            <div class="d-flex">
              <img :src="'/storage/' + movie.poster" alt="Movie Poster" class="movie-poster" />
              <div class="card-body-expanded ms-3">
                <h2>{{ movie.title }}</h2>
                <p>{{ movie.description }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <style scoped>
  .movie-poster {
    width: 120px; 
    height: 180px;
    object-fit: cover; 
  }
  
  .movie-card {
    border: 1px solid #ccc; 
    border-radius: 5px; 
    margin-bottom: 20px;
  }
  
  .card-body-expanded {
    flex-grow: 1;
    max-width: calc(100% - 140px); 
  }
  
  @media (max-width: 768px) {
    .movie-poster {
      width: 100%; 
      height: auto;
    }
  }
  </style>
  
  
  
  


  