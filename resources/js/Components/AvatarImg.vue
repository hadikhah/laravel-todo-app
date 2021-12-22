<template>
    <img :class="`inline  w-${size?size:'10'} h-${size?size:'10'} mr-2 rounded-full`" :src="src" :alt="alt">
</template>

<script>
export default {
    name: "AvatarImg",
    props: {
        src: String,
        alt: String,
        size: Number,
    }
}
</script>

<style scoped>

</style>
