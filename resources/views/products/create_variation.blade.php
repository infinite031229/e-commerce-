@extends('layouts.app')
@section('title', 'Dashboard - Create Variation')
@section('content')
<div class="content container-fluid">

	<!-- Page Header -->
	<div class="page-header">
		<div class="row">
			<div class="col">
				<h3 class="page-title">Create Variation</h3>
				<ul class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
					<li class="breadcrumb-item active">Create Variation</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Variation Details</h4>
				</div>
				<div class="card-body">
					@foreach($errors->all() as $error)
                    <span style="color:red">{{$error}}</span>
					
					@endforeach
					<form action="{{route('product.variations.store')}}" method="post" enctype="multipart/form-data">
						@csrf
                        <input name="product_id" value="{{$product_id}}" hidden/>
						<div class="row">
							
							
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-6">	
                                        <div class="form-group">
                                            <label>Variation</label>
                                            <select class="form-control @error('variation') is-invalid @enderror" id="variation" data-route="" name="variations[]" multiple >
                                                <option value="">Choose Variation</option>
                                                @foreach(App\Variation::all() as $variation)
                                                    <option value="{{$variation->id}}">{{ucwords($variation->title)}}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('variation'))
                                                @foreach($errors->get('variation') as $message)
                                                <span style="color:red">{{$message}}</span>
                                                @endforeach
                                            @endif
                                        </div>
									</div>
									<div class="col-md-6">
                                        <div class="form-group">
                                            <label>Size</label>
                                            <select class="form-control @error('color') is-invalid @enderror" id="color" data-route="" name="sizes[]" multiple >
                                                <option value="">Choose Size</option>
                                                @foreach(App\Size::all() as $size)
                                                    <option value="{{$size->id}}">{{ucwords($size->size)}}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('size'))
                                                @foreach($errors->get('size') as $message)
                                                <span style="color:red">{{$message}}</span>
                                                @endforeach
                                            @endif
                                        </div>
									</div>
								</div>
							</div>
							
							<!-- <div class="col-md-6">
								<div class="row">
									<div class="col-md-6">	
										<div class="form-group">
											<label>Price ($)</label>
											<input type="text" value="{{ old('price') }}" id="price" name="price" class="form-control product_prices" required>
											@if($errors->has('price'))
					                            @foreach($errors->get('price') as $message)
					                              <span style="color:red">{{$message}}</span>
					                            @endforeach
					                        @endif
										</div>
									</div>
									
								</div>
							</div>
							 -->
							<div class="col-md-12">
								<div class="row" id="more_details" style="display: none;"></div>
							</div>
							<!-- <div class="col-md-12">
								<div class="input-images"></div>
								<br>
								@if($errors->has('images'))
		                            @foreach($errors->get('images') as $message)
		                              <span style="color:red">{{$message}}</span>
		                            @endforeach
		                        @endif
							</div> -->
							<div class="col-md-12">
							
							</div>
							<!-- <div class="col-md-12">
								@if($errors->has('description'))
		                            @foreach($errors->get('description') as $message)
		                              <span style="color:red">{{$message}}</span>
		                            @endforeach
		                        @endif
								<textarea rows="8" name="description" class="form-control summernote @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
							</div> -->
						</div>
						<div class="text-right">
							<button type="submit" class="btn btn-lg btn-success bs_dashboard_btn bs_btn_color">UPLOAD</button>
						</div>
					</form>
						<div class="col-sm-12">
								<div class="card">
									
									<div class="card-body">

										<div class="table-responsive">
											
											<form action="{{route('product.variations.bulk_delete')}}" method="POST" id="deleteAll">
												@csrf
												<input type="hidden" name="items" id="bs_items_forbulkDelete">
											</form>
											
											<table class="datatable table table-stripped">
												<thead>
													<tr>
														
														<th>
															<input type="checkbox" id="checkAll"> 
														</th>
														<th>Count</th>
														<th>Title</th>
														<th>Sub Title</th>
														<th>Size</th>
														<th>Price</th>
														<th>Description</th>
														<th>Created On</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
												<?php $count = 1; ?>
													@foreach($variations as $variation)
												
													
													<tr>
													<form action="{{route('product.variations.edit_var')}}" method="post">
													@csrf
														<td style="padding:10px 18px;">
															<input type="checkbox" value="{{$variation->id}}" class="bs_dtrow_checkbox bs_checkItem">
															<input value="{{$variation->id}}" hidden name="id"/>
														</td>
														
														<td><?=$count++?></td>
														<td>{{ucwords($variation->variation->title)}}</td>
														<td>
														{{ucwords($variation->variation->sub_title)}}
														</td>
														<td>
														{{ucwords($variation->size->size)}}
														</td>
														<td>
														<input name="price" value="{{$variation->price}}"/>
														<!-- {{currency($variation->price, 'USD')}} -->
														</td>
														<td>
														<input name="description" value="{{$variation->description}}"/>
														<!-- {{currency($variation->price, 'USD')}} -->
														</td>
														<td>{{$variation->created_at->format('d-m-Y')}}</td>
														<td>
															<div class="actions">
																
																<button type="submit" class="btn btn-sm bg-success-light mr-2">
																	<i class="fe fe-pencil"></i> Save
																</button>

																<a href="{{route('product.variations.delete_var',$variation->id)}}" class="btn btn-sm bg-danger-light bs_delete" data-route="{{route('product.variations.delete_var',$variation->id)}}">
																	<i class="fe fe-trash"></i> Delete
																</a>
																
																
															</div>
														</td>
														</form>
													</tr>
													
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div> 
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('javascript')
<script type="text/javascript">
$(document).ready(function () {
	$('.input-images').imageUploader({Default: ['image/jpeg', 'image/png', 'image/gif', 'image/svg+xml']});
})
</script>
@endsection