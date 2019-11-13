<?php

    if(isset($_SESSION['logged_user']))
    {
        $logged_user = $_SESSION['logged_user'];
        if($logged_user->role_id != 2 || $logged_user == null)
        {
            $homeURL = base_url('home');
            header("Location: $homeURL");
            exit(0);
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

        $currentTimeSlot;

        if( (int)date("i")>=00 && (int)date("i")<=30)
            $currentTimeSlot = date("G")."00"." ".date("l");

        else if( (int)date("i")>=30)
            $currentTimeSlot = date("G")."30"." ".date("l");

        if(in_array($currentTimeSlot,$restrictions2))
            print("<br>" . $currentTimeSlot);

        else
        {
            print("you cant use xd ");
            $restrict = base_url('restrict');
            // header("Location: $restrict");
        }    

        // print("<b>Current time:</b> " . (int) date("G") . ": " . date("i") . " ". date("l"));
        // print("<br>");
        print($currentTime . "<br>");
        // print($currentTimeSlot);
        
    }

    else
    {
        $homeURL = base_url('home');
        header("Location: $homeURL");
    }

    include(APPPATH . 'views/modals/birthday_modal.php'); 
    include(APPPATH . 'views/modals/afk_warning_modal.php'); 
?>
<p id="afktimer" style="float: right; display:none;">Time Left: 9999<p>

<!-- scale to device resolution -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="<?php echo base_url("/css/style.css"); ?>" /> 

<!-- Nav Bar -->

<script type="text/javascript">
    
    function getCookie(cname) 
    {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for(var i = 0; i < ca.length; i++) 
        {
            var c = ca[i];
            while (c.charAt(0) === ' ') 
            {
                c = c.substring(1);
            }

            if (c.indexOf(name) === 0) 
            {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }
     

/*------------------------- AFK Timer Script -------------------------*/

    var start = document.getElementById("start");
    var dis = document.getElementById("afktimer");
    var finishTime;
    var timerLength = 60000; // 600 seconds or 10 minutes
    var timeoutID;
    dis.innerHTML = "Time Left: " + timerLength;
    
    document.onmousemove = function()
    { //reset timer and hide AFK popup
        StartTimer();
        $('#afkpopup').modal('hide'); 
    };
    
    StartTimer();

    function StartTimer() 
    {
        localStorage.setItem('myTime', ((new Date()).getTime() + timerLength * 1000));

        if (timeoutID !== undefined) window.clearTimeout(timeoutID);
            Update();
    };

    function Update() 
    {
        finishTime = localStorage.getItem('myTime');
        var timeLeft = (finishTime - new Date());
        dis.innerHTML = "Time Left: " + Math.max(timeLeft/1000,0);
        timeoutID = window.setTimeout(Update, 100);

        if(timeLeft<=480*1000) //display AFK popup after 2 minutes
        {
            $('#afkpopup').modal('show');
        }
        
        if(timeLeft<=10*1000) // logout user if AFK
        {
            location.href="<?php echo base_url('afk');?>";
        }
    }

    var currentDate = new Date();
    var curMonth = currentDate.getMonth()+1;
    var curDay = currentDate.getDate();

    var birthDate = new Date('<?php echo $logged_user->birthdate; ?>');
    var birthMonth = birthDate.getMonth()+1;
    var birthDay = birthDate.getDate(); 
   
    if(birthMonth===curMonth && birthDay===curDay)
    {
        if(!getCookie("birthday") && getCookie("birthday")!==1)
        {
            document.cookie = "birthday=1;" + ";path=/"; 
            $('#birthdaypopup').modal('show');
        }    
    }

    var randomColor = Math.floor(Math.random()*16777215).toString(16);
    var randomColor2 = Math.floor(Math.random()*16777215).toString(16);
    var randomColor3 = Math.floor(Math.random()*16777215).toString(16);
    var randomColor4 = Math.floor(Math.random()*16777215).toString(16);
    
    if(getCookie("activaterain")==='1')
    {  
        document.cookie = "NavbarColor=#" + randomColor + ";" + ";path=/"; 
        document.cookie = "ButtonColor=#" + randomColor4 + ";" + ";path=/"; 
        document.cookie = "ButtonHColor=#" + randomColor2 + ";" + ";path=/";
        document.cookie = "ButtonAColor=#" + randomColor3 + ";" + ";path=/";
    }
    
    if(getCookie("ButtonColor")==='')
    {
        document.cookie = "ButtonColor=#1d8f15;" + ";path=/"; 
        document.cookie = "ButtonHColor=#14620f;" + ";path=/"; 
        document.cookie = "ButtonAColor=#185729;" + ";path=/"; 
    }

//    changing custom themes, pointers, effects based on the users choices
    document.write('<style type="text/css">.navbar-font {background:' + getCookie("NavbarColor") + ';}\n\
                    #randtriv1{background: #'+ randomColor2 +';}\n\
                    .soundbg {display:' + getCookie("soundbg1") + ';}\n\
                     body {background' + getCookie("backgroundColor") + ';background-repeat: no-repeat;background-attachment: fixed;font-family:' + getCookie("Fonty") + '}\n\
                    .buttonsbgcolor {background:' + getCookie("ButtonColor") + ';}\n\
                    .buttonsbgcolor:hover{background:' + getCookie("ButtonHColor") + ';}\n\
                    .text1color{color:' + getCookie("ButtonColor") + ';}\n\
                    .bar1color{background:' + getCookie("ButtonColor") + ';}\n\
                    .text1color:hover{color:' + getCookie("ButtonHColor") + ';}\n\
                    .buttonsbgcolor:focus{background:' + getCookie("ButtonColor") + ';outline:0;}\n\
                    .buttonsbgcolor:active{background:' + getCookie("ButtonAColor")  + '!important;}\n\
                    .modalbg{background:' + getCookie("NavbarColor") + ';}\n\
                    .nav-pills>li.active>a, .nav-pills>li.active>a:focus, .nav-pills>li.active>a:hover { background: ' + getCookie("NavbarColor") + ';}\n\
                    .snowflakebg{display:' + getCookie("snowflakebg1") + '!important;}\n\
                    .sparklesbg{display:' + getCookie("sparklebg1") + ';}\n\
                    .fireworkbg{display:' + getCookie("fireworkbg1") + ';}\n\
                    .navbaricons:hover{background:' + getCookie("ButtonHColor") + ';}\n\
                    .navbarprofileicon:hover{background:' + getCookie("ButtonHColor") + ';}\n\
                    .bubblesbg{display:' + getCookie("bubblesbg1") + ';}\n\
                    .navbaricons .tooltiptext{background-color:' + getCookie("ButtonHColor") + ';}\n\
                    .camerapic .tooltiptext{background-color:' + getCookie("ButtonHColor") + ';}\n\
                    .playpop .tooltiptext{background-color:' + getCookie("ButtonHColor") + ';}\n\
                    .audiorec .tooltiptext{background-color:' + getCookie("ButtonHColor") + ';}\n\
                    .navbarprofileicon .tooltiptext{background-color:' + getCookie("ButtonHColor") + ';}\n\
                    .search-btn .tooltiptext1{background-color:' + getCookie("ButtonHColor") + ';}\n\
                    #logom .bubbletooltip{background-color:' + getCookie("ButtonHColor") + ';}\n\
                    .trail{background:' + getCookie("ButtonAColor") + '!important;}\n\
                    body::-webkit-scrollbar-thumb{background-color:' + getCookie("ButtonHColor") + ';}\n\
                    body ::selection{background:' + getCookie("ButtonHColor") + ';}\n\
                    body{cursor:url(' + getCookie("MousePointer") + '),auto;}\n\
                    :hover{cursor:url(' + getCookie("MousePointer") + '),auto;}\n\
                    .modal-header{background:' + getCookie("NavbarColor") + ';}\n\
                    .charLimitMessage{background:' + getCookie("ButtonHColor") + ';}\n\
                    .topic-grid1{background-color: #'+ randomColor +';}\n\
                    .homepostsborder{border-color:' + getCookie("ButtonColor") + ';}\n\
                    .ptopcolor{background:' + getCookie("ButtonColor") + ';}<\/style>');
    
    if(getCookie("MouseTrail")==='0')
            document.write('<style type="text/css">.trail{display:none;}<\/style>');
        
    if(getCookie("bubblesbg1")==='block')
        document.write('<style type="text/css"> #logom .bubbletooltip{visibility:visible;}<\/style>');
        
   else
        document.write('<style type="text/css"> #logom .bubbletooltip{visibility:hidden;}<\/style>');
        
    if(getCookie("randomcolors")==='1')
    {
        document.write('<style type="text/css">\n\
                    #randtriv1{background: #'+ randomColor2 +';}\n\
                .topic-grid1{background-color: #'+ randomColor +';}<\/style>');
    }
    
    else
    {
        document.write('<style type="text/css">\n\
                    #randtriv1{background:'+ getCookie("ButtonColor") +';}\n\
                    .topic-grid1{background-color:'+ getCookie("ButtonColor") +';}<\/style>');
    }    

    if(getCookie("sparklebg1")==="block")
    {
        document.write('<canvas id="world" class="sparklesbg"></canvas>'); 
    }

    if(getCookie("fireworkbg1")==="block")
    {
        document.write('<canvas id="firework" class="fireworkbg"></canvas>'); 
    }
    
    if(getCookie("dance")==='1')
    {
        document.write('<style type="text/css">\n\
                        .btn{animation: dance 3s infinite;}\n\
                        .navbaricons{animation: dance 3s infinite;}\n\
                        .navbarprofileicon{animation: dance 3s infinite;}\n\
                        #logout-btn{animation: dance 3s infinite;}\n\
                        button{animation: dance 3s infinite;}\n\
                        a{animation: dance 3s infinite;}\n\
                        <\/style>');
    }
       

    //night mode script
    var currentTime = new Date();
    var hours = currentTime.getHours();
    var minutes = currentTime.getMinutes();

    //different logo on nightmode
    if(hours >= 18 || hours < 6)
    {
        document.write('<style type="text/css">\n\
        #nav-logo{display:none}\n\
        #home2{display:none}\n\
        <\/style>');
    }
    
    else
    {
        document.write('<style type="text/css">\n\
            #nav-logo2{display:none}\n\
            #bed2{display:none}<\/style>');
    }

    //force logout by 8pm to 6am
    //        if(hours >= 20 || hours < 6)
    //        {
    //            location.href="http://localhost/MukhlatV2Beta/signin/logout";
    //        }
    //Warning before 8pm's force logout
    // if(hours === 19 && getCookie("warned")==='0')
    // {
    //     $('#timeoutpopup').modal({backdrop: 'static', keyboard: false});
    //     document.cookie = "warned=1;path=/"; 
        
    // }
       
</script>
<!--<script type="text/javascript" src="https://panzi.github.io/Browser-Ponies/basecfg.js" id="browser-ponies-config"></script>
<script type="text/javascript" src="https://panzi.github.io/Browser-Ponies/browserponies.js" id="browser-ponies-script"></script>-->
<!--<script type="text/javascript">/* <![CDATA[ */ (function (cfg) {BrowserPonies.setBaseUrl(cfg.baseurl);BrowserPonies.loadConfig(BrowserPoniesBaseConfig);BrowserPonies.loadConfig(cfg);})({"baseurl":"https://panzi.github.io/Browser-Ponies/","fadeDuration":500,"volume":1,"fps":25,"speed":3,"audioEnabled":false,"showFps":false,"showLoadProgress":true,"speakProbability":0.1,"spawn":{"winona":1},"autostart":true}); /* ]]> */</script>-->
<head>
    
    <script type="text/javascript" src="<?php echo base_url('sound-mouseover/sound-mouseover.js'); ?>"></script>
    
    <!--<link rel="stylesheet" type="text/css" href="<?php echo base_url('clippy.js-master/build/clippy.css'); ?>" media="all">-->
    <style>
        svg{
        display: block;
        width: 100%;
        height: 100%;
        padding: 0;
        margin: 0;
        position: fixed;
        }

        path{
        stroke-linecap: square;
        stroke: white;
        stroke-width: 0.5px;
        }        

    </style>
<!--        <style>/*******************************
* MODAL AS LEFT/RIGHT SIDEBAR
* Add "left" or "right" in modal parent div, after class="modal".
* Get free snippets on bootpen.com
*******************************/

	.modal.right .modal-dialog {
		position: fixed;
		margin: auto;
		width: 320px;
		height: 100%;
		-webkit-transform: translate3d(0%, 0, 0);
		    -ms-transform: translate3d(0%, 0, 0);
		     -o-transform: translate3d(0%, 0, 0);
		        transform: translate3d(0%, 0, 0);
	}

	.modal.right .modal-content {
		height: 100%;
		overflow-y: auto;
	}

	.modal.right .modal-body {
		padding: 15px 15px 80px;
	}


        
/*Right*/
	.modal.right.fade .modal-dialog {
		right: -320px;
		-webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
		   -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
		     -o-transition: opacity 0.3s linear, right 0.3s ease-out;
		        transition: opacity 0.3s linear, right 0.3s ease-out;
	}
	
	.modal.right.fade.in .modal-dialog {
		right: 0;
	}

/* ----- MODAL STYLE ----- */
	.modal-content {
		border-radius: 0;
		border: none;
	}

	.modal-header {
		border-bottom-color: #EEEEEE;
		background-color: #FAFAFA;
	}
</style>-->
    <!--snowflakes falling effect-->
<div class="snowflakebg" style="display: none;">       
    <div class="snowflakes" aria-hidden="true">
        <div class="snowflake" style="font-size: 23px">❄</div>
        <div class="snowflake" style="font-size: 24px">❅</div>
        <div class="snowflake" style="font-size: 32px">❆</div>
        <div class="snowflake" style="font-size: 23px">❄</div>
        <div class="snowflake" style="font-size: 24px">❅</div>
        <div class="snowflake" style="font-size: 32px">❆</div>
        <div class="snowflake" style="font-size: 23px">❄</div>
        <div class="snowflake" style="font-size: 24px">❅</div>
        <div class="snowflake" style="font-size: 32px">❆</div>
        <div class="snowflake" style="font-size: 23px">❄</div>
    </div>
</div>    

</head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
    <!--<script src="/intl/en/chrome/assets/common/js/chrome.min.js"></script>-->     
    
<!--Voice Search Script-->
<script type="text/javascript" src="<?php echo base_url('js/voicesearch.js'); ?>"> </script>

<!--draggability script-->
<script src="<?php echo base_url('draggabilly-master/dist/draggabilly.pkgd.min.js'); ?>"></script>

<!-- Nav Bar -->

<!-- SCM Music Player http://scmplayer.co -->
<!--    <script type="text/javascript" src="<?php echo base_url('scm-music-player-github/script.js'); ?>" 
    data-config="{'skin':'skins/simpleBlack/skin.css','volume':50,'autoplay':false,'shuffle':false,'repeat':0,'placement':'bottom','showplaylist':false,'playlist':[{'title':'Dora The Explorer Theme Song.','url':'<?php echo base_url('assets/music/Dora The Explorer Theme Song.mp3'); ?>'},{'title':'Flight of the Bumble-Bee','url':'<?php echo base_url('assets/music/Flight of the Bumble-Bee.mp3'); ?>'},{'title':'Inhuman Reactions','url':'<?php echo base_url('assets/music/INHUMAN REACTIONS.mp3'); ?>'}]}" >
    </script>-->
    <!-- SCM Music Player script end -->

    <!--night mode-->
<div id="overlay"></div>

<!--bubbles effect-->
<div class="bubblesbg">
<div class="bubble-container">
   <div class="bubble bubble1">
      <div class="bubble-border"></div>
      <div class="bubble-pop">*pop*</div>
   </div>
</div>
<div class="bubble bubble2 bubble1">
   <div class="bubble-border"></div>
   <div class="bubble-pop">*pop*</div>
</div>
<div class="bubble bubble3 bubble1">
   <div class="bubble-border"></div>
   <div class="bubble-pop">*pop*</div>
</div>
<div class="bubble bubble4 bubble1">
   <div class="bubble-border"></div>
   <div class="bubble-pop">*pop*</div>
</div>
<div class="bubble bubble5"><div class="bubble-border"></div><div class="bubble-pop">*ouch*</div></div>
<div class="bubble bubble6"><div class="bubble-border"></div><div class="bubble-pop">*pop*</div></div>
<div class="bubble bubble7"><div class="bubble-border"></div><div class="bubble-pop">*pop*</div></div>
<div class="bubble bubble8"><div class="bubble-border"></div><div class="bubble-pop">*pop*</div></div>
<div class="bubble bubble9"><div class="bubble-border"></div><div class="bubble-pop">*pop*</div></div>
</div>

<!--voice command easter egg-->
<div id ="peek" style="display:none;"><img src = "<?php echo base_url('images/green m cat.png'); ?>"/></div>

<!--frequency bar effect-->
    <div class="soundbg" style="float:left;">
        <svg preserveAspectRatio="none" id="visualizer" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <defs>
                <mask id="mask">
                    <g id="maskGroup">
                  </g>
                </mask>
                <linearGradient id="gradient" x1="0%" y1="0%" x2="0%" y2="100%">
                    <stop offset="0%" style="stop-color:#ff0a0a;stop-opacity:1" />
                    <stop offset="20%" style="stop-color:#f1ff0a;stop-opacity:1" />
                    <stop offset="90%" style="stop-color:#d923b9;stop-opacity:1" />
                    <stop offset="100%" style="stop-color:#050d61;stop-opacity:1" />
                </linearGradient>
            </defs>
            <rect x="0" y="0" width="100%" height="100%" fill="url(#gradient)" mask="url(#mask)"></rect>
        </svg>
        <h1></h1>
    </div>

	 
<!--	<div class="modal right fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
		<div class="modal-dialog" role="document">
			<div class="modal-content">

				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel2">Right Sidebar</h4>
				</div>

				<div class="modal-body">
					
				</div>

			</div> 
		</div> 
	</div>  -->

    <nav class = "navbar navbar-default navbar-font navbar-fixed-top" style = "box-shadow: 0px 1px 2px #ccc;">
        <div class = "container-fluid"  style="margin:0.5%;">
            <div class = "navbar-header" style = "margin-left: 50px;">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span> 
                </button>
                <a onmouseenter="playclip()" id ="logom" class = "draggable navbar-brand" href = "<?php echo base_url('home') ?>"><img style="cursor: pointer" id = "nav-logo" src = "<?php echo base_url('images/logo/mukhlatlogo on the sideb.png'); ?>"/><img style="cursor: pointer" id = "nav-logo2" src = "<?php echo base_url('images/logo/bed mukhlat.png'); ?>"/><span class="bubbletooltip" id="bubblegame"style="">Score: </span></a>
<!--            <button type="button" class="btn btn-demo" data-toggle="modal" data-target="#myModal2">
			Right Sidebar Modal
		</button>-->

            <span id="results" border="1px">
                <span id="final_span3" class="final"></span>
                <span id="interim_span3" class="interim"></span>
            </span>

            </div>
            <div class = "collapse navbar-collapse" id = "nav-collapse">
                <div class = "nav-left-end">
                    <form action = "<?php echo base_url('search'); ?>" class="navbar-left" role = "search" method = "GET" style="width:30%; margin-top:0.555%; margin-left:1%; margin-right:4%;">
                        <span class="input-group">
                            <div class="input-group-btn" style="display: inline-block;">
                                <input required type="text" name = "search-key" class="form-control" placeholder="" id="search" style="width: 400px; font-size: 22px">
                                <!-- <span class="btn btn-default search-btn tooltip1" onclick="voiceDropdown()" id="voice-search-button" style="cursor: pointer"><i class = "fa fa-microphone buttonsgo"style="font-size:16px;cursor: pointer"></i><span class="tooltiptext1" style="width:180px;">Search by voice</span></span> -->
                                <button class="btn btn-default search-btn tooltip1" type="submit" style="width:40px;height:35px">
<!--                                    <i class="glyphicon glyphicon-search buttonsgo" style="cursor: pointer"></i>--> <img  src = "<?php echo base_url('icons/search.png'); ?>" class="buttonsgo" style="width:150%;height:auto;cursor: pointer"/><span class="tooltiptext1" style="width:150px;">Start looking</span>
                                </button> 
                                
                            </div>
                            
                            <!--Hidden DIV for voice search-->
                            <span id="results" border="1px" style="display:none;">
                                <span id="final_span" class="final"></span>
                                <span id="interim_span" class="interim"></span>
                            </span>
                            <span id="results" border="1px">
                                <span id="final_span3" class="final"></span>
                                <span id="interim_span3" class="interim"></span>
                            </span>
                        </span>
                            
                        
                    </form>
                </div>
        <!--voice search-->
            <div id="voicedropdown" class="voice-dropdown-content navbarvoice" style="display:none;">
                                <div class="compact marquee" id="div_language" style="display: inline-block;font-size: 22px">
                                    <select id="select_language">
                                        <option value="0" onclick="resetDictation(event)">English</option>
                                        <option value="1" onclick="resetDictation(event)">Filipino</option>
                                        <option value="2" onclick="resetDictation(event)">French</option>
                                        <option value="3" onclick="resetDictation(event)">Korean</option>
                                        <option value="4" onclick="resetDictation(event)">Italian</option>
                                        <option value="5" onclick="resetDictation(event)">Spanish</option>
                                        <option value="6" onclick="resetDictation(event)">Japanese</option>
                                    </select>
                                </div>                         
                                <div style="display: inline-block;">
                                    <a href="#" class="voicesearch voicesearchtext tooltip1" id="voicesearch" onclick="startDictation(event);" style="color:white;background:green;margin-left:5px;"><i style="font-size: 22px" class = "fa fa-microphone"></i><span class="tooltiptext1">Start</span></a>

                                    <span id="snackbar">Speak to type is on now</span>
                                    <a href="#" class="voicesearch voicesearchtext tooltip1" id="voicesearch" onclick="stopDictation(event)" style="color:white;background: red;margin-left:5px;"><i style="font-size: 22px" class = "fa fa-microphone-slash"></i><span class="tooltiptext1" style="background:red;">Stop</span></a>
                                    <a href="#" class="voicesearch voicesearchtext tooltip1" id="voicesearch" onclick="resetDictation(event);" style="color:black;background:yellow;margin-left:5px;"><i style="font-size: 22px" class = "fa fa-refresh"></i><span class="tooltiptext1" style="background:yellow;color:black">Reset</span></a>
                                   <!--<a href="#" class="voicesearch" id="voicesearch" onclick='responsiveVoice.speak(search.value,"UK English Male",{rate: 0.9, pitch: 1});' >PLAY</a>-->
                                </div>
                            </div>
                            <div class="navbaricons2">
                                <a onclick="window.speechSynthesis.cancel();" onmouseenter="playclip()" id="logout-btn" href="#logout-modal" data-toggle = "modal" class="navbaricons" href="<?php echo base_url('signin/logout'); ?>" style="margin-right:4%;"><p class="iconin" style="font-size:14px !important;text-align: left !important;"><img  src = "<?php echo base_url('icons/logout.png'); ?>" class="iconin" style="width:100%;height:auto"/><!Bye!></p>
                                <span class="tooltiptext">Goodbye Mukhlat!</span></a>

                                <!-- <a onclick="window.speechSynthesis.cancel();" onmouseenter="playclip()" id="logout-btn" class="navbaricons" href="<?php echo base_url('signin/logout'); ?>" style="margin-right:4%;"><p class="iconin" style="font-size:14px !important;text-align: left !important;"><img  src = "<?php echo base_url('icons/logout.png'); ?>" class="iconin" style="width:100%;height:auto"/><!Bye!></p>
                                <span class="tooltiptext">Goodbye Mukhlat!</span></a> -->

                            <a onmouseenter="playclip()" class="navbaricons" href="#customize-theme" data-toggle = "modal">
                                <p class="iconin" style="font-size:14px !important;text-align: left !important;"><img  src = "<?php echo base_url('icons/paintbrush.png'); ?>" class="iconin" style="width:100%;height:auto"/><!Style></p>
                                <span class="tooltiptext">Change what you see!</span>
                            </a>
                                    </a>
                            
<!--                            <a onmouseenter="playclip()" class="navbaricons" id = "notif-btn" href="#notif-modal" data-toggle = "modal" <?php echo (int) $logged_user->unread_notifs > 0 ? "data-value = \"" . $logged_user->unread_notifs . "\"" : "" ?>>
                                    <?php if ((int) $logged_user->unread_notifs > 0): ?>
                                    <span id = "notif-badge" class = "badge" style="float:right;background: red;"><?php echo $logged_user->unread_notifs ?></span>
                                    <?php endif; ?>    
                                    <p class="iconin" style="font-size:14px !important;text-align: left !important;"><img  src = "<?php echo base_url('icons/notif.png'); ?>" class="iconin" style="width:100%;height:auto"/><!News>    </p>
                                <span class="tooltiptext">Check what's up!</span>  
                            </a>-->

                            <a onmouseenter="playclip()" class="navbaricons" id = "notif-btn" href="<?php echo base_url('chat') ?>" <?php echo (int) $logged_user->unread_notifs > 0 ? "data-value = \"" . $logged_user->unread_notifs . "\"" : "" ?>>
                                    <?php if ((int) $logged_user->unread_notifs > 0): ?>
                                    <span id = "notif-badge" class = "badge" style="float:right;background: red;"><?php echo $logged_user->unread_notifs ?></span>
                                    <?php endif; ?>    
                                    <p class="iconin" style="font-size:14px !important;text-align: left !important;"><img  src = "<?php echo base_url('icons/chat.png'); ?>" class="iconin" style="width:100%;height:auto"/><!Chat>    </p>
                                <span class="tooltiptext">Chit chat!</span>  
                            </a>

                            <div class="vl"  style="margin-right:0.3%;"></div>
 
                            <a onmouseenter="playclip()" class="navbaricons" href="<?php echo base_url('topic') ?>"><p class="iconin" style="font-size:14px !important;text-align: left !important;"> <img  src = "<?php echo base_url('icons/topics.png'); ?>" class="iconin" style="width:100%;height:auto;cursor: pointer"/><!Topics></p><span class="tooltiptext">Visit other rooms!</span></a>
                                <a onmouseenter="playclip()" class="navbaricons" href="<?php echo base_url('home') ?>"><p class="iconin" style="font-size:14px !important;text-align: left !important;"><img  src = "<?php echo base_url('icons/home.png'); ?>" class="iconin" style="width:100%;height:auto"/><!Home></p><span class="tooltiptext">Go to the homepage</span></a>
                               
                                <a onmouseenter="playclip()" class="navbarprofileicon" href="<?php echo base_url('user/profile/' . $logged_user->user_id); ?>" >
                                <img class = "img-circle nav-prof-pic iconin" src = "<?php echo $logged_user->profile_url ? base_url($logged_user->profile_url) : base_url('images/default.jpg') ?>"/> 
                                <?php echo $logged_user->first_name; ?><span class="tooltiptext">Check your profile!</span></a>

                </div>
            </div>
        </div>
    </nav>
<!--<img class = "draggable mascoti" src = "<?php echo base_url('images/Picture1.png'); ?>"/><span class="mascotitalk">Hello</span>-->

<!--<img class = "draggable mascoti" src = "<?php echo base_url('images/Picture1.png'); ?>"/>-->
<!-- Nav Bar Script -->
<script type="text/javascript" src="<?php echo base_url("/js/nav_bar.js"); ?>"></script>
<!--voice search indicator script-->
<script>
function voiceIndicatorON() {
    var VInd = document.getElementById("snackbar");
    VInd.className = "show";
}

function voiceIndicatorOFF() {
    var VInd = document.getElementById("snackbar");
    VInd.className = "hide";
}

</script>

<!--voice commands script-->
<script type="text/javascript">
        var final_transcript3 = '';
        var recognizing3 = true;
        var meow = new Audio('<?php echo base_url('images/catmeow.mp3'); ?>');

        if ('webkitSpeechRecognition' in window) {

          var recognition3 = new webkitSpeechRecognition();
          recognition3.lang = 'en-US';
          recognition3.continuous = true;
          recognition3.interimResults = true;

          recognition3.onstart = function() {
            recognizing3 = true;
          };

          recognition3.onerror = function(event) {
            console.log(event.error);
          };

          recognition3.onend = function() {
            recognizing3 = false;
        };

       recognition3.onresult = function(event) {
                      
            var interim_transcript3 = '';
            for (var i = event.resultIndex; i < event.results.length; ++i) {
              if (event.results[i].isFinal) {
                final_transcript3 += event.results[i][0].transcript;
              } else {
                interim_transcript3 += event.results[i][0].transcript;
              }
            }
            final_span3.innerHTML = linebreak(final_transcript3);
            interim_span3.innerHTML = linebreak(interim_transcript3);
                
                if(interim_span3.innerHTML.includes("birthday ko") || interim_span3.innerHTML.includes("happy birthday")){
                birthdayPopup();
            }

            if(interim_span3.innerHTML.includes("sawa na ako") || interim_span3.innerHTML.includes("time out")){
                forceTimeout();
            }

            if(interim_span3.innerHTML.includes("sawa na ako") || interim_span3.innerHTML.includes("remove blur")){
                location.href="http://localhost/MukhlatV2Beta/home";
            }

            if(interim_span3.innerHTML.includes("remove night mode")){
                document.write('<style type="text/css">#overlay{background-color: rgba(0,0,0,0);}<\/style>');
                location.href="http://localhost/MukhlatV2Beta/home";
            }

            if(interim_span3.innerHTML.includes("go to home")){
                location.href="http://localhost/MukhlatV2Beta/home";
            }

            if(interim_span3.innerHTML.includes("sa home po")){
                location.href="http://localhost/MukhlatV2Beta/home";
            }


            if(interim_span3.innerHTML.includes("go to topics")){
                location.href="http://localhost/MukhlatV2Beta/topic";
            }

            if(interim_span3.innerHTML.includes("sa topics po")){
                location.href="http://localhost/MukhlatV2Beta/topic";
            }

            if(interim_span3.innerHTML.includes("go to profile")){
                location.href="<?php echo base_url('user/profile/' . $logged_user->user_id); ?>";
            }

            if(interim_span3.innerHTML.includes("sa profile po")){
                location.href="<?php echo base_url('user/profile/' . $logged_user->user_id); ?>";
            }
            
            if(interim_span3.innerHTML.includes("activate camera")){
                $('#camerapopup').modal('show');
            }
            
            if(interim_span3.innerHTML.includes("selfie")){
                takephoto();
                interim_span3.innerHTML = interim_span3.innerHTML.replace("selfie","");
            }

//                if(interim_span3.innerHTML.includes("di siya mahal")){
//                    location.href="https://www.facebook.com/rafael.tanchuan";
//                }

            if(interim_span3.innerHTML.includes("voice search")){
                var x = document.getElementById("voicedropdown");
                if (x.style.display === "none") {
                    x.style.display = "block";
                }
                startDictation(event);
            }

            if(interim_span3.innerHTML.includes("meow")){
               meow.play();
               catpeek();
            }


          };
        }

        var two_line = /\n\n/g;
        var one_line = /\n/g;
        function linebreak(s) {
          return s.replace(two_line, '<p></p>').replace(one_line, '<br>');
        }

        function capitalize(s) {
          return s.replace(s.substr(0,1), function(m) { return m.toUpperCase(); });
        }

        function startDictation3(event) {
            recognition3.lang = 'fil-PH';
            final_transcript3 = '';
            final_span3.innerHTML = '';
            interim_span3.innerHTML = '';
            
            
            recognition3.start();
        }

        function stopDictation3(event) {
            recognition3.stop();
        }

        function resetDictation3(event) {
            recognition3.stop();
            recognition3.lang = 'fil-PH';
            final_transcript3 = '';
            final_span3.innerHTML = '';
            interim_span3.innerHTML = '';
        }
        
        var languages = new Array(
            'en-US',
            'fil-PH',
            'fr-FR',
            'ko-KR'
        );

        startDictation3(event);
        
        
    </script>
<!--<script src="<?php echo base_url('js/eastereggs.js'); ?>"></script>-->
<!--<script src="<?php echo base_url('js/usagetimer.js'); ?>"></script>-->
<script>var $draggable = $('.draggable').draggabilly();</script>
<script src="<?php echo base_url('js/frequencybars.js'); ?>"></script>
<script src="<?php echo base_url('js/sparkles.js'); ?>"></script>
<!--<script src="<?php echo base_url('js/fireworks.js'); ?>"></script>-->

<!--bubble popping and popped bubbles counter script-->
<script>
    var bubpop = new Audio('<?php echo base_url('images/pop.mp3'); ?>');
    var bubbles = document.querySelectorAll('.bubble');
    var poppedClass = 'bubble--popped';
    var score = Number(getCookie("score"));
    
    document.getElementById("bubblegame").innerHTML='Bubbles Popped: ' + score;
    
    function scoreBubble() {
        score++;
        document.cookie = "score=" + score +";path=/"; 
        document.getElementById("bubblegame").innerHTML='Bubbles Popped: ' + score;
    }
    
    function popBubble(e, bubble) {
       bubble.style.top = e.clientY - e.offsetY + 'px';
       bubble.style.left = e.clientX - e.offsetX + 'px';
       bubble.style.pointerEvents="none";
       bubble.classList.add(poppedClass);
       scoreBubble();
       bubpop.play();
    }

    function resetBubble(bubble) {
       bubble.classList.remove(poppedClass);
       bubble.style.top = '';
       bubble.style.left = '';
       bubble.style.pointerEvents="auto";
    }

    bubbles.forEach(function(bubble) {
       bubble.addEventListener('click', function(e) {
          popBubble(e, this);
       });

       bubble.addEventListener('animationend', function() {
          resetBubble(this);
       });
    });
</script>
<!--<script>//
//var starlike = new Audio('<?php echo base_url('images/SPARKLE EFFECT1.mp3'); ?>');
//function starding(){
//    starlike.play();}
//</script>-->
<script src="<?php echo base_url('js/cursordots.js'); ?>"></script>
<!-- Add these scripts to  the bottom of the page -->
<!-- jQuery 1.7+ --> 
<!--<script src="jquery.1.7.min.js"></script>-->

<!-- Clippy.js -->
<!--<script src="<?php echo base_url('clippy.js-master/build/clippy.min.js'); ?>"></script>

 Init script 
<script type="text/javascript">
    clippy.load('Links', function(agent){
        // do anything with the loaded agent
        agent.show();
        agent.speak('My name is Links.');
    });  
    
</script>-->

<!--mouseover on a button audio-->
<audio>
<source src="<?php echo base_url('sound-mouseover/click.mp3'); ?>">
<source src="<?php echo base_url('sound-mouseover/click.ogg'); ?>">
</audio>
<div id="sounddiv"><bgsound id="sound"></div>

<!--highlighted text reader script-->
<script>
var synth = window.speechSynthesis;
var voices90 = synth.getVoices();

function getSelectionText() { //highlight desired text to read
    var text = "";
    if (window.getSelection) {
        text = window.getSelection().toString();
    } else if (document.selection && document.selection.type !== "Control") {
        text = document.selection.createRange().text;
    }
    return text;
}

document.addEventListener('keydown', function(e) {
  if (e.keyCode === 16) { //press shift to read higlighted text
    var msg = new SpeechSynthesisUtterance(getSelectionText());
    msg.voice = voices90[2];
    synth.speak(msg);
  }
  if(e.keyCode === 17){ //press ctrl to stop reading
     window.speechSynthesis.cancel();
  }
});

</script>

<!--read post content reader script-->
        <script>
function readcontent(value) {
    if(!(speechSynthesis.speaking)){
    var value2 = value.replace(/`/g, "'");
    var reader = new SpeechSynthesisUtterance(value2);
    window.speechSynthesis.speak(reader);
    }
    else{
        window.speechSynthesis.cancel();
    }
  }

</script>
<!-- End Nav Bar -->


<?php include(APPPATH . 'views/modals/logout_confirm_modal.php'); ?>
<?php include(APPPATH . 'views/modals/notifications_modal.php'); ?>
<?php include(APPPATH . 'views/modals/customize_modal.php'); ?>