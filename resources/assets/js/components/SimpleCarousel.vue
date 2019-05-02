<template>
<div id="slider">
	<transition-group tag="div" :name="transitionName" class="slides-group">
  	<div v-if="show" :key="current" class="slide" >
      <matchcard :card="Matches" :m="m" :n="n"></matchcard>
  	</div>
	</transition-group>
	<div class="carousel_nav carousel_prev icon is-medium" 
        aria-label="Previous slide" 
        @click="slide(-1);prevousSlide()"><i class="fas fa-chevron-right arrow_left fa-3x"></i>
	</div>
	<div class="carousel_nav carousel_next icon is-medium" 
        aria-label="Next slide" 
        @click="slide(1)"><i class="fas fa-chevron-right arrow_right fa-3x"></i>
	</div>
</div>
</template>

<script>
import MatchCard from './MatchCard'

export default {

  data() {
    return {
      itemsPerRow: 4,
      m: 0,
      n: 4,
      index: 0,
      current: 0,
      direction: 1,
      transitionName: "fade",
      show: false,
      slides: [],
      matches: [],
      keyCode: '',
      search: '',
      windowWidth: 0,
    }
  },
  props:{
    Matches: Array,
  },
  methods: {
    slide(dir) {
      this.direction = dir;
      dir === 1
        ? (this.transitionName = "slide-next")
        : (this.transitionName = "slide-prev");
      var len = this.Matches.length;
      this.current = (this.current + dir % len + len) % len;
      this.nextSlide();
    },
    
    nextSlide() {
      this.m = this.m + this.itemsPerRow
      this.n = this.n + this.itemsPerRow
      if(this.m > (this.articleGroups.length * this.itemsPerRow) - this.itemsPerRow || this.n > this.articleGroups.length * this.itemsPerRow){
        this.m = this.itemsPerRow - this.itemsPerRow
        this.n = this.itemsPerRow
      }
    },
    prevousSlide() {
      this.m -= this.itemsPerRow
      this.n -= this.itemsPerRow
      if(this.m < 0 || this.n < 0){
        this.m = (this.articleGroups.length * this.itemsPerRow) - this.itemsPerRow
        this.n = this.articleGroups.length * this.itemsPerRow
      }
    },
    getWindowWidth(event) {
      this.windowWidth = document.documentElement.clientWidth;
      console.log(this.windowWidth);
      if(this.windowWidth < 1175){
        this.itemsPerRow = 3
        this.n = 3
        this.current = 1
      }
      if(this.windowWidth < 970){
        this.itemsPerRow = 2
        this.n = 2
        this.current = 1
      }
      if(this.windowWidth < 630){
        this.itemsPerRow = 1
        this.n = 1
        this.current = 1
      }
      if(this.windowWidth > 1175) {
        this.itemsPerRow = 4
        this.n = 4
        this.current = 1
      }
    },
  },
  components: {
    matchcard: MatchCard,
  },
  mounted() {
    this.show = true;
    this.$nextTick(function() {
      window.addEventListener('resize', this.getWindowWidth);
      this.getWindowWidth()
    })
  },
  computed: {
    articleGroups() {
      return Array.from(Array(Math.ceil(this.Matches.length / this.itemsPerRow)).keys())
    },
    
  },
  beforeDestroy() {
    window.removeEventListener('resize', this.getWindowWidth);
  },
  
}


</script>

<style>
@import url("https://fonts.googleapis.com/css?family=Crimson+Text");

/* FADE IN */
.fade-enter-active {
  transition: opacity 1s;
}
.fade-enter {
  opacity: 0;
}

/* GO TO NEXT SLIDE */
.slide-next-enter-active,
.slide-next-leave-active {
  transition: transform 0.5s ease-in-out;
}
.slide-next-enter {
  transform: translate(100%);
}
.slide-next-leave-to {
  transform: translate(-100%);
}

/* GO TO PREVIOUS SLIDE */
.slide-prev-enter-active,
.slide-prev-leave-active {
  transition: transform 0.5s ease-in-out;
}
.slide-prev-enter {
  transform: translate(-100%);
}
.slide-prev-leave-to {
  transform: translate(100%);
}

/* SLIDER STYLES */


#slider {
  width: 100%;
  position: relative;
}

.slide {
  width: 100%;
  position: absolute;
  top: 0;
  left: 0;
  display: flex;
  align-items: center;
  justify-content: center;
}

.carousel_nav{
    position:absolute;
    top: 50%;
    margin-top: 185px; 
    left: -10px;
    width: 63px;
    height: 63px;
  }

  .carousel_nav.carousel_next{
    right: 2px;
    left: auto;
  }

  .arrow_left{
    transform: rotate(180deg);
  }
</style>