<!DOCTYPE html>
<html>
    <head>
        <meta charset="GBK">
        <title>JavaScript Learning</title>
        <style type="text/css">
            .imgStyle{
                height: 100px;
                width: 100px;
                border: 3px solid gray;
            }
            .imgStyle:hover{
                border: 3px solid red;
                cursor: pointer;
            }
        </style>
    </head>
    <body>
        <h2><a onclick="preventDefaultAction(event);" href="http://baidu.com" >On this page right click wouldn't work!</a></h2>
        <img height="540" width="540" style="border: 3px solid grey" 
             src="images/1.jpg" id="mainImage" />
        <br/>
        <div id="myDiv" onclick="changeImage(event)">
            <img class="imgStyle" src="images/1.jpg" />
            <img class="imgStyle" src="images/2.jpg" />
            <img class="imgStyle" src="images/3.jpg" />
            <img class="imgStyle" src="images/4.jpg" />
            <img class="imgStyle" src="images/5.jpg" />
        </div>
    </body>
    <script  type="text/javascript">
        document.oncontextmenu = preventDefaultAction;
        function preventDefaultAction(event){
            event = event || window.event;
            if( event.preventDefault){
                event.preventDefault();
            }else{
                event.returnValue=false;
            }
        }
    
    </script>
</html>

