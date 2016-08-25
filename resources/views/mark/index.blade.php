@extends('layouts.master')

@section('title','Lista de Marcas')

@section('content')

     
  <ol class="breadcrumb">
     <li><a href="{{url('dashboard')}}">Escritorio</a></li>
     <li class="active">Marcas</li>
   </ol>
 

   <div class="page-header">
     <h1>Marcas <small>Actualizados hasta hoy</small></h1>
   </div>

   <div class="row">
     <div class="col-md-8">

       @include('partials.messages') 
        <div class="panel panel-default">
          <div class="panel-heading">
             Lista
             <p class="navbar-text navbar-right" style=" margin-top: 1px;">
                <button type="button" id='nuevo'  name='nuevo' class="btn btn-warning navbar-btn" style="margin-bottom: 1px; margin-top: -5px;margin-right: 8px;padding: 3px 20px;">Nuevo</button>
             </p>
           </div>
          <div class="panel-body">
               <div id="list-mark"></div>


          </div>
        </div>


     </div>
   </div>

<script  type="text/javascript">


    $(document).ready(function(){
        listmark();
    });


    $(document).on("click",".pagination li a",function(e) {
        e.preventDefault();

        var url = $(this).attr("href");

        $.ajax({
            type:'get',
            url:url,
            success: function(data){
                $('#list-mark').empty().html(data);
            }
        });

    });




    $("#nuevo").click(function(event)
  {
      document.location.href = "{{ route('mark.create')}}";
  });

  var listmark = function()
  {
      $.ajax({
          type:'get',
          url:'{{ url('listallmark')}}',
          success: function(data){
              $('#list-mark').empty().html(data);
          }
      });
  }


</script>
  
@endsection
