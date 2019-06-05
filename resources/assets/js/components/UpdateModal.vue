<template> 
  <div class="modal is-active">
    <div class="modal-background"></div>
    <div class="modal-card modal_body">
      <header class="modal-card-head">
        <p class="modal-card-title">Legutóbb játszott meccseid eredményei</p>
      </header>
      <section class="modal-card-body">
        <div class="unprocessed_container" v-for="unprc in unprocessed">
          <div class="unprocessed_header_win" v-if="unprc.result == 'Győzelem'">
            {{unprc.result}}
          </div>
          <div class="unprocessed_header_lose" v-else>
            {{unprc.result}}
          </div>
          <div class="unprocessed_content">
            <div class="data_container">
              <div class="data_header">
                <p>Helyezés</p>
              </div>
              <div class="data_content">
                {{unprc.placed}}
              </div>
            </div>
            <div class="data_container">
              <div class="data_header">
                <p>Pontszám/Tapasztalat</p>
              </div>
              <div class="data_content">
                {{unprc.score}}
              </div>
            </div>
            <div class="data_container">
              <div class="data_header">
                <p>Leadott lövések</p>
              </div>
              <div class="data_content">
                {{unprc.all_shot}}
              </div>
            </div>
            <div class="data_container">
              <div class="data_header">
                <p>Találatok</p>
              </div>
              <div class="data_content">
                {{unprc.all_hit}}
              </div>
            </div>
            <div class="data_container">
              <div class="data_header">
                <p>Pontoság</p>
              </div>
              <div class="data_content">
                {{unprc.acc}}%
              </div>
            </div>
            <div class="data_container">
              <div class="data_header">
                <p>Kiesések</p>
              </div>
              <div class="data_content">
                {{unprc.all_out}}
              </div>
            </div>
            <div class="data_container">
              <div class="data_header">
                <p>Szerzett bónusz</p>
              </div>
              <div class="data_content">
                {{unprc.bonus}}
              </div>
            </div>
            <div class="data_container">
              <div class="data_header">
                <p>Dátum</p>
              </div>
              <div class="data_content">
                {{unprc.match_date}}
              </div>
            </div>
          </div>
        </div>
      </section>
      <footer class="modal-card-foot">
        <button class="button is-success" @click="getUserStat">Értettem</button>
      </footer>
    </div>
  </div>
</template>

<script>
  

  export default ({
    props:{
      userID: Number,
      unprocessed: Array,
    },
    data() {
      return {
          userData: [],
          userStat: [],
          matches: [],
          unprocessedSafe:[],
          showModal: false,
          avgshot: 0,
          avghit: 0,
          avgacc: 0,
          bestplace: 100,
          remainxp: 0,
          lvl: 1,
          oldshots: 0,
          oldhits: 0,
          oldout: 0,
          oldmatches: 0,
          oldwins: 0,
          oldloses: 0,
          oldbestplace: 0,
          oldavg_shot: 0,
          oldavg_hit: 0,
          oldavg_acc: 0,
          oldlvl: 0,
          oldexperience: 0,
          processed: 1,
          bonus: 0,
        }
      },
      created() {
      },
      components: {
      },
      computed:{
        
      },
      methods: {
        getUserStat(){
          axios.get('./userstat/' + this.userID).then(response => {
            this.userStat = response.data;
          });
          axios.get('./api/profile').then(response => {
            this.userData = response.data;
          }).then(response => {
              this.safeUnprocessed();
            }).catch(function (error) {
              console.log(error);
            });
        },
        safeUnprocessed(){
          axios.get('./matches/' + this.userID).then(response => {
              this.matches = response.data;
              this.unprocessedSafe = [];
              console.log("unprocessedSafe");
              for(let i = 0; i < this.matches.length; i++){
                if(this.matches[i].processed == 0){
                  this.unprocessedSafe.push(this.matches[i]);
                }
              }
            }).then(response => {
              this.updateUserStat();
            }).catch(function (error) {
              console.log(error);
            });

        },
        updateUserStat(){

          for(let i = 0; i < this.userStat.length; i++){
            this.oldshots = this.userStat[0].all_shot
            this.oldhits = this.userStat[0].all_hit
            this.oldout = this.userStat[0].all_out
            this.oldmatches = this.userStat[0].matches
            this.oldwins = this.userStat[0].wins
            this.oldloses = this.userStat[0].loses
            this.oldbestplace = this.userStat[0].bestplace
            this.oldavg_shot = this.userStat[0].avg_shot
            this.oldavg_hit = this.userStat[0].avg_hit
            this.oldavg_acc = this.userStat[0].avg_acc
            this.oldlvl = this.userStat[0].lvl
            this.oldexperience = this.userStat[0].experience
            
          }
            this.oldbonus = this.userData.battle_points 

          for(let i = 0; i < this.unprocessedSafe.length; i++){
            this.oldmatches++
            console.log(this.oldmatches)
            if(this.unprocessedSafe[i].result == "Győzelem"){
              this.oldwins++
              this.bonus += 10
            }else if(this.unprocessedSafe[i].result == "Vereség"){
              this.oldloses++
              this.bonus += 5
            }
            this.oldshots += this.unprocessedSafe[i].all_shot
            this.oldhits += this.unprocessedSafe[i].all_hit
            this.oldexperience += this.unprocessedSafe[i].score
            this.bonus += this.unprocessedSafe[i].score
            this.bonus += this.unprocessedSafe[i].bonus
            this.oldout += this.unprocessedSafe[i].all_out
            if(this.unprocessedSafe[i].placed < this.oldbestplace || this.unprocessedSafe[i].placed > 0){
              this.oldbestplace = this.unprocessedSafe[i].placed
            }
            axios.post('./matchUpdate/' + this.unprocessedSafe[i].id,{
              processed: this.processed
            });
          }

            this.avgshot = parseFloat(this.oldshots/this.oldmatches).toFixed(1)
            this.avghit = parseFloat(this.oldhits/this.oldmatches).toFixed(1)
            this.avgacc = parseFloat((this.oldhits/this.oldshots)*100).toFixed(1)

            if(this.oldlvl == 33){
              this.oldexperience = 1000
              this.oldlvl = 33
            }else if(this.oldexperience >= 1000 && this.oldlvl < 33){
              this.remainxp = this.oldexperience - 1000
              this.oldexperience = this.remainxp
              this.oldlvl++
              this.$emit('lvlup',this.oldlvl)
            }
            
              
            this.oldbonus += this.bonus

            axios.post('./statUpdate/' + this.userID,{
              all_shot: this.oldshots,
              all_hit: this.oldhits,
              all_out: this.oldout,
              matches: this.oldmatches,
              wins: this.oldwins,
              loses: this.oldloses,
              bestplace: this.oldbestplace,
              avg_shot: this.avgshot,
              avg_hit: this.avghit,
              avg_acc: this.avgacc,
              experience: this.oldexperience,
              lvl: this.oldlvl,
            }).catch(function (error) {
              console.log(this.oldshots);
              console.log(this.oldhits);
              console.log(this.oldout);
              console.log(this.oldmatches);
              console.log(this.oldwins);
              console.log(this.oldloses);
              console.log(this.oldbestplace);
              console.log(this.avgshot);
              console.log(this.avghit);
              console.log(this.avgacc);
              console.log(this.oldexperience);
              console.log(this.oldlvl);
              console.log(error);
            });

            axios.post('./userBonusUpdate/' + this.userID,{
              battle_points: this.oldbonus,
            });

          this.$emit('closeUpdate');
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
    width: 75em;
    height: 35em;
  }
  .modal-card-body{
    text-align: center;
  }
  .unprocessed_container{
    width: 100%;
    height: 6em;
    border: 3px solid #0b1c5a;
    margin-bottom: .5em;
    background-color: #e1e1e1;
    font-size: 22px;
  }
  .unprocessed_header_win{
    width: 100%;
    text-align: left;
    color: green;
    font-size: 23px;
    text-align: left;
    padding: .3em;
  }
  .unprocessed_header_lose{
    width: 100%;
    text-align: left;
    color: red;
    font-size: 23px;
    text-align: left;
    padding: .3em;
  }
  .unprocessed_content{
    display: inline-flex;
    width: 100%;
    border-top: 3px solid #0b1c5a;
  }
  .data_container{
    width: 10em;
    border: 1px solid #0b1c5a;
    height: 3.4em;
  }
  .data_content{
    border-top: 1px solid #0b1c5a;
    height: 2.1em;
  }
</style>