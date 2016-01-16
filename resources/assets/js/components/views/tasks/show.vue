<template>
    <modal id="delete" heading="Delete this task" body="Are you sure you want to delete this task ?" approve-button-text="Delete" deny-button-text="Cancel"></modal>
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <alert-messages :messages="messages"></alert-messages>
            <div class="panel panel-info" v-if="task">
                <div class="panel-heading">
                    <h3 class="panel-title">Update the task</h3>
                </div>
                <div class="panel-body">
                    <form method="POST" @submit.prevent="updateTask">
                        <fieldset>
                            <div class="form-group ">
                                <label for="title">Title</label>
                                <input class="form-control input-sm" v-model="task.title" name="title" type="text" id="title">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control input-sm" v-model="task.description" name="description" type="test" id="description" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label><input type="checkbox" v-model="task.completed">Completed</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-ok-sign"></span> Update</button>
                                <button type="button" class="btn btn-sm btn-danger" data-title="Delete" data-toggle="modal" data-target="#delete" data-placement="top" rel="tooltip"><span class="glyphicon glyphicon-trash"></span> Delete</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

var errorHandler = require('../../../services/errorHandler');

module.exports = {

    data: function() {
        return {
            task: {
                id: null,
                title: null,
                description: null
            },
            messages: []
        }
    },

    events: {
        modalWasApproved: function() {
            this.deleteTask(this.task);
            this.$router.go('tasks');
        }    
    },

    methods: {
        
        fetch: function(id, successHandler) {
            var that = this;
            this.$http.get('tasks/' + id).then(function(response) {
                that.task = response.data.data;
                successHandler(response.data.data);
            }, function(response) {
                errorHandler.handleFailedResponse(response, this);
            });
        },

        updateTask: function() {
            var that = this;
            this.$http.put('tasks/' + this.task.id, this.task).then(function(response) {
                that.messages = [ {type: 'success', message: 'Task was updated successfully.' }];
            }, function(response) {
                errorHandler.handleFailedResponse(response, this);
            });
        },

        deleteTask: function() {
            var that = this;
            this.$http.delete('tasks/' + this.task.id).then(function(response) {
                that.messages = [{ type: 'success', message: 'Task has been removed successfully.'}];
                that.$dispatch('taskWasDeleted',that.task);
                that.task = null;
            }, function(response) {
                errorHandler.handleFailedResponse(response, this);
            });
        }
    },

    route: {
        
        data: function(transition) {
            this.fetch(this.$route.params.id, function(data) {
                transition.next({ task: data });
            });
        }
    }
}
</script>