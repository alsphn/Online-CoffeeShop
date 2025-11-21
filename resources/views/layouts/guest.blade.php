<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Online CoffeeShop') }} - @yield('title', 'Authentication')</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .auth-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            max-width: 1000px;
            width: 100%;
            display: flex;
            min-height: 600px;
        }

        .auth-left {
            flex: 1;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
        }

        .auth-left i {
            font-size: 80px;
            margin-bottom: 30px;
            opacity: 0.9;
        }

        .auth-left h2 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .auth-left p {
            font-size: 16px;
            opacity: 0.9;
            line-height: 1.6;
        }

        .auth-right {
            flex: 1;
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .brand-logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .brand-logo i {
            font-size: 50px;
            color: #667eea;
        }

        .brand-logo h3 {
            font-size: 28px;
            font-weight: 700;
            color: #333;
            margin-top: 10px;
        }

        .form-control {
            border-radius: 10px;
            padding: 12px 20px;
            border: 2px solid #e0e0e0;
            font-size: 15px;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
        }

        .form-label {
            font-weight: 500;
            color: #555;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            padding: 12px 30px;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }

        .form-check-input:checked {
            background-color: #667eea;
            border-color: #667eea;
        }

        .text-link {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
        }

        .text-link:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        .divider {
            text-align: center;
            margin: 20px 0;
            position: relative;
        }

        .divider::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            width: 100%;
            height: 1px;
            background: #e0e0e0;
        }

        .divider span {
            background: white;
            padding: 0 15px;
            position: relative;
            color: #999;
            font-size: 14px;
        }

        .alert {
            border-radius: 10px;
            padding: 12px 20px;
            font-size: 14px;
        }

        .input-group-text {
            background: #f8f9fa;
            border: 2px solid #e0e0e0;
            border-right: none;
            border-radius: 10px 0 0 10px;
        }

        .input-group .form-control {
            border-left: none;
            border-radius: 0 10px 10px 0;
        }

        @media (max-width: 768px) {
            .auth-container {
                flex-direction: column;
            }

            .auth-left {
                padding: 40px 20px;
            }

            .auth-left h2 {
                font-size: 24px;
            }

            .auth-left i {
                font-size: 60px;
            }

            .auth-right {
                padding: 40px 30px;
            }
        }
    </style>
</head>

<body>
    <div class="auth-container">
        {{ $slot }}
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>