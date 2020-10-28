@extends('home.layout.main')

@section('content')
<h1>about page</h1>
<script type="text/javascript">
  $('.key_search_home').on('keyup',function (e) {
    if ($(this).val()) {
        $('#link-search').attr('href',"{{url('/')}}/search/"+$(this).val());
        $('#link-search').click();
    }
  });
</script>
@endsection
