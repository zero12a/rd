<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">


    <!-- Custom styles for this template -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

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

    /*사이드바 100픽셀 고정*/
    .my-sidebar {
      -ms-flex: 0 0 230px;
      flex: 0 0 230px;
    }
    /*
    body {
      height:100%;
    }
    */

    </style>

    <script language=javascript>

    var lastActiveTabId = "";
    function addTab(tId, tNm, tUrl){
      //alert("addTab = " + tId);
      //tab
      //$("#tabsJustified").append('<li id="li_' + tId + '" class="nav-item"><a href="" data-target="#' + tId + 'Content" id="' + tId + '" data-toggle="tab" class="nav-link small text-uppercase">' + tNm + '<button class="close" type="button" onclick="closeTab(\'' + tId + '\')">×</button></a></li>');      
      $("#tabsJustified").append('<li id="li_' + tId + '" class="nav-item"><a href="#' + tId + 'Content"  id="' + tId + '" data-toggle="tab" class="nav-link small text-uppercase">' + tNm + '<button class="close" type="button">×</button></a></li>');      
    
      lastActiveTabId = 'li_' + tId;

      //tabContent
      tStr = '<div id="' + tId + 'Content" class="tab-pane fade active show h-100" style="background:silver;overflow:visible" >';
      tStr += '<iframe src="' + tUrl + '" style="overflow:visible" allowfullscreen="allowFullScreen" frameborder="0" width="100%" height="100%" style="background-color:gray;"></iframe>';
      tStr += '</div>';
      $("#tabsJustifiedContent").append(tStr);

      //탭활성화 하기
      //setTimeout(function() {
        $("#tabsJustified > #li_" + tId + " a").tab('show');
      //}, 1000);

      //$("#tabsJustified > #li_" + tId).tab('show');
      
      //탭 이벤트 잡기
      $('#tabsJustified > #li_' + tId + ' a').on('show.bs.tab', function(){
        //alert(tId + ' shown.');
      });

    }


    $(document).ready(function() {
          alert("document ready");
            /**
          * Remove a Tab
          */
          $('#tabsJustified').on('click', ' li a .close', function() {
            alert("tabsJustified click close");
            var tabId = $(this).parents('li').children('a').attr('href');
            var liId = $(this).parents('li').attr('id');
            //alert(liId);
            $(this).parents('li').remove('li');//li 지우기
            //alert(tabId);
            $(tabId).remove();//컨텐츠도 지우기
            //reNumberPages();

            if(liId == lastActiveTabId){
              $('#tabsJustified a:first').tab('show');
            }
            
          });

          $("#tabsJustified").on("click", "a", function(e) {
            //alert("tabsJustified click a");          
            if($(this)){
              e.preventDefault();
              lastActiveTabId = $(this).parents('li').attr('id');
              //alert("lastActiveTabId = " + lastActiveTabId);
              $(this).tab('show');
            }

          });

    });




    </script>
  </head>

  <body >
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
      <a class="navbar-brand col my-sidebar mr-0" href="#">Company name</a>
      <div class="w-100 bg-secondary text-right align-middle">
            <b>홍길동</b>님 어서 오세요. 최근 <b>특정 IP</b>에서 로그인 시간은 
            <b>2018.06.05 09:10:10</b>입니다.
      </div>
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="#">Sign out</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid h-100" style="background-color:red;overflow:visible;">
      <div class="row h-100" style="background-color:yellow;overflow:visible;">
        <nav class="col my-sidebar d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="#"  onclick="addTab('aaa','대시보드','login.php')">
                  <span data-feather="home"></span>
                  Dashboard <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#" onclick="addTab('bbb','주문내역','content_v4_table.php')">
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

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted bg-dark">
              <span>Saved reports</span>
              <a class="d-flex align-items-center text-muted" href="#">
                <span data-feather="plus-circle"></span>
              </a>
            </h6>
            <ul class="nav flex-column mb-2">
              <li class="nav-item bg-dark">
                <a class="nav-link" href="#">
                  <span data-feather="chevron-right" style="height:22px;width:22px"></span>
                  <span class="h-100 align-top">Current month</span>
                </a>
              </li>
              <li class="nav-item bg-dark">
                <a class="nav-link" href="#">
                  <span data-feather="file-text" style="height:22px;width:22px"></span>
                  <span class="h-100 align-top">Last quarter</span>
                </a>
              </li>
              <li class="nav-item bg-dark">
                <a class="nav-link" href="#">
                  <span data-feather="file-text" style="height:22px;width:22px"></span>
                  <span class="h-100 align-top">소셜로 가자</span>
                </a>
              </li>
              <li class="nav-item bg-dark">
                <a class="nav-link" href="#">
                  <span data-feather="file-text" style="height:22px;width:22px"></span>
                  <span class="h-100 align-top">Year-end sale</span>
                </a>
              </li>
            </ul>
          </div>
        </nav>

        <main role="main" class="col pt-0 pb-0 pl-0 pr-0 "
         style="background-color:green;overflow:visible;">
          
           
          <div id="tabs" class="h-100" style="background-color:blue;overflow:visible;">
            <ul id="tabsJustified" class="nav nav-tabs">
                <li class="nav-item"><a href="#home1" data-url="content.php"  data-toggle="tab" class="nav-link small text-uppercase">Home<button class="close" type="button">×</button></a></li>
                <li class="nav-item"><a href="#profile1" data-url="login.php" data-toggle="tab" class="nav-link small text-uppercase active">Profile</a></li>
                <li class="nav-item"><a href="" data-target="#messages1" data-toggle="tab" class="nav-link small text-uppercase">Messages</a></li>
                <li class="nav-item"><a href="" data-url="login.php" data-toggle="tab" class="nav-link small text-uppercase">
                login</a></li>
            
            </ul>
            <div id="tabsJustifiedContent" class="tab-content h-100" style="overflow:visible" >
                <div id="home1" class="tab-pane fade">
                  <input type=button id=a value="addTab" onclick="addTab('aaa','bbbbb')">
                  <input type=button id=a value="viewUrl" onclick="viewUrl()">                           
                    <div class="list-group"><a href="" class="list-group-item d-inline-block"><span class="float-right badge badge-pill badge-dark">51</span> Home Link</a> <a href="" class="list-group-item d-inline-block"><span class="float-right badge badge-pill badge-dark">8</span> Link 2</a>                            <a href="" class="list-group-item d-inline-block"><span class="float-right badge badge-pill badge-dark">23</span> Link 3</a> <a href="" class="list-group-item d-inline-block text-muted">Link n..</a></div>
                </div>
                <div id="profile1" class="tab-pane fade active h-100" style="background:silver;overflow:visible" >
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

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>

    
  </body>
</html>
