<template>
    <div class="wrapper" v-show="tasks.length">
        <modal id="delete" heading="Delete this task" body="Are you sure you want to delete this task ?" approve-button-text="Delete" deny-button-text="Cancel"></modal>
        <h2>{{ heading }}</h2>
        <alert :type="message.type" placement="top-right" :show.sync="showMessage" :dismissable="true" :duration="3000" width="400px">
            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> <strong>Well Done !</strong><p>{{ message.message }}</p>
        </alert>
        <div class="table-responsive">
            <table id="tasks-table" class="table table-bordred table-striped">
                <thead>
                    <tr>
                        <th>Task</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="task in tasks">
                        <td>{{ task.title | strlimit }}</td>
                        <td>{{ task.description | strlimit }}</td>
                        <td>
                            <div class="btn-group">
                                <a v-link="{ path: '/tasks/' + task.id }" class="btn btn-sm btn-primary" data-title="Edit" data-toggle="modal" data-target="#edit" data-placement="top" rel="tooltip"><span class="glyphicon glyphicon-pencil"></span></a>
                                <button class="btn btn-sm btn-danger" data-title="Delete" data-toggle="modal" data-target="#delete" data-placement="top" rel="tooltip" @click="setSelectedTask(task)"><span class="glyphicon glyphicon-trash"></span></button>
                                <button class="btn btn-sm btn-success" @click.prevent="toggleCompletion(task)"><span :class="['glyphicon', task.completed ? 'glyphicon-remove' : 'glyphicon-ok']"></span></button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <spinner type="pulse" :show="loading"></spinner>
</template>

<script type="text/javascript">
	
var errorHandler = require('../../../services/errorHandler');

module.exports = {

	props: {
		heading: {
			type: String,
			required: true
		},
		type: {
			type: String,
			default: 'pending',
			validator: function (value) {
		    	return value === 'pending' || value === 'completed';
		    }
		},
        tasks: {
            type: Array,
            required: true,
            twoWay: true
        }
	},

	ready: function() {
		this.fetch();
	},
    
    data: function() {
        return {
            message: { type: '', message: ''},
            showMessage: false,
            currentTask: null,
            loading: false
        }
    },

    events: {
        
        modalWasApproved: function() {
            this.deleteTask(this.currentTask);
            this.currentTask = null;
        },

        taskCompletionStatusWasToggled: function(task) {
            if(task.completed === true && this.type === 'completed')
            	this.tasks.push(task);
            else if(task.completed === false && this.type === 'pending')
            	this.tasks.push(task);
        },

        taskWasDeleted: function(task) {
            if(task.completed === true && this.type === 'completed')
                this.tasks.$remove(task);
            else if(task.completed === false && this.type === 'pending')
                this.tasks.$remove(task);
        }
    },

    methods: {

    	setSelectedTask: function(task) {
    		this.currentTask = task;
    	},

    	fetch: function() {
            var that = this;
            this.loading = true;
            this.$http.get('tasks/' + this.type).then(function(response) {
                that.loading = false;
                that.tasks = response.data.data;
                that.$dispatch('dataLoaded', this.type);
            }, function(response) {
                that.loading = false;
                errorHandler.handleFailedResponse(response, this);
            });
        },
        
        deleteTask: function(task) {
            var that = this;
            this.$http.delete('tasks/' + task.id).then(function(response) {
                that.tasks.$remove(task);
                that.message = { type: 'success', message: 'Task has been removed.'};
                that.showMessage = true;
            }, function(response) {
                errorHandler.handleFailedResponse(response, this);
            });
        },

        toggleCompletion: function(task) {
        	var that = this;
        	task.completed = !task.completed;
            this.$http.put('tasks/' + task.id, task).then(function(response) {
                that.message = {type: 'success', message: 'Completion status was changed.' };
                that.showMessage = true;
                that.tasks.$remove(task);
                that.$dispatch('taskCompletionStatusWasToggled',task);
            }, function(response) {
                errorHandler.handleFailedResponse(response, this);
            });
        }
    }
}
</script>

<style type="text/css">
    .tasks-view.loading:before {
        content: "Loading...";
        position: absolute;
        top: 16px;
        left: 20px;
    }
</style>