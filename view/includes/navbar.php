<!--Nav-->
<nav id="header" class="w-full z-30 top-0 py-1 backdrop-blur-lg bg-gray-800 bg-opacity-30 shadow-lg">
    <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-6 py-3">

        <label for="menu-toggle" class="cursor-pointer md:hidden block">
            <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                <title>menu</title>
                <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
            </svg>
        </label>
        <input class="hidden" type="checkbox" id="menu-toggle" />

        <div class="hidden md:flex md:items-center md:w-auto w-full order-3 md:order-1" id="menu">
            <nav>
                <ul class="md:flex items-center justify-between text-base text-gray-700 pt-4 md:pt-0">
                    <li><a class="inline-block no-underline text-gray-300 hover:text-white hover:underline py-2 px-4" href="/index.php?modul=role">Role</a></li>
                    <li><a class="inline-block no-underline text-gray-300 hover:text-white hover:underline py-2 px-4" href="/index.php?modul=user">User</a></li>
                </ul>
            </nav>
        </div>

        <div class="order-1 md:order-2">
            <a class="flex items-center tracking-wide no-underline hover:no-underline font-bold text-gray-100 text-xl " href="view\landingPage.php">
                <svg class="fill-current text-gray-800 mr-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M5,22h14c1.103,0,2-0.897,2-2V9c0-0.553-0.447-1-1-1h-3V7c0-2.757-2.243-5-5-5S7,4.243,7,7v1H4C3.447,8,3,8.447,3,9v11 C3,21.103,3.897,22,5,22z M9,7c0-1.654,1.346-3,3-3s3,1.346,3,3v1H9V7z M5,10h2v2h2v-2h6v2h2v-2h2l0.002,10H5V10z" />
                </svg>
                Ann Comic Store
            </a>
        </div>

        <div class="order-2 md:order-3 flex items-center" id="nav-content">

            <a class="inline-block no-underline text-gray-400 hover:text-white" href="/index.php?modul=logout">
                <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M10 17l5-5-5-5v3H3v4h12v3zM21 12c0 4.41-3.59 8-8 8H5c-4.41 0-8-3.59-8-8s3.59-8 8-8h8c4.41 0 8 3.59 8 8z"/>
                </svg>
            </a>
            
            <a class="pl-3 inline-block no-underline text-gray-400 hover:text-white" href="/index.php?modul=transaksi">
                <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M4 6h16M4 12h16M4 18h16" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                </svg>
            </a>
        </div>
    </div>
</nav>
