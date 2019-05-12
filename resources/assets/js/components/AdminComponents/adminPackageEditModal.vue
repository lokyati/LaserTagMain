<template> 
  <div class="modal is-active">
    <div class="modal-background"></div>
    <div class="modal-card modal_body">
      <header class="modal-card-head">
        <p class="modal-card-title">Csomag frissitése</p>
      </header>
      <section class="modal-card-body">
        <div class="field form_container">
          <label class="label left_label">Csomag neve</label>
          <div class="control">
            <input class="input" type="text" v-model="newpackagename">
          </div>

          <label class="label left_label">Csomag ára</label>
          <div class="control">
            <input class="input" type="text" v-model="newprice">
          </div>

          <label class="label left_label">Meccsek hossza</label> 
          <div class="control">
            <input class="input" type="text" v-model="newlength">
          </div>
          <label class="label left_label">Meccsek száma</label> 
          <div class="control">
            <input class="input" type="text" v-model="newmatchnumber">
          </div>
          <label class="label left_label">Teljes idő</label> 
          <div class="control">
            <input class="input" type="text" v-model="newtotaltime">
          </div>
          <label class="label left_label">Leirás</label> 
          <div class="control desc">
            <textarea class="textarea" rows="5" v-model="newdesc"></textarea>
          </div>
          <a class="button is-success is-medium save_btn" @click="edit">Mentés</a>
          <a class="button is-danger is-medium cancel_btn" @click="$emit('closeEditor')">Mégse</a>
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
          selected_package_id: 0,
          newpackagename: '',
          newprice: 0,
          newlength: 0,
          newmatchnumber: 0,
          newtotaltime: 0,
          newdesc: '',
        }
      },
      props: {
        pckgID: Number,
      },
      created() {
        this.getPackage();
      },
      components: {
      },
      computed:{
        
      },
      methods: {
        getPackage() {
          axios.get('../package/' + this.pckgID).then(response => {
            this.package = response.data;
            this.newpackagename = this.package.package_name;
            this.newprice = this.package.price;
            this.newlength = this.package.match_length;
            this.newmatchnumber = this.package.match_number;
            this.newtotaltime = this.package.total_time;
            this.newdesc = this.package.description;

          }).catch(function (error) {
              console.log(error);
            });
        },
        closeEditor(){
          this.$emit('closeEditor');
        },
        edit(){
            axios.post('../PckgUpdate/' + this.pckgID,{
              package_name: this.newpackagename,
              price: this.newprice,
              match_length: this.newlength,
              match_number: this.newmatchnumber,
              total_time: this.newtotaltime,
              description: this.newdesc,
            });
            this.$emit('closeEditor');
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