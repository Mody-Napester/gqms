<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Tajawal:400,500,700,800,900" rel="stylesheet">

    <style>
        @font-face {
            font-family: GE_SS_Two;
            src: url('/public/assets/fonts/ge-ss-two-medium.ttf') format('ttf');
        }
        body{
            font-family: 'Tajawal', sans-serif;
        }
        .section{
            padding: 1.2rem;
        }
        .btn-print{
            font-size: 4rem;
            font-weight: bold;
            padding: 3rem;
            display: inline-block;
            margin-top: 10%;
            text-align: center;
            /*width: 50%;*/
        }
        .bg-blue-1{
            background-color: #405566;
        }
        .txt-2{
            font-size: 2rem;
            font-weight: bold;
        }
        .top-div{
            color: #FFFFFF;
            font-size: 2rem;
            font-weight: bold;
            background-color: #7f8c8d;
            padding: 3px 15px;
            display: inline-block;
            border-radius: 5px;
            margin-right: 10px;

        }

        .logo-image{
            width:50px;
            display: inline-block;
        }

    </style>

    <title>{{ $screen->name_en }}</title>
</head>
<body>

<div>
    <div class="section bg-blue-1 mb-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 text-left">
                    <div class="top-div">{{ $screen->floor->name_en }}</div>
                </div>
                <div class="col-md-6">
                    <div class="text-white txt-2 text-right">
                        <span>مستشفى الجنزورى التخصصى</span>
                        <img class="logo-image" src="{{ url('assets/images/ganz-logo.jpg') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 text-center">
                <form action="" method="post">
                    @csrf

                    <button class="btn btn-primary btn-print" type="submit">اضغط هنا لطباعة دور</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<script type="text/javascript">

</script>
</body>
</html>