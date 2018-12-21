<?php 
    session_start();   
?>
<html>
<head>
<meta charset="utf-8"/>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCDTsY7Kesp9DHySpgaiyrVKjX0reVqI_A"></script>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~CSS Starts~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<style type="text/css">

a, a:link, a:visited {text-decoration:none; color: black;}
a:hover{color:#ccc;}
    
button:focus {outline:0;}
select:focus {outline:0;}
    
.parentDiv{
    position:relative;
    width: 1400p;
    height:1500px;
     margin: 0px;
    padding: 0px;
     text-align: center;
}
.searchtable td{
    padding-left: 25px;
}
.searchtable{
    position:absolute;
    border: 4px solid #ccc;
    margin-left:400px;
    margin-top: 100px;
    width: 650px;
    height: 250px;
    background-color:rgb(250,250,250);
    font-weight: bold;
    font-size: 13px;
}
.title{
    font-size: 30px;
    font-weight: 200;
    font-style: italic;
    text-align: center;
    padding-left: 0px;
}
hr {
    display: block;
    height: 1px;
    border: 0;
    border-top: 3px solid #ccc;
    margin-top: 5px;
    padding: 0; 
    width:96%;

}
button, #searchButt{
    border-radius: 4px;
    padding: 5px 22px;
    text-align: center;
    font-size: 12px;
}


.infoDiv{
    position:absolute;
    margin-top: 400px;
    width: 1400px;
    height: 100%;
    text-align: center;
}
.eventsTabl{
    margin-left:250px;
    width: 1000px;
    height: auto;
    font-size: 17px;
    border-collapse:collapse;
    display:none;
}
.eventsTabl tr td,th{
    border: 2px solid #ccc;
    padding-left: 5px;
}
.detailDiv{
   width: 100%;
    height: auto;
}
.detialTabl{
    margin-left:350px;
     width: 900px;
    height: auto;
    font-size: 15px;
    border-collapse:collapse;
    display: none;

}
.detialTabl tr{
    width:900px;
}
.venueTabl{
    margin-left:290px;
    width: 900px;
    height: auto;
    font-size: 15px;
    border-collapse:collapse;
    padding: 0px;
    display :none;
     padding: 0px;

}
.venueTabl tr td{
    width: 900px;
    margin: 0px;
    border: 2px solid #ccc;
}
.imagesTabl{
    border: 3px solid #ccc;
    margin-left:290px;
    width: 900px;
    height: auto;
    font-size: 15px;
    border-collapse:collapse;
    display: none;
    text-align: center;
}
.imagesTabl tr td{
    width: 900px;
    margin: 0px;
    border-bottom: 2px solid #ccc;
}
#mapid {
    height: 330px; 
    width: 380px; 
    float:right;
    margin-top: 25px;
    margin-right: 150px;
   }
#venuemode{
    padding: 10px;
    border: 0px;
    font-size: 15px;
    font-weight: bold;
    height:80px;
    background-color: #ccc;
    margin-top: 85px;
    margin-left: 30px;
}
.detailButton{
    text-align: center;
     display: none;
}

</style>

<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~Here location search~~~~~~~~~~~~~~~~~~~~~~~~-->
<script language="Javascript">  
var startLat;
var  startLon;
function getMyLocation() {
    document.getElementById("searchButt").disabled=true;
   
    var xmlhttp=new XMLHttpRequest(); 
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4) {
            if(xmlhttp.status == 200){
                var res = JSON.parse(xmlhttp.responseText);
                document.getElementById("latHere").value=res["lat"];
              
                document.getElementById("lonHere").value=res["lon"];
              
                document.getElementById("searchButt").disabled=false;
            }
        }
    };
    xmlhttp.overrideMimeType("application/json");
    xmlhttp.open("GET","http://ip-api.com/json",false); //open, send, responseText are 
    xmlhttp.send(); // Here a xmlhttprequestexception number 101 is thrown 
     
    
}
function   disTooltip(){
     document.getElementById("location").disabled=true;
     document.getElementById("location").removeAttribute("required");
}
function makeTooltip(){
    document.getElementById("location").removeAttribute("disabled");
    document.getElementById("location").required = true;
}
    
function doClear(){

    document.getElementById("keyword").value="";
    document.getElementById("radius").value="";
    document.getElementById("location").value="";
    document.getElementById("segmentId").value="";
    disTooltip();
    document.getElementById("start0").checked=true;
    document.getElementById("start1").checked=false;
    document.getElementById("eventsTabl").innerHTML="";
    document.getElementById("detialTabl").innerHTML="";
    document.getElementById("venueTabl").innerHTML="";
    document.getElementById("imagesTabl").innerHTML="";
    document.getElementById("infoDiv").style.display="none";
} 
function  locationAlter(){
    alert("invalid location!Please fill out again!");
}
</script>
</head>
<body onload="getMyLocation();">
<div class="parentDiv" id="parentDiv">
<form method="post" action="$_SERVER['PHP_SELF']">
    <table class='searchtable'>
        <tr>
            <td class="title" colspan="2" >Events Search
            <hr>
            </td>
        </tr>
        <tr>
            <td colspan="2" >Keyword 
                <input type="text" id="keyword" name="keyword" value="" required>
            </td>
        </tr>
        <tr>
            <td colspan="2" >Category
             <select name="segmentId" id="segmentId">
              <option value="" selected >default</option>
              <option value="KZFzniwnSyZfZ7v7nJ">Music</option>
              <option value="KZFzniwnSyZfZ7v7nE">Sports</option>
             <option value="KZFzniwnSyZfZ7v7na">Arts&amp;Theatre</option>
              <option value="KZFzniwnSyZfZ7v7nn">Film</option>
              <option value="KZFzniwnSyZfZ7v7n1">Miscellaneous</option>
            </select></td>
        </tr>
        <tr>
            <td>Distance(miles)  <input type="text" name="radius" id="radius" size="30px" placeholder="10" value="" >   from<br>
            </td>
            <td style="width:42%;padding-top:15px;">
                <input type="radio" name="start" id="start0" value="0" checked onclick="disTooltip()" 
                       >Here<br>
                <input type="hidden" name="latHere" id="latHere">
                <input type="hidden" name="lonHere" id="lonHere">
                <input type="radio" name="start" id="start1" value="1"   onclick="makeTooltip();"  >
                <input type="text" name="location" id="location" size="25px" placeholder="location" disabled value="" >
            </td>
        </tr>
       
        <tr>
            <td style="text-align: center">
                <input type="submit" value="Search" name="submit" id="searchButt">
                <button type="button" name="clear"  onclick="doClear();">Clear</button></td>
            <td></td>
        </tr>
    </table>
</form>    
    <div class="infoDiv" id="infoDiv">
        <table  class="eventsTabl" id="eventsTabl"></table>
        
        
        <div class="detailDiv" id="detailDiv">
            <table class='detialTabl' id="detialTabl"></table>
            
            <div style="width:100%;">
                <button onclick="clickShowVenue();" class="detailButton" id="venButt" style="border:0px;color:#ccc;font-size:20px;margin-left:43%;background-color:white;"><b>click to show venue info</b><br/>
                 <img src="http://csci571.com/hw/hw6/images/arrow_down.png"  id="venArrow" height="35px" width="65px" class="arrow">
                </button>
            </div>
            <table class="venueTabl" id="venueTabl"></table>
            
            <div style="width:100%;">
                <button onclick="clickShowImage();" class="detailButton"  id="phoButt"  style="border:0px;color:#ccc;font-size:20px;margin-left:42%;background-color:white;"><b>click to show venue photos</b><br/>
                 <img src="http://csci571.com/hw/hw6/images/arrow_down.png"  id="phoArrow" height="40px" width="70px" class="arrow">
                </button>
            </div>
            <table class='imagesTabl' id="imagesTabl"></table>
            
        </div>
    </div>

</div>
    
</body>

</html>

<script type="text/javascript">
//----------------------------------------------------Evnets List Table------------------------------------------------//
    var res;
    var formdata;
    function createEventListTable(){
        document.getElementById("keyword").value=formdata.keyword;
        document.getElementById('segmentId').value = formdata.selected;
        document.getElementById("radius").value=formdata.distance;
        var radiovalue=formdata.radio;
        if(radiovalue==document.getElementById("start0").value){
            document.getElementById("start0").checked=true;
            document.getElementById("start1").checked=false;
            disTooltip();
        }else{
            document.getElementById("start1").checked=true;
            document.getElementById("start0").checked=false;
            makeTooltip();
        }
        
        if(formdata.location!=null){
            document.getElementById("location").value=formdata.location;
        }
        
        
        
        document.getElementById("eventsTabl").style.display = "block";
        document.getElementById("detailDiv").style.display = "none";
         
        var htmlInfo="";
         if(res==null||typeof(res["_embedded"])=="undefined"||typeof(res["_embedded"]["events"])=="undefined"||res["_embedded"]["events"].length==0){
             htmlInfo="<tr><td style='width:1200px;background-color:#ccc;border:1p solid #ccc;text-align:center;' colspan='5'>No Events Records has been found</td></tr>";
         }else{
             var eventList = res["_embedded"]["events"];
             htmlInfo="<tr><th style='width:90px;'>Date</th><th  style='width:90px;'>Icon</th><th  style='width:650px;'>Event</th><th style='width:60px;'>Genre</th><th style='width:400px;'>Venue</th></tr>";
             for(var i=0;i<eventList.length;i++){
                 htmlInfo+="<tr><td>";
                 if(typeof(eventList[i].dates)=="undefined"||typeof(eventList[i].dates.start)=="undefined"||(typeof(eventList[i].dates.start.localDate)=="undefined"&&typeof(eventList[i].dates.start.localTime)!="undefined")){
                     htmlInfo+="N/A<br/>&nbsp;";
                 }else{
                     
                     if(typeof(eventList[i].dates.start.localDate)!="undefined"){
                        htmlInfo+=eventList[i].dates.start.localDate+"<br/>&nbsp;";
                     }
                     if(typeof(eventList[i].dates.start.localTime)!="undefined"){
                         htmlInfo+=""+eventList[i].dates.start.localTime;
                      }
                 }
                  htmlInfo+="</td><td>";
                 if(typeof(eventList[i].images)=="undefined"||eventList[i].images.length==0||typeof(eventList[i].images[0].url)=="undefined"){
                      htmlInfo+="N/A";
                 }else{
                     htmlInfo+="<img src="+eventList[i].images[0].url+" width='75px' height='50px'>";
                 }
                  
                   htmlInfo+="</td><td>";
                  if(typeof(eventList[i].name)=="undefined"){
                      htmlInfo+="N/A";
                  }else{
                   htmlInfo+="<a href='?eventId="+eventList[i].id+"&venueName="+eventList[i]._embedded.venues[0].name+"'>"+eventList[i].name+"</a>";
                  } 
                  htmlInfo+="</td><td>";
                 if(typeof(eventList[i].classifications)!="undefined"&&typeof(eventList[i].classifications[0].segment)!="undefined"){
                      htmlInfo+=""+eventList[i].classifications[0].segment.name+"</td>";
                  }else{
                       htmlInfo+="N/A";
                  }
                   htmlInfo+="</td><td style='padding-left:10px;'>"; if(typeof(eventList[i]._embedded)=="undefined"||typeof(eventList[i]._embedded.venues)=="undefined"||eventList[i]._embedded.venues.length==0||typeof(eventList[i]._embedded.venues[0].name)=="undefined"||typeof(eventList[i]._embedded.venues[0].location)=="undefined"||typeof(eventList[i]._embedded.venues[0].location.latitude)=="undefined"||typeof(eventList[i]._embedded.venues[0].location.longitude)=="undefined"){
                        htmlInfo+="N/A";
                     }else{
                         htmlInfo+="<div style='margin:0px;width:100%;height:100%;position:relative;'><div onclick='showMap("+i+");'style='margin:0px;'>"+eventList[i]._embedded.venues[0].name+"<input type='hidden' id='resEvenLat"+i+"' value='"+eventList[i]._embedded.venues[0].location.latitude+"'/><input type='hidden' id='resEvenLon"+i+"' value='"+eventList[i]._embedded.venues[0].location.longitude+"'/></div>"
                        +"<div id='tdid"+i+"' class='mapclass' style='width:300px;height:300px;z-index:50;position:absolute;display:none;'></div>"
                        +"<div  id='selectDiv"+i+"' class='selectclass' style='z-index:100;position:absolute;background-color:#ccc;display:none;'>"
                        +"<select id='resmode"+i+"'  style='background-color:#ccc;padding-top:10px;border: 0px;font-size: 13px;font-weight: bold;height:70px;line-height:5px;' size=3>"
                        +"<option value='WALKING'>Walk there</option>"
                        +"<option value='BICYCLING'>Bike there</option>"
                        +"<option value='DRIVING'>Drive there</option></select></div></div>";
                     }
                 
                    htmlInfo+="</td></tr>";
             }
         }

        document.getElementById("eventsTabl").innerHTML=htmlInfo;
    }
</script>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~Call Events list  Info API  PHP~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<?php
    include ("geoHash.php");
    
    if (!empty($_POST)&& isset($_POST["submit"]) ) {
        
        if($_POST['start']==1){
            //  before using this API , enable billing . After using this , disable billing!!!!!!!!!!!!!!!!!!!
            $_googleApiKey="AIzaSyCDTsY7Kesp9DHySpgaiyrVKjX0reVqI_A";
            $_locationInput = $_POST["location"];
            $_url =  "https://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($_locationInput)."&key=".$_googleApiKey;
            $_resLocation = json_decode(file_get_contents($_url),true);
            $_locationRes = $_resLocation["results"][0][geometry][location];
            $_resLat = $_locationRes["lat"];
            $_resLon = $_locationRes["lng"];
        }else{
            $_resLat=$_POST["latHere"];
            $_resLon=$_POST["lonHere"];
           
        }
        if($_resLat==""||$_resLon==""){
             echo "<script type='text/javascript'>locationAlter();</script>";
        }else{
            $_SESSION['latforever'] = $_resLat;
            $_SESSION['lonforever'] = $_resLon;

            //---------------------------------------TicketMaster Parameters
            $geoPoint = encode($_resLat,$_resLon);
            $keyword=$_POST["keyword"];
            $radius=$_POST["radius"];
            if($radius=="") $radius="10";
            $segmentId=$_POST["segmentId"];
            $unit = "miles";
            $ticketApiKey = "xF34U9ON4RI6uaaIMUirrSbb8hOGKVhb";
            $_urlTickets="https://app.ticketmaster.com/discovery/v2/events.json?apikey=".$ticketApiKey."&keyword=".urlencode($keyword)."&segmentId=".$segmentId."&radius=".$radius."&unit=".$unit."&geoPoint=".$geoPoint;

            $_resultValue = json_decode(file_get_contents($_urlTickets));
            $_resultValue = json_encode($_resultValue);

            // for holding form data
            $formarry = array("keyword" => $keyword, "selected" => $segmentId, "distance" => $radius,"radio"=>$_POST['start'],"location"=>$_POST["location"]);
            $_SESSION['formarry'] = $formarry;
            $formdata = json_encode($formarry);
            echo "<script type='text/javascript'>formdata=".$formdata.";startLat=".$_resLat.";startLon=".$_resLon.";res=".$_resultValue.";createEventListTable();</script>";
        }
    }
//if(isset($_POST["clear"])){
//    
//    $_SESSION['formarry'] = array();
//    echo $_SESSION['formarry'];
//    echo $_POST["clear"];
//}
   
?>
<!--~~~~~~~~~~~~~~~~~~~~~~Events List Control ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<script type="text/javascript"> 
function showMap(no){
    var idcurrent = "tdid"+no;
    var selectcurrent ="selectDiv"+no;
    var mapArry = document.getElementsByClassName("mapclass");
    var selectArry = document.getElementsByClassName("selectclass");
    for(var i=0;i<mapArry.length;i++){
        var idvalue = mapArry[i].id;
        if(idvalue!=idcurrent){
            mapArry[i].style.display = "none";
            selectArry[i].style.display = "none";
        }
    }
   var mapDiv = document.getElementById(idcurrent);
    if (mapDiv.style.display === "none") {
        mapDiv.style.display = "block";
        document.getElementById(selectcurrent).style.display = "block";
        document.getElementById("resmode"+no).value = "";
       
        initResultsMap(no);
    } else {
        mapDiv.style.display = "none";
        document.getElementById(selectcurrent).style.display = "none";
       
    }
}
function initResultsMap(no) {
    var dirDisplay = new google.maps.DirectionsRenderer;
    var dirService = new google.maps.DirectionsService;
    var Latt = Number(document.getElementById('resEvenLat'+no).value);
    var Lonn = Number(document.getElementById('resEvenLon'+no).value);
    var uluru = {lat: Latt, lng:Lonn};
  // The map, centered at Uluru
    var map = new google.maps.Map(
    document.getElementById("tdid"+no), {zoom: 13, center: uluru});
  // The marker, positioned at Uluru
    var marker = new google.maps.Marker({position: uluru, map: map});
    dirDisplay.setMap(map); 
    document.getElementById('resmode'+no).addEventListener('change', function() {
       calculate(dirService, dirDisplay,no);
    });

}
 
function calculate(dirService, dirDisplay,no) {
     var selectedMode = document.getElementById('resmode'+no).value;
     var destinationLat = Number(document.getElementById('resEvenLat'+no).value);
     var destinationLon = Number(document.getElementById('resEvenLon'+no).value);
    dirService.route({
      origin: {lat: Number(startLat), lng: Number(startLon)}, 
      destination: {lat: destinationLat, lng: destinationLon},  
      
      travelMode: google.maps.TravelMode[selectedMode]
    }, function(response, status) {
      if (status == 'OK') {
        dirDisplay.setDirections(response);
      } else {
        window.alert('Directions request failed due to ' + status);
      }
    });
}
</script>


<script type="text/javascript">
var resDetial;
var keepform;
//----------------------------------------------------Detial Table------------------------------------------------//
    function createDetialTable(){
        document.getElementById("keyword").value=keepform.keyword;
        document.getElementById('segmentId').value = keepform.selected;
        document.getElementById("radius").value=keepform.distance;
        var radiovalue=keepform.radio;
        if(radiovalue==document.getElementById("start0").value){
            document.getElementById("start0").checked=true;
            document.getElementById("start1").checked=false;
            disTooltip();
        }else{
            document.getElementById("start1").checked=true;
            document.getElementById("start0").checked=false;
            makeTooltip();
        }
        
        if(keepform.location!=null){
            document.getElementById("location").value=keepform.location;
        }
        
        var htmlDetial="";
        if(resDetial==null){
            htmlDetial="<tr><td colspan='2' style='text-align: center;'>No Detial Records has been found</td></tr>";
        }else{
             htmlDetial=" <caption style='text:align:center;'><h2>"+resDetial.name+"</h2></caption>";
             htmlDetial+="<tr>";
             if(typeof(resDetial.seatmap)=="undefined"){
                htmlDetial+="<td><div style='width:350px;'></div></td>";
              }
             htmlDetial+="<td>";
             if(typeof(resDetial.dates)!="undefined"||typeof(resDetial.dates.start)!="undefined"){
                 htmlDetial+="<b>Date</b><br/><br/>"+resDetial.dates.start.localDate+"&nbsp;";
                 if(typeof(resDetial.dates.start.localTime)!="undefined"){
                    htmlDetial+=""+resDetial.dates.start.localTime;
                 }
                  htmlDetial+="<br/><br/>";
             }
            
             if(typeof(resDetial._embedded.attractions)!="undefined"){
                htmlDetial+="<b>Artist/Team</b><br/><br/>"
                 var atrractions = resDetial._embedded.attractions;
                 for(var at=0;at<atrractions.length-1;at++){
                       htmlDetial+="<a href='"+atrractions[at].url+"' target='_black'/>"+atrractions[at].name+"</a>|&nbsp;&nbsp;";
                 }
                 if(atrractions.length>0){
                     htmlDetial+="<a href='"+atrractions[at].url+"' target='_black'/>"+atrractions[atrractions.length-1].name+"</a><br/><br/>";
                 }
             }
             htmlDetial+="<b>Venue</b><br/>"+resDetial._embedded.venues[0].name+"<br/><br/>";
             if(typeof(resDetial.classifications)!="undefined"){
                 htmlDetial+="<b>Genres</b><br/><br/>";
                 if(typeof(resDetial.classifications[0].subGenre)!="undefined"&&resDetial.classifications[0].subGenre.name!="Undefined"){
                    htmlDetial+=""+resDetial.classifications[0].subGenre.name;}
                 if(typeof(resDetial.classifications[0].genre)!="undefined"&&resDetial.classifications[0].genre.name!="Undefined"){
                    htmlDetial+="|"+resDetial.classifications[0].genre.name;}
                 if(typeof(resDetial.classifications[0].segment)!="undefined"&&resDetial.classifications[0].segment.name!="Undefined"){
                    htmlDetial+="|"+resDetial.classifications[0].segment.name;}
                 if(typeof(resDetial.classifications[0].subType)!="undefined"&&resDetial.classifications[0].subType.name!="Undefined"){
                    htmlDetial+="|"+resDetial.classifications[0].subType.name;}
                 if(typeof(resDetial.classifications[0].type)!="undefined"&&resDetial.classifications[0].type.name!="Undefined"){
                    htmlDetial+="|"+resDetial.classifications[0].type.name;}
                                     
                 htmlDetial+="<br/><br/>";
             }
             if(typeof(resDetial.priceRanges)!="undefined"){
                 htmlDetial +="<b>Price Ranges</b><br/><br/>";
                if(typeof(resDetial.priceRanges[0].min)!="undefined" && typeof(resDetial.priceRanges[0].max)!="undefined"){
                     htmlDetial +=resDetial.priceRanges[0].min+"-"+resDetial.priceRanges[0].max+"&nbsp;";
                 }else{
                     if(typeof(resDetial.priceRanges[0].min)=="undefined"){
                         htmlDetial +=resDetial.priceRanges[0].max+"&nbsp;";
                     }
                      if(typeof(resDetial.priceRanges[0].max)=="undefined"){
                         htmlDetial +=resDetial.priceRanges[0].min+"&nbsp;";
                     }
                 }
                 
                 if(typeof(resDetial.priceRanges[0].currency)!="undefined"){
                   htmlDetial +=""+resDetial.priceRanges[0].currency;
                 }
                 htmlDetial +="<br/><br/>";
             }
             if(typeof(resDetial.dates)!="undefined"||typeof(resDetial.dates.code)!="undefined"){
                htmlDetial +="<b>Ticket Status</b><br/><br/>"+resDetial.dates.status.code+"<br/><br/>";
             }
             htmlDetial +="<b>Buy Ticket At:</b><br/><br/><a href="+resDetial.url+" target='_blank'>Ticketmaster</a><br/><br/>";
             htmlDetial +="</td>";
             if(typeof(resDetial.seatmap)!="undefined"){
                 htmlDetial+="<td><img src="+resDetial.seatmap.staticUrl+" width='500px' height='300px'></td>"
                }else{
                    htmlDetial+="<td><div style='width:350px;'></div></td>";
                }
             htmlDetial+="</tr>";
           
            document.getElementById("venButt").style.display="block";
            document.getElementById("phoButt").style.display="block";
           
        }
        document.getElementById("detialTabl").innerHTML=htmlDetial;
        document.getElementById("detialTabl").style.display="block";
        document.getElementById("eventsTabl").style.display = "none";
    }
//----------------------------------------------------VenueTable-----------------------------------------------------//
    var venueDetial;
    
     function createVenueANDImagTable(){
          var htmlVenue="";
          var venueInfo = {};
         
         if(venueDetial==null||typeof(venueDetial._embedded)=="undefined"){
             htmlVenue="<tr><td colspan='2' style='text-align: center;'>No Venue Info Found</td></tr>";
         }else{
             venueInfo = venueDetial["_embedded"]["venues"][0];
             htmlVenue+="<tr><td style='width:20%;text-align:right;'><b>Name</b></td><td style='width:80%;text-align:center;'>"+venueInfo.name+"</td></tr>";
             htmlVenue+="<tr><td style='text-align:right;'><b>Map</b><input type='hidden' id='venLat' value='"+venueInfo.location.latitude+"'><input type='hidden' id='venLon' value='"+venueInfo.location.longitude+"'></td>";
              htmlVenue+="<td style='text-align:center;'>"
                      +"<select id='venuemode' size=2>"
                      +"<option value='WALKING'>Walk there</option>"
                      +"<option value='BICYCLING'>Bike there</option>"
                      +"<option value='DRIVING'>Drive there</option></select>"
                      +"<div id='mapid'>Map</div></td></tr>";
             htmlVenue+="<tr><td style='text-align:right;'><b>Address</b></td><td style='text-align:center;'>";
             if(typeof(venueInfo.address)=="undefined"||typeof(venueInfo.address.line1)=="undefined"){
                  htmlVenue+="N/A";
             }else{
                   htmlVenue+=""+venueInfo.address.line1;
             }
             htmlVenue+= "</td></tr>";
             htmlVenue+="<tr><td style='text-align:right;'><b>City</b></td><td style='text-align:center;'>";
             if(typeof(venueInfo.city)=="undefined"||typeof(venueInfo.city.name)=="undefined"){
                htmlVenue+="N/A";
             }else{
                   htmlVenue+=venueInfo.city.name;
             }
              htmlVenue+=",";
              if(typeof(venueInfo.state)=="undefined"||typeof(venueInfo.state.stateCode)=="undefined"){
                htmlVenue+="N/A";
             }else{
                htmlVenue+=venueInfo.state.stateCode;
             }
             htmlVenue+="</td></tr>";
             htmlVenue+="<tr><td style='text-align:right;'><b>Postal Code</b></td><td style='text-align:center;'>";
             if(typeof(venueInfo.postalCode)=="undefined"){
                htmlVenue+="N/A";
             }else{
              htmlVenue+=venueInfo.postalCode;
             }
              htmlVenue+="</td></tr>";
             htmlVenue+="<tr><td style='text-align:right;'><b>Upcoming Events</b></td><td style='text-align:center;'><a href="+venueInfo.url+" target='_blank'>"+venueInfo.name+" Tickes</a></td></tr>";

         }
        document.getElementById("venueTabl").innerHTML=htmlVenue;
        document.getElementById("venueTabl").style.display = "none";
    
//---------------------------------------------------Venue Images Table-------------------------------------------------//
        var htmlImages="";
         if(venueInfo==null||typeof(venueInfo.images)=="undefined"||venueInfo.images==null||venueInfo.images.length==0){
             htmlImages="<tr><td style='text-align: center;'>No Venue Photos Found</td></tr>";
         }else{
             var imageArr =venueInfo.images;
             for(var im=0;im<imageArr.length;im++){
                 htmlImages+="<tr><td><img src='"+imageArr[im].url+"' width='600px' height='300px'></td></tr>";

             }
         }
        document.getElementById("imagesTabl").innerHTML=htmlImages;
        document.getElementById("imagesTabl").style.display = "none";
    }
</script>

<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~Call detial Info API  PHP~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<?php

if(isset($_GET['eventId'])){
    $_eventId = $_GET['eventId'];
    $_venueName=$_GET['venueName'];
    $ticketApiKey2 = "xF34U9ON4RI6uaaIMUirrSbb8hOGKVhb";
    $_urlEvent = "https://app.ticketmaster.com/discovery/v2/events/".$_eventId."?apikey=".$ticketApiKey2;
    $_eventInfo = json_decode(file_get_contents($_urlEvent));
    $_eventInfo = json_encode($_eventInfo);
    
    $_urlVenue = "https://app.ticketmaster.com/discovery/v2/venues?apikey=".$ticketApiKey2."&keyword=".urlencode($_venueName);
    
    $_venueInfo =  json_decode(file_get_contents($_urlVenue));
    $_venueInfo = json_encode($_venueInfo);
    $_latforever = $_SESSION['latforever'];
    $_lonforever= $_SESSION['lonforever'];
    $_keepdata = json_encode($_SESSION['formarry']) ;
    echo "<script type='text/javascript'>keepform=".$_keepdata.";resDetial=".$_eventInfo.";createDetialTable();</script>";
    echo "<script type='text/javascript'>venueDetial=".$_venueInfo.";startLat=".$_latforever.";startLon=".$_lonforever.";createVenueANDImagTable();</script>";
}
?>
<!--~~~~~~~~~~~~~~~~~~~~~~Venue Map Control ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

 <script type="text/javascript">
function clickShowVenue() {
    var x = document.getElementById("venueTabl");
    var y = document.getElementById("imagesTabl");
    if (x.style.display === "none") {
    if(document.getElementById("venuemode")!=null&&typeof(document.getElementById("venuemode").value)!="undefined"){
            document.getElementById("venuemode").value="";
     }
        x.style.display = "block";
        document.getElementById("venArrow").src="http://csci571.com/hw/hw6/images/arrow_up.png";
        y.style.display = "none";
        document.getElementById("phoArrow").src="http://csci571.com/hw/hw6/images/arrow_down.png";
        if(document.getElementById('venLat')!=null){
            initMap();
        }
    } else {
        x.style.display = "none";
        document.getElementById("venArrow").src="http://csci571.com/hw/hw6/images/arrow_down.png";
        y.style.display = "block";
        document.getElementById("phoArrow").src="http://csci571.com/hw/hw6/images/arrow_up.png";
       
    }
}
// before use, go to GCP  to enable google map Api  and Direction API!!!!!!!!!!!
function initMap() {
    var Latt = Number(document.getElementById('venLat').value);
    var Lonn = Number(document.getElementById('venLon').value);
    if(Latt==""){
        document.getElementById('mapid').innerHTML="N/A";
    }else{
        var directionsDisplay = new google.maps.DirectionsRenderer;
        var directionsService = new google.maps.DirectionsService;
      // The location of Uluru

      var uluru = {lat: Latt, lng:Lonn};
      // The map, centered at Uluru
      var map = new google.maps.Map(
          document.getElementById('mapid'), {zoom: 13, center: uluru});
      // The marker, positioned at Uluru
      var marker = new google.maps.Marker({position: uluru, map: map});
      directionsDisplay.setMap(map);

      document.getElementById('venuemode').addEventListener('change', function() {
          calculateAndDisplayRoute(directionsService, directionsDisplay);
        });
  }
}
 
function calculateAndDisplayRoute(directionsService, directionsDisplay) {
     var selectedMode = document.getElementById('venuemode').value;
     var destinationLat = Number(document.getElementById('venLat').value);
     var destinationLon = Number(document.getElementById('venLon').value);
    directionsService.route({
      origin: {lat: startLat, lng: startLon},  
      destination: {lat: destinationLat, lng: destinationLon},  
      
      travelMode: google.maps.TravelMode[selectedMode]
    }, function(response, status) {
      if (status == 'OK') {
        directionsDisplay.setDirections(response);
      } else {
        window.alert('Directions request failed due to ' + status);
      }
    });
}
function clickShowImage() {
    var tabl = document.getElementById("imagesTabl");
    if (tabl.style.display === "none") {
        document.getElementById("venueTabl").style.display = "none";
        document.getElementById("venArrow").src="http://csci571.com/hw/hw6/images/arrow_down.png";
        tabl.style.display = "block";
        document.getElementById("phoArrow").src="http://csci571.com/hw/hw6/images/arrow_up.png";
    } else {
        tabl.style.display = "none";
        document.getElementById("phoArrow").src="http://csci571.com/hw/hw6/images/arrow_down.png";
       
    }
}
</script>

<!--

onsubmit="submitForm();event.preventDefault();event.stopPropagation()"
-->


