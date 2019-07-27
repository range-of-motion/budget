<template>
    <div class="validation_error mt-05">{{ $t('messages') . message }}</div>
</template>

<script>
    export default {
        props: ['message']
    }
</script>
