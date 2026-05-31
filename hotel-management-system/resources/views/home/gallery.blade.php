<div class="gallery" id="gallery">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="titlepage">
               <h2>Gallery</h2>
            </div>
         </div>
      </div>
      <div class="row">
        <style>
           .gallery_img figure img {
               width: 100%; 
               height: 200px; 
               object-fit: cover; 
               border-radius: 8px; 
           }
        </style>
        @foreach ($gallery as $item)
        <div class="col-md-3 col-sm-6">
           <div class="gallery_img">
              <figure><img src="/gallery/{{$item->images}}" alt="#"/></figure>
           </div>
        </div>
        @endforeach
      </div>
   </div>
</div>