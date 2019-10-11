
<?php
    include(APPPATH . 'views/header.php');
        
    //check if current user is child or logged in
    //if user is not a child, redirect to home
    //if user is not logged in, redirect to sign in
    $logged_user = $_SESSION['logged_user'];
    if($logged_user->role_id != 2 || $logged_user == null)
    {
        $homeURL = base_url('');
        header("Location: $homeURL");
    }

    
?>
<script type="text/javascript">
    
    var chat_id = "<?php echo $chat_id?>";
    
    var sender_id = "<?php echo $sender_id?>";
    
</script> 

<script type="text/javascript" src="<?php echo base_url("js/chat.js"); ?>"></script>

<link rel="icon" href="<?php echo base_url('./images/logo/mukhlatlogo_icon.png'); ?>" sizes="32x32">

<style type="text/css">
#chat_viewport{
    min-height: 500px;
    border : 1px solid black;
}
#chats_box{
    height: 80%;
  border: 3px solid blue;
  overflow:scroll;
}
</style>

<body>
    <?php include(APPPATH . 'views/navigation_bar.php');?>
    <div style="width: 100%; overflow: hidden ;margin-top: 60px;height:100vh;">
    <div id="chats_box"style="width: 20%; float: left;">
    
    <button id="addchat" style="width:100%;min-height:10%;">Send New Message</button>
    
    </div>
    <div style="width: 80%; float: right;">
    <div id="chat_viewport">
    </div>

    <div id="chat_input" >
        <input id="chat_msg" name="chat_msg" type="text" value="" tabindex="1" placeholder="input here" style="width:90%"/>
        <?php echo anchor('chat', 'send', array('title'=>'send', 'id' => 'submit_msg'));?>
        <div class="clearer"></div>
    </div>
    </div>
    </div>
</body>
