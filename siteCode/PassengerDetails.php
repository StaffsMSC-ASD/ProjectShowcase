<?php

session_start();
include("connect.php");
$query = "SELECT flight_number FROM PASSENGER_AET_FLIGHT WHERE passenger_id='".$_GET['id']."' ";
$query2="SELECT firstname,surname FROM PASSENGER_DETAIL WHERE passenger_id='".$_GET['id']."' ";
$_SESSION['id'] =$_GET['id'];

/*When the Select button for a certain passenger from ListOfPassengers.php is clicked */
if(!empty($_GET['id']))
{
	$userid=$_GET['id'];
	// Getting the flight number
	$result=mysqli_query($link,$query);
	if(!$result) {

     die("QUERY FAILED" . mysqli_error($link));
    }
		while ($row = mysqli_fetch_array($result,MYSQLI_NUM)){
			$flightnum=$row[0];

		}
	// Getting the Passenger's Firstname and Surname
	$result2=mysqli_query($link,$query2);
	if(!$result2) {

     die("QUERY FAILED" . mysqli_error($link));
    }
	while ($row = mysqli_fetch_array($result2,MYSQLI_NUM)){
		$firstname=$row[0];
		$surname=$row[1];
	}
     //Getting The flight details
	$query3="SELECT destination,origin FROM FLIGHT_DETAIL WHERE flight_number='".$flightnum."' ";
	$result3=mysqli_query($link,$query3);
	if(!$result3) {

     die("QUERY FAILED" . mysqli_error($link));
    }
	while ($row = mysqli_fetch_array($result3,MYSQLI_NUM)){
		$destination=$row[0];
		$origin=$row[1];
	}
}
?>

 <!DOCTYPE html>
<html>
     <head>
               <meta charset="UTF-8">
               <title>TheGreenSystem.com </title>
               <link rel="stylesheet" type="text/css" href= "css/HomePage.css">
                <meta name="viewport" content="width=device-width, inital-1.8">

    </head>
         <body>
           <header>
             <div class="container">
                 <div id="branding">
                     <h1><span class="highlight">The GreenLine</span> Passenger Targeting System </h1>
                </div>

                  <div>
                     <nav>
                        <ul>
                      <li><a href="HomePage.php">Home</a></li>
                      <li><a href="searchPassenger.php">Passenger Search</a></li>
                      <li><a href="searchFlights.php">Flight Search</a></li>

                   </ul>
                       </nav>
                   </div>
               </div>
            </header>


              <div class="wrapper">

       <h1> Passenger Details Found</h1>

       <p>Passenger Details found for passenger <?php echo $firstname . " " . $surname;?></p>


               <table>

                   <tr>
                       <td>Flight Number</td>
                       <td><?php echo $flightnum ?></td>
                   </tr>
                  <tr>
                       <td>Destination</td>
                       <td><?php echo $destination  ?></td>
                   </tr>
                   <tr>
                       <td>Origin</td>
                       <td><?php echo $origin ?></td>
                   </tr>


               </table>

       <form action = "RiskDetails.php" method = "POST">
       <p><input type="submit" name="getRisk" value="View Risk Analysis Details" />
               </p>
       </form>

              </div>


        <footer class="mainFooter">
            <p><a href="#" title="The GreenLine System" TheTheGreenLineSystem.com> GreenLine Systems </a>, Passenger Targeting System :: Copyright &copy; 2017</br>
            Staffordshire University - MSc - Agile Software Development group project September - December 2017 </p>
        </footer>

        </body>
</html>
