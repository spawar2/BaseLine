<!DOCTYPE html>
<html>
<head>  
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
ul, #myUL {
  list-style-type: none;
}

#myUL {
  margin: 0;
  padding: 0;
}

.caret {
  cursor: pointer;
  -webkit-user-select: none; /* Safari 3.1+ */
  -moz-user-select: none; /* Firefox 2+ */
  -ms-user-select: none; /* IE 10+ */
  user-select: none;
}

.caret::before {
  content: "\25B6";
  color: black;
  display: inline-block;
  margin-right: 6px;
}

.caret-down::before {
  -ms-transform: rotate(90deg); /* IE 9 */
  -webkit-transform: rotate(90deg); /* Safari */'
  transform: rotate(90deg);  
}

.nested {
  display: list-item;
}

.active {
  display: block;
}
</style>

</head>
<body>
<div class="container">
<p>
<p><img src="images/logo.png" width="350" height="98"  alt=""/></p>
<p>&nbsp;</p>

<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  
  <tr>
   


    <td width="202" align="left" valign="top" bgcolor="#CCCCCC">
<p></p>

<ul id="myUL">
  <li><span class="caret">Level 1</span>
    <ul class="nested">
      <li>  <a href="ontologydemo.php?id=Influenza A virus">Influenza A virus</a></li>
      <li><span class="caret">Level 2</span>
        <ul class="nested">
          <li><a href="ontologydemo.php?id=H3N2">H3N2</a></li>
           <li><a href="ontologydemo.php?id=H1N1">H1N1</a></li>
          <li><span class="caret">Level 3</span>
            <ul class="nested">
              <li><a href="ontologydemo.php?id=A/California/7/2009">A/California/7/2009</a></li>
              </ul>
          </li>
              </li>  
    </ul>
  </li>
</ul>
</td>


    <td width="1439" align="left" valign="top"><?php
            
               $plot_type=$_GET['id'];
			   if ($plot_type=="Influenza A virus")
			   {?>
            <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Influenza A virus</b></br> 

				<img src="haisheets/level1.png" width="1000" height="746">
                  
               <?php } else if($plot_type=="H3N2") {?>
               
				 <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Influenza A virus -> H3N2 </b></br>
				    <img src="haisheets/copylevel2.png" width="1003" height="740">
				   
			   <?php } 
			   
			  else if($plot_type=="H1N1") {?>
			   
			    <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Influenza A virus -> H1N1 </b></br>
				    <img src="haisheets/copylevel2hini.png" width="1003" height="740">
			   
			 <?PHP }  else{?>
	    <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Influenza A virus -> H1N1 -> A/California/7/2009</b></br>

				   				    <img src="haisheets/copylevel3.png" width="1010" height="733">

				 <?php }?>
            
      </td>
  </tr>

</table>
</div>

<script>
var toggler = document.getElementsByClassName("caret");
var i;

for (i = 0; i < toggler.length; i++) {
  toggler[i].addEventListener("click", function() {
    this.parentElement.querySelector(".nested").classList.toggle("active");
    this.classList.toggle("caret-down");
  });
}
</script>


</body>
</html>
