<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Kids Stories') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Kids Stories') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>


    <script>
        var react = async function(event) {
            event.preventDefault();
            var text = event.target.textContent;
            //console.log(text)
            var storyId = event.target.dataset.storyId;
            // var action = event.target.textContent;
            // toggleButtonText[action](event.target);
            // updateStoryStats[action](storyId);
            if (text === "Like") {
                console.log(1)
                const action = await axios.post('/api/v1/stories/' + storyId + '/reactions/like', {
                    action: text
                });
                console.log(action)
            } else {
                const action = await axios.post('/stories/' + storyId + '/reactions/dislike', {
                    action: text
                });
            }

            // axios({
            //         method: 'post',
            //         url: '/stories/' + storyId + '/reactions/like',
            //         data: {

            //         }
            //     })
            //     .then(data => {
            //         console.log(data)
            //     })
        };
    </script>

    <!-- <script src="https://js.pusher.com/4.4/pusher.min.js"></script>
    <script>
        var updateStoryStats = {
            Like: function(storyId) {
                document.querySelector('#likes-count-' + storyId).textContent++;
            },

            Unlike: function(storyId) {
                document.querySelector('#likes-count-' + storyId).textContent--;
            }
        };


        var toggleButtonText = {
            Like: function(button) {
                button.textContent = "Unlike";
            },

            Unlike: function(button) {
                button.textContent = "Like";
            }
        };

        var react = async function(event) {
            var storyId = event.target.dataset.storyId;
            var action = event.target.textContent;
            toggleButtonText[action](event.target);
            updateStoryStats[action](storyId);
            const like = await axios.post('/api/v1/stories/' + storyId + '/reactions/like', {
                action: action
            })
            if (like.data[0] === "Like") {
                Pusher.logToConsole = true;
                var pusher = new Pusher('bee56cb980ad4cfa9679', {
                    cluster: 'eu',
                    forceTLS: false
                });

                var channel = pusher.subscribe('KidsStories-development');
                channel.bind('Reaction', function(data) {
                    console.log(1);
                    console.log(data)
                    alert(JSON.stringify(data));
                });
            }
            //         .then(data => {

            //         });
        };


        // var pusher = new Pusher('bee56cb980ad4cfa9679', {
        //     cluster: 'eu',
        //     forceTLS: true
        // });

        // var channel = pusher.subscribe('KidsStories-development');
        // channel.bind('Reaction', function(data) {
        //     console.log(1)
        //     alert(JSON.stringify(data));
        // });

        // Echo.channel('KidsStories-development')
        //     .listen('Reaction', function(event) {
        //         console.log(1);
        //         var action = event.action;
        //         updateStoryStats[action](event.storyId);
        //     })
    </script> -->
</body>

</html>
