<html lang="en">
  <head>
      <!-- not nice - ace dev - Al-KHAYZEL A. SALI, HANRICKSON E. DUMAPIT, MATT ALBER S. LUNA -->
      <meta charset="UTF-8">
      <link rel="stylesheet" href="{{ asset('css/permit.css') }}">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
      <title>{{ config('app.name', 'Laravel').' - '.$title }}</title>
      @livewireStyles
  </head>
  <body>

  {{ $slot }}
    @livewireScripts

</body>
</html>