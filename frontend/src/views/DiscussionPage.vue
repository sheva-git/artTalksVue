<template>
  <div class="discussion-container">
    <!-- אזור פרטי התמונה -->
    <div class="image-details">
      <h1>{{ picture?.name || "No Title" }}</h1>
      <h3>By {{ picture?.artist || "Unknown Artist" }}</h3>
      <div class="image-container">
        <img
          :src="picture?.image || 'https://via.placeholder.com/600x400?text=No+Image'"
          alt="Artwork"
        />
      </div>
      <p>{{ picture?.description || "No description available." }}</p>
    </div>

    <!-- אזור הצ'אט -->
    <div class="chat-container">
      <h2>Chat</h2>
      <div class="chat-messages">
        <div v-for="message in messages" :key="message.id" class="message">
          <strong>{{ message.user }}:</strong> {{ message.text }}
        </div>
      </div>
      <div class="chat-input">
        <input
          v-model="newMessage"
          type="text"
          placeholder="Type your message here..."
          @keyup.enter="sendMessage"
        />
        <button @click="sendMessage">Send</button>
      </div>
    </div>
  </div>
</template>

<script>
import { io } from "socket.io-client";

export default {
  props: {
    picture: {
      type: Object,
      default: () => ({
        name: "Unknown",
        artist: "Unknown",
        image: "",
        description: "No description available.",
      }),
    },
  },
  data() {
    return {
      socket: null,
      messages: [],
      newMessage: "",
    };
  },
  methods: {
    sendMessage() {
      if (!this.newMessage.trim()) return;
      const message = { user: "Me", text: this.newMessage.trim() };
      this.messages.push(message);
      this.socket?.emit("chatMessage", message);
      this.newMessage = "";
    },
  },
  created() {
    this.socket = io("http://localhost:8000");
    this.socket.on("chatMessage", (message) => {
      this.messages.push(message);
    });
  },
  beforeUnmount() {
    this.socket?.disconnect();
  },
};
</script>

<style scoped>
.discussion-container {
  display: flex;
  max-width: 1200px;
  margin: 0 auto;
  padding: 20px;
  gap: 20px;
}

.image-details {
  flex: 2;
}

.image-details h1 {
  font-size: 2em;
  margin: 0;
}

.image-details h3 {
  font-size: 1.2em;
  color: gray;
}

.image-container img {
  width: 100%;
  max-height: 400px;
  object-fit: contain;
  border: 1px solid #ccc;
  border-radius: 10px;
  margin: 10px 0;
}

.chat-container {
  flex: 1;
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.chat-messages {
  flex: 1;
  border: 1px solid #ddd;
  padding: 10px;
  overflow-y: auto;
  max-height: 300px;
  background-color: #f9f9f9;
  border-radius: 5px;
}

.message {
  margin-bottom: 10px;
}

.chat-input {
  display: flex;
  gap: 10px;
}

.chat-input input {
  flex: 1;
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 5px;
}

.chat-input button {
  padding: 10px 20px;
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.chat-input button:hover {
  background-color: #0056b3;
}
</style>
