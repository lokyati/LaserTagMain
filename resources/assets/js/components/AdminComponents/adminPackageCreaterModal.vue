<template> 
  <div class="modal is-active">
    <div class="modal-background"></div>
    <div class="modal-card modal_body">
      <header class="modal-card-head">
        <p class="modal-card-title">Csomag létrehozása</p>
      </header>
      <section class="modal-card-body">
        <div class="field form_container">
          <label class="label left_label">Csomag neve</label>
          <div class="control">
            <input class="input" type="text" v-model="newpackagename">
          </div>

          <label class="label left_label">Csomag ára</label>
          <div class="control">
            <input class="input" type="number" v-model="newprice" min="0">
          </div>

          <label class="label left_label">Meccsek hossza</label> 
          <div class="control">
            <input class="input" type="number" v-model="newlength" min="0">
          </div>
          <label class="label left_label">Meccsek száma</label> 
          <div class="control">
            <input class="input" type="number" v-model="newmatchnumber" min="0">
          </div>
          <label class="label left_label">Teljes idő (óra)</label> 
          <div class="control">
            <input class="input" type="number" v-model="newtotaltime" min="0">
          </div>
          <label class="label left_label">Leirás</label> 
          <div class="control desc">
            <textarea class="textarea" rows="5" v-model="newdesc"></textarea>
          </div>
          <a class="button is-success is-medium save_btn" @click="save">Mentés</a>
          <a class="button is-danger is-medium cancel_btn" @click="$emit('closeCreater')">Mégse</a>
        </div>
      </section>
    </div>
  </div>
</template>

<script>
  

  export default ({
    data() {
      return {
          showModal: false,
          newpackagename: '',
          newprice: 0,
          newlength: 0,
          newmatchnumber: 0,
          newtotaltime: 0,
          newdesc: '',
          newpopularity: 1,
        }
      },
      props: {
        pckgID: Number,
      },
      created() {
      },
      components: {
      },
      computed:{
        
      },
      methods: {
        closeCreater(){
          this.$emit('closeCreater');
        },
        save(){
            axios.post('../PckgCreate',{
              package_name: this.newpackagename,
              price: this.newprice,
              match_length: this.newlength,
              match_number: this.newmatchnumber,
              total_time: this.newtotaltime,
              description: this.newdesc,
              popularity: this.newpopularity,
            }).catch(error => {
                console.log(error);
              });
            this.$emit('closeCreater');
          },
      },
  });
  
</script>

<style>
  .modal{
    font-family: 'Oswald', sans-serif;
    color: black;
  }
  .modal_body{
    width: 21em;
    height: 35em;
  }
  .modal-card-body{
    text-align: center;
  }
  .form_container{
    width: 18em;
    margin-bottom: 0 auto;
  }
  .left_label{
    float: left;
  }
  .desc{
    margin-bottom: 60px;
  }
  .save_btn{
    margin-right: 3em;
  }
  .err_msg{
    color: red;
  }
  .prefix{
    height: 2.3em !important;
  }
</style>