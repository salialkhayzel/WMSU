<!DOCTYPE html>
    <html>
    <head>
        <!-- not nice - ace dev - Al-KHAYZEL A. SALI, HANRICKSON E. DUMAPIT, MATT ALBER S. LUNA -->
        <meta charset="utf-8">
        <title>{{ config('app.name', 'Laravel').' - '.$title }}</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 0;
            }

            .container {
                max-width: 600px;
                margin: 60px auto;
                padding: 20px;
                background-color: #ffffff;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                border-radius: 5px;
            }

            .header {
                text-align: center;
                margin-bottom: 20px;
            }

            .logo img {
                max-width: 150px;
            }

            h1 {
                color: #333;
                font-size: 24px;
                margin-bottom: 10px;
            }

            p {
                font-size: 16px;
                line-height: 1.6;
                margin-bottom: 10px;
            }

            .verification-code {
                text-align: center;
                font-size: 32px;
                font-weight: bold;
                color: black;
                margin-top: 20px;
            }

            .footer {
                text-align: center;
                margin-top: 20px;
                color: #777;
                font-size: 14px;
            }
        </style>
        <link rel="shortcut icon" href="{{ asset('images/favicon/favicon.ico') }}" type="image/x-icon">
        <link rel="icon" href="{{ asset('images/favicon/favicon.ico') }}" type="image/x-icon"></head>
    </head>
    <body>
    {{ $slot }}

    
    </body>
</html>