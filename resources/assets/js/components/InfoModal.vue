<template> 
  <div class="modal is-active">
    <div class="modal-background"></div>
    <div class="modal-card">
      <header class="modal-card-head">
        <p class="modal-card-title">Kedves látogató!</p>
        <button class="delete" aria-label="close" @click="$emit('close')"></button>
      </header>
      <section class="modal-card-body">
        <p class="title">Üdvözlünk a LaserTag oldalán!</p>
        <p class="subtitle">Az oldal használata regisztrációhoz kötött. A létrehozott profilod segitségével, könnyedén foglalhatsz időpontot a termünkben magad és barátaid számára. A játékban szerzett tapasztalati pontjaidat és statisztikáidat a profilodban követheted nyomon, és ezeknek megfelelően kapott bónusz pontjaidat elköltheted kedvezményes foglalásokra. Termünket akár 50%-os kedvezménnyel is lefoglalhatod.
        Csatlakozz bátran!</p>
      </section>
      <footer class="modal-card-foot">
        <button class="button is-success" @click="$emit('close')">Értettem</button>
      </footer>
    </div>
  </div>
</template>

<script>
  new Vue({
    el:'#header',

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