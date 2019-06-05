<template> 
  <div class="modal is-active">
    <div class="modal-background"></div>
    <div class="modal-card modal_body">
      <header class="modal-card-head">
        <p class="modal-card-title">Biztos törölni akarod ezt a csomagot?</p>
      </header>
      <section class="modal-card-body">
        <div class="field form_container">
          <label class="label left_label">Csomag neve: </label>
          <label class="label left_label">{{pckgName}}</label>
          <a class="button is-success is-medium delete_btn" @click="deletePckg">Törlés</a>
          <a class="button is-danger is-medium cancel_btn" @click="$emit('closeDeleter')">Mégse</a>
        </div>
      </section>
    </div>
  </div>
</template>

<script>
  

  export default ({
    data() {
      return {
          package: [],
          showModal: false,
        }
      },
      props: {
        pckgID: Number,
        pckgName: String,
      },
      created() {
      },
      components: {
      },
      computed:{
        
      },
      methods: {
        closeDeleter(){
          this.$emit('closeDeleter');
        },
        deletePckg(){
            axios.delete('../PckgDelete/' + this.pckgID,{
            });
            this.$emit('closeDeleter');
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
    width: 42em;
    height: 10em;
  }
  .modal-card-body{
    text-align: center;
  }
  .form_container{
    width: 40em;
    margin-bottom: 0 auto;
  }
  .left_label{
    float: left;
  }
  .desc{
    margin-bottom: 60px;
  }
  .delete_btn{
    margin-right: 3em;
  }
  .err_msg{
    color: red;
  }
  .prefix{
    height: 2.3em !important;
  }
</style>