<template>
  <div class="mt-5 col-md-5 mx-auto">
    <div class="div">
      <div class="card bg-light ms-4 me-4 mb-4">
        <div class="card-header">Task Records</div>
        <div class="card-body">
          <div class="card-text">
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>

                    <th scope="col">Actions</th>
                  </tr>
                </thead>

                <TaskList v-for="task in tasks" :key="task.id" :task="task" />
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import TaskList from "./TaskList.vue";

export default {
  components: { TaskList },
  name: "AllTasks",
  computed: {
    tasks() {
      return this.$store.state.tasks;
    },
  },
  mounted() {
    this.$store.dispatch("getTasks");
  },
};
</script>
