<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin chat support - WMSU TEC</title>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="description">
    <meta content="" name="keywords">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <!-- Vendor CSS Files -->
    <link href="{{ asset('/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/boxicons/2.0.7/boxicons/css/boxicons.min.css" rel="stylesheet">
    <!--  Main CSS File -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <!--   js File -->
    <script src="{{ asset('js/dashboard.js') }}"></script>
</head>

<body class="admin-dashboard">

    <!-- ======= Header ======= -->
    @include('admin-components.admin-header');
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    @include('admin-components.admin-sidebar');
    <!-- End Sidebar -->

    <!-- ======= Main Content ======= -->
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Chat support</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Chat support</li>
                </ol>
            </nav>
        </div><!-- End Right side columns -->
        <!-- Insert Section -->
        <section class="admin-content">
            <div class="chat-container">
                <div class="chat-table">
                    <div class="chat-column recent-message">
                        <h3>Recent Messages</h3>
                        <div class="message" >
                            <div class="message-sender">User 1:</div>
                            <div class="message-content">Hello, I need assistance with...</div>
                        </div>
                        <div class="message">
                            <div class="message-sender">User 2:</div>
                            <div class="message-content">Can you help me with...</div>
                        </div>
                        <!-- Add more recent messages as needed -->
                    </div>
                    <div class="vertical-line"></div>
                    <div class="chat-column active-conversation">
                        <div class="active-conversation-header">
                            <h3>Active Conversation</h3>
                            <button class="end-conversation-button">End Conversation</button>
                        </div>
                        <div class="active-message" >
                            <div class="message-sender">User 1:</div>
                            <div class="message-content">Hello, I need assistance with...</div>
                        </div>
                        <!-- Add more active conversation messages as needed -->
                        <div class="reply-container">
                            <textarea class="reply-textarea" placeholder="Type your reply"></textarea>
                            <button class="send-button">Send</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- End Inserted Section -->

    </main><!-- End #main -->
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
</body>

</html>
