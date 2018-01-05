new Vue({
  el: '#app',
  data: {
    deleteTaskMessage: '',
    listFilter: 'all',
    loader: true,
    newTaskContainer: false,
    newTaskModel: {
      title: '',
      description: '',
      task_date: ''
    },
    newTaskMessage: '',
    updateTaskMessage: '',
    taskList: []
  },
  computed: {
    /** @return {!Array<!Object>} */
    sortedList() {
      if (this.listFilter != 'all') {
        return this.taskList.filter(obj => { 
          return obj.status === this.listFilter; });
      } else {
        return this.taskList;
      }
    },
    /** @return {!number} */
    newTaskTotal() {
      const newTask = this.taskList.filter(obj => { 
          return obj.status === 'new'; });
      return newTask.length;
    },
    /** @return {!number} */
    doneTaskTotal() {
      const doneTask = this.taskList.filter(obj => { 
          return obj.status === 'done'; });
      return doneTask.length;
    }
  },
  methods: {
    /**
     * Gets the initial data of the todo table from the 
     * database using the read api and load it in the taskList array.
     */
    fetchTodoList() {
      const readUrl = '/app/todo/read.php';
      this.$http.get(readUrl).then(function(response) {
        const data = response.data;

        this.taskList = data.records;
        this.loader = false;
      }.bind(this));
    },

    /**
     * Opens new task container.
     */
    openNewTask() {
      this.newTaskMessage = '';
      this.newTaskContainer = true;
    },

    /**
     * Saves new task item in the db.
     */
    saveNewTask() {
      // Refresh message for user display.
      this.newTaskMessage = '';

      // Prepare api url and call create api.
      const createUrl = '/app/todo/create.php';

      // Check posted data. minimum req is the title.
      // If task date is not set, use today as default date.
      if (this.newTaskModel.task_date == '') {
        this.newTaskModel.task_date = new Date();
      }

      if (this.newTaskModel.title != '') {
        this.$http.post(createUrl, this.newTaskModel).then(function(response) {
          const data = response.data;
          this.newTaskMessage = data.message;

          if (data.message == 'Task was created.') {
            this.newTaskModel.title = '';
            this.newTaskModel.description = '';
            this.newTaskModel.task_date = '';

            this.fetchTodoList();
          }
        }.bind(this));   
      } else {
        this.newTaskMessage = 'Kindly check required fields!';
      }
    },

    /**
     * Delete specific task
     * @param {!number} taskId
     */
    deleteTask(taskId) {
      // Refresh message for user display.
      this.deleteTaskMessage = '';
      
      // Set checker for user confirmation.
      const checker = confirm('Are you sure you want delete this task?');

      if (checker == true) {
        // Prepare api url and call delete api.
        const deleteUrl = '/app/todo/delete.php';
        this.$http.post(deleteUrl, { id: taskId }).then(function(response) {
          const data = response.data;
          this.deleteTaskMessage = data.message;

          if (data.message == 'Task was deleted.') {
            this.fetchTodoList();
          }
        }.bind(this));
      }
    },

    /**
     * Opens update task container for the specific task
     * @param {!number} taskId
     */
    openUpdateContainer(taskId) {
      // Refresh message for user display.
      this.updateTaskMessage = '';

      const domId = `update-container-${taskId}`;
      document.getElementById(domId).style.display = 'flex';
    },

    /**
     * Close update task container for the specific task
     * @param {!number} taskId
     */
    closeUpdateContainer(taskId) {
      const domId = `update-container-${taskId}`;
      document.getElementById(domId).style.display = 'none';
    },

    /**
     * Update specific task content
     * @param {!number} taskId
     */
    updateTask(taskId) {
      // Refresh message for user display.
      this.updateTaskMessage = '';

      // Get the specific task from the list.
      const task = this.taskList.find(obj => { return obj.id === taskId; });

      // Prepare api url and call update api.
      const updateUrl = '/app/todo/update.php';
      this.$http.post(updateUrl, task).then(function(response) {
        const data = response.data;
        this.updateTaskMessage = data.message;
      }.bind(this));
    }
  },
  created() {
    // Initially fetch todo list.
    this.fetchTodoList();
  }
})