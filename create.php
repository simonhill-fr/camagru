<!-- montage.php -->

<?php 

function put_create_error()
{
	if (isset($_SESSION["error"]))
	{
		$ret = $_SESSION["error"];
		$_SESSION["error"] = "";
		unset($_SESSION["error"]);
		echo $ret;
	}
}

if (isset($_POST["img_data"]) && $_POST["img_data"] !== ""
	&& isset($_POST["filter"]) && $_POST["filter"] )
{
	include "create_picture.php";
	$filterPath = "./images/filters/" . $_POST["filter"];
	create_picture($filterPath);
}

if (isset($_POST["img_delete"])) {
	$db = db_connection();
	$sql = "DELETE FROM pictures WHERE pictures.path = '".$_POST['img_delete']."'";
	$db->exec($sql);
	unlink($_POST['img_delete']);

}

?>
<div class="colmask rightmenu">
	<div class="colleft">
		<div class="col1">
			<!-- Column 1 start -->
			<h2 style="text-align: center">Step 1 : Pick a Filter</h2>
			<div align="center">
				<form action="./?page=create" method="post" name="takepic_form">
					<label>
						<input id="r1" type="radio" value="glasses.png" name="filter" required>
						<img id="but1" class="filters" onclick="imgSelect(this)" src="images/filters/glasses.png" width="20%">
					</label>
					<label>
						<input id="r2" type="radio" value="wig.png" name="filter" required>
						<img id="but2" class="filters" onclick="imgSelect(this)" src="images/filters/wig.png" width="20%">
					</label>
					<label>
						<input id="r3" type="radio" value="dog.png" name="filter" required>
						<img id="but3" class="filters" onclick="imgSelect(this)" src="images/filters/dog.png"  width="20%">
					</label>
				</div>

				<div style="text-align: center">
					<h2>Step 2 : Take a Picture</h2>
					<video id="video"></video>
					<div style="display: none"><canvas id="canvas"></canvas></div>
					<div><button id="startbutton" name="img_data" type="submit" disabled>Take a picture</button></div>
				</form>
			</div>
			<div align="center">
				<div>
					<form action="upload.php" method="post" enctype="multipart/form-data">
					<h3> or Upload picture </h3>
					<div class="error"><?php put_create_error(); ?></div>
					<input id="upload_filter" type="hidden" name="upload_filter" >
					<input type="file" name="imgToUpload" id="imgToUpload" \>
					<input id="uploadbutton" type="submit" name="upload_submit" value="Upload Image" >
					</form>
				</div>
			</div>			
		</div>
		<!-- Column 1 end -->
		<div id="thumb_sidebar" class="col2">
<?php include 'sidebar_usr_img.php'; ?>
		</div>
	</div>
	</div>
</div>

<script src="js/takepicture.js"></script>