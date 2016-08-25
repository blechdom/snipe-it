@extends('layouts/default')

{{-- Page title --}}
@section('title')
{{ trans('admin/hardware/general.view') }} {{ $asset->asset_tag }}
@parent
@stop

{{-- Account page content --}}
@section('content')


<div class="row">
    <div class="col-md-12">

  <!-- Custom Tabs -->
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active">
          <a href="#details" data-toggle="tab"><span class="hidden-lg hidden-md"><i class="fa fa-info-circle"></i></span> <span class="hidden-xs hidden-sm">Details</span></a>
        </li>
      </ul>
      <div class="tab-content">

<div class="tab-pane fade in active" id="details">
          <div class="row">
          <div class="col-md-8">
            <div class="table-responsive" style="margin-top: 10px;">
              <table class="table">
                  <tbody>
                  @if ($asset->company)
                      <tr>
                          <td>{{ trans('general.company') }}</td>
                          <td>{{ $asset->company->name }}</td>
                      </tr>
                  @endif
                    @if ($asset->name)
                    <tr>
                      <td>{{ trans('admin/hardware/form.name') }}</td>
                      <td>{{ $asset->name }}</td>
                    </tr>
                    @endif
                    @if ($asset->serial)
                    <tr>
                      <td>{{ trans('admin/hardware/form.serial') }}</td>
                      <td>{{ $asset->serial  }}</td>
                    </tr>
                    @endif
                    @if ($asset->model->manufacturer)
                      <tr>
                        <td>{{ trans('admin/hardware/form.manufacturer') }}</td>
                        <td>
                          {{ $asset->model->manufacturer->name }}
                        </td>
                      </tr>
                      <tr>
                        <td>{{ trans('admin/hardware/form.model') }}</td>
                        <td>
                          {{ $asset->model->name }}
                         </td>
                      </tr>
                      <tr>
                        <td>{{ trans('admin/models/table.modelnumber') }}</td>
                        <td>
                          {{ $asset->model->modelno }}
                         </td>
                      </tr>
                    @endif

               <!--     @if ($asset->model->fieldset)
                    @foreach($asset->model->fieldset->fields as $field)
                      <tr>
                        <td>{{ $field->name }}</td>
                        <td>
			   {{ $asset->{$field->db_column_name()} }}
                         </td>
                      </tr>
                      @endforeach
                    @endif   -->
		   @if ($asset->expected_checkin!='')
                      <tr>
                        <td>{{ trans('admin/hardware/form.expected_checkin') }}</td>
                        <td>
                          {{ $asset->expected_checkin }}
                         </td>
                      </tr>
                   @endif
                   <tr>
                      <td>{{ trans('admin/hardware/form.notes') }}</td>
                      <td> {!! nl2br(e($asset->notes)) !!}</td>
                    </tr>
 @if (($asset->status_id ) && ($asset->status_id > 0))
                @if ($asset->assetstatus)

<tr><td>Status</td>
                        @if (($asset->assetstatus->deployable=='1') && ($asset->assigned_to > 0))
                           <td>Checked Out</td>
                        @else
                       <td>     {{{ $asset->assetstatus->name }}}</td>
                        @endif
</tr>
                 @endif
            @endif
  @if (($asset->assigneduser) && ($asset->assigned_to > 0) && ($asset->deleted_at==''))
            <tr>    <td>{{ trans('admin/hardware/form.checkedout_to') }}</td><td>
                <p><img src="{{ $asset->assigneduser->gravatar() }}" class="user-image-inline" alt="{{ $asset->assigneduser->fullName() }}">
                {{ $asset->assigneduser->fullName() }}</p></td></tr>

                                  @endif

 @if (count($asset->uploads) > 0)
 <tr><td colspan=2>	<table class="table table-hover">
                <thead>
                    <tr>
                        <th class="col-md-4"><span class="line"></span>{{ trans('general.file_name') }}</th>
                        <th class="col-md-2"></th>
			<th class="col-md-2"></th>
			<th class="col-md-4">{{ trans('general.notes') }}</th>
                    </tr>
                </thead>
                <tbody>
                        @foreach ($asset->uploads as $file)
                        <tr>
                            <td>
                                {{ $file->filename }}
                            </td>
			  <td>
                                @if ( \App\Helpers\Helper::checkUploadIsImage($file->get_src('assets')))
                                     <a href="../{{ $asset->id }}/showfile/{{ $file->id }}" data-toggle="lightbox" data-type="image"><img src="../{{ $asset->id }}/showfile/{{ $file->id }}" class="img-thumbnail" style="max-width: 50px;"></a>
                                @endif
                            </td>
                            <td>
                                @if ($file->filename)
                                <a href="{{ route('show/assetfile', [$asset->id, $file->id]) }}" class="btn btn-default">{{ trans('general.download') }}</a>
                                @endif
 			    <td>
                                @if ($file->note)
                                    {{ $file->note }}
                                @endif
                            </td>
                        </tr>
                        @endforeach


                </tbody>
            </table></td></tr>
@endif

 	<tr>
       		<td></td>	<td>
			<div style=" white-space: nowrap;"><a href="/account/request-asset/{{{ $asset->id }}}" class="btn btn-info btn-sm" title="Request">Request</a></div>
		</td>
	</tr>
                  </tbody>
              </table>
            </div> <!-- /table-responsive -->
          </div><!-- /col -->

          <div class="col-md-4">

              @if ($asset->image)
                  <img src="{{ Config::get('app.url') }}/uploads/assets/{{{ $asset->image }}}" class="assetimg">
              @else
                  @if ($asset->model->image!='')
                      <img src="{{ Config::get('app.url') }}/uploads/models/{{{ $asset->model->image }}}" class="assetimg">
                  @endif
              @endif

              @if  (App\Models\Setting::getSettings()->qr_code=='1')
                 <img src="{{ config('get.url') }}/hardware/{{ $asset->id }}/qr_code" class="img-thumbnail pull-right" style="height: 100px; width: 100px; margin-right: 10px;">
              @endif

          </div>
        </div><!-- /row -->
        </div><!-- /.tab-pane -->



</div>

</div>

@stop
