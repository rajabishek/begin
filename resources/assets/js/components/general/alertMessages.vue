<template>
    <div id="{{id}}" v-if="messages.length">
        <alert v-for="message in messages" :type="message.type" :dismissable="!message.shouldNotBeDismissible">{{ message.message }}</alert>
    </div>
</template>

<script>
module.exports = {
    props: {
        id: {
            type: String,
            default: 'alert-messages'
        },
        messages: {
            type: Array,
            required: true
        }
    }
};
</script>