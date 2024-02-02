<script>
import axios from "axios";
export default {
  name: "CreateTaskComponent",

  data() {
    return {
      results: "",
      tasks: {
        title: "",
        body: "",
      },
      isLoading: false,
      isLoadingTitle: "Loading",
    };
  },

  methods: {
    createTask() {
      if (this.tasks.body == "") {
        this.$toast.warning("The body Field is required");
      } else if (this.tasks.title == "") {
        this.$toast.warning("The title Field is required");
      } else {
        this.isLoading = true;
        this.isLoadingTitle = "Saving Task";
        this.$store.dispatch("createTask", this.tasks);
        this.$router.push({ name: "AllTasks" });
      }
    },
  },
  async mounted() {
    await axios.get("http://localhost:8000/api/user").then((res) => {
      this.results = res.data;
    });
  },
};
</script>

<template>
  <div class="mt-5 container">
    <h1>Task create page</h1>
    <div class="card">
      <div class="card-header">
        <h4>
          Add Task
          <NuxtLink to="/" class="btn btn-danger float-end">Back</NuxtLink>
        </h4>
      </div>
      <div class="card-body">
        <h2>Welcome {{ results ? results.name : "we" }}</h2>
        <div v-if="isLoading">
          <!-- <Loading :title="isLoadingTitle" /> -->
          <h3>Saving Task...</h3>
        </div>
        <div v-else>
          <form @submit.prevent="createTask()">
            <div class="mb-3">
              <label for=""> Title</label>
              <input type="text" class="form-control" v-model="tasks.title" />
            </div>
            <div class="mb-3">
              <label for=""> Body</label>
              <input type="text" class="form-control" v-model="tasks.body" />
            </div>
            <div class="mb-3">
              <button class="btn btn-success">save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
