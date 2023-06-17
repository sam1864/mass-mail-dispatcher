<html>
    <head>
    <title>Mass Mail Dispatcher</title>
  <style>
.container {
			display: flex;
			flex-wrap: wrap;
			gap: 20px;
		}
		.valid-emails {
			flex-basis: 50%;
		}
		.invalid-emails {
			flex-basis: 50%;
		}

    body {
        font-family: Arial, sans-serif;
        background-color: #15475C;
        color: 	#000000;
    }
    
    h1 {
        font-size: 36px;
        font-family: 'Helvetica', sans-serif;
        color: #333;
        text-align: center;
        /* margin-top: 50px; */
        margin-bottom: 30px;
        text-transform: uppercase;
        letter-spacing: 2px;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }
    
    form {
        margin: 0 auto;
        max-width: 500px;
        background-color: #4D8C8E;
        padding: 30px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0,0,0,0.2);
         background-color: #EEE;
    }
    
    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    input[type="email"],
    textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        box-sizing: border-box;
        border-radius: 3px;
        border: 1px solid #CCC;
        font-size: 16px;
    }
    
    input[type="text"],
    textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        box-sizing: border-box;
        border-radius: 3px;
        border: 1px solid #CCC;
        font-size: 16px;
    }
    input[type="file"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        box-sizing: border-box;
        border-radius: 3px;
        border: 1px solid #CCC;
        font-size: 16px;
        background-color: #F5F5F5;
        cursor: pointer;
    }

    input[type="file"]::-webkit-file-upload-button {
        background-color: #4CAF50;
        color: #FFF;
        border: none;
        border-radius: 3px;
        padding: 10px 20px;
        cursor: pointer;
        transition: background-color 0.2s ease;
    }

    input[type="file"]::-webkit-file-upload-button:hover {
        background-color: #2E8B57;
    }
    
    button {
        display: block;
        margin: 0 auto;
        padding: 10px 20px;
        background-color: #149ad7;
        color: #FFF;
        border: none;
        border-radius: 3px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.2s ease;
    }
    
    button:hover {
        background-color: #4D8C8E;
    }
    
    .textareas {
        display: flex;
        flex-wrap: wrap;
        margin-top: 20px;
        background-color: #FFF;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0,0,0,0.2);
    }
    
    .textareas label {
        display: block;
        margin-bottom: 10px;
        font-weight: bold;
        text-align: center;
        flex: 1 1 100%;
    }
    
    .textareas textarea {
        flex: 1 1 100%;
        margin-bottom: 20px;
        border-radius: 3px;
        border: 1px solid #CCC;
        font-size: 16px;
    }
    
    
    @media (max-width: 500px) {
        form, .textareas {
        max-width: 90%;
        }
    }
  </style>
</head>
<body><form class="" action="send.php" method="post" enctype="multipart/form-data">
<h1 style="color:red">Mass Mail Dispatcher</h1>
    <hr><br>
    <label for="from">From:</label>
    <input type="email" name="email" value="" />
    <BR>
    <label for="message">Subject:</label>
    
    <input type="text" name="subject" value="" />
    <label for="message">Message:</label>
    <input type="text" name="message" value="" />
    <label for="csvFile">CSV File:</label>
    <input type="file" id="csvFile" name="csvfile" onchange="validateEmailsFromFile(this.files[0])">

    <button type="submit" name="send" >SEND</button>

    <div id="validEmails"></div>
<div id="invalidEmails"></div>


</form>
<script
      src="https://code.jquery.com/jquery-3.2.1.min.js">
</script>
<script>


function validateEmail(email) {
  const regex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,3}$/;
  return regex.test(email);
}



function validateEmailsFromFile(file) {
  const reader = new FileReader();
  reader.onload = function(event) {
    const csv = event.target.result;
    const lines = csv.split('\n');
    const validEmailsContainer = document.createElement("div");
    const invalidEmailsContainer = document.createElement("div");
    
  
    const validEmailsHeading = document.createElement("h2");
    validEmailsHeading.textContent = "Valid Emails";
    const invalidEmailsHeading = document.createElement("h2");
    invalidEmailsHeading.textContent = "Invalid Emails";
    
    for (let i = 0; i < lines.length; i++) {
      const email = lines[i].trim();
      if (email !== "" && validateEmail(email)) {
        const validEmailElement = document.createElement("div");
        validEmailElement.textContent = email;
        validEmailsContainer.appendChild(validEmailElement);
      } else if (email !== "") {
        const invalidEmailElement = document.createElement("div");
        invalidEmailElement.textContent = email;
        invalidEmailsContainer.appendChild(invalidEmailElement);
      }
    }
    
   
    document.body.appendChild(validEmailsHeading);
    document.body.appendChild(validEmailsContainer);
    document.body.appendChild(invalidEmailsHeading);
    document.body.appendChild(invalidEmailsContainer);
  }
  reader.readAsText(file);
}

</script>






</body>
</html>