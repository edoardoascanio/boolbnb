<template>
<div>
        <div class="row">
            <div v-show="images.length > 1" class="col-1" @click="change(-1)">prima</div>
            <div class="col-10">
                <img :src="images[activeImg]" alt="" style="width: 100%; height: 300px; object-fit: cover">
            </div>
            <div v-show="images.length > 1" class="col-1" @click="change(1)">dopo</div>
        </div>
        <!-- <div v-else>
            <div>
                <img :src="asset('storage/placeholder/house-placeholder.jpeg')" alt="" style="width: 100%; height: 300px; object-fit: cover">
            </div>
        </div> -->
</div>    
</template>

<script>
export default {
    name: "SliderImages",
    props:  {
        id: Number,
    }, 
    data(){
        return {
            images: [],
            activeImg: 0,
            id: this.id,
        }
    },
    methods: {
        getImages() {
            axios.get("http://127.0.0.1:8000/api/images/" + this.id) 
            .then(resp => {
                this.images = resp.data.results;
            })
        },
        change(x) {
            if(x < 0) {
                this.activeImg--
                if(this.activeImg < 0) {
                    this.activeImg = (this.images.length - 1)
                }
            }
            if(x > 0) {
                this.activeImg++
                if(this.activeImg > this.images.length - 1) {
                    this.activeImg = 0
                }
            }

        }
    },
    mounted() {
        this.getImages()
    }
       
}
</script>
