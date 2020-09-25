<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Date Generator</title>
  </head>
  <body>
    <div class="container-fluid">
        <header>
        <h1> <span> <img src="imgs/Logo.png" alt=""> Date Idea Generator</span></h1>
        </header>

        <div class="content">

        <div class="row mb-5">
            <div class="col-md-4">
                <div style="text-align: center;">
                    <img src="imgs/love.svg" style="width: 100%"/>
                </div>
            </div>
            <div class="col-md-8 ">
                <h1>Welcome to the Date Idea Generator</h1>
                <h4 class="mb-5">Our site is based in Hamilton, Ontario. We have hundreds of date options
                    in various categories so you are sure to find a fun night out.</h4>

            <div class="row">
            <div class="col-sm-12 col-md-6">
              <div class="mainmenu-option">
                <a href="randomdate.php">
                    <div style="text-align: center;">
                        <img src="imgs/random.svg" style="width: 60%; height: 148px;"/>
                    </div>

                  <h2>Random Date</h2>
                  <h4>Looks like you're the spontanous one. 
                  Pick this option to get a totally random date.</h4>
                </a>
              </div>
            </div>

            <div class="col-sm-12 col-md-6">
              <div class="mainmenu-option">
                <a href="preferencedate.php">
                    <div style="text-align: center;">
                        <img src="imgs/preference.svg" style="width: 60%; height: 148px;"/>
                    </div>

                  <h2>Based on Preference</h2>
                  <h4>We have a bunch of places that are catagorized to help give 
                  you a more ideal date for that special someone.</h4>
                </a>
              </div>
            </div>

          </div>
        </div>

            <div style="margin-top: 4rem; background-color: #851d41; padding: 2rem; border-radius: 5px;">
              <div class="row mainmenu-option">
                <div class="col-md-10">
                    <a href="addDate.php" class="addnewdate-link">
                        <h2 style="text-align: left; color: #FFF9F9;">Add a New Date</h2>
                        <h4 style="text-align: left; color: #FFF9F9;">Have you found a place that you want to share with others? Add it to the database
                            and let people experience the fun you've had.
                        </h4>
                    </a>
                </div>
                <div class="col-md-2">
                    <img src="imgs/map.svg" style="height: 148px;"/>
                </div>
                </div>
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
  </body>
</html>
