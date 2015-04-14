<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
  <!---  <link rel="stylesheet" href="static/css/bootstrap.min.css">
    <script src="static/js/jquery-1.11.2.js"></script>
    <script src="static/js/bootstrap.min.js"></script>
    <meta charset="utf-8"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

    <title>Ajax</title>
    <script>
        var XMLHttp;
        function processAJAX(name, email , company)
        {
            if(window.XMLHttpRequest)
            {
                XMLHttp = new XMLHttpRequest();
            }
            else
            {
                XMLHttp = new ActiveXObject();
            }

            XMLHttp.open("POST","requesthandler.php",true);

            XMLHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");

            XMLHttp.onreadystatechange = function()
            {
                if(XMLHttp.readyState == 4)
                {
                    document.getElementById("data").innerHTML = XMLHttp.responseText;
                    document.getElementById("del").disabled = false;

                }
            }

            XMLHttp.send("names="+name+"&emails="+email+"&companys="+company);
        }

        function show()
        {
            //document.getElementById("msg").innerHTML = "<img src=\"img.gif\" width='50' height='50' />";
            var name = document.getElementById("name").value;
            var company = document.getElementById("company").value;
            var email = document.getElementById("email").value;

            //alert(name + email + company);

            var ne = document.getElementById("nameerror");
            var ce = document.getElementById("comerror");
            var ee = document.getElementById("emailerror");
            if(name == "")
            {
                ne.innerHTML = "Enter a valid Name";
            }
            else
            {
                ne.innerHTML = "";
            }

            if(validateEmail(email) == false)
            {
                ee.innerHTML = "Invalid email";

            }
            else {
                ee.innerHTML = "";
            }
            if(validateEmail(email))
            {
                if(name !="" )
                {
                    processAJAX(name,email,company);
                    document.getElementById("name").value = "";
                    document.getElementById("company").value = "";
                    document.getElementById("email").value = "";
                }
                else
                {
                    alert("Name field is empty");
                }

            }
            else
            {
                alert("Email Not found");
            }
        }

        function validateEmail(email) {
            var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
            return re.test(email);
        }
    </script>
</head>
<body onload="refresh()">
<br>
<br>
<div class="container page-header">
    <h1>Simple AJAX Test App</h1>
</div>
    <div class="container">
        <div class="col-lg-6 col-md-6">
            <form name="form" id="myform" method="post" onsubmit="show()">
                <div class="form-group">
                    <input class="form-control" type="text" name="fullname" id="name" placeholder="Full Name" value="">
                    <div class="alert-warning" id="nameerror"></div>
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="company" id="company" placeholder="Company Name" value="">
                    <div class="alert-warning" id="comerror"></div>
                </div>
                <div class="form-group">
                    <input class="form-control" type="email" name="email" id="email" placeholder="Email Address" value="">
                    <div id="emailerror" class="alert-warning"></div>
                </div>

            </form>
            <button class="btn btn-primary id="submit" onclick="show()">New Entity</button>
        </div>
        <script>
            function searchItem()
            {
                txt = document.getElementById("srctxt").value;
               // alert(txt);
                if(window.XMLHttpRequest)
                {
                    XMLHttp = new XMLHttpRequest();
                }
                else
                {
                    XMLHttp = new ActiveXObject();
                }

                XMLHttp.open("GET","search.php?phrase="+txt,true);

                XMLHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");

                XMLHttp.onreadystatechange = function()
                {
                    if(XMLHttp.readyState == 4)
                    {
                        document.getElementById("data").innerHTML = XMLHttp.responseText;
                        document.getElementById("del").disabled = false;

                    }
                }

                XMLHttp.send();
            }
        </script>
        <div class="col-lg-6 col-md-6">
            <form class="form-inline right" method="post" >
                <div class="form-group">
                    <input type="text" name="seachtxt" id="srctxt" class="form-control" placeholder="search by name" onkeyup="searchItem()">
                    <!--<span class="input-group-btn"> <button class="btn btn-default" id="srcbtn">Search</button></span> -->
                </div>
            </form>
            <table class="table table-responsive table-striped table-hover">
                <thead>
                    <tr>
                        <th>Name</th><th>Company</th><th>Email Address</th><th>Action Perform</th>
                    </tr>
                </thead>
                <tbody id="data" class="t">

                </tbody>
            </table>
            <button class="btn btn-primary" id="submit" onclick="refresh()">Reload</button>
            <button class="btn btn-primary" hidden="hidden" id="del" onclick="removeFunc()">Remove All</button>
            <script>
                function refresh()
                {
                    document.getElementById("data").innerHTML = "<img src=\"img.gif\" width='50' height='50' />";
                    if(window.XMLHttpRequest)
                    {
                        XMLHttp = new XMLHttpRequest();
                    }
                    else
                    {
                        XMLHttp = new ActiveXObject();
                    }

                    XMLHttp.open("POST","onload.php",true);

                    XMLHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");

                    XMLHttp.onreadystatechange = function()
                    {

                        if(XMLHttp.readyState == 4)
                        {

                            setData(XMLHttp.responseText);

                        }
                    }

                    XMLHttp.send();


                }
                function setData(data)
                {

                    var xxx = document.getElementById("del");
                    console.log(xxx);
                    if(data == "")
                    {
                        xxx.disabled = true;
                    }
                    else
                    {
                        xxx.disabled = false;
                    }
                    document.getElementById("data").innerHTML = data;
                }
                function removeFunc()
                {
                    if(window.XMLHttpRequest)
                    {
                        XMLHttp = new XMLHttpRequest();
                    }
                    else
                    {
                        XMLHttp = new ActiveXObject();
                    }

                    XMLHttp.open("POST","ondelete.php",true);

                    XMLHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");

                    XMLHttp.onreadystatechange = function()
                    {
                        if(XMLHttp.readyState == 4)
                        {
                           setData(XMLHttp.responseText);

                        }
                    }

                    XMLHttp.send();
                }
                function deleteItem(id)
                {
                    r = confirm("Are You Sure You Want To Delete ?");

                    if(r == true)
                    {
                        if(window.XMLHttpRequest)
                        {
                            XMLHttp = new XMLHttpRequest();
                        }
                        else
                        {
                            XMLHttp = new ActiveXObject();
                        }

                        XMLHttp.open("GET","deleteItem.php?id="+id,true);

                        XMLHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");

                        XMLHttp.onreadystatechange = function()
                        {
                            if(XMLHttp.readyState == 4)
                            {
                                setData(XMLHttp.responseText);

                            }
                        }

                        XMLHttp.send();
                    }
                    else
                    {

                    }

                }
            </script>
        </div>
    </div>

    
</body>
</html>