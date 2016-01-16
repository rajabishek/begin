<template>
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Create a task</h3>
                </div>
                <div class="panel-body">
                    <alert-messages :messages="messages"></alert-messages>
                    <form method="POST" @submit.prevent="createTask">
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
                                <loading-button type="success" size="sm" :loading="loading">Create</loading-button>
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
                title: '',
                description: ''
            },
            loading: false,
            messages: []
        }
    },

    methods: {
        createTask: function() {
            this.loading = true;
            var that = this;
            this.$http.post('tasks', this.task).then(function(response) {
                that.task.title = '';
                that.task.description = '';
                that.messages = [ {type: 'success', message: 'Task created successfully.' }];
                that.loading = false;
            }, function(response) {
                that.loading = false;
                errorHandler.handleFailedResponse(response, this);
            });
        }
    }
}
</script>