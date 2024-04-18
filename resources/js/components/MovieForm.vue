<template>
    <div>
        <form @submit.prevent="saveMovie">
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
