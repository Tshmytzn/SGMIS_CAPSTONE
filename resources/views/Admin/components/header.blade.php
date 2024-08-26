<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title> {{ $title }}</title>

    <!-- Favicon -->
    <link href="{{ asset('./static/logoicon.png') }}" rel="icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('./dist/css/tabler.min.css?1684106062') }}" rel="stylesheet" />
    <link href="{{ asset('./dist/css/tabler-flags.min.css?1684106062') }}" rel="stylesheet" />
    <link href="{{ asset('./dist/css/tabler-payments.min.css?1684106062') }}" rel="stylesheet" />
    <link href="{{ asset('./dist/css/tabler-vendors.min.css?1684106062') }}" rel="stylesheet" />
    <link href="{{ asset('./dist/css/demo.min.css?1684106062') }}" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/css/alertify.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/css/themes/default.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/alertify.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs/build/css/alertify.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs/build/css/themes/default.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
   

    {{-- DATATABLE --}}
    <link href="{{ asset('./dist/css/event.css') }}" rel="stylesheet" />
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
         .folder {
            width: 300px;
            height: 200px;
            margin: 0 auto;
            position: relative;
            border-radius: 6px;
            box-shadow: 4px 4px 7px rgba(0, 0, 0, 0.59);
            overflow: hidden; /* to hide overflow content */
        }

        .folder:before {
            content: '';
            width: 0;
            height: 0;
            border-style: solid;
            border-width: 50px 150px 0 150px; /* adjust these values for different folder sizes */
            border-color: transparent transparent transparent transparent;
            position: absolute;
            top: -50px;
            left: 0;
        }
    </style>
</head>
