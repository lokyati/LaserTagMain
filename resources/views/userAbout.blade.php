<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>LaserTag</title>

    <!-- Scripts--> 
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <!--dns-prefetch: It is a way to speed up web pages by pre-resolving DNS. -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Oswald:400,500&amp;subset=latin-ext" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css">
    <link rel="stylesheet" href="https://unpkg.com/buefy/dist/buefy.min.css">
    <link href="{{ asset('css/about_style.css') }}" rel="stylesheet">

</head>
<body>
    <div class="navbar_container">
        <div class="navbar-brand">
            LaserTag
        </div>
        <div class="navbar-end">
            <ul>
              <li><a href="{{  URL::to('home')  }}">Profil</a></li>
              <li><a class="is-on" href="{{  URL::to('about')  }}">Rólunk/Kapcsolat</a></li>
              <li>
                  <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    Kijelentkezés
                  </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
              </li>
            </ul> 
        </div>
    </div>
    <div class="about_contacts_container">
        <div class="columns about_container">
            <div class="column is-one-third is-marginless">
                <img class="about_img" src="{{ URL::asset('img/laser.jpg') }}">
            </div>
            <div class="column about_text is-marginless">
                <p>A lézerharc egy olyan lézerfegyverrel játszott csapatjáték, amely nem okoz fizikai
                sérülést, viszont látványos és igénybe veszi az ember reflexeit. A játékban két csapat méri
                össze ügyességét, egy erre a célra kialakított, több száz négyzetméteres fedett pályán.
                Minden játékos el van látva egy lézerfegyverrel és egy mellénnyel. Ha a 6 drb. találati pont
                közül valamelyik találatot kap, a játékos 5 másodpercig nem tud lőni és találatot sem
                kaphat. Amint ez az idő lejárt, újra játékba kerül. A lézer fénye a szemre nem káros és
                „diszkófüstben”   tökéletesen  látható.  A  mérkőzést   követően   mindenki   kap   egy
                kiértékelést, amiből kiderül, hogy melyik csapat nyert, és mindenki láthatja a statisztikáit.</p>
            </div>
        </div>
        <div class="contacts_container">
            <p class="title is-2">Kapcsolat</p>
            <p class="subtitle is-8">E-mail: <a href="mailto:lasertag@gmail.com">lasertag@gmail.com</a></p>
            <p class="subtitle is-8">Telefon: <a href="callto://+758421598">0758421598</a></p>
        </div>
    </div>
</body>
<footer id="footer">
 <div class="columns">
        <div class="column is-one-third">
            <p class="subtitle is-8 has-text-white">Cimünk</p>
            <p class="subtitle is-8 has-text-white">Csíkszereda, Hargita megye, Szabadság tér, 1. szám, 530104</p>
            <gdprmodal v-if="showModal" @close="showModal = false"></gdprmodal>
            <p class="subtitle is-8 has-text-white"><a @click="showModal = true">Adatvédelmi tájékoztató</a></p>
            <p class="subtitle is-8 has-text-white">© 2019 LaserTag</p>
        </div>
        <div class="column">
            <p class="subtitle is-8 has-text-white">Keress minket a közösségi oldalakon is</p>
            <div class="icon_container">
              <div class="facebook_icon"></div>
              <div class="twitter_icon"></div>
              <div class="instagram_icon"></div>
            </div>
        </div>
        <div class="column">
            <p class="subtitle is-8 has-text-white">Navigácó</p>
            <p class="subtitle is-8 has-text-white"><a href="{{  URL::to('home')  }}">Profil</a></p>
            <p class="subtitle is-8 has-text-white"><a href="{{  URL::to('about')  }}">Rólunk/Kapcsolat</a></p>
            <!--<p class="subtitle is-8 has-text-white"><a class="admin_button" href="{{ route('admin.login') }}">Admin belépés</a></p>-->
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                Kijelentkezés
              </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
</footer>
</html>