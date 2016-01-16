<template>
    <div class="row">
        <div class="row">
            <div class="col-sm-6">
                <task-list type="pending" heading="Pending Tasks" :tasks.sync="pendingTasks"></task-list>  
            </div>
            <div class="col-sm-6">
                <task-list type="completed" heading="Completed Tasks" :tasks.sync="completedTasks"></task-list>
            </div>
        </div>
        <alert :dismissable="false" type="danger" v-if="showTasksEmpty">There are no tasks to show.</alert>
    </div>
</template>

<script>

var taskListComponent = require('./list.vue');

module.exports = {

    data: function() {
        
        return {
            pendingTasks: [],
            completedTasks: [],
            dataLoaded: { pending: false, completed: false },
            showTasksEmpty: false
        }
    },

    computed: {
        
        totalTasksCount: function() {
            return this.pendingTasks.length + this.completedTasks.length;
        }
    },

    components: {
        'task-list': taskListComponent
    },

    events: {

        taskCompletionStatusWasToggled: function(task) {
            this.$broadcast('taskCompletionStatusWasToggled', task);
        },

        taskWasDeleted: function(task) {
            this.$broadcast('taskWasDeleted', task);
        },

        dataLoaded: function(type){
            
            this.dataLoaded[type] = true;
            
            if(this.dataLoaded['completed'] === true && this.dataLoaded['pending'] === true)
                this.showTasksEmpty = this.totalTasksCount === 0
        }
    }
}
</script>