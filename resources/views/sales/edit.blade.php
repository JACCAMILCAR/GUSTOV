@extends('layouts.master')
@section('content')
<h2>Edit Sale</h2>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="/sales/{{ $id }}" method="POST" enctype="multipart/form-data">
    @method('PATCH')
    @csrf()
    <div class="row">
        <div class="col-md-4">
            <label for="nameCostumer">Name Costumer</label>
            <input type="text" name="nameCostumer" class="form-control" id="nameCostumer" placeholder="Enter name costumer" value="{{ $sales[0]->nameCostumer }}">
        </div>
        <div class="col-md-4">
            <label for="nit">NIT</label>
            <input type="text" name="nit" class="form-control" id="nit" placeholder="Enter nit" value="{{ $sales[0]->nit }}">
        </div>
        <div class="col-md-4">
            <label for="phoneCostumer">Phone Costumer</label>
            <input type="text" name="phoneCostumer" class="form-control" id="phoneCostumer" placeholder="Enter phone costumer" value="{{ $sales[0]->phoneCostumer }}">
        </div>
    </div>
    <input type="hidden" name="receiptGustov" id="receiptGustov" value="{{$id}}">
    <div class="row">
                    <div class="col-md-4">
						<div class="form-group">
							<label for="articulo">Menu</label>
							<select name="pid_producto" id="pid_producto" class="form-control selectpicker" data-live-search="true">
								<option value="">Select Menu</option>
								@foreach($menus as $menu)
									<option data-producto-id="{{$menu->id}}" value="{{$menu->id}}">
										 {{$menu->name}}
									</option>
								@endforeach
							</select>
						</div>
					</div>
                    <div class="col-md-4">
						<div class="form-group">
							<label for="">Menu Price BS</label>
							<div id="permissions_box">
								<div id="permissions_checkbox_list">

								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="quantity">Quantity</label>
							<input type="number" name="cantidad" id="cantidad" class="form-control" oninput="this.value = Math.max(this.value, 0)">
						</div>
					</div>
                    <div class="col-md-6">
						<div class="form-group">
							<button type="button" id="bt_add" class="btn btn-dark">Add</button>
						</div>
					</div>						
						<div class="col-md-12">
							<table id="detalles" class="table table-striped table-bordered table-hover table-condensed" style="margin-top: 10px">
								<thead style="background-color: white">
									<th>Options</th>
									<th>Menu</th>
									<th>Description</th>
									<th>Quantity</th>
									<th>Price</th>
									<th>Subtotal</th>
								</thead>
								<tfoot>
									<th>Total</th>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
									<th><h5 id="total" name="total">0.00</h5></th>
								</tfoot>
								<tbody>
									
								</tbody>
							</table>
						</div>
		<div class="col-md-6" id="save">
			<div class="form-group">
				<br>
				<button class="btn btn-primary" type="submit">Edit Sale</button>
				<a href="{{ url()->previous() }}" class="btn btn-primary">Cancel</a>
			</div>
		</div>
	</div>
</form>
@section('js_sale')
	<script>
			$(document).ready(function(){
				var permissions_box = $('#permissions_box');
				var permissions_checkbox_list = $('#permissions_checkbox_list');
				permissions_box.hide();
				$('#pid_producto').on('change', function(){
					var pid_producto = $(this).find(':selected');
					var menu_id = pid_producto.data('producto-id');
					permissions_checkbox_list.empty();
					$.ajax({
						url:"/sales/create",
						method:'get',
						dataType: 'json',
						data:{
							menu_id: menu_id,
						}
					}).done(function(data){
						permissions_box.show();
						$(permissions_checkbox_list).append(
								'<div class="form-group">'+
									'<input type="text" value="'+data+'" class="form-control" id="price" disabled/>'+
								'</div>'
						);
					});
				});
			});
	</script>
	<script>
		var limit = 1;
		$(document).ready(function() {
			setTimeout(clickbutton, 1);
			function clickbutton() {
				add();
			}
		});
		$(document).ready(function(){
			$("#bt_add").click(function(){
				add();
			});
		});
		var cont = 0;
		var total = 0;
		var subtotal = [];
		var aux = [];
		var aux2 = [];
		var valor = 0;
		var id_articulo = [];
		var price = [];
		var quantity =  [];
		$("#save").hide();
		function add(){
			if(limit==1){
				<?php for($i=0; $i < count($sales); $i++){?>
					id_articulo[cont] = <?php echo $sales[$i]->idMenu?>;
					articulo = '<?php echo $sales[$i]->name?>';
					quantity[cont] = <?php echo $sales[$i]->quantity?>;
					aux2[cont] = <?php echo $sales[$i]->quantity?>;
					price[cont] = <?php echo $sales[$i]->price?>;
					description = '<?php echo $sales[$i]->description?>';
					subtotal[cont] = (quantity[cont] * price[cont]);
					total = total + subtotal[cont];
					var fila = '<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-danger" onclick="deleteRow('+cont+')">X</button></td><td><input type="hidden" name="id_articulo[]" value="'+id_articulo[cont]+'">'+articulo+'</td><td class="text-center"><input type="text" name="description[]" value="'+description+'"/></td><td class="text-center"><input type="number" name="quantity[]" id="quantity'+cont+'" value="'+quantity[cont]+'" onclick="updateRow('+cont+')" onkeyup="updateRow('+cont+')" min="0" oninput="this.value = Math.max(this.value, 0)" step="any"></td><td class="text-center"><input type="hidden" name="price[]" id="price'+cont+'" value="'+price[cont]+'" onclick="updateRow('+cont+')" onkeyup="updateRow('+cont+')" min="0"	oninput="this.value = Math.max(this.value, 0)" step="any">'+price[cont]+'</td><td> <h5 type="number" name="subtotal" id="subtotal'+cont+'">'+subtotal[cont]+'</h5></td></tr>';
					cont++;
					cleanUp();
					$("#total").html("Bs " + total);
					assess();
					$("#detalles").append(fila);
				<?php } ?>
				limit = 0;
			}else{
				id_articulo[cont] = $("#pid_producto").val();
				articulo = $("#pid_producto option:selected").text();
				quantity[cont] = $("#cantidad").val();
				price[cont] = $("#price").val();
				if(id_articulo[cont] != "" && quantity[cont] > 0  && price[cont] != ""){
					//subtotal array initial 0
					subtotal[cont] = (quantity[cont] * price[cont]);
					total = total + subtotal[cont];
					var fila = '<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-danger" onclick="deleteRow('+cont+')">X</button></td><td><input type="hidden" name="id_articulo[]" value="'+id_articulo[cont]+'">'+articulo+'</td><td class="text-center"><input type="text" name="description[]"/></td><td class="text-center"><input type="number" name="quantity[]" id="quantity'+cont+'" value="'+quantity[cont]+'" onclick="updateRow('+cont+')" onkeyup="updateRow('+cont+')" min="0" oninput="this.value = Math.max(this.value, 0)" step="any"></td><td class="text-center"><input type="hidden" name="price[]" id="price'+cont+'" value="'+price[cont]+'" onclick="updateRow('+cont+')" onkeyup="updateRow('+cont+')" min="0" oninput="this.value = Math.max(this.value, 0)" step="any">'+price[cont]+'</td><td> <h5 type="number" name="subtotal" id="subtotal'+cont+'">'+subtotal[cont]+'</h5></td></tr>';
					cont++;
					cleanUp();
					$("#total").html("Bs " + total);
					assess();
					$("#detalles").append(fila);
				}else{
					alert("Error when entering the detail of the income, check the data of the menu.");
				}
			}
		}
		function cleanUp(){
			$("#cantidad").val("");
		}
		function assess(){
			if(total > 0){
				$("#save").show();
			}else{
				$("#save").hide();
			}
		}
		function deleteRow(index){
			total = total-subtotal[index];
			$("#total").html("$" + total);
			$("#fila" + index).remove();
			assess();
		}
		function updateRow(index){
			var menu_id = id_articulo[index];
			$.ajax({
				url:"/sales/create",
				method:'get',
				dataType: 'json',
				data:{
					menu_id: menu_id,
				}
			}).done(function(data){
				if(aux2[index]==null){
					valor = data +1;
				}else{ 
					valor = aux2[index] + data +1;
				}
				quantity[index] = $("#quantity"+index).val();
				price[index] = $("#price"+index).val();
				
					aux[index] = quantity[index] * price[index];
					total = total - subtotal[index];
					subtotal[index] = aux[index];
					$("#subtotal"+index).html(subtotal[index]);
					total = total + subtotal[index];
					$("#total").html("$" + total);
					assess();
			});					
		}
	</script>
@endsection
@endsection