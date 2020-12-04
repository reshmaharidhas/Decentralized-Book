<?php
    $servername = "localhost";
    $database ="id10711229_butterfly";
    $username = "id10711229_reshma";
    $password = "Code6world";
    $tblname="police_images";
    $connect = mysqli_connect("localhost","id10711229_reshma","Code6world");
    mysqli_select_db($connect,$database);
    if(isset($_POST["insert"]) && isset($_POST["mpid"])) 
    {
        $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
        $mpidnum = $_POST["mpid"];
        $query = "INSERT INTO missingpeople_images(id,photo) VALUES ('$mpidnum','$file')";
        if(mysqli_query($connect,$query))
        {
            echo '<script>alert("Image inserted into database")</script>'; 
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>DBook - Register Missing Person</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" type="text/css" href="index.css">
		<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
    </head>
    <body>
        <div class="w3-container w3-text-white w3-center" style="background-color:black;">
            <h1>DBook</h1>
			<h4>Decentralized Book - To find MISSING people</h4>
			<a href="index.html"><i class='fas fa-home' style="float: left;"></i></a>
        </div>
        <br><br>
        <div class="w3-padding-large">
            <center>
            <div class = "w3-container w3-black w3-padding" style="width:60%;">
                <div class="w3-padding-large">
                    <h4>Missing Person Details Registration Form</h4><br>
                    <p id='current'></p>
                    <label style="float:left">Enter a new ID for Missing Person*</label>
                    <input type="text" id="mp_id" class="w3-input w3-border"><br>
                    <label style="float:left">Missing Person Full Name*</label>
                    <input type="text" id="mp_name" class="w3-input w3-border"><br>
                    <label style="float:left">Age*</label>
                    <input type="number" id="mp_age" class="w3-input w3-border"><br>
                    <label style="float:left">Gender*</label>
                    <input type="text" id="mp_gender" class="w3-input w3-border"><br>
                    <label style="float:left">Height*</label>
                    <input type="number" id="mp_height" class="w3-input w3-border" placeholder="Enter in cm"><br>
                    <label style="float:left">Hair Color*</label>
                    <input type="text" id="mp_hair" class="w3-input w3-border"><br>
                    <label style="float:left">Skin Complexion*</label>
                    <input type="text" id="mp_skin" class="w3-input w3-border"><br>
                    <label style="float:left">Build*</label>
                    <input type="text" id="mp_build" class="w3-input w3-border"><br>
                    <label style="float:left">Weight*</label>
                    <input type="number" id="mp_weight" class="w3-input w3-border"><br>
                    <label style="float:left">Eye Color*</label>
                    <input type="text" id="mp_eyecolor" class="w3-input w3-border"><br>
                    <label style="float:left">Missing Date*</label>
                    <input type="text" id="mp_missingsince" class="w3-input w3-border" placeholder="Enter in dd/mm/year format"><br>
                    <label style="float:left">Missing Place*</label>
                    <input type="text" id="mp_missingplace" class="w3-input w3-border"><br>
                    <label style="float:left">Remarks*</label>
                    <input type="text" id="mp_remarks" class="w3-input w3-border"><br>
                    <br><br>
					<button id='registerMissingPersonbtn' class="w3-button w3-blue w3-text-black w3-round-xlarge">
                        <b>Register Missing Case</b>
                    </button>
					<p id='regstatus'></p>
                </div>
            </div>
            <br>
            <div class="w3-container w3-brown w3-mobile w3-round w3-border w3-text-black">
            <form method="post" enctype="multipart/form-data" id="mp_photobox" style="display:none;">
                <h3>Add photo of Missing Person</h3>
                <input type="file" id="image" name="image">
                <h5>(Image size must be less than 67kb)</h5>
                <br/><br>
                <label>Enter Missing Person ID:</label>
                <input type="text" name="mpid" id="mpid" class="w3-input"/><br>
                <center>
                    <button type="submit" id='insert' name="insert" class="w3-button w3-black w3-hover-purple">
                        Add
                    </button><br><br>                
                </center>
            </form>
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
                contract.methods.getNumRegMissingPerson().call().then(function(bal)
                {
                    $('#current').html(bal);
                })
				
            })
            $('#registerMissingPersonbtn').click(function()
            {
				var status = "Missing Person details registered SUCCESSFULLY";
                var mp_id, mp_name, mp_gender, mp_haircolor, mp_skin, mp_build, mp_eye,
                 mp_missingdate, mp_missingfrom, mp_remarks;
                var mp_age = 0;
                var mp_height = 0;
                var mp_weight = 0;

                mp_id = $('#mp_id').val();
                mp_name = $('#mp_name').val();
                mp_age = parseInt($('#mp_age').val());
                mp_gender = $('#mp_gender').val();
                mp_height = parseInt($('#mp_height').val());
                mp_haircolor = $('#mp_hair').val();
                mp_skin = $('#mp_skin').val();
                mp_build = $('#mp_build').val();
                mp_weight = parseInt($('#mp_weight').val());
                mp_eye = $('#mp_eyecolor').val();
                mp_missingdate = $('#mp_missingsince').val();
                mp_missingfrom = $('#mp_missingplace').val();
                mp_remarks = $('#mp_remarks').val();
                web3.eth.getAccounts().then(function(accounts)
                {
                    var acc = accounts[0];
                    return contract.methods.registerMissingPerson(mp_id, mp_name, mp_age, mp_gender, mp_height, mp_haircolor, mp_skin,mp_build,mp_weight,mp_eye,mp_missingdate,mp_missingfrom,mp_remarks).send({from: acc});
                }).then(function(tx)
                {
                    console.log(tx);
					$('#regstatus').html(status);
                    $('#mp_photobox').show();
                }).catch(function(tx)
                {
                    console.log(tx);
                })
            })
        </script>

    </body>
</html>