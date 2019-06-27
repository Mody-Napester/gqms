<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Screen</title>

    <link href="{{ url('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr style="background-color: #cccccc">
                            <th>Issue</th>
                            <th>Value</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>Screen URL</td>
                            <td>{{ request()->url() }}</td>
                        </tr>
                        <tr>
                            <td>Screen Type</td>
                            <td>{{ ($screen)? (($type = DB::table('screen_types')->where('id', $screen->screen_type_id)->first())? $type->name_en : 'Type not available') : 'Not Available'}}</td>
                        </tr>
                        <tr>
                            <td>Screen Name</td>
                            <td>{{ ($screen)? $screen->name_en : 'Not Available'}}</td>
                        </tr>
                        <tr>
                            <td>Screen Area</td>
                            <td>{{ ($screen)? (($screen->area_id)? $screen->area->name_en : 'Area not found') : 'Not Available'}}</td>
                        </tr>
                        <tr>
                            <td>Screen Current IP</td>
                            <td>{{ ($screen)? $screen->ip : 'Not Available'}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-sm-2"></div>
        </div>
    </div>
</body>
</html>