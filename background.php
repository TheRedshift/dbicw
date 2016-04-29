<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" type="text/css" href="homepage.css">
    <meta charset="UTF-8">
    <title>The Compendium</title>
</head>

<body>

<!-- Css adapted from http://www.secondpicture.com/tutorials/web_design/css_ul_li_horizontal_css_menu.html -->
<ul>
    <li><a href="ArtistPage.php">Artists</a></li>
    <li><a href="CdPage.php">CDs</a></li>
    <li><a href="TrackPage.php">Tracks</a></li>
    <li><a href="Homepage.php">Home</a></li>
    <li><a style="background-image: none;" href="about.php">About</a></li>
</ul>

<br>


<div class="searches">
    <span>
        <form action="searchArtist.php">

            <h1>Search for an artist-</h1>

            <br><br>

            <p>
                Artist name:
                <input type="text" name="search" autofocus minlength="1" maxlength="99" required/>
            </p>


            <p>
                <input type="submit" value="Confirm" />
            </p>


        </form>


    </span>


    <span>


        <form action="searchCD.php">

            <h1>Search for a CD-</h1>

            <br><br>

            <p>
                CD title:
                <input type="text" name="search" autofocus minlength="1" maxlength="99" required/>
            </p>


            <p>
                <input type="submit" value="Confirm" />
            </p>


        </form>


    </span>



    <span>

        <form action="searchTrack.php">

            <h1>Search for a Track-</h1>

            <br><br>

            <p>
                Track title:
                <input type="text" name="search" autofocus minlength="1" maxlength="99" required/>
            </p>


            <p>
                <input type="submit" value="Confirm" />
            </p>


        </form>

    </span>

</div>

<br><br>




</body>
</html>