 <template>
  <div id="posts">
    <p
      class="border p-3"
      v-for="post in posts"
      :key="post"
    >
      {{ post.title }}
      <img :src='fullImagePath(post.image)'>
      <router-link :to="{ name: 'update', params: { postId : post.id } }">
        <button
          type="button"
          class="p-1 mx-3 float-right btn btn-light"
        >
          Update
        </button>
      </router-link>
      <button
        type="button"
        @click="deletePost(post.id)"
        class="p-1 mx-3 float-right btn btn-danger"
      >
        Delete
      </button>
    </p>
    <div>
      <button
        v-if="next"
        type="button"
        @click="navigate(next)"
        class="m-3 btn btn-primary"
      >
        Next
      </button>
      <button
        v-if="prev"
        type="button"
        @click="navigate(prev)"
        class="m-3 btn btn-primary"
      >
        Previous
      </button>
    </div>
  </div>
</template>

<style scoped>
#posts > p > img {
  margin-left: 50px;
  width: 100px;
  height: auto;
}

#posts > p {
  font: 1.6em Arial;
  color: #aaa;
}
/* #posts > button {
  justify-content: center;
} */
</style>

<script>
export default {
  mounted() {
    this.getPosts();
  },
  data() {
    return {
      posts: {},
      next: null,
      prev: null
    };
  },
  methods: {
    getPosts(address) {
      axios.get(address ? address : "/api/posts").then(response => {
        this.posts = response.data.data;
        this.prev = response.data.links.prev;
        this.next = response.data.links.next;
      });
    },
    fullImagePath(localPath) {
      return "/uploads/posts/" + localPath;
    },
    deletePost(id) {
      axios.delete("/api/posts/" + id).then(response => this.getPosts());
    },
    navigate(address) {
      this.getPosts(address);
    }
  }
};
</script>