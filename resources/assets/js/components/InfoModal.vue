<template> 
  <div class="modal is-active">
    <div class="modal-background"></div>
    <div class="modal-card">
      <header class="modal-card-head">
        <p class="modal-card-title">Bővebb információk</p>
        <button class="delete" aria-label="close" @click="$emit('close')"></button>
      </header>
      <section class="modal-card-body">
        Bővebb információk...
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt aliquid eos eum at repudiandae eius reiciendis nobis provident ab incidunt dolorem quae assumenda quasi modi quisquam iusto, amet fugit dolores?
      </section>
      <footer class="modal-card-foot">
        <button class="button is-success" @click="$emit('close')">Értettem</button>
      </footer>
    </div>
  </div>
</template>

<script>
  new Vue({
    el:'#info',

    data: {
      showModal:false
    }
  });
  
</script>

<style>
  .modal{
    font-family: 'Oswald', sans-serif;
    color: black;
  }
</style>