<template>
    <div>
        <form id="movieForm" @submit.prevent="saveMovie" action="/api/v1/movies" method="post">
            <div class="form-group mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" class="form-control"/>
            </div>
            <div class="form-group mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" rows="3" name="description"></textarea>
            </div>
            <div class="form-group mb-3">
                <label for="poster" class="form-label">Poster</label>
                <input type="file" class="form-control" id="poster" name="poster" required>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</template>

<script setup>
const saveMovie = async () => {
  const form_data = new FormData(document.getElementById('movieForm'));
  const headers = { 'Accept': 'application/json','Authorization': 'Bearer ' + localStorage.getItem('token') };
  const response = await fetch('/api/v1/movies', {
    method: 'POST',
    headers,
    body: form_data
  });
  const data = await response.json();
  console.log(data);
}
</script>
