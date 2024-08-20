<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}-Tender's List</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- FontAwesome CDN --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />

</head>
<body>
	<div class="container">
		<div class="row mt-5">
			<div class="col-md-10 offset-1">
				<div class="card">
					<div class="card-header"><h3>Tenders</h3></div>
					<div class="card-body">
						<table class="table">
							<thead class="head">
								<tr align="center">
									<td>Title</td>
                                    <td>Description</td>
                                    <td>Due Date</td>
								</tr>
                            </thead>
                            <tbody id="tendorbody">

                            </tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
    </div>

    <div id="modals">

    </div>
    {{-- <!-- Modal Approve -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

        </div>
        <div class="modal-footer">
        <a class="btn btn-dark" style="color:#fff;">Apply</a>
        <button id="sbmt-approved-by" type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div> --}}

	{{-- <script type="text/javascript" src="jquery/jquery.min.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script> --}}
	<script>
		$(document).ready(function() {
            // var table_row_string = "";

            // setInterval(get_tenders,2000);
            get_tenders();
            function get_tenders(){
                // console.log('interval');
                var table_row_string = "";
                var modal_string = "";
                $.ajax({
                    url: 'http://vendorms.zac/api/tendors',
                    type: 'GET',
                    dataType: 'json',
                    contentType: 'application/json; charset=utf-8',
                    success: function(response){
                        for(var i = 0; i < response.length; i++){
                            table_row_string += "<tr align='center' class=\"refresh-row\"><span hidden=\"hidden\">"+response[i].obfuscator+"</span><td><a href=\"#\" data-toggle=\"modal\" data-target=\"#exampleModal"+i+"\" id=\"tender-display\">"+response[i].title+"</a></td><td>"+response[i].description+"</td><td>"+response[i].due_date+"<td></tr>";

                            modal_string+='<div class="modal fade" id="exampleModal'+i+'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="exampleModalLabel">'+response[i].title+'</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body"><h3><span class="font-weight-bold">ID:</span> '+response[i].obfuscator.toUpperCase()+'</h3><p class="text-secondary"><span class="font-weight-bold">Created:</span> '+response[i].created_at+'</p><p class="text-secondary"><span class="font-weight-bold">Due Date:</span> '+response[i].due_date+'</p><div class="row"><div class="col-md-10 offset-1 text-secondary"><p>Description</p><hr>'+response[i].description+'</div></div><hr><h3 class="mb-4">File(s)</h3><a href="../../storage/tenders/'+response[i].file+'" class="btn btn-outline-success rounded-0">View File</a></div><div class="modal-footer"><a href="http://vendorms.zac/tender_details/'+response[i].obfuscator+'" class="btn btn-dark" style="color:#fff;">Details</a><button id="sbmt-approved-by" type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button></div></div></div></div>';
                        }

                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown){
                        console.log("Status: " + textStatus); console.log("Error: " + errorThrown);
                    },
                }).done(function(){
                    $("#tendorbody").html(table_row_string);
                    $('#modals').html(modal_string);

                });
            }

            // $("a#tender-display").on('click', function(e){
            //     e.preventDefault();
            //     var obfuscator = $(this).find("span").val();
            //     console.log("Obf:"+obfuscator);
            //     // $.ajax({
            //     //     url: 'http://vendorms.zac/api/tender-details/',
            //     //     type: 'GET',
            //     //     dataType: 'json',
            //     //     contentType: 'application/json; charset=utf-8',
            //     //     success: function(response){
            //     //     },
            //     //     error: function(XMLHttpRequest, textStatus, errorThrown){
            //     //         console.log("Status: " + textStatus); console.log("Error: " + errorThrown);
            //     //     },
            //     // }).done(function(){


            //     // });
            // });
		});
	</script>
</body>
</html>
