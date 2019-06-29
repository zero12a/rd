<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/lib/bootstrap4/css/bootstrap.min.css" >
    
        <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="/lib/bootstrap4/jquery-3.4.1.slim.min.js" i></script>

    <script src="/lib/bootstrap4/js/bootstrap.min.js"></script>

    <!-- 아이콘-->
    <script src="/lib/feather.min.js"></script>

    
    <style>

    </style>

    <script>

    $( document ).ready(function() {
      alert( "document ready!" );
      feather.replace();
    });

    </script>
  </head>
  <body>
    <div id="menu">
            <div class="panel list-group">
             <a href="#" class="list-group-item" data-toggle="collapse" data-target="#sm" data-parent="#menu"><i style="padding-left:0px;padding-top:0px;"
                color="silver" 
                width="20"
                height="20"
                data-feather="folder"></i> <span class="align-middle">MESSAGES</span></a>
             <div id="sm" class="sublinks collapse">
              <a class="list-group-item small"><i style="padding-left:0px;padding-top:0px;"
                color="silver" 
                width="20"
                height="20"
                data-feather="chevron-right"></i> inbox</a>
              <a class="list-group-item small"><i style="padding-left:0px;padding-top:0px;"
                color="silver" 
                width="20"
                height="20"
                data-feather="chevron-right"></i> sent</a>
             </div>
             <a href="#" class="list-group-item" data-toggle="collapse" data-target="#sl" data-parent="#menu"><i style="padding-left:0px;padding-top:0px;"
                color="silver" 
                width="20"
                height="20"
                data-feather="folder"></i> <span class="align-middle">TASKS</span> <span class="glyphicon glyphicon-tag pull-right"></span></a>
             <div id="sl" class="sublinks collapse">
              <a class="list-group-item small"> saved tasks</a>
              <a class="list-group-item small"> add new task</a>
             </div>
             <a href="#" class="list-group-item">ANOTHER LINK ...<span class="glyphicon glyphicon-stats pull-right"></span></a>
            </div>
    </div>
 

</body>
</html>