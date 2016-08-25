@extends('layouts/default')

{{-- Page title --}}
@section('title')
View Assets for  {{ $user->fullName() }}
@parent
@stop

{{-- Account page content --}}
@section('content')

  <div class="row">
    <div class="col-md-12">
      <div class="box box-default">

          @if ($user->id)
            <div class="box-header with-border">
              <div class="box-heading">
                <h3 class="box-title"> Keys and Lockers assigned to {{$user->first_name }}</h3>
              </div>
            </div><!-- /.box-header -->
          @endif

        <div class="box-body">
          <!-- checked out assets table -->
          @if (count($user->keys) > 0)
            <div class="table-responsive">
              <table class="table table-striped">
                  <thead>
                      <tr>
                          <th class="col-md-3">Keys and Lockers</th>
                          <th class="col-md-2">{{ trans('admin/hardware/table.asset_tag') }}</th>
                          <th class="col-md-3">{{ trans('general.name') }}</th>
			  <th class="col-md-2">Image</th>
                          <th class="col-md-2">Combo</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($user->keys as $key)

			<tr>
                          <td>
                          @if ($key->physical=='1') {{ $key->model->name }}
                          @endif
                          </td>
                          <td>{{ $key->asset_tag }}</td>
                          <td>{{ $key->name }}</td>
                          <td>

                          @if (($key->image) && ($key->image!=''))
                            <img src="{{ config('app.url') }}/uploads/assets/{{ $key->image }}" height="50">

                          @elseif (($key->model) && ($key->model->image!=''))
                            <img src="{{ config('app.url') }}/uploads/models/{{ $key->model->image }}" height="50">
                          @endif

                         </td>
			<td>

                          @if ($key->_snipeit_locker_combo)
                            {{ $key->_snipeit_locker_combo }}
			@endif
                         </td>
                      </tr>
                      @endforeach
                  </tbody>
              </table>
            </div>
          @else

          <div class="col-md-12">
              <div class="alert alert-info alert-block">
                  <i class="fa fa-info-circle"></i>
                  {{ trans('general.no_results') }}
              </div>
          </div>
          @endif
        </div>
    </div>
  </div>
</div>
 <div class="row">
    <div class="col-md-12">
      <div class="box box-default">

          @if ($user->id)
            <div class="box-header with-border">
              <div class="box-heading">
                <h3 class="box-title"> Assets assigned to {{ $user->first_name }}</h3>
              </div>
            </div><!-- /.box-header -->
          @endif

        <div class="box-body">
          <!-- checked out assets table -->
          @if (count($user->nokeys) > 0)
            <div class="table-responsive">
              <table class="table table-striped">
                  <thead>
                      <tr>
                          <th class="col-md-3">Asset</th>
                          <th class="col-md-2">{{ trans('admin/hardware/table.asset_tag') }}</th>
                          <th class="col-md-3">{{ trans('general.name') }}</th>
                          <th class="col-md-2">Image</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($user->nokeys as $nokey)

                        <tr>
                          <td>
                          @if ($nokey->physical=='1') {{ $nokey->model->name }}
                          @endif
                          </td>
                          <td><a href="/account/{{ $nokey->id }}/view-item">{{ $nokey->asset_tag }}</a></td>
                          <td><a href="/account/{{ $nokey->id }}/view-item">{{ $nokey->name }}</a></td>
                          <td>

                          @if (($nokey->image) && ($nokey->image!=''))
                            <img src="{{ config('app.url') }}/uploads/assets/{{ $nokey->image }}" height="50">

                          @elseif (($nokey->model) && ($nokey->model->image!=''))
                            <img src="{{ config('app.url') }}/uploads/models/{{ $nokey->model->image }}" height="50">
                          @endif

                         </td>
                      </tr>
                      @endforeach
                  </tbody>
              </table>
            </div>
          @else

          <div class="col-md-12">
              <div class="alert alert-info alert-block">
                  <i class="fa fa-info-circle"></i>
                  {{ trans('general.no_results') }}
              </div>
          </div>
          @endif
        </div>
    </div>
  </div>
</div>

  <div class="row">
    <div class="col-md-12">
      <div class="box box-default">

          @if ($user->id)
            <div class="box-header with-border">
              <div class="box-heading">
                <h3 class="box-title"> {{ trans('admin/users/general.software_user', array('name' => $user->first_name)) }}</h3>
              </div>
            </div><!-- /.box-header -->
          @endif

        <div class="box-body">
          <!-- checked out licenses table -->
          @if (count($user->licenses) > 0)
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                  <tr>
                      <th class="col-md-5">{{ trans('general.name') }}</th>
                      <th class="col-md-4">{{ trans('admin/hardware/form.serial') }}</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($user->licenses as $license)
                  <tr>
                      <td>{{ $license->name }}</td>
                      <td>

                          @can('licenses.keys')

                             {{ mb_strimwidth($license->serial, 0, 50, "...") }}
                            @else
                              ---
                            @endcan
                      </td>
                  </tr>
                  @endforeach
              </tbody>
          </table>
          </div>
          @else

          <div class="col-md-12">
              <div class="alert alert-info alert-block">
                  <i class="fa fa-info-circle"></i>
                  {{ trans('general.no_results') }}
              </div>
          </div>
          @endif
        </div>
    </div>
  </div>
</div>

  <div class="row">
    <div class="col-md-12">
      <div class="box box-default">

          @if ($user->id)
            <div class="box-header with-border">
              <div class="box-heading">
                <h3 class="box-title"> {{ trans('general.consumables') }} </h3>
              </div>
            </div><!-- /.box-header -->
          @endif

        <div class="box-body">
          <!-- checked out consumables table -->
          @if (count($user->consumables) > 0)
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                  <tr>
                      <th class="col-md-12">{{ trans('general.name') }}</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($user->consumables as $consumable)
                  <tr>
                      <td>{{ $consumable->name }}</td>
                  </tr>
                  @endforeach
              </tbody>
          </table>
          </div>
          @else

          <div class="col-md-12">
              <div class="alert alert-info alert-block">
                  <i class="fa fa-info-circle"></i>
                  {{ trans('general.no_results') }}
              </div>
          </div>
          @endif

        </div>
    </div>
  </div>
</div>

  <div class="row">
    <div class="col-md-12">
      <div class="box box-default">

          @if ($user->id)
            <div class="box-header with-border">
              <div class="box-heading">
                <h3 class="box-title"> {{ trans('general.accessories') }}</h3>
              </div>
            </div><!-- /.box-header -->
          @endif

        <div class="box-body">
          <!-- checked out licenses table -->
          @if (count($user->accessories) > 0)
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                  <tr>
                      <th class="col-md-12">Name</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($user->accessories as $accessory)
                  <tr>
                      <td>{{ $accessory->name }}</td>
                  </tr>
                  @endforeach
              </tbody>
          </table>
          </div>
          @else

          <div class="col-md-12">
              <div class="alert alert-info alert-block">
                  <i class="fa fa-info-circle"></i>
                  {{ trans('general.no_results') }}
              </div>
          </div>
          @endif
        </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="box box-default">

        @if ($user->id)
          <div class="box-header with-border">
            <div class="box-heading">
              <h3 class="box-title"> History</h3>
            </div>
          </div><!-- /.box-header -->
        @endif

      <div class="box-body">
        @if (count($user->userlog) > 0)
        <div class="table-responsive">
        <table class="table table-striped" id="example">
            <thead>
                <tr>
                    <th class="col-md-1"></th>
                    <th class="col-md-2"><span class="line"></span>{{ trans('table.action') }}</th>
                    <th class="col-md-4"><span class="line"></span>{{ trans('general.asset') }}</th>
                    <th class="col-md-2"><span class="line"></span>{{ trans('table.by') }}</th>
                    <th class="col-md-3">{{ trans('general.date') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user->userlog as $log)
                <tr>
                    <td class="text-center">
                        @if (($log->assetlog) && ($log->asset_type=="hardware"))
                            <i class="fa fa-barcode"></i>
                        @elseif (($log->accessorylog) && ($log->asset_type=="accessory"))
                            <i class="fa fa-keyboard-o"></i>
                        @elseif (($log->consumablelog) && ($log->asset_type=="consumable"))
                            <i class="fa fa-tint"></i>
                        @elseif (($log->licenselog) && ($log->asset_type=="software"))
                            <i class="fa fa-floppy-o"></i>
                        @else
                        <i class="fa fa-times"></i>
                        @endif

                    </td>
                    <td>{{ $log->action_type }}</td>
                    <td>

                        @if (($log->assetlog) && ($log->asset_type=="hardware"))

                            @if ($log->assetlog->deleted_at=='')

                                    {{ $log->assetlog->showAssetName() }}

                            @else
                                <del>{{ $log->assetlog->showAssetName() }}</del> (deleted)
                            @endif

                        @elseif (($log->licenselog) && ($log->asset_type=="software"))

                            @if ($log->licenselog->deleted_at=='')

                                    {{ $log->licenselog->name }}

                            @else
                                <del>{{ $log->licenselog->name }}</del> (deleted)
                            @endif

                         @elseif (($log->consumablelog) && ($log->asset_type=="consumable"))

                             @if ($log->consumablelog->deleted_at=='')
                                {{ $log->consumablelog->name }}
                             @else
                                 <del>{{ $log->consumablelog->name }}</del> (deleted)
                             @endif

                        @elseif (($log->accessorylog) && ($log->asset_type=="accessory"))
                            @if ($log->accessorylog->deleted_at=='')
                                {{ $log->accessorylog->name }}
                            @else
                                <del>{{ $log->accessorylog->name }}</del> (deleted)
                            @endif

                         @else
                             {{ trans('general.bad_data') }}
                        @endif

                    </td>
                    <td>
                        @if ($log->adminlog)
                        {{ $log->adminlog->fullName() }}
                        @endif
                    </td>
                    <td>{{ $log->created_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
        @else


        <div class="col-md-12">
            <div class="alert alert-info alert-block">
                <i class="fa fa-info-circle"></i>
                {{ trans('general.no_results') }}
            </div>
        </div>
        @endif
      </div>
  </div>
</div>
</div>

@stop
