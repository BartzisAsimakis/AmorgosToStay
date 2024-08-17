var buttonUrl = document.getElementById('buttonUrl');

document.getElementById('imageB').style.display='none';
document.getElementById('urlBox').addEventListener('change', function() {
    var urlElement = document.getElementById('url');
    var buttonSub = document.getElementById('buttForm');

    buttonUrl.disabled = this.disabled;
    buttonSub.disabled = !buttonUrl.disabled;



    if (urlElement.style.backgroundColor === 'orange' || urlElement.style.backgroundColor === '') {
        urlElement.style.backgroundColor = 'white';
        urlElement.disabled = false;
        document.getElementById('imageB').style.display='block';
        document.getElementById('labelPhoto').style.display='block';
    } else {
        urlElement.style.backgroundColor = 'orange';
        urlElement.disabled = true;
        document.getElementById('imageB').style.display='none';
        document.getElementById('labelPhoto').style.display='none';
    }
});

document.getElementById('buttonUrl').onsubmit=function (){

     if( document.getElementById('url').value ===" "){
        alert("Enter a url address");
         document.getElementById('url').value.focus();
     }
}

        document.getElementById('message').onblur= function (){
            let messageString = document.getElementById('message'). value;
            if((messageString.length<100)&&(messageString.length>0))
            {
                document.getElementById('message').value="";
                document.getElementById('message').style.backgroundColor= 'yellow';
                document.getElementById('message').focus();
                document.getElementById('message'). placeholder= "Το λιγοτερο εκατο (100) χαρακτήρες.";
                //document.getElementById('lname').disabled = true;
            }
            else
            {
                document.getElementById('message').style.backgroundColor= 'white ';
                document.getElementById('message'). placeholder= "Το όνομα σου..";
               // document.getElementById('lname').disabled = false;
            }
         }

         document.getElementById('mob').onblur= function (){
            let mobile = document.getElementById('mob'). value;
            if(mobile.length!==10)
            {
                document.getElementById('mob').value="";
                document.getElementById('mob').style.backgroundColor= 'yellow';
                document.getElementById('mob').focus();
                document.getElementById('mob'). placeholder= "Ακριβώς δεκα (10) ψηφια ";
                //document.getElementById('lname').disabled = true;
            }
            else
            {
                document.getElementById('mob').style.backgroundColor= 'white ';
                document.getElementById('mob'). placeholder= "Το κινητό σου..";
               // document.getElementById('lname').disabled = false;
            }
         }
