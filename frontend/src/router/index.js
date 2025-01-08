import { createRouter, createWebHistory } from "vue-router";
import GalleryPage from "@/views/GalleryPage.vue";
import DiscussionPage from "@/views/DiscussionPage.vue";

const routes = [
  {
    path: "/",
    name: "Gallery",
    component: GalleryPage,
  },
  {
    path: '/discussion',
    name: 'Discussion',
    component: DiscussionPage,
    props: (route) => ({ picture: JSON.parse(route.query.picture) }), // קבלת התמונה דרך query
  }
  
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
