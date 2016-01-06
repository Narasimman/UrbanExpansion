<div class="container">

      <!-- Jumbotron -->
      <div class="jumbotron">
        <div class="collapse-group">
          <h2 class="heading team-group btn-primary">Urbanization Project Staff</h2>

          <section class="bio-list collapse">

            <article id="person-shlomo-solly-angel" class="post">
              <div class="alignleft">
                <img src="<?php echo IMAGES; ?>Solly1.jpg" alt="Shlomo (Solly) Angel">
              </div>
              <div class="info">
                <h1>Shlomo (Solly) Angel</h1>
                <h2>Adjunct Professor and Senior Research Scholar</h2>
                  <a target="_blank" href="http://sollyangel.com" class="cite">http://sollyangel.com</a>
                  <p class="text-justify"> Shlomo (Solly) Angel is an adjunct professor at NYU and senior research scholar at the NYU Stern Urbanization Project, where he leads the Urban Expansion initiative. Angel is an expert on urban development policy, having advised the United Nations, the World Bank, and the Inter-American Development Bank (IDB). He currently focuses on documenting and planning for urban expansion in the developing world.</p>
                  <p class="text-justify"> In 1973, he started a program in Human Settlements Planning and Development at the Asian Institute of Technology in Bangkok. He taught at the Institute from 1973 to 1983, while researching housing and urban development in the cities of East, South, and Southeast Asia. From the mid-80s to mid-90s, he worked as a housing and urban development consultant to UN-Habitat, the Asian Development Bank, and the Government of Thailand. In 2000, he published <em>Housing Policy Matters</em>, a comparative study of housing conditions and policies around the world. From 2000 onward, he prepared housing sector assessments of 11 Latin America and Caribbean countries for the IDB and the World Bank.</p>
                  <p class="text-justify"> Angel earned a bachelor’s degree in architecture and a doctorate in city and regional planning at the University of California, Berkeley.</p>
              </div>
            </article>

            <article id="person-nicolas-galarza" class="post">
              <div class="alignleft">
                <img src="<?php echo IMAGES; ?>nico_new.jpg" alt="Nicolás Galarza">
                <a target="_blank" href="http://twitter.com/nicogalarza" class="link">
                  <span>@nicogalarza</span>
                </a>
              </div>
              <div class="info">
                <h1>Nicolás Galarza</h1>
                <h2>Research Scholar</h2>
                  <p class="text-justify">  Nicolás Galarza is Research Scholar at the Urbanization Project, focusing on the Urban Expansion initiative in Latin America. Nicolás holds a Masters of Urban Planning from NYU Wagner Graduate School of Public Service. Prior to pursuing his Masters in New York City, Nicolás served as advisor to the Program Director of the National Poverty Alleviation Strategy and to the High Presidential Commissioner for Social Action on Civic Technology and Innovation in his native Colombia.</p>              
              </div>
            </article>


            <article id="person-patrick-lamson-hall" class="post">
              <div class="alignleft">
                <img src="<?php echo IMAGES; ?>PatrickHeadshot_Small.png" alt="Patrick Lamson-Hall">
              </div>
              <div class="info">
                <h1>Patrick Lamson-Hall</h1>
                <h2>Research Scholar</h2>
                  <p class="text-justify"> Patrick Lamson-Hall is a Research Scholar at the NYU Stern Urbanization Project. He recently completed his Masters in Urban Planning at the NYU Wagner School of Public Service. His research interests include urbanization in the developing world, development economics, and historical urbanization.</p>              
              </div>
            </article>

            <article id="person-alejandro-blei" class="post">
              <div class="alignleft">
                <img src="<?php echo IMAGES; ?>Alex_Blei_headshot.JPG" alt="Alejandro  Blei">
              </div>
              <div class="info">
                <h1>Alejandro  Blei</h1>
                <h2>Research Scholar</h2>
                <p>Alex Blei is a Research Scholar at the NYU Stern Urbanization Project and at the Marron Institute. He is also a PhD candidate at the University of Illinois at Chicago in the Department of Urban Planning and Policy specializing in urban transportation. Most recently, he formed part of a team that used satellite imagery and historical maps to document global urban expansion over a 200 year period. Their findings were published as the Atlas of Urban Expansion. As an IGERT fellow he is shifting his focus from the macro to the micro level. Using GPS travel survey data, he seeks to understand how spatio-temporal analyses of travel behavior can inform individual decision making as well as planning and policy decisions. He has also worked as a transit planner in New York and Chicago.</p>              
              </div>
            </article>

            <article id="person-pritha-gopalan" class="post">
              <div class="alignleft">
                <img src="<?php echo IMAGES; ?>Pritha_headshot_2C.JPG" alt="Pritha Gopalan">
              </div>
              <div class="info">
                <h1>Pritha Gopalan</h1>
                <h2>Research Scholar</h2>
                <p>Pritha is a Research Scholar with the NYU Stern Urbanization Project and a Survey Leader managing the Land and Housing Survey in a Global Sample of 200 Cities. She is an applied anthropologist with extensive research and teaching experience, and previously worked at the Institute for Financial and Managerial Research and Department of Humanities and Social Sciences at IIT Madras, in India, and the Academy for Educational Development in New York. Most recently, she served as a Social researcher on a collaborative convened by the Government of Tamil Nadu (India) to restore an urban river and rehabilitate riverbank settlements. She holds a Ph.D. in Educational Anthropology from the University of Pennsylvania, and has authored several publications.</p>            
              </div>
            </article>
          
            <article id="person-achilles-kallergis" class="post">
              <div class="alignleft">
                <img src="<?php echo IMAGES; ?>Achilles_Heashot.JPG" alt="Achilles Kallergis">
              </div>
              <div class="info">
                <h1>Achilles Kallergis</h1>
                <h2>Research Scholar</h2>
                <p> Achilles Kallergis is a Research Scholar at NYU Stern Urbanization Project. He is also a doctoral candidate in Public and Urban Policy&nbsp; and teaches at the Graduate Program for International Affairs at the New School University. His research interests include urbanization in the developing world with a particular focus on informal settlements.&nbsp; He has consulted for the Gates Foundation, UN-Habitat and the World Bank and has collaborated with community networks such as Slum Dwellers International and the Asian Coalition for Housing Rights.</p>
              </div>
            </article>

          </section>
        </div>

        <div class="collapse-group">
            <h2 class="heading team-group btn-primary">Regional Coordinators</h2>
            <section class="bio-list collapse">
            </section>
        </div>

          <div class="collapse-group">  
            <h2 class="heading team-group btn-primary">City-Based Researchers</h2>
            <section class="bio-list collapse">
            </section>
          </div>
        </div>

       <script src="<?php echo JS; ?>jquery-1.10.2.min.js"></script>
        <script type="text/javascript">
        $(document).ready(function(e) {
            $('.team-group').on('click', function(e) {
              e.preventDefault();
              var $this = $(this);
              var $collapse = $this.closest('.collapse-group').find('.collapse');
              $collapse.slideToggle();
            });
          });
      </script>




    </div> <!-- /container -->


