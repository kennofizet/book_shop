<div id="footer-wp">
    <div class="wp-inner">
        <p id="copyright">2018 © Admin create by .....</p>
    </div>
</div>
</div>
</div>
<script src="{{url('/')}}/notification/bootstrap-growl.min.js"></script>
    <script src="{{url('/')}}/notification/notification-active.js"></script>
    <script type="text/javascript">
    function pushNotify(status,style,mess) {

        $('#' + 'id_tag_notification_' + status + '_default_style' + style).attr('data-mess',mess);
        $('#' + 'id_tag_notification_' + status + '_default_style' + style).click();
    }
    </script>
</body>
</html>
