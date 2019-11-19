<?php $logged_user = $_SESSION['logged_user']; ?>
<!-- Customize Modal -->
<head>

<style>
.selected{ 
   box-shadow:0px 0px 0px 5px #000;
}

</style>

</head>

<div id="customize-theme" class="modal fade" role="dialog">
    <div class="modal-dialog">
        
        <!-- Customize Modal Content-->
        <div class="modal-content">
            <div class="modal-header modal-heading modalbg">
                <button type="button" class="close close12" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center textoutliner"><strong>Style</strong></h4>
            </div>
            <div class="modal-body">
                <div class = "row">
                    <div class = "col-md-12">
                        <ul class="nav nav-pills nav-justified" style = "margin-bottom: 10px;">
                            <li class = "active"><a data-toggle="pill" href="#requests-div"><strong style="cursor: pointer">Colors</strong></a></li>
                            <li><a data-toggle="pill" href="#fonts-div"><strong style="cursor: pointer">Fonts</strong></a></li>
                            <li><a data-toggle="pill" href="#cursors-div"><strong style="cursor: pointer">Pointers</strong></a></li>
                            <li><a data-toggle="pill" href="#invites-div"><strong style="cursor: pointer">Extras</strong></a></li>
                        </ul>
                    </div></canvas>
                    <div class = "col-md-12">
                        <div class="tab-content">
                            <div id="requests-div" class="tab-pane fade in active">
                                <table style="width:100%"><tr>
                                <td><div id="green" class="blocks" onClick="themeCookie('green');changeBGColor(':#D7eadd', 'linear-gradient(to bottom,#009900,#009900 50%,#007f00 50%,#007f00);','#1d8f15', '#14620f', '#185729');addBGclouds('none');">Green</div></td>
                                <td><div id="blue" class="blocks" onClick="themeCookie('blue');changeBGColor(':#CBF9F3', 'repeating-linear-gradient(45deg,#3485f8,#3485f8 10px,#075ad0 10px,#075ad0 20px);','#3fa0e5', '#1b7ec5', '#198bdf', '#1578c1');addBGclouds('none');">Blue</div></td>
                                <td><div id="pink" class="blocks" onClick="themeCookie('pink');changeBGColor(':#feecf2', 'repeating-linear-gradient(-55deg,#fccfe2,#fccfe2 10px,#fac0d8 10px,#fac0d8 20px);','#f7aec4','#f07197', '#f95d9b', '#e80862');addBGclouds('none');">Pink</div></td>
                                <td><div id="orange" class="blocks" onClick="themeCookie('orange');changeBGColor(':#FCF7D1', 'repeating-linear-gradient(to right,#f6ba52,#f6ba52 10px,#ffd180 10px,#ffd180 20px);','#ed8023', '#bd5f0f', '#9d4f0d');addBGclouds('none');">Orange</div></td>
                                <td><div id="violet" class="blocks" onClick="themeCookie('violet');changeBGColor(':#e6e6fa', 'repeating-radial-gradient(circle,purple,purple 10px,#4b026f 10px,#4b026f 20px);','#8a49df', '#a2158e', '#660d5a');addBGclouds('none');">Violet</div></td>
                                </tr>
                                <!--background, navbar, button, buttonH, buttonA-->
                                <tr>
                                <td><div id="strawberry" class="blocks" onClick="changeBGColor(':#d13030', 'green','#EEC247','#D3AB2F','#A74901');addBGclouds('none');">Strawberry</div></td>
                                <td><div id="sky" class="blocks" onClick="changeBGColor(':linear-gradient(to top, #5BC0EB, #CBF9F3);', 'white','#7ec0ee','#6499be','#4b738e');addBGclouds('block');">Sky</div></td>
                                <td><div id="watermelon" class="blocks" onClick="changeBGColor(':linear-gradient(to top, #f96868 80%, white);', 'green','#d13030','#253947','#0c1317');addBGclouds('none');">Watermelon</div></td>
                                <td><div id="chocoice" class="blocks" onClick="changeBGColor(':#ffe3b9', '#6b3e26', '#6b3e26','#542a0c','#2a1506');addBGclouds('none');"><div style="color:white;">Chocolate</div> Ice cream</div></td>
                                <td><div id="FB" class="blocks" onClick="changeBGColor(':#e9ebee', '#4267b2', '#4267b2','#3B5CA0','#3B5CA0');addBGclouds('none');">fb</div></td>
                                </tr>
                                <!-- image and more backgrounds-->
                                <tr>
                                <td><div id="galaxy" class="blocks" onClick="changeBGColor('-image: url(<?php echo base_url('images/galaxy.jpg'); ?>)', '#060707','#404a4d','#1d2223','whitesmoke');addBGclouds('none');">Galaxy</div></td>
                                <td><div id="rainbow" class="blocks" onClick="changeBGColor(':linear-gradient(124deg, #FF9AA2, #FFB7B2, #FFDAC1, #E2F0CB, #B5EAD7, #C7CEEA);', '#5BC0EB','#5BC0EB');document.cookie='activaterain=1;path=/;';addBGclouds('none');">Rainbow</div></td>
<!--                            <td><div id="soundswitch" class="blocks" onClick="addBGsound('none');">No Sound</div></td>
                                <td><div id="soundswitch1" class="blocks" onClick="addBGsound('block');">Sound</div>
                                </td>-->
                                </tr>
                                <tr><td>&nbsp</td></tr>
                                <tr><td colspan="5"><center><input class="btn btn-primary buttonsbgcolor" type="button" value="Done!" onClick="window.location.reload()"></center></td></tr>
                                </table>
                            </div>
                            <div id="fonts-div" class="tab-pane fade in">
                                <table style="width:100%"><tr>

                                <!-- Font styles-->
                                <tr> <td><div class="blocks" onClick="changeFont('\'Sniglet-Regular\'');" style="font-family:'Sniglet-Regular'">Sniglet</div></td>
                                <td><div class="blocks" onClick="changeFont('\'ComickBook_Simple\'');" style="font-family:'ComickBook_Simple'">ComickBook</div></td>
                                <td><div class="blocks" onClick="changeFont('\'Asparagus Sprouts\'');" style="font-family:'Asparagus Sprouts'">Asparagus Sprouts</div></td>
                                <td><div class="blocks" onClick="changeFont('\'Comic Sans MS\'');" style="font-family:'Comic Sans MS'">Comic Sans MS</div></td>
                                <td><div class="blocks" onClick="changeFont('\'Wingdings\'');" style="font-family:'Wingdings'">Wingdings</div></td>
                                </tr>
                                <tr><td>&nbsp</td></tr>
                                <tr><td colspan="5"><center><input class="btn btn-primary buttonsbgcolor" type="button" value="Done!" onClick="window.location.reload()"></center></td></tr>
                                </table>
                            </div>
                            <div id="cursors-div" class="tab-pane fade in">
                                <table style="width:100%">
                                <tr>
                                
                                <td><center><div class="blocks" onClick="mouseTrail();"><img src = "<?php echo base_url('images/cursors/trail.cur'); ?>"/><br>Mouse Trail</div></center></td>
                                <td class="defaultpointer"><center><div class="blocks" onClick="changePointer('');removeTrail();"><br>Default</div></center></td>
                                <td class="themepointer"><center><div class="blocks" onClick="changeThemePointer(getCookie('theme'));"><img src = "<?php echo base_url('images/cursors/green.cur'); ?>"/><br>Theme</div></center></td>
                                <td class="aric"><center><div class="blocks" onClick="changePointer('<?php echo base_url('images/cursors/aric.cur'); ?>');"><img src = "<?php echo base_url('images/cursors/aric.cur'); ?>"/><br>Aric</div></center></td>
                                <td class="kyloren"><center><div class="blocks" onClick="changePointer('<?php echo base_url('images/cursors/kyloren.cur'); ?>');"><img src = "<?php echo base_url('images/cursors/kyloren.cur'); ?>"/><br>Kylo Ren</div></center></td>
                                </tr>
                                <td class="watermelon"><center><div class="blocks" onClick="changePointer('<?php echo base_url('images/cursors/watermelon.cur'); ?>');"><img src = "<?php echo base_url('images/cursors/watermelon.cur'); ?>"/>Watermelon</div></center></td>
                                <td class="stormtrooper"><center><div class="blocks" onClick="changePointer('<?php echo base_url('images/cursors/stormtrooper.cur'); ?>');"><img src = "<?php echo base_url('images/cursors/stormtrooper.cur'); ?>"/>Stormtrooper</div></center></td>
                                <td class="ugandanknuckles"><center><div class="blocks" onClick="changePointer('<?php echo base_url('images/cursors/ugandanknuckles.cur'); ?>');"><img src = "<?php echo base_url('images/cursors/ugandanknuckles.cur'); ?>"/><br>Da Wae</div></center></td>

                                <tr><td>&nbsp</td></tr>
                                <tr><td colspan="5"><center><input class="btn btn-primary buttonsbgcolor" type="button" value="Done!" onClick="window.location.reload()"></center></td></tr>
                                </table>
                            </div>
                            <div id="invites-div" class="tab-pane fade in">
                                <table style="width:100%">
                                    <tr>
    <!--                                <td><div id="soundswitch" class="blocks" onClick="addBGsound('none');">No Sound</div></td>
                                        <td><div id="soundswitch1" class="blocks" onClick="addBGsound('block');">Sound</div>-->
                                        <td><div class="blocks" onClick="extrasRemover();">None</div></td>
                                        <td><div class="blocks" onClick="addBGsound('block');"><img src = "<?php echo base_url('images/extras/sound.png'); ?>"/>Sound</div></td>
                                        <td><div class="blocks" onClick="addBGsnow('block');"><img src = "<?php echo base_url('images/extras/snowflake.png'); ?>"/>Snowflake</div></td>
                                        <td><div class="blocks" onClick="addBGspark('block');"><img src = "<?php echo base_url('images/extras/sparkles.png'); ?>"/>Sparkles</div></td>
                                        <td><div class="blocks" onClick="addBGbubble('block');"><img src = "<?php echo base_url('images/extras/bubbles.png'); ?>"/>Bubbles</div></td>
                                    </tr>    
                                    <tr>
                                        <td><div class="blocks"><div class="btn btn-primary buttonsbgcolor textoutliner" onClick="buttonDance();" style="animation: dance 3s infinite;">Dancing Buttons</div></div></td>
                                        <td><div class="blocks" onClick="toggleRandomColors();addRainbowAnimation('block');"><img src = "<?php echo base_url('images/extras/randomcolors.png'); ?>"/>Random Colors</div></td>
                                        <td><div class="blocks" onClick="addBGclouds('block');"><img src = "<?php echo base_url('images/extras/randomcolors.png'); ?>"/>Clouds</div></td>
                                    </tr>
                                <!--<tr><td><div class="blocks" onClick="addBGfirework('block');">Fireworks</div></td></tr>-->
                                
                                <tr><td>&nbsp</td></tr>
                                <tr><td colspan="5"><center><input class="btn btn-primary buttonsbgcolor" type="button" value="Done!" onClick="window.location.reload()"></center></td></tr>
                                </table>
                            </div>
                            

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    
    document.cookie = "backgroundColor1=" + getCookie("backgroundColor") + ";" + ";path=/";  
    document.cookie = "NavbarColor1=" + getCookie("NavbarColor") + ";" + ";path=/";  
    document.cookie = "ButtonColor1=" + getCookie("ButtonColor") + ";" + ";path=/";
    document.cookie = "ButtonHColor1=" + getCookie("ButtonHColor") + ";" + ";path=/";
    document.cookie = "ButtonAColor1=" + getCookie("ButtonAColor") + ";" + ";path=/"; 
    document.cookie = "MousePointer1=" + getCookie("MousePointer") + ";" + ";path=/"; 
    
    
    function changeBGColor(background, navbar, button, buttonH, buttonA)
    {document.cookie='activaterain=0;path=/;';
        
        document.cookie = "backgroundColor=" + background + ";" + ";path=/";   
        document.cookie = "NavbarColor=" + navbar + ";" + ";path=/"; 
        document.cookie = "ButtonColor=" + button + ";" + ";path=/"; 
        document.cookie = "ButtonHColor=" + buttonH + ";" + ";path=/";
        document.cookie = "ButtonAColor=" + buttonA + ";" + ";path=/";

    }
    function changeFont(Fonty)
    {
        
        document.cookie = "Fonty=" + Fonty + ";" + ";path=/";

    }
    
    function toggleRandomColors()
    {
        if(getCookie("randomcolors")==='0')
            document.cookie = "randomcolors=1;path=/";
        
        else
            document.cookie = "randomcolors=0;path=/";
        
    }
    
    function buttonDance()
    {
        if(getCookie("dance")==='0' || getCookie("dance")==='')
            document.cookie = "dance=1;path=/";
        
        else
            document.cookie = "dance=0;path=/";
        
    }
    
    function themeCookie(value)
    {
        document.cookie = "theme=" + value + ";" + ";path=/";
    }
    
    function changePointer(value)
    {
        document.cookie = "MousePointer=" + value + ";" + ";path=/";
    }

    function changeThemePointer(theme)
    {
        var value='';
        
        switch(theme)
        {
            case 'green':value='<?php echo base_url('images/cursors/green.cur'); ?>';break;
            case 'blue':value='<?php echo base_url('images/cursors/blue.cur'); ?>';break;
            case 'pink':value='<?php echo base_url('images/cursors/pink.cur'); ?>';break;
            case 'orange':value='<?php echo base_url('images/cursors/orange.cur'); ?>';break;
            case 'violet':value='<?php echo base_url('images/cursors/violet.cur'); ?>';break;
            default:break;
        }
        
        changePointer(value);
    }
    function removeTrail(){
        document.cookie = "MouseTrail=0;" + ";path=/";
    }
    
    function mouseTrail()
    {
        if(getCookie("MouseTrail")==='0')
            document.cookie = "MouseTrail=1;" + ";path=/";
        
        else
        {
            if(getCookie("MouseTrail")==='1')
                document.cookie = "MouseTrail=0;" + ";path=/";
        }
        
    }

    function addBGsound(value){
                    document.cookie = "soundbg1=" + value + ";" + ";path=/";
                }
    function addBGsnow(value){                    
                    document.cookie = "snowflakebg1=" + value + ";" + ";path=/";   
                }
    function addBGspark(value){
        document.cookie = "sparklebg1=" + value + ";" + ";path=/";
    }
    function addBGbubble(value){
        document.cookie = "bubblesbg1=" + value + ";" + ";path=/";
    }
    function addBGfirework(value){
        document.cookie = "fireworkbg1=" + value + ";" + ";path=/";
    }
    function addBGclouds(value){
        document.cookie = "cloudbg1=" + value + ";" + ";path=/";
    }
    function addRainbowAnimation(value){
        document.cookie = "rainbowbg1=" + value + ";" + ";path=/";
    }
    function extrasRemover(){
        addBGsound('none');
        addBGspark('none');
        addBGsnow('none');
        addBGbubble('none');
        addBGfirework('none');
        addBGclouds('none');
        addRainbowAnimation('none');
        document.cookie='randomcolors=0;path=/;';
        document.cookie='dance=0;path=/;';
    }
        
    function getCookie(cname) {
            var name = cname + "=";
            var ca = document.cookie.split(';');
            for(var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }
   $('.blocks').click(function(){
   $('.selected').removeClass('selected'); // removes the previous selected class
   $(this).addClass('selected'); // adds the class to the clicked image
});
// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close12")[0];
var modal = document.getElementById('customize-theme');

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    document.cookie = "backgroundColor=" + getCookie("backgroundColor1") + ";" + ";path=/";  
    document.cookie = "NavbarColor=" + getCookie("NavbarColor1") + ";" + ";path=/";  
    document.cookie = "ButtonColor=" + getCookie("ButtonColor1") + ";" + ";path=/";
    document.cookie = "ButtonHColor=" + getCookie("ButtonHColor1") + ";" + ";path=/";
    document.cookie = "ButtonAColor=" + getCookie("ButtonAColor1") + ";" + ";path=/";  
    document.cookie = "MousePointer=" + getCookie("MousePointer1") + ";" + ";path=/"; 
    document.cookie='activaterain=0;path=/;';
};

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target === modal) {
        document.cookie = "backgroundColor=" + getCookie("backgroundColor1") + ";" + ";path=/";  
        document.cookie = "NavbarColor=" + getCookie("NavbarColor1") + ";" + ";path=/";  
        document.cookie = "ButtonColor=" + getCookie("ButtonColor1") + ";" + ";path=/";
        document.cookie = "ButtonHColor=" + getCookie("ButtonHColor1") + ";" + ";path=/";
        document.cookie = "ButtonAColor=" + getCookie("ButtonAColor1") + ";" + ";path=/"; 
        document.cookie = "MousePointer=" + getCookie("MousePointer1") + ";" + ";path=/"; 
        document.cookie='activaterain=0;path=/;';
    }
};
</script>