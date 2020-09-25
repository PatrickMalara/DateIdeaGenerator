<?php
include 'connect.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script type='text/javascript' src='https://www.bing.com/api/maps/mapcontrol?key=Ai_myf_VEZ2GGngHQztsj-bPl02G6sinlA6YvROH3heSHtoy5Tl1yJyUWT_V5xHN'></script>
    <title>Date Generator - Random Date</title>
  </head>
  <body onload="loadMapScenario();">
    <div class="container-fluid">
        <header>
       
        <h1> <span> <a href="index.php"><img src="imgs/Logo.png" alt=""></a> Random Date</span></h1>
        </header>

        <div class="content-map" style="display: block;">
          <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6">
              <div id='myMap' class="map"></div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6"> 
              <h2 id="dateTitle"></h2>
              <h6 id="dateAddress"></h6>
              <p id="dateDesc"></p>
              <span style="display: inline-block;">
                <img src="https://img.icons8.com/color/32/000000/thumb-up--v1.png" style="display: inline-block;"/>
                <p id="upvotes" style="color: green; display: inline-block; cursor: pointer;">0</p>
                <img src="https://img.icons8.com/color/32/000000/poor-quality--v1.png" style="display: inline-block;"/>
                <p id="downvotes" style="color: red; display: inline-block; cursor: pointer;">0</p>
              </span>
            </div>
          </div>
        </div>

        <footer>
        &copy Patrick Malara 2020
        </footer>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script>
      var map;
        var infobox;
        var preference;
        var id;

      function loadMapScenario() {
          map = new Microsoft.Maps.Map(document.getElementById('myMap'), {
            center: new Microsoft.Maps.Location(43.2557, -79.8711),
            zoom: 12,
            customMapStyle: {
                elements: {
                    area: { fillColor: '#b6e591' },
                    water: { fillColor: '#75cff0' },
                    tollRoad: { fillColor: '#a964f4', strokeColor: '#a964f4' },
                    arterialRoad: { fillColor: '#ffffff', strokeColor: '#d7dae7' },
                    road: { fillColor: '#ffa35a', strokeColor: '#ff9c4f' },
                    street: { fillColor: '#ffffff', strokeColor: '#ffffff' },
                    transit: { fillColor: '#000000' }
                },
                settings: {
                    landColor: '#efe9e1'
                }
            }
          });

          infobox = new Microsoft.Maps.Infobox(map.getCenter(), { title: 'Current Position', description: 'This is where you are', visible: false });
          infobox.setMap(map);
          getDates();
        }

        /**
         * This function is called whenever we need to retrive
         * the dates list from the database
        */
        function getDates(){
            fetch("getdates.php", { credentials: 'include' })
                .then(response => response.json())
                .then(getDatesSuccess); 
        }

        function getDatesSuccess(json) {
            var randomNumber = Math.floor(Math.random() * json.length);
            loc = new Microsoft.Maps.Location(json[randomNumber].latitude, json[randomNumber].longitude);
                myPin = new Microsoft.Maps.Pushpin(loc, { 
                    title: json[randomNumber].title,
                    icon: 'imgs/HeartDropPin.png',
                    color: '#FF5757'});
                myPin.metadata = {
                    id: json[randomNumber].id,
                    infoTitle: json[randomNumber].title,
                    infoDescription: json[randomNumber].address,
                    infoFullDesc: json[randomNumber].desc,
                    catagory: json[randomNumber].category,
                    upvotes: json[randomNumber].upvotes,
                    downvotes: json[randomNumber].downvotes
                };
                map.entities.push(myPin);
                Microsoft.Maps.Events.addHandler(myPin, 'click', activatedInfoBox);

            id = json[randomNumber].id;
            $("#dateTitle").text(json[randomNumber].title);
            $("#dateDesc").text(json[randomNumber].desc);
            $("#upvotes").text(json[randomNumber].upvotes);
            $("#downvotes").text(json[randomNumber].downvotes);
            $("#dateAddress").text(json[randomNumber].address);
        }

        function activatedInfoBox(e) {
            infobox.setLocation(new Microsoft.Maps.Location(e.target.getLocation().latitude, e.target.getLocation().longitude));
            infobox.setOptions({ location: location, title: e.target.metadata.infoTitle, description: e.target.metadata.infoDescription, visible: true });
        }


      $(document).ready(function(){
        

        function upVote(){
            var params = "id=" + id;

            fetch("upVote.php", {
            method: 'POST',
            credentials: 'include',
            headers: {"Content-Type": "application/x-www-form-urlencoded"},
            body: params 
            })
            .then(response => response.text()) 
            .then(upVoteSuccess); 
              
        }
        function upVoteSuccess(text) {
          $("#upvotes").text(text);
        }

        function downVote(){
            var params = "id=" + id;

            fetch("downVote.php", {
            method: 'POST',
            credentials: 'include',
            headers: {"Content-Type": "application/x-www-form-urlencoded"},
            body: params 
            })
            .then(response => response.text()) 
            .then(downVoteSuccess); 
              
        }
        function downVoteSuccess(text) {
          $("#downvotes").text(text);
        }

        $("#upvotes").click( function(){
          upVote();
        });
        $("#downvotes").click( function(){
          downVote();
        });

      });
    </script>



  </body>
</html>