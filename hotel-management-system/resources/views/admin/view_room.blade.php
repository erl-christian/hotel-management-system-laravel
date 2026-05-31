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

        #deleteModal .modal-content, #updateModal .modal-content {
            background-color: #3d4141; 
            color: white;
        }
    </style>
  </head>
  <body>
    @include('admin.header')
    @include('admin.sidebar')

    {{-- Delete Modal --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close close-modal-btn" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to Delete this room?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary cancel-modal-btn">Cancel</button>
                    <a id="confirmDeleteBtn" href="#" class="btn btn-danger">Delete</a>
                </div>
            </div>
        </div>
    </div>    
    {{-- Delete Modal --}}

    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <table class="table-deg">
                    <tr>
                        <th class="th-deg">Room ID</th>
                        <th class="th-deg">Room Title</th>
                        <th class="th-deg">Description</th>
                        <th class="th-deg">Price</th>
                        <th class="th-deg">Wifi</th>
                        <th class="th-deg">Room Type</th>
                        <th class="th-deg">Image</th>
                        <th class="th-deg">Delete</th>
                        <th class="th-deg">Update</th>
                    </tr>

                    @foreach ($data as $data)
                    <tr>
                        <td>{{$data->id}}</td>
                        <td>{{$data->room_title}}</td>
                        <td>{!! Str::limit($data->description,150) !!}</td>
                        <td>&#8369;{{$data->price}}</td>
                        <td>{{$data->wifi}}</td>
                        <td>{{$data->room_type}}</td>
                        <td>
                            <img src="room/{{$data->image}}" alt="Room Image">
                        </td>

                        <td>
                            <a onclick="return false;" class="btn btn-danger delete-btn" href="{{url('room_delete', $data->id)}}">Delete</a>
                        </td>

                        <td>
                            <a class="btn btn-warning" href="{{url('room_update', $data->id)}}">Update</a>
                        </td>

                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

    @include('admin.footer')
  </body>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.delete-btn');
        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
        const deleteModalEl = document.getElementById('deleteModal');
        const deleteModal = new bootstrap.Modal(deleteModalEl);

        deleteButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                const deleteUrl = this.getAttribute('href');
                confirmDeleteBtn.setAttribute('href', deleteUrl);
                deleteModal.show();
            });
        });

        
        const cancelModalBtn = document.querySelector('.cancel-modal-btn');
        const closeModalBtn = document.querySelector('.close-modal-btn');

        cancelModalBtn.addEventListener('click', function () {
            deleteModal.hide();
        });

        closeModalBtn.addEventListener('click', function () {
            deleteModal.hide();
        });
    });
</script>



</html>
