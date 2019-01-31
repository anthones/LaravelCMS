<template>
  <div class="container">
    <form>
      <div :class="['form-group m-1 p-3', successful ? 'alert-success' : '']">
        <span
          v-if="successful"
          class="label label-sucess"
        >Updated!</span>
      </div>

      <div :class="['form-group m-1 p-3', error ? 'alert-danger' : '']">
        <span
          v-if="errors.title"
          class="label label-danger"
        >
          {{ errors.title[0] }}
        </span>
        <span
          v-if="errors.body"
          class="label label-danger"
        >
          {{ errors.body[0] }}, status {{ error.response.status }}
        </span>
      </div>

      <div class="form-group">
        <input
          type="title"
          ref="title"
          class="form-control"
          id="title"
          placeholder="Enter title"
          required
        >
      </div>

      <div class="form-group">
        <froala
          class="form-control"
          ref="body"
          id="body"
          :tag="'textarea'"
          :config="config"
          v-model="model"
        ></froala>
      </div>

      <div class="custom-file mb-3">
        <input
          type="file"
          ref="image"
          name="image"
          class="custom-file-input"
          id="image"
        >
        <label class="custom-file-label">Choose file...</label>
      </div>

      <button
        type="submit"
        @click.prevent="update"
        class="btn btn-primary block"
      >
        Submit
      </button>
    </form>
  </div>
</template>

<script>
export default {
  mounted() {
    this.getPost();
  },
  props: {
    postId: {
      type: Number,
      required: true
    }
  },
  data() {
    return {
      error: false,
      successful: false,
      errors: [],
      config: {
        events: {
          "froalaEditor.initialized": function() {
            console.log("initialized");
          }
        }
      },
      model: "Edit Your Content Here!",
      imageKey: 0
    };
  },
  methods: {
    update() {
      const formData = new FormData();
      formData.append("title", this.$refs.title.value);
      formData.append("body", this.$refs.body.value);
      formData.append("image", this.$refs.image.files[0]);
      formData.append("_method", "PUT");

      axios
        .post("/api/posts/" + this.postId, formData)
        .then(response => {
          this.successful = true;
          this.error = false;
          this.errors = [];
        })
        .catch(error => {
          if (!_.isEmpty(error.response)) {
            if ((error.response.status = 422)) {
              this.errors = error.response.data.errors;
              this.successful = false;
              this.error = true;
            }
          }
        });
    },
    fullImagePath(localPath) {
      return "/uploads/posts/" + localPath;
    },
    getPost() {
      axios.get("/api/posts/" + this.postId).then(response => {
        this.$refs.title.value = response.data.data.title;
        this.$refs.body.value = response.data.data.body;
      });
    }
  }
};
</script>