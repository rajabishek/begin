<template>
    <div class="row">
        <div class="row" v-show="!tasksEmpty">
            <div class="col-sm-6">
                <task-list type="pending" heading="Pending Tasks"></task-list>  
            </div>
            <div class="col-sm-6">
                <task-list type="completed" heading="Completed Tasks"></task-list>
            </div>
        </div>
        <alert :dismissable="false" type="danger" v-else>There are no tasks to show.</alert>
    </div>
</template>

<script>

var taskListComponent = require('./list.vue');

module.exports = {

    data: function() {
        return {
            tasks: [],
            pendingTasksCount: 100, //Just to fake initially to prevent error message from showing
            completedTasksCount: 100
        }
    },

    computed: {
        totalTasksCount: function() {
            return this.pendingTasksCount + this.completedTasksCount;
        },

        tasksEmpty: function() {
            return this.totalTasksCount == 0;
        }
    },

    components: {
        'task-list': taskListComponent
    },

    events: {
        
        taskCompletionStatusWasToggled: function(task) {
            this.$broadcast('taskCompletionStatusWasToggled', task);
        },

        tasksCountChanged: function(task) {
            if(task.type === 'pending')
                this.pendingTasksCount = task.count;
            else if(task.type === 'completed')
                this.completedTasksCount = task.count;
        },
    }
}
</script>