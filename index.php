<!DOCTYPE html>
<html>
    <head>
        <meta charset="GBK">
        <title>jQuery Learning</title>
        <style>
            .divContainer{
                font-size: 24px;
                color: #ccc;
                font-weight: 200;
            }
        </style>
    </head>
    <body>
        <?php
        ?>

<!--        Skills: <input type="checkbox" name="skills" value="javascript"/> JavaScript
 <input type="checkbox" name="skills" value="jquery"/> jQuery
 <input type="checkbox" name="skills" value="php"/> PHP
 <input type="checkbox" name="skills" value="html"/> HTML
 <input type="checkbox" name="skills" value="css"/> CSS<br/><br/>
 
 Prefered Cities: <input type="checkbox" name="skills" value="New York"/> New York
 <input type="checkbox" name="cities" value="Beijing"/> Beijing
 <input type="checkbox" name="cities" value="Shanghai"/> Shanghai
 <input type="checkbox" name="cities" value="Hong Kong"/> Hong Kong
 <input type="checkbox" name="cities" value="Chengdu"/> Chengdu<br/><br/>
 
 <input type="submit" value="Get skills" id="btn1" />
 <input type="submit" value="Get cities" id="btn2" />-->

        <input type="button" value="Click me" id="btn" />    
        <input type="button" value="Undelegate" id="btn1" />    
        <span id="myspan"> Country in the world.</span>
        <ul>
            <li>United States</li>
            <li>United Kingdom</li>
            <li>China</li>
            <li>Japan</li>
            <li>Canada</li>
        </ul>   
        First Name : <input id="firstName" value=""/> <br/>
        Select Percentages: 
        <select id="ddlPrecentage" >
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="30">30</option>
            <option value="40">40</option>
            <option value="50">50</option>
            <option value="60">60</option>
            <option value="70">70</option>
            <option value="80">80</option>
            <option value="90">90</option>
            <option value="100">100</option>
        </select>
        <input type="button" id="myBtn" value="Animate Progress"  />
        <br/>
        <div title="outDiv" id="outDiv" style="background-color: #eee; width: 500px; height: 20px; padding: 5px;"  >
            <div id="innerDiv" style="background-color: #ff0000; width: 0px; height: 18px;"></div>
        </div>
    </body>
    <script type="text/javascript" src="jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            var previousPrecentage  = 0;
            var currentPrecentage  = 0;
            
            function animationProgressBar( previousPrecentage, currentPrecentage  ){
                $( '#innerDiv' ).animate({
                    'width' : (500 * currentPrecentage ) / 100
                }, 3000);
                
                if( previousPrecentage > currentPrecentage){
                    currentPrecentage -=1;
                }
                // animation can not only animate the DOM object and it also can
                // animate only object or value you specified!
                // Optimize the current progress bar
                
                $({counter: previousPrecentage } ).animate( { counter:  currentPrecentage},{ 
                    duration : 3000,
                    step: function () {
                        $('#innerDiv').text( Math.ceil(  this.counter) + '%' );
                    }
                
                });
            }
            
            $('#myBtn').click( function (){
                previousPrecentage = currentPrecentage;
                currentPrecentage  = $('#ddlPrecentage').val();
                
                animationProgressBar(previousPrecentage,currentPrecentage  );
            });
        });
    </script>


</html>
