<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BeatMeet Auth')</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: white;
        }

        .auth-wrapper {
            width: 1120px;
            min-height: 760px;
            margin: 45px auto;
            background: radial-gradient(circle at center, #5367a3 0%, #2d3d63 45%, #17243b 100%);
            position: relative;
            overflow: hidden;
        }

        .auth-logo {
            position: absolute;
            top: 28px;
            left: 30px;
            z-index: 3;
        }

        .auth-logo img {
            width: 70px;
            background: white;
            border-radius: 9px;
            display: block;
        }

        .auth-card {
            width: 430px;
            min-height: 560px;
            background: #f8fafc;
            border-radius: 28px;
            padding: 60px 34px 40px;
            position: absolute;
            top: 90px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 2;
        }

        .auth-title {
            text-align: center;
            margin-bottom: 42px;
        }

        .auth-title p {
            margin: 0;
            color: black;
            font-size: 22px;
        }

        .auth-title h1 {
            margin: 4px 0 0;
            color: black;
            font-size: 52px;
            line-height: 1;
            font-weight: bold;
            letter-spacing: -2px;
        }

        .form-group {
            margin-bottom: 22px;
        }

        .form-group input {
            width: 100%;
            height: 42px;
            border: 1px solid #17243b;
            border-radius: 8px;
            padding: 0 12px;
            font-size: 16px;
            background: white;
        }

        .form-group input::placeholder {
            color: #b8b8b8;
        }

        .submit-area {
            display: flex;
            justify-content: flex-end;
            margin-top: -6px;
        }

        .submit-btn {
            background: #ef4765;
            color: black;
            border: none;
            padding: 9px 18px;
            border-radius: 7px;
            font-size: 16px;
            cursor: pointer;
        }

        .submit-btn:hover {
            background: #d93d58;
            color: white;
        }

        .auth-links {
            margin-top: 14px;
            font-size: 12px;
        }

        .auth-links a {
            display: block;
            color: #6892e8;
            text-decoration: underline;
            margin-bottom: 4px;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .record-area-left {
            position: absolute;
            bottom: -110px;
            left: 0;
            display: flex;
            align-items: flex-end;
            gap: 10px;
        }

        .record-area-right {
            position: absolute;
            bottom: -110px;
            right: 0;
            display: flex;
            align-items: flex-end;
            gap: 10px;
        }

        .record {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 4px solid rgba(255, 255, 255, 0.3);
            background: radial-gradient(circle, #111827 0 10%, #f8fafc 11% 35%, #79c7b8 36% 100%);
        }

        .record.orange {
            background: radial-gradient(circle, #111827 0 10%, #f8fafc 11% 35%, #ef5b2a 36% 100%);
        }

        .record.blue {
            background: radial-gradient(circle, #111827 0 10%, #f8fafc 11% 35%, #5367a3 36% 100%);
        }

        .record.small {
            width: 110px;
            height: 110px;
        }

        @media (max-width: 1200px) {
            .auth-wrapper {
                width: 100%;
                margin: 0;
                min-height: 100vh;
            }
        }

        @media (max-width: 600px) {
            .auth-card {
                width: 88%;
                top: 120px;
                padding: 45px 24px 35px;
            }

            .auth-title h1 {
                font-size: 42px;
            }

            .record-area-left,
            .record-area-right {
                display: none;
            }
        }
    </style>
</head>
<body>

    <div class="auth-wrapper">
        <div class="auth-logo">
            <a href="{{ route('home') }}">
                <img src="{{ asset('resource/image/logo-beatmeet.png') }}" alt="BeatMeet Logo">
            </a>
        </div>

        @yield('content')

        <div class="record-area-left">
            <div class="record blue small"></div>
            <div class="record orange"></div>
            <div class="record"></div>
        </div>

        <div class="record-area-right">
            <div class="record"></div>
            <div class="record blue"></div>
            <div class="record orange small"></div>
        </div>
    </div>

</body>
</html>