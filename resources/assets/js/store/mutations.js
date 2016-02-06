module.exports =  {
    
    ADD_TASK: function(state, title, description) {
        state.tasks.unshift({
            title: title,
            description: description,
            completed: false
        });
    },

    DELETE_TASK: function(state, task) {
        state.tasks.$remove(task);
    },

    TOGGLE_TASK: function(state, task) {
        task.completed = !task.completed;
    },

    EDIT_TASK: function(state, task, data) {
        task = data;
    }
}