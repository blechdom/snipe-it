@extends('layouts/default')

{{-- Page title --}}
@section('title')
Access / Status
@parent
@stop


@section('header_right')
@can('licenses.create')
    <a href="{{ route('create/licenses') }}" class="btn btn-primary pull-right">
      {{ trans('general.create') }}
    </a>
    @endcan
@stop

{{-- Page content --}}
@section('content')


<div class="row">
  <div class="col-md-12">
    <div class="box">

    <div class="box-body">
      <table
      name="access"
      id="table"
      data-url="{{route('api.access.list') }}"
      class="table table-striped"
      data-cookie="true"
      data-click-to-select="true"
      data-cookie-id-table="accessTable">
          <thead>
              <tr>
                  <th data-field="name_account" data-sortable="true" data-visible="true">Available Access / Status</th>
		<th data-field="request_action" data-sortable="false" data-visible="true">Request</th>
              </tr>
          </thead>
      </table>
    </div><!-- /.box-body -->
    <div class="box-footer clearfix">

    </div>
  </div><!-- /.box -->




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
    $('#table').bootstrapTable({
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
        showColumns: false,
        exportDataType: 'all',
        exportTypes: ['csv', 'txt','json', 'xml'],
        exportOptions: {
            fileName: 'licenses-export-' + (new Date()).toISOString().slice(0,10),
        },
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
