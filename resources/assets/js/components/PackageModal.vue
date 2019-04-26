<template> 
  <div class="modal is-active">
    <div class="modal-background"></div>
    <div class="modal-card modal_body">
      <header class="modal-card-head">
        <p class="modal-card-title">Csomag kivalasztasa</p>
        <button class="delete" aria-label="close" @click="$emit('close')"></button>
      </header>
      <section class="modal-card-body">
        <p class="loading" v-bind:class="{loadingstyle:loadingstyle}">Csomagok betoltese</p>
        <package v-bind:packages="packages" v-on:close="close($event)"></package>
      </section>
    </div>
  </div>
</template>

<script>
  import Package from './Package'

  export default ({
    props:{
      
    },
    data() {
      return {
          packages: [],
          showModal: false,
          loadingstyle: false,
          selected_package_id: 0,
        }
      },
      created() {
        this.getPackages();
      },
      components: {
        package: Package,
      },
      methods: {
        getPackages() {
          axios.get('./api/allpackage').then(response => {
            this.packages = response.data;
            this.loadingstyle = true;
          }).catch(function (error) {
              console.log(error);
            });
        },
        close(close){
          this.selected_package_id = close
          this.$emit('close',this.selected_package_id);
        }
      },
  });
  
</script>

<style>
  .modal{
    font-family: 'Oswald', sans-serif;
    color: black;
  }
  .modal_body{
    width: 100%;
    height: 28em;
  }
  .modal-card-body{
    text-align: center;
  }
  .loading{
    position: absolute;
    font-size: 5em;
    width: 100%;
  }
  .loadingstyle.loading{
    display: none;
  }
</style>