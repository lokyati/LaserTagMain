<template> 
  <div class="modal is-active">
    <div class="modal-background"></div>
    <div class="modal-card lvlup_modal_body">
      <header class="modal-card-head">
        <p class="modal-card-title">Gratulálok szintet léptél!</p>
      </header>
      <section class="modal-card-body">
        Új szinted: {{lvl}}
        <a class="button is-danger is-medium cancel_btn" @click="$emit('close')">Értettem</a>
      </section>
    </div>
  </div>
</template>

<script>
  

  export default ({
    props:{
      userID: Number,
      lvl: Number,
      oldrank: Number,
    },
    data() {
      return {
          
        }
      },
      created() {
        this.rankUp();
      },
      components: {
      },
      computed:{
        
      },
      methods: {
        rankUp(){
          if(this.lvl % 3 == 0){
              this.oldrank = this.oldrank + 1;
              console.log(this.oldrank);
              axios.post('./userRankUpdate/' + this.userID,{
                rank_id: this.oldrank
              });
            }
          },
        }
  });
  
</script>

<style>
  .modal{
    font-family: 'Oswald', sans-serif;
    color: black;
  }
  .lvlup_modal_body{
    width: 20em;
    height: 35em;
  }
  .modal-card-body{
    text-align: center;
  }
</style>