<!doctype html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>US XMR Pool</title>

    <link href="https://fonts.googleapis.com/css?family=Inconsolata|PT+Mono|Ubuntu" rel="stylesheet" crossorigin="anonymous">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="/styles/site.css?v=0.4.3">
</head>

<body onload="onLoad()">
    <div id="app">
        <div class="navbar hide-sm">
            <router-link :to="{ name: 'home' }" tag="a" exact>Home</router-link>
            <router-link :to="{ name: 'faq' }" tag="a" exact>FAQ</router-link>
            <router-link :to="{ name: 'getting-started' }" tag="a" exact>Getting Started</router-link>
            <router-link :to="{ name: 'tutorials' }" tag="a" exact>Mining Tutorials</router-link>
            <router-link :to="{ name: 'blocks' }" tag="a" exact>Blocks</router-link>
            <router-link :to="{ name: 'payments' }" tag="a" exact>Payments</router-link>
            <router-link :to="{ name: 'dashboard' }" tag="a" exact>Miner Dashboard</router-link>
        </div>

        <div class="navbar-small show-sm">
            <div><i class="fa fa-bars fa-fw fa-2x" onclick="showHideMenu()"></i></div>
            <div id="mobileMenu" onclick="showHideMenu()">
                <router-link :to="{ name: 'home' }" tag="a" exact>Home</router-link>
                <router-link :to="{ name: 'faq' }" tag="a" exact>FAQ</router-link>
                <router-link :to="{ name: 'getting-started' }" tag="a" exact>Getting Started</router-link>
                <router-link :to="{ name: 'tutorials' }" tag="a" exact>Mining Tutorials</router-link>
                <router-link :to="{ name: 'blocks' }" tag="a" exact>Blocks</router-link>
                <router-link :to="{ name: 'payments' }" tag="a" exact>Payments</router-link>
                <router-link :to="{ name: 'dashboard' }" tag="a" exact>Miner Dashboard</router-link>
            </div>
        </div>

        <header>
            <div class="header-container">
                <h1>
                    US XMR Pool
                    <span>A Premier West Coast Monero Mining Pool</span>
                </h1>
            </div>
        </header>

        <router-view></router-view>

        <footer>
            <a target="_blank" href="https://github.com/clintar/cryptonote-xmr-pool">Powered by cryptonote-xmr-pool</a>
        </footer>
    </div>

    <script src="/js/vue-components.js?v=0.4.3"></script>

    <script>
        function onLoad() {
            var menu = document.getElementById('mobileMenu');
            menu.style.display = 'none';
        }

        function showHideMenu() {
            var menu = document.getElementById('mobileMenu');
            if (menu.style.display === 'none') {
                menu.style.display = 'block';
            } else {
                menu.style.display = 'none';
            }
        }
    </script>
</body>
</html>
