<template> 
  <div id="fail" class="modal is-active">
    <div class="modal-background"></div>
    <div class="modal-card">
      <header class="modal-card-head has-text-danger">
        <p class="modal-card-title has-text-danger">Sikertelen foglalas</p>
      </header>
      <section class="modal-card-body">
        A foglalas meghiusult: {{ message }}
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
      fail: Boolean,
      message: String,
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