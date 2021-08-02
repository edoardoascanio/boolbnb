<template>
    <div>
        <div class="row mt-4 mb-4">
            <div class="arrow left-arrow">
                <div v-show="images.length > 1" class="container-chevron" @click="change(-1)">
                    <i class="fas fa-chevron-left"></i>
                </div>
            </div>
            <div class="col-12 col-md-10 box-height">
                <img :src="images[activeImg]" alt="">
            </div>
            <div class="arrow right-arrow">
                <div v-show="images.length > 1" class="container-chevron" @click="change(1)">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </div>
        </div>
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
