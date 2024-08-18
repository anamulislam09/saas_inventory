@php
    $basicInfo = App\Models\BasicInfo::first();
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $basicInfo->title }}</title>
    <link rel="shortcut icon" href="{{ asset('public/uploads/basic-info/' . $basicInfo->favIcon) }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container-fluid {
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }

        .main-content {
            width: 100%;
            max-width: 800px;
            margin: 5em auto;
            margin-top: 3em;
            margin-bottom: 3em;
            display: flex;
            border-radius: 20px;
            box-shadow: 0 5px 5px rgba(0, 0, 0, .4);
            overflow: hidden;
        }

        .company__info {
            background-color: #008080;
            color: #fff;
            padding: 2em;
            text-align: center;
        }

        .company__logo {
            font-size: 3em;
            margin-bottom: 1em;
        }

        .company__title {
            font-size: 1.5em;
            margin: 0;
        }

        .login_form {
            background-color: #fff;
            padding: 2em;
            flex-grow: 1;
        }

        form {
            margin-bottom: 0;
        }

        .form__input {
            width: 100%;
            border: 0px solid transparent;
            border-radius: 0;
            border-bottom: 1px solid #ccc;
            padding: 1em .5em .5em;
            outline: none;
            transition: all .3s ease;
        }

        .form__input:focus {
            border-bottom-color: #008080;
            box-shadow: 0 0 5px rgba(0, 80, 80, .4);
            border-radius: 4px;
        }

        .form__input--password {
            position: relative;
        }

        .btn {
            width: 100%;
            border-radius: 30px;
            color: #fff;
            font-weight: 600;
            background-color: #008080;
            border: 1px solid #008080;
            margin-top: 1.5em;
            padding: 0.75em;
            cursor: pointer;
        }

        .btn:hover,
        .btn:focus {
            background-color: #005757;
            border-color: #005757;
        }

        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .error-message {
            color: red;
            font-size: 0.875em;
            margin-top: 0.25em;
        }

        /* Table Styles */
        table {
            width: 100%;
            margin-top: 2em;
            border-collapse: collapse;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table th,
        table td {
            padding: 0.75em;
            text-align: center;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #008080;
            color: white;
        }

        table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* Responsive adjustments */
        @media screen and (max-width: 768px) {
            .main-content {
                flex-direction: column;
                max-width: 100%;
            }

            .company__info,
            .login_form {
                border-radius: 0;
                width: 100%;
            }

            .company__info {
                padding: 2em 1em;
            }

            table {
                font-size: 0.9em;
            }
        }

        .row.main-content.bg-success {
            margin-top: 185px;
        }
    </style>
</head>

<body>
    <!-- Main Content -->
    <div class="container-fluid">
        <div class="row main-content bg-success">
            <div class="col-md-4 company__info">
                <div class="company__logo">
                    <span class="fa fa-android"></span>
                </div>
                <h4 class="company__title">{{ $basicInfo->title }}</h4>
            </div>
            <div class="col-md-8 login_form">
                <div class="container-fluid">
                    <h2 class="text-center">Login Panel</h2>
                    <form id="loginForm" method="POST" action="{{ route('admin.login') }}" class="form-group">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="email" id="username" class="form__input" placeholder="Email"
                                autofocus value="{{ old('email') }}">
                            @if ($errors->has('email'))
                                <span class="error-message">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group form__input--password">
                            <input type="password" name="password" id="password" class="form__input"
                                placeholder="Password">
                            <span class="fa fa-eye toggle-password" onclick="togglePassword()"></span>
                            @if ($errors->has('password'))
                                <span class="error-message">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="remember_me" id="remember_me">
                            <label for="remember_me">Remember Me!</label>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Submit" class="btn">
                        </div>
                    </form>
                    <div class="text-center">
                        <p>Don't have an account? <a href="#">Register Here</a></p>
                    </div>
                    {{-- <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Role</th>
                                    <th>Email</th>
                                    <th>Password</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admins as $key => $admin)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $admin->role }}</td>
                                        <td id="email{{ $key }}">{{ $admin->email }}</td>
                                        <td id="password{{ $key }}">4444</td>
                                        <td><i class="far fa-copy" onclick='copyCredentials("{{ $key }}")'></i></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <div class="container-fluid text-center footer">
        Coded with &hearts; by <a target="_blank" href="https://sysdevltd.com">SYS DEV LTD.</a>
    </div>
    <script>
        function togglePassword() {
            var passwordField = document.getElementById("password");
            var toggleIcon = document.querySelector(".toggle-password");
            if (passwordField.type === "password") {
                passwordField.type = "text";
                toggleIcon.classList.remove("fa-eye");
                toggleIcon.classList.add("fa-eye-slash");
            } else {
                passwordField.type = "password";
                toggleIcon.classList.remove("fa-eye-slash");
                toggleIcon.classList.add("fa-eye");
            }
        }

        function copyCredentials(rowId) {
            var emailField = document.getElementById("email" + rowId);
            var passwordField = document.getElementById("password" + rowId);
            document.getElementById("username").value = emailField.textContent.trim();
            document.getElementById("password").value = passwordField.textContent.trim();
        }
    </script>
</body>

</html>
