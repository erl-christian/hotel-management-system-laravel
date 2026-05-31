<!DOCTYPE html>
<html lang="en">
   <head>
      <base href="/public">
      @include('home.css')
      <style>
         /* Additional CSS for improved layout */
        .our_room {
            padding: 60px 0; 
        }

        .titlepage h2 {
            font-size: 42px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }

        .titlepage p {
            font-size: 18px;
            color: #666;
        }

        .room {
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
            border-radius: 12px;
            background: #fff;
            transition: transform 0.3s, box-shadow 0.3s;
            max-width: 900px;
            margin: 0 auto; /* Center the room card */
        }

        .room:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
        }

        .room_img figure img {
            border-radius: 12px 12px 0 0;
            height: 350px;
            width: 100%;
            object-fit: cover;
        }

        .bed_room {
            padding: 30px;
            text-align: center;
        }

        .bed_room h1 {
            font-size: 28px;
            color: #333;
            margin-bottom: 15px;
        }

        .bed_room p {
            font-size: 16px;
            color: #555;
            line-height: 1.8;
        }

        .bed_room h4, .bed_room h2 {
            font-size: 20px;
            color: #333;
            margin-top: 15px;
        }

        .bed_room h2 {
            font-weight: bold;
            color: #007bff;
        }

        .room-details {
            margin-right: 20px; /* Space between room details and booking form */
        }

        .booking-form {
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
            border-radius: 12px;
            background: #fff;
            padding: 30px;
            flex-shrink: 0; /* Prevent the form from shrinking */
        }

        .booking-form h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }

        .booking-form .form-group label {
            font-size: 16px;
            color: #555;
            font-weight: bold;
        }

        .booking-form .form-control {
            border-radius: 8px;
            border: 1px solid #ccc;
            padding: 10px;
            font-size: 16px;
        }

        .booking-form .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 10px 20px;
            font-size: 18px;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        .booking-form .btn-primary:hover {
            background-color: #0056b3;
        }

        @media (max-width: 991px) {
            .col-md-12 {
                flex-direction: column; /* Stack on smaller screens */
            }

            .room-details,
            .booking-form {
                margin: 0 auto 20px; /* Center and add spacing */
            }
        }

        @media (min-width: 992px) {
            .room {
                display: flex;
                align-items: stretch;
            }

            .room_img {
                flex: 1;
            }

            .bed_room {
                flex: 1;
                padding: 40px;
                display: flex;
                flex-direction: column;
                justify-content: center;
            }
        }
      </style>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
   </head>
   <body class="main-layout">
      <!-- loader -->
      <div class="loader_bg">
         <div class="loader"><img src="images/loading.gif" alt="#"/></div>
      </div>
      <!-- end loader -->

      <!-- header -->
      <header>
         @include('home.header')
      </header>

      <div class="our_room">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage text-center">
                     <h2>Our Room</h2>
                     <p>Explore our cozy and well-equipped rooms designed to provide maximum comfort.</p>
                  </div>
               </div>
            </div>

            <div class="col-md-12 d-flex justify-content-between">
                <!-- Room Details -->
                <div class="room-details col-lg-7">
                   <div id="serv_hover" class="room">
                      <div class="room_img">
                         <figure>
                            <img src="/room/{{$room->image}}" alt="Room Image" />
                         </figure>
                      </div>
                      <div class="bed_room">
                         <h1>{{$room->room_title}}</h1>
                         <p>{{$room->description}}</p>
                         <h4>Free Wifi: <span>{{$room->wifi ? 'Yes' : 'No'}}</span></h4>
                         <h4>Room Type: {{$room->room_type}}</h4>
                         <h2>Price: ${{$room->price}}</h2>
                      </div>
                   </div>
                </div>
             
                <!-- Booking Form -->
                <div class="booking-form col-lg-4">
                   <h2 class="text-center">Book Your Stay</h2>

                    <div class="alert alert-success">
                        @if (session()->has('message'))

                        <button type="button" class="close" data-bs-dismiss="alert">X</button>
                    
                        {{session()->get('message')}}
                    
                        @endif
                    </div>
                

                   @if($errors)
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li style="color: red">{{ $error }}</li>
                        @endforeach
                    </ul>
                   @endif

                   <form action="{{url('add_booking', $room->id)}}" method="POST">

                        @csrf

                      <div class="form-group">
                         <label for="name">Name</label>
                         <input type="text" name="name" id="name" class="form-control" @if(Auth::id()) value="{{Auth::user()->name}}" @endif placeholder="Enter your name" required>
                      </div>
             
                      <div class="form-group">
                         <label for="email">Email</label>
                         <input type="email" name="email" id="email" class="form-control" @if(Auth::id()) value="{{Auth::user()->email}}" @endif  placeholder="Enter your email" required>
                      </div>
             
                      <div class="form-group">
                         <label for="phone">Phone</label>
                         <input type="tel" name="phone" id="phone" class="form-control" @if(Auth::id()) value="{{Auth::user()->phone}}" @endif  placeholder="Enter your phone number" required>
                      </div>
             
                      <div class="form-group">
                         <label for="startDate">Start Date</label>
                         <input type="date" name="startDate" id="startDate" class="form-control" required>
                      </div>
             
                      <div class="form-group">
                         <label for="endDate">End Date</label>
                         <input type="date" name="endDate" id="endDate" class="form-control" required>
                      </div>
             
                      <div class="text-center">
                         <button type="submit" class="btn btn-primary btn-block">Book Room</button>
                      </div>
                   </form>
                </div>
             </div>
             
         </div>
      </div>

      <!-- footer -->
      @include('home.footer')
      <!-- end footer -->
   </body>
   <script type="text/javascript">
        $(function(){
            var dtToday = new Date();
        
            var month = dtToday.getMonth() + 1;

            var day = dtToday.getDate();

            var year = dtToday.getFullYear();

            if(month < 10)
                month = '0' + month.toString();

            if(day < 10)
            day = '0' + day.toString();

            var maxDate = year + '-' + month + '-' + day;
            $('#startDate').attr('min', maxDate);
            $('#endDate').attr('min', maxDate); 
        });
   </script>
</html>
