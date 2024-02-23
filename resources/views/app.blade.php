<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'ClickAsh') }}</title>

    <meta name="theme-color" content="#2a6049">

    {{-- favicon --}}
    <link rel="icon" href="{{ asset('/favicon.png') }}" type="image/x-icon" />
    <meta name="title" content="Inicio - {{ config('app.name', 'ClickAsh') }}" />
    <meta name="description"
        content="ClickAsh es una innovadora aplicación diseñada para facilitar la venta de rifas. Con esta plataforma, podrás supervisar de manera efectiva cada etapa del proceso de venta realizado por tus vendedores, obteniendo un control total sobre las transacciones y gestionando las cajas en tiempo real para garantizar una operación fluida y eficiente. Con ClickAsh, optimiza la administración de tu negocio y disfruta de una experiencia de gestión integral y en tiempo real. " />

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ config('app.url') }}" />
    <meta property="og:title" content="Inicio - {{ config('app.name', 'ClickAsh') }}" />
    <meta property="og:description"
        content="ClickAsh es una innovadora aplicación diseñada para facilitar la venta de rifas. Con esta plataforma, podrás supervisar de manera efectiva cada etapa del proceso de venta realizado por tus vendedores, obteniendo un control total sobre las transacciones y gestionando las cajas en tiempo real para garantizar una operación fluida y eficiente. Con ClickAsh, optimiza la administración de tu negocio y disfruta de una experiencia de gestión integral y en tiempo real. " />
    <meta property="og:image" content="{{ asset('/favicon.png') }}" />

    <!-- Scripts -->
    @routes
    @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead

    {{-- todas las etiquetas svg tendran el color --}}
    <style>
        svg {
            color: #535353;
        }

        .swal2-popup .swal2-styled {
            border-radius: 0.375rem !important;
        }

        /* Hide scrollbar for Chrome, Safari and Opera */
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }

        /* Hide scrollbar for IE, Edge and Firefox */
        .hide-scrollbar {
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }

        pre {
            background-color: #ffffff;
            padding: 1rem;
            border-radius: 1rem;
        }
    </style>
</head>

<body class="font-sans antialiased bg-white">
    @inertia
</body>

</html>
