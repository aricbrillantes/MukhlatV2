<?php
    include(APPPATH . 'views/header.php');

    // header("Refresh: 60");

    $CI =&get_instance();
    $CI->load->model('attachment_model');

    if(isset($_SESSION['logged_user']))
    {
        $logged_user = $_SESSION['logged_user'];
        if($logged_user->role_id != 2 || $logged_user == null)
        {
            $homeURL = base_url('home');
            header("Location: $homeURL");
        }

        $CI =&get_instance();
        $CI->load->model('user_model');
        $usertimes = $CI->user_model->get_usertimes($logged_user->user_id);
        // print_r($usertimes->row()->time_setting);

        $restrictions1 = explode(" ",$usertimes->row()->time_setting);
        $restrictions2 = [];
        // print_r($restrictions);

        for($i=0; $i<count($restrictions1); $i++)
        {
            // print($restrictions[$i]."\n");

            switch($restrictions1[$i])
            {
                case "cell1-A":array_push($restrictions2,"0000 Monday");break;
                case "cell2-A":array_push($restrictions2,"0000 Tuesday");break;
                case "cell3-A":array_push($restrictions2,"0000 Wednesday");break;
                case "cell4-A":array_push($restrictions2,"0000 Thursday");break;
                case "cell5-A":array_push($restrictions2,"0000 Friday");break;
                case "cell6-A":array_push($restrictions2,"0000 Saturday");break;
                case "cell7-A":array_push($restrictions2,"0000 Sunday");break;

                case "cell8-A":array_push($restrictions2,"0030 Monday");break;
                case "cell9-A":array_push($restrictions2,"0030 Tuesday");break;
                case "cell10-A":array_push($restrictions2,"0030 Wednesday");break;
                case "cell11-A":array_push($restrictions2,"0030 Thursday");break;
                case "cell12-A":array_push($restrictions2,"0030 Friday");break;
                case "cell13-A":array_push($restrictions2,"0030 Saturday");break;
                case "cell14-A":array_push($restrictions2,"0030 Sunday");break;

                case "cell15-A":array_push($restrictions2,"0100 Monday");break;
                case "cell16-A":array_push($restrictions2,"0100 Tuesday");break;
                case "cell17-A":array_push($restrictions2,"0100 Wednesday");break;
                case "cell18-A":array_push($restrictions2,"0100 Thursday");break;
                case "cell19-A":array_push($restrictions2,"0100 Friday");break;
                case "cell20-A":array_push($restrictions2,"0100 Saturday");break;
                case "cell21-A":array_push($restrictions2,"0100 Sunday");break;

                case "cell22-A":array_push($restrictions2,"0130 Monday");break;
                case "cell23-A":array_push($restrictions2,"0130 Tuesday");break;
                case "cell24-A":array_push($restrictions2,"0130 Wednesday");break;
                case "cell25-A":array_push($restrictions2,"0130 Thursday");break;
                case "cell26-A":array_push($restrictions2,"0130 Friday");break;
                case "cell27-A":array_push($restrictions2,"0130 Saturday");break;
                case "cell28-A":array_push($restrictions2,"0130 Sunday");break;

                case "cell29-A":array_push($restrictions2,"0200 Monday");break;
                case "cell30-A":array_push($restrictions2,"0200 Tuesday");break;
                case "cell31-A":array_push($restrictions2,"0200 Wednesday");break;
                case "cell32-A":array_push($restrictions2,"0200 Thursday");break;
                case "cell33-A":array_push($restrictions2,"0200 Friday");break;
                case "cell34-A":array_push($restrictions2,"0200 Saturday");break;
                case "cell35-A":array_push($restrictions2,"0200 Sunday");break;

                case "cell36-A":array_push($restrictions2,"0230 Monday");break;
                case "cell37-A":array_push($restrictions2,"0230 Tuesday");break;
                case "cell38-A":array_push($restrictions2,"0230 Wednesday");break;
                case "cell39-A":array_push($restrictions2,"0230 Thursday");break;
                case "cell40-A":array_push($restrictions2,"0230 Friday");break;
                case "cell41-A":array_push($restrictions2,"0230 Saturday");break;
                case "cell42-A":array_push($restrictions2,"0230 Sunday");break;

                case "cell43-A":array_push($restrictions2,"0300 Monday");break;
                case "cell44-A":array_push($restrictions2,"0300 Tuesday");break;
                case "cell45-A":array_push($restrictions2,"0300 Wednesday");break;
                case "cell46-A":array_push($restrictions2,"0300 Thursday");break;
                case "cell47-A":array_push($restrictions2,"0300 Friday");break;
                case "cell48-A":array_push($restrictions2,"0300 Saturday");break;
                case "cell49-A":array_push($restrictions2,"0300 Sunday");break;

                case "cell50-A":array_push($restrictions2,"0330 Monday");break;
                case "cell51-A":array_push($restrictions2,"0330 Tuesday");break;
                case "cell52-A":array_push($restrictions2,"0330 Wednesday");break;
                case "cell53-A":array_push($restrictions2,"0330 Thursday");break;
                case "cell54-A":array_push($restrictions2,"0330 Friday");break;
                case "cell55-A":array_push($restrictions2,"0330 Saturday");break;
                case "cell56-A":array_push($restrictions2,"0330 Sunday");break;

                case "cell57-A":array_push($restrictions2,"0400 Monday");break;
                case "cell58-A":array_push($restrictions2,"0400 Tuesday");break;
                case "cell59-A":array_push($restrictions2,"0400 Wednesday");break;
                case "cell60-A":array_push($restrictions2,"0400 Thursday");break;
                case "cell62-A":array_push($restrictions2,"0400 Friday");break;
                case "cell62-A":array_push($restrictions2,"0400 Saturday");break;
                case "cell63-A":array_push($restrictions2,"0400 Sunday");break;

                case "cell64-A":array_push($restrictions2,"0430 Monday");break;
                case "cell65-A":array_push($restrictions2,"0430 Tuesday");break;
                case "cell66-A":array_push($restrictions2,"0430 Wednesday");break;
                case "cell67-A":array_push($restrictions2,"0430 Thursday");break;
                case "cell68-A":array_push($restrictions2,"0430 Friday");break;
                case "cell69-A":array_push($restrictions2,"0430 Saturday");break;
                case "cell70-A":array_push($restrictions2,"0430 Sunday");break;

                case "cell71-A":array_push($restrictions2,"0500 Monday");break;
                case "cell72-A":array_push($restrictions2,"0500 Tuesday");break;
                case "cell73-A":array_push($restrictions2,"0500 Wednesday");break;
                case "cell74-A":array_push($restrictions2,"0500 Thursday");break;
                case "cell75-A":array_push($restrictions2,"0500 Friday");break;
                case "cell76-A":array_push($restrictions2,"0500 Saturday");break;
                case "cell77-A":array_push($restrictions2,"0500 Sunday");break;

                case "cell78-A":array_push($restrictions2,"0530 Monday");break;
                case "cell79-A":array_push($restrictions2,"0530 Tuesday");break;
                case "cell80-A":array_push($restrictions2,"0530 Wednesday");break;
                case "cell81-A":array_push($restrictions2,"0530 Thursday");break;
                case "cell82-A":array_push($restrictions2,"0530 Friday");break;
                case "cell83-A":array_push($restrictions2,"0530 Saturday");break;
                case "cell84-A":array_push($restrictions2,"0530 Sunday");break;

                case "cell85-A":array_push($restrictions2,"0600 Monday");break;
                case "cell86-A":array_push($restrictions2,"0600 Tuesday");break;
                case "cell87-A":array_push($restrictions2,"0600 Wednesday");break;
                case "cell88-A":array_push($restrictions2,"0600 Thursday");break;
                case "cell89-A":array_push($restrictions2,"0600 Friday");break;
                case "cell90-A":array_push($restrictions2,"0600 Saturday");break;
                case "cell91-A":array_push($restrictions2,"0600 Sunday");break;

                case "cell92-A":array_push($restrictions2,"0630 Monday");break;
                case "cell93-A":array_push($restrictions2,"0630 Tuesday");break;
                case "cell94-A":array_push($restrictions2,"0630 Wednesday");break;
                case "cell95-A":array_push($restrictions2,"0630 Thursday");break;
                case "cell96-A":array_push($restrictions2,"0630 Friday");break;
                case "cell97-A":array_push($restrictions2,"0630 Saturday");break;
                case "cell98-A":array_push($restrictions2,"0630 Sunday");break;

                case "cell99-A":array_push($restrictions2,"0700 Monday");break;
                case "cell100-A":array_push($restrictions2,"0700 Tuesday");break;
                case "cell101-A":array_push($restrictions2,"0700 Wednesday");break;
                case "cell102-A":array_push($restrictions2,"0700 Thursday");break;
                case "cell103-A":array_push($restrictions2,"0700 Friday");break;
                case "cell104-A":array_push($restrictions2,"0700 Saturday");break;
                case "cell105-A":array_push($restrictions2,"0700 Sunday");break;

                case "cell106-A":array_push($restrictions2,"0730 Monday");break;
                case "cell107-A":array_push($restrictions2,"0730 Tuesday");break;
                case "cell108-A":array_push($restrictions2,"0730 Wednesday");break;
                case "cell109-A":array_push($restrictions2,"0730 Thursday");break;
                case "cell110-A":array_push($restrictions2,"0730 Friday");break;
                case "cell111-A":array_push($restrictions2,"0730 Saturday");break;
                case "cell112-A":array_push($restrictions2,"0730 Sunday");break;

                case "cell113-A":array_push($restrictions2,"0800 Monday");break;
                case "cell114-A":array_push($restrictions2,"0800 Tuesday");break;
                case "cell115-A":array_push($restrictions2,"0800 Wednesday");break;
                case "cell116-A":array_push($restrictions2,"0800 Thursday");break;
                case "cell117-A":array_push($restrictions2,"0800 Friday");break;
                case "cell118-A":array_push($restrictions2,"0800 Saturday");break;
                case "cell119-A":array_push($restrictions2,"0800 Sunday");break;

                case "cell120-A":array_push($restrictions2,"0830 Monday");break;
                case "cell121-A":array_push($restrictions2,"0830 Tuesday");break;
                case "cell122-A":array_push($restrictions2,"0830 Wednesday");break;
                case "cell123-A":array_push($restrictions2,"0830 Thursday");break;
                case "cell124-A":array_push($restrictions2,"0830 Friday");break;
                case "cell125-A":array_push($restrictions2,"0830 Saturday");break;
                case "cell126-A":array_push($restrictions2,"0830 Sunday");break;

                case "cell127-A":array_push($restrictions2,"0900 Monday");break;
                case "cell128-A":array_push($restrictions2,"0900 Tuesday");break;
                case "cell129-A":array_push($restrictions2,"0900 Wednesday");break;
                case "cell130-A":array_push($restrictions2,"0900 Thursday");break;
                case "cell131-A":array_push($restrictions2,"0900 Friday");break;
                case "cell132-A":array_push($restrictions2,"0900 Saturday");break;
                case "cell133-A":array_push($restrictions2,"0900 Sunday");break;

                case "cell134-A":array_push($restrictions2,"0930 Monday");break;
                case "cell135-A":array_push($restrictions2,"0930 Tuesday");break;
                case "cell136-A":array_push($restrictions2,"0930 Wednesday");break;
                case "cell137-A":array_push($restrictions2,"0930 Thursday");break;
                case "cell138-A":array_push($restrictions2,"0930 Friday");break;
                case "cell139-A":array_push($restrictions2,"0930 Saturday");break;
                case "cell140-A":array_push($restrictions2,"0930 Sunday");break;

                case "cell141-A":array_push($restrictions2,"1000 Monday");break;
                case "cell142-A":array_push($restrictions2,"1000 Tuesday");break;
                case "cell143-A":array_push($restrictions2,"1000 Wednesday");break;
                case "cell144-A":array_push($restrictions2,"1000 Thursday");break;
                case "cell145-A":array_push($restrictions2,"1000 Friday");break;
                case "cell146-A":array_push($restrictions2,"1000 Saturday");break;
                case "cell147-A":array_push($restrictions2,"1000 Sunday");break;

                case "cell148-A":array_push($restrictions2,"1030 Monday");break;
                case "cell149-A":array_push($restrictions2,"1030 Tuesday");break;
                case "cell150-A":array_push($restrictions2,"1030 Wednesday");break;
                case "cell151-A":array_push($restrictions2,"1030 Thursday");break;
                case "cell152-A":array_push($restrictions2,"1030 Friday");break;
                case "cell153-A":array_push($restrictions2,"1030 Saturday");break;
                case "cell154-A":array_push($restrictions2,"1030 Sunday");break;

                case "cell155-A":array_push($restrictions2,"1100 Monday");break;
                case "cell156-A":array_push($restrictions2,"1100 Tuesday");break;
                case "cell157-A":array_push($restrictions2,"1100 Wednesday");break;
                case "cell158-A":array_push($restrictions2,"1100 Thursday");break;
                case "cell159-A":array_push($restrictions2,"1100 Friday");break;
                case "cell160-A":array_push($restrictions2,"1100 Saturday");break;
                case "cell161-A":array_push($restrictions2,"1100 Sunday");break;

                case "cell162-A":array_push($restrictions2,"1130 Monday");break;
                case "cell163-A":array_push($restrictions2,"1130 Tuesday");break;
                case "cell164-A":array_push($restrictions2,"1130 Wednesday");break;
                case "cell165-A":array_push($restrictions2,"1130 Thursday");break;
                case "cell166-A":array_push($restrictions2,"1130 Friday");break;
                case "cell167-A":array_push($restrictions2,"1130 Saturday");break;
                case "cell168-A":array_push($restrictions2,"1130 Sunday");break;

                case "cell169-A":array_push($restrictions2,"1200 Monday");break;
                case "cell170-A":array_push($restrictions2,"1200 Tuesday");break;
                case "cell171-A":array_push($restrictions2,"1200 Wednesday");break;
                case "cell172-A":array_push($restrictions2,"1200 Thursday");break;
                case "cell173-A":array_push($restrictions2,"1200 Friday");break;
                case "cell174-A":array_push($restrictions2,"1200 Saturday");break;
                case "cell175-A":array_push($restrictions2,"1200 Sunday");break;

                case "cell176-A":array_push($restrictions2,"1230 Monday");break;
                case "cell177-A":array_push($restrictions2,"1230 Tuesday");break;
                case "cell178-A":array_push($restrictions2,"1230 Wednesday");break;
                case "cell179-A":array_push($restrictions2,"1230 Thursday");break;
                case "cell180-A":array_push($restrictions2,"1230 Friday");break;
                case "cell181-A":array_push($restrictions2,"1230 Saturday");break;
                case "cell182-A":array_push($restrictions2,"1230 Sunday");break;

                case "cell183-A":array_push($restrictions2,"1300 Monday");break;
                case "cell184-A":array_push($restrictions2,"1300 Tuesday");break;
                case "cell185-A":array_push($restrictions2,"1300 Wednesday");break;
                case "cell186-A":array_push($restrictions2,"1300 Thursday");break;
                case "cell187-A":array_push($restrictions2,"1300 Friday");break;
                case "cell188-A":array_push($restrictions2,"1300 Saturday");break;
                case "cell189-A":array_push($restrictions2,"1300 Sunday");break;

                case "cell190-A":array_push($restrictions2,"1330 Monday");break;
                case "cell191-A":array_push($restrictions2,"1330 Tuesday");break;
                case "cell192-A":array_push($restrictions2,"1330 Wednesday");break;
                case "cell193-A":array_push($restrictions2,"1330 Thursday");break;
                case "cell194-A":array_push($restrictions2,"1330 Friday");break;
                case "cell195-A":array_push($restrictions2,"1330 Saturday");break;
                case "cell196-A":array_push($restrictions2,"1330 Sunday");break;

                case "cell197-A":array_push($restrictions2,"1400 Monday");break;
                case "cell198-A":array_push($restrictions2,"1400 Tuesday");break;
                case "cell199-A":array_push($restrictions2,"1400 Wednesday");break;
                case "cell200-A":array_push($restrictions2,"1400 Thursday");break;
                case "cell201-A":array_push($restrictions2,"1400 Friday");break;
                case "cell202-A":array_push($restrictions2,"1400 Saturday");break;
                case "cell203-A":array_push($restrictions2,"1400 Sunday");break;
            
                case "cell204-A":array_push($restrictions2,"1430 Monday");break;
                case "cell205-A":array_push($restrictions2,"1430 Tuesday");break;
                case "cell206-A":array_push($restrictions2,"1430 Wednesday");break;
                case "cell207-A":array_push($restrictions2,"1430 Thursday");break;
                case "cell208-A":array_push($restrictions2,"1430 Friday");break;
                case "cell209-A":array_push($restrictions2,"1430 Saturday");break;
                case "cell210-A":array_push($restrictions2,"1430 Sunday");break;

                case "cell211-A":array_push($restrictions2,"1500 Monday");break;
                case "cell212-A":array_push($restrictions2,"1500 Tuesday");break;
                case "cell213-A":array_push($restrictions2,"1500 Wednesday");break;
                case "cell214-A":array_push($restrictions2,"1500 Thursday");break;
                case "cell215-A":array_push($restrictions2,"1500 Friday");break;
                case "cell216-A":array_push($restrictions2,"1500 Saturday");break;
                case "cell217-A":array_push($restrictions2,"1500 Sunday");break;

                case "cell218-A":array_push($restrictions2,"1530 Monday");break;
                case "cell219-A":array_push($restrictions2,"1530 Tuesday");break;
                case "cell220-A":array_push($restrictions2,"1530 Wednesday");break;
                case "cell221-A":array_push($restrictions2,"1530 Thursday");break;
                case "cell222-A":array_push($restrictions2,"1530 Friday");break;
                case "cell223-A":array_push($restrictions2,"1530 Saturday");break;
                case "cell224-A":array_push($restrictions2,"1530 Sunday");break;

                case "cell225-A":array_push($restrictions2,"1600 Monday");break;
                case "cell226-A":array_push($restrictions2,"1600 Tuesday");break;
                case "cell227-A":array_push($restrictions2,"1600 Wednesday");break;
                case "cell228-A":array_push($restrictions2,"1600 Thursday");break;
                case "cell229-A":array_push($restrictions2,"1600 Friday");break;
                case "cell230-A":array_push($restrictions2,"1600 Saturday");break;
                case "cell231-A":array_push($restrictions2,"1600 Sunday");break;

                case "cell232-A":array_push($restrictions2,"1630 Monday");break;
                case "cell233-A":array_push($restrictions2,"1630 Tuesday");break;
                case "cell234-A":array_push($restrictions2,"1630 Wednesday");break;
                case "cell235-A":array_push($restrictions2,"1630 Thursday");break;
                case "cell236-A":array_push($restrictions2,"1630 Friday");break;
                case "cell237-A":array_push($restrictions2,"1630 Saturday");break;
                case "cell238-A":array_push($restrictions2,"1630 Sunday");break;

                case "cell239-A":array_push($restrictions2,"1700 Monday");break;
                case "cell240-A":array_push($restrictions2,"1700 Tuesday");break;
                case "cell241-A":array_push($restrictions2,"1700 Wednesday");break;
                case "cell242-A":array_push($restrictions2,"1700 Thursday");break;
                case "cell243-A":array_push($restrictions2,"1700 Friday");break;
                case "cell244-A":array_push($restrictions2,"1700 Saturday");break;
                case "cell245-A":array_push($restrictions2,"1700 Sunday");break;

                case "cell246-A":array_push($restrictions2,"1730 Monday");break;
                case "cell247-A":array_push($restrictions2,"1730 Tuesday");break;
                case "cell248-A":array_push($restrictions2,"1730 Wednesday");break;
                case "cell249-A":array_push($restrictions2,"1730 Thursday");break;
                case "cell250-A":array_push($restrictions2,"1730 Friday");break;
                case "cell251-A":array_push($restrictions2,"1730 Saturday");break;
                case "cell252-A":array_push($restrictions2,"1730 Sunday");break;

                case "cell253-A":array_push($restrictions2,"1800 Monday");break;
                case "cell254-A":array_push($restrictions2,"1800 Tuesday");break;
                case "cell255-A":array_push($restrictions2,"1800 Wednesday");break;
                case "cell256-A":array_push($restrictions2,"1800 Thursday");break;
                case "cell257-A":array_push($restrictions2,"1800 Friday");break;
                case "cell258-A":array_push($restrictions2,"1800 Saturday");break;
                case "cell259-A":array_push($restrictions2,"1800 Sunday");break;

                case "cell260-A":array_push($restrictions2,"1830 Monday");break;
                case "cell261-A":array_push($restrictions2,"1830 Tuesday");break;
                case "cell262-A":array_push($restrictions2,"1830 Wednesday");break;
                case "cell263-A":array_push($restrictions2,"1830 Thursday");break;
                case "cell264-A":array_push($restrictions2,"1830 Friday");break;
                case "cell265-A":array_push($restrictions2,"1830 Saturday");break;
                case "cell266-A":array_push($restrictions2,"1830 Sunday");break;

                case "cell267-A":array_push($restrictions2,"1900 Monday");break;
                case "cell268-A":array_push($restrictions2,"1900 Tuesday");break;
                case "cell269-A":array_push($restrictions2,"1900 Wednesday");break;
                case "cell270-A":array_push($restrictions2,"1900 Thursday");break;
                case "cell271-A":array_push($restrictions2,"1900 Friday");break;
                case "cell272-A":array_push($restrictions2,"1900 Saturday");break;
                case "cell273-A":array_push($restrictions2,"1900 Sunday");break;

                case "cell274-A":array_push($restrictions2,"1930 Monday");break;
                case "cell275-A":array_push($restrictions2,"1930 Tuesday");break;
                case "cell276-A":array_push($restrictions2,"1930 Wednesday");break;
                case "cell277-A":array_push($restrictions2,"1930 Thursday");break;
                case "cell278-A":array_push($restrictions2,"1930 Friday");break;
                case "cell279-A":array_push($restrictions2,"1930 Saturday");break;
                case "cell280-A":array_push($restrictions2,"1930 Sunday");break;

                case "cell281-A":array_push($restrictions2,"2000 Monday");break;
                case "cell282-A":array_push($restrictions2,"2000 Tuesday");break;
                case "cell283-A":array_push($restrictions2,"2000 Wednesday");break;
                case "cell284-A":array_push($restrictions2,"2000 Thursday");break;
                case "cell285-A":array_push($restrictions2,"2000 Friday");break;
                case "cell286-A":array_push($restrictions2,"2000 Saturday");break;
                case "cell287-A":array_push($restrictions2,"2000 Sunday");break;

                case "cell288-A":array_push($restrictions2,"2030 Monday");break;
                case "cell289-A":array_push($restrictions2,"2030 Tuesday");break;
                case "cell290-A":array_push($restrictions2,"2030 Wednesday");break;
                case "cell291-A":array_push($restrictions2,"2030 Thursday");break;
                case "cell292-A":array_push($restrictions2,"2030 Friday");break;
                case "cell293-A":array_push($restrictions2,"2030 Saturday");break;
                case "cell294-A":array_push($restrictions2,"2030 Sunday");break;

                case "cell295-A":array_push($restrictions2,"2100 Monday");break;
                case "cell296-A":array_push($restrictions2,"2100 Tuesday");break;
                case "cell297-A":array_push($restrictions2,"2100 Wednesday");break;
                case "cell298-A":array_push($restrictions2,"2100 Thursday");break;
                case "cell299-A":array_push($restrictions2,"2100 Friday");break;
                case "cell300-A":array_push($restrictions2,"2100 Saturday");break;
                case "cell301-A":array_push($restrictions2,"2100 Sunday");break;

                case "cell302-A":array_push($restrictions2,"2130 Monday");break;
                case "cell303-A":array_push($restrictions2,"2130 Tuesday");break;
                case "cell304-A":array_push($restrictions2,"2130 Wednesday");break;
                case "cell305-A":array_push($restrictions2,"2130 Thursday");break;
                case "cell306-A":array_push($restrictions2,"2130 Friday");break;
                case "cell307-A":array_push($restrictions2,"2130 Saturday");break;
                case "cell308-A":array_push($restrictions2,"2130 Sunday");break;

                case "cell309-A":array_push($restrictions2,"2200 Monday");break;
                case "cell310-A":array_push($restrictions2,"2200 Tuesday");break;
                case "cell311-A":array_push($restrictions2,"2200 Wednesday");break;
                case "cell312-A":array_push($restrictions2,"2200 Thursday");break;
                case "cell313-A":array_push($restrictions2,"2200 Friday");break;
                case "cell314-A":array_push($restrictions2,"2200 Saturday");break;
                case "cell315-A":array_push($restrictions2,"2200 Sunday");break;

                case "cell316-A":array_push($restrictions2,"2230 Monday");break;
                case "cell317-A":array_push($restrictions2,"2230 Tuesday");break;
                case "cell318-A":array_push($restrictions2,"2230 Wednesday");break;
                case "cell319-A":array_push($restrictions2,"2230 Thursday");break;
                case "cell320-A":array_push($restrictions2,"2230 Friday");break;
                case "cell321-A":array_push($restrictions2,"2230 Saturday");break;
                case "cell322-A":array_push($restrictions2,"2230 Sunday");break;

                case "cell323-A":array_push($restrictions2,"2300 Monday");break;
                case "cell324-A":array_push($restrictions2,"2300 Tuesday");break;
                case "cell325-A":array_push($restrictions2,"2300 Wednesday");break;
                case "cell326-A":array_push($restrictions2,"2300 Thursday");break;
                case "cell327-A":array_push($restrictions2,"2300 Friday");break;
                case "cell328-A":array_push($restrictions2,"2300 Saturday");break;
                case "cell329-A":array_push($restrictions2,"2300 Sunday");break;

                case "cell330-A":array_push($restrictions2,"2330 Monday");break;
                case "cell331-A":array_push($restrictions2,"2330 Tuesday");break;
                case "cell332-A":array_push($restrictions2,"2330 Wednesday");break;
                case "cell333-A":array_push($restrictions2,"2330 Thursday");break;
                case "cell334-A":array_push($restrictions2,"2330 Friday");break;
                case "cell335-A":array_push($restrictions2,"2330 Saturday");break;
                case "cell336-A":array_push($restrictions2,"2330 Sunday");break;
            }
        }

        // print_r($restrictions2);

        date_default_timezone_set('Asia/Manila');
        $currentTime = date("G").date("i")." ".date("l");

        $currentTimeSlot; $nextTimeSlot;

        if( (int)date("i")>=00 && (int)date("i")<=30)
        {
            $currentTimeSlot = date("G")."00"." ".date("l");

        }    

        else if( (int)date("i")>=30)
        {
            $currentTimeSlot = date("G")."30"." ".date("l");
        }    

        // print($restrictions2[array_search($currentTimeSlot, $restrictions2)+1]);

        if(in_array($currentTimeSlot,$restrictions2))
        {
            //comment out this line for testing
            $home = base_url('home');
            // header("Location: $home");
        }    

        else if(!in_array($currentTimeSlot,$restrictions2))
        {
            // print("<br>you cant use xd");
            // $restrict = base_url('restrict');
            // header("Location: $restrict");
        }    

        // print("<b>Current time:</b> " . (int) date("G") . ": " . date("i") . " ". date("l"));
        // print("<br>");
        // print($currentTime . "<br>");
        // print($currentTimeSlot . "<br>");
        
    }

    else
    {
        $homeURL = base_url('home');
        header("Location: $homeURL");
    }
?>

<script>
    var restrictions =  <?php echo json_encode($restrictions2); ?>;
    
    function checkRestriction2()
    {
        
        var today = new Date();

        var time = today.getHours() + "" + today.getMinutes() + " " + day;

        var hour, min, day;
        var curTime, curHour, curMinute;

        switch(today.getDay())
        {
            case 0:day="Sunday";break;
            case 1:day="Monday";break;
            case 2:day="Tuesday";break;
            case 3:day="Wednesday";break;
            case 4:day="Thursday";break;
            case 5:day="Friday";break;
            case 6:day="Saturday";break;
        }

        //formatting "current timeslot" and "next timeslot"
        if(today.getMinutes()>=0 && today.getMinutes()<=30)
        {
            curHour=today.getHours();
            curMinute=0;

            if(curHour==0)
                curTime = "00" + curMinute + " " + day;
            

            else
                curTime = curHour + "00 " + day;
            
        }    

        else if(today.getMinutes()>=30)
        {
            curHour=today.getHours();
            curMinute=30;

            if(curHour==23)
            {
                switch((today.getDay())+1)
                {
                    case 0:day="Sunday";break;
                    case 1:day="Monday";break;
                    case 2:day="Tuesday";break;
                    case 3:day="Wednesday";break;
                    case 4:day="Thursday";break;
                    case 5:day="Friday";break;
                    case 6:day="Saturday";break;
                }

                curTime = curHour + "" + curMinute + " " + day;
            }

            else
                curTime = curHour + "" + curMinute + " " + day;
            

        }

        // checks if child cannot use for the current timeslot
        if(restrictions.includes(curTime))
        {

            // location.href="<?php echo base_url('home');?>";
        }

        // alert(curTime);

        setTimeout(checkRestriction2, 10000); //seconds x 1000
    } 

    checkRestriction2();
    

</script>


<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="<?php echo base_url("/css/style.css"); ?>" /> 
<body style="background-color: #f4fff6;">
    <br>
    <div class = "container col-sm-12 col-md-12 col-xs-12">
        <div class = "row">
            <div class = "col-sm-12 col-md-12 col-xs-12 home-container">
                <div class = "col-sm-12 col-md-12 col-xs-12 home-container text-center">
                    <br><br><br><br><br><h1>Hey there! You cannot use Mukhlat right now 😅<br><br>Come back later!</h1><br><br><br><br>

                    <!-- <h2>You can click this green button to check if you can use it again!😊.<br><br></h2>
                    <button class="container btn col-xs-4 col-xs-offset-4 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4" style="background-color: green; color: white; font-size: 24px;" onclick="location.href='<?php echo base_url('home');?>'">Home</button> -->
                    
                    <h2>Or you can say goodbye for now 👋.<br><br></h2>
                    <button class="container btn col-xs-4 col-xs-offset-4 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4" style="background-color: orange; color: white; font-size: 24px;" onclick="location.href='<?php echo base_url('signin/logout');?>'">Goodbye!</button>
                    
                    <!-- <br><br><button class = "btn" data-dismiss="modal" style="background-color: orange; color: black; font-size: 24px">No, take me back!</button> -->
                </div>


            </div>

        </div>
    </div>
</body>
