<template>
    <vue-slider v-bind="options" v-model="allocation" ></vue-slider>
</template>
<script>

import vueSlider from 'vue-slider-component';
export default {
    name:"simulationItem",
    props:{
        options:{},
        item:{
            required:true,
            default:null
        }
    },
    components:{
        'vue-slider':vueSlider
    },
    data() {
        return {
            allocation:0
        }
    },
    watch:{
        allocation(newVal, oldVal) {
            this.$emit('update',newVal);
            console.log(newVal)
        }
    },
    mounted() {
        this.allocation = this.item;
        console.log('simulator item'+this.allocation);
    }
}
</script>
