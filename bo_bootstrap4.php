<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.0/examples/dashboard/dashboard.css" rel="stylesheet">


    <style>
    
    .nav-tabs > li .close {
        margin: -2px 0 0 10px;
        font-size: 18px;
    }

    html{
      height: calc(100vh - 110px);
      overflow-y: visible;
    }

    body,row {
      height: 100%;
    }

    /*
    body {
      height:100%;
    }
    */

    </style>

    <script language=javascript>
      function addTab(tId, tNm){
        alert(1);
        $("#tabsJustified").append('<li class="nav-item"><a href="" data-target="#' + tId + '" id="' + tId + '" data-toggle="tab" class="nav-link small text-uppercase">' + tNm + '</a><button class="close" type="button" onclick="closeTab(' + tId + ')">×</button></li>');      
      }

      function viewUrl(){
        alert(22);
        var obj = $("#home1");
        //alert(obj);        
        var url = $("#home1").attr("data-url");
        alert(url);
        if (typeof url !== "undefined") {
          var url = $("#home1").attr("data-url");
          var pane = $("#home1"), href = $("#home1").hash;

          // ajax load from data-url
          $("#home1Content").load(url,function(result){ 
              alert("end load");     
              pane.tab('show');
          });
        } else {
            $("#home1").tab('show');
        }

      }

      function initBody(){
        $('#tabs').on('click','#tabsJustified a',function (e) {
            alert(1);
            e.preventDefault();
            alert(2);
            var url = $(this).attr("data-url");
            alert(url);
            if (typeof url !== "undefined") {
                alert(4);
                var pane = $(this), href = this.hash;

                // ajax load from data-url
                //$(href).load(url,function(result){ 
                //  alert(result);     
                //  pane.tab('show');
                //});
                paneID = $(e.target).attr('href');
                alert("paneID : "+paneID);
                src = $(paneID).attr('data-src');
                alert("paneID : "+paneID);
                $(paneID+" iframe").attr("src",url)

            } else {
                $(this).tab('show');
            }
        });
      }



      function closeTab(tId){
        //
        $("").remove();
      }
    </script>
  </head>

  <body onload="initBody()">
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Company name</a>
      <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="#">Sign out</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid h-100" style="background-color:red;overflow:visible;">
      <div class="row h-100" style="background-color:yellow;overflow:visible;">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="#">
                  <span data-feather="home"></span>
                  Dashboard <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file"></span>
                  Orders
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="shopping-cart"></span>
                  Products
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="users"></span>
                  Customers
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="bar-chart-2"></span>
                  Reports
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="layers"></span>
                  Integrations
                </a>
              </li>
            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Saved reports</span>
              <a class="d-flex align-items-center text-muted" href="#">
                <span data-feather="plus-circle"></span>
              </a>
            </h6>
            <ul class="nav flex-column mb-2">
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file-text"></span>
                  Current month
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file-text"></span>
                  Last quarter
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file-text"></span>
                  Social engagement
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file-text"></span>
                  Year-end sale
                </a>
              </li>
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-2 px-3" style="background-color:green;overflow:visible">
          
           
          <div id="tabs" class="h-100" style="background-color:blue;overflow:visible">
            <ul id="tabsJustified" class="nav nav-tabs">
                <li class="nav-item"><a href="#home1" data-url="content.php"  data-toggle="tab" class="nav-link small text-uppercase">Home<button class="close" type="button">×</button></a></li>
                <li class="nav-item"><a href="#profile1" data-url="login.php" data-toggle="tab" class="nav-link small text-uppercase active">Profile</a></li>
                <li class="nav-item"><a href="" data-target="#messages1" data-toggle="tab" class="nav-link small text-uppercase">Messages</a></li>
                <li class="nav-item"><a href="" data-url="login.php" data-toggle="tab" class="nav-link small text-uppercase">
                login</a></li>
            
            </ul>
            
            <br>
            <div id="tabsJustifiedContent" class="tab-content h-100" style="overflow:visible" >
                <div id="home1" class="tab-pane fade">
                  <input type=button id=a value="addTab" onclick="addTab('aaa','bbbbb')">
                  <input type=button id=a value="viewUrl" onclick="viewUrl()">                           
                    <div class="list-group"><a href="" class="list-group-item d-inline-block"><span class="float-right badge badge-pill badge-dark">51</span> Home Link</a> <a href="" class="list-group-item d-inline-block"><span class="float-right badge badge-pill badge-dark">8</span> Link 2</a>                            <a href="" class="list-group-item d-inline-block"><span class="float-right badge badge-pill badge-dark">23</span> Link 3</a> <a href="" class="list-group-item d-inline-block text-muted">Link n..</a></div>
                </div>
                <div id="profile1" class="tab-pane fade active show h-100" style="background:silver;overflow:visible" >
                  <iframe src="" style="overflow:visible" allowfullscreen="allowFullScreen" frameborder="0" width="100%" height="100%" style="background-color:gray;"></iframe>
                </div>
                <div id="messages1" class="tab-pane fade">
                  <div class="align-self-stretch">Aligned flex item1</div>
                  <div class="align-self-stretch">Aligned flex item2</div>
                  <div class="align-self-stretch">Aligned flex item3</div>

                    <div class="list-group"><a href="" class="list-group-item d-inline-block"><span class="float-right badge badge-pill badge-dark">44</span> Message 1</a> <a href="" class="list-group-item d-inline-block"><span class="float-right badge badge-pill badge-dark">8</span> Message 2</a>                            <a href="" class="list-group-item d-inline-block"><span class="float-right badge badge-pill badge-dark">23</span> Message 3</a> <a href="" class="list-group-item d-inline-block text-muted">Message n..</a></div>
                </div>
            </div>
          </div>
                
        </main>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script
			  src="https://code.jquery.com/jquery-3.3.1.min.js"
			  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
			  crossorigin="anonymous"></script>
        
    <script src="https://getbootstrap.com/docs/4.0/dist/js/bootstrap.min.js"></script>

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>

    
  </body>
</html>
