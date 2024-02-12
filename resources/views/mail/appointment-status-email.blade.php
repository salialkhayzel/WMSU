<!DOCTYPE html>
<html lang="en">
<head>
  <!-- not nice - ace dev - https://github.com/Drusha01 -->
  <meta charset="UTF-8">
  <title>WMSU Testing and Evaluation Center</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    /* Custom styles */
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }
    .email-content {
      background-color: #ffffff;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      margin: 20px auto;
      max-width: 600px;
    }
    .center-logo {
      text-align: center;
      margin-bottom: 20px;
    }
    .center-logo img {
      max-width: 150px;
      height: auto;
    }
    .signature {
      margin-top: 20px;
      font-size: 14px;
      color: #555;
    }
  </style>
</head>
<body>
  <div class="container email-content">
    <div class="center-logo">
      <img src="<?php echo $message->embed(asset('images/logo/logo.png') ); ?>">
      <h2>Western Mindanao State University Testing and Evaluation Center</h2>
    </div>
  
    <p>Good day, {{$email}},</p>
    <p>Testing and Evaluation Center would like to notify that your appointment is <strong>{{ $status}}</strong> <strong>@if($schedule){{'on '.date_format(date_create($schedule),"F d, Y h:i A")}}@endif</strong>.</p>
    @if(isset($reason))<p><strong>{{$reason}}</strong></p>@endif
    <p>Please be on time and stay safe.</p>
    <div class="signature">
      <p>Best Regards,<br>Testing and Evaluation Center<br>09066131868</p>
    </div>
  </div>
</body>
</html>
