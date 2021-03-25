<html>
	<head>
		<title> Braintest website</title>
		<link rel="stylesheet" href="main11.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" ></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" >
		</script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" >
		</script>
    <style>
      img{
        width: 100%;
        height: auto;
        }
        a
        {
          color: #ffffff;
        }
      </style>
	</head>
	<body>
		<!-----NavigationBar---->
		<section id="nav-bar">
			<nav class="navbar navbar-expand-lg navbar-light">
  			<a class="navbar-brand" href="#"><img src="logo.png"></a>
  			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    		<span class="navbar-toggler-icon"></span>
  			</button>
  			<div class="collapse navbar-collapse" id="navbarNav">
   			<ul class="navbar-nav ml-auto">
      		<li class="nav-item active">
        	<a class="nav-link" href="#">HOME</a>
      		</li>
            <li class="nav-item">
            <a class="nav-link" href="#aboutbraintumor">ABOUT BRAIN TUMOR</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#testtumor">TEST TUMOR</a>
            </li>
      		<li class="nav-item">
        	<a class="nav-link" href="#about">ABOUT US</a>
      		</li>
      		<li class="nav-item">
        	<a class="nav-link" href="#consultdoctor">CONSULT DOCTOR</a>
      		</li>
      		
          <li class="nav-item">
            <a class="nav-link" href="#contact">CONTACT US</a>
          </li>
    		</ul>
  			</div>
			</nav>
		</section>
    <br>
    <!------ about bran tumor----->
 <section id="aboutbraintumor">
    <div class="container">
      <h1 align="center">ABOUT BRAIN TUMOR</h1><br><br>
      <div class="row">
        <div class="col-md-6">
         
          <div class="about-content">
            A brain tumor is a mass or growth of abnormal cells in your brain. Many different types of brain tumors exist. Some brain tumors are noncancerous (benign), and some brain tumors are cancerous (malignant). Brain tumors can begin in your brain (primary brain tumors), or cancer can begin in other parts of your body and spread to your brain (secondary, or metastatic, brain tumors). How quickly a brain tumor grows can vary greatly. The growth rate as well as location of a brain tumor determines how it will affect the function of your nervous system. Brain tumor treatment options depend on the type of brain tumor you have, as well as its size and location.
          </div>
        </div>
        <div class="col-md-6">
          <img src="braintumor.jpg">
        </div>
      </div>
    </div>
   </section>
 <br>
 <br>
 <br>
 <!-----------test tumor-------->
 <section id="testtumor">
  <div class="container">
    <h1 align="center">TEST BRAIN TUMOR</h1><br><br><br><br>
    <div class="box">
        <span style="--i:1;"><img src ="i1.jpg"></span>
        <span style="--i:2;"><img src ="i2.jpg"></span>
        <span style="--i:3;"><img src ="i3.jpg"></span>
        <span style="--i:4;"><img src ="i4.jpg"></span>
        <span style="--i:5;"><img src ="i5.jpg"></span>
        <span style="--i:6;"><img src ="i6jpg.jpg"></span>
        <span style="--i:7;"><img src ="i7.jpg"></span>
        <span style="--i:8;"><img src ="i8.jpg"></span>
</div>

<style>
  .box
{
	position:relative;
	width:200px;
	height:200px;
	transform-style:preserve-3d;
	animation: animate 20s linear infinite;

}
@keyframes animate
{
	0%
	{
		transform: perspective(1000px) rotateY(0deg);
	}
	100%
	{
		transform: perspective(1000px) rotateY(360deg);
	}
	
}
.box span
{
  position:absolute;
  top:0;
  left:0;
  width:100%;
  height:100%;
  transform-origin: center;
  transform-style: preserve-3d;
  transform:rotateY(calc(var(--i)* 45deg)) translateZ(400px);
}
.box span img
{
	position:absolute;
	top:0;
	left:0;
	width: 100%;
	height: 100%;
	object-fit: cover;
}
</style>  
    
  <?php
	if(isset($_FILES['image'])){
		$file_name = $_FILES['image']['name'];   
		$temp_file_location = $_FILES['image']['tmp_name']; 

		require 'vendor/autoload.php';

		$s3 = new Aws\S3\S3Client([
			'region'  => 'us-east-1',
			'version' => 'latest',
			'credentials' => [
				'key'    => "***********************",// for security purpose 
				'secret' => "***********************",
			]
		]);		
    
   

		$result = $s3->putObject([
			'Bucket' => 'testbrainaws',
			'Key'    => $file_name,
			'SourceFile' => $temp_file_location			
		]);
    
//$command = escapeshellcmd("python analyze.py .$item");
//$output =shell_exec("python analyze.py $item");
$item = $_FILES['image']['name'];
$output =shell_exec("python analyze.py $item");
$nvarl="notumor";
$varl="yestumor";
echo $output;

if(strcmp($output,$nvarl))
{
  $ans="TUMOR NEGATIVE";
}
if(strcmp($output,$varl))
{
  $ans="TUMOR POSITIVE";
}
echo "<input  class='sub' style='float:right' width='250px' height:'400px' value='$item'/>";

echo "<input  class='sub' style='float:right' width='250px' height:'400px' value='$ans'/>";

//$_SERVER['PHP_SELF'];
}    
 
?> 

<form class="form_class" action="main1.php#testtumor" method="POST" enctype="multipart/form-data">         
	<input class="sub1" type="file" name="image" />
	<input class="sub" type="submit"/>
</form>
<?php 

?>
<style>
  .form_class 
  {
    position: absolute;
    left: 900px;
    top: 1000px;
  }
  .sub 
  {
    position: relative;
    text-align:center;
    width: 250px;
    height:300px:
    padding: 40 px;
    font-size:35 px;
    color: #ffffff;
    font-family:poppins;
    font-weight: 100;
    background-image: linear-gradient(rgba(0,0,0,0.8),rgba(0,0,0,0.8)),url(back2.jpg);
    border: 5px solid #15f4ee;
    text-transform:uppercase;
    Letter-spacing:1px;
    cursor: pointer;
    border-radius: 150px;
    transition:1.5s;
  }
  .sub:hover 
  {
    box-shadow: 0 5px 50px 0 #15f4ee inset, 0 5px 50px 0 #15f4ee,
                0 5px 50px 0 #15f4ee inset, 0 5px 50px 0 #15f4ee;
    text-shadow:0 0 5px #15f4ee inset, 0 0 5px #15f4ee;

  }
  .sub1
  {
    position: relative;
    text-align:center;
    width: 250px;
    padding: 40 px;
    font-size:10 px;
    color: #15f4ee
    font-family:poppins;
    font-weight:80;
    border: 5px solid #15f4ee;
    Letter-spacing:1px;
    cursor: pointer;
    border-radius: 100px;
    transition:1.5s;
  }
  .sub1:hover 
  {
    box-shadow: 0 5px 50px 0 #15f4ee inset, 0 5px 50px 0 #15f4ee,
                0 5px 50px 0 #15f4ee inset, 0 5px 50px 0 #15f4ee;
    text-shadow:0 0 5px #15f4ee inset, 0 0 5px #15f4ee;

  }

  
</style>



<br>
<br>
</div>
 </section>
 <br><br><br>

 <!-----AboutUs------>
 <section id="about">
  <div class="container">
    <h1 align="center">ABOUT US</h1>
    <div class="row">
      <div class="col-md-6">
        
        <div class="about-content">
         In the current situation where people are facing losts of health issues and time constraints plays an important role.
         So keeping that in mind we have come up with technology which can detect brain tumor in seconds and you need not be a professional.
         We have actively involved in bringing dynamic changes in the society collaborating health field and modern machine learning technology.
         <br>
         We have some similar ongoing projects that would definetely provide tremendous help to mankind.
         We not only provide you accurate results but also provide you an oppotunity to contact with doctors who could help you with the problems.
         <br>
         We deeply believe in the slogan<br>
        <h3> Better diagnosis Better doctors Better care<h3>
        </div>
      </div>
      <div class="col-md-6">
        <br><img src="aboutusjpg.jpg">
      </div>
    </div>
  </div>
 </section>
 <br>
 <br>
 <br>
 <!------Consult Doctor------>
 <section id="consultdoctor">
   <div class="container">
     <h1 class="h1s" align="center" >CONSULT DOCTOR</h1>
     <div class="row">
        <div class="col-md-4">
        <h5>Dr Radhika Shetty</h5>
        <h6>MD. Neurologist<br>Contact no:9874561230</h6>
        </div>
        <div class="col-md-4">
        <h5>Dr. Sharon Joseph</h5>
        <h6>MD. Neurologist<br>Contact no:9874561230</h6>
        <br>
        </div>
        <div class="col-md-4">
        <h5>Dr abcdejnfkjnfk</h5>
        <h6>MD. Neurologist<br>Contact no:9874561230</h6>
        
        </div>

     </div>
     <div class="row">
              <div class="col-md-4">
              <img src="d1.jpeg" class="img-responsive">
              </div>
              <div class="col-md-4">
              <img src="d2.jpeg" class="img-responsive">
              </div>
              <div class="col-md-4"> 
              <img src="d3.jpeg" class="img-responsive">
              </div>
     </div>
   </div>
<script>
h1s
{
	position:relative;
	font-size: 6em;
	Letter-spacing: 15px;
	color: #0e3742;
	text-transform:uppercase;
	width:100%;
	text-align:center;
	-webkit-box-reflect:below 1px linear-gradient(transparent,#000800);
	Line-height:0.70em;
	outline:none;
	animation:animate 5s linear infinite;
}
@keyframes animate
{
   0%,18%,20%,50.1%,60%,65.1%,80%,90.1%,92%
   {
	   color: #0e3742
   }
   18.1%,20.1%,30%,50%,60.1%,65%,80.1%,90%,92.1%,100%
   {
	   color: #fff;
	   text-shadow: 0 0 10px #03bcf4,
	   0 0 20px #03bcf4,
	   0 0 40px #03bcf4,
	   0 0 80px #03bcf4,
	   0 0 160px #03bcf4,

   }
}
</script>
 </section>
 <br>
 <br>
 <br>
 <!------Contact us------>
 <section id="contact">
  <div class="container">
    <h2> CONTACT US</h2><br>
    <div class="row">
      <div class="col-md-6"> 
        <form class="contact-form" action="main1.php#contact" method="post">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Your Name" name="name">
       </div>
                   <div class="form-group">
              <input type="number" class="form-control" placeholder="Phone No" name="phone">
       </div>
                <div class="form-group">
              <textarea class="form-control" row=4 placeholder="Your Message" name="feedback"></textarea>
       </div>
       <input type="submit" class="sub" value="submit" name="submit" >

       </form>   
      <?php
     $servername = 'localhost';
     $username = 'root';
     $password = '';
     $dbname = 'feedback';
     
     
     // Create connection
     $conn = new mysqli($servername, $username, $password, $dbname) or die("unable to connect");
     if($conn->connect_errno)
     {
       echo 'failed'.$conn->connect_error;
    }

    if(isset($_POST['submit']))
     { 
       
       $name=$_POST['name'];
       $phone=$_POST['phone'];
       $feedback=$_POST['feedback'];
     }
     $sql = mysqli_query($conn,"INSERT INTO feedback_details (Name,Phone,Feedback)VALUES ('$name','$phone','$feedback')");


     ?>    
      </div>
	</div>
	</div>
     
</section>
 


 
<script src="js/smooth-scroll.js"></script>
<script>
  var scroll = new SmoothScroll('a[href*="#"]');
</script>

	</body>
</html>