<template>
	<div :class="{ 'sk-spinner': true, 'sk-spinner-pulse': type === 'pulse' }" v-show="show"></div>
</template>

<script>
module.exports = {
    props: {
    	type: {
            type: String,
            required: true
        },
        show: {
            type: Boolean,
            required: true
        }
    }
};
</script>