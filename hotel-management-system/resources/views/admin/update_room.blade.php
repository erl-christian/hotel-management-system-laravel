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

    <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
            <div class="div-center">
                <h1>Update Rooms</h1>
                <form action="{{url('edit_room', $data->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="div_deg">
                        <label for="title">Room Title</label>
                        <input type="text" name="title" id="title" value="{{$data->room_title}}">
                    </div>

                    <div class="div_deg">
                        <label for="description">Description</label>
                        <textarea name="description" id="description">{{$data->description}}</textarea>
                    </div>

                    <div class="div_deg">
                        <label for="price">Price</label>
                        <input type="number" name="price" id="price" value="{{$data->price}}">
                    </div>

                    <div class="div_deg">
                        <label for="type">Room Type</label>
                        <select name="type" id="type" required>
                            <option selected value="{{$data->room_type}}">{{$data->room_type}}</option>
                            <option value="regular">Regular</option>
                            <option value="premium">Premium</option>
                            <option value="deluxe">Deluxe</option>
                        </select>
                    </div>

                    <div class="div_deg">
                        <label for="wifi">Free Wifi</label>
                        <select name="wifi" id="wifi" required>
                            <option selected value="{{$data->wifi}}">{{$data->wifi}}</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>

                    <div class="div_deg">
                        <label for="image">Current Image</label>
                        <img style="margin: auto" width="100" src="/room/{{$data->image}}" alt="">
                    </div>

                    <div class="div_deg">
                        <label for="image">Upload Image</label>
                        <input type="file" name="image" id="image" required>
                    </div>

                    <div class="div_deg">
                        <input class="btn btn-primary" type="submit" value="Update Room">
                    </div>
                </form>
            </div>
          </div>
        </div>
    </div>
    @include('admin.footer')
  </body>
</html>