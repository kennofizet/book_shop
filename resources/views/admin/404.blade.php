@extends('admin.layout.main')

@section('content')
<h1>404 page</h1>
@endsection
@section('script')
<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>

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
        console.log("All scripts loaded2");
        
    });

    // trigger a callback when all queues are complete
    jQuery.when(d1, d2).done(function() {
      console.log("All scripts loaded");
    });
    body_script("{{url('/')}}/admin/js/main.js");
</script>

@endsection
