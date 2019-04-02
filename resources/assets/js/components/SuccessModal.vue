<template> 
  <div id="success" class="modal is-active">
    <div class="modal-background"></div>
    <div class="modal-card">
      <header class="modal-card-head">
        <p class="modal-card-title has-text-success">Sikeres foglalas</p>
      </header>
      <section class="modal-card-body">
        Gratulalok a foglalas sikeres! A foglalassal kapcsolatos informaciokat az email fiokodban talalod vagy a profilod "Foglalasaim" penupontja alatt.
      </section>
      <footer class="modal-card-foot">
        <button class="button is-success" @click="$emit('close')">Értettem</button>
      </footer>
    </div>
  </div>
</template>

<script>
  export default ({
    props:{
      success: Boolean,
    },
    data() {
      return {
        }
      },
  });
  
</script>

<style>
  .modal{
    font-family: 'Oswald', sans-serif;
    color: black;
  }
</style>