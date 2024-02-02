<script>
import axios from "axios";
export default {
  name: "EditTasks",
  props: ["id"],

  data() {
    return {
      results: "",
      tasks: {
        title: "",
        body: "",
      },
      isLoading: false,
      isLoadingPage: false,
      isLoadingTitle: "Loading",
    };
  },

  computed: {
    task() {
      return this.$store.state.task;
    },
  },
  mounted() {
    this.$store.dispatch("getTask", this.$route.params.id);
    this.tasks = this.task;
    this.isLoadingPage = true;
  },
  methods: {
    update() {
      this.isLoading = true;
      this.isLoadingTitle = "Updating Task";
      this.$store.dispatch("updateTask", this.tasks);
    },
  },
};
</script>

<template>
  <div class="mt-5 container">
    <div v-if="isLoadingPage">
      <h1>Task Edit page</h1>
      <div class="card">
        <div class="card-header">
          <h4>
            Add Task
            <RouterLink to="/all-task" class="btn btn-danger float-end"
              >Back</RouterLink
            >
          </h4>
        </div>
        <div class="card-body">
          <h2>Welcome {{ results ? results.name : "we" }}</h2>
          <div v-if="isLoading">
            <!-- <Loading :title="isLoadingTitle" /> -->
            <h3>Saving Task...</h3>
          </div>
          <div v-else>
            <form @submit.prevent="update">
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
    <div v-else>
      <h3>Retrieving Task</h3>
    </div>
  </div>
</template>
