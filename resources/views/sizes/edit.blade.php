<form action="{{route('sizes.update',$size->id)}}" method="post">
	<input type="hidden" name="_method" value="put">
	@csrf
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<label>Size</label>
				<input type="text" class="form-control" value="{{$size->size}}" name="size" required>
			</div>
			<div class="form-group">
				<label>Category</label>
				<select class="form-control" name="category">
					@foreach(App\Category::all() as $category)
						<option value="{{$category->id}}" {{($category->id == $size->category->id) ? 'selected' : ''}}>{{$category->title}}</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="col-md-12">
			<button type="submit" class="btn btn-success bs_dashboard_btn bs_btn_color btn-block">UPDATE</button>
		</div>
	</div>
</form>