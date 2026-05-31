<!DOCTYPE html>
<html>
  <head> 
    <base href="/public">
    @include('admin.css')
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .div-center {
            width: 50%;
            margin: auto;
            background-color: #f8f9fa;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 40px;
        }

        h1 {
            font-size: 30px;
            font-weight: bold;
            color: #3d4141;
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: inline-block;
            width: 150px;
            color: #3d4141;
            font-weight: bold;
            margin-bottom: 10px;
        }

        input, textarea, select {
            width: calc(100% - 160px);
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            color: #333;
            background-color: #fff;
            margin-bottom: 20px;
            transition: border-color 0.3s;
        }

        input:focus, textarea:focus, select:focus {
            border-color: #3d4141;
            outline: none;
        }

        textarea {
            resize: vertical;
            height: 80px;
        }

        .btn-primary {
            display: block;
            width: 100%;
            background-color: #3d4141;
            color: white;
            border: none;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #292b2c;
        }

        .div_deg {
            margin-bottom: 15px;
        }
    </style>
  </head>
  <body>
    @include('admin.header')
    
    @include('admin.sidebar')
      <!-- Sidebar Navigation end-->
      
      <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <div class="div-center">
                    <h1 style="padding: 20px; font-size: 50px;">Send Email to {{$data->name}}</h1>
                    <form action="{{url('mail', $data->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
    
    
                        <div class="div_deg">
                            <label for="description">Greeting</label>
                            <input type="text" name="title"></input>
                        </div>

                        <div class="div_deg">
                            <label >Mail Body</label>
                            <textarea name="body"></textarea>
                        </div>

                        <div class="div_deg">
                            <label>Action Text</label>
                            <input type="text" name="action_text"></input>
                        </div>

                        <div class="div_deg">
                            <label>Action Url</label>
                            <input type="text" name="action_url"></input>
                        </div>

                        <div class="div_deg">
                            <label>End Line</label>
                            <input type="text" name="endline"></input>
                        </div>

                        <div class="div_deg">
                            <input class="btn btn-primary" type="submit" value="Send Mail">
                        </div>
    
                    </form>
                </div>
            </div>
        </div>
      </div>

    @include('admin.footer')
  </body>
</html>