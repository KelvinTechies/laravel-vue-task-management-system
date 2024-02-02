export const ADD_TASK = (state, task) => {
  state.tasks.push({
    task,
  });
};

export const SET_TASKS = (state, tasks) => {
  state.tasks = tasks;
};

export const SET_TASK = (state, task) => {
  state.task = task;
};

export const UPDATE_TASK = (state, updatedTask) => {
  // state.tasks = updatedTask;
  state.tasks.map((task) => {
    if (task.id === updatedTask.id) {
      task.title = updatedTask.title;
      task.body = updatedTask.body;
    }
  });
};

export const DELETE_TASK = (state, taskID) => {
  state.tasks = state.tasks.filter((task) => {
    return task.id !== taskID;
  });
};
