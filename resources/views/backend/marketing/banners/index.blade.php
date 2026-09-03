@extends('backend.layouts.app')
@section('content')

<div class="row">
	<div class="col-xl-10 mx-auto">
		<h6 class="fw-600">{{ translate('Home Banners') }}</h6>

		{{-- Main Slider --}}
		<div class="card">
			<div class="card-header">
				<h6 class="mb-0">{{ translate('Main Slider') }}</h6>
			</div>
			<div class="card-body">
				<div class="alert alert-info">
					{{ translate('Minimum 664 px or higher X 490px') }}.
				</div>
				<table class="table aiz-table mb-4">
					<thead>
						<tr>
							<th data-breakpoints="lg">#</th>
							<th>{{ translate('Image') }}</th>
							<th>{{ translate('Link') }}</th>
							<th data-breakpoints="lg">{{ translate('Status') }}</th>
							<th class="text-right">{{ translate('Options') }}</th>
						</tr>
					</thead>
					<tbody>
						@forelse ($sliders as $key => $banner)
							<tr>
								<td>{{ $key + 1 }}</td>
								<td><img src="{{ uploaded_asset($banner->image) }}" alt="banner" class="h-50px"></td>
								<td>{{ $banner->link }}</td>
								<td>
									<label class="aiz-switch aiz-switch-success mb-0">
										<input onchange="update_banner_status(this)" value="{{ $banner->id }}" type="checkbox" @if($banner->status == 1) checked @endif>
										<span class="slider round"></span>
									</label>
								</td>
								<td class="text-right">
									<a href="#" class="btn btn-square btn-soft-primary btn-sm" data-toggle="modal" data-target="#edit-banner-{{ $banner->id }}">
										<i class="la la-edit"></i>
									</a>
									<a href="{{ route('banners.destroy', $banner->id) }}" class="btn btn-square btn-soft-danger btn-sm confirm-delete" data-href="{{ route('banners.destroy', $banner->id) }}">
										<i class="la la-trash"></i>
									</a>
								</td>
							</tr>
						@empty
							<tr>
								<td colspan="5" class="text-center">{{ translate('No banner added yet') }}</td>
							</tr>
						@endforelse
					</tbody>
				</table>

				<form action="{{ route('banners.store') }}" method="POST" enctype="multipart/form-data">
					@csrf
					<input type="hidden" name="position" value="slider">
					<div class="row gutters-5">
						<div class="col-md-5">
							<div class="form-group">
								<div class="input-group" data-toggle="aizuploader" data-type="image">
									<div class="input-group-prepend">
										<div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
									</div>
									<div class="form-control file-amount">{{ translate('Choose File') }}</div>
									<input type="hidden" name="image" class="selected-files">
								</div>
								<div class="file-preview box sm"></div>
							</div>
						</div>
						<div class="col-md">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="http://" name="link">
							</div>
						</div>
						<div class="col-md-auto">
							<button type="submit" class="btn btn-soft-secondary btn-sm">{{ translate('Add New') }}</button>
						</div>
					</div>
				</form>
			</div>
		</div>

		{{-- Side Banners --}}
		<div class="card">
			<div class="card-header">
				<h6 class="mb-0">{{ translate('Side Banners (Max 2)') }}</h6>
			</div>
			<div class="card-body">
				<table class="table aiz-table mb-4">
					<thead>
						<tr>
							<th data-breakpoints="lg">#</th>
							<th>{{ translate('Image') }}</th>
							<th>{{ translate('Link') }}</th>
							<th data-breakpoints="lg">{{ translate('Status') }}</th>
							<th class="text-right">{{ translate('Options') }}</th>
						</tr>
					</thead>
					<tbody>
						@forelse ($side_boxes as $key => $banner)
							<tr>
								<td>{{ $key + 1 }}</td>
								<td><img src="{{ uploaded_asset($banner->image) }}" alt="banner" class="h-50px"></td>
								<td>{{ $banner->link }}</td>
								<td>
									<label class="aiz-switch aiz-switch-success mb-0">
										<input onchange="update_banner_status(this)" value="{{ $banner->id }}" type="checkbox" @if($banner->status == 1) checked @endif>
										<span class="slider round"></span>
									</label>
								</td>
								<td class="text-right">
									<a href="#" class="btn btn-square btn-soft-primary btn-sm" data-toggle="modal" data-target="#edit-banner-{{ $banner->id }}">
										<i class="la la-edit"></i>
									</a>
									<a href="{{ route('banners.destroy', $banner->id) }}" class="btn btn-square btn-soft-danger btn-sm confirm-delete" data-href="{{ route('banners.destroy', $banner->id) }}">
										<i class="la la-trash"></i>
									</a>
								</td>
							</tr>
						@empty
							<tr>
								<td colspan="5" class="text-center">{{ translate('No banner added yet') }}</td>
							</tr>
						@endforelse
					</tbody>
				</table>

				@if ($side_boxes->count() < 2)
					<form action="{{ route('banners.store') }}" method="POST" enctype="multipart/form-data">
						@csrf
						<input type="hidden" name="position" value="side_box">
						<div class="row gutters-5">
							<div class="col-md-5">
								<div class="form-group">
									<div class="input-group" data-toggle="aizuploader" data-type="image">
										<div class="input-group-prepend">
											<div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
										</div>
										<div class="form-control file-amount">{{ translate('Choose File') }}</div>
										<input type="hidden" name="image" class="selected-files">
									</div>
									<div class="file-preview box sm"></div>
								</div>
							</div>
							<div class="col-md">
								<div class="form-group">
									<input type="text" class="form-control" placeholder="http://" name="link">
								</div>
							</div>
							<div class="col-md-auto">
								<button type="submit" class="btn btn-soft-secondary btn-sm">{{ translate('Add New') }}</button>
							</div>
						</div>
					</form>
				@endif
			</div>
		</div>
	</div>
</div>

@endsection

@section('modal')
	@foreach ($sliders->merge($side_boxes) as $banner)
		<div id="edit-banner-{{ $banner->id }}" class="modal fade" role="dialog">
			<div class="modal-dialog modal-dialog-centered modal-dialog-zoom" role="document">
				<div class="modal-content">
					<div class="modal-header bord-btm">
						<h4 class="modal-title h6">{{ translate('Edit Banner') }}</h4>
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
					</div>
					<form action="{{ route('banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
						@csrf
						@method('PUT')
						<div class="modal-body">
							<div class="form-group">
								<label>{{ translate('Image') }}</label>
								<div class="input-group" data-toggle="aizuploader" data-type="image">
									<div class="input-group-prepend">
										<div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
									</div>
									<div class="form-control file-amount">{{ translate('Choose File') }}</div>
									<input type="hidden" name="image" value="{{ $banner->image }}" class="selected-files">
								</div>
								<div class="file-preview box sm"></div>
							</div>
							<div class="form-group">
								<label>{{ translate('Link') }}</label>
								<input type="text" class="form-control" placeholder="http://" name="link" value="{{ $banner->link }}">
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-styled btn-base-3" data-dismiss="modal">
								{{ translate('Close') }}
							</button>
							<button type="submit" class="btn btn-primary btn-styled btn-base-1">
								{{ translate('Save') }}
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	@endforeach

	@include('modals.delete_modal')
@endsection

@section('script')
	<script type="text/javascript">
		function update_banner_status(el) {
			$.post('{{ route('banners.update_status') }}', {
				_token: '{{ csrf_token() }}',
				id: $(el).val(),
				status: $(el).is(':checked') ? 1 : 0
			});
		}
	</script>
@endsection
