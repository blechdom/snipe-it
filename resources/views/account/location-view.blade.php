@extends('layouts/default')

{{-- Page title --}}
@section('title')

 {{ $location->name }}
 {{ trans('general.location') }}
@parent
@stop

{{-- Page content --}}
@section('content')

  <div class="row">
    <div class="col-md-12">
      <div class="box box-default">

        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <div class="table table-responsive">
                <table
                name="location_assets"
                id="table-assets"
                data-url="{{route('api.locations.viewfacilityassets', $location->id)}}"
                class="table table-striped"
                data-cookie="true"
                data-click-to-select="true"
                data-cookie-id-table="location_assetsDetailTable">
                    <thead>
                        <tr>
                            <th data-searchable="false" data-sortable="false" data-field="name_account" data-visible="true">{{ trans('general.name') }}</th>
                            <th data-searchable="false" data-sortable="false" data-field="model" data-visible="true">{{ trans('admin/hardware/form.model') }}</th>
                        	<th data-field="request_maintenance" data-sortable="false" data-visible="true">Maintenance</th>
			</tr>
                    </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>





@section('moar_scripts')
<script src="{{ asset('assets/js/bootstrap-table.js') }}"></script>
<script src="{{ asset('assets/js/extensions/cookie/bootstrap-table-cookie.js') }}"></script>
<script src="{{ asset('assets/js/extensions/mobile/bootstrap-table-mobile.js') }}"></script>
<script src="{{ asset('assets/js/extensions/export/bootstrap-table-export.js') }}"></script>
<script src="{{ asset('assets/js/extensions/export/tableExport.js') }}"></script>
<script src="{{ asset('assets/js/extensions/export/jquery.base64.js') }}"></script>

<script type="text/javascript">
    $('#table-assets').bootstrapTable({
        classes: 'table table-responsive table-no-bordered',
        undefinedText: '',
        iconsPrefix: 'fa',
        showRefresh: false,
        search: true,
        pageSize: {{ \App\Models\Setting::getSettings()->per_page }},
        pagination: true,
        sidePagination: 'server',
        sortable: true,
        cookie: true,
        mobileResponsive: true,
        showExport: false,
        exportDataType: 'all',
        exportTypes: ['csv', 'txt','json', 'xml'],
        maintainSelected: true,
        paginationFirstText: "{{ trans('general.first') }}",
        paginationLastText: "{{ trans('general.last') }}",
        paginationPreText: "{{ trans('general.previous') }}",
        paginationNextText: "{{ trans('general.next') }}",
        pageList: ['10','25','50','100','150','200'],
        icons: {
            paginationSwitchDown: 'fa-caret-square-o-down',
            paginationSwitchUp: 'fa-caret-square-o-up',
            columns: 'fa-columns',
            refresh: 'fa-refresh'
        },

    });
</script>


@stop

@stop
