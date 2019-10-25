<!-- Notification Modal -->

<style>
    div.content-container
    {
        border:0px;
    }

    .sumTable 
    { 

        <?php if ($mobile): ?>
            background-color: #f9f9f9;

        <?php else: ?>
            background: rgb(255,255,255);
            
        <?php endif; ?>

        width: 93%;
        text-align: left;
        border-collapse: collapse; 
    }

    .sumTable th 
    { 
        background: rgb(100,100,100);
        color: white; 
        padding: 5px;
        border: 1px solid grey; 
    }

    
    .sumTable td
    { 
        <?php if ($mobile): ?>
            font-size: 8px;
            width: 10px;
        <?php endif; ?>

        background: rgb(255,255,255);
        
        padding: 3px;
        border: 2px solid; 
    }

    .sumTable th 
    { 
        width: 5%;
        padding: 3px;
        border: 2px solid black; 
    }

    td.timecol
    {
        background: rgb(242,242,242);
        font-size: 14px;

        <?php if ($mobile): ?>
            font-size: 8px;
            width: 10px;
        <?php endif; ?>
    }

    .nav-pills > li.active > a, .nav-pills > li.active > a:hover, .nav-pills > li.active > a:focus 
    {
        color: white;
        background-color: #228a45;
    }

    .nav > li > a:hover, .nav > li > a:focus 
    {
        text-decoration: none;
        background-color: #ffffff;
        color: #228a45;
    }

</style>

<div id="confirm-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Notification Modal Content-->
        <div class="modal-content">
            <div class="modal-header modal-heading">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center"><strong>Save Changes?</strong></h4>
            </div>
            <div class="modal-body">

                <div id="save-settings" class = "col-md-12 col-xs-12 text-center" style="font-size:18px; margin-top: 10px; margin-bottom: 10px; display:none">
                    Based on the times you selected, you will be allowing your child to use Mukhlat at a very late time!
                    Are you sure?
                </div>


                <div class = "content-container container-fluid col-md-10 col-md-offset-1 col-sm-offset-1 col-sm-10 col-xs-offset-1 col-xs-10">
                    <ul class="nav nav-pills nav-justified" style="">
                        <li class="active"><a data-toggle="pill" href="#timetable-1-summary">AM</a></li>
                        <li class=""><a data-toggle="pill" href="#timetable-2-summary">PM</a></li>
                        <!-- <li class=""><a data-toggle="pill" href="#timetable-3-summary">Morning</a></li>
                        <li class=""><a data-toggle="pill" href="#timetable-4-summary">Afternoon</a></li>
                        <li class=""><a data-toggle="pill" href="#timetable-5-summary">Night</a></li>
                        <li class=""><a data-toggle="pill" href="#timetable-6-summary">Late Night</a></li> -->
                        
                    </ul>
                </div>

                 <!-- The table -->
                 <div id="time-table-summary" class="container-fluid tab-content col-xs-16">

                    <table id="timetable-1-summary" class="sumTable container-fluid tab-pane fade in active">
                        <tr>
                            <th style="background-color: #a83b3b"><center>Time</center></th>
                                <th><center>M<center></th>
                                <th><center><center></th>
                                <th><center>T<center></th>
                                <th><center><center></th>
                                <th><center>W<center></th>
                                <th><center><center></th>
                                <th><center>T<center></th>
                                <th><center><center></th>
                                <th><center>F<center></th>
                                <th><center><center></th>
                                <th><center>S<center></th>
                                <th><center><center></th>
                                <th><center>S<center></th>
                                <th><center><center></th>
                        </tr>

                        <tr>
                            <td id="_sum-cell1" class="timecol"><center>12:00</center></td>
                            <td id="sum-cell1"> </td>
                            <td id="sum-cell8"> </td>
                            <td id="sum-cell2"> </td>
                            <td id="sum-cell9"> </td>
                            <td id="sum-cell3"> </td>
                            <td id="sum-cell10"> </td>
                            <td id="sum-cell4"> </td>
                            <td id="sum-cell11"> </td>
                            <td id="sum-cell5"> </td>
                            <td id="sum-cell12"> </td>
                            <td id="sum-cell6"> </td>
                            <td id="sum-cell13"> </td>
                            <td id="sum-cell7"> </td>
                            <td id="sum-cell14"> </td>
                        </tr>
                        
                        <tr>
                            <td id="_sum-cell15" class="timecol"><center>01:00</center></td>
                            <td id="sum-cell15"> </td>
                            <td id="sum-cell22"> </td>
                            <td id="sum-cell16"> </td>
                            <td id="sum-cell23"> </td>
                            <td id="sum-cell17"> </td>
                            <td id="sum-cell24"> </td>
                            <td id="sum-cell18"> </td>
                            <td id="sum-cell25"> </td>
                            <td id="sum-cell19"> </td>
                            <td id="sum-cell26"> </td>
                            <td id="sum-cell20"> </td>
                            <td id="sum-cell27"> </td>
                            <td id="sum-cell21"> </td>
                            <td id="sum-cell28"> </td>
                        </tr>

                        <tr>
                            <td id="_sum-cell29" class="timecol"><center>02:00</center></td>
                            <td id="sum-cell29"> </td>
                            <td id="sum-cell36"> </td>
                            <td id="sum-cell30"> </td>
                            <td id="sum-cell37"> </td>
                            <td id="sum-cell31"> </td>
                            <td id="sum-cell38"> </td>
                            <td id="sum-cell32"> </td>
                            <td id="sum-cell39"> </td>
                            <td id="sum-cell33"> </td>
                            <td id="sum-cell40"> </td>
                            <td id="sum-cell34"> </td>
                            <td id="sum-cell41"> </td>
                            <td id="sum-cell35"> </td>
                            <td id="sum-cell42"> </td>
                        </tr>

                        
                        <tr>
                            <td class="timecol"><center>03:00</center></td>
                            <td id="sum-cell43"> </td>
                            <td id="sum-cell50"> </td>
                            <td id="sum-cell44"> </td>
                            <td id="sum-cell51"> </td>
                            <td id="sum-cell45"> </td>
                            <td id="sum-cell52"> </td>
                            <td id="sum-cell46"> </td>
                            <td id="sum-cell53"> </td>
                            <td id="sum-cell47"> </td>
                            <td id="sum-cell54"> </td>
                            <td id="sum-cell48"> </td>
                            <td id="sum-cell55"> </td>
                            <td id="sum-cell49"> </td>
                            <td id="sum-cell56"> </td>

                        </tr>

                        <tr>
                            <td class="timecol"><center>04:00</center></td>
                            <td id="sum-cell57"> </td>
                            <td id="sum-cell64"> </td>
                            <td id="sum-cell58"> </td>
                            <td id="sum-cell65"> </td>
                            <td id="sum-cell59"> </td>
                            <td id="sum-cell66"> </td>
                            <td id="sum-cell60"> </td>
                            <td id="sum-cell67"> </td>
                            <td id="sum-cell61"> </td>
                            <td id="sum-cell68"> </td>
                            <td id="sum-cell62"> </td>
                            <td id="sum-cell69"> </td>
                            <td id="sum-cell63"> </td>
                            <td id="sum-cell70"> </td>
                        </tr>

                       
                        <tr>
                            <td class="timecol"><center>05:00</center></td>
                            <td id="sum-cell71"> </td>
                            <td id="sum-cell78"> </td>
                            <td id="sum-cell72"> </td>
                            <td id="sum-cell79"> </td>
                            <td id="sum-cell73"> </td>
                            <td id="sum-cell80"> </td>
                            <td id="sum-cell74"> </td>
                            <td id="sum-cell81"> </td>
                            <td id="sum-cell75"> </td>
                            <td id="sum-cell82"> </td>
                            <td id="sum-cell76"> </td>
                            <td id="sum-cell83"> </td>
                            <td id="sum-cell77"> </td>                            
                            <td id="sum-cell84"> </td>
                        </tr>

                        <tr>
                            <td class="timecol"><center>06:00</center></td>
                            <td id="sum-cell85"> </td>
                            <td id="sum-cell92"> </td>
                            <td id="sum-cell86"> </td>
                            <td id="sum-cell93"> </td>
                            <td id="sum-cell87"> </td>
                            <td id="sum-cell94"> </td>
                            <td id="sum-cell88"> </td>
                            <td id="sum-cell95"> </td>
                            <td id="sum-cell89"> </td>
                            <td id="sum-cell96"> </td>
                            <td id="sum-cell90"> </td>
                            <td id="sum-cell97"> </td>
                            <td id="sum-cell91"> </td>
                            
                            <td id="sum-cell98"> </td>
                        </tr>

                        <tr>
                            <td id="_sum-cell99"  class="timecol"><center>07:00</center></td>
                            <td id="sum-cell99"> </td>
                            <td id="sum-cell106"> </td>
                            <td id="sum-cell100"> </td>
                            <td id="sum-cell107"> </td>
                            <td id="sum-cell101"> </td>
                            <td id="sum-cell108"> </td>
                            <td id="sum-cell102"> </td>
                            <td id="sum-cell109"> </td>
                            <td id="sum-cell103"> </td>
                            <td id="sum-cell110"> </td>
                            <td id="sum-cell104"> </td>
                            <td id="sum-cell111"> </td>
                            <td id="sum-cell105"> </td>
                            <td id="sum-cell112"> </td>
                        </tr>                        

                        
                        <tr>
                            <td class="timecol"><center>08:00</center></td>
                            <td id="sum-cell113"> </td>
                            <td id="sum-cell120"> </td>
                            <td id="sum-cell114"> </td>
                            <td id="sum-cell121"> </td>
                            <td id="sum-cell115"> </td>
                            <td id="sum-cell122"> </td>
                            <td id="sum-cell116"> </td>
                            <td id="sum-cell123"> </td>
                            <td id="sum-cell117"> </td>
                            <td id="sum-cell124"> </td>
                            <td id="sum-cell118"> </td>
                            <td id="sum-cell125"> </td>
                            <td id="sum-cell119"> </td>
                            <td id="sum-cell126"> </td>
                        </tr>

                        <tr>
                            <td class="timecol"><center>09:00</center></td>
                            <td id="sum-cell127"> </td>
                            <td id="sum-cell134"> </td>
                            <td id="sum-cell128"> </td>
                            <td id="sum-cell135"> </td>
                            <td id="sum-cell129"> </td>
                            <td id="sum-cell136"> </td>
                            <td id="sum-cell130"> </td>
                            <td id="sum-cell137"> </td>
                            <td id="sum-cell131"> </td>
                            <td id="sum-cell138"> </td>
                            <td id="sum-cell132"> </td>
                            <td id="sum-cell139"> </td>
                            <td id="sum-cell133"> </td>
                            <td id="sum-cell140"> </td>
                        </tr>

                        <tr>
                            <td class="timecol"><center>10:00</center></td>
                            <td id="sum-cell141"> </td>
                            <td id="sum-cell148"> </td>
                            <td id="sum-cell142"> </td>
                            <td id="sum-cell149"> </td>
                            <td id="sum-cell143"> </td>
                            <td id="sum-cell150"> </td>
                            <td id="sum-cell144"> </td>
                            <td id="sum-cell151"> </td>
                            <td id="sum-cell145"> </td>
                            <td id="sum-cell152"> </td>
                            <td id="sum-cell146"> </td>
                            <td id="sum-cell153"> </td>
                            <td id="sum-cell147"> </td>
                            <td id="sum-cell154"> </td>
                        </tr>

                        <tr>
                            <td class="timecol"><center>11:00</center></td>
                            <td id="sum-cell155"> </td>
                            <td id="sum-cell162"> </td>
                            <td id="sum-cell156"> </td>
                            <td id="sum-cell163"> </td>
                            <td id="sum-cell157"> </td>
                            <td id="sum-cell164"> </td>
                            <td id="sum-cell158"> </td>
                            <td id="sum-cell165"> </td>
                            <td id="sum-cell159"> </td>
                            <td id="sum-cell166"> </td>
                            <td id="sum-cell160"> </td>
                            <td id="sum-cell167"> </td>
                            <td id="sum-cell161"> </td>
                            <td id="sum-cell168"> </td>
                        </tr>
                    </table>

                    <table id="timetable-2-summary" class="sumTable container-fluid tab-pane fade">
                        <tr>
                            <th style="background-color: #a83b3b"><center>Time</center></th>
                                <th><center>M<center></th>
                                <th><center><center></th>
                                <th><center>T<center></th>
                                <th><center><center></th>
                                <th><center>W<center></th>
                                <th><center><center></th>
                                <th><center>T<center></th>
                                <th><center><center></th>
                                <th><center>F<center></th>
                                <th><center><center></th>
                                <th><center>S<center></th>
                                <th><center><center></th>
                                <th><center>S<center></th>
                                <th><center><center></th>
                        </tr>
                        <tr>
                            <td class="timecol"><center>12:00</center></td>
                            <td id="sum-cell169"> </td>
                            <td id="sum-cell176"> </td>
                            <td id="sum-cell170"> </td>
                            <td id="sum-cell177"> </td>
                            <td id="sum-cell171"> </td>
                            <td id="sum-cell178"> </td>
                            <td id="sum-cell172"> </td>
                            <td id="sum-cell179"> </td>
                            <td id="sum-cell173"> </td>
                            <td id="sum-cell180"> </td>
                            <td id="sum-cell174"> </td>
                            <td id="sum-cell181"> </td>
                            <td id="sum-cell175"> </td>
                            <td id="sum-cell182"> </td>
                        </tr>

                        <tr>
                            <td class="timecol"><center>01:00</center></td>
                            <td id="sum-cell183"> </td>
                            <td id="sum-cell190"> </td>
                            <td id="sum-cell184"> </td>
                            <td id="sum-cell191"> </td>
                            <td id="sum-cell185"> </td>
                            <td id="sum-cell192"> </td>
                            <td id="sum-cell186"> </td>
                            <td id="sum-cell193"> </td>
                            <td id="sum-cell187"> </td>
                            <td id="sum-cell194"> </td>
                            <td id="sum-cell188"> </td>
                            <td id="sum-cell195"> </td>
                            <td id="sum-cell189"> </td>
                            
                            <td id="sum-cell196"> </td>
                        </tr>
                        
                        <tr>
                            <td class="timecol"><center>02:00</center></td>
                            <td id="sum-cell197"> </td>
                            <td id="sum-cell204"> </td>
                            <td id="sum-cell198"> </td>
                            <td id="sum-cell205"> </td>
                            <td id="sum-cell199"> </td>
                            <td id="sum-cell206"> </td>
                            <td id="sum-cell200"> </td>
                            <td id="sum-cell207"> </td>
                            <td id="sum-cell201"> </td>
                            <td id="sum-cell208"> </td>
                            <td id="sum-cell202"> </td>
                            <td id="sum-cell209"> </td>
                            <td id="sum-cell203"> </td>
                            
                            <td id="sum-cell210"> </td>
                        </tr>

                        <tr>
                            <td class="timecol"><center>03:00</center></td>
                            <td id="sum-cell211"> </td>
                            <td id="sum-cell218"> </td>
                            <td id="sum-cell212"> </td>
                            <td id="sum-cell219"> </td>
                            <td id="sum-cell213"> </td>
                            <td id="sum-cell220"> </td>
                            <td id="sum-cell214"> </td>
                            <td id="sum-cell221"> </td>
                            <td id="sum-cell215"> </td>
                            <td id="sum-cell222"> </td>
                            <td id="sum-cell216"> </td>
                            <td id="sum-cell223"> </td>
                            <td id="sum-cell217"> </td>
                            <td id="sum-cell224"> </td>
                        </tr>

                        <tr>
                            <td class="timecol"><center>04:00</center></td>
                            <td id="sum-cell225"> </td>
                            <td id="sum-cell232"> </td>
                            <td id="sum-cell226"> </td>
                            <td id="sum-cell233"> </td>
                            <td id="sum-cell227"> </td>
                            <td id="sum-cell234"> </td>
                            <td id="sum-cell228"> </td>
                            <td id="sum-cell235"> </td>
                            <td id="sum-cell229"> </td>
                            <td id="sum-cell236"> </td>
                            <td id="sum-cell230"> </td>
                            <td id="sum-cell237"> </td>
                            <td id="sum-cell231"> </td>
                            <td id="sum-cell238"> </td>
                        </tr>

                        <tr>
                            <td class="timecol"><center>05:00</center></td>
                            <td id="sum-cell239"> </td>
                            <td id="sum-cell246"> </td>
                            <td id="sum-cell240"> </td>
                            <td id="sum-cell247"> </td>
                            <td id="sum-cell241"> </td>
                            <td id="sum-cell248"> </td>
                            <td id="sum-cell242"> </td>
                            <td id="sum-cell249"> </td>
                            <td id="sum-cell243"> </td>
                            <td id="sum-cell250"> </td>
                            <td id="sum-cell244"> </td>
                            <td id="sum-cell251"> </td>
                            <td id="sum-cell245"> </td>
                            <td id="sum-cell252"> </td>
                        </tr>

                        <tr>
                            <td class="timecol"><center>06:00</center></td>
                            <td id="sum-cell253"> </td>
                            <td id="sum-cell260"> </td>
                            <td id="sum-cell254"> </td>
                            <td id="sum-cell261"> </td>
                            <td id="sum-cell255"> </td>
                            <td id="sum-cell262"> </td>
                            <td id="sum-cell256"> </td>
                            <td id="sum-cell263"> </td>
                            <td id="sum-cell257"> </td>
                            <td id="sum-cell264"> </td>
                            <td id="sum-cell258"> </td>
                            <td id="sum-cell265"> </td>
                            <td id="sum-cell259"> </td>
                            <td id="sum-cell266"> </td>
                        </tr>

                        <tr>
                            <td class="timecol"><center>07:00</center></td>
                            <td id="sum-cell267"> </td>
                            <td id="sum-cell274"> </td>
                            <td id="sum-cell268"> </td>
                            <td id="sum-cell275"> </td>
                            <td id="sum-cell269"> </td>
                            <td id="sum-cell276"> </td>
                            <td id="sum-cell270"> </td>
                            <td id="sum-cell277"> </td>
                            <td id="sum-cell271"> </td>
                            <td id="sum-cell278"> </td>
                            <td id="sum-cell272"> </td>
                            <td id="sum-cell279"> </td>
                            <td id="sum-cell273"> </td>
                            <td id="sum-cell280"> </td>
                        </tr>

                        <tr>
                            <td class="timecol"><center>08:00</center></td>
                            <td id="sum-cell281"> </td>
                            <td id="sum-cell288"> </td>
                            <td id="sum-cell282"> </td>
                            <td id="sum-cell289"> </td>
                            <td id="sum-cell283"> </td>
                            <td id="sum-cell290"> </td>
                            <td id="sum-cell284"> </td>
                            <td id="sum-cell291"> </td>
                            <td id="sum-cell285"> </td>
                            <td id="sum-cell292"> </td>
                            <td id="sum-cell286"> </td>
                            <td id="sum-cell293"> </td>
                            <td id="sum-cell287"> </td>
                            <td id="sum-cell294"> </td>
                        </tr>

                        <tr>
                            <td class="timecol"><center>09:00</center></td>
                            <td id="sum-cell295"> </td>
                            <td id="sum-cell302"> </td>
                            <td id="sum-cell296"> </td>
                            <td id="sum-cell303"> </td>
                            <td id="sum-cell297"> </td>
                            <td id="sum-cell304"> </td>
                            <td id="sum-cell298"> </td>
                            <td id="sum-cell305"> </td>
                            <td id="sum-cell299"> </td>
                            <td id="sum-cell306"> </td>
                            <td id="sum-cell300"> </td>
                            <td id="sum-cell307"> </td>
                            <td id="sum-cell301"> </td>
                            <td id="sum-cell308"> </td>
                        </tr>

                      
                        <tr>
                            <td class="timecol"><center>10:00</center></td>
                            <td id="sum-cell309"> </td>
                            <td id="sum-cell316"> </td>
                            <td id="sum-cell310"> </td>
                            <td id="sum-cell317"> </td>
                            <td id="sum-cell311"> </td>
                            <td id="sum-cell318"> </td>
                            <td id="sum-cell312"> </td>
                            <td id="sum-cell319"> </td>
                            <td id="sum-cell313"> </td>
                            <td id="sum-cell320"> </td>
                            <td id="sum-cell314"> </td>
                            <td id="sum-cell321"> </td>
                            <td id="sum-cell315"> </td>
                            <td id="sum-cell322"> </td>
                        </tr>

                        

                        <tr>
                            <td class="timecol"><center>11:00</center></td>
                            <td id="sum-cell323"> </td>
                            <td id="sum-cell330"> </td>
                            <td id="sum-cell324"> </td>
                            <td id="sum-cell331"> </td>
                            <td id="sum-cell325"> </td>
                            <td id="sum-cell332"> </td>
                            <td id="sum-cell326"> </td>
                            <td id="sum-cell333"> </td>
                            <td id="sum-cell327"> </td>
                            <td id="sum-cell334"> </td>
                            <td id="sum-cell328"> </td>
                            <td id="sum-cell335"> </td>
                            <td id="sum-cell329"> </td>
                            <td id="sum-cell336"> </td>
                        </tr>
                    </table>

                    <table id="timetable-3-summary" class="sumTable container-fluid tab-pane fade">
                        <tr>
                            <th style="background-color: #a83b3b"><center>Time</center></th>
                                <th><center>Mon<center></th>
                                <th><center>Tue<center></th>
                                <th><center>Wed<center></th>
                                <th><center>Thu<center></th>
                                <th><center>Fri<center></th>
                                <th><center>Sat<center></th>
                                <th><center>Sun<center></th>
                        </tr>
                    </table>

                    <table id="timetable-4-summary" class="sumTable container-fluid tab-pane fade">
                        
                        <tr>
                            <th style="background-color: #a83b3b"><center>Time</center></th>
                                <th><center>Mon<center></th>
                                <th><center>Tue<center></th>
                                <th><center>Wed<center></th>
                                <th><center>Thu<center></th>
                                <th><center>Fri<center></th>
                                <th><center>Sat<center></th>
                                <th><center>Sun<center></th>
                        </tr>

                    </table>

                    <table id="timetable-5-summary" class="sumTable container-fluid tab-pane fade">
                        
                        <tr>
                            <th style="background-color: #a83b3b"><center>Time</center></th>
                                <th><center>Mon<center></th>
                                <th><center>Tue<center></th>
                                <th><center>Wed<center></th>
                                <th><center>Thu<center></th>
                                <th><center>Fri<center></th>
                                <th><center>Sat<center></th>
                                <th><center>Sun<center></th>
                        </tr>

                        
                    </table>

                    <table id="timetable-6-summary" class="sumTable container-fluid tab-pane fade">

                        <tr>
                            <th style="background-color: #a83b3b"><center>Time</center></th>
                                <th><center>Mon<center></th>
                                <th><center>Tue<center></th>
                                <th><center>Wed<center></th>
                                <th><center>Thu<center></th>
                                <th><center>Fri<center></th>
                                <th><center>Sat<center></th>
                                <th><center>Sun<center></th>
                        </tr>

                        
                    </table>


                </div>

                <div class = "row">
                    <div class = "col-md-12">
                        <ul class="nav nav-pills nav-justified" style = "margin-bottom: 10px;">
   
                            <li class = "active text-center"><button data-dismiss="modal" class = "btn btn-success" style="width:50%; font-size:24px; margin-top: 10px; margin-bottom: 10px; background-color: grey">Cancel</button></li>

                            <li class = "active text-center"><button onclick="changeTimeSettings('time-table', 'td', 'cell');" class = "btn btn-success" style="width:50%; font-size:24px; margin-top: 10px; margin-bottom: 10px">Yes</button></li>
                        </ul>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    var i, late, items = [];
    var cell = document.getElementById("time-table").getElementsByTagName("td");
    
    for (var i = 0; i < cell.length; i++) 
    {
        if(cell[i].id.includes("-A"))
        {
            items.push(cell[i].id);
            // alert(sum-cell[i].id);

            if(parseInt(cell[i].id.replace("cell","").replace("-A","")) < 64 ||  parseInt(cell[i].id.replace("cell","").replace("-A","")) > 281)
            {
                late=1;
                // alert("yo u late");
            }
        }
    }

    string = items.join(" ");

    var j;
    var readarray = string.split(" ");
    var currentID;
    
    if(string!=null && string!="" && string!=" ")
    {
        for(j=0; j<readarray.length; j++)
        {
            // alert(readarray[j]);

            currentID = "sum-" + readarray[j].replace("-A","");
            // alert(currentID);

            document.getElementById(currentID).style.background = "rgb(50, 200, 100)";
        }
    }

    function updateSummary()
    {
        var i, temp; 
                    
        for(i=1; i<337; i++)
        {
            temp = "sum-cell" + i;

            if(document.getElementById(temp))
            {
                document.getElementById(temp).style.background = "rgb(255, 255, 255)";
                document.getElementById(temp).id = temp.replace("-A","");
            }

        }  

        var  items2 = [];
        var cell = document.getElementById("time-table").getElementsByTagName("td");

        for (var i = 0; i < cell.length; i++) 
        {
            if(cell[i].id.includes("-A"))
            {
                items2.push(cell[i].id);
                // alert(cell[i].id);

                if(parseInt(cell[i].id.replace("cell","").replace("-A","")) < 64 ||  parseInt(cell[i].id.replace("cell","").replace("-A","")) > 281)
                {
                    late=1;
                    // alert("yo u late");
                }
            }
        }

        string = items2.join(" ");
        readarray = string.split(" ");
        
        if(string!=null && string!="" && string!=" ")
        {
            for(j=0; j<readarray.length; j++)
            {
                // alert(readarray[j]);

                currentID = "sum-" + readarray[j].replace("-A","");
                // alert(currentID);

                document.getElementById(currentID).style.background = "rgb(50, 200, 100)";
            }
        }
    }


</script>