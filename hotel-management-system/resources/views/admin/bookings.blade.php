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

    <!-- Delete Modal -->
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
    
    <!-- Approve Modal -->
    <div class="modal fade" id="approveModal" tabindex="-1" aria-labelledby="approveModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="approveModalLabel">Confirm Approval</h5>
                    <button type="button" class="btn-close close-modal-btn" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to approve this booking?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary cancel-modal-btn">Cancel</button>
                    <a id="confirmApproveBtn" href="#" class="btn btn-success">Approve</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Reject Modal -->
    <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rejectModalLabel">Confirm Rejection</h5>
                    <button type="button" class="btn-close close-modal-btn" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to reject this booking?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary cancel-modal-btn">Cancel</button>
                    <a id="confirmRejectBtn" href="#" class="btn btn-warning">Reject</a>
                </div>
            </div>
        </div>
    </div>

    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <table class="table-deg">
                    <tr>
                        <th class="th-deg">Room ID</th>
                        <th class="th-deg">Room Title</th>
                        <th class="th-deg">Customer Name</th>
                        <th class="th-deg">Email</th>
                        <th class="th-deg">Phone</th>
                        <th class="th-deg">Arrival Date</th>
                        <th class="th-deg">Leaving Date</th>
                        <th class="th-deg">Status</th>
                        <th class="th-deg">Price</th>
                        <th class="th-deg">Image</th>
                        <th class="th-deg">Delete</th>
                        <th class="th-deg">Status Update</th>

                        
                    </tr>

                    @foreach ($data as $data)
                    <tr>
                        <td>{{$data->room_id}}</td>
                        <td>{{$data->room->room_title}}</td>
                        <td>{{$data->name}}</td>
                        <td>{{$data->email}}</td>
                        <td>{{$data->phone}}</td>
                        <td>{{$data->start_date}}</td>
                        <td>{{$data->end_date}}</td>
                        <td>
                            @if ($data->status == 'approve')

                            <span style="color: green;">Approved</span>

                            @endif

                            @if ($data->status == 'rejected')

                            <span style="color: red;">Rejected</span>

                            @endif

                            @if ($data->status == 'waiting')

                            <span style="color: black;">Waiting</span>

                            @endif

                            
                        </td>
                        <td>{{$data->room->price}}</td>
                        <td>
                            <img src="room/{{$data->room->image}}" alt="Room Image">
                        </td>

                        <td>
                            <a onclick="return false;" class="btn btn-danger delete-btn" href="{{url('booking_delete', $data->id)}}">Delete</a>
                        </td>

                        <td>
                            <a onclick="return false;" class="btn btn-success approve-btn" href="{{url('approve_book', $data->id)}}">Approve</a>
                            <a onclick="return false;" class="btn btn-warning reject-btn" href="{{url('reject_book', $data->id)}}">Reject</a>
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

        const approveButtons = document.querySelectorAll('.approve-btn');
        const confirmApproveBtn = document.getElementById('confirmApproveBtn');
        const approveModalEl = document.getElementById('approveModal');
        const approveModal = new bootstrap.Modal(approveModalEl);

        const rejectButtons = document.querySelectorAll('.reject-btn');
        const confirmRejectBtn = document.getElementById('confirmRejectBtn');
        const rejectModalEl = document.getElementById('rejectModal');
        const rejectModal = new bootstrap.Modal(rejectModalEl);

        const cancelModalBtns = document.querySelectorAll('.cancel-modal-btn');
        const closeModalBtns = document.querySelectorAll('.close-modal-btn');

        // Add click listeners for delete buttons
        deleteButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                const deleteUrl = this.getAttribute('href');
                confirmDeleteBtn.setAttribute('href', deleteUrl);
                deleteModal.show();
            });
        });

        // Add click listeners for approve buttons
        approveButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                const approveUrl = this.getAttribute('href');
                confirmApproveBtn.setAttribute('href', approveUrl);
                approveModal.show();
            });
        });

        // Add click listeners for reject buttons
        rejectButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                const rejectUrl = this.getAttribute('href');
                confirmRejectBtn.setAttribute('href', rejectUrl);
                rejectModal.show();
            });
        });

        // Add click listeners for cancel buttons
        cancelModalBtns.forEach(button => {
            button.addEventListener('click', function () {
                deleteModal.hide();
                approveModal.hide();
                rejectModal.hide();
            });
        });

        // Add click listeners for close buttons
        closeModalBtns.forEach(button => {
            button.addEventListener('click', function () {
                deleteModal.hide();
                approveModal.hide();
                rejectModal.hide();
            });
        });
    });
</script>



</html>
