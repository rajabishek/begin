<template>
	<button class="btn btn-{{size}} btn-{{type}}" type="submit"><i :class="{'fa': loading, 'fa-spinner': loading, 'fa-spin': loading}"></i> <slot></slot></button>
</template>

<script>
module.exports = {
    props: {
    	loading: {
            type: Boolean,
            required: true
        },
        size: {
            type: String,
            required: true
        },
        type: {
            type: String,
            required: true
        }
    }
};
</script>