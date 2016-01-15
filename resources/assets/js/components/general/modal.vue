<template>
    <div class="modal fade" id="{{ id }}" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title custom_align" id="Heading">{{ heading }}</h4>
                </div>
                <div class="modal-body">
                    {{ body }}
                </div>
                <div class="modal-footer">
                    <button type="button" @click="approve" data-dismiss="modal" class="btn btn-sm btn-danger" ><span class="glyphicon glyphicon-ok-sign"></span> {{ approveButtonText }}</button>
                    <button type="button" data-dismiss="modal" @click="deny" class="btn btn-sm btn-primary" ><span class="glyphicon glyphicon-remove"></span> {{ denyButtonText }}</button>
                </div>
            </div> 
        </div>
    </div>
</template>

<script>
module.exports = {
    props: {
        id: {
            type: String,
            required: true
        },
        heading: {
            type: String,
            required: true
        },
        body: {
            type: String,
            required: true
        },
        approveButtonText: {
            type: String,
            default: 'Ok'
        },
        denyButtonText: {
            type: String,
            default: 'Cancel'
        }
    },
    methods: {
        approve: function() {
            this.$dispatch('modalWasApproved');
        },
        deny: function() {
            this.$dispatch('modalWasDenied');
        }
    }
};
</script>