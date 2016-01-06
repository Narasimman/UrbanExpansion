 <div class="container">
      <!-- Jumbotron -->
      <div class="jumbotron">
	 <link rel="stylesheet" href="<?php echo CSS; ?>bootstrap-select.css">
      <div class="city-select">
        <select class="selectpicker" title="Choose your city...">
          <option>Kampala</option>    
          <option>Pokhara</option>
          <option>Kolkata</option>
          <option>Coimbatore</option>
          <option>Mergui</option>
          <option>Mumbai</option>
          <option>Buenos Aires</option>
        </select>
      </div>


      <div id="map-holder" style="display:none;">
        
      </div>


      </div>

      <script src="<?php echo JS; ?>jquery-1.10.2.min.js"></script>
      <script src="<?php echo JS; ?>bootstrap.js"></script>
      <script src="<?php echo JS; ?>bootstrap-select.js"></script>

      <script type="text/javascript">
        $(document).ready(function() {
          var urls = {
            "Kampala"     : "https://www.google.com/maps/d/embed?mid=zieUleZTQGhg.kCVEmXCsd0UA",
            "Pokhara"     : "https://www.google.com/maps/d/embed?mid=zMhLaSs1bI9M.kdSyn0K37q9U", 
            "Kolkata"     : "https://www.google.com/maps/d/embed?mid=zMhLaSs1bI9M.kcoV5nFmCxDc",
            "Coimbatore"  : "https://www.google.com/maps/d/embed?mid=zMhLaSs1bI9M.kb6YVP5NkORw",
            "Mergui"      : "https://www.google.com/maps/d/embed?mid=zMhLaSs1bI9M.koITzTQ8os2Y",
            "Mumbai"      : "https://www.google.com/maps/d/embed?mid=zMhLaSs1bI9M.kj1WMtpu2kx8",
            "Buenos Aires": "https://www.google.com/maps/d/embed?mid=zMhLaSs1bI9M.kGcYOviuXYUE"
            
          };
           $('.selectpicker').selectpicker({
              style: 'btn-primary',
              size: 4,
              liveSearch :true
            });
          $('.selectpicker').change(function() {
            var city = $(this).val();
            $('#map-holder').html(
              $('<iframe>', {
              src: urls[city],
              id:  'myFrame',
              frameborder: 0,
              height: 510,
              width: 720,
              scrolling: 'no'
              })
              );
              $('#map-holder').show();
            
          });
        });
      </script>

    </div> <!-- /container -->

