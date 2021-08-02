<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Subscriba</title>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/app.css">
    <link rel="icon" href="img/favicon.png"/>
    <link href="css/style.css" rel="stylesheet" type="text/css"/>
    <script src="js/app.js" defer></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body> 
    <header class="header-content subcriba-bx-shadow1">
        <div class="container d-flex"> 
            <div class="logo-container">
                <a href="/">
                    <img src="/img/logo.png" alt="Subscriba Logo" >
                </a>
            </div> 
            <div class="nav-menu"> 
                <div class="menu-btn"> 
                    <div>
                        <a class="btn btn-primary" href="/api_key">
                            Store API Key
                        </a>
                        <a href="/subscribers" class="btn btn-primary">
                            View Subscribers
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div id="app"></div>
</body>
</html>