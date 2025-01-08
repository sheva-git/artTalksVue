<template>
  <div>
    <input
      type="text"
      v-model="searchTerm"
      placeholder="Search for pictures..."
    />
    <div class="gallery">
      <div 
        class="card" 
        v-for="picture in filteredPictures" 
        :key="picture.id"
        @mouseover="showImageDetails(picture)"
        @mouseleave="hideImageDetails"
      >
        <img :src="picture.image" alt="Picture" />
        <h2>{{ picture.name }}</h2>
        <p>By: {{ picture.artist }}</p>
        <p>{{ picture.description }}</p>
        <button @click="goToDiscussion(picture)">View Discussion</button>

        <!-- מידע נוסף מתחת לתמונה -->
        <div v-if="hoveredPicture && hoveredPicture.id === picture.id" class="image-details">
          <p>Resolution: {{ hoveredPicture.resolution }}</p>
          <p>Weight: {{ hoveredPicture.size }} KB</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      pictures: [],
      searchTerm: "",
      hoveredPicture: null, 
    };
  },
  computed: {
    filteredPictures() {
      return this.pictures.filter((picture) =>
        picture.name.toLowerCase().includes(this.searchTerm.toLowerCase()) ||
        picture.artist.toLowerCase().includes(this.searchTerm.toLowerCase())
      );
    },
  },
  methods: {
    goToDiscussion(picture) {
      this.$router.push({
        name: 'Discussion',
        query: { picture: JSON.stringify(picture) }, 
      });
    },
    showImageDetails(picture) {
      this.hoveredPicture = picture; 
    },
    hideImageDetails() {
      this.hoveredPicture = null; 
    },
  },
  created() {
    axios
      .get("http://localhost/art-talks/Backend/pictures.php")
      .then((response) => {
        this.pictures = response.data.map((picture) => ({
          ...picture,
          resolution: `${picture.width}x${picture.height}`, 
          size: (picture.size / 1024).toFixed(2), 
        }));
      })
      .catch((error) => {
        console.error("Error fetching data:", error);
      });
  },
};
</script>

<style>
.gallery {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
}
.card {
  border: 1px solid #ddd;
  padding: 16px;
  width: 200px;
  text-align: center;
  position: relative;
}
.card img {
  width: 100%;
  height: auto;
}
.image-details {
  margin-top: 10px;
  background-color: #f9f9f9;
  border: 1px solid #ddd;
  padding: 5px;
  border-radius: 5px;
  text-align: left;
}
</style>
