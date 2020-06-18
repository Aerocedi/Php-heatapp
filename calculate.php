<!Doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial=1,shrink-to-fit=no"/>
    <meta content="IE=Edge,chrome=1" http-equiv="X-UA-Compatible">
    <title>Heat_Exchanger Calaculator.php</title>

    <link rel="stylesheet" href="Pub_code/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="Pub_code/bootstrap/css/bootstrap-grid.min.css.map">
    <link rel="stylesheet" href="Pub_code/bootstrap/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="Pub_code/bootstrap/css/bootstrap-grid.css.map">
    <link rel="stylesheet" href="Pub_code/bootstrap/css/bootstrap-grid.css">
    <link rel="stylesheet" href="Pub_code/bootstrap/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="Pub_code/bootstrap/css/bootstrap-reboot.css.map">
    <link rel="stylesheet" href="Pub_code/bootstrap/css/bootstrap-reboot.css">
    <link rel="stylesheet" href="Pub_code/bootstrap/css/bootstrap-reboot.min.css.map">
    <link rel="stylesheet" href="Pub_code/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="Pub_code/bootstrap/css/bootstrap.min.css.map">
    <link rel="stylesheet" href="Pub_code/bootstrap/css/bootstrap.css.map">
    <link rel="stylesheet" href="Pub_code/main.css">
    <link rel="stylesheet" href="Pub_code/font-css/font-awesome.min.css">
    <link rel="icon" href="heat.jpg">
    <script src="Pub_code/jquery-3.2.1.min.js"></script>
</head>
<?php
     $heat=filter_input(INPUT_POST,"heat");
     $fluid1=filter_input(INPUT_POST,"fluid1");
        $fluid2=filter_input(INPUT_POST,"fluid2");
      $Area=filter_input(INPUT_POST,"Area");
      $coefficient=filter_input(INPUT_POST,"coefficient");
      $pel = "Parallel Flow Type";
      $cer = "Counter Flow Type";
      //cold Region
      $mc=filter_input(INPUT_POST,"mc");
      $tcin=filter_input(INPUT_POST,"tcin");
    
      //Hot Region
      $mh=filter_input(INPUT_POST,"mh");
      $thin=filter_input(INPUT_POST,"thin");
      
      $cmax;
      $cmin;
      $ccold;
      $chot;
      $const;
      $NTU;
      $effect;
      $abs;
      $heattrans1;
      $heatrans2;
      $maxtrans;
      $outletcold;
      $outlethot;
          function solve1($val1,$val2){
          global $effect;
          global $mc;
          global $cmax;
          global $cmin;
          global $chot;
          global $ccold;
          global $mh;
          global $const;
          global $NTU;
          global $coefficient;
          global $Area;
          global $abs;
          global $thin;
          global $tcin;
          global $maxtrans;
          global $outletcold;
          global $outlethot;
$chot=$mh*$val2;
$ccold=$mc*$val1;
if($chot>$ccold){
         $cmax=$chot;
         $cmin=$ccold;
$const=$cmin/$cmax;
$NTU=($coefficient*$Area)/($cmin);
$abs=(-$NTU)*(1+$const);
$effect=(1-exp($abs))/(1+$const);
$final=$cmin*($thin-$tcin);
 $maxtrans=$effect*$final;
          $outlethot=$thin-($maxtrans/$chot);
          $outletcold=$tcin+($maxtrans/$ccold);
          echo "The calculated effectivess is ".$effect;
          echo "The Outlet temperature for hot fluid is ".$outlethot;
            echo "The Outlet temperature for cold fluid is ".$outletcold;
          return ;
          }
          
elseif($chot<$ccold){
$cmin=$chot;
$cmax=$ccold;
$const=$cmin/$cmax;
$NTU=($coefficient*$Area)/$cmin;
$abs=(-$NTU)*(1+$const);
$effect=1-exp($abs)/(1+$const);
$final=$cmin*($thin-$tcin);
 $maxtrans=$effect*$final;
          $outlethot=$thin-($maxtrans/$chot);
           $outletcold=$tcin+($maxtrans/$ccold);
            echo "<center>
        <h4>The calculated effectivess <b>E</b> is<p> $effect</p><br>
            The Outlet temperature for hot fluid is<p> $outlethot<sup>o</sup>C</p><br>
            The Outlet temperature for cold fluid is<p> $outletcold<sup>o</sup>C</p><br>
            </h4></center>";
            return;
         }
         elseif($chot==$ccold){
             $cmin=$chot;
$cmax=$ccold;
$const=$cmin/$cmax;
$NTU=($coefficient*$Area)/$cmin;
$abs=(-$NTU)*(1+$const);
$effect=(1-exp($abs))/(1+$const);
$final=$cmin*($thin-$tcin);
 $maxtrans=$effect*$final;
          $outlethot=$thin-($maxtrans/$chot);
           $outletcold=$tcin+($maxtrans/$ccold);
            echo "<center>
        <h4>The calculated effectivess <b>E</b> is<p> $effect</p><br>
            The Outlet temperature for hot fluid is<p> $outlethot<sup>o</sup>C</p><br>
            The Outlet temperature for cold fluid is<p> $outletcold<sup>o</sup>C</p><br>
            </h4></center>";
            return;
         }
          
          else{
              return "$NTU NOT DEFINED";
          }
         
          }

          ############SECOND FUNCION############
            function solve2($val1,$val2){
         global $effect;
          global $mc;
          global $cmax;
          global $cmin;
          global $chot;
          global $ccold;
          global $mh;
          global $const;
          global $NTU;
          global $coefficient;
          global $Area;
          global $abs;
          global $thin;
          global $tcin;
          global $maxtrans;
          global $outletcold;
          global $outlethot;
$chot=$mh*$val2;
$ccold=$mc*$val1;
if($chot>$ccold){
         $cmax=$chot;
         $cmin=$ccold;
$const=$cmin/$cmax;
$NTU=($coefficient*$Area)/$cmin;
$abs=(-$NTU)*(1-$const);
$effect=(1-exp($abs))/(1-($const*exp($abs)));
$final=$cmin*($thin-$tcin);
 $maxtrans=$effect*$final;
          $outlethot=$thin-($maxtrans/$chot);
          $outletcold=$tcin+($maxtrans/$ccold);
          echo "The calculated effectivess is ".$effect;
          echo "The Outlet temperature for hot fluid is ".$outlethot;
            echo "The Outlet temperature for cold fluid is ".$outletcold;
          return ;
          }
          
elseif($chot<$ccold){
$cmin=$chot;
$cmax=$ccold;
$const=$cmin/$cmax;
$NTU=($coefficient*$Area)/$cmin;
$abs=(-$NTU)*(1-$const);
$effect=(1-exp($abs))/(1-($const*exp($abs)));
$final=$cmin*($thin-$tcin);
 $maxtrans=$effect*$final;
          $outlethot=$thin-($maxtrans/$chot);
           $outletcold=$tcin+($maxtrans/$ccold);
            echo "<center>
        <h4>The calculated effectivess <b>E</b> is<p> $effect</p><br>
            The Outlet temperature for hot fluid is<p> $outlethot<sup>o</sup>C</p><br>
            The Outlet temperature for cold fluid is<p> $outletcold<sup>o</sup>C</p><br>
            </h4></center>";
            return;
         }
         elseif($chot==$ccold){
             $cmin=$chot;
$cmax=$ccold;
$const=$cmin/$cmax;
$NTU=($coefficient*$Area)/$cmin;
$abs=(-$NTU)*(1-$const);
$effect=(1-exp($abs))/(1-($const*exp($abs)));
$final=$cmin*($thin-$tcin);
 $maxtrans=$effect*$final;
          $outlethot=$thin-($maxtrans/$chot);
           $outletcold=$tcin+($maxtrans/$ccold);
            echo "<center>
        <h4>The calculated effectivess <b>E</b> is<p> $effect</p><br>
            The Outlet temperature for hot fluid is<p> $outlethot<sup>o</sup>C</p><br>
            The Outlet temperature for cold fluid is<p> $outletcold<sup>o</sup>C</p><br>
            </h4></center>";
            return;
         }
          
          else{
              return "$NTU NOT DEFINED";
          }
         
            }

         
    ?>
<body style="background-color:#002e62">
    <div class="fluid px-5 py-3 ">
        

       <h1 class="bg-inverse text-white mt-5 px-2 py-2">
            <img src="Pub_code/heat.jpg" class="img-fluid" alt="heat_exhanger"/>
     <?php
     
       Print "Heat Exchanger: <bold>$heat</bold>";
     ?>
     </h1>
      <div class="col-lg-12 col-sm-12 card bg-white" style="color:#000">
           <p class="text-center"><i class="fa fa-th-large"></i>  SUMMARY OF DATA</p>
          <table class="table table-striped py-2 px-2">
                  <tbody>
                  <tr>
                  <th><i class="fa fa-tint"></i> Type of cold Fluid:</th>
                  <td> <b><?php echo  $fluid1; ?></b></td>
                  </tr>
                  <tr>
                  <th><i class="fa fa-tint"></i> Type of Hot Fluid:</th>
                  <td> <b><?php echo  $fluid2; ?></b></td>
                  </tr>
                      <tr>
                 
               <th><i class="fa fa-long-arrow-down"></i><b> Cold inlet:</b></th>
                  <td> <?php echo  $tcin; ?></td>
                  </tr>
                  <tr>
                      <th> <i class="fa fa-long-arrow-right"><b>Hot inlet:</b></th>
                  <td> <?php echo  $thin;?></td>
                  </tr>
                  <tr>
                      <th> <i class="fa fa-long-arrow-down"><b>Cold outlet:</b></th>
                   <td> <?php
                   ?></td>
                   </tr>
                       <tr>
                           <th> <i class="fa fa-long-arrow-left"><b>Hot outlet</b></th>
                <td> <?php?></td>
                </tr>
                <tr>
                    <th> <i class="fa fa-arrows-alt"></i>  Total Area in M<sup>2</sup></th>
             <td> <?php echo  $Area;?></td>
             </tr>
             <tr>
                 <th>Overall heat coefficient:</th>
               <td> <?php echo  $coefficient;?></td>
</tr>
              <tbody>
          </table>
          <p>
          <b>
 <?php

  if($heat==$pel){
       switch($fluid1 and $fluid2){
         case "Water" and "Water":
         $ans1=solve1(4187,4187);
         print($ans1);
        
         break;
         case "EN" and "Water":
         print(solve1(5.23,4.81));
        break;
         case "GL" and "Water":
         print(solve1(0.65,4.81));
         break;
         case "ethal" and "Water":
         print(solve1(1.28,4.81));
         break;
         case "AM" and "Water":
         print(solve1(3.123,4.81));
         break;
         case  "EN" and "GL" :
         print(solve1(5.23,0.65));
         break;
         break;
         case  "Water" and "GL":
         print(solve1(4.81,0.65));
        break;
         case "Water" and "ethal":
         print(solve1(4.81,1.28));
         break;
         case  "Water" and "AM":
         print(solve1(4.81,3.123));
         break;
         case  "GL" and "ethal" :
         print(solve1(0.65,1.28));
         break;
           case  "GL" and "AM" :
         print(solve1(0.65,3.123));
         break;
         case   "ethal"  and "GL":
         print(solve1(1.28,0.65));
         break;
           case  "AM" and "GL" :
         print(solve1(3.123,0.65));
         break;
          case  "AM" and "ethal" :
         print(solve1(3.123,1.28));
         break;
         default:
         echo "CANNOT RETURN VALUE";
         break;
     }
     
  }
  elseif($heat==$cer){
 switch($fluid1 and $fluid2){
         case "Water" and "Water":
         print( "The Calculated Effectivess is ".solve2(4.81,4.81));
         break;
         case "EN" and "Water":
         print(solve2(5.23,4.81));
        break;
         case "GL" and "Water":
         print(solve2(0.65,4.81));
         break;
         case "ethal" and "Water":
         print(solve2(1.28,4.81));
         break;
         case "AM" and "Water":
         print(solve2(3.123,4.81));
         break;
         case  "EN" and "GL" :
         print(solve2(5.23,0.65));
         break;
         break;
         case  "Water" and "GL":
         print(solve2(4.81,0.65));
        break;
         case "Water" and "ethal":
         print(solve2(4.81,1.28));
         break;
         case  "Water" and "AM":
         print(solve2(4.81,3.123));
         break;
         case  "GL" and "ethal" :
         print(solve2(0.65,1.28));
         break;
           case  "GL" and "AM" :
         print(solve2(0.65,3.123));
         break;
         case   "ethal"  and "GL":
         print(solve2(1.28,0.65));
         break;
           case  "AM" and "GL" :
         print(solve2(3.123,0.65));
         break;
          case  "AM" and "ethal" :
         print(solve2(3.123,1.28));
         break;
         default:
         echo "CANNOT RETURN VALUE";
         break;
     }
     }
  else{
      echo "Invalid Result";
  }
?></b>
</p>
</div>
<center class="py-4 px-3">
    <button class="btn btn-md col-lg-6 col-sm-12 col-md-6 btn-outline-info py-3" onclick="refer()" ><i class="fa fa-refresh">  <b>Refresh</b></i></button>
    </center>
</div>


</body>
<script src="Pub_code/heat_me.js" type="text/javascript"></script>
<script src="Pub_code/bootstrap/js/bootstrap.min.js "></script>
<script src="Pub_code/bootstrap/js/bootstrap.js "></script>

</html>
