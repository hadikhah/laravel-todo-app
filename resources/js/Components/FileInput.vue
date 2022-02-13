<template>
    <label class="inline-block m-2 text-gray-500">{{ label }}</label>
    <div class="max-w-2xl  rounded-xl border-gray-300">
        <div class=" p-4">
            <div class="flex items-center  ">
                <label
                    class=" w-32 h-32 flex flex-col bg-gray-500  rounded-full border-4 border-blue-200 border-dashed hover:bg-gray-400 hover:border-gray-300 cursor-pointer">
                    <img class="rounded-full w-52 max-h-52 h-52 hover:bg-sky-700 opacity-50" v-if="image" :src='image'
                         ref="image"
                         :alt="label">
                    <div class="rounded-full flex flex-col absolute items-center  justify-center w-32 h-32">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-8 h-8 rounded-full text-white group-hover:text-gray-600"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                        </svg>

                    </div>
                    <input hidden type="file" class="opacity-0" @change="onFileUpload($event)" :accept="accept"/>
                </label>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "FileInput",
    props: {
        accept: String,
        label: String,
        preview: String
    },
    data() {
        return {
            image: this.$props.preview
        }
    },
    methods: {
        onFileUpload(event) {
            let reader = new FileReader();
            reader.readAsDataURL(event.target.files[0]);
            reader.onload = () => {
                this.image = reader.result
            };

            this.$emit('update:modelValue', event.target.files[0]);
        }
    },

}
</script>

<style scoped>

</style>
