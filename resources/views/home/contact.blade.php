@extends('home.layout.main')
@section('style')
<style type="text/css">
	#back_pg4{
	    background: url(http://melonfree.com/gfx/bgtexture.jpg) repeat scroll 0 0 transparent;
	    color: #6D635D;
	    font-family: Amaranth;
	}
	#page-4 {
		background: url("http://melonfree.com/gfx/fondocontacts.jpg") no-repeat scroll center 5px transparent;
		clear: both;
		height: 575px;
		margin-left: auto;
		margin-right: auto;
		padding-top: 20px;
		text-align: center;
		width: 1200px;
	}
	#page-4 h2 {
		font-size: 36px;
		font-weight: lighter;
		text-align: center;
	}
	#page-4 #contact-container {
		clear: both;
		margin: 0 auto;
		width: 1120px;
	}
	#page-4 #contact-container #left-contact, #page-4 #contact-container #right-contact {
		justify-content: center;
		display: flex;
		float: left;
		text-align: center;
		width: 400px;
	}
	#page-4 #contact-container #left-contact img, #page-4 #contact-container #right-contact img {
		clear: both;
		text-align: center;
	}
	#page-4 #contact-container #left-contact h3, #page-4 #contact-container #right-contact h3 {
		clear: both;
		font-size: 18px;
		margin-bottom: 20px;
	}
	#page-4 #contact-container #form-contact {
		float: left;
		margin-top: 20px;
		width: 320px;
	}
	#page-4 #contact-container #form-contact .input {
		clear: both;
		margin: 0 auto 10px;
		text-align: center;
		width: 241px;
	}
	#page-4 #contact-container #form-contact .inputform {
		background: url("http://melonfree.com/gfx/formtextfield.png") no-repeat scroll 0 0 transparent;
		border: medium none;
		color: #6D635D;
		font-size: 15px;
		font-style: italic;
		height: 40px;
		padding-left: 18px;
		width: 223px;
	}
	#page-4 #contact-container #form-contact .textareaform {
		background: url("http://melonfree.com/gfx/textarea.png") no-repeat scroll 0 0 transparent;
		border: medium none;
		color: #6D635D;
		font-size: 15px;
		font-style: italic;
		height: 130px;
		padding-left: 18px;
		padding-top: 12px;
		resize: none;
		width: 224px;
	}
	#page-4 #contact-container #form-contact .inputform:focus, #page-4 #contact-container #form-contact .textareaform:focus {
		outline: medium none;
	}
	#page-4 #contact-container #form-contact .buttonform {
		background: url("http://melonfree.com/gfx/send237x35.png") no-repeat scroll 0 0 transparent;
		border: medium none;
		color: #FFFFFF;
		font-size: 18px;
		font-style: italic;
		height: 35px;
		width: 237px;
	}
</style>
@endsection
@section('content')
<div id="back_pg4">
	<div id="page-4">
		<div class="contact-us" id="contact-us"></div>
		<h2>Contact Us</h2>
		<p style="color: red;display: none;" id="tag_validator_contact">Vui lòng nhập đầy đủ thông tin</p>
		<p style="color: red;display: none;" id="tag_success_contact">Một email yêu cầu của bạn đã được gửi tới admin</p>
		<div id="contact-container">
			<div id="left-contact">
				<img src="http://melonfree.com/gfx/thedesigner.png" width="180" height="378" alt="The Designer">
				<div id="contact-person"></div>
			</div>
			<div id="form-contact" style="padding-top: 40px">                
				<form action="{{route('source.api.user.contact.send-new')}}" name="contact" id="form_contact" method="POST">
					{{csrf_field()}}
					<div class="input">
						<input type="text" name="name" class="inputform" value="Tên" onfocus="clearText(this)" onblur="clearText(this)">

					</div>
					<div class="input">	<input type="text" name="email" class="inputform" value="E-mail" onfocus="clearText(this)" onblur="clearText(this)">

					</div>
					<div class="input">			
						<input type="text" name="title" class="inputform" value="Subject" onfocus="clearText(this)" onblur="clearText(this)">

					</div>
					<div class="input">
						<textarea onblur="clearText(this)" onfocus="clearText(this)" rows="9" cols="1" class="textareaform" name="content"></textarea>

					</div>
					<div class="input">
						<input name="send" type="submit" class="buttonform" value="Send">

					</div>
				</form>
			</div>
			<div id="right-contact">
				<img src="http://melonfree.com/gfx/developer.png" width="180" height="367" alt="the developer">
			</div> 
		</div>
		<div style="clear:both"></div>
	</div>
</div>

<a href="{{route('contact')}}" style="display: none;" id="redirect-link"></a>
@endsection
@section('script')
<script type="text/javascript">

function loadScripts(scripts) {
    var deferred = jQuery.Deferred();

    function loadScript(i) {
      if (i < scripts.length) {
        jQuery.ajax({
          url: scripts[i],
          dataType: "script",
          cache: true,
          success: function() {
            loadScript(i + 1);
          }
        });
      } else {
        deferred.resolve();
      }
    }
    loadScript(0);

    return deferred;
  }

  var d1 = loadScripts([

  ]).done(function() {
    console.log("All scripts loaded1");

  });

    // queue #2 - jquery cycle2 plugin and tile effect plugin
    var d2 = loadScripts([
    ]).done(function() {
       
    });

    // trigger a callback when all queues are complete
    jQuery.when(d1, d2).done(function() {
        
    });
    
</script>
<script type="text/javascript">
	jQuery(function($) {
        $('#form_contact').on('submit',function(e){
        	$('#tag_success_contact').css('display','none');
        	$('#tag_validator_contact').css('display','none');
            e.preventDefault();
            $.ajax({
              url:"{{route('source.api.user.contact.send-new')}}",
              method:"POST",
              data:new FormData(this),
              dataType:'JSON',
              contentType: false,
              cache: false,
              processData: false,
              success:function(data){
                if (data.message == "success") {
                    $('#tag_success_contact').css('display','block');
                }else if(data.message == "validator"){
                    $('#tag_validator_contact').css('display','block');
                }else{
                }
              },
              error:function(jqXHR, textStatus, errorThrown) {
              }
            });
        });
    });
</script>
@endsection
