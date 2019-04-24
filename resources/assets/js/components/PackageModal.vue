<template> 
  <div class="modal is-active">
    <div class="modal-background"></div>
    <div class="modal-card">
      <header class="modal-card-head">
        <p class="modal-card-title">Csomag kivalasztasa</p>
        <button class="delete" aria-label="close" @click="$emit('close')"></button>
      </header>
      <section class="modal-card-body">
        <package v-bind:packages="packages"></package>
      </section>
      <footer class="modal-card-foot">
        <button class="button is-success" @click="$emit('close')"> Kivalaszt</button>
      </footer>
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
          }).catch(function (error) {
              console.log(error);
            });
        },
      },
  });
  
</script>

<style>
  .modal{
    font-family: 'Oswald', sans-serif;
    color: black;
  }
  .modal-card{
    width: 100%;
  }
</style>