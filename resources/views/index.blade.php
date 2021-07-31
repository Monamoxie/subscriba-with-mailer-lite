<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Join the league with Subscriba</title>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="css/pr1.css" rel="stylesheet" type="text/css" />
    <link href="css/pr2.css" rel="stylesheet" type="text/css" /> 
    <link href="css/style.css" rel="stylesheet" type="text/css"/>
    <script src="{{ asset('js/app.js') }}" defer></script> 
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
</head>
<body> 
    <div class="c-navigation top-header-navigation mzp-is-sticky">
        <div class="c-navigation-l-content">
            <div class="c-navigation-container">
                <div class="c-navigation-logo">
                    <a href="/">
                        <img class="c-navigation-logo-image" src="https://www.mozilla.org/media/protocol/img/logos/mozilla/logo-word-hor.e20791bb4dd4.svg" alt="Mozilla" width="112" height="32">
                    </a>
                </div>

                <div class="c-navigation-items" id="c-navigation-items">

                    <div class="c-navigation-shoulder menu-btn"> 
                        <div class="mzp-c-button-download-container c-button-download-thanks">
                            <a class="btn btn-primary" href="/api_key">
                                Store API Key
                            </a>
                            <button class="btn btn-primary">
                                View Subscribers
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div id="app"></div>
    {{-- <script>
        var animateButton = function(e) {
            e.preventDefault;
            //reset animation
            e.target.classList.remove('animate');
            
            e.target.classList.add('animate');
            setTimeout(function(){
                e.target.classList.remove('animate');
            },700);
            };

            var bubblyButtons = document.getElementsByClassName("bubbly-button");

            for (var i = 0; i < bubblyButtons.length; i++) {
            bubblyButtons[i].addEventListener('click', animateButton, false);
        }
    </script> --}}
</body>
</html>

