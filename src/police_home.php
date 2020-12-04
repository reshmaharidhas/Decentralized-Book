<!DOCTYPE html>
<html lang="en">
    <head>
        <title>DBook - Police Dashboard</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" type="text/css" href="index.css">
		<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
		<style>
			@media only screen and (max-width: 800px) and (orientation: portrait) {
    			#searchResults {
       				width: 95%;
					background-color: aqua;
   				}
			}
		</style>
	</head>
    <body>
        <div class="w3-container w3-text-white w3-center" style="background-color:black;">
            <h1>DBook</h1>
			<h4>Decentralized Book - To find MISSING people</h4>
			<a href="dbook.html"><i class='fas fa-home' style="float: left;"></i></a>
        </div>
        <br>
        <div class="w3-padding-large">
			<div class="w3-container w3-black w3-mobile" id="policeDashboard" style="display:none;">
				<div class="w3-row-padding">
                    <div class="w3-third">Badge: <b id='viewBadge'></b></div>
                    <div class="w3-third">Name: <b id='viewName'></b></div>
					<div class="w3-third">Rank: <b id='viewRank'></b></div>
				</div>
				<div class="w3-row-padding">
					<div class="w3-third">Unit: <b id='viewUnit'></b></div>
                    <div class="w3-third">Station: <b id='viewStation'></b></div>
					<div class="w3-third">Gender: <b id='viewGender'></b></div>
				</div>
        	</div><br><br>
            <center>
			<div class="w3-row-padding">
				<div class="w3-container w3-half w3-pink w3-padding-large w3-mobile">
                	<button id='showMyDetails' class="w3-button w3-black w3-hover-purple" type="button">Show My Profile</button><br><br>
                	<a href="view_my_photo.php">
                    <button class="w3-button w3-black w3-hover-purple">Show My Photo</button><br><br>
                	</a>
                	<a href="five.php">
                    	<button class="w3-button w3-black w3-hover-purple">Add Profile Photo</button><br><br>
                	</a>
                	<a href="register_missing_person.php">
                    	<button class="w3-button w3-black w3-hover-purple">Register Missing Person</button><br><br>
					</a>
					<button class="w3-button w3-black w3-mobile w3-hover-purple" id="searchMP">Search Missing Person<br> by ID</button><br><br>
					<div id='box' class="w3-container w3-grey w3-padding w3-mobile" style="width: 70%;display: none;">
						<input type="text" id="missingPersonID" class="w3-input w3-border" style="width: 60%;" placeholder="Enter ID number"><br>
						<button id='searchDetails' class="w3-button w3-red w3-hover-purple">Search Details</button>
					</div>
					<div id='searchResults' class="w3-container w3-mobile" style="width: 80%;background-color: blue;display: none;">
						<div style="text-align: left;" class="w3-text-white">
						<h1 class="w3-red" style="text-align: center;"><b id="res_status"></b></h1><br>
						Name: <b id="res_name"></b><br>
						Age : <b id="res_age"></b><br>
						Missing From : <b id="res_missingplace"></b><br>
						Missing Since: <b id="res_since"></b><br>
						Height: <b id="res_h"></b>cm<br>
						Eyes: <b id="res_eyes"></b><br>
						Hair: <b id="res_hair"></b><br>
						Weight: <b id="res_w"></b>kg<br>
						Complexion: <b id="res_skincolor"></b><br>
						Gender: <b id="res_gender"></b><br>
						Remarks: <b id="res_remarks"></b><br>
						Build: <b id="res_build"></b><br>
						</div>
					</div>
				</div><br>

				<div class="w3-container w3-half w3-padding w3-red w3-mobile w3-border" id="mpPhoto">
						<h3>PHOTO SEARCH BY MISSING PERSON ID</h3>
                        <?php
                            $servername = "localhost";
                            $database ="id10711229_butterfly";
                            $username = "id10711229_reshma";
                            $password = "Code6world";
                            $tblname="police_images";
                            $connect = mysqli_connect("localhost","id10711229_reshma","Code6world");
                            mysqli_select_db($connect,$database);
							if(isset($_POST["view"]) && isset($_POST["vmpid"])) 
							{
								$vmpidnum = $_POST["vmpid"];
								$query = "SELECT * FROM missingpeople_images WHERE id LIKE '$vmpidnum'";
								$result = mysqli_query($connect, $query);
								if($result)
								{
									while($row = mysqli_fetch_array($result))
									{
										echo '
										<div class="w3-container w3-white w3-padding" style="width:50%;">
											<img src="data:image/jpeg;base64,'.base64_encode($row['photo']).'" class="w3-image" />
										</div>
										';
										echo "<b>ID:</b>"; echo $vmpidnum;
									}
								}
							}
						?>
						<form method="post" enctype="multipart/form-data" class="w3-container">
							<br><br>
							Enter Id<input type="text" name="vmpid" id="vmpid" class="w3-input" placeholder="Enter Missing Person ID here" />
							<input type="submit" name="view" id="view" value="View" class="w3-button w3-black"/>
						</form>
				</div>
			</div>
            </center>
        </div>
        <script src="https://cdn.jsdelivr.net/gh/ethereum/web3.js@1.0.0-beta.36/dist/web3.min.js"></script>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" crossorigin="anonymous"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script>
            var contract;
            $(document).ready(function()
            {
                web3 = new Web3(web3.currentProvider);
                var address = "0x84d4be2e2f78166168d19564eeaad2e22be32ba2";
                var abi = [
	{
		"constant": false,
		"inputs": [
			{
				"name": "_complexion",
				"type": "string"
			},
			{
				"name": "_id",
				"type": "string"
			}
		],
		"name": "addArrayComplexion",
		"outputs": [],
		"payable": false,
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"constant": false,
		"inputs": [
			{
				"name": "_addPoliceUserid",
				"type": "string"
			},
			{
				"name": "_addPolicePassword",
				"type": "string"
			}
		],
		"name": "addPoliceLogin",
		"outputs": [],
		"payable": false,
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"constant": false,
		"inputs": [
			{
				"name": "_policeBadge",
				"type": "string"
			}
		],
		"name": "addPolicePhoto",
		"outputs": [],
		"payable": false,
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"constant": false,
		"inputs": [
			{
				"name": "_mpid",
				"type": "string"
			}
		],
		"name": "getMissingPersonDetails",
		"outputs": [],
		"payable": false,
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"constant": false,
		"inputs": [],
		"name": "getPoliceDetails",
		"outputs": [],
		"payable": false,
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"constant": false,
		"inputs": [],
		"name": "logoutPolice",
		"outputs": [],
		"payable": false,
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"constant": false,
		"inputs": [
			{
				"name": "_id",
				"type": "string"
			},
			{
				"name": "_name",
				"type": "string"
			},
			{
				"name": "_age",
				"type": "uint256"
			},
			{
				"name": "_gender",
				"type": "string"
			},
			{
				"name": "_height",
				"type": "uint256"
			},
			{
				"name": "_hair",
				"type": "string"
			},
			{
				"name": "_skin",
				"type": "string"
			},
			{
				"name": "_build",
				"type": "string"
			},
			{
				"name": "_weight",
				"type": "uint256"
			},
			{
				"name": "_eye",
				"type": "string"
			},
			{
				"name": "_since",
				"type": "string"
			},
			{
				"name": "_place",
				"type": "string"
			},
			{
				"name": "_remarks",
				"type": "string"
			}
		],
		"name": "registerMissingPerson",
		"outputs": [],
		"payable": false,
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"constant": false,
		"inputs": [
			{
				"name": "_policeId",
				"type": "string"
			},
			{
				"name": "_policePassword",
				"type": "string"
			},
			{
				"name": "_policeName",
				"type": "string"
			},
			{
				"name": "_policeRank",
				"type": "string"
			},
			{
				"name": "_policeUnit",
				"type": "string"
			},
			{
				"name": "_policeStation",
				"type": "string"
			},
			{
				"name": "_policeGender",
				"type": "string"
			}
		],
		"name": "registerPolice",
		"outputs": [],
		"payable": false,
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"constant": false,
		"inputs": [
			{
				"name": "_policeusername",
				"type": "string"
			},
			{
				"name": "_policepassword",
				"type": "string"
			}
		],
		"name": "signinPolice",
		"outputs": [],
		"payable": false,
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"inputs": [],
		"payable": false,
		"stateMutability": "nonpayable",
		"type": "constructor"
	},
	{
		"anonymous": false,
		"inputs": [
			{
				"indexed": false,
				"name": "",
				"type": "string"
			}
		],
		"name": "PrinterWord",
		"type": "event"
	},
	{
		"constant": true,
		"inputs": [],
		"name": "getArrayLength",
		"outputs": [
			{
				"name": "",
				"type": "uint256"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [],
		"name": "getMpAge",
		"outputs": [
			{
				"name": "",
				"type": "uint256"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [],
		"name": "getMpBuild",
		"outputs": [
			{
				"name": "",
				"type": "string"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [],
		"name": "getMpEyeColor",
		"outputs": [
			{
				"name": "",
				"type": "string"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [],
		"name": "getMpGender",
		"outputs": [
			{
				"name": "",
				"type": "string"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [],
		"name": "getMpHairColor",
		"outputs": [
			{
				"name": "",
				"type": "string"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [],
		"name": "getMpHeight",
		"outputs": [
			{
				"name": "",
				"type": "uint256"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [],
		"name": "getMpID",
		"outputs": [
			{
				"name": "",
				"type": "string"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [],
		"name": "getMpMissingPlace",
		"outputs": [
			{
				"name": "",
				"type": "string"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [],
		"name": "getMpMissingSince",
		"outputs": [
			{
				"name": "",
				"type": "string"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [],
		"name": "getMpName",
		"outputs": [
			{
				"name": "",
				"type": "string"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [],
		"name": "getMpRemarks",
		"outputs": [
			{
				"name": "",
				"type": "string"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [],
		"name": "getMpSkinColor",
		"outputs": [
			{
				"name": "",
				"type": "string"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [],
		"name": "getMpStatus",
		"outputs": [
			{
				"name": "",
				"type": "string"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [],
		"name": "getMpWeight",
		"outputs": [
			{
				"name": "",
				"type": "uint256"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [],
		"name": "getNumRegMissingPerson",
		"outputs": [
			{
				"name": "",
				"type": "uint256"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [],
		"name": "getPolCount",
		"outputs": [
			{
				"name": "",
				"type": "uint256"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [],
		"name": "getPoliceBadgeNum",
		"outputs": [
			{
				"name": "",
				"type": "string"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [],
		"name": "getPoliceFullName",
		"outputs": [
			{
				"name": "",
				"type": "string"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [],
		"name": "getPoliceGender",
		"outputs": [
			{
				"name": "",
				"type": "string"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [],
		"name": "getPoliceRank",
		"outputs": [
			{
				"name": "",
				"type": "string"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [],
		"name": "getPoliceStaion",
		"outputs": [
			{
				"name": "",
				"type": "string"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [],
		"name": "getPoliceUnit",
		"outputs": [
			{
				"name": "",
				"type": "string"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [
			{
				"name": "",
				"type": "address"
			}
		],
		"name": "matchAddrToBadgeNum",
		"outputs": [
			{
				"name": "",
				"type": "string"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [
			{
				"name": "",
				"type": "string"
			}
		],
		"name": "missingCaseRegistration",
		"outputs": [
			{
				"name": "mpIDnum",
				"type": "string"
			},
			{
				"name": "policeBadge",
				"type": "string"
			},
			{
				"name": "mpBool",
				"type": "bool"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [
			{
				"name": "",
				"type": "uint256"
			}
		],
		"name": "missingPeopleList",
		"outputs": [
			{
				"name": "",
				"type": "string"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [
			{
				"name": "",
				"type": "string"
			}
		],
		"name": "missingPersonDB",
		"outputs": [
			{
				"name": "mpIDnum",
				"type": "string"
			},
			{
				"name": "mpName",
				"type": "string"
			},
			{
				"name": "mpAge",
				"type": "uint256"
			},
			{
				"name": "mpGender",
				"type": "string"
			},
			{
				"name": "mpHeight",
				"type": "uint256"
			},
			{
				"name": "mpHairColor",
				"type": "string"
			},
			{
				"name": "mpSkinColor",
				"type": "string"
			},
			{
				"name": "mpStatus",
				"type": "string"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [
			{
				"name": "",
				"type": "string"
			}
		],
		"name": "missingPersonProfile",
		"outputs": [
			{
				"name": "mpIDnum",
				"type": "string"
			},
			{
				"name": "mpBuild",
				"type": "string"
			},
			{
				"name": "mpWeight",
				"type": "uint256"
			},
			{
				"name": "mpEyeColor",
				"type": "string"
			},
			{
				"name": "mpMissingSince",
				"type": "string"
			},
			{
				"name": "mpMissingFromPlace",
				"type": "string"
			},
			{
				"name": "mpRemarks",
				"type": "string"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [],
		"name": "mp_age",
		"outputs": [
			{
				"name": "",
				"type": "uint256"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [],
		"name": "mp_build",
		"outputs": [
			{
				"name": "",
				"type": "string"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [],
		"name": "mp_caseRegisteredBy",
		"outputs": [
			{
				"name": "",
				"type": "string"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [],
		"name": "mp_eyecolor",
		"outputs": [
			{
				"name": "",
				"type": "string"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [],
		"name": "mp_gender",
		"outputs": [
			{
				"name": "",
				"type": "string"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [],
		"name": "mp_haircolor",
		"outputs": [
			{
				"name": "",
				"type": "string"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [],
		"name": "mp_height",
		"outputs": [
			{
				"name": "",
				"type": "uint256"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [],
		"name": "mp_id",
		"outputs": [
			{
				"name": "",
				"type": "string"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [],
		"name": "mp_missingplace",
		"outputs": [
			{
				"name": "",
				"type": "string"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [],
		"name": "mp_missingsince",
		"outputs": [
			{
				"name": "",
				"type": "string"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [],
		"name": "mp_name",
		"outputs": [
			{
				"name": "",
				"type": "string"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [],
		"name": "mp_remarks",
		"outputs": [
			{
				"name": "",
				"type": "string"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [],
		"name": "mp_skincolor",
		"outputs": [
			{
				"name": "",
				"type": "string"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [],
		"name": "mp_status",
		"outputs": [
			{
				"name": "",
				"type": "string"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [],
		"name": "mp_weight",
		"outputs": [
			{
				"name": "",
				"type": "uint256"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [],
		"name": "mpCount",
		"outputs": [
			{
				"name": "",
				"type": "uint256"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [],
		"name": "owner",
		"outputs": [
			{
				"name": "",
				"type": "address"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [],
		"name": "pol_badgenum",
		"outputs": [
			{
				"name": "",
				"type": "string"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [],
		"name": "pol_gender",
		"outputs": [
			{
				"name": "",
				"type": "string"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [],
		"name": "pol_name",
		"outputs": [
			{
				"name": "",
				"type": "string"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [],
		"name": "pol_rank",
		"outputs": [
			{
				"name": "",
				"type": "string"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [],
		"name": "pol_station",
		"outputs": [
			{
				"name": "",
				"type": "string"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [],
		"name": "pol_unit",
		"outputs": [
			{
				"name": "",
				"type": "string"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [],
		"name": "polCount",
		"outputs": [
			{
				"name": "",
				"type": "uint256"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [
			{
				"name": "",
				"type": "address"
			}
		],
		"name": "policeLogin",
		"outputs": [
			{
				"name": "userid",
				"type": "string"
			},
			{
				"name": "userpassword",
				"type": "string"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [
			{
				"name": "",
				"type": "address"
			}
		],
		"name": "policeLoginStatus",
		"outputs": [
			{
				"name": "",
				"type": "uint256"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [
			{
				"name": "",
				"type": "address"
			}
		],
		"name": "policePhotoDB",
		"outputs": [
			{
				"name": "policeBadge",
				"type": "string"
			},
			{
				"name": "policePhoto",
				"type": "bool"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [
			{
				"name": "",
				"type": "address"
			}
		],
		"name": "policeProfile",
		"outputs": [
			{
				"name": "policeBadgeNum",
				"type": "string"
			},
			{
				"name": "policePassword",
				"type": "string"
			},
			{
				"name": "policeName",
				"type": "string"
			},
			{
				"name": "policeRank",
				"type": "string"
			},
			{
				"name": "policeUnit",
				"type": "string"
			},
			{
				"name": "policeStation",
				"type": "string"
			},
			{
				"name": "policeGender",
				"type": "string"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [
			{
				"name": "",
				"type": "string"
			}
		],
		"name": "policeRegisteredStatus",
		"outputs": [
			{
				"name": "",
				"type": "uint256"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [
			{
				"name": "",
				"type": "address"
			}
		],
		"name": "policeRegisterStatus",
		"outputs": [
			{
				"name": "",
				"type": "uint256"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	}
];
                
                contract = new web3.eth.Contract(abi, address);
                contract.methods.getPolCount().call().then(function(bal)
                {
                    $('#current').html(bal);
                })
            })
            $('#showMyDetails').click(function()
            {   
                web3.eth.getAccounts().then(function(accounts)
                {
                    var acc = accounts[0];
                    return contract.methods.getPoliceDetails().send({from: acc});
                }).then(function(tx)
                {
                    console.log(tx);
					$("#policeDashboard").show();
					contract.methods.getPoliceBadgeNum().call().then(function(bal)
                	{
                        $('#viewBadge').html(bal);
                    })
                    contract.methods.getPoliceFullName().call().then(function(bal)
                	{
                        $('#viewName').html(bal);
                    })
                    contract.methods.getPoliceRank().call().then(function(bal)
                	{
                        $('#viewRank').html(bal);
                    })
                    contract.methods.getPoliceUnit().call().then(function(bal)
                	{
                        $('#viewUnit').html(bal);
                    })
                    contract.methods.getPoliceStaion().call().then(function(bal)
                	{
                        $('#viewStation').html(bal);
                    })
                    contract.methods.getPoliceGender().call().then(function(bal)
                	{
                        $('#viewGender').html(bal);
                    })
                }).catch(function(tx)
                {
                    console.log(tx);
                })
            })


			$('#searchMP').click(function(){
				$('#box').show();
			});

			$('#searchDetails').click(function()
            {   
				var mp;
				mp = $('#missingPersonID').val();
                web3.eth.getAccounts().then(function(accounts)
                {
                    var acc = accounts[0];
                    return contract.methods.getMissingPersonDetails(mp).send({from: acc});
                }).then(function(tx)
                {
                    console.log(tx);
					$("#searchResults").show();
					contract.methods.getMpStatus().call().then(function(bal)
                	{
                        $('#res_status').html(bal);
                    })
					contract.methods.getMpName().call().then(function(bal)
                	{
                        $('#res_name').html(bal);
                    })
                    contract.methods.getMpAge().call().then(function(bal)
                	{
                        $('#res_age').html(bal);
                    })
					contract.methods.getMpMissingPlace().call().then(function(bal)
                	{
                        $('#res_missingplace').html(bal);
                    })
					contract.methods.getMpMissingSince().call().then(function(bal)
                	{
                        $('#res_since').html(bal);
                    })
					contract.methods.getMpHeight().call().then(function(bal)
                	{
                        $('#res_h').html(bal);
                    })
					contract.methods.getMpEyeColor().call().then(function(bal)
                	{
                        $('#res_eyes').html(bal);
                    })
					contract.methods.getMpHairColor().call().then(function(bal)
                	{
                        $('#res_hair').html(bal);
                    })
					contract.methods.getMpWeight().call().then(function(bal)
                	{
                        $('#res_w').html(bal);
                    })
					contract.methods.getMpSkinColor().call().then(function(bal)
                	{
                        $('#res_skincolor').html(bal);
                    })
					contract.methods.getMpGender().call().then(function(bal)
                	{
                        $('#res_gender').html(bal);
                    })
					contract.methods.getMpBuild().call().then(function(bal)
                	{
                        $('#res_build').html(bal);
                    })
					contract.methods.getMpRemarks().call().then(function(bal)
                	{
                        $('#res_remarks').html(bal);
                    })

                }).catch(function(tx)
                {
                    console.log(tx);
                })
            })

			$('#logoutBtn').click(function()
            {   
                var logoutStatement = "Logged out";
                web3.eth.getAccounts().then(function(accounts)
                {
                    var acc = accounts[0];
                    return contract.methods.logoutPolice().send({from: acc});
                }).then(function(tx)
                {
                    console.log(tx);
                    $('#logstatus').html(logoutStatement);
                }).catch(function(tx)
                {
                    console.log(tx);
                })
            })

        </script>

    </body>
</html>