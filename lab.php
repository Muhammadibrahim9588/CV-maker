<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="phpstyle.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src='https://kit.fontawesome.com/a076d05399.js'></script>
	<title></title>
</head>
<body>
	<?php
	$connection=mysqli_connect("localhost","root","","cv");
	if(isset($_POST['submit']))
	{
	//image folder mein store ho rahi hai
		$filename = $_FILES["uploadfile"]["name"];
		$tempname = $_FILES["uploadfile"]["tmp_name"];
		$folder = "./image/" . $filename;
		move_uploaded_file($tempname, $folder);
	//details sql mein store ho rahin hain
		$name=$_POST['name'];
		$name=openssl_encrypt($name,"AES-128-CTR","GeeksforGeeks",0,'1234567891011121');
		$phone=$_POST['phone'];
		$phone=openssl_encrypt($phone,"AES-128-CTR","GeeksforGeeks",0,'1234567891011121');
		$email=$_POST['email'];
		$email=openssl_encrypt($email,"AES-128-CTR","GeeksforGeeks",0,'1234567891011121');
		$gender=$_POST['gen'];
		$dob=$_POST['dob'];
		$address=$_POST['address'];
		$address=openssl_encrypt($address,"AES-128-CTR","GeeksforGeeks",0,'1234567891011121');
		$companyname=$_POST['companyname'];
		$currentdes=$_POST['currentdes'];
		$exp=$_POST['exp'];
		$cnameexp=$_POST['cnameexp'];
		$degree=$_POST['degree'];
		$degreeyear=$_POST['degreeyear'];
		$marks=$_POST['marks'];
		$skill1=$_POST['skill1'];
		$skill2=$_POST['skill2'];
		$skill3=$_POST['skill3'];
		$skill4=$_POST['skill4'];
		$skill5=$_POST['skill5'];


		$insert_query="INSERT INTO details (filename,name,phone,email,gender,dob,address,companyname,currentdes,exp,cnameexp,degree,degreeyear,marks,skill1,skill2,skill3,skill4,skill5) VALUES ('$filename','$name','$phone','$email','$gender','$dob','$address','$companyname','$currentdes','$exp','$cnameexp','$degree','$degreeyear','$marks','$skill1','$skill2','$skill3','$skill4','$skill5')";
	//query excecute
		$insert_result=mysqli_query($connection,$insert_query);

	}
	?>

	<?php
		//image fetch ka code
	$query2 = " select * from details ORDER BY id DESC LIMIT 1";
	$result = mysqli_query($connection, $query2);
	while ($data = mysqli_fetch_assoc($result)) {
		?>
		<div id="display-image">
			<!-- image print ka code -->
			<img src="./image/<?php echo $data['filename']; ?>"><br>
		</div>
		<?php
	}
		//database se detial fetch ka function
	function queryexecution($field)
	{
		$query1="SELECT $field FROM details ORDER BY id DESC LIMIT 1";
		$result=mysqli_query($GLOBALS['connection'],$query1);
		$row = mysqli_fetch_row($result);
		return $row[0];
	}
	?>
	<div id="name">
		<?php
		$decryption_name=openssl_decrypt (queryexecution("name"),"AES-128-CTR", 
        "GeeksforGeeks",0,'1234567891011121');
        echo $decryption_name;
		?>
		<?php
		?>
		<div id="currentdes">
			<?php
			echo queryexecution("currentdes");echo "<br>";
			?>
		</div>
	</div>
	<div id="personal_details">
		<h3>PERSONAL DETAILS</h3>
		<i class="fa fa-phone"></i>
		<?php
		$decryption_phone=openssl_decrypt(queryexecution("phone"),"AES-128-CTR", 
        "GeeksforGeeks",0,'1234567891011121');
        echo $decryption_phone;echo "<br>";
		?>
		<i class="fa fa-envelope"></i>
		<?php
		$decryption_email=openssl_decrypt(queryexecution("email"),"AES-128-CTR", 
        "GeeksforGeeks",0,'1234567891011121');
        echo $decryption_email."<br>";
		?>

		<i class="fa fa-intersex"></i>
		<?php
		echo queryexecution("gender");echo "<br>";
		?>
		<i class='far fa-calendar-alt'></i>
		<?php
		echo queryexecution("dob");echo "<br>";
		?>
		<i class='fas fa-route'></i>
		<?php
		$decryption_address=openssl_decrypt(queryexecution("address"),"AES-128-CTR", 
        "GeeksforGeeks",0,'1234567891011121');
        echo $decryption_address."<br>";
		?>
	</div>
	<div id="workexp">
		<h3>WORK EXPERIENCE</h3>
		<div id="companyname">
			<?php
			echo queryexecution("companyname");echo "<br>";
			?>
		</div>
		<div id="currentdes2">
			<?php
			echo queryexecution("currentdes");echo "<br>";
			?>
		</div>
		<div id="exp">
			<?php
			echo queryexecution("exp");echo " Years of Experience<br>";
			?>
		</div>
		<div id="expdetail">
			Details: 
			<?php
			echo queryexecution("cnameexp");echo "<br>";
			?>
		</div>
	</div>
	<div id="education">
		<h3>EDUCATION</h3>
		<div id="degree">
	<?php
	echo queryexecution("degree");echo "<br>";
	?>
	</div>
	<div id="degreeyear">
		Year of graduation: 
	<?php
	echo queryexecution("degreeyear");echo "<br>";
	?>
	</div>
	<div id="marks">
	<?php
	echo queryexecution("marks");echo "<br>";
	?>
	</div>
</div>
<div id="skills">
		<h3>Skills</h3>
		<div id="skill1">
			<?php
			echo queryexecution("skill1");echo "<br>";
			?>
		</div>
		<div id="skill2">
			<?php
			echo queryexecution("skill2");echo "<br>";
			?>
		</div>
		<div id="skill3">
			<?php
			echo queryexecution("skill3");echo "<br>";
			?>
		</div>
		<div id="skill4">
			<?php
			echo queryexecution("skill4");echo "<br>";
			?>
		</div>
		<div id="skill5">
			<?php
			echo queryexecution("skill5");echo "<br>";
			?>
		</div>
	</div>
</body>
</html>
<style type="text/css">
	*{
		box-sizing: border-box;
	}
	body{
		margin:0;
	}
	#display-image{
		justify-content: center;
		padding: 0px;
		margin: 0px;
		text-align: left;
		background-color: red;
		width: 0px;	
		float: left;

	}
	img{
		margin: 5px;
		width: 250px;
		height: 230px;
		border-radius: 50%;
	}

	#personal_details{
		font-size: 25px;
		text-transform: capitalize;
		padding-left: 80px;
		width: 500px;
		float: left;
		line-height: 1.6;
	}
	#name{
		font-size: 50px;
		background-color: #383838;
		height: 250px;
		padding-top: 60px;
		padding-left: 300px;
		color: white;
		text-transform: uppercase;	
	}
	#currentdes{
		font-size: 18px;
		font-style: oblique;
		font-family: Arial, Helvetica, sans-serif;
		padding-top: 10px;
	}
	#workexp{
		font-size: 25px;
		text-transform: capitalize;
		padding-left: 250px;
		width: 700px;
		float: left;
		line-height: 1.6;
	}
	#currentdes2{
		line-height: 1.3;
		font-style: oblique;
	}
	#companyname{
		font-weight: bold;
		font-size: 30px;
		line-height: 1.3;
	}
	#exp{
		font-size: 18px;
		line-height: 1.8;

	}
	#expdetail{
		font-size: 18px;
		/*line-height: 2.5;*/
		height: 100px;
	}
	#education{
		font-size: 25px;
		text-transform: capitalize;
		padding-left: 80px;
		width: 500px;
		line-height: 1.6;
		margin-top: 400px;
		padding-bottom: 100px;
	}
	#skills{
		font-size: 25px;
		text-transform: capitalize;
		margin-left: 748px;
		margin-top: -327px;
		width: 700px;
		float: left;
		line-height: 1.6;
	}
	#degree{
		font-weight: bold;
	}
	h3{
		background-color: black;
		color: white;
		width: 400px;
		text-align: center;
	}
	
</style>