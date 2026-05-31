<!DOCTYPE html>
<html>
  <head>
    @include('admin.css')
    <style>
        .table-deg {
            border: 1px solid #3d4141;
            margin: auto;
            width: 80%;
            text-align: center;
            margin-top: 40px;
            border-collapse: collapse;
            background-color: #f8f9fa;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .th-deg {
            background-color: #3d4141;
            color: white;
            padding: 20px;
            text-transform: uppercase;
        }

        tr {
            border: 1px solid #ccc;
            transition: background-color 0.3s ease;
        }

        tr:hover {
            background-color: #e0e0e0;
        }

        td {
            padding: 15px;
            color: #333;
        }

        td img {
            width: 150px;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
        }

        td img:hover {
            transform: scale(1.1);
        }

        .page-content {
            padding: 20px;
        }

        .page-header {
            padding: 10px 0;
        }

        #approveModal .modal-content, #rejectModal .modal-content{
            background-color: #3d4141;
            color: white;
        }
         .btn {
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 14px;
        font-weight: 600;
        text-transform: uppercase;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        }

        .btn-success {
            background-color: #28a745;
            color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-success:hover {
            background-color: #218838;
            transform: scale(1.05);
        }

        .btn-warning {
            background-color: #ffc107;
            color: #3d4141;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-warning:hover {
            background-color: #e0a800;
            transform: scale(1.05);
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
                <table class="table-deg">
                    <tr>
                        <th class="th-deg">Name</th>
                        <th class="th-deg">Email</th>
                        <th class="th-deg">Phone</th>
                        <th class="th-deg">Message</th>
                        <th class="th-deg">Send Email</th>

                    </tr>

                    @foreach ($message as $message)
                    <tr>
                        <td>{{$message->name}}</td>
                        <td>{{$message->email}}</td>
                        <td>{{$message->phone}}</td>
                        <td>{{$message->message}}</td>
                        <td>
                            <a class="btn btn-success" href="{{url('send_mail', $message->id)}}">Send Mail</a>
                        </td>

                    </tr>
                    @endforeach




                </table>
            </div>
        </div>
      </div>

    @include('admin.footer')
  </body>
</html>
