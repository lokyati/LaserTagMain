<template> 
  <div class="modal is-active">
    <div class="modal-background"></div>
    <div class="modal-card modal_body_editor">
      <header class="modal-card-head">
        <p class="modal-card-title">Profil adatok frissitese</p>
      </header>
      <section class="modal-card-body">
        <p class="err_msg">{{err_msg}}</p>
        <div class="field form_container">
          <label class="label left_label">Vezeteknév</label>
          <div class="control">
            <input class="input" type="text" v-model="newlastn">
          </div>

          <label class="label left_label">Keresztnév</label>
          <div class="control">
            <input class="input" type="text" v-model="newfirstn">
          </div>

          <label class="label left_label">Telefonszám</label> 
          <div class="control tel">
            <span class="tag is-primary is-medium prefix">+40</span>
            <input class="input" type="text" v-model="newtel">
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
    props:{
      userID: Number,
    },
    data() {
      return {
          userData: [],
          showModal: false,
          selected_package_id: 0,
          newlastn: '',
          newfirstn: '',
          newtel: '',
          err_msg: '',
          notnumber: true,
          notstring: true,
          numbers: '1234567890',
          strings: 'aábcdeéfghijklmnoóőpqrstuúűvwxyz',
        }
      },
      created() {
        this.getUserData();
      },
      components: {
      },
      computed:{
        
      },
      methods: {
        getUserData() {
          axios.get('profile').then(response => {
            this.userData = response.data;
            this.newlastn = this.userData.lastname;
            this.newfirstn = this.userData.firstname;
            this.newtel = this.userData.tel;
          });
        },
        closeEditor(){
          this.$emit('closeEditor');
        },
        checkStringForNumbers(newlastn,newfirstn){
          let strlast = String(newlastn);
          let strfrst = String(newfirstn);
          let nmbrs = String(this.numbers);
          for( let i = 0; i < strlast.length; i++){
            for (let x = 0; x < nmbrs.length; x++){
              if(nmbrs[x] === strlast[i]){
                this.notnumber = false;
              }
            }
          }

          for( let i = 0; i < strfrst.length; i++){
            for (let x = 0; x < nmbrs.length; x++){
              if(nmbrs[x] == strfrst[i]){
                this.notnumber = false;
              }
            }
          }
        },
        checkNumberForStrings(newtel){
          let tel = String(newtel);
          let strs = String(this.strings);
          for( let i = 0; i < tel.length; i++){
            for (let x = 0; x < strs.length; x++){
              if(strs[x] == tel[i]){
                this.notstring = false;
              }
            }
          }
        },
        edit(){
            this.checkStringForNumbers(this.newlastn,this.newfirstn);
            this.checkNumberForStrings(this.newtel);
            if(this.notnumber == true && this.notstring == true && this.newtel.length == 9){
            axios.post('./ProfileUpdate/' + this.userID,{
              firstname: this.newfirstn,
              lastname: this.newlastn,
              tel: this.newtel,
            });
            this.$emit('closeEditor');
            this.err_msg = '';
          }else{
            console.log('error');
            this.notnumber = true;
            this.notstring = true;
            this.err_msg = "A begépelt adatok helytelenek. Ügyelj arra, hogy a név ne teartalmazzon számokat és a telefonszám ne tartalmazzon betűket. Továbbá a telefonszámnál 9 számjegy szerepeljen.";
          }
        },
      },
  });
  
</script>

<style>
  .modal{
    font-family: 'Oswald', sans-serif;
    color: black;
  }
  .modal_body_editor{
    width: 20em;
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
  .tel{
    margin-bottom: 60px;
    width: 100%;
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