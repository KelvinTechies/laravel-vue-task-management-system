<script>
export default {
  name: "TaskList",

  props: ["task"],
  methods: {
    deleteTask(task) {
      this.$store.dispatch("deleteTask", task);
    },
    truncateText() {
      const words = this.originalText.split(" ");
      const truncatedWords = words.slice(0, 15);
      this.truncatedText = truncatedWords.join(" ");
    },
  },
  data() {
    return {
      originalText: this.task.body,
      truncatedText: "",
    };
  },
  created() {
    this.truncateText();
  },
};
</script>

<template>
  <tbody>
    <tr>
      <td>{{ task.title }}</td>
      <td>{{ truncatedText }}</td>
      <td>
        <RouterLink
          :to="{ name: 'EditTasks', params: { id: task.id } }"
          type="button"
          class="btn btn-success me-1"
          data-bs-toggle="modal"
          data-bs-target="#mymodal{{student.id}}"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="20"
            height="20"
            viewBox="0 0 24 24"
          >
            <path
              fill="currentColor"
              d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75zM20.71 7.04a.996.996 0 0 0 0-1.41l-2.34-2.34a.996.996 0 0 0-1.41 0l-1.83 1.83l3.75 3.75z"
            />
          </svg>
        </RouterLink>

        <button @click.prevent="deleteTask(task.id)" class="btn btn-danger">
          <svg
            class=""
            xmlns="http://www.w3.org/2000/svg"
            width="22"
            height="22"
            viewBox="0 0 24 24"
          >
            <path
              fill="currentColor"
              d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6zm2.46-7.12l1.41-1.41L12 12.59l2.12-2.12l1.41 1.41L13.41 14l2.12 2.12l-1.41 1.41L12 15.41l-2.12 2.12l-1.41-1.41L10.59 14zM15.5 4l-1-1h-5l-1 1H5v2h14V4z"
            />
          </svg>
        </button>
      </td>
    </tr>
  </tbody>
</template>

<style></style>
