<!DOCTYPE html>
<?php
include 'connect.php';
?>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    <title>Date Generator - Add Date</title>
  </head>
  <body onload="loadMapScenario();">
    <div class="container-fluid">
        <header>
       
        <h1> <span> <a href="index.php"><img src="imgs/Logo.png" alt=""></a> Add a Date</span></h1>
        </header>

        <div class="content-map" style="display: block;">
          <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6">
              <div id='myMap' class="map"></div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6"> 
              <h2>Found a cool place?</h2>
              <br />
              
            <form action="" method="post">
                <label for="dateTitle">Name:</label>
                <input id="dateTitle" type="text" name="dateTitle">

                <label for="dateAddress">Address:</label>
                <input id="dateAddress" type="text" name="dateAddress">

                <label for="dateLatitude">Latitude:</label>
                <input type="text" name="dateLatitude" id="dateLatitude">

                <label for="dateLongitute">Longitude:</label>
                <input type="text" name="dateLongitute" id="dateLongitude">

                <label for="dateDesc">Desciption:</label>
                <input type="text" name="dateDesc" id="dateDesc">

                <label for="dateCategory">Category:</label>
                <select id="dateCategory">
                    <option value="Drinking">Drinking</option>
                    <option value="Art">Art</option>
                    <option value="Outdoors">Out-doors</option>
                    <option value="Games">Games</option>
                    <option value="Eating">Eating</option>
                    <option value="Animals">Animals</option>
                </select> 

                <input id="addDate" type="button" value="Add Date" style="background-color: #851D41; color: white;">
                <p style="color: green;" id="addDateSuccess"></p>

            </form>

            </div>
          </div>
        </div>

        <footer>
        &copy Patrick Malara 2020
        </footer>
    </div>

    <script type='text/javascript' src='https://www.bing.com/api/maps/mapcontrol?key=Ai_myf_VEZ2GGngHQztsj-bPl02G6sinlA6YvROH3heSHtoy5Tl1yJyUWT_V5xHN'></script>
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

        function getDates(){
            fetch("getdates.php", { credentials: 'include' })
                .then(response => response.json())
                .then(getDatesSuccess); 
        }


        function getDatesSuccess(json) {
            for(var i = 0; i < json.length; i++){
            loc = new Microsoft.Maps.Location(json[i].latitude, json[i].longitude);
                myPin = new Microsoft.Maps.Pushpin(loc, { 
                    title: json[i].title,
                    icon: 'imgs/HeartDropPin.png',
                    color: '#FF5757'});
                myPin.metadata = {
                    id: json[i].id,
                    infoTitle: json[i].title,
                    infoDescription: json[i].address,
                    infoFullDesc: json[i].desc,
                    catagory: json[i].category,
                    upvotes: json[i].upvotes,
                    downvotes: json[i].downvotes
                };
                map.entities.push(myPin);
                Microsoft.Maps.Events.addHandler(myPin, 'click', activatedInfoBox);
            }

        }

        function activatedInfoBox(e) {
            infobox.setLocation(new Microsoft.Maps.Location(e.target.getLocation().latitude, e.target.getLocation().longitude));
            infobox.setOptions({ location: location, title: e.target.metadata.infoTitle, description: e.target.metadata.infoDescription, visible: true });
        }


      $(document).ready(function(){
    
        //This is where we actually submit the form info into a post request to our server
        function addDate(){
            var dateTitle = document.getElementById("dateTitle");
            var dateAddress = document.getElementById("dateAddress");
            var dateDesc = document.getElementById("dateDesc");
            var dateLatitude = document.getElementById("dateLatitude");
            var dateLongitude = document.getElementById("dateLongitude");
            var dateCategory = document.getElementById("dateCategory");
                                   
            var params =    "dateTitle=" + dateTitle.value +
                            "&dateAddress=" + dateAddress.value + 
                            "&dateDesc=" + dateDesc.value + 
                            "&dateLatitude=" + dateLatitude.value + 
                            "&dateLongitude=" + dateLongitude.value + 
                            "&dateCategory=" + dateCategory.value;
            


            fetch("addNewDate.php", {
                method: 'POST',
                credentials: 'include',
                headers: {"Content-Type": "application/x-www-form-urlencoded"},
                body: params 
                })
                .then(response => response.text()) 
                .then(addDateSuccess); 
        }

        function addDateSuccess(text){
            $("#addDateSuccess").text( text + ", refresh the page to see the updated map.");
        }

        $("#addDate").click(function(){
            addDate();
        });

      });
    </script>
  </body>
</html>
