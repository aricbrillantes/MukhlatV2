<!-- Chat (Module from GetBetter)-->
<div id="chat-area" class="row" style = "z-index: 9999;">
    <div id="contacts" class="dropup">
        <button class="btn btn-default disabled" data-toggle="dropdown">
            Talk to others!<span class="badge"></span>
        </button>
        <ul class="dropdown-menu" role="menu">
            <li class="chat-contact" user-id="1" user-session="">
                <a href="javascript:void(0);">
                    Juan Dela Cruz
                </a>
            </li>
            <!--
        <li class="text-center">
            No Online Doctors
        </li>-->
            <li class="divider">
            </li>
            <span class="offline text-center">
                Offline
            </span>
            <li class="chat-contact" user-id="3" user-session="">
                <a href="javascript:void(0);">
                    Momsie Dela Cruz
                </a>
                <span class="specialty">
                </span>
            </li>
        </ul>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url("/js/chat.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("/js/chat_client.js"); ?>"></script>
<script type="text/javascript">chat_dialog = '<?php $this->load->view('chat/chat_dialog', null, true) ?>'</script>

</body>
</html>